<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Document</title>
</head>
<style>
    input,select,textarea{ margin-top: 15px; }
    .ingreen{color:green;}
    .inred{color:red;border:none;background: none;}
    span{display: inline-block;width: 60px;text-align:center;}
</style>
<body style="text-align: center">
<form class="am-form am-form-horizontal" onsubmit="return false" method="post" id="myForm" enctype="multipart/form-data">
    <label for="user">用户名：</label>
    <input type="text" name="user" class="oChxm" id="user" placeholder="最多输入6个字符" /><div class="" type="text" ></div><br>

    <label for="password">密　码：</label>
    <input type="password" name="password" id="password" class="oChphone"  placeholder="最多输入20个字符"/><div class="" type="text" ></div><br>

    <input type="checkbox" name="checkbox" id="checkbox" value="1"/>
    <label for="password">（七天免登录）</label><br>

    <input type="button" onclick="login()" class="am-btn am-btn-success" value="登录" /><br>
</form>
<a href="/register"><span style="color: blue">没有帐号，点击注册</span></a>
</body>
<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
<script src="/js/ocheck.js"></script>
<script>
    function login() {
        var han = /^[\u4e00-\u9fa5]+$/;
        var pwd = /^(\w){6,20}$/;
        if ($('#user').val()!='') {
            var user = $('#user').val();
            if (!han.test(user)) {
                alert("你傻啊，得是汉字")
                return false;
            };
        } else {
            alert('请输入名字');
            return false;
        }
        if ($('#password').val()!='') {
            var password = $('#password').val();
            if (!pwd.test(password)) {
                alert("密码格式错误")
                return false;
            };
        } else {
            alert('请输入密码');
            return false;
        }
        var checkbox=0;
        var ischeck = $("input[type='checkbox']").is(':checked');//false;
        if(ischeck==true)
        {
            checkbox=1;
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            //几个参数需要注意一下
            type: "POST",//方法类型
            dataType: "json",//预期服务器返回的数据类型
            url: "{{url('/login')}}" ,//url
            data: {"user":user,"password":password,"checkbox":checkbox},//提交的数据,
            success: function (result) {
                console.log(result);//打印服务端返回的数据(调试用)
                if (result.code == 200) {
                    alert("登陆成功");
                    window.location.href=result.url;
                }
                if (result.code == 201) {
                    alert(result.message);
                }
                ;
            },
            error : function() {
                alert("账号或密码错误！");
            }
        });
    }
</script>


</html>