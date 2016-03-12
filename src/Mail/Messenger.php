<?php

namespace Kisphp\Mail;

class Messenger
{
    const MAIL_MESSAGE_TYPE = 'text/html';

    /**
     * @var \Swift_SmtpTransport
     */
    protected $transport;

    /**
     * @var \Swift_Mailer
     */
    protected $mailer;

    /**
     * @var \Swift_Message
     */
    protected $message;

    /**
     * @var MailConfigInterface
     */
    protected $mailConfig;

    /**
     * @param MailConfigInterface $config
     */
    public function __construct(MailConfigInterface $config)
    {
        $this->mailConfig = $config;

        $this->createMailTransport();
        $this->createMailer();
    }

    /**
     * @param array $arrayEmailName
     * @param string $subject
     * @param string $htmlMessage
     *
     * @return $this
     */
    public function createMailMessage(array $arrayEmailName, $subject, $htmlMessage)
    {
        $this->message = \Swift_Message::newInstance($subject)
            ->setFrom([
                $this->mailConfig->getFromEmail() => $this->mailConfig->getFromName(),
            ])
            ->setTo($arrayEmailName)
            ->setBody($htmlMessage, self::MAIL_MESSAGE_TYPE)
        ;

        return $this;
    }

    /**
     * @throws \Swift_DependencyException
     *
     * @return int
     */
    public function send()
    {
        if ($this->message === null) {
            throw new \Swift_DependencyException('First you need to access method "createMailMessage"');
        }

        return $this->mailer->send($this->message);
    }

    /**
     * @return $this
     */
    protected function createMailTransport()
    {
        $this->transport = \Swift_SmtpTransport::newInstance(
            $this->mailConfig->getHost(),
            $this->mailConfig->getPort(),
            $this->mailConfig->getMailEncryptionType()
        );

        $this->transport
            ->setUsername($this->mailConfig->getSenderUsername())
            ->setPassword($this->mailConfig->getSenderPassword())
        ;

        return $this;
    }

    /**
     * @return $this
     */
    protected function createMailer()
    {
        $this->mailer = \Swift_Mailer::newInstance($this->transport);

        return $this;
    }

    /**
     * @return \Swift_Message
     */
    public function getMessage()
    {
        return $this->message;
    }
}
