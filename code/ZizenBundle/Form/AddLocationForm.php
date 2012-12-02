<?php
namespace ZSI\ZizenBundle\Form;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;


/**
 * AddLocationForm creates a form for adding a new location!
 */
class AddLocationForm extends AbstractType {
 
  public function buildForm(FormBuilder $builder, array $options) {
		$builder->add('location_name','text',array('label'=>'Název lokace: ',
										'required' => false,
										'empty_data' => null))
				->add('location_location','text',array('label'=>'Místo lokace: ',
										'required' => false,
										'empty_data' => null));
  }
 
  public function getName() {
    /* identifikator formulare */
    return 'addLocation';
  }
 
	public function getDefaultOptions(array $options)
	{
	    return array(
	        //'data_class' => 'ZSI\ZizenBundle\Entity\Location',
	    );
	} 
}
?>
