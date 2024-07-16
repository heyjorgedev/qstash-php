<?php

namespace HeyJorgeDev\QStash;

use HeyJorgeDev\QStash\Contracts\ReceiverInterface;
use Jose\Component\Checker\ClaimCheckerManager;
use Jose\Component\Checker\ExpirationTimeChecker;
use Jose\Component\Checker\InvalidClaimException;
use Jose\Component\Checker\IsEqualChecker;
use Jose\Component\Checker\IssuerChecker;
use Jose\Component\Checker\NotBeforeChecker;
use Jose\Component\Core\AlgorithmManager;
use Jose\Component\Core\JWKSet;
use Jose\Component\KeyManagement\JWKFactory;
use Jose\Component\Signature\Algorithm\HS256;
use Jose\Component\Signature\JWS;
use Jose\Component\Signature\JWSVerifier;
use Jose\Component\Signature\Serializer\CompactSerializer;
use Jose\Component\Signature\Serializer\JWSSerializerManager;
use Psr\Clock\ClockInterface;

class Receiver implements ReceiverInterface
{
    protected readonly JWKSet $keys;

    protected readonly JWSVerifier $jwsVerifier;

    protected readonly JWSSerializerManager $serializer;

    /**
     * @param  array<string>  $signingKeys
     */
    public function __construct(protected ClockInterface $clock, array $signingKeys)
    {

        $this->jwsVerifier = new JWSVerifier(
            signatureAlgorithmManager: new AlgorithmManager([
                new HS256(),
            ]),
        );

        $this->serializer = new JWSSerializerManager([
            new CompactSerializer(),
        ]);

        $keys = [];
        foreach ($signingKeys as $signingKey) {
            $keys[] = JWKFactory::createFromSecret(
                $signingKey,       // The shared secret
                [                      // Optional additional members
                    'alg' => 'HS256',
                    'use' => 'sig',
                ]
            );
        }

        $this->keys = new JWKSet($keys);
    }

    public function verify(array|string $body, string $signature, string $url): bool
    {
        $jws = $this->serializer->unserialize($signature);

        return $this->jwsVerifier->verifyWithKeySet($jws, $this->keys, 0)
            && $this->checkClaims($url, $body, $jws);
    }

    private function checkClaims(string $url, array|string $body, JWS $jws): bool
    {
        $claimChecker = new ClaimCheckerManager([
            new IssuerChecker(['Upstash']),
            new NotBeforeChecker($this->clock),
            new ExpirationTimeChecker($this->clock),
            new IsEqualChecker('sub', $url),
        ]);

        $claims = json_decode($jws->getPayload(), true);

        try {
            $claimChecker->check($claims, ['iss', 'nbf', 'exp', 'sub']);

            return $this->compareBody($claims['body'], $body);
        } catch (InvalidClaimException) {
            return false;
        }
    }

    private function compareBody(string $jwtBody, array|string $receivedBody): bool
    {
        // TODO: Implement

        return true;
    }
}
