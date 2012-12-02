<?php

namespace ZSI\ZizenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents the entity of thirst on the data layer. 
 * Each user has its own instance of this class. Each instance of this class
 * has its own instance of location and pub.
 */

/**
 * @ORM\Entity
 */
class Thirst {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $thirst_id;
    /**
     * @ORM\Column(type="integer")
     */
    protected $status;
    /**
     * @ORM\Column(length="255")
     */
    protected $note;
    /**
     * @ORM\OneToOne(targetEntity="Location")
     * @ORM\JoinColumn(name="location_id", referencedColumnName="location_id")
     **/
    protected $location;
    /**
     * @ORM\OneToOne(targetEntity="Pub")
     * @ORM\JoinColumn(name="pub_id", referencedColumnName="pub_id")
     **/
    protected $pub;


    /**
     * Set thirst_id
     *
     * @param integer $thirstId
     */
    public function setThirstId($thirstId)
    {
        $this->thirst_id = $thirstId;
    }

    /**
     * Get thirst_id
     *
     * @return integer 
     */
    public function getThirstId()
    {
        return $this->thirst_id;
    }

    /**
     * Set status
     *
     * @param integer $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set note
     *
     * @param string $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * Get note
     *
     * @return string 
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set location
     *
     * @param ZSI\ZizenBundle\Entity\Location $location
     */
    public function setLocation(\ZSI\ZizenBundle\Entity\Location $location)
    {
        $this->location = $location;
    }

    /**
     * Get location
     *
     * @return ZSI\ZizenBundle\Entity\Location 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set pub
     *
     * @param ZSI\ZizenBundle\Entity\Pub $pub
     */
    public function setPub(\ZSI\ZizenBundle\Entity\Pub $pub)
    {
        $this->pub = $pub;
    }

    /**
     * Get pub
     *
     * @return ZSI\ZizenBundle\Entity\Pub 
     */
    public function getPub()
    {
        return $this->pub;
    }
}
