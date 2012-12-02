<?php
namespace ZSI\ZizenBundle\Form;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;


/**
 * editFiltersForm creates a form for editing user's filters!
 */
class editFiltersForm extends AbstractType {
 
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
 
	  
	public function getName() {
		/* identifikator formulare */
		return 'editFilters';
    }
 
	public function getDefaultOptions(array $options)
	{
	    return array(
	        'data_class' => 'ZSI\ZizenBundle\Entity\Filters',
	    );
	} 
	
}
?>
