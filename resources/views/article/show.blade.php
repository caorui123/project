<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>tab</title>
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="external nofollow" rel="external nofollow" >
</head>
<style type="text/css">
    table{margin: auto;}
</style>
<body class="text-center">
<a href="/article/add"><span style="font-size: 30px;">添加文章</span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="/logout"><span style="font-size: 30px;">退出</span></a>
<table border="2" cellspacing="0"  style="width: 500px;">
    <tr>
        <th width="5px;" style="text-align: center">序号</th>
        <th width="50px;" style="text-align: center">标题</th>
        <th width="30px;" style="text-align: center">作者</th>
        <th width="50px;" style="text-align: center">添加时间</th>
        <th width="100px;" style="text-align: center">操作</th>
    </tr>
    <?php foreach ($student as $key=>$value){?>
    <tr>
        <td style="text-align: center;width: 10px;" ><?php echo $value->id?></td>
        <td style="text-align: center;width: 10px;" ><?php echo $value->title?></td>
        <td style="text-align: center;width: 10px;" ><?php echo $value->author?></td>
        <td style="text-align: center;width: 10px;" ><?php echo date('Y-m-d',$value->time)?></td>
        <td style="text-align: center;width: 10px;" >
            <a href="/article/del?id=<?php echo $value->id?>">删除</a>&nbsp;&nbsp;&nbsp;
            <a href="/article/update?id=<?php echo $value->id?>">修改</a>
        </td>
    </tr>
    <?php }?>
</table>
<div style="text-align: center">{{ $student->links() }}</div>
</div>
</body>
</html>
