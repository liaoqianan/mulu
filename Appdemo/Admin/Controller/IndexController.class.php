<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){

      $this->display();
    }

    public function top(){

    	$this->display();

    }

    public function left(){
        $role_id = session('role_id');
        $role_info = D('Role')->find($role_id);
        //dump($role_info);die;
        if(session('username')=='admin'){
            $role_info['auth_ids'] = 'all';
            $role_info['auth_vals'] = 'all';
        }
        if($role_info['auth_ids']=='all'){
            $topAuth = D('Auth')->where("auth_pid=0")->select();
        }else{
            $topAuth = D('Auth')->where("auth_pid=0 AND auth_id IN ({$role_info['auth_ids']})")->select();
        }
        if($role_info['auth_ids']== 'all' ){
            $sonAuth = D('Auth')->where("auth_pid!=0")->select();
        }else{
            $sonAuth = D('Auth')->where("auth_pid!=0 AND auth_id IN ({$role_info['auth_ids']})")->select();
        }
        $this->assign('topAuth',$topAuth);
        $this->assign('sonAuth',$sonAuth);
    	$this->display();
    }

    public function main(){

    	$this->display();
    }

    public function login(){
        // 判断是否有post提交数据
        if( IS_POST ){
            // 1. 验证码进行判断
            $code = I('verify');
            $verify = new \Think\Verify();
            // 判断验证码是否正确
            if(!$verify->check( $code )){
                $this->error('验证码有误！',U('Index/login') );die;
            }
            // 2. 接收提交的管理员帐号，并查询该管理员的信息
            $username = I('post.username');
            $info = D('Admin')->where("username='$username'")->find();
           // dump( $info);die;
            if(!$info){
                $this->error('帐号或密码有误！', U('Index/login') );die;
            }
            // 3. 判断密码是否正确
            $password = I('post.password');

            if( security($password, $info['salt']) == $info['password'] ){
                echo 11111;
                // 保存登录状态
                session('username',$info['username']);      // 管理员帐号
                session('admin_id',$info['admin_id']);      // 管理员ID
                session('role_id',$info['role_id']);        // 管理员角色ID
                session('login_time',$info['login_time']);  // 登录时间
                session('is_login', 1 );                    // 登录状态

                $data = array( 'login_time'=>time() );
                // 更新登录时间
                D('Admin')->where("admin_id=" . $info['admin_id'])->save( $data ); // 也可以使用setFields()

                $this->success('登录成功！', U('Index/index') );die;

            }else{

                $this->error('帐号或密码有误！', U('Index/login') );die;

            }

        }
        $this->display();
    }


    public function logout(){
        session('username',null);
        session('role_id',null);
        session('admin_id',null);
        session('login_time',null);
        session('is_login',null);
        $this->success('退出成功',U('Index/login'));die;
    }
    public function verify(){
        $config = array(
            'length' => 2,     // 设置验证码的位数
            // 验证码字体使用 ThinkPHP/Library/Think/Verify/zhttfs/
            'useZh'  => false,  // 设置使用中文验证码
        );
        // 实例化验证码类
        $verify = new \Think\Verify( $config );

        // 生成验证码
        $verify -> entry();

    }

}