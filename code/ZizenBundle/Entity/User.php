<?php

namespace ZSI\ZizenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * This class presents the entity of user on the data layer. It is the most
 * important class on the data layer. Each user has its own personal data, 
 * set of pubs, locations, and friends. It also has its own instance of thirst and filters.
 * 
 */

/**
 * @ORM\Entity
 */
class User implements UserInterface {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $user_id;
    /**
     * @Assert\NotBlank()
     * @ORM\Column(length="100")
     */
    protected $username;
    /**
     * @Assert\NotBlank()
     * @ORM\Column
     */
    protected $password;
    /**
     * @ORM\Column(length="64")
     */
    protected $salt;
    /**
     * @ORM\Column(length="32")
     */
    protected $role;    
    /**
     * @Assert\NotBlank()
     * @ORM\Column(length="100")
     */
    protected $name;
    /**
     * @Assert\NotBlank()
     * @ORM\Column(length="100")
     */
    protected $surname;
    /**
     * @Assert\NotBlank()
     * @ORM\Column(length="100", nullable=true)
     */
    protected $email;
    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="boolean", nullable=true)
     */
     protected $sex;
    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="date", nullable=true)
     */
	protected $birthDate;
    /**
     * @ORM\OneToOne(targetEntity="Filters")
     * @ORM\JoinColumn(name="filters_id", referencedColumnName="filters_id")
     **/
     protected $filters;
    /**
     * @ORM\ManyToMany(targetEntity="Location")
     * @ORM\JoinTable(
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="user_id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="location_id", referencedColumnName="location_id")}
     *      )
     */
    protected $locations;
    /**
     * @ORM\ManyToMany(targetEntity="Pub")
     * @ORM\JoinTable(
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="user_id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="pub_id", referencedColumnName="pub_id")}
     *      )
     */
    protected $favouritePubs;
     /**
     * @ORM\OneToOne(targetEntity="Location")
     * @ORM\JoinColumn(name="defaultLocation_id", referencedColumnName="location_id")
     **/   
    protected $defaultLocation;
    /**
     * @ORM\ManyToMany(targetEntity="User")
     * @ORM\JoinTable(
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="user_id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="friend_id", referencedColumnName="user_id")}
     *      )
     */
    protected $friends;
    /**
     * @ORM\OneToOne(targetEntity="Thirst")
     * @ORM\JoinColumn(name="thirst_id", referencedColumnName="thirst_id")
     **/
    protected $thirst;
     
    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set username
     *
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Set password
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }
    /**
     * Set role
     *
     * @param string $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * Get role
     *
     * @return string 
     */
    public function getRole()
    {
        return $this->role;
    }

    public function getRoles() {
   	return array($this->role);
    }

    public function eraseCredentials() {
    }

    public function equals(UserInterface $user) {
    	return $this->username === $user->getUsername();
    }

    public function __construct()
    {
		$this->salt = md5(uniqid(null, true));
		$this->locations = new \Doctrine\Common\Collections\ArrayCollection();
		$this->favouritePubs = new \Doctrine\Common\Collections\ArrayCollection();
		$this->friends = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set user_id
     *
     * @param integer $userId
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;
    }

    /**
     * Get user_id
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set sex
     *
     * @param boolean $sex
     */
    public function setSex($sex)
    {
        $this->sex = $sex;
    }

    /**
     * Get sex
     *
     * @return boolean 
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set birthDate
     *
     * @param date $birthDate
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    /**
     * Get birthDate
     *
     * @return date 
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set filters
     *
     * @param ZSI\ZizenBundle\Entity\Filters $filters
     */
    public function setFilters(\ZSI\ZizenBundle\Entity\Filters $filters)
    {
        $this->filters = $filters;
    }

    /**
     * Get filters
     *
     * @return ZSI\ZizenBundle\Entity\Filters 
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * Add locations
     *
     * @param ZSI\ZizenBundle\Entity\Location $locations
     */
    public function addLocation(\ZSI\ZizenBundle\Entity\Location $locations)
    {
        $this->locations[] = $locations;
    }

    /**
     * Get locations
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLocations()
    {
        return $this->locations;
    }

    /**
     * Add favouritePubs
     *
     * @param ZSI\ZizenBundle\Entity\Pub $favouritePubs
     */
    public function addPub(\ZSI\ZizenBundle\Entity\Pub $favouritePubs)
    {
        $this->favouritePubs[] = $favouritePubs;
    }

    /**
     * Get favouritePubs
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFavouritePubs()
    {
        return $this->favouritePubs;
    }

    /**
     * Add friends
     *
     * @param ZSI\ZizenBundle\Entity\User $friends
     */
    public function addUser(\ZSI\ZizenBundle\Entity\User $friends)
    {
        $this->friends[] = $friends;
    }
    /**
     * Delete friends
     *
     * @param ZSI\ZizenBundle\Entity\User $friends
     */
    public function deleteUser(\ZSI\ZizenBundle\Entity\User $friend)
    {
		$index = 0;
		foreach($this->friends as $item)
		{
			if($item->getUserId() == $friend->getUserId())
				unset($this->friends[$index]);
			$index++;
		}
    }
    /**
     * Get friends
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFriends()
    {
        return $this->friends;
    }

	public function unsetThirst()
	{
		$this->thirst = null;
	}
    /**
     * Set thirst
     *
     * @param ZSI\ZizenBundle\Entity\Thirst $thirst
     */
    public function setThirst(\ZSI\ZizenBundle\Entity\Thirst $thirst)
    {
        $this->thirst = $thirst;
    }

    /**
     * Get thirst
     *
     * @return ZSI\ZizenBundle\Entity\Thirst 
     */
    public function getThirst()
    {
        return $this->thirst;
    }

    /**
     * Set defaultLocation
     *
     * @param ZSI\ZizenBundle\Entity\Location $defaultLocation
     */
    public function setDefaultLocation(\ZSI\ZizenBundle\Entity\Location $defaultLocation)
    {
        $this->defaultLocation = $defaultLocation;
    }

    /**
     * Get defaultLocation
     *
     * @return ZSI\ZizenBundle\Entity\Location 
     */
    public function getDefaultLocation()
    {
        return $this->defaultLocation;
    }
    /**
     * Unset defaultLocation
     * 
     */   
    public function unsetDeaultLocation()
    {
		$this->defaultLocation = null;
	}
}
