$(document).ready(function() {

    var url = location.search; //获取url中"?"符后的字串
    var theRequest = new Object();
    if (url.indexOf("?") != -1) {
        var str = url.substr(1);
        var strs = str.split("&");
        for(var i = 0; i < strs.length; i ++) {
            theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]);
        }
    }
    var id=theRequest.id;

    $.ajax({
        type : "POST",
        contentType : "application/x-www-form-urlencoded",
        url : "/origin/Index/forumGetTargetModule",
        data : {
            id:id
        },
        success : function(res) {

            if(res.status == 200){
                $("#forum_module").append(
                    "<a>"+res.result['module']+"</a>"
                );
            }
        }
    });

    $("#write_type_link").append(
        "<a href=/origin/Index/forumArticleWrite?id="+id+">写文章</a>"
    );

    $.ajax({
        type : "POST",
        contentType : "application/x-www-form-urlencoded",
        url : "/origin/Index/forumGetArticleList",
        data : {
            id:id
        },
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

                            document.getElementById('list_set').innerHTML = function(){
                                var arr = [], i = 1, thisData = res.result.concat().splice(obj.curr*obj.limit - obj.limit, obj.limit);
                                layui.each(thisData, function(index, key){
                                    arr.push(
                                        "<blockquote class='layui-elem-quote'>" +
                                            "<a href='/origin/Index/forumArticle?id="+key['id']+"'>"+i+"、"+key['title']+"</a>" +
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

