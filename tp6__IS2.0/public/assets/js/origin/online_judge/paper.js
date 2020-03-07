$(document).ready(function() {
    $.ajax({
        type : "POST",
        contentType : "application/x-www-form-urlencoded",
        url : "/origin/Synthesize/tokenCheck",
        success : function(res) {
            if(res == "越权操作！"){
                layer.msg("越权操作！");
                $(window).attr('location','/origin/Index/login?type=onlineJudgeIndex');
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
    var multiple_len = 0;
    $.ajax({
        type : "POST",
        contentType : "application/x-www-form-urlencoded",
        url : "/origin/OnlineJudge/getTargetPaper",
        data : {
            target:id
        },
        success : function(res) {

            if(res.status == 200){
                $("#head_set").append("<a>"+res.result['head']+"</a>");
                $("#deadline_set").append("<p>截止日期(时间戳)："+res.result['deadline']+"</p>");
                let i = 1;let j = 0;let k = 0;let x = 0;let m = 0;

                if(res.result['status'] == '已判'){
                    $("#type_commit").hide();
                    $("#type_judge").hide();
                    if(res.result['body']['single'] != null){
                        $("#single_set").append(
                            "<blockquote class='layui-elem-quote layui-quote-nm'>单选题</blockquote>" +
                            "<hr class='layui-bg-gray'>"
                        );
                        var single_answer = [];var str = res.result['single_answer'];
                        var correct_single_answer = [];var correct_str = res.result['correct_single_answer'];
                        var single_analysis = [];var analysis_str = res.result['single_analysis'];
                        var correct_count = 0;
                        var analysis_count = 0;
                        single_answer = str.split(',');
                        correct_single_answer = correct_str.split(',');
                        single_analysis = analysis_str.split(',');

                        for(let key of res.result['body']['single']){
                            $("#single_set").append(
                                "<div class='layui-form-item' pane>" +
                                    "<blockquote class='layui-elem-quote'>"+i+"、"+key[0]+"</blockquote>" +
                                    "<select name='single_answer'>" +
                                        "<option value="+single_answer[j]+">你的答案："+single_answer[j].toUpperCase()+"</option>" +
                                        "<option value='a'>A:"+key[1]+"</option>" +
                                        "<option value='b'>B:"+key[2]+"</option>" +
                                        "<option value='c'>C:"+key[3]+"</option>" +
                                        "<option value='d'>D:"+key[4]+"</option>" +
                                    "</select>" +
                                    "<blockquote class='layui-elem-quote layui-quote-nm'>"+
                                        "正确答案"+correct_single_answer[correct_count]+"<br>"+
                                        single_analysis[analysis_count]+
                                    "</blockquote>" +
                                    "<hr class='layui-bg-gray'>" +
                                "</div>"
                            );
                            analysis_count++;
                            correct_count++;
                            j++;
                            i++;
                        }
                    }
                    if(res.result['body']['multiple'] != null){
                        $("#multiple_set").append(
                            "<blockquote class=\"layui-elem-quote layui-quote-nm\">多选题</blockquote>" +
                            "<hr class=\"layui-bg-gray\">"
                        );
                        var multiple_answer = [];var str = res.result['multiple_answer'];
                        var correct_multiple_answer = [];var correct_str = res.result['correct_multiple_answer'];
                        var multiple_analysis = [];var analysis_str = res.result['multiple_analysis'];
                        var correct_count = 0;
                        var analysis_count = 0;
                        multiple_answer = str.split(',');
                        correct_multiple_answer = correct_str.split(',');
                        multiple_analysis = analysis_str.split(',');
                        multiple_len = res.result['body']['multiple'].length;
                        for(let key of res.result['body']['multiple']){
                            let temp = multiple_answer[k].split('-');
                            let str_a = "<input type='checkbox' name=multiple_answer_"+x+" value='a' title=A:"+key[1]+">";
                            let str_b = "<input type='checkbox' name=multiple_answer_"+x+" value='b' title=B:"+key[2]+">";
                            let str_c = "<input type='checkbox' name=multiple_answer_"+x+" value='c' title=C:"+key[3]+">";
                            let str_d = "<input type='checkbox' name=multiple_answer_"+x+" value='d' title=D:"+key[4]+">";
                            for(let item of temp){
                                if(item == 'a'){
                                    str_a = "<input checked type='checkbox' name=multiple_answer_"+x+" value='a' title=A:"+key[1]+">";
                                }
                                if(item == 'b'){
                                    str_b = "<input checked type='checkbox' name=multiple_answer_"+x+" value='b' title=B:"+key[2]+">";
                                }
                                if(item == 'c'){
                                    str_c = "<input checked type='checkbox' name=multiple_answer_"+x+" value='c' title=C:"+key[3]+">";
                                }
                                if(item == 'd'){
                                    str_d = "<input checked type='checkbox' name=multiple_answer_"+x+" value='d' title=D:"+key[4]+">";
                                }

                            }
                            $("#multiple_set").append(
                                "<div class='layui-form-item' pane>" +
                                "<blockquote class='layui-elem-quote'>"+i+"、"+key[0]+"</blockquote>" +
                                str_a +
                                str_b +
                                str_c +
                                str_d +
                                "<blockquote class='layui-elem-quote layui-quote-nm'>"+
                                    "正确答案"+correct_multiple_answer[correct_count]+"<br>"+
                                    multiple_analysis[analysis_count]+
                                "</blockquote>" +
                                "<hr class='layui-bg-gray'>" +
                                "</div>"
                            );
                            analysis_count++;
                            correct_count++;
                            k++;
                            x++;
                            i++;
                        }
                    }

                    if(res.result['body']['judge'] != null){
                        $("#judge_set").append(
                            "<blockquote class=\"layui-elem-quote layui-quote-nm\">判断题</blockquote>" +
                            "<hr class=\"layui-bg-gray\">"
                        );
                        var judge_answer = [];var str = res.result['judge_answer'];
                        var correct_judge_answer = [];var correct_str = res.result['correct_judge_answer'];
                        var judge_analysis = [];var analysis_str = res.result['judge_analysis'];
                        var correct_count = 0;
                        var analysis_count = 0;
                        judge_answer = str.split(',');
                        correct_judge_answer = correct_str.split(',');
                        judge_analysis = analysis_str.split(',');
                        for(let key of res.result['body']['judge']){
                            $("#judge_set").append(
                                "<div class='layui-form-item' pane>" +
                                    "<blockquote class='layui-elem-quote'>"+i+"、"+key[0]+"</blockquote>" +
                                    "<select name='judge_answer'>" +
                                        "<option value="+judge_answer[m]+">你的答案："+judge_answer[m].toUpperCase()+"</option>" +
                                        "<option value='a'>A:"+key[1]+"</option>" +
                                        "<option value='b'>B:"+key[2]+"</option>" +
                                    "</select>" +
                                    "<blockquote class='layui-elem-quote layui-quote-nm'>"+
                                        "正确答案"+correct_judge_answer[correct_count]+"<br>"+
                                    judge_analysis[analysis_count]+
                                    "</blockquote>" +
                                    "<hr class='layui-bg-gray'>" +
                                "</div>"
                            );
                            analysis_count++;
                            correct_count++;
                            m++;
                            i++;
                        }
                    }
                    layui.use('form', function(){
                        var form = layui.form;
                        form.render();
                    });
                    return;
                }
                if(res.result['body']['single'] != null){
                    $("#single_set").append(
                        "<blockquote class=\"layui-elem-quote layui-quote-nm\">单选题</blockquote>" +
                        "<hr class=\"layui-bg-gray\">"
                    );
                    if(res.result['single_answer'] != null){
                        var single_answer = [];var str = res.result['single_answer'];
                        single_answer = str.split(',');
                        for(let key of res.result['body']['single']){
                            $("#single_set").append(
                                "<div class='layui-form-item' pane>" +
                                    "<blockquote class='layui-elem-quote'>"+i+"、"+key[0]+"</blockquote>" +
                                    "<select name='single_answer'>" +
                                        "<option value="+single_answer[j]+">上次保存为："+single_answer[j].toUpperCase()+"</option>" +
                                        "<option value='a'>A:"+key[1]+"</option>" +
                                        "<option value='b'>B:"+key[2]+"</option>" +
                                        "<option value='c'>C:"+key[3]+"</option>" +
                                        "<option value='d'>D:"+key[4]+"</option>" +
                                    "</select>" +
                                "</div>"
                            );
                            j++;
                            i++;
                        }
                    }else if(res.result['single_answer'] == null){
                        for(let key of res.result['body']['single']){
                            $("#single_set").append(
                                "<div class='layui-form-item' pane>" +
                                    "<blockquote class='layui-elem-quote'>"+i+"、"+key[0]+"</blockquote>" +
                                    "<select name='single_answer'>" +
                                        "<option value=''>请选择</option>" +
                                        "<option value='a'>A:"+key[1]+"</option>" +
                                        "<option value='b'>B:"+key[2]+"</option>" +
                                        "<option value='c'>C:"+key[3]+"</option>" +
                                        "<option value='d'>D:"+key[4]+"</option>" +
                                    "</select>" +
                                "</div>"
                            );
                            i++;
                        }
                    }
                }

                if(res.result['body']['multiple'] != null){
                    $("#multiple_set").append(
                        "<blockquote class=\"layui-elem-quote layui-quote-nm\">多选题</blockquote>" +
                        "<hr class=\"layui-bg-gray\">"
                    );
                    if(res.result['multiple_answer'] != null){
                        var multiple_answer = [];var str = res.result['multiple_answer'];
                        multiple_answer = str.split(',');
                        multiple_len = res.result['body']['multiple'].length;
                        for(let key of res.result['body']['multiple']){
                            let temp = multiple_answer[k].split('-');
                            let str_a = "<input type='checkbox' name=multiple_answer_"+x+" value='a' title=A:"+key[1]+">";
                            let str_b = "<input type='checkbox' name=multiple_answer_"+x+" value='b' title=B:"+key[2]+">";
                            let str_c = "<input type='checkbox' name=multiple_answer_"+x+" value='c' title=C:"+key[3]+">";
                            let str_d = "<input type='checkbox' name=multiple_answer_"+x+" value='d' title=D:"+key[4]+">";
                            for(let item of temp){
                                if(item == 'a'){
                                    str_a = "<input checked type='checkbox' name=multiple_answer_"+x+" value='a' title=A:"+key[1]+">";
                                }
                                if(item == 'b'){
                                    str_b = "<input checked type='checkbox' name=multiple_answer_"+x+" value='b' title=B:"+key[2]+">";
                                }
                                if(item == 'c'){
                                    str_c = "<input checked type='checkbox' name=multiple_answer_"+x+" value='c' title=C:"+key[3]+">";
                                }
                                if(item == 'd'){
                                    str_d = "<input checked type='checkbox' name=multiple_answer_"+x+" value='d' title=D:"+key[4]+">";
                                }

                            }
                            $("#multiple_set").append(
                                "<div class='layui-form-item' pane>" +
                                    "<blockquote class='layui-elem-quote'>"+i+"、"+key[0]+"</blockquote>" +
                                    str_a +
                                    str_b +
                                    str_c +
                                    str_d +
                                "</div>"
                            );
                            k++;
                            x++;
                            i++;
                        }
                    }else if(res.result['multiple_answer'] == null){
                        multiple_len = res.result['body']['multiple'].length;
                        for(let key of res.result['body']['multiple']){
                            $("#multiple_set").append(
                                "<div class='layui-form-item' pane>" +
                                    "<blockquote class='layui-elem-quote'>"+i+"、"+key[0]+"</blockquote>" +
                                    "<input type='checkbox' name=multiple_answer_"+x+" value='a' title=A:"+key[1]+">" +
                                    "<input type='checkbox' name=multiple_answer_"+x+" value='b' title=B:"+key[2]+">" +
                                    "<input type='checkbox' name=multiple_answer_"+x+" value='c' title=C:"+key[3]+">" +
                                    "<input type='checkbox' name=multiple_answer_"+x+" value='d' title=D:"+key[4]+">" +
                                "</div>"
                            );
                            x++;
                            i++;
                        }
                    }
                }

                if(res.result['body']['judge'] != null){
                    $("#judge_set").append(
                        "<blockquote class=\"layui-elem-quote layui-quote-nm\">判断题</blockquote>" +
                        "<hr class=\"layui-bg-gray\">"
                    );
                    if(res.result['judge_answer'] != null){
                        var judge_answer = [];var str = res.result['judge_answer'];
                        judge_answer = str.split(',');
                        for(let key of res.result['body']['judge']){
                            $("#judge_set").append(
                                "<div class='layui-form-item' pane>" +
                                    "<blockquote class='layui-elem-quote'>"+i+"、"+key[0]+"</blockquote>" +
                                    "<select name='judge_answer'>" +
                                        "<option value="+judge_answer[m]+">上次保存为："+judge_answer[m].toUpperCase()+"</option>" +
                                        "<option value='a'>A:"+key[1]+"</option>" +
                                        "<option value='b'>B:"+key[2]+"</option>" +
                                    "</select>" +
                                "</div>"
                            );
                            m++;
                            i++;
                        }
                    }else if(res.result['judge_answer'] == null){
                        for(let key of res.result['body']['judge']){
                            $("#judge_set").append(
                                "<div class='layui-form-item' pane>" +
                                    "<blockquote class='layui-elem-quote'>"+i+"、"+key[0]+"</blockquote>" +
                                    "<select name='judge_answer'>" +
                                        "<option value=''>请选择</option>" +
                                        "<option value='a'>A:"+key[1]+"</option>" +
                                        "<option value='b'>B:"+key[2]+"</option>" +
                                    "</select>" +
                                "</div>"
                            );
                            i++;
                        }
                    }
                }
                layui.use('form', function(){
                    var form = layui.form;
                    form.render();
                });

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
            }else{
                layer.msg("仅对17/18通信工程开放");
            }

        }
    });

    $("#type_commit").click(function() {

        var single_answer = "";var multiple_answer = "";var judge_answer = "";
        $("[name='single_answer']").each(function(index,value){
            single_answer += $(value).val() + ",";
        });

        for(var i = 0; i < multiple_len; i++){
            var temp2 = '';
            $("[name=multiple_answer_"+i+"]:checked").each(function(index,value){
                let temp = $(value).val();
                temp2 += temp + "-";
            });
            temp2 = temp2.substring(0, temp2.lastIndexOf('-'));
            multiple_answer += temp2 + ",";
        }

        $("[name='judge_answer']").each(function(index,value){
            judge_answer += $(value).val() + ",";
        });

        $.ajax({
            type : "POST",
            contentType : "application/x-www-form-urlencoded",
            url : "/origin/OnlineJudge/doTargetPaper",
            data : {
                target:id,
                single_answer:single_answer,
                multiple_answer:multiple_answer,
                judge_answer:judge_answer,
                status:'未判'
            },
            success : function(res) {

                if(res.status == 200){
                    $("#remove_warn").remove();
                    $("#warn").append(
                        "<div id=\"remove_warn\">" +
                            "<div class=\"alert alert-success\" role=\"alert\">" +
                                "保存成功可以继续检查！" +
                            "</div>" +
                        "</div>"
                    );
                    layer.msg("保存成功可以继续检查！");
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
                }else{
                    layer.msg("仅对17/18通信工程开放");
                }
            }
        });
    });

    $("#type_judge").click(function() {

        var single_answer = "";var multiple_answer = "";var judge_answer = "";
        $("[name='single_answer']").each(function(index,value){
            single_answer += $(value).val() + ",";
        });

        for(var i = 0; i < multiple_len; i++){
            var temp2 = '';
            $("[name=multiple_answer_"+i+"]:checked").each(function(index,value){
                let temp = $(value).val();
                temp2 += temp + "-";
            });
            temp2 = temp2.substring(0, temp2.lastIndexOf('-'));
            multiple_answer += temp2 + ",";
        }

        $("[name='judge_answer']").each(function(index,value){
            judge_answer += $(value).val() + ",";
        });

        $.ajax({
            type : "POST",
            contentType : "application/x-www-form-urlencoded",
            url : "/origin/OnlineJudge/doTargetPaper",
            data : {
                target:id,
                single_answer:single_answer,
                multiple_answer:multiple_answer,
                judge_answer:judge_answer,
                status:'已判'
            },
            success : function(res) {

                if(res.status == 200){
                    $("#remove_warn").remove();
                    $("#warn").append(
                        "<div id=\"remove_warn\">" +
                            "<div class=\"alert alert-success\" role=\"alert\">" +
                                "判题成功！" +
                            "</div>" +
                        "</div>"
                    );
                    layer.msg("判题成功！");
                    setTimeout(location.href="/origin/Index/onlineJudgeIndex", 2000);
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
                }else{
                    layer.msg("仅对17/18通信工程开放");
                }
            }
        });
    });

});