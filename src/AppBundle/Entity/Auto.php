<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Auto
 *
 * @ORM\Table(name="auto", options={"collate"="utf8mb4_general_ci"})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AutoRepository")
 */
class Auto
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
     * @ORM\Column(name="web_url", type="string", length=190, unique=true)
     */
    private $webUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="image_url", type="string", length=190)
     */
    private $imageUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=190)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="year", type="datetime")
     */
    private $year;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=64)
     */
    private $city;

    /**
     * @var int
     *
     * @ORM\Column(name="mileage", type="integer")
     */
    private $mileage;

    /**
     * @var string
     *
     * @ORM\Column(name="gearbox", type="string", length=64)
     */
    private $gearbox;

    /**
     * @var string
     *
     * @ORM\Column(name="fuel", type="string", length=64)
     */
    private $fuel;

    /**
     * @var int
     *
     * @ORM\Column(name="power", type="integer")
     */
    private $power;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ad_created_at", type="datetime")
     */
    private $adCreatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var int
     *
     * @ORM\Column(name="watchlist_id", type="integer")
     */
    private $watchlistId;


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
     * Set webUrl
     *
     * @param string $webUrl
     *
     * @return Auto
     */
    public function setWebUrl($webUrl)
    {
        $this->webUrl = $webUrl;

        return $this;
    }

    /**
     * Get webUrl
     *
     * @return string
     */
    public function getWebUrl()
    {
        return $this->webUrl;
    }

    /**
     * Set imageUrl
     *
     * @param string $imageUrl
     *
     * @return Auto
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * Get imageUrl
     *
     * @return string
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Auto
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
     * Set year
     *
     * @param \DateTime $year
     *
     * @return Auto
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
     * @param string $city
     *
     * @return Auto
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
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
     * Set mileage
     *
     * @param integer $mileage
     *
     * @return Auto
     */
    public function setMileage($mileage)
    {
        $this->mileage = $mileage;

        return $this;
    }

    /**
     * Get mileage
     *
     * @return int
     */
    public function getMileage()
    {
        return $this->mileage;
    }

    /**
     * Set gearbox
     *
     * @param string $gearbox
     *
     * @return Auto
     */
    public function setGearbox($gearbox)
    {
        $this->gearbox = $gearbox;

        return $this;
    }

    /**
     * Get gearbox
     *
     * @return string
     */
    public function getGearbox()
    {
        return $this->gearbox;
    }

    /**
     * Set fuel
     *
     * @param string $fuel
     *
     * @return Auto
     */
    public function setFuel($fuel)
    {
        $this->fuel = $fuel;

        return $this;
    }

    /**
     * Get fuel
     *
     * @return string
     */
    public function getFuel()
    {
        return $this->fuel;
    }

    /**
     * Set power
     *
     * @param integer $power
     *
     * @return Auto
     */
    public function setPower($power)
    {
        $this->power = $power;

        return $this;
    }

    /**
     * Get power
     *
     * @return int
     */
    public function getPower()
    {
        return $this->power;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Auto
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
     * Set adCreatedAt
     *
     * @param \DateTime $adCreatedAt
     *
     * @return Auto
     */
    public function setAdCreatedAt($adCreatedAt)
    {
        $this->adCreatedAt = $adCreatedAt;

        return $this;
    }

    /**
     * Get adCreatedAt
     *
     * @return \DateTime
     */
    public function getAdCreatedAt()
    {
        return $this->adCreatedAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Auto
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Auto
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
     * Set watchlistId
     *
     * @param integer $watchlistId
     *
     * @return Auto
     */
    public function setWatchlistId($watchlistId)
    {
        $this->watchlistId = $watchlistId;

        return $this;
    }

    /**
     * Get watchlistId
     *
     * @return int
     */
    public function getWatchlistId()
    {
        return $this->watchlistId;
    }
}
