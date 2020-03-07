$(document).ready(function(){

    var login_type = "type_password";
    $("#type_email").hide();
    $("#type_email_send").hide();

    $("#register").click(function() {
        setTimeout(location.href="/origin/Index/register");
    });

    $("#login_type_change").click(function() {
        login_type = "type_email";
        $("#type_password").hide();
        $("#type_email").show();
        $("[name='captcha']").attr('src',"/captcha?id=" + Math.random());
    });

    $("#login_type_back").click(function() {
        login_type = "type_password";
        $("#type_email").hide();
        $("#type_password").show();
        $("[name='captcha']").attr('src',"/captcha?id=" + Math.random());
    });


    $("#send_email").click(function() {
        layer.msg("请稍微等待验证码...");
        $("#remove_warn").remove();
        $("#warn").append(
            "<div id=\"remove_warn\">" +
                "<div class=\"alert alert-success\" role=\"alert\">" +
                    "<i class=\"icon-cup\"></i>请稍微等待验证码..." +
                "</div>" +
            "</div>"
        );
        login_type = "type_email";
        var email = $("#email").val();
        var validate = $("#validate_send_email").val();

        $.ajax({
            type : "POST",
            contentType : "application/x-www-form-urlencoded",
            url : "/origin/Index/sendEmailRandom",
            data : {
                email:email,
                validate:validate
            },
            success : function(res) {

                if(res.status == 200){
                    layer.msg("信息已发送，请输入验证码！");
                    $("#type_email").hide();
                    $("#email_place").hide();
                    $("#type_email_send").show();
                    $("#remove_warn").remove();
                    $("#warn").append(
                        "<div id=\"remove_warn\">" +
                            "<div class=\"alert alert-success\" role=\"alert\">" +
                                "<i class=\"icon-check\"></i>信息已发送，请输入验证码！" +
                            "</div>" +
                        "</div>"
                    );
                    $("[name='captcha']").attr('src',"/captcha?id=" + Math.random());
                }
                if(res.status == 100){
                    layer.msg("警告！"+res.result);
                    $("#remove_warn").remove();
                    $("#warn").append(
                        "<div id=\"remove_warn\">" +
                            "<div class='alert alert-warning alert-dismissible' role='alert'>" +
                                "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                                    "<span aria-hidden='true'>&times;</span>" +
                                "</button>" +
                                "<strong>警告！</strong>"+res.result+"！" +
                            "</div>" +
                        "</div>"
                    );
                    $("[name='captcha']").attr('src',"/captcha?id=" + Math.random());
                }
            }
        });

    });

    $("[name='commit']").click(function() {
        var url = location.search; //获取url中"?"符后的字串
        var theRequest = new Object();
        if (url.indexOf("?") != -1) {
            var str = url.substr(1);
            strs = str.split("&");
            for(var i = 0; i < strs.length; i ++) {
                theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]);
            }
        }
        var whence=theRequest.type;
        var student_id = $("#student_id").val();
        var password = $("#password").val();
        var email = $("#email").val();
        var random = $("#random").val();
        if(login_type == "type_password"){
            var validate = $("#validate_password").val();
        }else if(login_type == "type_email"){
            var validate = $("#validate_email").val();
        }

        $.ajax({
            type : "POST",
            contentType : "application/x-www-form-urlencoded",
            url : "/origin/Index/uniteLogin",
            data : {
                student_id:student_id,
                password:password,
                email:email,
                random:random,
                login_type:login_type,
                validate:validate
            },
            success : function(res) {

                if(res.status == 200){
                    $.cookie('unite_login_token', res.result['token'], {expires: 1, path: '/'});
                    $.cookie('unite_login_name', res.result['name'], {expires: 1, path: '/'});
                    $.cookie('unite_login_id', res.result['id'], {expires: 1, path: '/'});
                    layer.msg("登陆成功！");
                    $("#remove_warn").remove();
                    $("#warn").append(
                        "<div id=\"remove_warn\">" +
                            "<div class=\"alert alert-success\" role=\"alert\">" +
                                "<i class=\"icon-check\"></i>登陆成功！" +
                            "</div>" +
                        "</div>"
                    );
                    if(whence == "synthesizeIndex"){
                        return setTimeout(location.href="/origin/Index/synthesizeIndex?type=zong_ce", 1000);
                    }
                    if(whence == "origin"){
                        return setTimeout(location.href="/", 1000);
                    }
                    setTimeout(location.href="/origin/Index/"+whence, 1000);
                }
                if(res.status == 100){
                    $("#remove_warn").remove();
                    $("#warn").append(
                        "<div id=\"remove_warn\">" +
                            "<div class='alert alert-warning alert-dismissible' role='alert'>" +
                                "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                                    "<span aria-hidden='true'>&times;</span>" +
                                "</button>" +
                                "<strong>警告！</strong>"+res.result+"！" +
                            "</div>" +
                        "</div>"
                    );
                    layer.msg(res.result);
                }
            }
        });
    });


});
