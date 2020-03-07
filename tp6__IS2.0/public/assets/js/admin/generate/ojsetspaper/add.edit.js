$(document).ready(function() {

    var url = location.search; //获取url中"?"符后的字串
    url=decodeURI(url);
    var theRequest = new Object();
    if (url.indexOf("?") != -1) {
        var str = url.substr(1);
        strs = str.split("&");
        for(var i = 0; i < strs.length; i ++) {
            theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]);
        }
    }
    var target=theRequest.id;

    var single_title_body = '';
    var single_answer = '';
    var analysis_single = '';
    var multiple_title_body = '';
    var multiple_answer = '';
    var analysis_multiple = '';
    var judge_title_body = '';
    var judge_answer = '';
    var analysis_judge = '';
    $("#add_base_info_unit").hide();
    $("#add_single_unit").hide();
    $("#add_multiple_unit").hide();
    $("#add_judge_unit").hide();

    if(target != -1){
        $.ajax({
            type : "POST",
            contentType : "application/x-www-form-urlencoded",
            url : "/admin/Ojsetspaper/retrieveData",
            data : {
                key:'id',
                value:target
            },
            success : function(res) {
                $('#id').val(res.result[0]['id']);$('#head').val(res.result[0]['head']);$('#signle').val(res.result[0]['signle']);$('#multiple').val(res.result[0]['multiple']);$('#judge').val(res.result[0]['judge']);$('#single_answer').val(res.result[0]['single_answer']);$('#multiple_answer').val(res.result[0]['multiple_answer']);$('#judge_answer').val(res.result[0]['judge_answer']);$('#bornline').val(res.result[0]['bornline']);$('#deadline').val(res.result[0]['deadline']);$('#status').val(res.result[0]['status']);
            }
        });

        $("#commit").click(function() {
            var id = $('#id').val();var head = $('#head').val();var signle = $('#signle').val();var multiple = $('#multiple').val();var judge = $('#judge').val();var single_answer = $('#single_answer').val();var multiple_answer = $('#multiple_answer').val();var judge_answer = $('#judge_answer').val();var bornline = $('#bornline').val();var deadline = $('#deadline').val();var status = $('#status').val();

            $.ajax({
                type : "POST",
                contentType: "application/x-www-form-urlencoded",
                url : "/admin/Ojsetspaper/updateData",
                data : {
                    target:target,
                    id:id,head:head,signle:signle,multiple:multiple,judge:judge,single_answer:single_answer,multiple_answer:multiple_answer,judge_answer:judge_answer,bornline:bornline,deadline:deadline,status:status
                },
                success : function(res) {
                    if(res.status == 200){
                        window.parent.location.reload();
                    }
                }
            });
        })
    }
    if(target == -1){
        $("#commit").click(function() {
            var head = $('#head').val();
            var bornline = $('#bornline').val();
            var deadline = $('#deadline').val();
            console.log(single_title_body)
            console.log(single_answer)
            console.log(analysis_single)
            console.log(multiple_title_body)
            console.log(multiple_answer)
            console.log(analysis_multiple)
            console.log(judge_title_body)
            console.log(judge_answer)
            console.log(analysis_judge)
            $.ajax({
                type : "POST",
                contentType: "application/x-www-form-urlencoded",
                url : "/admin/Ojsetspaper/createData",
                data : {
                    head:head,
                    single:single_title_body,
                    multiple:multiple_title_body,
                    judge:judge_title_body,
                    single_answer:single_answer,
                    multiple_answer:multiple_answer,
                    judge_answer:judge_answer,
                    single_analysis:analysis_single,
                    multiple_analysis:analysis_multiple,
                    judge_analysis:analysis_judge,
                    bornline:bornline,
                    deadline:deadline
                },
                success : function(res) {
                    if(res.status == 200){
                        window.parent.location.reload();
                    }
                }
            });
        })
    }

    $("#add_base_info").click(function() {
        $("#four_button").hide();
        $("#were_set").hide();
        $("#add_base_info_unit").show();
    });

    $("#confirm_base_info").click(function() {
        $("#add_base_info_unit").hide();
        $("#four_button").show();
        $("#were_set").show();
        $.show_blocks(single_title_body, multiple_title_body, judge_title_body);
    });

    $("#back_base_info").click(function() {
        $("#add_base_info_unit").hide();
        $("#four_button").show();
        $("#were_set").show();
        $.show_blocks(single_title_body, multiple_title_body, judge_title_body);
    });

    $("#add_single").click(function() {
        $("#four_button").hide();
        $("#were_set").hide();
        $("#add_single_unit").show();
    });
    $("#confirm_single").click(function() {
        let title_single = $("#title_single").val();
        let a_single = $("#a_single").val();
        let b_single = $("#b_single").val();
        let c_single = $("#c_single").val();
        let d_single = $("#d_single").val();
        let answer_single = $("#answer_single").val();
        let analysis = $("#analysis_single").val();
        let temp = title_single + '`' + a_single + '`' + b_single + '`' + c_single + '`' + d_single;
        single_title_body += temp + ',';
        single_answer += answer_single + ',';
        analysis_single += analysis + ',';

        $("#add_single_unit").hide();
        $("#four_button").show();
        $("#were_set").show();
        $.show_blocks(single_title_body, multiple_title_body, judge_title_body);
    });
    $("#back_single").click(function() {
        $("#add_single_unit").hide();
        $("#four_button").show();
        $("#were_set").show();
        $.show_blocks(single_title_body, multiple_title_body, judge_title_body);
    });


    $("#add_multiple").click(function() {
        $("#four_button").hide();
        $("#were_set").hide();
        $("#add_multiple_unit").show();
    });
    $("#confirm_multiple").click(function() {
        let title_multiple = $("#title_multiple").val();
        let a_multiple = $("#a_multiple").val();
        let b_multiple = $("#b_multiple").val();
        let c_multiple = $("#c_multiple").val();
        let d_multiple = $("#d_multiple").val();
        let answer_multiple = $("#answer_multiple").val();
        let analysis = $("#analysis_multiple").val();
        let temp = title_multiple + '`' + a_multiple + '`' + b_multiple + '`' + c_multiple + '`' + d_multiple;
        multiple_title_body += temp + ',';
        multiple_answer += answer_multiple + ',';
        analysis_multiple += analysis + ',';

        $("#add_multiple_unit").hide();
        $("#four_button").show();
        $("#were_set").show();
        $.show_blocks(single_title_body, multiple_title_body, judge_title_body);
    });
    $("#back_multiple").click(function() {
        $("#add_multiple_unit").hide();
        $("#four_button").show();
        $("#were_set").show();
        $.show_blocks(single_title_body, multiple_title_body, judge_title_body);
    });


    $("#add_judge").click(function() {
        $("#four_button").hide();
        $("#were_set").hide();
        $("#add_judge_unit").show();
    });
    $("#confirm_judge").click(function() {
        let title_judge = $("#title_judge").val();
        let a_judge = $("#a_judge").val();
        let b_judge = $("#b_judge").val();
        let answer_judge = $("#answer_judge").val();
        let analysis = $("#analysis_judge").val();
        let temp = title_judge + '`' + a_judge + '`' + b_judge;
        judge_title_body += temp + ',';
        judge_answer += answer_judge + ',';
        analysis_judge += analysis + ',';

        $("#add_judge_unit").hide();
        $("#four_button").show();
        $("#were_set").show();
        $.show_blocks(single_title_body, multiple_title_body, judge_title_body);
    });
    $("#back_judge").click(function() {
        $("#add_judge_unit").hide();
        $("#four_button").show();
        $("#were_set").show();
        $.show_blocks(single_title_body, multiple_title_body, judge_title_body);
    });




    $.show_blocks = function (single_title_body, multiple_title_body, judge_title_body) {
        single_title_body = single_title_body.split(',');

        $("#singles_remove").remove();
        $("#singles_set").append(
            "<div id=\"singles_remove\"></div>"
        );
        var i = 0;
        for(let key of single_title_body){
            if(key == ""){
                continue;
            }
            $("#singles_remove").append(
                "<div class=\"form-controls col-xs-8 col-sm-9\">" +
                key[0] + key[1] + key[2] + key[3] + key[4] + "..." + "<a onclick='$.single_delete("+i+")'><i class='Hui-iconfont'>&#xe609;</i></a>" +
                "</div>"
            );
            i++;
        }


        multiple_title_body = multiple_title_body.split(',');

        $("#multiples_remove").remove();
        $("#multiples_set").append(
            "<div id=\"multiples_remove\"></div>"
        );
        var i = 0;
        for(let key of multiple_title_body){
            if(key == ""){
                continue;
            }
            $("#multiples_remove").append(
                "<div class=\"form-controls col-xs-8 col-sm-9\">" +
                key[0] + key[1] + key[2] + key[3] + key[4] + "..." + "<a onclick='$.multiple_delete("+i+")'><i class='Hui-iconfont'>&#xe609;</i></a>" +
                "</div>"
            );
            i++;
        }


        judge_title_body = judge_title_body.split(',');

        $("#judges_remove").remove();
        $("#judges_set").append(
            "<div id=\"judges_remove\"></div>"
        );
        var i = 0;
        for(let key of judge_title_body){
            if(key == ""){
                continue;
            }
            $("#judges_remove").append(
                "<div class=\"form-controls col-xs-8 col-sm-9\">" +
                key[0] + key[1] + key[2] + key[3] + key[4] + "..." + "<a onclick='$.judge_delete("+i+")'><i class='Hui-iconfont'>&#xe609;</i></a>" +
                "</div>"
            );
            i++;
        }

    }



    $.single_delete = function (id) {
        let temp = [];var str_title_body = '';var str_answer = '';var str_analysis = '';
        temp = single_title_body.split(',');
        for(var i = 0; i < temp.length; i++){
            if(id == i || temp[i] == ''){
                continue;
            }
            str_title_body += temp[i] + ',';
        }
        temp = single_answer.split(',');
        for(var i = 0; i < temp.length; i++){
            if(id == i || temp[i] == ''){
                continue;
            }
            str_answer += temp[i] + ',';
        }
        temp = analysis_single.split(',');
        for(var i = 0; i < temp.length; i++){
            if(id == i || temp[i] == ''){
                continue;
            }
            str_analysis += temp[i] + ',';
        }
        single_title_body = str_title_body;
        single_answer = str_answer;
        analysis_single = str_analysis;
        $.show_blocks(single_title_body, multiple_title_body, judge_title_body);
    }

    $.multiple_delete = function (id) {
        let temp = [];var str_title_body = '';var str_answer = '';var str_analysis = '';
        temp = multiple_title_body.split(',');
        for(var i = 0; i < temp.length; i++){
            if(id == i || temp[i] == ''){
                continue;
            }
            str_title_body += temp[i] + ',';
        }
        temp = multiple_answer.split(',');
        for(var i = 0; i < temp.length; i++){
            if(id == i || temp[i] == ''){
                continue;
            }
            str_answer += temp[i] + ',';
        }
        temp = analysis_multiple.split(',');
        for(var i = 0; i < temp.length; i++){
            if(id == i || temp[i] == ''){
                continue;
            }
            str_analysis += temp[i] + ',';
        }
        multiple_title_body = str_title_body;
        multiple_answer = str_answer;
        analysis_multiple = str_analysis;
        $.show_blocks(single_title_body, multiple_title_body, judge_title_body);
    }

    $.judge_delete = function (id) {
        let temp = [];var str_title_body = '';var str_answer = '';var str_analysis = '';
        temp = judge_title_body.split(',');
        for(var i = 0; i < temp.length; i++){
            if(id == i || temp[i] == ''){
                continue;
            }
            str_title_body += temp[i] + ',';
        }
        temp = judge_answer.split(',');
        for(var i = 0; i < temp.length; i++){
            if(id == i || temp[i] == ''){
                continue;
            }
            str_answer += temp[i] + ',';
        }
        temp = analysis_judge.split(',');
        for(var i = 0; i < temp.length; i++){
            if(id == i || temp[i] == ''){
                continue;
            }
            str_analysis += temp[i] + ',';
        }
        judge_title_body = str_title_body;
        judge_answer = str_answer;
        analysis_judge = str_analysis;
        $.show_blocks(single_title_body, multiple_title_body, judge_title_body);
    }

})
