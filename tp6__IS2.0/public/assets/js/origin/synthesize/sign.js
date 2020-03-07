$(document).ready(function() {

    $.ajax({
        type : "POST",
        contentType : "application/x-www-form-urlencoded",
        url : "/origin/Synthesize/tokenCheck",
        success : function(res) {
            if(res == "越权操作！"){
                layer.msg("越权操作！");
                $(window).attr('location','/origin/Index/login?type=synthesizeIndex');
            }
        }
    });

    var url = location.search; //获取url中"?"符后的字串
    var theRequest = new Object();
    if (url.indexOf("?") != -1) {
        var str = url.substr(1);
        strs = str.split("&");
        for(var i = 0; i < strs.length; i ++) {
            theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]);
        }
    }
    var type=theRequest.type;

    if(type == "pin_kun_sign"){
        $("#sign_title").append(
            "<h1>贫困生报名</h1>"
        );
        $("#ban_wei_form").hide();
    }
    if(type == "ban_wei_sign"){
        $("#sign_title").append(
            "<h1>班委报名</h1>"
        );
        $("#pin_kun_form").hide();
    }
    $("#pin_kun_situation_other").hide();
    $('#pin_kun_situation').change(function(){
        var pin_kun_situation = $("#pin_kun_situation").val();
        if(pin_kun_situation == "其他情况"){
            $("#pin_kun_situation_other").show();
        }else{
            $("#pin_kun_situation_other").hide();
        }
    })

    $("[name='commit']").click(function() {
        var pin_kun_message = $("#pin_kun_message").val();
        var pin_kun_situation = $("#pin_kun_situation").val();
        if(pin_kun_situation == "其他情况"){
            pin_kun_situation = $("#pin_kun_situation_other").val();
        }
        var ban_wei_message = $("#ban_wei_message").val();
        var ban_wei_situation = $("#ban_wei_situation").val();
        $.ajax({
            type : "POST",
            contentType : "application/x-www-form-urlencoded",
            url : "/origin/Synthesize/signPKBW",
            data : {
                pin_kun_message:pin_kun_message,
                pin_kun_situation:pin_kun_situation,
                ban_wei_message:ban_wei_message,
                ban_wei_situation:ban_wei_situation,
                type:type
            },
            success : function(res) {
                if(res.status == 200){
                    layer.msg(res.result);
                    $("#remove_warn").remove();
                    $("#warn").append(
                        "<div class=\"alert alert-success\" role=\"alert\">" +
                            res.result +
                        "</div>"
                    );
                    if(type == "pin_kun_sign"){
                        type = "pin_kun";
                    }
                    if(type == "ban_wei_sign"){
                        type = "ban_wei";
                    }
                    setTimeout(location.href="/origin/Index/synthesizeIndex?type="+type, 1000);
                }
                if(res.status == 100){
                    $("#remove_warn").remove();
                    $("#warn").append(
                        "<div id=\"remove_warn\">" +
                            "<div class='alert alert-warning alert-dismissible' role='alert'>" +
                                "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                                    "<span aria-hidden='true'>&times;</span>" +
                                "</button>" +
                                "<strong>"+res.result+"</strong>" +
                            "</div>" +
                        "</div>"
                    );
                    layer.msg(res.result);
                }
            }
        });
    });
});

