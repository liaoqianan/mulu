<?php
/**
 * ConmmonController.class.php
 * 文件描述
 * Created on ${DATA} 21:48
 * Create by liaoqianan
 */
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller{
   public function __construct(){
       parent::__construct();

       $this->checkLogin();
      // $this->checkAuth();
   }


    public function checkLogin()
    {
        // 声明不需要验证登录的页面地址[控制器及方法名组成](为避免出现判断出错，书写的时候，全部要求小写)
        $nocheck = array(
            'index/login',        // 登录页面不需要登录验证
            'index/verify',       // 验证码生成页不需要登录验证
            'admin/findpassword', // 找回密码不需要登录验证
            'admin/resetpassword',// 重置密码不需要登录验证
        );

        // 获取当前用户请求的地址[控制器和方法](避免出现判断出错，全部改成小写)
        $current = strtolower(CONTROLLER_NAME . '/' . ACTION_NAME);
       // echo $current;
        // 把当前的控制器/方法名 和  我们不需要验证登录的地址进行比较
        if (in_array($current, $nocheck)) {
            return; // 阻止函数继续执行下去，因为这里的页面表示不需要登录验证
        }

        // 登录验证
        if (session('is_login') != 1) {
            $this->error('您尚未登录！请登录', U('index/login'));
            die;
        }
    }
 public function checkAuth(){
       $nocheck = array(
           'index-top',
           'index-left',
           'index-main',
           'index-login',
           'index-logout',
           'index-verify',
           'admin-findpassword',
           'admin-resetpassword',
       );
       $current = strtolower(CONTROLLER_NAME . '-' . ACTION_NAME);
       if(in_array($current, $nocheck ) ){
           return;
       }
       $role_id = I('role_id');
       $role_info = D('Role')->find($role_id);
       if(session('username') != 'amdin'&& strpos(strtolower($role_info['auth_vals']),$current)===false){
        $this->error('对不起,您的权限不足不能操作当前页面');
       }
   }
}
