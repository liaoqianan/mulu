<?php
namespace Home\Controller;
use Think\Controller;
class CartController extends Controller{
    // 初始化
    public function _initialize(){
        // 实例化购物车工具类
        $this->cart = new \Common\Library\Cart();
    }

    // 购物车列表
    public function index(){

    }

    // 添加商品到购物车
    public function add(){
        // 判断当前如果有ajax
        if( IS_AJAX ){
            // 获取商品数据
            $goods_price = I('get.goods_price');
            $goods_buy_number = I('get.goods_buy_number');

            $data = array(
                'goods_id'          => I('get.goods_id'),
                'goods_name'        => I('get.goods_name'),
                'goods_price'       => $goods_price,
                'goods_buy_number'  => $goods_buy_number,
                // 单种商品的总价格 = 商品单价 * 商品数量
                'goods_total_price' => $goods_price * $goods_buy_number,
                // 接收属性
                'goods_attr'        => I('get.goods_attr'),
            );

            // 调用购物车类的添加商品方法
            $this->cart->add($data);

            // 获取添加以后的商品的总价格和总数量
            $NumberPrice = $this->cart->getNumberPrice();
            $this->ajaxReturn( $NumberPrice );

        }
    }

    // 编辑[修改商品数量]
    public function edit(){
        if( IS_AJAX ){
            $goods_number = I('goods_number');
            $goods_id = I('goods_id');
            $this->cart->changeNumber($goods_number,$goods_id);
            $NumberPrice = $this->cart->getNumberPrice();
            $this->ajaxReturn( $NumberPrice );
        }
    }

    // 删除购物车中的商品
    public function del(){
        $godos_id  = I("goods_id");
        $data = $this->cart->delete($goods_id);
        $this->ajaxReturn($data);
    }

    // 1. 购物流程 - 购物车的商品列表
    public function flow1(){

        $this->_getCart();
        $this->display();
    }

    // 2. 购物流程 - 订单结算界面
    public function flow2(){

        // 判断当前用户是否已经登录，如果没有登录则跳转登录
        if( session('user_login') != 1 ){
            // 这里想想，用户会不会去登录之后就不回来这里拉？
            // 所以我们要帮助他，登录以后跳转会这里
            // 因此，我们需要记录这里的地址
            // 1. 地址栏附带参数        home/user/login.html?url=Cart/flow2
            // 2. 使用session记录一下
            session('jump_url','Cart/flow2');
            $this->error('您尚未登录！请登录以后再进行结算！', U('User/login') );die;
        }
        // 获取购物车商品相关信息
        $this->_getCart();
        $this->display();
    }

    // 3. 购物流程 - 订单生成并支付
    public function flow3(){
        if( IS_POST ){
            // dump( $_POST );
            if( !D('Order')->create() ){
                $this->error('生成订单失败！<br>' . D('Order')->getError() );die;
            }

            // 订单生成[本质上把数据存储到订单表中]

            $order_id = D('Order')->add();
            if( !$order_id ){
                $this->error('生成订单失败！<br>' . D('Order')->getError() );die;
            }

            // 把购物车中的商品存储订单商品表中
            $cartInfo = $this->cart->getCartInfo();
            $data = [];  // 存储循环以后有order_id的数据
            foreach( $cartInfo as $key=>$value ){
                // 在每一个商品的数据中都添加order_id
                $value['order_id'] = $order_id;
                $data[] = $value;
            }

            // 存储订单的所有商品数据
            $res = D('OrderGoods')->addAll($data);
            if( !$res ){
                $this->error('生成订单失败！<br>' . D('Order')->getError() );die;
            }

            // 根据订单ID获取订单数据
            $orderInfo = D('Order')->find($order_id);

            // 生成订单以后，接下来，我们要让我们会员支付
            $subject = 'xxx大促销'; // 订单名称

            D('Alipay')->pay( $orderInfo['order_number'], $subject, $orderInfo['order_price'] );
        }
    }

    public function _getCart(){
        // 获取购物车中所有的商品
        $CartList = $this->cart->getCartInfo();
        // dump( $CartList );
        // 在循环中，每一个商品的图片都获取出来
        foreach( $CartList as $key => $value ){
            $GoodsInfo = D('Goods')->find($value['goods_id']);
            $CartList[$key]['goods_logo_thumb'] = $GoodsInfo['goods_logo_thumb'];
        }
        // 商品信息列表
        $this->CartList = $CartList;

        // 商品总价格 和 总数量
        $this->NumberPrice = $this->cart->getNumberPrice();
    }


    public function flow5(){
        if( IS_POST ){
            D('Alipay')->notify_url();
        }else{
            D('Alipay')->return_url();
        }
    }

}
