<?php
namespace ZSI\ZizenBundle\Form;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;


/**
 * searchFriendForm creates a form for searching friends!
 */ 
class searchFriendForm extends AbstractType {
 
  public function buildForm(FormBuilder $builder, array $options) {
		$builder->add('name','text',array('label'=>'Jméno přítele: ',
										'required' => false,
										'empty_data' => null))
				->add('surname','text',array('label'=>'Příjmení přítele: ',
										'required' => false,
										'empty_data' => null));
  }
 
	  
	public function getName() {
		/* identifikator formulare */
		return 'searchFriend';
    }
 
	public function getDefaultOptions(array $options)
	{
	    return array(
	        //'data_class' => 'ZSI\ZizenBundle\Entity\Filters',
	    );
	} 
	
}
?>
