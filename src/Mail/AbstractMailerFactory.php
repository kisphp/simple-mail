<?php

namespace Kisphp\Mail;

abstract class AbstractMailerFactory
{
    /**
     * @return MessengerInterface
     */
    public static function createMailer()
    {
        $factory = new static();
        $config = $factory->createMailConfig();

        return $factory->createMessenger($config);
    }

    /**
     * @return MailConfigInterface
     */
    abstract public function createMailConfig();

    /**
     * @param MailConfigInterface $config
     *
     * @return MessengerInterface
     */
    public function createMessenger(MailConfigInterface $config)
    {
        return new Messenger($config);
    }
}
