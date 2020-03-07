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
        url : "/origin/Index/forumGetArticle",
        data : {
            id:id
        },
        success : function(res) {

            if(res.status == 200){
                $("#title_set").append(
                    "<a>"+res.result['title']+"</a>"
                );
                $("#info_set").append(
                    "<p>作者："+res.result['author']+"&nbsp;--&nbsp;发布时间："+res.result['create_time']+"</p>"
                );
                $("#article_set").append(
                    "<p>&nbsp;&nbsp;"+res.result['content']+"</p>"
                );
                list_get(res.result['type']);
            }
        }
    });

    $.ajax({
        type : "POST",
        contentType : "application/x-www-form-urlencoded",
        url : "/origin/Index/forumGetAllComment",
        data : {
            id:id
        },
        success : function(res) {
            console.log(res)
            if(res.status == 200){
                var j = 1;
                for(let key of res.result){
                    $("#comment_set").append(
                        "<div class='card'>" +
                            "<div class='card-header' role='tab' id='headingOne'>" +
                                "<a data-toggle='collapse' href='#collapseOne' aria-expanded='true' aria-controls='collapseOne'>第"+j+"楼</a>" +
                            "</div>" +
                            "<div id='collapseOne' class='collapse show' role='tabpanel' aria-labelledby='headingOne' data-parent='#accordion'>" +
                                "<div class='card-body'>" +
                                    "<strong>"+key['comment']+"</strong></br>评论From："+key['name']+"&nbsp;&nbsp;评论时间（时间戳）："+key['create_time']+
                                "</div>" +
                            "</div>" +
                        "</div>"
                    );
                    j++;
                }
            }
        }
    });

    $("#commit_comment").click(function() {
        var comment = $("#comment").val();
        var validate = $("#validate").val();
        $.ajax({
            type : "POST",
            contentType : "application/x-www-form-urlencoded",
            url : "/origin/Forum/commentSet",
            data : {
                id:id,
                validate:validate,
                comment:comment
            },
            success : function(res) {
                if(res == "越权操作！"){
                    layer.msg("请先登陆再评论！");
                    $("#remove_warn").remove();
                    $("#warn").append(
                        "<div id=\"remove_warn\">" +
                            "<div class='alert alert-warning alert-dismissible' role='alert'>" +
                                "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                                    "<span aria-hidden='true'>&times;</span>" +
                                "</button>" +
                                "<strong>请先登陆再评论！</strong>" +
                            "</div>" +
                        "</div>"
                    );
                    setTimeout(location.href="/origin/Index/login?type=forumIndex", 2000);
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
                if(res.status == 200){
                    layer.msg("评论成功！");
                    window.parent.location.reload();
                }
            }
        });
    });


});

function list_get(id) {
    $.ajax({
        type : "POST",
        contentType : "application/x-www-form-urlencoded",
        url : "/origin/Index/forumGetArticleList",
        data : {
            id:id
        },
        success : function(res) {
            if(res.status == 200){
                for(let key of res.result){
                    $("#list_set").append(
                        "<li><a href=/origin/Index/forumArticle?id="+key['id']+">"+key['title']+"</a></li>"
                    );
                }
            }
        }
    });
}