<?php

class Application_Model_Offer extends Zend_Db_Table_Abstract
{
	protected $_name = 'offer';
	
	function addOffer($userData,$prod_Id){
		$row = $this->createRow();
		$row->start = $userData['start'];
		$row->end = $userData['end'];
		$row->precent = $userData['precent'];
		//How
		
		$row->productID = $prod_Id;
		//$prod_Id = "select max(productID) from product";
		// var_dump($prod_Id = "select max(productID) from product");
		$row->save();
		 
	}
        function editOffer($userData,$prod_Id){
		$this->update($userData, "productID=".$prod_Id);
		 
	}

}

