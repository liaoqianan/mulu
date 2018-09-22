<?php
/**
 * GoodsAttributeController.class.php
 * 文件描述
 * Created on ${DATA} 13:30
 * Create by liaoqianan
 */
namespace Admin\Controller;
use Think\Controller;
class GoodsAttributeController extends CommonController{

    public function index(){
        $model = D('GoodsAttribute');
        $count = $model->count();
        $page = new \Think\Page($count,10);
        $page->setConfig('first','首页');
        $page->setConfig('last','尾页');
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page->lastSuffix = false;
        $PageList = $page->show();
        $AttrList = $model->alias('ga')->join('__GOODS_TYPE__ gt ON ga.type_id = gt.type_id')->limit($page->firstRow,$page->listRows)->select();
        $typeList = D('GoodsType')->select();
        //dump($typeList);die;
        $this->assign(array(
            'PageList' => $PageList,
            'AttrList' => $AttrList,
            'typeList' =>$typeList,
            'count'    =>$count,
        ));

        $this->display();
    }
    public function add(){
        if(IS_POST){
            if(!D('GoodsAttribute')->create()){
                $this->error('添加失败'.D('GoodsAttribute')->getError());die;
            }
            $id =D('GoodsAttribute')->add();
            if($id){
                $this->success('添加成功',U('GoodsAttribute/index'));die;
            }else{
                $this->error('添加失败'.D('GoodsAttribute/index')->getError());die;
            }
        }
        $this->TypeList = D('GoodsType')->select();
        $this->display();
    }
    public function edit(){

        if(IS_POST){

            if(!D('GoodsAttribute')->create()){
                //dump(D('GoodsAttribute')->create());die;
                $this->error('验证失败'.D('GoodsAttribute')->getDbError().D('GoodsAttribute')->getError());die;
            }

            $res = D('GoodsAttribute')->save();
            //dump($res);die;
            if($res){
                $this->success('编辑成功',U('GoodsAttribute/index'));die;
            }else{
                $this->error('编辑失败'.D('GoodsAttribute')->getDbError() . D('GoodsAttribute')->getError());die;
            }
        }

        $id =I('get.id','','intval');
        $this->typeList = D('GoodsType')->select();
        $this->info = D('GoodsAttribute')->find($id);
        $this->display();
    }
    public function del(){
        $id = I('get.id');
        $model = D('GoodsAttribute');
        $data = $model->delete($id);
        if($data){
            $this->success('删除成功',U('GoodsAttribute/index'),1);die;
        }else{
            $this->error('删除失败',$model->getError());die;
        }
    }
    public function getAttr(){
        if(IS_AJAX){
        $type_id = I('get.type_id','','intval');
        $model = D('GoodsAttribute');
        if($type_id){
            $where = 'ga.type_id=' .$type_id;
        }else{
            $where ='';
        }

        $data = $model->alias('ga')->join('__GOODS_TYPE__ gt ON ga.type_id = gt.type_id')->where($where)->select();
        $this->ajaxReturn($data,'json');
        }
    }
}