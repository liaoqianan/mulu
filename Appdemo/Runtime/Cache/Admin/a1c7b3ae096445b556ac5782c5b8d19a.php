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
            <li><a href="<?php echo U(Index/index);?>">首页</a></li>
            <li><a href="#">数据表</a></li>
            <li><a href="#">基本内容</a></li>
        </ul>
    </div>
    <div class="rightinfo">
        <div class="tools">
            <ul class="toolbar">
                <li><span><img src="/Public/Admin/images/t01.png" /></span><a href="<?php echo U('Goods/add');?>">添加</a></li>
                <li><span><img src="/Public/Admin/images/t02.png" /></span><a href="<?php echo U('Goods/edit');?>">修改</a></li>
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
                    <th>商品ID</th>
                    <th>商品名称</th>
                    <th>logo</th>
                    <th>商品价格</th>
                    <th>商品数量</th>
                    <th>添加时间</th>
                    <th>是否上架</th>
                    <th>商品排序</th>
                    <th>操作</th>

                </tr>
            </thead>
            <tbody>
                <?php if(is_array($goodslist)): $i = 0; $__LIST__ = $goodslist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td>
                        <input name="" type="checkbox" value="<?php echo ($vo["goods_id"]); ?>" />
                    </td>
                    <td><?php echo ($vo["goods_id"]); ?></td>
                    <td><?php echo ($vo["goods_name"]); ?></td>
                    <td><img src="/Public/<?php echo ($vo["goods_logo_thumb"]); ?>" alt=""/></td>
                    <td><?php echo ($vo["goods_price"]); ?></td>
                    <td><?php echo ($vo["goods_number"]); ?></td>
                    <td><?php echo (date('Y-m-d H:i:s',$vo["created_at"])); ?></td>
                    <td>
                        <?php if($vo['sale_time']==0): ?>下架 
                         <?php else: ?>      
                        <?php echo (date('Y-m-d H:i:s',$vo["sale_time"])); endif; ?>
                    </td>
                    <td><?php echo ($vo["sotr"]); ?></td>
                    <td>
                        <a href="<?php echo U('Goods/edit','id='.$vo['goods_id']);?>" class="tablelink">编辑</a>
                        <a href="#" class="tablelink">查看</a>
                        <a href="<?php echo U('Goods/pics','id='.$vo[goods_id]);?>">相册</a>
                        <a href="<?php echo U('Goods/del','id='.$vo['goods_id']);?>" class="tablelink">删除</a>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>    
            </tbody>
        </table>
        <div class="pagin">
            <div class="message">共<i class="blue"><?php echo ($count); ?></i>条记录，当前显示第&nbsp;<i class="blue"><?php echo ((isset($_GET['p']) && ($_GET['p'] !== ""))?($_GET['p']):1); ?>&nbsp;</i>页
            </div>
            <style type="text/css">
            .paginList div span,
            .paginList div a{    
                float: left;
                width: auto;
                padding: 2px 8px; 
                height: 28px;
                border: 1px solid #DDD;
                text-align: center;
                line-height: 30px;
                border-left: none;
                color: #3399d5;
            }
            .paginList div a:last-child,
            .paginList div span:last-child{
                border-bottom-right-radius: 5px;
                border-top-right-radius: 5px;
            }
            .paginList div a:first-child,
            .paginList div span:first-child{
                border-left: 1px solid #DDD;
                border-bottom-left-radius: 5px;
                border-top-left-radius: 5px;
            }
            .paginList div .current{
                background: #f5f5f5;
                cursor: default;
                color: #737373;
            }
            </style>
            <div class="paginList">
                <ul>
                 <?php echo ($pagelist); ?>
                </ul>
            </div>
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