$(document).ready(function(){

    $.ajax({
        type : "POST",
        contentType : "application/x-www-form-urlencoded",
        url : "/origin/Index/activeGetClasses",
        success : function(res) {
            if(res.status == 200){
                for(let key of res.result){
                    $("#classes_id").append(
                        "<option value="+key['classes_id']+">"+key['classes_name']+"</option>"
                    );
                }

            }
        }
    });

    $("#commit").click(function() {
        layer.msg("请等待邮件发送！");
        $("#remove_warn").remove();
        $("#warn").append(
            "<div class=\"alert alert-success\" role=\"alert\">" +
                "请等待邮件发送！" +
            "</div>"
        );
        var name = $("#name").val();
        var student_id = $("#student_id").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var classes_id = $("#classes_id").val();
        var validate = $("#validate").val();

        $.ajax({
            type : "POST",
            contentType : "application/x-www-form-urlencoded",
            url : "/origin/Index/uniteRegister",
            data : {
                name:name,
                student_id:student_id,
                email:email,
                password:password,
                classes_id:classes_id,
                validate:validate
            },
            success : function(res) {
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
                    layer.msg("警告！"+res.result);
                }else if(res.status == 200){
                    $("#remove_warn").remove();
                    $("#warn").append(
                        "<div class=\"alert alert-success\" role=\"alert\">" +
                            "注册成功，请查看邮箱点击链接进行账号激活！" +
                        "</div>"
                    );
                    layer.msg("注册成功，请查看邮箱点击链接进行账号激活！");
                    setTimeout("location.href='/origin/Index/login'", 2000);
                }
            }
        });

    });
});
