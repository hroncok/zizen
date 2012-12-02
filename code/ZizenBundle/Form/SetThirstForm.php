<?php
namespace ZSI\ZizenBundle\Form;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * AddFavouritePubForm creates a form for adding a new pub!
 */
class SetThirstForm extends AbstractType {
 
  public function buildForm(FormBuilder $builder, array $options) {
		$builder->add('setLocation','entity',array('label'=>'Lokace: ',
											'class'=>'ZSIZizenBundle:Location', 
											'property'=>'location_name'))
				->add('setPub','entity',array('label'=>'Hospoda: ',
											'class'=>'ZSIZizenBundle:Pub', 
											'property'=>'pub_name'))
				->add('setStatus', 'choice', array( 'label' => 'Status: ',
											'choices'   => array('0' => 'Neaktivní', '1' => 'Aktivní', '2' => 'V hospodě')))
				->add('note', 'text', array('label' => 'Poznámka: ',
											'required' => false));
  }
 
  public function getName() {
    /* identifikator formulare */
    return 'setThirst';
  }
 
	public function getDefaultOptions(array $options)
	{
	    return array(
	        //'data_class' => 'ZSI\ZizenBundle\Entity\Pub',
	    );
	} 
}
?>
