<?php
/**
 * GoodsPicsModel.class.php
 * 文件描述
 * Created on ${DATA} 12:33
 * Create by liaoqianan
 */
namespace Admin\Model;
use Think\Model;
class GoodsPicsModel extends Model{
    //主键
    protected $pk = 'pics_id';
    //表字段
    protected $fields = array('pics_id', 'goods_id', 'pics_bg', 'pics_md', 'pics_sm');
}