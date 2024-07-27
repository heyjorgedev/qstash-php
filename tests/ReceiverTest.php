<?php

use HeyJorgeDev\QStash\Receiver;
use HeyJorgeDev\QStash\Tests\Mocks\MockClock;

it('can verify a token', function () {
    // mocks the expiration date
    $now = (new DateTimeImmutable)->setTimestamp(1721069141);

    $receiver = new Receiver(new MockClock($now), [
        'sig_561zQH6V9b96E63sS3b9wvGXosi7',
        'sig_5KX2tPTwA8LWwQDEfPDmF7ktwB2v',
    ]);

    $result = $receiver->verify(
        body: ['message' => 'hello world'],
        signature: 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhdWQiOiIiLCJib2R5IjoiLVcyTk4xZnZNaGFxLVhlT0JJcXE4SUE4ajdMSlhxTDhaY1NDMXJoRE1CVT0iLCJleHAiOjE3MjEwNjkxNTEsImlhdCI6MTcyMTA2ODg1MSwiaXNzIjoiVXBzdGFzaCIsImp0aSI6Imp3dF82Y2tnQTdSUW5qNngzWE1LU25mVWI4YXRUc1pQIiwibmJmIjoxNzIxMDY4ODUxLCJzdWIiOiJodHRwczovL3dlYmhvb2suc2l0ZS83N2FlODk4OC1lZWNmLTRhMDEtOWE3Ni0yYTM3MjEyYzc1YTgifQ.ppulAF6fmnYfeVdR72HprfzLSIN_6KX65JOXwdxRMyk',
        url: 'https://webhook.site/77ae8988-eecf-4a01-9a76-2a37212c75a8',
    );

    expect($result)->toBeTrue();
});
