<?php

namespace ZSI\ZizenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * This class represents the entity of filters on the data layer!
 */

/**
 * @ORM\Entity
 */
class Filters {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
	protected $filters_id;
	/**
	 * @Assert\Regex(pattern="/^([1-9][0-9]*)$/")
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $friend_radius;
	/**
	 * @Assert\Regex(pattern="/^([1-9][0-9]*)$/")
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $other_radius;
	/**
	 * @Assert\Regex(pattern="/^([1-9][0-9]*)$/")
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $age_min;
	/**
	 * @Assert\Regex(pattern="/^([1-9][0-9]*)$/")
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $age_max;
	/**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $filter_sex;

    /**
     * Set filters_id
     *
     * @param integer $filtersId
     */
    public function setFiltersId($filtersId)
    {
        $this->filters_id = $filtersId;
    }

    /**
     * Get filters_id
     *
     * @return integer 
     */
    public function getFiltersId()
    {
        return $this->filters_id;
    }

    /**
     * Set friend_radius
     *
     * @param integer $friendRadius
     */
    public function setFriendRadius($friendRadius)
    {
        $this->friend_radius = $friendRadius;
    }

    /**
     * Get friend_radius
     *
     * @return integer 
     */
    public function getFriendRadius()
    {
        return $this->friend_radius;
    }

    /**
     * Set other_radius
     *
     * @param integer $otherRadius
     */
    public function setOtherRadius($otherRadius)
    {
        $this->other_radius = $otherRadius;
    }

    /**
     * Get other_radius
     *
     * @return integer 
     */
    public function getOtherRadius()
    {
        return $this->other_radius;
    }

    /**
     * Set age_min
     *
     * @param integer $ageMin
     */
    public function setAgeMin($ageMin)
    {
        $this->age_min = $ageMin;
    }

    /**
     * Get age_min
     *
     * @return integer 
     */
    public function getAgeMin()
    {
        return $this->age_min;
    }

    /**
     * Set age_max
     *
     * @param integer $ageMax
     */
    public function setAgeMax($ageMax)
    {
        $this->age_max = $ageMax;
    }

    /**
     * Get age_max
     *
     * @return integer 
     */
    public function getAgeMax()
    {
        return $this->age_max;
    }

    /**
     * Set filter_sex
     *
     * @param boolean $filterSex
     */
    public function setFilterSex($filterSex)
    {
        $this->filter_sex = $filterSex;
    }

    /**
     * Get filter_sex
     *
     * @return boolean 
     */
    public function getFilterSex()
    {
        return $this->filter_sex;
    }

    /**
     * Set id
     *
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
