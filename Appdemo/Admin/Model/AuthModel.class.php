<?php
/**
 * AuthModel.class.php
 * 文件描述
 * Created on ${DATA} 14:46
 * Create by liaoqianan
 */

namespace Admin\Model;

use Think\Model;

class AuthModel extends Model
{

    protected $pk = 'auth_id';
    
    protected $fields = array('auth_id', 'auth_name', 'auth_pid', 'auth_controller', 'auth_action', 'is_menu');

    protected $_validate = array(
        array('auth_name','require','权限名必须',1,'',3),
        array('auth_pid','require','父级id必须',1,'',3),
//        array('auth_controller','require','控制器必须',1,'',3),
//        array('auth_action','require','方法必须',1,'',3),

    );
}