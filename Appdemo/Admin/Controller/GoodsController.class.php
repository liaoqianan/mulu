<?php 
namespace Admin\Controller;
use Think\Controller;
use Think\Page;

class GoodsController extends CommonController{
	//商品首页
	public function index(){
		//实例goods模型
		$model = D('Goods');
		//dump($model);
		//查询到所有数据
		$count = $model->count();
		//dump($count);die;
		//数据总量和每页显示数据量
		$page = new Page($count,5);
		$page->setConfig('first','首页');
		$page->setConfig('prev','上一页');
		$page->setConfig('next','下一页');
		//是否配置尾页内容，false表示不配置
		$page->lastSuffix = false;
		$page->setConfig('last','尾页');
		//每页页码数量
		$page->rollPage = 5;
		//显示分页
		$this->assign('count',$count);
		$this->pagelist = $page->show();
		//dump($this->pagelist);die;
		//查询出的分页数据
		$this->goodslist = $model->where('deleted_at = 0')
		              ->order('sotr ASC,goods_id DESC')
		              ->limit($page->firstRow.','.$page->listRows)
		              ->select();  
		             // dump($this->goodslist);die;        
		$this->display(); 
	}
	public function add(){
		$model = D('Goods');
		if(IS_POST){
            //dump($model->create());die;
			if(!$model->create()){

				$this->error('添加失败！<br>'.$model->getError());die;
			}
				$id = $model->add();
				//dump($id);die;
				if($id){
				    D('GoodsAttributeRelation')->addAttr($id);
					$this->success('添加成功',U('Goods/index'));die;
				}else{
					$this->error('添加失败'.$model->getError());die;
				}
		}

		$this->TypeList = D('GoodsType')->select();
		$this->display();
	}

    /**
     *
     */
    public function edit(){

        $id = I('get.id','','intval'); // intval 把变量转成整数

        // 判断是否post提交过来的数据
        if( IS_POST ){

            // 使用create来接收数据
            if( !D('Goods')->create() ){
                //dump(D('Goods')->create());die;
                $this->error( '商品编辑失败！<br>'. D('Goods')->getError() );die;
            }

            // 保存商品数据[ 使用save，save会根据我们是否包含了id来判断是否是编辑操作 ]
            $res = D('Goods')->save();

            // 根据结果进行页面跳转
            if( $res ){
               $model = D('GoodsAttributeRelation');
               $model->addAttr($res);
                $this->success('商品编辑成功！', U('Goods/index') );die;
            }else{
                $this->error('商品编辑失败！' . D('Goods')->getError() );die;
            }

        }

        $this->TypeList = D('GoodsType')->select();
        //dump($this->TypeList);die;
        $this->info = D('Goods')->find( $id );
        //dump($this->info);die;
        $this->display();
	}
	public function del(){
        $id  = I('get.id');
        //dump($id);die;
        $model = D('Goods');
        $info = $model->where('goods_logo_src')->find($id);
       if(!$info){
           $this->error('图片删除失败');die;
       }else {
           unlink('./Public/' . $info['goods_logo_src']);
           unlink('./Public/' . $info['goods_logo_thumb']);
       }
           $data = $model->delete($id);

           if ($data) {
               $this->success('商品删除成功', U('Goods/index'));
               die;
           } else {
               $this->error('商品删除失败' . $model->getError());
               die;
           }
	}
	public function pics(){
	    if(IS_POST){
	        /*这里不需要使用create()方法因为这里没有上传其他信息只是上传文件
	         *上传文件保存在了$_FILES中
	         * 直接上传文件
	         */
	        if($_FILES['pics']['error']['0'] == 0){
                //上传所需的配置信息
                $config = array(
                    'exts'     =>array('gif','png','jpg','jpeg'),//上传格式
                    'maxSize'  =>8*1024*1024,//上传大小
                    'rootPath' =>'./Public/',//文件存储目录【这里不会自动创建】
                    'savePath' =>'/Uploads/GoodsPics/'//文件存储目录【这里会自动创建】
                );
                //实例化上传类
                $upload = new \Think\Upload($config);
                //dump($upload);die;
                $info = $upload->upload();
                //dump($info);die;
                $data =array();
                $goods_id = I('post.goods_id','','intval');
                $image = new \Think\Image();
                //dump($image);die;
                foreach( $info as $v){
                   $image->open( './Public/' . $v['savepath'] . $v['savename']);

                   $pics_md = $v['savepath'] .'md_' . $v['savename'];
                   $image->thumb(350,350,2)->save('./Public/' .$pics_md);

                   $pics_sm = $v['savepath'] .'sm_' . $v['savename'];
                   $image->thumb(54,54,2)->save('./Public/' .$pics_sm);
                    $data[] = array(
                        'pics_bg' => $v['savepath'] . $v['savename'],
                        'pics_md' => $pics_md,
                        'pics_sm' => $pics_sm,
                        'goods_id'=> $goods_id,
                    );
                    //dump($data);die;


                }
                $model = D('GoodsPics');
                $model->addAll($data);
            }

        }

       $goods_id = I('get.id','','intval');
	    $model = D(GoodsPics);
        $info = $model->where("goods_id=$goods_id")->select();

        $this->assign('info',$info);
	    $this->display();
    }
    public function delpics(){
	    $id = I('get.id','','intval');
	    $model = D('GoodsPics');
	    $info = $model->find($id);
	    if(!$info){
	        echo 0;
        }else{
	       $res = D('GoodsPics')->delete($id);
	        if( $res ) {
                unlink('./Public/' . $info['pics_bg']);
                unlink('./Public/' . $info['pics_md']);
                unlink('./Public/' . $info['pics_sm']);
                echo 1;
            }else{
            echo 0;
            }
        }
    }
}