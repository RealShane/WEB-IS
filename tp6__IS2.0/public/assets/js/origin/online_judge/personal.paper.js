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
    $("#welcome").append(
        "<h1>欢迎：" + $.cookie('unite_login_name') + "!--这里是你做过的试卷</h1>"
    );
    $.ajax({
        type : "POST",
        contentType : "application/x-www-form-urlencoded",
        url : "/origin/OnlineJudge/personalPapers",
        success : function(res) {

            if(res.status == 200){
                var i = 1;var j = 1;
                for(let key of res.result){
                    if(key['status'] == '已判'){
                        $("#judged").append(
                            "<blockquote class='layui-elem-quote'>"+
                                "<a href='/origin/Index/onlineJudgePaper?id="+key['paper_id']+"'>"+i+"、"+key['paper_name']+"</a><br>" +
                                "分数："+key['mark']+
                            "</blockquote>"
                        );
                        i++;
                    }
                    if(key['status'] == '未判'){
                        $("#un_judged").append(
                            "<blockquote class='layui-elem-quote'>"+
                                "<a href='/origin/Index/onlineJudgePaper?id="+key['paper_id']+"'>"+j+"、"+key['paper_name']+"</a><br>" +
                                "状态："+key['status']+
                            "</blockquote>"
                        );
                        j++;
                    }

                }
            }else{
                layer.msg("仅对17/18通信工程开放");
            }
        }
    });
});