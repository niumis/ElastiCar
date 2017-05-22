<?php

namespace AppBundle\Service;

use AppBundle\Entity\Watchlist;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Symfony\Component\Validator\Constraints as Assert;

class SubscriptionMail
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @return object|\Swift_Mailer
     */
    private function getMailer()
    {
        return $this->container->get('mailer');
    }

    /**
     * @param $email
     * @param $ads
     * @return bool
     */
    public function sendMail($email, $ads, $firstMail)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Autoskautas.lt')
            ->setFrom('noreply@autoskautas.lt')
            ->setTo($email)
            ->setBody(
                $this->container->get('templating')->render(
                    '@App/Mail/subscription.html.twig',
                    [
                        'ads' => $ads,
                        'firstMail' => $firstMail,
                    ]
                ),
                'text/html'
            );

        $this->getMailer()->send($message);

        return true;
    }
}
