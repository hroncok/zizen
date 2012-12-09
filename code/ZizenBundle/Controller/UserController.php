<?php

namespace ZSI\ZizenBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use ZSI\ZizenBundle\Form\EditRecordForm;
use ZSI\ZizenBundle\Form\AddFavouritePubForm;
use ZSI\ZizenBundle\Form\AddLocationForm;
use ZSI\ZizenBundle\Form\SelectDefaultLocForm;
use ZSI\ZizenBundle\Form\EditFiltersForm;
use ZSI\ZizenBundle\Form\SetThirstForm;
use ZSI\ZizenBundle\Form\SearchFriendForm;

use ZSI\ZizenBundle\Entity\User;
use ZSI\ZizenBundle\Entity\Pub;
use ZSI\ZizenBundle\Entity\Location;
use ZSI\ZizenBundle\Entity\Filters;
use ZSI\ZizenBundle\Entity\Thirst;

/**
 * UserController class manages all functions, that the logged user can use!
 * It it the most important class for this application.
 * All return values of all methods implemented in this class are .html pages.
 * So in the controllers all logic is done and return values render files for
 * presentative layer.
 */
class UserController extends Controller
{
    
    /**
     * This function provides a menu for the logged user!
     * So it just really provides all the functions logged user have.
     */
    public function personalSettingsAction() 
    {
        return $this->render('ZSIZizenBundle:User:personalSettings.html.twig');
    } 
    
    /**
     * This function shows personal info of the logged user!
     * His info includes name, surname, username, mail, sex, and other...
     */
    public function showRecordAction()
    {
		$user = $this->get('security.context')->getToken()->getUser();
		if ($user->getSex() == 0)
			$sex = "muž";
		else if($user->getSex() == 1)
			$sex = "žena";
		return $this->render('ZSIZizenBundle:User:showRecord.html.twig', array('user' => $user, 'sex' => $sex));
	}
	
    /**
     * This function provides the ability to edit personal info!
     * So the user is really able to edit his name, surname, and so on...
     */	
	public function editRecordAction()
	{
		$user = $this->get('security.context')->getToken()->getUser();
		$form = $this->createForm(new EditRecordForm(), $user);
	 
		$request = $this->getRequest();
		if ($request->getMethod() == 'POST') {
		  $form->bindRequest($request);

		  if($form->isValid()) {
				$em = $this->getDoctrine()->getEntityManager();
				$em->flush();
				return $this->redirect($this->generateUrl('ZSIZizenBundle_showRecord'));
		  }
		}
		return $this->render('ZSIZizenBundle:Form:editRecordForm.html.twig',array('form' => $form->createView()));
	}

    /**
     * This function shows the list of favourite pubs of the logged user!
     */
	public function showFavouritePubsAction()
	{
		$user = $this->get('security.context')->getToken()->getUser();
		$pubs = $user->getFavouritePubs();
		return $this->render('ZSIZizenBundle:User:showFavouritePubs.html.twig', array('pubs' => $pubs));
	}

    /**
     * This function provides the ability to add a new favourite pub for a current user!
     */	
	public function addFavouritePubAction() 
	{
		$user = $this->get('security.context')->getToken()->getUser();
		$em = $this->getDoctrine()->getEntityManager();
		$pub = new Pub();
		$form = $this->createForm(new AddFavouritePubForm(), $pub);
		$request = $this->getRequest();
		if ($request->getMethod() == 'POST') {
		  $form->bindRequest($request);

		  if($form->isValid()) {
				$em = $this->getDoctrine()->getEntityManager();
				$pubExists = $em->getRepository('ZSIZizenBundle:Pub')->findOneBy(array('pub_name' => $pub->getPubName(), 'pub_location' => $pub->getPubLocation()));
				//return new Response(var_dump($pubExists));
				if(isset($pubExists))
				{
					$user->addPub($pubExists);
					$em->flush();
				}
				else
				{
					$pubs = $em->getRepository('ZSIZizenBundle:Pub')->findAll();
					$maxId = 0;
					foreach ($pubs as $item) {
						if ($item->getPubId() > $maxId) {
							$maxId = $item->getPubId();
						}
					}
					$pub->setPubId($maxId + 1);
					$em->persist($pub);
					$em->flush();
					$user->addPub($pub);
					$em->flush();
				}
				return $this->redirect($this->generateUrl('ZSIZizenBundle_showFavouritePubs'));
		  }
		}
		return $this->render('ZSIZizenBundle:Form:addFavouritePubForm.html.twig',array('form' => $form->createView()));
	}

    /**
     * This function provides the ability to add a new location of the current user!
     */	
	public function addLocationAction()
	{
		$user = $this->get('security.context')->getToken()->getUser();
		$em = $this->getDoctrine()->getEntityManager();
		$form = $this->createForm(new AddLocationForm());
		$request = $this->getRequest();
		if ($request->getMethod() == 'POST') {
		  $form->bindRequest($request);
		  if($form->isValid()) {
			  $paramArray = $request->request->all();
			  $locName = $paramArray['addLocation']['location_name'];
			  $locLoc = $paramArray['addLocation']['location_location'];
			  $locationExists = $em->getRepository('ZSIZizenBundle:Location')->findOneBy(array('location_name' => $locName, 'location_location' => $locLoc));  
			  
			  if(isset($locationExists))
			  {
				  $usersLocs = $user->getLocations();
				  $match = 0;
				  foreach($usersLocs as $item)
				  {
					  if($item->getLocationId() == $locationExists->getLocationId())
						$match++;
				  }
				  if($match == 0)
				  {
					  $user->addLocation($locationExists);
					  $em->persist($user);
					  $em->flush();
				  }
			  }
			  else
			  {
				  $location = new Location();
				  $locs = $em->getRepository('ZSIZizenBundle:Location')->findAll();
				  $maxId = 0;
				  foreach ($locs as $item) {
					if ($item->getLocationId() > $maxId) {
						$maxId = $item->getLocationId();
					}
		    	  }
		    	  $location->setLocationId($maxId + 1);
		    	  $location->setLocationName($locName);
		    	  $location->setLocationLocation($locLoc);
		    	  $em->persist($location);
		    	  $em->flush();
		    	  $user->addLocation($location);
		    	  $em->persist($location);
		    	  $em->flush();				  
			  }
			  return $this->redirect($this->generateUrl('ZSIZizenBundle_showLocations'));
		  }
		}	
		return $this->render('ZSIZizenBundle:Form:addLocationForm.html.twig',array('form' => $form->createView()));	
	}

    /**
     * This function shows a list of locations of the logged user!
     */	
	public function showLocationsAction()
	{
		$user = $this->get('security.context')->getToken()->getUser();
		$em = $this->getDoctrine()->getEntityManager();
		$locs = $user->getLocations();
		return $this->render('ZSIZizenBundle:User:showLocations.html.twig',array('default' => $user->getDefaultLocation(), 'locs' => $locs));
	}

    /**
     * This function provides the ability to select the default location for the current user!
     */	
	public function selectDefaultLocAction()
	{
		$user = $this->get('security.context')->getToken()->getUser();
		$em = $this->getDoctrine()->getEntityManager();
		
		$form = $this->createForm(new SelectDefaultLocForm(), $user);
		$request = $this->getRequest();
		if ($request->getMethod() == 'POST') {
			  $paramArray = $request->request->all();
			  $locId = $paramArray['selectDefaultLoc']['defaultLocation'];
			  $loc = $em->getRepository('ZSIZizenBundle:Location')->findOneBy(array('location_id' => $locId));
			  $default = $user->getDefaultLocation();
			  if(isset($default))
				$user->unsetDeaultLocation();
			  $user->setDefaultLocation($loc);
			  $em->persist($loc);
			  $em->flush();
			  return $this->redirect($this->generateUrl('ZSIZizenBundle_showLocations'));
		}
		return $this->render('ZSIZizenBundle:Form:selectDefaultLocForm.html.twig',array('form' => $form->createView()));			
	}

    /**
     * This function provides the ability to edit user's filters, which are important for searching thirsts!
     */	
	public function editFiltersAction()
	{
		$user = $this->get('security.context')->getToken()->getUser();
		$filtersExist = $user->getFilters();
		if(isset($filtersExist))
			$filters = $filtersExist;
		else
			$filters = new Filters();
		$em = $this->getDoctrine()->getEntityManager();
		$form = $this->createForm(new EditFiltersForm(), $filters);
		$request = $this->getRequest();
		if ($request->getMethod() == 'POST') {
		  $form->bindRequest($request);
		  if($form->isValid()) {
			  $paramArray = $request->request->all();
			  $sex = $paramArray['editFilters']['filter_sex'];
			  
			  $fils = $em->getRepository('ZSIZizenBundle:Filters')->findAll();
			  $maxId = 0;
			  foreach ($fils as $item) {
				  if ($item->getFiltersId() > $maxId) {
					 $maxId = $item->getFiltersId();
				  }
		      }
		      if(isset($filtersExist))
			  {
				  if(strlen($sex) == 0)
					$filters->setFilterSex(null);
				  $em->flush();
			  }
			  else
			  {
				  if(strlen($sex) == 0)
					$filters->setFilterSex(null);
				  $filters->setFiltersId($maxId + 1);
				  $em->persist($filters);
				  $em->flush();
				  $user->setFilters($filters);
				  $em->persist($filters);
				  $em->flush();
			  }
			  return $this->redirect($this->generateUrl('ZSIZizenBundle_showFilters'));
		  }
		  
	    }
	    return $this->render('ZSIZizenBundle:Form:editFiltersForm.html.twig',array('form' => $form->createView()));			
	}

    /**
     * This function shows user's set filters!
     */	
	public function showFiltersAction()
	{
		$user = $this->get('security.context')->getToken()->getUser();
		$filters = $user->getFilters();
		$fR = 0;
		$oR = 0;
		$aMax = 0;
		$aMin = 0;
		$sex = 0;
		if(isset($filters))
		{
			$isSet = true;
			$fR = $filters->getFriendRadius();
			$oR = $filters->getOtherRadius();
			$aMax = $filters->getAgeMax();
			$aMin = $filters->getAgeMin();
			$setSex = $filters->getFilterSex();
			if(isset($setSex))
			{
				if($setSex == 0)
					$sex = "muž";
				else if($setSex == 1)
					$sex = "žena";
			}
			else
			{
					$sex = "neuvedeno";
			}
		}
		else 
		{
			$isSet = false;
		}
		return $this->render('ZSIZizenBundle:User:showFilters.html.twig',array('isSet' => $isSet, 'fR' => $fR, 'oR' => $oR, 'aMax' => $aMax, 'aMin' => $aMin, 'sex' => $sex));			
	}

    /**
     * This function provides the ability to set user's thirst!
     */	
	public function setThirstAction()
	{
		$user = $this->get('security.context')->getToken()->getUser();
		$thirstExists = $user->getThirst();
		if(isset($thirstExists))
			$thirst = $thirstExists;
		else
			$thirst = new Thirst();
		$em = $this->getDoctrine()->getEntityManager();
		$form = $this->createForm(new SetThirstForm());
		$request = $this->getRequest();
		if ($request->getMethod() == 'POST') {
		  $form->bindRequest($request);
		  if($form->isValid()) {
			  $paramArray = $request->request->all();
			  $locId = $paramArray['setThirst']['setLocation'];			 
			  $pubId = $paramArray['setThirst']['setPub'];	
			  $note = $paramArray['setThirst']['note'];	
			  $status = $paramArray['setThirst']['setStatus'];

			  if(!isset($thirstExists))
			  {
					$ths = $em->getRepository('ZSIZizenBundle:Thirst')->findAll();
				  	$maxId = 0;
					foreach ($ths as $item) {
						if ($item->getThirstId() > $maxId) {
							$maxId = $item->getThirstId();
						}
					}
					$thirst->setThirstId($maxId + 1);
					$em->persist($thirst);
					$em->flush();
			  }
			  if(strlen($pubId) != 0)
			  {
				 $pub = $em->getRepository('ZSIZizenBundle:Pub')->findOneBy(array('pub_id' => $pubId)); 
				 $thirst->setPub($pub);
				 $em->persist($thirst);
				 $em->flush();
			  }
			  if(strlen($locId) != 0)
			  {
				 $loc = $em->getRepository('ZSIZizenBundle:Location')->findOneBy(array('location_id' => $locId)); 
				 $thirst->setLocation($loc);
				 $em->persist($thirst);
				 $em->flush();				  
			  }
			  if(strlen($note) != 0)
			  {
				  $thirst->setNote($note);
				  $em->persist($thirst);
				  $em->flush();
			  }
			  else 
			  {
				  $note = null;
				  $thirst->setNote($note);
				  $em->persist($thirst);
				  $em->flush();
			  }
			  
			  $thirst->setStatus($status);
			  $em->persist($thirst);
			  $em->flush();
			  
			  
			  $user->setThirst($thirst);
			  $em->persist($user);
			  $em->flush();
			  return $this->redirect($this->generateUrl('ZSIZizenBundle_showThirst'));	  
		  }
	    }
	    return $this->render('ZSIZizenBundle:Form:setThirstForm.html.twig',array('form' => $form->createView()));	 
	}

    /**
     * This function shows user's set thirst!
     * So it shows the position, pub and the current status of the thirst.
     */	
	public function showThirstAction()
	{
		$user = $this->get('security.context')->getToken()->getUser();
		$thirst = $user->getThirst();
		$isSet = true;
		if(isset($thirst))
		{
			if($thirst->getStatus() == 0)
				$status = "neaktivní";
			else if($thirst->getStatus() == 1)
				$status = "aktivní";
			else if($thirst->getStatus() == 2)
				$status = "v hospodě";
			else 
				$isSet = false;
		}
		else 
		{
			$status = 0;
		}
		return $this->render('ZSIZizenBundle:User:showThirst.html.twig',array('thirst' => $thirst, 'status' => $status, 'isSet' => $isSet));	
	}
	
    /**
     * This function provides the ability to search friends!
     * Now searching works just for searching names, surnames or both.
     */
	public function searchFriendAction()
	{
		$user = $this->get('security.context')->getToken()->getUser();
		$em = $this->getDoctrine()->getEntityManager();
		$form = $this->createForm(new SearchFriendForm());
		$request = $this->getRequest();
		if ($request->getMethod() == 'POST') {
		  $form->bindRequest($request);
		  if($form->isValid()) {		
			  $paramArray = $request->request->all();
			  $name = $paramArray['searchFriend']['name'];			 
			  $surname = $paramArray['searchFriend']['surname'];	

			  if(strlen($name) == 0 && strlen($surname) == 0)
			  {
				  $friends = null;
			  } 
			  else if(strlen($name != 0))
			  {
				  $friends = $em->getRepository('ZSIZizenBundle:User')->findBy(array('name' => $name));
			  }
			  else if(strlen($surname != 0))
			  {
				  $friends = $em->getRepository('ZSIZizenBundle:User')->findBy(array('surname' => $surname));
			  }
			  else
			  {
				  $friends = $em->getRepository('ZSIZizenBundle:User')->findBy(array('name' => $name, 'surname' => $surname));
			  }
			  return $this->render('ZSIZizenBundle:User:searchFriend.html.twig',array('friends' => $friends, 'id' => $user->getUserId()));
		  }
		}	
	    return $this->render('ZSIZizenBundle:Form:searchFriendForm.html.twig',array('form' => $form->createView()));
	}

    /**
     * This function provides the ability to see other users personal info!
     * @param userId The id of the user, whose personal info the logged user wants to look at.
     */	
	public function showProfileAction($userId)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$friend = $em->getRepository('ZSIZizenBundle:User')->findOneBy(array('user_id' => $userId));
		return $this->render('ZSIZizenBundle:User:showProfile.html.twig',array('friend' => $friend));
	}

    /**
     * This function provides the ability to add a new friend!
     * @param userId The id of the user, who the logged user wants to be friends with.
     */	
	public function addFriendAction($userId)
	{
		$user = $this->get('security.context')->getToken()->getUser();
		$em = $this->getDoctrine()->getEntityManager();
		$friend = $em->getRepository('ZSIZizenBundle:User')->findOneBy(array('user_id' => $userId));
		
		$users = $user->getFriends();
		$match = 0;
		foreach($users as $us)
		{
			if($us->getUserId() == $friend->getUserId())
				$match++;
		}
		if($match == 0)
		{
			$user->addUser($friend);
			$em->persist($user);
			$em->flush();
		}
		return $this->redirect($this->generateUrl('ZSIZizenBundle_showFriends'));
	}
	
    /**
     * This function shows a list of just logged user's friends!
     */	
	public function showFriendsAction()
	{
		$user = $this->get('security.context')->getToken()->getUser();
		$em = $this->getDoctrine()->getEntityManager();
		$friends = $user->getFriends();
		return $this->render('ZSIZizenBundle:User:showFriends.html.twig',array('friends' => $friends));
	}

    /**
     * This function provides the ability to delete a friend out of a list of user's friends!
     * @param userId The id of the user, who the logged user wants to delete from my list of friends.
     */	
	public function deleteFriendAction($userId)
	{
		$user = $this->get('security.context')->getToken()->getUser();
		$em = $this->getDoctrine()->getEntityManager();
		$friend = $em->getRepository('ZSIZizenBundle:User')->findOneBy(array('user_id' => $userId));
		$user->deleteUser($friend);
		$em->persist($user);
		$em->flush();
		$friends = $user->getFriends();
		return $this->render('ZSIZizenBundle:User:showFriends.html.twig',array('friends' => $friends));
	}
	

}
