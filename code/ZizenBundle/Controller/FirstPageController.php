<?php

namespace ZSI\ZizenBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use ZSI\ZizenBundle\Form\CreateAccountForm;

use ZSI\ZizenBundle\Entity\User;

/**
 * This class provides the basic interface of the application. It is what 
 * the non-logged user can see!
 */
class FirstPageController extends Controller
{
    /**
     * This function just renders the basic "index" page!
     */
    public function indexAction() 
    {
        return $this->render('ZSIZizenBundle:FirstPage:index.html.twig');
    } 
    
    /**
     * This function just renders the "about the application" page!
     */
    public function aboutAction() 
    {
        return $this->render('ZSIZizenBundle:FirstPage:about.html.twig');
    }
    
    /**
     * This function renders the logged page, which is the actual interface 
     * for the logged user!
     */
    public function loggedAction() {
        return $this->render('ZSIZizenBundle:FirstPage:logged.html.twig');
    }

	/**
	 * This function provides the ability to make a new account. When its 
	 * created the non-logged user is redirected to the "index" page, where 
	 * he can sign it right after the registration!
	 */
    public function registrationAction() {
		$em = $this->getDoctrine()->getEntityManager();
		$form = $this->createForm(new CreateAccountForm());
		$request = $this->getRequest();
		if ($request->getMethod() == 'POST') {
			$form->bindRequest($request);
			if ($form->isValid()) {
				$paramArray = $request->request->all();
				$name = $paramArray['createAccount']['name'];
				$surname = $paramArray['createAccount']['surname'];
				$username = $paramArray['createAccount']['username'];
				$password = $paramArray['createAccount']['password'];
				$email = $paramArray['createAccount']['email'];
				$sex = $paramArray['createAccount']['sex'];
				$birthDate = $paramArray['createAccount']['birthDate'];
			
				$users = $em->getRepository('ZSIZizenBundle:User')->findAll();
					$maxId = 0;
					foreach ($users as $item) {
						if ($item->getUserId() > $maxId) {
							$maxId = $item->getUserId();
						}
					}
					$userExists = $em->getRepository('ZSIZizenBundle:User')->findOneBy(array('username' => $username));
					if(isset($userExists))
						return $this->redirect($this->generateUrl('ZSIZizenBundle_mainPageIndex'));
					$user = new User();
					$user->setUserId($maxId + 1);
					$user->setName($name);
					$user->setSurname($surname);
					$user->setUsername($username);
					$factory = $this->get('security.encoder_factory');
					$encoder = $factory->getEncoder($user);
					$passwd = $encoder->encodePassword($password, $user->getSalt());
					$user->setPassword($passwd);
					$user->setEmail($email);
					$user->setSex($sex);
					$dateString = $birthDate['year'] . "-" . $birthDate['month'] . "-" . $birthDate['day'] ;
					$user->setBirthDate(new \DateTime($dateString));
					$user->setRole("ROLE_USER");
					$em->persist($user);
					$em->flush();
				return $this->redirect($this->generateUrl('ZSIZizenBundle_mainPageIndex'));
			}
		}
		return $this->render('ZSIZizenBundle:Form:createAccountForm.html.twig', array('form' => $form->createView()));
    }
}
