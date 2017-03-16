<?php

class Application_Form_RegistrationForm extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('post');
		$id = $this->createElement('hidden','id');

		$firstname = $this->createElement('text','firstname');
		$firstname->setLabel('First Name:')
		->setAttrib('maxlength',100);

		$lastname = $this->createElement('text','lastname');
		$lastname->setLabel('Last Name:')
		->setAttrib('maxlength',100);

		$email = $this->createElement('text','email');
		$email->setLabel('Email:')
		->setAttrib('maxlength',255);

		$username = $this->createElement('text','username');
		$username->setLabel('Username:')
		->setAttrib('maxlength',75);

		$password = $this->createElement('password','password');
		$password->setLabel('Password:')
		->setAttrib('maxlength',75);

		$confirmPassword = $this->createElement('password','confirmPassword');
		$confirmPassword->setLabel('Confirm Password:')
		->setAttrib('maxlength',20);

		$register = $this->createElement('submit','register');
		$register->setLabel('Sign up')
		->setIgnore(true);

		$this->addElements(array($firstname,$lastname,$email,$username,$password,$confirmPassword,$register));



    }


}

