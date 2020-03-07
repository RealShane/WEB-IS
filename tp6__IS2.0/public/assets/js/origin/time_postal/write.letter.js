$(document).ready(function() {

    $.ajax({
        type : "POST",
        contentType : "application/x-www-form-urlencoded",
        url : "/origin/Synthesize/tokenCheck",
        success : function(res) {
            if(res == "越权操作！"){
                layer.msg("越权操作！");
                $(window).attr('location','/origin/Index/login?type=timePostalWriteLetter');
            }
        }
    });
    var laydate = layui.laydate;
    laydate.render({
        elem: '#delivery_time'
    });
    $('#status').change(function(){
        var status = $("#status").val();
        if(status == "公开信"){
            $("#timer").hide();
        }else{
            $("#timer").show();
        }
    })
    $("#commit").click(function() {
        var title = $("#title").val();
        var letter = $("#letter").val();
        var delivery_time = $("#delivery_time").val();
        var status = $("#status").val();
        var validate = $("#validate").val();
        $.ajax({
            type : "POST",
            contentType : "application/x-www-form-urlencoded",
            url : "/origin/TimePostal/writeLetter",
            data : {
                title:title,
                letter:letter,
                delivery_time:delivery_time,
                status:status,
                validate:validate
            },
            success : function(res) {
                if(res.status == 200){
                    layer.msg(res.message);
                    $("#remove_warn").remove();
                    $("#warn").append(
                        "<div class=\"alert alert-success\" role=\"alert\">" +
                            res.message +
                        "</div>"
                    );
                    setTimeout(location.href="/origin/Index/timePostalMailBox", 2000);
                }
                if(res.status == 100) {
                    $("#remove_warn").remove();
                    $("#warn").append(
                        "<div id=\"remove_warn\">" +
                        "<div class='alert alert-warning alert-dismissible' role='alert'>" +
                        "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                        "<span aria-hidden='true'>&times;</span>" +
                        "</button>" +
                        "<strong>" + res.message + "</strong>" +
                        "</div>" +
                        "</div>"
                    );
                    layer.msg(res.message);
                }
            }
        });
    });

});

