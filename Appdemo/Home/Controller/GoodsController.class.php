<?php 
namespace Home\Controller;
use Think\Controller;

class GoodsController extends CommonController{
	public function index(){
        $where = [];
        //按属性查询
        if($cid = I('get.cid',0,'intval')){
        $where['cate_id'] = $cid;
        }
        //按价格查询
        if($price = I('get.price')){
            $price = explode('-',$price);
            $where['goods_price'] = array('BETWEEN',$price);
        }

         $this->goodsList = D('Goods')->where()->select();
         $this->GoodsList =D('Goods')->where($where)->select();
		$this->display();
	}
	public function detail(){
	    $goods_id = I('id',0,'intval');
        //dump($goods_id);die;
	    if($goods_id < 1){
            $this->error('参数有误。请重新输入');
        }
        $model = D('GoodsAttributeRelation');
	    //dump($model);die;

        // 根据商品ID获取商品信息
        $this->goodsInfo = D('Goods')->find( $goods_id );
        //dump( $this->goodsInfo );die;
        // 商品的相册图片
        $this->goodsPics = D('GoodsPics')->where('goods_id='.$goods_id)->select();
        //dump( $this->goodsPics);die;
        // 商品的唯一属性[attr_sel = 0]
        $this->onlyAttr = $model->getOnlyAttr($goods_id);

        // 商品的单选属性[attr_sel = 1]
        $this->radioAttr = $model->getRadioAttr( $goods_id );
        //dump( $this->radioAttr);die;
		$this->display();
	}
}