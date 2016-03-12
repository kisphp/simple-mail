<?php

namespace Test\Mail;

use Test\Mail\Moks\MockMailConfig;
use Test\Mail\Moks\MockMessenger;

class MessengerTest extends \PHPUnit_Framework_TestCase
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
        $this->config = new MockMailConfig();
        $this->messenger = new MockMessenger($this->config);
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

        $this->messenger->createMailMessage([
            'test@example.com' => 'name',
        ], $subject, $messageBody);

        $swiftMessage = $this->messenger->getMessage();

        $this->assertSame($subject, $swiftMessage->getSubject());
        $this->assertSame($messageBody, $swiftMessage->getBody());
        $this->assertArrayHasKey('test@example.com', $swiftMessage->getTo());
    }
}
