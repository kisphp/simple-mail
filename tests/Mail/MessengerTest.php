<?php

namespace Test\Mail;

use PHPUnit\Framework\TestCase;
use Test\Mail\Moks\MockMailConfig;
use Test\Mail\Moks\MockMessenger;
use Test\Mail\Moks\MockMailFactory;

class MessengerTest extends TestCase
{
    /**
     * @var MockMailConfig
     */
    protected $config;

    /**
     * @var MockMessenger
     */
    protected $messenger;

    public function setUp()
    {
        $this->messenger = MockMailFactory::createMailer();
    }

    /**
     * @expectedException \Swift_DependencyException
     */
    public function testSendWithoutConfiguration()
    {
        $this->messenger->send();
    }

    public function testSetMessegeCreate()
    {
        $subject = 'subject';
        $messageBody = 'my test <b>message</b>';

        $swiftMessage = $this->createSwiftMessager($subject, $messageBody);

        $this->assertArrayHasKey('test@example.com', $swiftMessage->getTo());
    }

    public function testMessageBody()
    {
        $subject = 'subject';
        $messageBody = 'my test <b>message</b>';

        $swiftMessage = $this->createSwiftMessager($subject, $messageBody);

        $this->assertSame($messageBody, $swiftMessage->getBody());
    }

    public function testMessageSubject()
    {
        $subject = 'subject';
        $messageBody = 'my test <b>message</b>';

        $swiftMessage = $this->createSwiftMessager($subject, $messageBody);

        $this->assertSame($subject, $swiftMessage->getSubject());
    }

    /**
     * @expectedException \Swift_TransportException
     */
    public function test_sendingEmail()
    {
        $subject = 'subject';
        $messageBody = 'my test <b>message</b>';

        $this->messenger->createMailMessage([
            'test@example.com' => 'name',
        ], $subject, $messageBody);

        $this->messenger->send();
    }

    /**
     * @param string $subject
     * @param string $messageBody
     *
     * @return \Swift_Message
     */
    protected function createSwiftMessager($subject, $messageBody)
    {
        $this->messenger->createMailMessage(
            [
                'test@example.com' => 'name',
            ],
            $subject,
            $messageBody
        );

        $swiftMessage = $this->messenger->getMessage();

        return $swiftMessage;
    }
}
