# Kisphp Simple mailer

[![Build Status](https://travis-ci.org/kisphp/simple-mail.svg?branch=master)](https://travis-ci.org/kisphp/simple-mail)
[![codecov.io](https://codecov.io/github/kisphp/simple-mail/coverage.svg?branch=master)](https://codecov.io/github/kisphp/simple-mail?branch=master)

[![Latest Stable Version](https://poser.pugx.org/kisphp/simple-mail/v/stable)](https://packagist.org/packages/kisphp/simple-mail)
[![Total Downloads](https://poser.pugx.org/kisphp/simple-mail/downloads)](https://packagist.org/packages/kisphp/simple-mail)
[![License](https://poser.pugx.org/kisphp/simple-mail/license)](https://packagist.org/packages/kisphp/simple-mail)
[![Monthly Downloads](https://poser.pugx.org/kisphp/simple-mail/d/monthly)](https://packagist.org/packages/kisphp/simple-mail)

Quick send emails with swift mailer for your website with a very simple implementation.
By default is configured to send through google.


## Installation

```bash
composer require kisphp/simple-mail
```

## Configuration

If you already use composer into your project, then the required libraries will be automatically included.
Other way you'll have to include autoloader into your php file:

```php
require_once 'vendor/autoload.php';
```

First step is to create a Configuration class that will implement `Kisphp\MailConfigInterface`.

```php
<?php

class MailConfig implements Kisphp\MainConfigInterface
{
    // create here methods declared in interface
}
```

Next you'll need to create Messenger object:

```php
<?php

use Kisphp\Mail\Messenger;

$config = new MailConfig();
$messenger = new Messenger($config);

$recipients = [
    'user_1@example.com' => 'User name 1',
    'user_2@example.com' => 'User name 2',
];

// create message
$messenger->createMailMessage($recipients, $subject, $messageBody);

// send the message (will return number of emails sent)
$messenger->send();

```

## Change mail transport type

To change the transport type you'll have to extend the createMailTransport method from Messenger class:

```php
<?php

class ProjectMessenger extends Kisphp\Mail\Messenger
{
    protected function createMailTransport()
    {
        $this->transport = \Swift_MailTransport::newInstance();
    }
}

// and load this class in your project
$messenger = new ProjectMessenger($config);

```

More details can be seen here: [SwiftMailer Sending](http://swiftmailer.org/docs/sending.html)
