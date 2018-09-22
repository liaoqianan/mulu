<?php
namespace Admin\Model;
use Think\Cache\Driver\File;
use Think\Model;
class GoodsModel extends Model{

    //字段映射
	protected $_map = array(
		'price'   =>'goods_price',
		'number'  =>'goods_number',
		'weight'  =>'goods_weight',
	);
	//字段定义
    protected $_fields = array('goods_id', 'sotr', 'goods_name', 'goods_price',
                             'goods_number', 'goods_weight', 'goods_desc', 'brand_id',
                             'cate_id', 'goods_logo_src', 'goods_logo_thumb', 'sale_time',
                             'deleted_at', 'created_at', 'updated_at');
    //定义主键 必须定义主键不然编辑数据的时候会报‘操作错误’
    protected $pk = 'goods_id';
	protected $_validate =array(
        array('goods_name','require','商品名称不能为空！',1, '', 3 ),
        array('goods_name','','商品名称已存在',1,'unique', 3 ),
	);
	protected $_auto = array(
		array('created_at','time',1,'function'),
		array('sale_time','time',3,'function'),
		array('updated_at','strtotime',2,'function'),
	);

    /**
     * @param $data 表单数据
     * @param $options [type] $options [表名和模型名称]
     * @return bool|void
     */
    protected  function _before_insert(&$data,$options ){

        $this->uploadfile($data, $options );

        return true;
    }

    /**
     * @param $data [表单数据]
     * @param $options [表名和模型名称]
     */
    protected function _before_update( &$data, $options ){

        $this->uploadfile( $data, $options );


        if( $_FILES['goods_logo_src']['error'] == 0 ){

            // 删除原来的图片和缩略图
            // 1. 根据商品ID来获取商品的图片信息，商品ID保存在了 $options里面了
            $info = $this->where($options['where'])->find();

            // 删除图片操作，使用unlink操作
            unlink( './Public/' . $info['goods_logo_src']);
            unlink( './Public/' . $info['goods_logo_thumb']);

        }

    }
    protected function uploadfile(&$data,$options ){

        if($_FILES['goods_logo_src']['error'] == 0) {
            //上传配置
            $config = array(
                'exts' => array('jpg', 'jpeg', 'png', 'gif'),
                'rootPath' => './Public/',
                'savePath' => '/Uploads/Goods/',
                'maxSize' => 8 * 1024 * 1024,
            );

            $upload = new \Think\Upload($config);

            $info = $upload->uploadOne($_FILES['goods_logo_src']);
            if ($info) {
                //保存图片地址
                $data['goods_logo_src'] = $info['savepath'] . $info['savename'];

                $image = new \Think\Image();

                $image->open('./Public/' . $data['goods_logo_src']);
                $data['goods_logo_thumb'] = $info['savepath'] . 'thumb_' . $info['savename'];
                $image->thumb(160, 160, 2)->save('./Public/' . $data['goods_logo_thumb']);
            } else {
                $this->error =$upload->getError();
                return false;
            }
        }
    }
}