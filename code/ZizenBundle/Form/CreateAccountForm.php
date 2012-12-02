<?php
namespace ZSI\ZizenBundle\Form;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;


/**
 * CreateAccountForm creates a form for creating a new account!
 */
class createAccountForm extends AbstractType {
 
  public function buildForm(FormBuilder $builder, array $options) {
		$builder->add('name','text',array('label'=>'Jméno: ',
										'required' => false))
				->add('surname','text',array('label'=>'Příjmení: ',
										'required' => false,
										'empty_data' => null))
				->add('username','text',array('label'=>'Uživatelské jméno: ',
										'required' => false,
										'empty_data' => null))
				->add('password','text',array('label'=>'Heslo: ',
										'required' => false,
										'empty_data' => null))
				->add('email','text',array('label'=>'E-mail: ',
										'required' => false,
										'empty_data' => null))
				->add('sex', 'choice', array(
										'choices'   => array('0' => 'muž', '1' => 'žena'),
										'required'  => false))
			    ->add('birthDate', 'date', array(
										 'label' => 'Datum narození: ',
										 'input'  => 'datetime',
										 'widget' => 'choice',
										 'required' => false,
										 'empty_value' => array('year' => 'Year', 'month' => 'Month', 'day' => 'Day')));
  }
 
	  
	public function getName() {
		/* identifikator formulare */
		return 'createAccount';
    }
 
	public function getDefaultOptions(array $options)
	{
	    return array(
	        'data_class' => 'ZSI\ZizenBundle\Entity\User',
	    );
	} 
	
}
?>
