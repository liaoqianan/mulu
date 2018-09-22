<?php
/**
 * AdminModel.class.php
 * 文件描述
 * Created on ${DATA} 12:32
 * Create by liaoqianan
 */
namespace Admin\Model;
use Think\Model;
class AdminModel extends Model
{
    //主键定义
    protected $pk = 'admin_id';
    protected $_map = array(
        'name'      => 'username',
        'pwd'       => 'password',
        'pwd2'      => 'password2'
    );
    //字段定义
    protected $fields = array('admin_id', 'username', 'password', 'salt', 'mail', 'login_time', 'role_id','password_token');
    //自动验证
    protected  $_validate = array(
        array('username','require','用户名不能为空'),
        array('username','','该用户名已经被占用','0','unique'),
        array('password','require','密码不能为空'),
        array('password2','require','确认密码必须填写'),
        array('password2','password','两次密码保持一致',0,'confirm'),
        array('user_email','email','邮箱格式不正确',2),


    );

    // 数据添加之前执行的钩子方法
    protected function _before_insert(&$data,$options){
        $this->password( $data, $options );
    }

    // 更新前置钩子
    protected function _before_update(&$data, $options){
        $this->password( $data, $options );
    }

    // 生成盐值，并对密码进行加密
    protected function password( &$data, $options ){
        if( isset( $data['password'] ) && $data['password'] != false ){
            // 生成盐值[6位]
            $data['salt'] = random();

            // 密码加密处理
            $data['password'] = security( $data['password'], $data['salt'] );

        }
    }

}