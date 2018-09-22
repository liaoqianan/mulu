<?php
/**
 * GoodsAttributeRelation.class.php
 * 文件描述
 * Created on ${DATA} 10:08
 * Create by liaoqianan
 */
namespace Admin\Model;
use Think\Model;
class GoodsAttributeRelationModel extends Model
{
     protected $pk = 'id';

     protected $fields = array('id', 'goods_id', 'attr_id', 'attr_value');

     protected $_validata = array(
                array('goods_id','require','商品ID不能为空',1,'',3),
                array('attr_id','require','属性ID不能为空',1,'',3),
                array('attr_value','require','属性值不能为空',1,'',3),
     );
    public function addAttr( $goods_id ){
        if( IS_POST ){

            // 接收数据，因为create方法直接接收当前数据表中字段的数据
            $ids  = I('post.attr_ids');
            $vals = I('post.attr_vals');

            $attrList = array();  // 声明一个空数组，用来存放循环以后的数据
            // 添加操作
            foreach($ids as $key => $value ){
                $attrList[] = array('goods_id'=>$goods_id, 'attr_id'=>$value, 'attr_value'=> $vals[$key] );
            }

            // dump( $attrList );die;
            $res = $this->addAll( $attrList );
            if( $res ){
                return '添加商品属性成功！'; // 这里是模型文件，没有什么页面跳转功能的！
            }else{
                return '添加商品属性失败！';
            }

        }
    }
}