> **This project is still in early stages of development.**
> I am still writing most of the API endpoints and the API is under constant change so I do not recommend to use it on production yet. 


# QStash Client SDK for PHP

[![Latest Version on Packagist](https://img.shields.io/packagist/v/heyjorgedev/qstash-php.svg?style=flat-square)](https://packagist.org/packages/heyjorgedev/qstash-php)
[![Tests](https://img.shields.io/github/actions/workflow/status/heyjorgedev/qstash-php/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/heyjorgedev/qstash-php/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/heyjorgedev/qstash-php.svg?style=flat-square)](https://packagist.org/packages/heyjorgedev/qstash-php)

**QStash** is an HTTP based messaging and scheduling solution for serverless and
edge runtimes.

## How does QStash work?

QStash is the message broker between your serverless apps. You send an HTTP
request to QStash, that includes a destination, a payload and optional settings.
We durably store your message and will deliver it to the destination API via
HTTP. In case the destination is not ready to receive the message, we will retry
the message later, to guarentee at-least-once delivery.

## Installation

You can install the package via composer:

```bash
composer require heyjorgedev/qstash-php
```

### Get your authorization token

Go to [Upstash Console](https://console.upstash.com/qstash) and copy the QSTASH_TOKEN.

## Basic Usage

```php
use HeyJorgeDev\QStash\QStash;
use HeyJorgeDev\QStash\ValueObjects\Message;
use HeyJorgeDev\QStash\ValueObjects\Url;

$client = QStash::client('QSTASH_TOKEN');

$message = $client->publish(
    Message::to(new Url('https://my-api...'))
        ->withBody([
            'hello' => 'world',
        ])
]);

echo $message->id;
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Jorge Lapa](https://github.com/heyjorgedev)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
