<?php
/**
 * GoodsAttributeModel.class.php
 * 文件描述
 * Created on ${DATA} 14:47
 * Create by liaoqianan
 */
namespace Admin\Model;
use Think\Model;
class GoodsAttributeModel extends Model{
    // 主键定义
    protected $pk = 'attr_id';
    // 字段定义
    protected $fields = array('attr_id', 'attr_name', 'type_id', 'attr_sel', 'attr_write', 'attr_vals');
    // 自动验证
    protected $_validate = array(
        array('attr_name','require','属性名称不能为空！',1,'',3),
        array('attr_name','','属性已存在',1,'unique',3),
        array('type_id','require','商品类型不能为空！',1,'',3)
    );
    // 自动完成
    protected $_auto = array(
        array('attr_vals','transformComma',3,'callback'),
    );
    /***把中文逗号转换成英文逗号并去掉首尾的逗号
     * @param $data [表单提交过来的数据]
     * @return string [修正之后的数据]
     *
     */
    public function transformComma($data){
        //把中文逗号转换成英文逗号
        $str = str_replace('，',',',$data);
        //把首尾的逗号去掉
        return trim($str,',');//return表示把处理过的数据返还回去
    }
}