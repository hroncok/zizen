<?php

namespace ZSI\ZizenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * This class represents the entity of location on the data layer!
 */

/**
 * @ORM\Entity
 */
class Location {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
	protected $location_id;
	/**
	 * @Assert\NotBlank()
     * @ORM\Column(length="100")
     */
    protected $location_name;
	/**
	 * @Assert\NotBlank()
     * @ORM\Column(length="100")
     */
    protected $location_location;

    /**
     * Set location_id
     *
     * @param integer $locationId
     */
    public function setLocationId($locationId)
    {
        $this->location_id = $locationId;
    }

    /**
     * Get location_id
     *
     * @return integer 
     */
    public function getLocationId()
    {
        return $this->location_id;
    }

    /**
     * Set location_name
     *
     * @param string $locationName
     */
    public function setLocationName($locationName)
    {
        $this->location_name = $locationName;
    }

    /**
     * Get location_name
     *
     * @return string 
     */
    public function getLocationName()
    {
        return $this->location_name;
    }


    /**
     * Set location_location
     *
     * @param string $locationLocation
     */
    public function setLocationLocation($locationLocation)
    {
        $this->location_location = $locationLocation;
    }

    /**
     * Get location_location
     *
     * @return string 
     */
    public function getLocationLocation()
    {
        return $this->location_location;
    }
}
