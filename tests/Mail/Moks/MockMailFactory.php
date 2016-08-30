<?php

namespace Test\Mail\Moks;

use Kisphp\Mail\AbstractMailerFactory;

class MockMailFactory extends AbstractMailerFactory
{
    /**
     * @return MockMailConfig
     */
    public function createMailConfig()
    {
        return new MockMailConfig();
    }
}
