$(document).ready(function() {
    var token = $.cookie('unite_login_token');
    $.ajaxSetup({
        beforeSend : function(request) {
            request.setRequestHeader("access-token", token);
        },
    });
    $("[name='captcha']").click(function(){
        $("[name='captcha']").attr('src',"/captcha?id=" + Math.random());
    });
    $("[name='captcha_a']").click(function(){
        $("[name='captcha']").attr('src',"/captcha?id=" + Math.random());
    });
    $("#captcha").click(function(){
        $("#captcha").attr('src',"/captcha?id=" + Math.random());
    });
    $("#captcha_a").click(function(){
        $("#captcha").attr('src',"/captcha?id=" + Math.random());
    });
    if(token != null){
        $("#window_login_remove").remove();
        $("#phone_login_remove").remove();
        $("#window_login_set").append(
            "<a id=\"window_login_remove\">" +
                $.cookie('unite_login_name') +
                "<a id='window_quit' href='#'>" +
                    "<i class=\"icon-logout\"></i>退出" +
                "</a>" +
            "</a>"
        );
        $("#phone_login_set").append(
            "<a id=\"phone_login_remove\">" +
                $.cookie('unite_login_name') +
                "<a id='phone_quit' href='#'>" +
                    "<i class=\"icon-logout\"></i>退出" +
                "</a>" +
            "</a>"
        );
    }else{
        $("#window_login_remove").remove();
        $("#phone_login_remove").remove();
        $("#window_login_set").append(
            "<a id=\"window_login_remove\">" +
                "<a href=/origin/Index/login?type=origin>" +
                    "<i class=\"icon-login\"></i>登录" +
                "</a>" +
            "</a>"
        );
        $("#phone_login_set").append(
            "<a id=\"phone_login_remove\">" +
                "<a href=/origin/Index/login?type=origin>" +
                    "<i class=\"icon-login\"></i>登录" +
                "</a>" +
            "</a>"
        );
    }
    $("#window_quit").click(function(){
        $.ajax({
            type : "POST",
            contentType : "application/x-www-form-urlencoded",
            url : "/origin/Index/uniteQuit",
            success : function(res) {
                if(res.status == 200){
                    layer.msg("退出成功！");
                    $.removeCookie('unite_login_token', {path: '/'});
                    $.removeCookie('unite_login_name', {path: '/'});
                    $.removeCookie('unite_login_id', {path: '/'});
                    setTimeout(location.href="/", 1000);
                }
            }
        });
    });
    $("#phone_quit").click(function(){
        $.ajax({
            type : "POST",
            contentType : "application/x-www-form-urlencoded",
            url : "/origin/Index/uniteQuit",
            success : function(res) {
                if(res.status == 200){
                    layer.msg("退出成功！");
                    $.removeCookie('unite_login_token', {path: '/'});
                    $.removeCookie('unite_login_name', {path: '/'});
                    $.removeCookie('unite_login_id', {path: '/'});
                    setTimeout(location.href="/", 1000);
                }
            }
        });
    });

});
