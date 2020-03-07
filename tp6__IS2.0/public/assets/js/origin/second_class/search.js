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

    $("#commit").click(function() {
        var student_id = $("#student_id").val();

        $.ajax({
            type : "POST",
            contentType : "application/x-www-form-urlencoded",
            url : "/origin/SecondClass/searchSign",
            data : {
                student_id:student_id
            },
            success : function(res) {

                if(res.status == 100){

                    $("#remove_info").remove();
                    $("#info_set").append(
                        "<div class='alert alert-warning alert-dismissible' role='alert'>" +
                            "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                                "<span aria-hidden='true'>&times;</span>" +
                            "</button>" +
                            "<strong>警告！</strong>"+res.result+"！" +
                        "</div>"
                    );
                    layer.msg(res.result);
                }
                if(res.status == 200){
                    $("#remove_info").remove();
                    $("#info_set").append(
                        "<p id=\"remove_info\">" +
                            "所选课名："+res.result['course_name']+"</br>"+
                            "课程代号："+res.result['course_id']+"</br>"+
                            "你的姓名："+res.result['name']+"</br>"+
                            "你的班级："+res.result['classes_name']+"</br>"+
                            "班级代号："+res.result['classes_id']+"</br>"+
                            "报名时间（时间戳）："+res.result['year']+"</br>"+
                            "你的分数："+res.result['mark']+
                        "</p>"
                    );
                }
            }
        });

    });
});