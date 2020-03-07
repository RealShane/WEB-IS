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

    $.ajax({
        type : "POST",
        contentType : "application/x-www-form-urlencoded",
        url : "/origin/SecondClass/allCourse",
        success : function(res) {
            if(res.status == 200){
                for(let key of res.result){
                    $("#course_set").append(
                        "<div class=\"col-lg-4 col-md-6\">" +
                            "<div class=\"office-box\">" +
                                "<h5>"+key['course_name']+"</h5>" +
                                "<address>" +
                                    "讲师："+key['author']+" | 上课地点："+key['location']+" | 上课时间："+key['time']+" " +
                                "</address>" +
                                "<a href=\"/origin/Index/secondClassSign?id="+key['id']+"\"><i class=\"fas fa-code\"></i>报名</a>" +
                            "</div>" +
                        "</div>"
                    );
                }
            }
        }
    });

});