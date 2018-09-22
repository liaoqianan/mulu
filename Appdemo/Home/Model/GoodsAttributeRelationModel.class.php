<?php
/**
 * GoodsAttributeRelationModel.class.php
 * 文件描述
 * Created on ${DATA} 10:35
 * Create by liaoqianan
 */
namespace Home\Model;
use Think\Model;
class GoodsAttributeRelationModel extends Model
{
    protected $pk = "id";
    protected $fields = array('id', 'goods_id', 'attr_id', 'attr_value');
    /**
     * 查询指定商品的唯一属性
     * @param  int    $goods_id 商品ID
     * @return array            当前商品的所有唯一属性
     */
    public function getOnlyAttr($goods_id){
        return $this->alias('gar')
            ->join('__GOODS_ATTRIBUTE__ ga ON ga.attr_id = gar.attr_id')
            ->where("goods_id=$goods_id AND attr_sel = 0" )
            ->select();
    }
    /**
     * 查询指定商品的单选属性
     * @param  int $goods_id 商品ID
     * @return array           当前商品的所有单选属性
     */
    public function getRadioAttr($goods_id){
        $data = $this->alias('gar')
                     ->join('__GOODS_ATTRIBUTE__ ga ON ga.attr_id = gar.attr_id')
                     ->where("goods_id=$goods_id AND attr_sel = 1" )
                     ->select();
        $attrList = array(); // 声明一个空数组，用于存储调整数组结构以后的数据

        // 数组在循环的属性，按商品属性进行分组，再次组成新的数组
        foreach($data as $key=>$value ){
            // $attrList[$value['attr_name']][] = array();
            // 以属性的名称作为二维数组的下标
            $attrList[ $value['attr_name'] ][] = $value;
            //dump($attrList);die;
        }

        return $attrList;
    }
}