<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Car
 *
 * @ORM\Table(name="car")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CarRepository")
 */
class Car
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="picture_url", type="string", length=2083, nullable=true)
     */
    private $pictureUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=6, scale=2)
     */
    private $price;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="year", type="date")
     */
    private $year;

    /**
     * @ORM\Column(name="gearbox", type="boolean", nullable=true)
     */
    private $gearbox;

    /**
     * @var string
     *
     * @ORM\Column(name="power", type="string", length=255, nullable=true)
     */
    private $power;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="Fuel", inversedBy="cars")
     * @ORM\JoinColumn(name="fuel_id", referencedColumnName="id")
     */
    private $fuel;

    /**
     * @ORM\ManyToOne(targetEntity="City", inversedBy="cars")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     */
    private $city;

    /**
     * @ORM\ManyToOne(targetEntity="Body", inversedBy="cars")
     * @ORM\JoinColumn(name="body_id", referencedColumnName="id")
     */
    private $body;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Car
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set pictureUrl
     *
     * @param string $pictureUrl
     *
     * @return Car
     */
    public function setPictureUrl($pictureUrl)
    {
        $this->pictureUrl = $pictureUrl;

        return $this;
    }

    /**
     * Get pictureUrl
     *
     * @return string
     */
    public function getPictureUrl()
    {
        return $this->pictureUrl;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Car
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set gearbox
     *
     * @param $gearbox
     *
     * @return Car
     */
    public function setGearbox($gearbox = null)
    {
        $this->gearbox = $gearbox;

        return $this;
    }

    /**
     * Get gearbox
     *
     * @return int
     */
    public function getGearbox()
    {
        return $this->gearbox;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Car
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Car
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set fuel
     *
     * @param Fuel $fuel
     *
     * @return Car
     */
    public function setFuel(Fuel $fuel = null)
    {
        $this->fuel = $fuel;

        return $this;
    }

    /**
     * Get fuel
     *
     * @return Fuel
     */
    public function getFuel()
    {
        return $this->fuel;
    }

    /**
     * Set year
     *
     * @param \DateTime $year
     *
     * @return Car
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return \DateTime
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set city
     *
     * @param \AppBundle\Entity\City $city
     *
     * @return Car
     */
    public function setCity(\AppBundle\Entity\City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \AppBundle\Entity\City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set power
     *
     * @param string $power
     *
     * @return Car
     */
    public function setPower($power)
    {
        $this->power = $power;

        return $this;
    }

    /**
     * Get power
     *
     * @return string
     */
    public function getPower()
    {
        return $this->power;
    }

    /**
     * Set body
     *
     * @param \AppBundle\Entity\Body $body
     *
     * @return Car
     */
    public function setBody(\AppBundle\Entity\Body $body = null)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return \AppBundle\Entity\Body
     */
    public function getBody()
    {
        return $this->body;
    }
}
