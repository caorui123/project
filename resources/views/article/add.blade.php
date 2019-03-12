<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Document</title>
</head>
<style>
    input,select,textarea{ margin-top: 15px; }
</style>
<body style="text-align: center">
<form class="am-form am-form-horizontal" method="post" id="myForm" enctype="multipart/form-data">
    <label for="user">标题：</label>
    <input type="text" name="user" id="user" placeholder="标题" maxlength="8"/><br>

    <label for="password">作者：</label>
    <input type="text" name="password" id="password" placeholder="作者"/><br>
    <input type="button" onclick="sub()" class="am-btn am-btn-success" value="提交" /><br>
</form>
</body>
<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
<script>
     function sub() {
        var user = $('#user').val();
        var password = $('#password').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //ajax请求开始
        $.ajax({
            url: "{{url('/article/add')}}", // point to server-side PHP script
            type: "POST",//方法类型
            dataType: "json",//预期服务器返回的数据类型
            data: {"user":user,"password":password},
            success: function (result) {
                console.log(result);//打印服务端返回的数据(调试用)
                if (result.code == 200) {
                    alert("添加成功");
                    window.location.href=result.url;
                }
                ;
            },
            error : function() {
                alert("添加失败！");
            }
        });
    };
</script>
</html>