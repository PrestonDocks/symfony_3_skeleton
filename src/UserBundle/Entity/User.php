<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

	/**
	 * @ORM\Column(type="string",unique=true)
	 * @Assert\NotBlank(message="Username can not be empty")
	 */
	private $username;

    /**
     * @ORM\Column(type="string")
     */
	private $password;

    /**
     * @Assert\NotBlank(message="You must enter a password",groups={"Registration"})
     */
	private $plainPassword;

	/**
	 * @ORM\Column(type="string",unique=true)
	 * @Assert\NotBlank(message="Email can not be empty")
	 * @Assert\Email(message="The email field must contain a valid email")
	 */
	private $email;

	/**
	 * @ORM\Column(type="string")
	 * @Assert\NotBlank(message="First name can not be empty")
	 */
	private $firstName;

	/**
	 * @ORM\Column(type="string")
	 * @Assert\NotBlank(message="Last name can not be empty")
	 */
	private $lastName;

	/**
	 * @ORM\Column(type="string")
	 */
	private $phoneNumber;

	/**
	 * @ORM\Column(type="string")
	 */
	private $mobileNumber;

    /**
     * @ORM\Column(type="json_array")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $passwordResetCode;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

	public function getUsername() {
		return $this->username;
	}

	public function getRoles() {
		$roles = $this->roles;
		if(!in_array('ROLE_USER',$roles)){
		    $roles[] = "ROLE_USER";
        }
        return $roles;
	}

	public function getPassword() {
		return $this->password;
	}

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }



	public function getSalt() {
		// TODO: Implement getSalt() method.
	}

	public function eraseCredentials() {
		$this->plainPassword = null;
	}

	/**
	 * @param mixed $username
	 */
	public function setUsername( $username ) {
		$this->username = $username;
	}


	/**
	 * @return mixed
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @param mixed $email
	 */
	public function setEmail( $email ) {
		$this->email = $email;
	}

	/**
	 * @return mixed
	 */
	public function getFirstName() {
		return $this->firstName;
	}

	/**
	 * @param mixed $firstName
	 */
	public function setFirstName( $firstName ) {
		$this->firstName = $firstName;
	}

	/**
	 * @return mixed
	 */
	public function getLastName() {
		return $this->lastName;
	}

	/**
	 * @param mixed $lastName
	 */
	public function setLastName( $lastName ) {
		$this->lastName = $lastName;
	}

	/**
	 * @return mixed
	 */
	public function getPhoneNumber() {
		return $this->phoneNumber;
	}

	/**
	 * @param mixed $phoneNumber
	 */
	public function setPhoneNumber( $phoneNumber ) {
		$this->phoneNumber = $phoneNumber;
	}

	/**
	 * @return mixed
	 */
	public function getMobileNumber() {
		return $this->mobileNumber;
	}

	/**
	 * @param mixed $mobileNumber
	 */
	public function setMobileNumber( $mobileNumber ) {
		$this->mobileNumber = $mobileNumber;
	}

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        $this->password = null;
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

    /**
     * @return mixed
     */
    public function getPasswordResetCode()
    {
        return $this->passwordResetCode;
    }

    /**
     * @param mixed $passwordResetCode
     */
    public function setPasswordResetCode($passwordResetCode)
    {
        $this->passwordResetCode = $passwordResetCode;
    }




}

