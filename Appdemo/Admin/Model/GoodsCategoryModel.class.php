<?php
/**
 * GoodsCategoryModel.class.php
 * 文件描述
 * Created on ${DATA} 15:17
 * Create by liaoqianan
 */
namespace Admin\Model;
use Think\Model;

Class GoodsCategoryModel extends Model
{
    protected $pk = 'cate_id';

    protected $fields = array('cate_id', 'cate_pid', 'cate_name', 'description', 'keywords', 'is_show', 'show_nav', 'sort');

    protected $_validate = array(
        array('cate_name','require','分类不能为空'),
        array('cate_name','','分类已存在',0,'unique'),
    );

}