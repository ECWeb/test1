<?php

namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="customers")
 */
class Customer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $email;

    /**
     * @ORM\Column(type="string")
     */
    protected $username;

    /**
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * @ORM\Column(type="string")
     */
    protected $firstname;

    /**
     * @ORM\Column(type="string")
     */
    protected $lastname;

    /**
     * @ORM\Column(type="string")
     */
    protected $gender;

    /**
     * @ORM\Column(type="string")
     */
    protected $country;

    /**
     * @ORM\Column(type="string")
     */
    protected $city;

    /**
     * @ORM\Column(type="string")
     */
    protected $phone;

    /**
     * @param $email
     * @param $username
     * @param $password
     * @param $firstname
     * @param $lastname
     * @param $gender
     * @param $country
     * @param $city
     * @param $phone
     *
    */
    public function __construct($email, $username, $password, $firstname, $lastname, $gender, $country, $city, $phone)
    {
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->firstname = $firstname;
        $this->lastname  = $lastname;
        $this->gender = $gender;
        $this->country = $country;
        $this->city = $city;
        $this->phone = $phone;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getPhone()
    {
        return $this->id;
    }

}