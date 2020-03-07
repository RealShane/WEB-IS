$(document).ready(function(){
    $.ajax({
        type : "POST",
        contentType : "application/x-www-form-urlencoded",
        url : "/origin/Synthesize/tokenCheck",
        success : function(res) {
            if(res == "越权操作！"){
                layer.msg("越权操作！");
                $(window).attr('location','/origin/Index/login?type=secondClassIndex');
            }
        }
    });

    var url = location.search; //获取url中"?"符后的字串
    var theRequest = new Object();
    if (url.indexOf("?") != -1) {
        var str = url.substr(1);
        strs = str.split("&");
        for(var i = 0; i < strs.length; i ++) {
            theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]);
        }
    }
    var target=theRequest.id;

    $.ajax({
        type : "POST",
        contentType : "application/x-www-form-urlencoded",
        url : "/origin/SecondClass/targetCourseInfo",
        data : {
            target:target
        },
        success : function(res) {
            if(res.status == 200){
                $("#course_name_h1").append(
                    "<h1>"+res.result['course_name']+"</h1>"
                );
                $("[name='course_name']").append(
                    "<p>"+res.result['course_name']+"</p>"
                );
                $("#course_info").append(
                    "<p>课程简介："+res.result['description']+"</p><br>" +
                    "<p>讲师："+res.result['author']+" | 上课地点："+res.result['location']+" | 上课时间："+res.result['time']+"</p>"
                );
                $("#course").append(
                    "<option value="+res.result['id']+">"+res.result['course_name']+"</option>"
                );
            }
        }
    });

    $.ajax({
        type : "POST",
        contentType : "application/x-www-form-urlencoded",
        url : "/origin/SecondClass/allCourse",
        success : function(res) {
            if(res.status == 200){
                for(let key of res.result){
                    $("#catalogue").append(
                        "<li><a href=\"/origin/Index/secondClassSign?id="+key['id']+"\">"+key['course_name']+"</a></li>"
                    );
                }
            }
        }
    });

    $("#commit").click(function() {

        $.ajax({
            type : "POST",
            contentType : "application/x-www-form-urlencoded",
            url : "/origin/SecondClass/signForCourse",
            data : {
                target:target
            },
            success : function(res) {

                if(res.status == 0){

                    $("#remove_warn").remove();
                    $("#warn").append(
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
                }else if(res.status == 100){
                    $("#remove_warn").remove();
                    $("#warn").append(
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
                }else if(res.status == 200){
                    $("#remove_warn").remove();
                    $("#warn").append(
                        "<div class=\"alert alert-success\" role=\"alert\">" +
                            "选课成功！2秒后跳转至查询页面可查询！" +
                        "</div>"
                    );
                    layer.msg("选课成功！2秒后跳转至查询页面可查询！");
                    setTimeout("location.href='/origin/Index/secondClassSearch'", 2000);
                }else{
                    $("#remove_warn").remove();
                    $("#warn").append(
                        "<div id=\"remove_warn\">" +
                            "<div class='alert alert-warning alert-dismissible' role='alert'>" +
                                "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                                    "<span aria-hidden='true'>&times;</span>" +
                                "</button>" +
                                "<strong>警告！</strong>网络原因报名失败！" +
                            "</div>" +
                        "</div>"
                    );
                    layer.msg("警告！网络原因报名失败！");
                }
            }
        });

    });
});