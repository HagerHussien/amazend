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

	function productSearch($prod_name) {

        return $this->fetchAll("EnName like \"$prod_name%\"")->toArray();
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
        // $person = (array)$userData;
		    $auth = Zend_Auth::getInstance();
        $storage = $auth->getStorage();
        $userData = $storage->read();
        
        $person=$storage->read()->shopperID;
        $row->shopperID = $person;
        // var_dump($person);
        // die();

		return $row->save();

        
		
		//return $this->$row->productID;
    }

  function maxPurchased(){
      // use Zend\Db\Sql\Sql;
      // $sql = new Sql($adapter);
      // $select = $this->_dbTable->select()
      // ->from($this->_name,array('ArName','EnName','photo'))
      // ->order('no_purchase DESC')
      // ->LIMIT(5);
      $select =  $this->select()
      ->from('product',array('ArName','EnName','photo'))
      ->order('product.no_purchase DESC')
      ->limit(5);

      $stmt = $select->query();
      return $stmt->fetchAll();


  }
}
