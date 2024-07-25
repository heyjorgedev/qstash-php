<?php

use PHPUnit\Framework\Assert;

expect()->extend('toUseApiKey', function (string $apiKey) {
    $transporterProperty = new \ReflectionProperty($this->value, 'transporter');
    $transporter = $transporterProperty->getValue($this->value);
    $headerProperty = new \ReflectionProperty($transporter, 'headers');
    $headersWrapper = $headerProperty->getValue($transporter);
    $headers = $headersWrapper->toArray();
    Assert::assertArrayHasKey('Authorization', $headers);
    Assert::assertEquals($headers['Authorization'], 'Bearer '.$apiKey);
});
