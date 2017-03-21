<?php

class Application_Form_CommentForm extends Zend_Form
{

    public function init()
    {

      /* Form Elements & Other Definitions Here ... */
      $this->setMethod('POST');
      $id = new Zend_Form_Element_Hidden('id');

      $comment_body = new Zend_Form_Element_Text('comment_body');
      $comment_body->setLabel('comment : ');
      $comment_body->setAttribs(array(
                      'class'=>'form-control'));
      $comment_body->setRequired();
      $comment_body->addValidator('StringLength',false,Array(3,200));
      $comment_body->addFilter('StringTrim');

      $submit= new Zend_Form_Element_Submit('Go');
      $submit->setAttribs(array('class'=>'btn btn-success'));


      $this->addElements(array(
        $comment_body,
        $submit
      ));
  }


}
