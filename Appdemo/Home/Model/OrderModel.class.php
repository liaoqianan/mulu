<?php
/**
 * OrderModel.class.php
 * 文件描述
 * Created on ${DATA} 16:59
 * Create by liaoqianan
 */
namespace Home\Model;
use Think\Model;
class OrderModel extends Model
{
    protected $pk = "order_id";

    protected $_map = array(
        'pay'     =>'order_pay',
        'content' =>'invoice_content',
    );

    protected $fields = array('order_id', 'user_id', 'order_number',
                              'order_price', 'order_pay', 'invoice_head',
                              'invoice_company', 'invoice_content', 'consignee_name',
                              'consignee_address', 'consignee_mobile', 'order_status',
                              'created_at', 'updated_at');

    protected $_auto = array(
                       array('order_number','createOrderNum',1,'callback'),
                       array('order_price','getOrderPrice',1,'callback'),
                       array('created_at','time',1,'function'),
                       array('updated_at','time',2,'function'),
                       array('user_id','getUserId',1,'callback'),
    );

    public function createOrderNum(){

        return time().mt_rand(10000,99999);

    }
    public function getOrderPrice(){

            $cart = new \Common\Library\Cart();
            $NumberPice = $cart ->getNumberPrice();
            return $NumberPice['price'];
    }

    public function getUserId(){

        return session('user_id');
    }
}