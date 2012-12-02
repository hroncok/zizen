<?php
namespace ZSI\ZizenBundle\Form;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;


/**
 * SelectDefaultLocForm creates a form for selecting a default location!
 */ 
class SelectDefaultLocForm extends AbstractType {
 
  public function buildForm(FormBuilder $builder, array $options) {
		$builder->add('defaultLocation','entity',array('label'=>'Lokace: ',
											'class'=>'ZSIZizenBundle:Location', 
											//'required' => false,
											//'empty_value'=>'---',
											//'empty_data' => null,
											'property'=>'location_name'));
  }
 
  public function getName() {
    /* identifikator formulare */
    return 'selectDefaultLoc';
  }
 
	public function getDefaultOptions(array $options)
	{
	    return array(
	        'data_class' => 'ZSI\ZizenBundle\Entity\User',
	    );
	} 
}
?>
