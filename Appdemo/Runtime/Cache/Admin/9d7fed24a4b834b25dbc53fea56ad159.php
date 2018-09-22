<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>商品相册</title>
    <link href="/Public/Admin/css/style.css" rel="stylesheet" type="text/css" />
    <!--灯箱插件-->
    <link rel="stylesheet" href="/Public/Puice/lightbox/css/lightbox.css" />
   <script language="JavaScript" src="/Public/Admin/js/jquery.js"></script>
    <!--<script src=/Public/Puice/lightbox/js/lightbox-plus-jquery.js"></script>-->
    <style>
        .add,.sub{
            vertical-align:top;
            cursor: pointer;
        }
        .imglist li{
            width: auto;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="#">首页</a></li>
            <li><a href="#">商品管理</a></li>
            <li><a href="#">商品相册</a></li>
        </ul>
    </div>
    <div class="formbody">
        <ul class="imglist">
            <?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li >
                    <img class="pics" data-id="<?php echo ($vo["pics_id"]); ?>" width="15" src="/Public/Admin/images/t03.png" alt="" />
                    <a href="/Public/<?php echo ($vo["pics_bg"]); ?>" data-lightbox='my' data-title='my'/>
                    <img src="/Public/<?php echo ($vo["pics_sm"]); ?>" />
                    </a>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <form action="" method="post" enctype="multipart/form-data">
            <ul class="forminfo">
                <li>
                    <img class="add" src="/Public/Admin/images/t01.png" alt="" />
                    <input type="file" name="pics[]" />
                </li>
            </ul>
            <ul>
                <li>
                    <label>&nbsp;</label>
                    <input type="hidden" name="goods_id" value="<?php echo ($_GET['id']); ?>">
                    <input id="btnSubmit" type="submit" class="btn" value="确认保存" />
                </li>
            </ul>
        </form>
    </div>
</body>
<script>
    //点击
    $('.add').on('click',function(){
        $(this).parent()
               .clone()
               .find('img').attr('src','/Public/Admin/images/t03.png')
               .removeClass('add').addClass('sub')
               .parent()
               .appendTo('.forminfo');
    });

    // 动态减少文件上传框
    $('.forminfo').on('click','.sub',function(){
        $(this).parent().remove();  // 把当前被点击的img的父级元素li移除掉
    });

    //点击li发送ajax删除相册图片
  $('.pics').on('click',function(){
      if( !confirm('确定要删除这张图片吗？')){
        return false;
      }
      var _this = $(this);
     var pics_id = $(this).attr('data-id');

     $.get('/index.php/Admin/Goods/delpics',{'id':pics_id},function(msg){

       if(msg == 1){
            _this.parent().remove();
       }else{
           alert('删除图片失败！');
       }
     });
  });

</script>
<script type="text/javascript" src="/Public/Puice/lightbox/js/lightbox.js"></script>
</html>