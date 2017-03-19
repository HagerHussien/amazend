<?php

class Application_Form_CustomerLogin extends Zend_Form
{

   public function init()
    {
        $this->setMethod('POST');
        
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email:')
            ->setRequired(true)
            ->setAttrib('class','form-control');
        $password= new Zend_Form_Element_Password('password');
         $password->setLabel('Password:');
        $password->setAttrib('class','form-control');
        
        $submit= new Zend_Form_Element_Submit('submit');
        $submit->setAttribs(array('class'=>'btn btn-success'));
        
        $this->addElements(array($email,$password,$submit));
    }

}

