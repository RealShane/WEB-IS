$(document).ready(function() {
    var url = location.search; //获取url中"?"符后的字串
    var theRequest = new Object();
    if (url.indexOf("?") != -1) {
        var str = url.substr(1);
        strs = str.split("&");
        for(var i = 0; i < strs.length; i ++) {
            theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]);
        }
    }
    var id=theRequest.id;
    $.ajax({
        type : "POST",
        contentType : "application/x-www-form-urlencoded",
        url : "/origin/Index/getTargetMail",
        data : {
            id:id
        },
        success : function(res) {

            if(res.status == 200){
                $("#letter_title").append(
                    "<h4>"+res.result['title']+"</h4>"
                );
                $("#letter_info").append(
                    "<h6>作者："+res.result['name']+"&nbsp;--&nbsp;时间："+res.result['create_time']+"</h6>"
                );

                $("#letter_body").append(
                    "<p>"+res.result['letter']+"</p>"
                );
            }
        }
    });

});