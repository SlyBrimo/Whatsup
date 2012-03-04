<?php

namespace Whatsup\SUPBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Whatsup\SUPBundle\Entity\Venue
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Whatsup\SUPBundle\Repository\VenueRepository")
 */
class Venue
{
	public function __toString() { return $this->name; }
	
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

	/** @ORM\ManyToOne(targetEntity="Adaptive\UserBundle\Entity\User") */
	private $user;
	
	/** @ORM\OneToMany(targetEntity="Whatsup\SUPBundle\Entity\Event", mappedBy="venue") */
	private $events;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string $address
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string $city
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var string $state
     *
     * @ORM\Column(name="state", type="string", length=255)
     */
    private $state;

    /**
     * @var string $zip
     *
     * @ORM\Column(name="zip", type="string", length=255)
     */
    private $zip;

    /**
     * @var string $phone
     *
     * @ORM\Column(name="phone", type="string", length=255)
     */
    private $phone;

    /**
     * @var string $logo
     *
     * @ORM\Column(name="logo", type="string", length=255)
     */
    private $logo;

    /**
     * @var string $website
     *
     * @ORM\Column(name="website", type="string", length=255)
     */
    private $website;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="string", length=1000)
     */
    private $description;

	/** @ORM\OneToOne(targetEntity="Image", cascade={"persist", "remove"}) */
    private $image;

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
     * Set address
     *
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set city
     *
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set state
     *
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set zip
     *
     * @param string $zip
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    /**
     * Get zip
     *
     * @return string 
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set phone
     *
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set logo
     *
     * @param string $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * Get logo
     *
     * @return string 
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set website
     *
     * @param string $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
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
     * Set user
     *
     * @param Adaptive\UserBundle\Entity\User $user
     */
    public function setUser(\Adaptive\UserBundle\Entity\User $user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return Adaptive\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set image
     *
     * @param Whatsup\SUPBundle\Entity\Image $image
     */
    public function setImage(\Whatsup\SUPBundle\Entity\Image $image)
    {
        $this->image = $image;
    }

    /**
     * Get image
     *
     * @return Whatsup\SUPBundle\Entity\Image 
     */
    public function getImage()
    {
        return $this->image;
    }
    public function __construct()
    {
        $this->events = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add events
     *
     * @param Whatsup\SUPBundle\Entity\Event $events
     */
    public function addEvent(\Whatsup\SUPBundle\Entity\Event $events)
    {
        $this->events[] = $events;
    }

    /**
     * Get events
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getEvents()
    {
        return $this->events;
    }
}