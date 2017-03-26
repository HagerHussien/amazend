<?php

class Application_Model_Product extends Zend_Db_Table_Abstract {

    protected $_name = 'product';

    function productDetails($prod_id) {
        return $this->find($prod_id)->toArray()[0];
    }

    function listProducts() {
        return $this->fetchAll()->toArray();
    }

    function productSearch($prod_name) {

        return $this->fetchAll("EnName like \"$prod_name%\"")->toArray();
    }

    function addNewProduct($userData) {
        $row = $this->createRow();
        $row->EnName = $userData['EnName'];
        $row->ArName = $userData['ArName'];
        $row->EnDescription = $userData['EnDescription'];
        $row->ArDescription = $userData['ArDescription'];
        $row->price = $userData['price'];
        // var_dump($userData['photo']);
        // die();
        $row->photo = $userData['photo'];
        //category id
        //$catobj = new Application_Model_Category();
        //$cat = $catobj->getCat($userData['categoryID']);
        //$row->categoryID = $cat['categoryID'];

        
        $row->categoryID = $userData['categoryID'];

        //from session
        //$row->shopperID = $userData['shopperID'];
        $auth = Zend_Auth::getInstance();
        $storage = $auth->getStorage();
        $userData = $storage->read();

        $person = $storage->read()->shopperID;
        $row->shopperID = $person;

        return $row->save();
    }



function editProduct($userData) {
        //$row = $this->createRow();
        $row->productID = $userData['productID'];
        $row->EnName = $userData['EnName'];
        $row->ArName = $userData['ArName'];
        $row->EnDescription = $userData['EnDescription'];
        $row->ArDescription = $userData['ArDescription'];
        $row->price = $userData['price'];
        $row->photo = $userData['photo'];
              $row->categoryID = $userData['categoryID'];
        $auth = Zend_Auth::getInstance();
        $storage = $auth->getStorage();
        $userData = $storage->read();
        $person = $storage->read()->shopperID;
        $row->shopperID = $person;

        return $row->save();
    }

    function maxPurchased() {
        $select = $this->select()
                ->from('product', array('ArName', 'EnName', 'photo'))
                ->order('product.no_purchase DESC')
                ->limit(5);

        $stmt = $select->query();
        return $stmt->fetchAll();
  }
  function prouduct_price($product_id){
      $select =  $this->select()
      ->from('product',array('price'))
      ->where('productID=?',$product_id);
      $stmt = $select->query();
      return $stmt->fetchAll();
  }

  function category_products($category_id){
      $select =  $this->select()
      ->from('product',array())
      ->where('product.categoryID=?',$category_id);
      $stmt = $select->query();
      return $stmt->fetchAll();
    }

public function topProduct($catID)
  {
    $db = Zend_Db_Table::getDefaultAdapter();

    $select = new Zend_Db_Select($db);

    $select ->from('product')
      ->where( 'product.categoryID='.(int)$catID)
      ->order('product.no_purchase DESC')
      ->limit(1);
    return $resultSet = $db->fetchAll($select);

  }

  function addRate($product_id,$rate){
      $select =  $this->select()
      ->from('product',array('rate','no_rate'))
      ->where('product.productID=?',$product_id);
      $stmt = $select->query();
      $res= $stmt->fetchAll();
      $old_rate= $res[0]['rate'];
      $old_no_rate = $res[0]['no_rate'];
      $product['rate'] = $old_rate + $rate;
      $product['no_rate'] = $old_no_rate + 1 ;
      $this->update($product,"productID=$product_id");

  }

  function getRate($product_id){
      $select =  $this->select()
      ->from('product',array('rate','no_rate'))
      ->where('product.productID=?',$product_id);
      $stmt = $select->query();
      $res= $stmt->fetchAll();
      $res_rate= $res[0]['rate'];
      $res_no_rate = $res[0]['no_rate'];
      $rate = (int)($res_rate / $res_no_rate);
      return $rate;
  }


function deleteProd($id)
{
  $this->delete("productID=$id");
  
}


public function updateProd($catID,$EnName,$ArName,$adminID)
  {
    $data = array(
    'productID' => $catID,
    'EnName' => $EnName,
    'ArName' => $ArName,
    'adminID' => $adminID,
    );
    $this->update($data, 'productID = '. (int)$catID);
  }



  function getProd($id)
  {
  $id = (int)$id;
    $row = $this->fetchRow('productID = ' . $id);
    if (!$row) {
    throw new Exception("Could not find Product $id");
    }
    return $row->toArray();
  }

}
