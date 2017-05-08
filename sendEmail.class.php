<?php

/**
 * Class sendEmail
 *
 * A class to send a email with php
 * - set the sender
 * - set the reply (if send(true) then sender = reply)
 * - set the subject
 * - set the message
 * - send the email (with parameter: email address)
 *
 * Help by: https://openclassrooms.com/courses/e-mail-envoyer-un-e-mail-en-php
 */

class sendEmail
{

    private $sender = array(
        'name',
        'address'
    );

    private $reply = array(
        'name',
        'address'
    );

    private $exp_equal_reply;

    private $subject;

    private $msg;

    /*
    ––––––––––––––––––––––––
    -- Headers --
    ––––––––––––––––––––––––
    */

    private $header;

    /*
    ––––––––––––––––––––––––
    -- Contain --
    ––––––––––––––––––––––––
    */

    private $contain;


    /**
     * sendMail constructor.
     *
     * @param $exp_equal_reply
     * parameter: if true then sender = reply else false sender ≠ reply
     *
     */
    public function __construct($exp_equal_reply)
    {

        if ($exp_equal_reply != true)
        {

            $exp_equal_reply = false;

        }

        $this->exp_equal_reply = $exp_equal_reply;

    }

    /**
     * @param $name
     * @param $address
     */
    public function set_sender($name, $address)
    {

        $this->sender['name'] = $name;
        $this->sender['address'] = $address;

        if ($this->exp_equal_reply == true) {
            $this->set_reply($name, $address);
        }

    }

    /**
     * @param $name
     * @param $address
     */
    public function set_reply($name, $address)
    {

        $this->reply['nom'] = $name;
        $this->reply['adresse'] = $address;

    }

    /**
     * @param $subject
     */
    public function set_objet($subject)
    {

        $this->subject = $subject;

    }

    /**
     * @param $msg
     */
    public function set_msg($msg)
    {

        $this->msg = $msg;

    }

    /**
     * @param $email
     */
    private function prepare($email)
    {

        $border = "-----=" . md5(rand());;

        if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $email)) {

            $newline = "\r\n";

        } else {

            $newline = "\n";

        }

        /*
        ––––––––––––––––––––––––
        -- Header --
        –––––––––––––––––––––––– 
        */

        $this->header = "From: \"" . $this->sender['name'] . "\"<" . $this->sender['address'] . ">" . $newline;
        $this->header .= "Reply-to: \"" . $this->reply['name'] . "\"<" . $this->reply['address'] . ">" . $newline;
        $this->header .= "MIME-Version: 1.0" . $newline;
        $this->header .= "Content-Type: multipart/alternative;" . $newline . " boundary=\"$border\"" . $newline;

        /*
        ––––––––––––––––––––––––
        -- Contain --
        ––––––––––––––––––––––––
        */

        $this->contain = $newline . "--" . $border . $newline;
        $this->contain .= "Content-Type: text/html; charset=\"utf-8\"" . $newline;
        $this->contain .= "Content-Transfer-Encoding: 8bit" . $newline;
        $this->contain .= $newline . $this->msg . $newline;
        $this->contain .= $newline . "--" . $border . "--" . $newline;
        $this->contain .= $newline . "--" . $border . "--" . $newline;

    }

    /**
     * @param $email
     */
    public function send($email)
    {

        $this->prepare($email);

        mail($email, $this->subject, $this->contain, $this->header);

    }

}


?>
