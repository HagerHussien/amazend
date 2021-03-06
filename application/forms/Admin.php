<?php

class Application_Form_Admin extends Zend_Form
{

    public function init()
    {
        $this->setMethod('POST');
        
        //adminID      auto incremented-hidden
        
        //EnName
        $EnName = new Zend_Form_Element_Text('EnName');
        $EnName->setLabel('En Name: ');
        $EnName->setAttribs(Array(
        'placeholder'=>'Example: Mohamed',
        'class'=>'form-control'
        ));
        $EnName->setRequired();
        $EnName->addValidator('StringLength', false, Array(4,20));
        $EnName->addFilter('StringTrim');
        
        //ArName
        $ArName = new Zend_Form_Element_Text('ArName');
        $ArName->setLabel('Ar Name: ');
        $ArName->setAttribs(Array(
        'placeholder'=>'Example: Mohamed',
        'class'=>'form-control'
        ));
        //$ArName->setRequired();
        $ArName->addValidator('StringLength', false, Array(4,20));
        $ArName->addFilter('StringTrim');
        
        //email
        $email = new Zend_form_Element_Text('email');
        $email->setLabel('Email: ');
        $email->setAttribs(array('class'=>'form-control','placeholder'=>'example:ahmed@example.com'));   
        $email->setRequired();
        
        $password=new Zend_Form_Element_Password('password');
        $password->setLabel('Password: ')
            ->setRequired('true')
            ->addFilter(new Zend_Filter_StringTrim())
            ->addValidator(new Zend_Validate_NotEmpty())
            ->setAttrib('class','form-control');
              
        
        $submit= new Zend_Form_Element_Submit('submit');
        $submit->setAttribs(array('class'=>'btn btn-success'));
        
        $reset= new Zend_Form_Element_Reset('reset');
        $reset->setAttribs(array('class'=>'btn btn-danger'));

        $this->addElements(array(
          $EnName,
          $ArName,
          $email,
          $password,
          $submit,
          $reset
        ));
    }


}

