<?php

namespace ZSI\ZizenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * This class represents the entity of pub on the data layer.
 */

/**
 * @ORM\Entity
 */
class Pub {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
	protected $pub_id;
	/**
	 * @Assert\NotBlank()
     * @ORM\Column(length="100")
     */
    protected $pub_name;
	/**
	 * @Assert\NotBlank()
     * @ORM\Column(length="100")
     */
    protected $pub_location;

    /**
     * Set pub_id
     *
     * @param integer $pubId
     */
    public function setPubId($pubId)
    {
        $this->pub_id = $pubId;
    }

    /**
     * Get pub_id
     *
     * @return integer 
     */
    public function getPubId()
    {
        return $this->pub_id;
    }

    /**
     * Set pub_name
     *
     * @param string $pubName
     */
    public function setPubName($pubName)
    {
        $this->pub_name = $pubName;
    }

    /**
     * Get pub_name
     *
     * @return string 
     */
    public function getPubName()
    {
        return $this->pub_name;
    }

    /**
     * Set pub_location
     *
     * @param string $pubLocation
     */
    public function setPubLocation($pubLocation)
    {
        $this->pub_location = $pubLocation;
    }

    /**
     * Get pub_location
     *
     * @return string 
     */
    public function getPubLocation()
    {
        return $this->pub_location;
    }
}
