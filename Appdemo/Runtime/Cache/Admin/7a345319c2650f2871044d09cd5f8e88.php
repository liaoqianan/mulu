<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <link href="/Public/Admin/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $(".click").click(function() {
            $(".tip").fadeIn(200);
        });

        $(".tiptop a").click(function() {
            $(".tip").fadeOut(200);
        });

        $(".sure").click(function() {
            $(".tip").fadeOut(100);
        });

        $(".cancel").click(function() {
            $(".tip").fadeOut(100);
        });

    });
    </script>
</head>

<body>
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="<?php echo U(Index/main);?>">首页</a></li>
            <li><a href="<?php echo U('GoodsCategory/index');?>">商品分类</a></li>
            <li></li>
        </ul>
    </div>
    <div class="rightinfo">
        <div class="tools">
            <ul class="toolbar">
                <li><a href="<?php echo U('GoodsCategory/add');?>"><span><img src="/Public/Admin/images/t01.png" /></span>添加</a></li>
                <li><span><img src="/Public/Admin/images/t02.png" /></span>修改</li>
                <li><span><img src="/Public/Admin/images/t03.png" /></span>删除</li>
                <li><span><img src="/Public/Admin/images/t04.png" /></span>统计</li>
            </ul>
        </div>
        <table class="tablelist">
            <thead>
                <tr>
                    <th>
                        <input name="" type="checkbox" value="" id="checkAll" />
                    </th>
                    <th>编号</th>
                    <th>分类名称</th>
                    <th>是否在前台展示</th>
                    <th>是否作为导航</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            <?php if(is_array($GoodsCategoryList)): $i = 0; $__LIST__ = $GoodsCategoryList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td>
                        <input name="" type="checkbox" value="{vo.cate_id}" />
                    </td>
                    <td><?php echo ($vo["cate_id"]); ?></td>
                    <td><?php echo (str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$vo["level"]*3)); echo ($vo["cate_name"]); ?></td>
                    <td><?php echo ($vo["is_show"]); ?></td>
                    <td><?php echo ($vo["is_nav"]); ?></td>
                    <td><a href="<?php echo U('GoodsCategory/edit','id=' . $vo['cate_id']);?>" class="tablelink">编辑</a>
                        <a href="<?php echo U('GoodsCategory/del','id=' . $vo['cate_id']);?>" class="tablelink"> 删除</a>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
        <div class="tip">
            <div class="tiptop"><span>提示信息</span>
                <a></a>
            </div>
            <div class="tipinfo">
                <span><img src="/Public/Admin/images/ticon.png" /></span>
                <div class="tipright">
                    <p>是否确认对信息的修改 ？</p>
                    <cite>如果是请点击确定按钮 ，否则请点取消。</cite>
                </div>
            </div>
            <div class="tipbtn">
                <input name="" type="button" class="sure" value="确定" />&nbsp;
                <input name="" type="button" class="cancel" value="取消" />
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('.tablelist tbody tr:odd').addClass('odd');
    </script>
</body>

</html>