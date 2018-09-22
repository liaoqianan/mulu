<?php
/**
 * AdminController.class.php
 * 文件描述
 * Created on ${DATA} 12:28
 * Create by liaoqianan
 */
namespace Admin\Controller;
use Think\Controller;
class AdminController extends CommonController{

   public function index(){
       $model = D('Admin');
   /*    $count = $model->count();
       //dump($count);die;
       //数据总量和每页显示数据量
       $page = new \Think\Page($count,10);
       $page->setConfig('first','首页');
       $page->setConfig('prev','上一页');
       $page->setConfig('next','下一页');
       //是否配置尾页内容，false表示不配置
       $page->lastSuffix = false;
       $page->setConfig('last','尾页');
       //每页页码数量
       $page->rollPage = 5;
       $this->show = $page->show();*/
       //dump($this->show);die;
       $this->adminList = $model->alias('a')->join('__ROLE__ r ON r.role_id = a.role_id','left')->select();
       //$this->count = $model->count();
       //dump( $this->adminList);die;
       $this->display();
   }
    public function add(){
        if(IS_POST){
           $model = D('Admin');
           //dump($model);die;
           if(!$model->create()){
               $this->error('管理员添加失败'.$model->getDbError().$model->getError());die;
           }
           $id = $model->add();
           $model->fetchSql($id);
           if($id){
               $this->success('管理员添加成功',U('Admin/index'));die;
           }else{
               $this->error('管理员添加失败'.$model->getDbError().$model->getError());die;
           }
        }
        $this->roleinfo = D('Role')->select();
        $this->display();
    }
    public function edit(){
       $id = I('get.id','','intval');
       if(IS_POST){
           $model = D('Admin');
           if(!$model->create()){
               $this->error('管理员编辑失败！<br>'.$model->getDbError().$model->getError());
           }
           $res = $model->save();
           if($res){
              $this->success('管理员编辑成功！',U('admin/index'));die;
           }else{
               $this->error('管理员编辑失败！<br>'.$model->getDbError().$model->getError());die;
           }
       }
        $this->roleinfo = D('Role')->select();
        $this->info =D('Admin')->find($id);
        $this->display();
    }

    public function del(){
       $id = I('get.id','','intval');
       $model = D('Admin');
       $data = $model->delete($id);
       if($data){
           $this->success('删除成功',U('admin/index'));
       }else{
           $this->error('删除失败'.$model->getDbError().$model->getError());
       }
    }
    public function findpassword(){

        // 判断是否有post数据提交过来
        if( IS_POST ){
            // 1. 验证判断
            $code = I('post.verify');
            $verify = new \Think\Verify();
            if( !$verify->check( $code ) ){
                $this->error( '验证码有误！请重新确认！', U('admin/findpassword') );die;
            }

            // 2. 验证提交上来的用户名是否是一致
            $where = array(
                'username'=> I('post.username'),
                'mail'    => I('post.mail'),
            );
            $info = D('Admin')->where($where)->find();
            if( !$info ){
                $this->error( '帐号或者邮箱有误！', U('admin/findpassword') );die;
            }

            // 邮箱中点击链接的地址
            $findpassword = random( 32 ) .'-'. time();

            // 把当前找回密码的随机串保存给当前用户
            D('Admin')->where('admin_id=' . $info['admin_id'])->setField('password_token',$findpassword);

            $url     = U('Admin/resetpassword', array('id'=>$findpassword ) );
            $host    = 'http://' . $_SERVER['SERVER_NAME'];
            $link    = $host . $url;

            // 邮件正文[邮件里面任何的路径都必须是完整的绝对路径，不管是链接，还是我们的图片]
            $content =<<<MSG
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>找回密码</title>
</head>
<body>
  亲爱的{$info['username']}！<br>您的在我们<a href="$host">京西小商城</a>中申请了找回功能，请点击以下链接尽快完成找回密码操作。<br>
  <a href="$link">点击进入找回密码页面</a>
</body>
</html>
MSG;
            // 发送邮件
            $res = sendMail($info['mail'], '尊敬的客户', '找回密码', $content );
            // 根据发送邮件的返回值，提示用户
            if( $res ){
                $this->success('已经成功发送邮件到您的邮箱了！请尽快完成找回密码操作',3);die;
            }else{
                $this->error('发送邮件失败！请联系网站管理员或网站客服！');die;
            }
        }
        $this->display();

    }

    // 重置密码
    public function resetpassword(){
        // 判断是否有post数据提交
        if( IS_POST ){
            //dump($_POST);die;
            $model = D('Admin');
            // 使用create来接收并校验数据
            if( ! $model->create() ){
                $this->error('重置密码有误，请重新修改！');
            }
            // 数据保存
            $res = $model->save();
            if( $res ){
                // 有可能之前登录过，保留了一些信息，现在重置，最好清空！
                session('username',null );      // 管理员帐号
                session('admin_id',null );      // 管理员ID
                session('role_id',null );       // 管理员角色ID
                session('login_time',null );    // 登录时间
                session('is_login', null );     // 登录状态

                // 修改成功了以后，清空当前一次的找回密码的随机串
                $model->where('admin_id=' . I('post.admin_id') )->setField('password_token',$findpassword);

                $this->success('重置密码成功！请登录！', U('index/login') );die;

            }else{
                $this->error('重置密码失败！');die;
            }
        }

        // 根据地址栏上面的随机串查询管理员的基本信息
        $findpassword = I('get.id');
        // 判断当前$findpassword的有效期

        $this->info = D('Admin')->where("password_token='$findpassword'")->find();
        if( !$this->info ){
            $this->error('请求错误！请重新确认！');die;
        }
        $this->display();
    }
}