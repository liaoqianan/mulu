<?php
/**
 * UserController.php
 * 文件描述
 * Created on ${DATA} 12:37
 * Create by liaoqianan
 */
namespace Home\Controller;
use Think\Controller;
class UserController extends CommonController
{
    public function index(){

        $this->display();
    }
    public function register(){
        if(IS_POST){
            if(strtolower( I('post.sms_code') )!=strtolower( session('sms_code') ) ){
                $this->error('短信验证码错误');die;
            }
            if(time() - session('sms_time')>600){
                $this->error('短信验证码已失效！请重新获取！');die;
            }
            $model = D('User');
            if(!$model->create()){
                $this->error('注册失败'.$model->getError());die;
            }
            $id = $model->add();
            if($id){
                session('sms_code',null);
                session('sms_time',null);
                $this->success('注册成功！',U('User/register'));die;
            }else{
                $this->error('注册失败'.$model->getError());die;
            }
        }
        $this->display();
    }
    // 会员登录页面
    public function login(){
        // 判断是否有post提交数据
        if( IS_POST ){
            // 接收登录信息
            $username = I('username');
            $password = I('password');

            if( $username == '' || $password == '' ){
                $this->error('用户名或密码必须填写！');die;
            }

            // 使用帐号到数据库中查询
            $where = array(
                'user_name' => $username,
            );

            $userInfo = D('User')->where($where)->find();
            // 如果查不出数据
            if( !$userInfo ){
                $this->error('帐号有误！');die;
            }

            // 如果查出数据，则判断密码是否正确
            if( security($password,$userInfo['salt']) == $userInfo['user_pwd'] ){
                // 保存登录状态
                session('user_name',$userInfo['user_name']); // 会员帐号
                session('user_id',$userInfo['user_id']); // 会员ID
                session('user_login',1);   //  会员的登录状态

                // 判断是否要在登录以后跳转到指定页面
                if( session('jump_url') ){
                    $url = U( session('jump_url')  );
                }else{
                    $url = U('User/index');
                }

                $this->success('登录成功！', $url );die;
            }else{
                $this->error('登录失败！');die;
            }

        }
        $this->display();
    }

    public function logout(){
        session('user_id',null);
        session('user_name',null);
        session('user_login',null);
        $this->success('退出成功',U('User/login'));die;
    }

    public function code(){
        if(IS_AJAX){
            if(time()-60 < session('sms_time')){
                $arr = array(
                    'code'  =>0,
                    'msg'   =>'请等待60秒再点击',
                );
                $this->ajaxReturn($arr,'json');
            }
            $code = random(6);
            session('sms_code',$code );
            session('sms_time',time() );
            $mobile = I('get.mobile');
            if(!$mobile){
                $arr = array(
                    'code'  =>0,
                    'msg'   =>'缺少手机号码！',
                );
                $this->ajaxReturn($arr,'json');
            }
            $res = D('User')->where("user_mobile='$mobile'")->count();
            if($res){
                if($res){
                   $arr = array(
                       'code'  =>0,
                       'msg'   =>'此手机号已注册！',
                   );
                   $this->ajaxReturn($arr,'json');
                }
                $res = sendSmsCode( $mobile,'新用户',$code );
                if($res == 'OK'){
                    $arr = array(
                        'code'   =>1,
                        'msg'    =>'发送成功',
                    );
                    $this->ajaxReturn($arr,'json');
                }else{
                    $arr = array(
                        'code'  =>0,
                        'msg'   =>'短信发送失败！',
                    );
                    $this->ajaxReturn($arr,'json');
                }
            }
        }
    }
}