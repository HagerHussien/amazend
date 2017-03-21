/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  mohamd
 * Created: Mar 21, 2017
 */

SELECT cart.cartID,customerID,c_prod.productID,c_prod.quantity,c_prod.price,c_prod.total,offer.precent AS discount ,history.order_status_id as ostaus
FROM cart 
INNER JOIN cart_product AS c_prod ON cart.cartID=c_prod.cartID 
INNER JOIN product ON c_prod.productID=product.productID 
LEFT JOIN order_history as history ON cart.cartID=history.order_id
LEFT JOIN offer ON offer.productID=product.productID
WHERE customerID=2 AND history.order_status_id is NULL AND offer.end >= NOW()