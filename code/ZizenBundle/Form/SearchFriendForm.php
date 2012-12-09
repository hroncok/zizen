<?php
namespace ZSI\ZizenBundle\Form;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;


/**
 * searchFriendForm creates a form for searching friends!
 */ 
class searchFriendForm extends AbstractType {
  /**
   * This function actually creates the form. It defines the right look of the form.
   * @param $builder Instance of FormBuilder class, it actually saves all properties needed for the form into the instance of this class.
   * @param $options It is an aditional information for the form, that defines which instance of a data class should be used for the form.  
   */ 
  public function buildForm(FormBuilder $builder, array $options) {
		$builder->add('name','text',array('label'=>'Jméno přítele: ',
										'required' => false,
										'empty_data' => null))
				->add('surname','text',array('label'=>'Příjmení přítele: ',
										'required' => false,
										'empty_data' => null));
  }
 
  /**
   * This function just returns the name of this actual type of form.
   */  
	public function getName() {
		/* identifikator formulare */
		return 'searchFriend';
    }
	/**
	 * This function returns the instance of a data class, which was used for making this form.
	 * @param An aditional information for the function, from which the actual instance is returned.
	 */ 
	public function getDefaultOptions(array $options)
	{
	    return array(
	        //'data_class' => 'ZSI\ZizenBundle\Entity\Filters',
	    );
	} 
	
}
?>
