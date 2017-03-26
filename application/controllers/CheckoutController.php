<?php

class CheckoutController extends Zend_Controller_Action
{

    public $language = null;

    public function init()
    {
        $request = $this->getRequest()->getParam('ln');
        //echo $request;
        if (empty($request)) {
            $this->language = new Zend_Session_Namespace('language');
            $this->language->type = isset($this->language->type) ? $this->language->type : "En";
        } else {
            $this->language = new Zend_Session_Namespace('language');
            $this->language->type = $request;
            // echo $this->language->type;
        }
    }

    public function indexAction()
    {
        // action body
    }

    public function cartAction()
    {
        $userData = Zend_Auth::getInstance()->getStorage()->read();
        $person = (array) $userData;
        $cust_id = $person['customerID'];
        if (empty($cust_id)){
            $this->redirect('/customer/login');
        }
//        $cart_model = new Application_Model_Cart();
//        $cart = $cart_model;

        $db = Zend_Db_Table::getDefaultAdapter(); //set in config file
        $select = new Zend_Db_Select($db);
//        $select->from('product', array('id', 'title')) //the array specifies which columns I want returned in my result set
        $select->from('cart', array('cartID', 'customerID')) //the array specifies which columns I want returned in my result set
                //by specifying an empty array, I am saying that I don't care about the columns from this table
                ->joinInner('cart_product', 'cart.cartID = cart_product.cartID')
                ->joinInner('product', 'product.productID=cart_product.productID')
                ->joinLeft('order_history', 'order_history.order_id=cart.cartID', array())
                ->joinLeft('offer', 'offer.productID=product.productID', array('precent', 'end'))
                ->where("customerID = $cust_id")
                ->where('order_history.order_status_id IS NULL');
        $resultSet = $db->fetchAll($select);
        $this->view->cart = $resultSet;

        //get coupon

        $coupon_name = $this->_request->getParam("coup");
        if (isset($coupon_name)) {
            $coupon_model = new Application_Model_Coupon();
            $coupon_value = $coupon_model->getCouponValue($coupon_name);
            $this->view->coupon_value = $coupon_value;
        }
    }

    public function placeorderAction()
    {
        $userData = Zend_Auth::getInstance()->getStorage()->read();
        $person = (array) $userData;
        $cust_id = $person['customerID'];
        $user_email=$person['email'];
        $username = $person['EnName'];
        // makes disable renderer
        $this->_helper->viewRenderer->setNoRender();

        //makes disable layout
        $this->_helper->getHelper('layout')->disableLayout();

//need to get user email and name using session
        $cart_id = 2;
        $requet = $this->getRequest();
        if ($requet->isPost()) {
            $data = $requet->getParams();
            
            $orderhist_model= new Application_Model_Orderhistory();
            $order_data = array('id'=>NULL,'order_id'=>$cart_id,'order_status_id'=>1);
            $orderhist_model->insert($order_data);
//            $products
            $mailstring= "<b>Dear/" . $username . "</b><br>Thank you for using <a href='http://amazend.com'>AmaZend.Com</a><br>" .
            "We are currently processing your order and here is your order details<br><br>" .
            "<table border=1><tr><th>Item</th><th>Qty.</th><th>Unit Price</th><th>Discount</th><th>Total</th></tr>";
            for ($index = 0; $index < count($data['data']); $index++) {
                $mailstring.="<tr align=center>";
                foreach ($data['data'][$index] as $value) {
                    $mailstring.="<td>" . $value . "</td>";
                }
                $mailstring.='</tr>';
            };
//            var_dump($data['coupon_value']);
            $mailstring.="<tfoot><tr><th colspan=3>Subtotal</th><th colspan=2>".$data['order_subtotal']."</th></tr>";
            $mailstring.="<tr><th colspan=3>Coupon</th><th colspan=2>".$data['coupon_value']."%"."</th></tr>";
            $mailstring.="<tr><th colspan=3>Order total</th><th colspan=2>".$data['order_total']."</th></tr></table>";

            $tr = new Zend_Mail_Transport_Smtp('smtp.gmail.com', array('auth' => 'login',
                'port' => 587,
                'ssl' => 'tls',
                'username' => 'amazend.zendphp@gmail.com',
                'password' => 'amazendzendphp'));
            Zend_Mail::setDefaultTransport($tr);

            $mail = new Zend_Mail();
            $mail->setFrom('amazend.zendphp@gmail.com');

            $mail->setBodyHtml($mailstring);

            $mail->addTo($user_email, 'recipient');
            $mail->setSubject('[AmaZend.com] Order details');
            $mail->send($tr);
        }
    }

    public function updatebasketAction()
    {
        // makes disable renderer
        $this->_helper->viewRenderer->setNoRender();

        //makes disable layout
        $this->_helper->getHelper('layout')->disableLayout();

        $requet = $this->getRequest();
        $data = $requet->getParams();
        unset($data['controller']);
        unset($data['action']);
        unset($data['module']);

        if (isset($data['ln']) || isset($data['coup']))
            unset($data['ln']);
        unset($data['coup']);

        if (empty($data)) {
            $this->redirect('/checkout/cart');
        }

        $prod_cart_model = new Application_Model_CartProduct();

        $columns = array('productID', 'quantity', 'price', 'total');
        $where[] = 'cartID=2';
        for ($index = 0; $index < count($data); $index++) {
            $i = 0;
            unset($where[1]);
            $values = array();
            foreach ($data[$index] as $key => $value) {
                $values["$columns[$i]"] = $value;
                $i++;
            }
            $pid = $data[$index][0];
            $where[] = "productID=$pid";
            var_dump($values);
            $prod_cart_model->update($values, $where);
        }
    }

    public function removeitemAction()
    {
        $request = $this->getRequest();
        $del_id = $request->getParam('pid');
        $cart_product = new Application_Model_CartProduct();
        $where[]="cartID=2";
        $where[]="productID=$del_id";
        $cart_product->delete($where);
        $this->redirect("/checkout/cart");
    }


}


