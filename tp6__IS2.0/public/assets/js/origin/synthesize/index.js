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
    if(type == "zong_ce"){
        $("#username").append(
            "<h1>欢迎："+$.cookie('unite_login_name')+"!--这里是综合测评</h1>"
        );
    }else if(type == "pin_kun"){
        $("#username").append(
            "<h1>欢迎："+$.cookie('unite_login_name')+"!--这里是贫困生测评</h1>"
        );
    }else if(type == "ban_wei"){
        $("#username").append(
            "<h1>欢迎："+$.cookie('unite_login_name')+"!--这里是班委测评</h1>"
        );
    }

    $.ajax({
        type : "POST",
        contentType : "application/x-www-form-urlencoded",
        url : "/origin/Synthesize/allStudent",
        data : {
            type:type
        },
        success : function(res) {

            if(res.status == 200){
                for(let key of res.result){
                    $("#student_set").append(
                        "<div class=\"col-lg-4 col-md-6\">" +
                            "<div class=\"office-box\">" +
                                "<h5>"+key['name']+"</h5>" +
                                "<a href=\"/origin/Index/synthesizeScore?id="+key['id']+"&type="+type+"\"><i class=\"fas fa-code\"></i>评分</a> " +
                            "</div>" +
                        "</div>"
                    );
                }
            }else{
                layer.msg("仅对18计科一二三班通信工程！");
            }

        }
    });


});

