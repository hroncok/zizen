<?php

namespace ZSI\ZizenBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

/**
 * This class provides the "logging system". Thanks to this class, user is
 * able to log into the application!
 */
class SecurityController extends Controller {
  
  /**
   * This function provides the ability to log on!
   */
  public function loginAction() {
    $request = $this->getRequest();
    $session = $request->getSession();
    
    // načtení případné chyby z minulého přihlášení
    if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
        $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
    } else {
        $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
    }
 
    // šablona s formulářem
    return $this->render('ZSIZizenBundle:Security:login.html.twig', array(
    // tímto způsobem získáme naposledy zadané uživatelské jméno
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
    // do šablony předáme i případnou zjištěnou chybu
            'error' => $error,
        ));
  }      
}
