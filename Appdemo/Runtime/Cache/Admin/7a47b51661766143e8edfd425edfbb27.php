<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <link href="/Public/Admin/css/style.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript" src="/Public/Admin/js/jquery.js"></script>
</head>

<body>
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="#">首页</a></li>
            <li><a href="<?php echo U('GoodsCategory/index');?>">商品分类</a></li>
            <li>添加</li>
        </ul>
    </div>
    <div class="formbody">
        <div class="formtitle"><span>基本信息</span></div>
        <form action="" method="post">
            <ul class="forminfo">
                <li>
                    <label>分类名称</label>
                    <input name="cate_name" placeholder="请输入分类名称" type="text" class="dfinput" /></li>
                <li>
                    <label>父级分类</label>
                    <select name="cate_pid" class="dfinput">
                        <option value="0">作为顶级</option>
                        <?php if(is_array($GoodsCategoryList)): $i = 0; $__LIST__ = $GoodsCategoryList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["cate_id"]); ?>"><?php echo (str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$vo["level"]*3)); echo ($vo["cate_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <i></i></li>
                <li>
                    <label>是否显示在前台</label>
                    <select name="is_show" class="dfinput" />
                        <option value="1">显示</option>
                        <option value="0">隐藏</option>
                    </select>
                    <i></i>
                </li>
                <li>
                    <label>是否作为导航</label>
                    <select name="is_nav" class="dfinput" />
                    <option value="1">是</option>
                    <option value="0">否</option>
                    </select>
                    <i></i>
                </li>
                <li>
                    <label>&nbsp;</label>
                    <input name="" id="btnSubmit" type="button" class="btn" value="确认保存" />
                </li>
            </ul>
        </form>
    </div>
</body>
<script type="text/javascript">
//jQuery代码
$(function(){
    //给btnsubmit绑定点击事件
    $('#btnSubmit').on('click',function(){
        //表单提交
        $('form').submit();
    })
});
</script>
</html>