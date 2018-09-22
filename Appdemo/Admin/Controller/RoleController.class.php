<?php
/**
 * RoleController.class.php
 * 文件描述
 * Created on ${DATA} 22:39
 * Create by liaoqianan
 */
namespace Admin\Controller;
use Think\Controller;

class RoleController extends CommonController
{

    public function index(){

        $this->RoleList = D('Role')->select();
        $this->display();
    }

    public function add(){

        if(IS_POST){
            $model = D('Role');
            if(!$model->create()){
                $this->error('角色添加失败'.$model->getDbError().$model->getError());die;
            }
            $id = $model->add();
            if($id){
                $this->success('角色添加成功',U('Role/index'));die;
            }else{
                $this->error('角色添加失败'.$model->getDbError().$model->getError());die;
            }
        }
        $this->display();
    }

    public function edit(){

        $id = I('get.id','','intval');
       // dump($id);die;
        if(IS_POST){
            $model = D('Role');
            if(!$model->create()){
                $this->error('角色编辑失败'.$model->getDbError().$model->getError());
            }
            $res = $model->save();
            if($res){
                $this->success('角色编辑成功',U('Role/index'));die;
            }else{
                $this->error('角色编辑失败'.$model->getDbError().$model->getError());die;
            }
        }
        $this->info = D('Role')->find($id);
        //dump($this->info);die;
        $this->display();
    }

    public function del(){
        $id = I('get.id','','intval');
        $model = D('Role');
        $data = $model->delete($id);
        if($data){
            $this->success('角色删除成功',U('Role/index'));die;
        }else{
            $this->error('角色删除成功'.$model->getDbError().$model->getError());die;
        }
    }

    public function setAuth(){

        // 判断是否有post数据提交
        if( IS_POST ){
            // 接收所有表单中提交上来的权限ID
            $auth_id = I('auth_id');

            // 转换成字符串，方便存储到数据表中
            $auth_ids = implode( ',',$auth_id );
            // 把 $auth_ids 作为 in语句的条件，获取所有的普通权限名称
            $auth_vals = D('Auth')->where("auth_pid!=0 AND auth_id IN ($auth_ids)")->select();

            // 把 $auth_vals 中所有的权限转换成类似 Goods-index 这种格式
            $auth_ac   = ''; // 用来存储转换后的权限名称
            foreach( $auth_vals as $key => $value ){

                $auth_ac .= $value['auth_controller'] . '-' . $value['auth_action'] . ',';
            }

            // 去掉权限名称后面的,
            $auth_ac = trim($auth_ac,',');

            // 整理数组
            $data = array('auth_ids'=>$auth_ids, 'auth_vals'=> $auth_ac );
            //dump($data);die;
            $res = D('Role')->where('role_id='.I('post.role_id') )->save($data);
            if( $res ){
                $this->success('分配权限成功!',U('Role/index') );die;
            }else{
                $this->error('分配权限失败！');die;
            }

        }
        // 接收角色ID，查询对应角色的信息
        $role_id = I('get.id','','intval');
        $this->roleInfo = D('Role')->find( $role_id );
        //dump($this->roleInfo);die;
        // 获取顶级权限信息
        $this->topAuth = D('Auth')->where('auth_pid=0')->select();
        //dump($this->topAuth);die;
        // 获取普通权限信息
        $this->sonAuth = D('Auth')->where('auth_pid!=0')->select();
        //dump($this->sonAuth);die;
        $this->display();
    }


}