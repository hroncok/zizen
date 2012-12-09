<?php
namespace ZSI\ZizenBundle\Form;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * AddFavouritePubForm creates a form for adding a new pub!
 */
class SetThirstForm extends AbstractType {
 
  /**
   * This function actually creates the form. It defines the right look of the form.
   * @param $builder Instance of FormBuilder class, it actually saves all properties needed for the form into the instance of this class.
   * @param $options It is an aditional information for the form, that defines which instance of a data class should be used for the form.  
   */
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
  /**
   * This function just returns the name of this actual type of form.
   */ 
  public function getName() {
    /* identifikator formulare */
    return 'setThirst';
  }
 
	/**
	 * This function returns the instance of a data class, which was used for making this form.
	 * @param An aditional information for the function, from which the actual instance is returned.
	 */
	public function getDefaultOptions(array $options)
	{
	    return array(
	        //'data_class' => 'ZSI\ZizenBundle\Entity\Pub',
	    );
	} 
}
?>
