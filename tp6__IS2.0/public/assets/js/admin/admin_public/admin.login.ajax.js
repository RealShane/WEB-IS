$(document).ready(function(){

    $("#login_send").click(function(){
        var username = $("#username").val();
        var password = $("#password").val();
        var validate = $("#validate").val();

        $.ajax({
            type : "POST",
            contentType : "application/x-www-form-urlencoded",
            url : "/admin/AdminBaseAccess/adminLogin",
            data : {
                username:username,
                password:password,
                validate:validate
            },
            success : function(res) {
                console.log(res);
                if(res.status == 0){
                    $("#remove").remove();
                    $("#alert").append(
                        "<div id='remove'><p>"+res.result+"</p></div>"
                    );
                    $("#captcha").attr('src',"/captcha?id=" + Math.random());

                }else if(res.status == 200){
                    $(window).attr('location','/admin/Index');
                }

            }
        });

    });


});