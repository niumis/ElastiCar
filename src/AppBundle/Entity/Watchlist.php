<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\ManyToOne(targetEntity="Brand", inversedBy="watchlists")
     * @ORM\JoinColumn(name="brand_id", referencedColumnName="id")
     */
    private $brand;


    /**
     * @var int
     *
     * @ORM\Column(name="model_id", type="integer")
     */
    private $modelId;


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
     * Set userId
     *
     * @param integer $userId
     *
     * @return Watchlist
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return mixed
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param mixed $brand
     * @return Watchlist
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
        return $this;
    }


    /**
     * Set modelId
     *
     * @param integer $modelId
     *
     * @return Watchlist
     */
    public function setModelId($modelId)
    {
        $this->modelId = $modelId;

        return $this;
    }

    /**
     * Get modelId
     *
     * @return int
     */
    public function getModelId()
    {
        return $this->modelId;
    }
}
