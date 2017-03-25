<?php

class Application_Model_Product extends Zend_Db_Table_Abstract
{
    protected $_name = 'product';

    function productDetails($prod_id) {
        return $this->find($prod_id)->toArray()[0];
    }

    function listProducts(){
        return $this->fetchAll()->toArray();
    }

    function addNewProduct($userData){
        $row = $this->createRow();
		$row->EnName = $userData['EnName'];
		$row->ArName = $userData['ArName'];
		$row->EnDescription = $userData['EnDescription'];
        $row->ArDescription = $userData['ArDescription'];
        $row->price = $userData['price'];
		// var_dump($userData['photo']);
		// die();
        $row->photo=$userData['photo'];
        //category id
        //$catobj = new Application_Model_Category();
        //$cat = $catobj->getCat($userData['categoryID']);
        //$row->categoryID = $cat['categoryID'];
        
        $row->categoryID = $userData['categoryID'];
		
        //from session
        //$row->shopperID = $userData['shopperID'];
		
		return $row->save();

        
		
		//return $this->$row->productID;
    }

}
