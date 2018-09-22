<?php
/**
 * CommonController.class.php
 * 文件描述
 * Created on ${DATA} 13:40
 * Create by liaoqianan
 */

namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller{

    public function  _initialize(){

        $this->cateList = D('GoodsCategory')->where('is_show=1')->select();
    }
}