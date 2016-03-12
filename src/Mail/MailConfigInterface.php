<?php

namespace Kisphp\Mail;

interface MailConfigInterface
{
    /**
     * smtp.gmail.com
     * mail.example.com
     *
     * @return string
     */
    public function getHost();

    /**
     * 25 local smtp
     * 465 gmail
     *
     * @return int
     */
    public function getPort();

    /**
     * email address to connect to local/gmail mail server
     *
     * @return string
     */
    public function getSenderUsername();

    /**
     * @return string
     */
    public function getSenderPassword();

    /**
     * null|ssl
     *
     * @return string
     */
    public function getMailEncryptionType();

    /**
     * this will be the sender email address
     *
     * @return string
     */
    public function getFromEmail();

    /**
     * this will be the sender name
     *
     * @return string
     */
    public function getFromName();
}
