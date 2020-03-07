$(document).ready(function() {

    $.ajax({
        type : "POST",
        contentType : "application/x-www-form-urlencoded",
        url : "/origin/Synthesize/tokenCheck",
        success : function(res) {
            if(res == "越权操作！"){
                layer.msg("越权操作！");
                $(window).attr('location','/origin/Index/login?type=forumIndex');
            }
        }
    });

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

    $("#commit").click(function() {
        var title = $("#title").val();
        var content = $("#content").val();
        var validate = $("#validate").val();
        $.ajax({
            type : "POST",
            contentType : "application/x-www-form-urlencoded",
            url : "/origin/Forum/articleWrite",
            data : {
                title:title,
                content:content,
                validate:validate,
                type:id
            },
            success : function(res) {

                if(res.status == 200){
                    $("#remove_warn").remove();
                    $("#warn").append(
                        "<div id=\"remove_warn\">" +
                            "<div class=\"alert alert-success\" role=\"alert\">" +
                            "提交成功，联系Shane通过审核！" +
                            "</div>" +
                        "</div>"
                    );
                    layer.msg("提交成功，联系Shane通过审核！");
                    setTimeout(location.href="/origin/Index/forumIndex", 2000);
                }else{
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

