<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Brand
 *
 * @ORM\Table(name="brand")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BrandRepository")
 */
class Brand
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
     * @ORM\OneToMany(targetEntity="Watchlist", mappedBy="brand")
     */
    private $watchlists;


    public function __construct()
    {
        $this->watchlists = new ArrayCollection();
    }


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
     * @return Brand
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
     * Add watchlist
     *
     * @param \AppBundle\Entity\Watchlist $watchlist
     *
     * @return Brand
     */
    public function addWatchlist(Watchlist $watchlist)
    {
        $this->watchlists[] = $watchlist;

        return $this;
    }

    /**
     * Remove watchlist
     *
     * @param \AppBundle\Entity\Watchlist $watchlist
     */
    public function removeWatchlist(Watchlist $watchlist)
    {
        $this->watchlists->removeElement($watchlist);
    }

    /**
     * Get watchlists
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWatchlists()
    {
        return $this->watchlists;
    }
}
