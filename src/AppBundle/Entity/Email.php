<?php
/**
 * Created by IntelliJ IDEA.
 * User: german
 * Date: 26.12.15
 * Time: 20:24
 */

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Email
{
    /**
     * @Assert\NotBlank()
     */
    protected $name;
    /**
     * @Assert\NotBlank()
     */
    protected $email;
    /**
     * @Assert\NotBlank()
     */
    protected $phone;
    protected $message;

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhone()
    {
        return $this->phone;

    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }
}