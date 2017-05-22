<?php
/**
 * Created by PhpStorm.
 * User: niumis
 * Date: 2017-05-22
 * Time: 21:04
 */

namespace AppBundle\Controller\Security;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="security_login")
     */
    public function loginAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('@App/Security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }
}