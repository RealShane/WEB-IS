$(document).ready(function(){

    $.ajax({
        type : "POST",
        contentType : "application/x-www-form-urlencoded",
        url : "/origin/Index/forumGetAllModule",
        success : function(res) {

            if(res.status == 200){
                for(let key of res.result){
                    $("#module_set").append(
                        "<div class=\"col-lg-4 col-md-6\">" +
                            "<div class=\"office-box\">" +
                                "<h5>"+key['module']+"</h5>" +
                                "<address>" +
                                    "版块描述："+key['description'] +
                                "</address>" +
                                "<a href=\"/origin/Index/forumArticleList?id="+key['id']+"\"><i class=\"fas fa-code\"></i>进入</a>" +
                            "</div>" +
                        "</div>"
                    );
                }
            }
        }
    });

});