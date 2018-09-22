<?php
/**
 * GoodsType.class.php
 * 文件描述
 * Created on ${DATA} 14:34
 * Create by liaoqianan
 */
namespace Admin\Controller;
use Think\Controller;
class GoodsTypeController extends CommonController{
    public function index(){
        $model = D('GoodsType');
        $count = $model->count();
        //dump($count);die;
        $page = new \Think\Page($count,2);
        $page->setConfig('first','首页');
        $page->setConfig('last','尾页');
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page->setConfig('prev','上一页');
        $page->lastSuffix = false;
        //dump($page);die;
        $typeHTML = $page->show();
        $typelist = $model->limit($page->firstRow,$page->listRows)
                          ->select();
        $this->assign(array(
            'typeHTML' => $typeHTML,
            'typelist' => $typelist,
            'count'    => $count,
        ));
        $this->display();
    }
    public function add(){
        if(IS_POST){
            $model = D('GoodsType');
            //dump($model);die;
            if(!$model->create()){
             // dump($model->create());die;

                $this->error('添加分类失败'.$model->getError());die;
            }

            $id = $model->add();
            //dump($id);die;
            if($id){
                $this->success('分类添加成功',U('GoodsType/index'));die;
            }else{
                $this->error('分类添加失败'.$model->getError());die;
            }
        }

        $this->display();
    }
    public function edit(){
        $id =I('get.id','','intval');
        //dump($id);die;
        if(IS_POST){

        if(!D('GoodsType')->create()){
            dump(D('GoodsType')->create());die;
            $this->error('验证失败'.D('GoodsType')->getError());die;
        }

        $res = D('GoodsType')->save();
        //dump($res);die;
        if($res){
            $this->success('编辑成功',U('GoodsType/index'));die;
        }else{
            $this->error('编辑失败'.D('GoodsType')->getError());die;
        }
        }
        $this->info = D('GoodsType')->find();
        //dump($this->info);die;
        $this->display();
    }
    public function del(){
        $id = I('get.id','','intval');
        //dump($id);die;
        $model = D('GoodsType');
        //dump($model);die;
        $data = $model->delete($id);
        //dump($data);die;
        if($data){
            $this->success('删除成功',U('index'));die;
        }else{
            $this->error('删除失败'.$model->getError());die;
        }

    }
}