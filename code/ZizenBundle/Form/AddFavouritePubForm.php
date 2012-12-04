<?php
namespace ZSI\ZizenBundle\Form;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * AddFavouritePubForm creates a form for adding a new pub!
 */
class AddFavouritePubForm extends AbstractType {
 
  public function buildForm(FormBuilder $builder, array $options) {
		$builder->add('pub_name','text',array('label'=>'Název hospody: ',
										'required' => false,
										'empty_data' => null))
				->add('pub_location','text',array('label'=>'Lokace hospody: ',
										'required' => false,
										'empty_data' => null));
  }
 
  public function getName() {
    /* identifikator formulare */
    return 'addFavouritePub';
  }
 
	public function getDefaultOptions(array $options)
	{
	    return array(
	        'data_class' => 'ZSI\ZizenBundle\Entity\Pub',
	    );
	} 
}
?>