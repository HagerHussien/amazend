<?php

class Application_Form_CreateCoupon extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
		$this->setName('CREATE');
		$this->setMethod('POST');

		$str = 'abcdefghijklmnopqrstuvwxyz0123456789';
		$shuffled = str_shuffle($str);

		$couponID = new Zend_Form_Element_Hidden('couponID');
		$couponID->addFilter('Int');

		$name  = new Zend_Form_Element_Text('name');
		$name ->setLabel('Coupon code')
		->setRequired(true)
		->addValidator('NotEmpty')
		->addFilter('StringTrim');
		$name->setAttrib('readonly', 'readonly');
		$name ->setAttribs(array('class' =>'form-control',));
		$name->setValue($shuffled );

		$percent = new Zend_Form_Element_Text('percent');
		$percent ->setLabel('Coupon percent')
		->setRequired(true)
		->addValidator('NotEmpty')
		->addFilter('StringTrim');
		$percent ->setAttribs(array('class' =>'form-control' ,
				'placeholder' => 'Please Enter Coupon Percent'));
		
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('id', 'submitbutton');
		$submit->setAttribs(array('class' => 'btn btn-success'));
	

		$this->addElements(array($couponID,$name,$percent ,$submit ));
    

    }


}

