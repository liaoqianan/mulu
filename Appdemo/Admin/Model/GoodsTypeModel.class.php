<?php
/**
 * GoodsTypeModel.class.php
 * 文件描述
 * Created on ${DATA} 12:13
 * Create by liaoqianan
 */
namespace Admin\Model;
use Think\Model;
class GoodsTypeModel extends Model{

    protected $pk = 'type_id';

    protected $fields = array('type_id', 'type_name');

    protected $validate = array(
            array('type_name','return','类型名不能为空',1,'',3),
            array('type_name','','类型已存在',1,'unique',3),
    );
}