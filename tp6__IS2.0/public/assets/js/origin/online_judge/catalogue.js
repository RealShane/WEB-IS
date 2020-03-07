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
        url : "/origin/OnlineJudge/getAllCatalogue",
        success : function(res) {

            if(res.status == 200){
                layui.use('laypage', function(){
                    var laypage = layui.laypage;
                    laypage.render({
                        elem : 'page_set',
                        limit : 10,
                        first : '首页',
                        last : '尾页',
                        curr : res.result,
                        layout : ['count', 'prev', 'page', 'next'],
                        count : res.result.length,
                        jump: function(obj){

                            document.getElementById('catalogue_set').innerHTML = function(){
                                var arr = [], i = 1, thisData = res.result.concat().splice(obj.curr*obj.limit - obj.limit, obj.limit);
                                layui.each(thisData, function(index, key){
                                    arr.push(
                                        "<blockquote class='layui-elem-quote'>" +
                                            "<a href='/origin/Index/onlineJudgePaperList?id="+key['id']+"'>"+i+"、"+key['head']+"</a>" +
                                        "</blockquote>"
                                    );
                                    i++;
                                });
                                return arr.join('');
                            }();
                        }
                    });
                });
            }else{
                layer.msg("仅对17/18通信工程开放");
            }
        }
    });


});