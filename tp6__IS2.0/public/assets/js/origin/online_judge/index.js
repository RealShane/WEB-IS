$(document).ready(function() {
    $.ajax({
        type : "POST",
        contentType : "application/x-www-form-urlencoded",
        url : "/origin/Synthesize/tokenCheck",
        success : function(res) {
            if(res == "越权操作！"){
                layer.msg("越权操作！");
                $(window).attr('location','/origin/Index/login?type=onlineJudgeIndex');
            }
        }
    });

    $.ajax({
        type : "POST",
        contentType : "application/x-www-form-urlencoded",
        url : "/origin/OnlineJudge/rankList",
        success : function(res) {

            if(res.status == 200){
                var i = 0, j = 1;
                for(let key of res.result){
                    if(i >= 10){
                        break;
                    }
                    $("#rank_list").append(
                        "<blockquote class='layui-elem-quote'>" +
                            "<a>"+j+"、姓名："+key['name']+"&nbsp;&nbsp;总分："+key['mark']+"</a>" +
                        "</blockquote>"
                    );
                    i++;j++;
                }
            }else{
                layer.msg("仅对17/18通信工程开放");
            }
        }
    });

});