<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Watchlist
 *
 * @ORM\Table(name="watchlist")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\WatchlistRepository")
 */
class Watchlist
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
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var int
     *
     * @ORM\Column(name="brand_id", type="integer")
     */
    private $brandId;

    /**
     * @var int
     *
     * @ORM\Column(name="model_id", type="integer")
     */
    private $modelId;

    /**
     * @var int
     *
     * @ORM\Column(name="year_from", type="integer")
     */
    private $yearFrom;

    /**
     * @var int
     *
     * @ORM\Column(name="year_to", type="integer")
     */
    private $yearTo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="mail_sent", type="boolean")
     */
    private $mailSent;

    /**
     * @var boolean
     *
     * @ORM\Column(name="unsubscribed", type="boolean")
     */
    private $unsubscribed;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     * @Assert\DateTime()
     */
    private $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Assert\DateTime()
     */
    private $createdAt;


    public function __construct()
    {
        $this->mailSent = false;
        $this->unsubscribed = false;
        $this->updatedAt = new \DateTime();
        $this->createdAt = new \DateTime();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Watchlist
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     *
     * @return Watchlist
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return int
     */
    public function getBrandId()
    {
        return $this->brandId;
    }

    /**
     * @param int $brandId
     * @return Watchlist
     */
    public function setBrandId($brandId)
    {
        $this->brandId = $brandId;

        return $this;
    }

    /**
     * @return int
     */
    public function getModelId()
    {
        return $this->modelId;
    }

    /**
     * @param int $modelId
     * @return Watchlist
     */
    public function setModelId($modelId)
    {
        $this->modelId = $modelId;

        return $this;
    }

    /**
     * @return int
     */
    public function getYearFrom(): int
    {
        return $this->yearFrom;
    }

    /**
     * @param int $yearFrom
     * @return Watchlist
     */
    public function setYearFrom(int $yearFrom): Watchlist
    {
        $this->yearFrom = $yearFrom;

        return $this;
    }

    /**
     * @return int
     */
    public function getYearTo(): int
    {
        return $this->yearTo;
    }

    /**
     * @param int $yearTo
     * @return Watchlist
     */
    public function setYearTo(int $yearTo): Watchlist
    {
        $this->yearTo = $yearTo;

        return $this;
    }


    /**
     * @return boolean
     */
    public function getMailSent()
    {
        return $this->mailSent;
    }

    /**
     * @param boolean $mailSent
     * @return Watchlist
     */
    public function setMailSent($mailSent)
    {
        $this->mailSent = $mailSent;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUnsubscribed()
    {
        return $this->unsubscribed;
    }

    /**
     * @param mixed $unsubscribed
     * @return Watchlist
     */
    public function setUnsubscribed($unsubscribed)
    {
        $this->unsubscribed = $unsubscribed;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return Watchlist
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return Watchlist
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
