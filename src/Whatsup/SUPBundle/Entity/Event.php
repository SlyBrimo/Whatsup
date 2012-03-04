<?php

namespace Whatsup\SUPBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Whatsup\SUPBundle\Entity\Event
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Event
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

	/** @ORM\ManyToOne(targetEntity="Whatsup\SUPBundle\Entity\Venue") */
	private $venue;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var datetime $startdate
     *
     * @ORM\Column(name="startdate", type="datetime")
     */
    private $startdate;

    /**
     * @var datetime $enddate
     *
     * @ORM\Column(name="enddate", type="datetime")
     */
    private $enddate;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="string", length=1000)
     */
    private $description;

	/** @ORM\OneToOne(targetEntity="Image", cascade={"persist", "remove"}) */
    private $flyer;

	/**
	 * @ORM\Column(name="is_featured", type="boolean", nullable=true)
	*/
	private $is_featured;
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
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
     * Set startdate
     *
     * @param datetime $startdate
     */
    public function setStartdate($startdate)
    {
        $this->startdate = $startdate;
    }

    /**
     * Get startdate
     *
     * @return datetime 
     */
    public function getStartdate()
    {
        return $this->startdate;
    }

    /**
     * Set enddate
     *
     * @param datetime $enddate
     */
    public function setEnddate($enddate)
    {
        $this->enddate = $enddate;
    }

    /**
     * Get enddate
     *
     * @return datetime 
     */
    public function getEnddate()
    {
        return $this->enddate;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set venue
     *
     * @param Whatsup\SUPBundle\Entity\Venue $venue
     */
    public function setVenue(\Whatsup\SUPBundle\Entity\Venue $venue)
    {
        $this->venue = $venue;
    }

    /**
     * Get venue
     *
     * @return Adaptive\UserBundle\Entity\Venue 
     */
    public function getVenue()
    {
        return $this->venue;
    }

    public function setIsFeatured($is_featured)
    {
        $this->is_featured = $is_featured;
    }

	public function getIsFeatured()
    {
        return $this->is_featured;
    }

	public function __toString(){
		return $this->name;
	}

    /**
     * Set flyer
     *
     * @param Whatsup\SUPBundle\Entity\Image $flyer
     */
    public function setFlyer(\Whatsup\SUPBundle\Entity\Image $flyer)
    {
        $this->flyer = $flyer;
    }

    /**
     * Get flyer
     *
     * @return Whatsup\SUPBundle\Entity\Image 
     */
    public function getFlyer()
    {
        return $this->flyer;
    }
}