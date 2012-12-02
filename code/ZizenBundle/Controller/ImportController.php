<?php

namespace ZSI\ZizenBundle\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ZSI\ZizenBundle\Entity\User;

/**
 * This class is not essential for the application. The only function of this
 * class is to load some testing data into the database behind the application.
 */
class ImportController extends Controller {  
	/**
	 * This function loads some testing data into the database!
	 */
	public function personImportAction() 
	{
		$em = $this->getDoctrine()->getEntityManager();

		$person = new User();
		$person->setUserId(0);
		$person->setUsername("tosnedav");
		$factory = $this->get('security.encoder_factory');
		$encoder = $factory->getEncoder($person);
		$password = $encoder->encodePassword('topa', $person->getSalt());
		$person->setPassword($password);
		$person->setName("David");
		$person->setSurname("Tošner");
		$person->setEMail("tosnedav@fit.cvut.cz");
		$person->setSex(0);
		$person->setRole("ROLE_USER");
		$em->persist($person);
		$em->flush();

		$person = new User();
		$person->setUserId(1);
		$person->setUsername("troupmar");
		$factory = $this->get('security.encoder_factory');
		$encoder = $factory->getEncoder($person);
		$password = $encoder->encodePassword('trpa', $person->getSalt());
		$person->setPassword($password);
		$person->setName("Martin");
		$person->setSurname("Troup");
		$person->setEMail("troupmar@fit.cvut.cz");
		$person->setSex(0);
		$person->setRole("ROLE_USER");
		$em->persist($person);
		$em->flush();
		
		$person = new User();
		$person->setUserId(3);
		$person->setUsername("kocikdav");
		$factory = $this->get('security.encoder_factory');
		$encoder = $factory->getEncoder($person);
		$password = $encoder->encodePassword('kopa', $person->getSalt());
		$person->setPassword($password);
		$person->setName("David");
		$person->setSurname("Kocík");
		$person->setEMail("kocikdav@fit.cvut.cz");
		$person->setSex(0);
		$person->setRole("ROLE_USER");
		$em->persist($person);
		$em->flush();
		
		$person = new User();
		$person->setUserId(4);
		$person->setUsername("hroncmir");
		$factory = $this->get('security.encoder_factory');
		$encoder = $factory->getEncoder($person);
		$password = $encoder->encodePassword('hrpa', $person->getSalt());
		$person->setPassword($password);
		$person->setName("Miroslav");
		$person->setSurname("Hrončok");
		$person->setEMail("hroncmir@fit.cvut.cz");
		$person->setSex(0);
		$person->setRole("ROLE_USER");
		$em->persist($person);
		$em->flush();
		
		return $this->render('ZSIZizenBundle:FirstPage:logged.html.twig', array('name' => "tonda" ));
	}
}
?>
