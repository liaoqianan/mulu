<?php
/**
 * UserModel.class.php
 * 文件描述
 * Created on ${DATA} 12:52
 * Create by liaoqianan
 */

namespace Home\Model;
use Think\Model;
class UserModel extends Model
{
    protected $pk = 'user_id';

    protected $fields = array('user_id', 'user_name', 'user_email', 'user_mobile', 'user_pwd', 'salt', 'openid', 'user_sex', 'user_check', 'user_check_code', 'is_del');

    protected $_map = array(
        'username' => 'user_name',
        'password' => 'user_pwd',
        'email'    => 'user_email',
        'mobile'   =>  'user_mobile',
    );

    protected $_validate = array(
        array('user_name','require','用户名不能为空'),
        array('username','该用户名已经被占用',0,'unique'),
        array('user_pwd','require','密码不能为空'),
        array('user_pwd2','require','确认密码必须填写'),
        array('user_pwd2','user_pwd','两次密码保持一致',0,'confirm'),
        array('user_mobile','/(\+86)?\d{11}/','手机格式不正确!',0,'regex',3),
        array('user_mobile','','手机号码以备使用',0,'unique',3),
        array('is_read','1','请认真阅读《用户协议》！',0,'equal',1),
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