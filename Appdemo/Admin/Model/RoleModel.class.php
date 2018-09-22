<?php
/**
 * RoleModel.class.php
 * 文件描述
 * Created on ${DATA} 12:13
 * Create by liaoqianan
 */

namespace Admin\Model;

use Think\Model;

class RoleModel extends Model
{

    protected $pk = 'role_id';

    protected $fields = array('role_id', 'role_name', 'auth_ids', 'auth_vals');

    protected $_validate = array(
                array('role_name','require','角色名不能为空',1,'',3),
    );

}