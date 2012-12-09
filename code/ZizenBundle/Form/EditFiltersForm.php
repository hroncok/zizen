<?php
namespace ZSI\ZizenBundle\Form;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;


/**
 * editFiltersForm creates a form for editing user's filters!
 */
class editFiltersForm extends AbstractType {
  /**
   * This function actually creates the form. It defines the right look of the form.
   * @param $builder Instance of FormBuilder class, it actually saves all properties needed for the form into the instance of this class.
   * @param $options It is an aditional information for the form, that defines which instance of a data class should be used for the form.  
   */ 
  public function buildForm(FormBuilder $builder, array $options) {
		$builder->add('friend_radius','text',array('label'=>'Radius pro přátele: ',
										'required' => false))
				->add('other_radius','text',array('label'=>'Radius pro ostatní: ',
										'required' => false,
										'empty_data' => null))
				->add('age_max','text',array('label'=>'Maximální věk: ',
										'required' => false,
										'empty_data' => null))
				->add('age_min','text',array('label'=>'Minimální věk: ',
										'required' => false,
										'empty_data' => null))
				->add('filter_sex', 'choice', array( 'label' => 'Pohlaví: ',
										'choices'   => array('0' => 'muž', '1' => 'žena'),
										'required'  => false));
  }
 
	   /**
   * This function just returns the name of this actual type of form.
   */ 
	public function getName() {
		/* identifikator formulare */
		return 'editFilters';
    }
 	/**
	 * This function returns the instance of a data class, which was used for making this form.
	 * @param An aditional information for the function, from which the actual instance is returned.
	 */
	public function getDefaultOptions(array $options)
	{
	    return array(
	        'data_class' => 'ZSI\ZizenBundle\Entity\Filters',
	    );
	} 
	
}
?>
