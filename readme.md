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
require_once '/path/to/vendor/autoload.php';
```

First step you need to do, is to create a Configuration class that will implement `Kisphp\Mail\MailConfigInterface;`.

```php
<?php

namespace Demo;

use Kisphp\Mail\MailConfigInterface;

class DemoMailConfig implements MailConfigInterface
{
    public function getHost()
    {
        return 'ssl://smtp.gmail.com';
    }

    public function getPort()
    {
        return 465;
    }

    public function getSenderUsername()
    {
        return 'your-email-address@gmail.com';
    }

    public function getSenderPassword()
    {
        return 'your account password';
    }

    public function getMailEncryptionType()
    {
        return null;
    }

    public function getFromEmail()
    {
        return 'no-reply@example.com';
    }

    public function getFromName()
    {
        return 'My website';
    }
}
```

Next you'll need to create extend `AbstractMailerFactory` class to use your configuration:

```php
class DemoMailerFactory extends AbstractMailerFactory
{
    /**
     * @return DemoMailConfig
     */
    public function createMailConfig()
    {
        return new DemoMailConfig();
    }
}
```

And from here you can start to use it:

```php
<?php

$messenger = DemoMailerFactory::createMailer();

// recipients
$recipients = [
    'user_1@example.com' => 'User name 1',
    'user_2@example.com' => 'User name 2',
];

$subject = 'Testing mail';
$htmlMessage = 'this is my <b>message</b> for you';

// compose email
$messenger->createMailMessage($recipients, $subject, $htmlMessage);

// send the email and get the number of how many emails were sent
$emailsSent = $messenger->send();

```

## Change mail transport type

To change the transport type you'll have to extend the createMailTransport method from Messenger class:

```php
<?php

use Kisphp\Mail\Messenger;

class ProjectMessenger extends Messenger
{
    /**
     * @return $this
     */
    protected function createMailTransport()
    {
        $this->transport = \Swift_MailTransport::newInstance();
        
        return $this;
    }
}

class DemoMailerFactory extends AbstractMailerFactory
{
    
    // createMailConfig method here
    
    /**
     * @param MailConfigInterface $config
     *
     * @return MessengerInterface
     */
    public function createMessenger(MailConfigInterface $config)
    {
        return new ProjectMessenger($config);
    }
}

// and load this class in your project
$messenger = new ProjectMessenger($config);

```

More details can be seen here: [SwiftMailer Sending](http://swiftmailer.org/docs/sending.html)
