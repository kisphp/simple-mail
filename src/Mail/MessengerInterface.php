<?php

namespace Kisphp\Mail;

interface MessengerInterface
{
    /**
     * @param array $arrayEmailName
     * @param string $subject
     * @param string $htmlMessage
     *
     * @return $this
     */
    public function createMailMessage(array $arrayEmailName, $subject, $htmlMessage);

    /**
     * @throws \Swift_DependencyException
     *
     * @return int
     */
    public function send();
}
