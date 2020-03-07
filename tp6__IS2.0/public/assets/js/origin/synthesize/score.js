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
    var target=theRequest.id;
    var type=theRequest.type;

    $.ajax({
        type : "POST",
        contentType : "application/x-www-form-urlencoded",
        url : "/origin/Synthesize/targetStudent",
        data : {
            target:target,
            type:type
        },
        success : function(res) {
            if(res.status == 200){

                if(type == "zong_ce"){
                    $("#target_name").append(
                        "<h1>给"+res.result+"打分!--这里是综合测评</h1>"
                    );
                }else if(type == "pin_kun"){
                    $("#target_name").append(
                        "<h1>给"+res.result+"投票!--这里是贫困生测评</h1>"
                    );
                }else if(type == "ban_wei"){
                    $("#target_name").append(
                        "<h1>给"+res.result+"投票!--这里是班委测评</h1>"
                    );
                }
            }else{
                layer.msg("仅对18计科一二三班通信工程！");
            }
        }
    });

    if(type == "pin_kun" || type == "ban_wei"){
        $("#input_remove").remove();
        $("#button_remove").remove();
        $("#commit").append(
            "<span class=\"m-r-n-lg\" id=\"button_remove\">投票</span>"
        );
    }

    $("#commit").click(function() {
        var mark = $("#mark").val();
        if(type == "pin_kun" || type == "ban_wei"){
            mark = 100;
        }
        if(mark < 70 || mark >100){
            $("#remove_warn").remove();
            layer.msg("警告！分数不能小于70或大于100！");
            return $("#warn").append(
                "<div id=\"remove_warn\">" +
                    "<div class='alert alert-warning alert-dismissible' role='alert'>" +
                        "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                            "<span aria-hidden='true'>&times;</span>" +
                        "</button>" +
                        "<strong>警告！分数不能小于70或大于100！</strong>" +
                    "</div>" +
                "</div>"
            );
        }

        $.ajax({
            type : "POST",
            contentType : "application/x-www-form-urlencoded",
            url : "/origin/Synthesize/score",
            data : {
                type:type,
                target:target,
                mark:mark
            },
            success : function(res) {

                if(res.status == 200){
                    $("#remove_warn").remove();
                    $("#warn").append(
                        "<div class=\"alert alert-success\" role=\"alert\">" +
                            res.result +
                        "</div>"
                    );
                    layer.msg(res.result);
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
