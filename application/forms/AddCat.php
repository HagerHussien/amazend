<?php

class Application_Form_AddCat extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
		$this->setName('ADD');
		$this->setMethod('POST');
		
		$categoryID = new Zend_Form_Element_Hidden('categoryID');
		$categoryID->addFilter('Int');

		$EnName  = new Zend_Form_Element_Text('EnName');
		$EnName ->setLabel('Category Name in English')
		->setRequired(true)
		->addValidator('NotEmpty')
		->addFilter('StringTrim');
		$EnName ->setAttribs(array('class' =>'form-control' ,
				'placeholder' => 'Please Enter Category Name in English'));

		$ArName  = new Zend_Form_Element_Text('ArName');
		$ArName ->setLabel('Category Name in Arabic')
		->setRequired(true)
		->addValidator('NotEmpty')
		->addFilter('StringTrim');
		$ArName ->setAttribs(array('class' =>'form-control' ,
				'placeholder' => 'Please Enter Category Name in Arabic'));
		$admin_obj = new Application_Model_Admin();
		$allAdmins = $admin_obj->getAllAdmins();
		$AdminID = new Zend_Form_Element_Select('adminID');
		$AdminID->setLabel('Admin')
		->setRequired(true)
		->addValidator('NotEmpty');
		foreach($allAdmins as $key=>$value)
			{
				$AdminID->addMultiOption($value['adminID'], $value['EnName']);
			}
		$AdminID->setAttribs(array('class' =>'form-control'));
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('id', 'submitbutton');
		$submit->setAttribs(array('class' => 'btn btn-success'));
		$reset = new Zend_Form_Element_Submit('reset');
		$reset->setAttribs(array('class' => 'btn btn-danger'));
		$this->addElements(array($categoryID,$EnName,$ArName,$AdminID ,$submit ,$reset));
    
}

}