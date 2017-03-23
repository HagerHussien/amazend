<?php

class Application_Form_Search extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */


        $this->setName('search');
		$this->setMethod('POST');
		//$this->setAttribs(array('class'=> 'navbar-form', 'role'=>'search'));
		
		$search = new Zend_Form_Element_Text('search');
		$search ->setAttribs(array('class' =>'form-control' ,
				'placeholder' => 'Search : please add product name '));

		
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('id', 'submitbutton');
		$submit->setAttribs(array('class' => 'fa fa-search'));
		
		$this->addElements(array($search ,$submit ));
    }


}



            