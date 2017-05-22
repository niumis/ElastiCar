<?php
/**
 * Created by PhpStorm.
 * User: darker
 * Date: 17.5.8
 * Time: 16.34
 */

namespace AppBundle\Service;

use AppBundle\Entity\Watchlist;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Symfony\Component\Validator\Constraints as Assert;

class Subscription
{

    /**
     * @var Container
     */
    private $container;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Email(
     *     message="Įvestas el. pašto adresas '{{ value }}' yra negaliojantis.",
     *     checkMX=true,
     *     checkHost=true
     * )
     */
    private $email;

    /**
     * @var int
     *
     * @Assert\NotBlank()
     * @Assert\Type(
     *     type="integer"
     * )
     */
    private $brandId;

    /**
     * @var int
     *
     * @Assert\NotBlank()
     * @Assert\Type(
     *     type="integer"
     * )
     */
    private $modelId;

    /**
     * @var int
     *
     * @Assert\NotBlank()
     * @Assert\Type(
     *     type="integer"
     * )
     */
    private $yearFrom;

    /**
     * @var int
     *
     * @Assert\NotBlank()
     * @Assert\Type(
     *     type="integer"
     * )
     */
    private $yearTo;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->entityManager = $this->getContainer()->get('doctrine')->getManager();
    }

    /**
     * @return bool
     */
    public function validate()
    {

        $validator = $this->getContainer()->get('validator');
        $errors = $validator->validate($this);

        if (count($errors) > 0) {
            return false;
        }

        $model = $this->getEntityManager()
            ->getRepository('AppBundle:Model')
            ->findOneBy([
                'brandId' => $this->getBrandId(),
                'modelId' => $this->getModelId()
            ]);

        if (!$model) {
            return false;
        }

        return true;
    }

    /**
     * @return $this|null
     */
    public function subscribe()
    {
        $watchlist = new Watchlist();
        $watchlist->setEmail($this->getEmail());
        $watchlist->setBrandId($this->getBrandId());
        $watchlist->setModelId($this->getModelId());
        $watchlist->setYearFrom($this->getYearFrom());
        $watchlist->setYearTo($this->getYearTo());

        $this->getEntityManager()->persist($watchlist);
        $this->getEntityManager()->flush();
        $this->getEntityManager()->clear();

        return $this;
    }

    /**
     * @return Container
     */
    private function getContainer()
    {
        return $this->container;
    }

    /**
     * @return EntityManager
     */
    private function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Subscription
     */
    public function setEmail($email)
    {
        $this->email = $email;
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
     * @return Subscription
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
     * @return Subscription
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
     * @return Subscription
     */
    public function setYearFrom(int $yearFrom): Subscription
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
     * @return Subscription
     */
    public function setYearTo(int $yearTo): Subscription
    {
        $this->yearTo = $yearTo;
        return $this;
    }


}
