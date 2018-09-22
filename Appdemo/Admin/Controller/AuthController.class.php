<?php
/**
 * AuthController.php
 * 文件描述
 * Created on ${DATA} 14:26
 * Create by liaoqianan
 */

namespace Admin\Controller;

use Think\Controller;

class AuthController extends CommonController
{

    public function index(){
        $model = D('Auth');
        $count = $model->count();
       /* $page = new \Think\Page($count,10);
        $page->setConfig('header','首页');
        $page->setConfig('last','尾页');
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $this->show = $page->show();*/
        $this->AuthList = $model->order('auth_id DESC')->select();
        $this->AuthList = getTree($this->AuthList);
        $this->display();
    }

    public function add(){
        if(IS_POST){
            $model = D('Auth');
         if(!$model->create()){
             $this->error('权限添加失败'.$model->getDbError().$model->getError());
         }
         $id = $model->add();
         if($id){
             $this->success('添加成功',U('auth/index'));die;
         }else{
             $this->error('添加失败'.$model->getDbError().$model->getError());die;
         }
        }
        $this->authList = D('Auth')->where('auth_pid=0')->select();
        $this->display();
    }

    public function edit(){
       $id = I('get.id','','intval');
        // dump($id);die;
        if(IS_POST){
            $model = D('Auth');
            if(!$model->create()){
                $this->error('编辑失败'.$model->getDbError().$model->getError());die;
            }
            $data = $model->save();

            if($data){
                $this->success('编辑成功',U('Auth/index'));die;
            }else{
                $this->error('编辑失败'.$model->getDbError().$model->getError());die;
            }
        }
        $this->info = D('Auth')->find($id);
        //dump( $this->info);die;
        $this->authList = D('Auth')->where('auth_pid=0')->select();
        $this->display();
    }

    public function del(){
        $id = I('get.id','','intval');
        $model = D('Auth');
        $id = $model->delete($id);
        if($id){
            $this->success('删除成功',U('Auth/index'));die;
        }else{
            $this->error('删除成功'.$model->getError());die;
        }
    }
}