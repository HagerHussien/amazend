<?php

class Application_Form_Product extends Zend_Form
{

    public function init()
    {
    	$this->setMethod('POST');
        
        $EnName = new Zend_Form_Element_Text('EnName');
        $EnName->setLabel('English Name: ');
        $EnName->setAttribs(Array(
        'placeholder'=>'Example: anything',
        'class'=>'form-control'
        ));
        $EnName->setRequired();
        $EnName->addValidator('StringLength', false, Array(4,20));
        $EnName->addFilter('StringTrim');
        //$EnName->addFilter(new Zend_Filter_Int());
        
        $ArName = new Zend_Form_Element_Text('ArName');
        $ArName->setLabel('Arabic Name: ');
        $ArName->setAttribs(Array(
        'placeholder'=>'Example: anything',
        'class'=>'form-control'
        ));
        //$ArName->setRequired();
        $ArName->addValidator('StringLength', false, Array(4,20));
        $ArName->addFilter('StringTrim');
        
        $EnDescription = new Zend_Form_Element_Text('EnDescription');
        $EnDescription->setLabel('English Description: ');
        $EnDescription->setAttribs(Array(
        'placeholder'=>'Example: anything',
        'class'=>'form-control'
        ));
        //$EnDescription->setRequired();
        $EnDescription->addValidator('StringLength', false, Array(4,200));
        $EnDescription->addFilter('StringTrim');
        
        $ArDescription = new Zend_Form_Element_Text('ArDescription');
        $ArDescription->setLabel('Arabic Description: ');
        $ArDescription->setAttribs(Array(
        'placeholder'=>'Example: anything',
        'class'=>'form-control'
        ));
        //$ArDescription->setRequired();
        $ArDescription->addValidator('StringLength', false, Array(4,200));
        $ArDescription->addFilter('StringTrim');
        
        $uploadDir = 'img';
        //$photo = new Zend_Form_Element_Text('photo');
        $photo = new Zend_Form_Element_File('photo');
        $photo->setLabel('Product photo: ')
                ->setDestination("img")
//                ->setValueDisabled(true)
                ->addValidator('Count', false, 1)
                ->addValidator('Size', false, 1024000)
                ->addValidator('Extension', false, 'jpg,png,gif')
                ->setAttrib('enctype', 'multipart/form-data');
//        $photo->setAttribs(Array(
//        'placeholder'=>'Example: 1000',
//        'class'=>'form-control'
//        ));
        
        $price = new Zend_Form_Element_Text('price');
        $price->setLabel('Price in $: ')
            ->setRequired(true)
            ->setAttrib('class','form-control')
            ->addFilter(new Zend_Filter_Int());
            
            
        //$rate = new Zend_Form_Element_Text('rate');
        //$rate->setLabel('Rate out of 5: ')
        //    ->setRequired(true)
        //    ->setAttrib('class','form-control')
        //    ->addFilter(new Zend_Filter_Int());
            
        // $no_purchase = new Zend_Form_Element_Text('no_purchase');
        // $no_purchase->setLabel('Number of purchases: ')
        //     ->setRequired(true)
        //     ->setAttrib('class','form-control')
        //     ->addFilter(new Zend_Filter_Int());
        
        $categoryID = new Zend_Form_Element_Select('categoryID');
        //$categoryID->addFilter(new Zend_Filter_Int());
        $categoryobj = new Application_Model_Category();
        $allCategories = $categoryobj->listCat();
        foreach($allCategories as $key=>$value)
        {
            $categoryID->addMultiOption($value['categoryID'], $value['cat_EnName']);
        }
        
        //$shopperID = new Zend_Form_Element_Text('shopperID');
        
        //offer part
    
        $start = new Zend_Form_Element_Text('start');
        
		
   
        $end = new Zend_Form_Element_Text('end');

        
        //offer percentage
        $precent = new Zend_Form_Element_Text('precent');
    	$precent->setLabel('Offer % : ')
            ->setRequired()
            ->addFilter(new Zend_Filter_Int())
            ->setAttribs(Array('placeholder' => 'Example: 30', 'class' => 'form-control'));
        
        $submit= new Zend_Form_Element_Submit('create');
        $submit->setLabel('Save');
        $submit->setAttribs(array('class'=>'btn btn-success'));
        
        $this->addElements(array(
          $EnName,
          $ArName,
          $EnDescription,
          $ArDescription,
          $photo,
          $price,
          //$rate,
          //$no_purchase,
          $categoryID,
          //$start,
          $start->setAttribs(['size' => '30', 'class' => 'datepicker'])
              ->setLabel('Start Date: ')
              ->setValue(date("Y-m-d H:i:s")),
          //$end,
          $end->setAttribs(['size' => '30', 'class' => 'datepicker'])
              ->setLabel('End Date: ')
              ->setValue(date("Y-m-d H:i:s")),
          $precent,
          $submit
        ));
    }


}

