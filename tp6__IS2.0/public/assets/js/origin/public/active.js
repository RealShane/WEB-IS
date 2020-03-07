$(document).ready(function(){
    var url = location.search; //获取url中"?"符后的字串
    var theRequest = new Object();
    if (url.indexOf("?") != -1) {
        var str = url.substr(1);
        var strs = str.split("&");
        for(var i = 0; i < strs.length; i ++) {
            theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]);
        }
    }
    var active_token=theRequest.token;

    $.ajax({
        type : "POST",
        contentType : "application/x-www-form-urlencoded",
        url : "/origin/Index/activeRegister",
        beforeSend : function(request) {
            request.setRequestHeader("active-token", active_token);
        },
        success : function(res) {

            if(res.status == 200){
                $("#active_info").append(
                    "<div id=\"remove_warn\">" +
                        "<div class=\"alert alert-success\" role=\"alert\">" +
                            "<i class=\"icon-check\"></i>"+res.result+
                        "</div>" +
                    "</div>"
                );
                layer.msg(res.result);
            }

            if(res.status == 100){
                $("#active_info").append(
                    "<div id=\"remove_warn\">" +
                        "<div class='alert alert-warning alert-dismissible' role='alert'>" +
                            "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                                "<span aria-hidden='true'>&times;</span>" +
                            "</button>" +
                            "<strong>警告！</strong>"+res.result+"！" +
                        "</div>" +
                    "</div>"
                );
                layer.msg(res.result);
            }
        }
    });
});
