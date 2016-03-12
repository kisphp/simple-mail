<?php

namespace Test\Mail\Moks;

use Kisphp\Mail\MailConfigInterface;

class MockMailConfig implements MailConfigInterface
{
    public function getHost()
    {
        return 'mail-host.example.com';
    }

    public function getPort()
    {
        return 25;
    }

    public function getSenderUsername()
    {
        return 'sender username';
    }

    public function getSenderPassword()
    {
        return 'password';
    }

    public function getMailEncryptionType()
    {
        return 'ssl';
    }

    public function getFromEmail()
    {
        return 'from@example.com';
    }

    public function getFromName()
    {
        return 'from name';
    }
}
