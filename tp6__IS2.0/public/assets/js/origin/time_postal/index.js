$(document).ready(function() {

    $.ajax({
        type : "POST",
        contentType : "application/x-www-form-urlencoded",
        url : "/origin/Index/getAllOpenMail",
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

                            document.getElementById('letter_set').innerHTML = function(){
                                var arr = [], i = 1, thisData = res.result.concat().splice(obj.curr*obj.limit - obj.limit, obj.limit);
                                layui.each(thisData, function(index, key){
                                    arr.push(
                                        "<blockquote class='layui-elem-quote'>" +
                                            "<a href='/origin/Index/timePostalOpenLetter?id="+key['id']+"'>"+i+"、"+key['title']+"</a>" +
                                        "</blockquote>"
                                    );
                                    i++;
                                });
                                return arr.join('');
                            }();
                        }
                    });
                });
            }
        }
    });

});