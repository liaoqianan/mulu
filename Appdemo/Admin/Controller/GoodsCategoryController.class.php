<?php
/**
 * GoodsCategoryController.php
 * 文件描述
 * Created on ${DATA} 14:19
 * Create by liaoqianan
 */
namespace Admin\Controller;
use Think\Controller;

class GoodsCategoryController extends Controller
{

    public function index(){
        $model = D('GoodsCategory');
        //dump($model);die;
        $this->GoodsCategoryList = $model->order('cate_id DESC')->select();
        //dump( $this->GoodsCategoryList);die;
        $this->GoodsCategoryList =  getCateTree( $this->GoodsCategoryList);
        //dump( $this->GoodsCategoryList);die;
        $this->display();
}

    public function add(){
        if(IS_POST){
            //dump($_POST);die;
            if(!D('GoodsCategory')->create()){
               // dump(D('GoodsCategory')->create());die;
                $this->error('添加错误'.D('GoodsCategory')->getError());die;
            }
            $id = D('GoodsCategory')->add();
            if($id){
                $this->success('添加成功',U('GoodsCategory/index'));die;
            }else{
                $this->error('添加错误'.D('GoodsCategory')->getError());die;
            }
        }
        //$this->topGoodsCategory = D('GoodsCategory')->where("cate_pid=0")->select();
        $this->GoodsCategoryList = D('GoodsCategory')->order('cate_id DESC')->select();
        $this->GoodsCategoryList =  getCateTree(  $this->GoodsCategoryList,0,0,'cate_pid','cate_id' );
        $this->display();
    }

    public function edit(){
        $id = I('get.id','','intval');
        if(IS_POST){
            //dump($_POST);die;
            $model = D('GoodsCategory');
            //dump( $model);die;
            if(!$model->create()){
                //dump($model->create());die;
                $this->error('编辑出错'.$model->getError());die;
            }
            $res = $model->save();
            //dump($res);die;
            if($res){
                $this->success('编辑成功',U('GoodsCategory/index'));die;
            }else{
                $this->error('编辑失败'.$model->getError());die;
            }
        }
        $this->info = D('GoodsCategory')->find($id);
        $this->GoodsCategoryList = D('GoodsCategory')->order('cate_id DESC')->select();
        $this->GoodsCategoryList =  getCateTree(  $this->GoodsCategoryList );
        $this->display();
    }

    public function del(){
        $id = I('get.id','','intval');
        $model = D('GoodsCategory');
        $info = $model->delete($id);
        if($info){
            $this->success('删除成功',U('GoodsCategory/index'));die;
        }else{
            $this->error('删除失败'.$model->getError());
        }
    }

}