$(document).ready(function() {

    $.ajax({
        type : "POST",
        contentType : "application/x-www-form-urlencoded",
        url : "/origin/Synthesize/tokenCheck",
        success : function(res) {
            if(res == "越权操作！"){
                layer.msg("越权操作！");
                $(window).attr('location','/origin/Index/login?type=timePostalMailBox');
            }
        }
    });

    $.ajax({
        type : "POST",
        contentType : "application/x-www-form-urlencoded",
        url : "/origin/TimePostal/letterInMailBox",
        success : function(res) {

            if(res.status == 200){
                var i = 1, j = 1, k = 1;
                for(let key of res.result){
                    if(key['status'] == "公开信" ){
                        $("#open_letter").append(
                            "<blockquote class='layui-elem-quote'>"+i+"、"+key['title']+"&nbsp;--&nbsp;写信时间："+key['create_time']+"&nbsp;--&nbsp;" +
                                "<i class='icon-action-undo'></i>" +
                                "<a onclick=deleteLetter("+key['id']+") href='#'>删除</a>" +
                            "</blockquote>"
                        );
                        i++;
                    }
                    if(key['status'] == "时光信件" || key['status'] == "已发送"){
                        $("#private_letter").append(
                            "<blockquote class='layui-elem-quote'>"+j+"、"+key['title']+"&nbsp;--&nbsp;写信时间："+key['create_time']+"&nbsp;--&nbsp;取信时间（时间戳）："+key['delivery_time']+"&nbsp;--&nbsp;状态："+key['status']+"&nbsp;--&nbsp;" +
                                "<i class='icon-action-undo'></i>" +
                                "<a onclick=deleteLetter("+key['id']+") href='#'>删除</a>" +
                            "</blockquote>"
                        );
                        j++;
                    }
                    if(key['status'] == "删除"){
                        var a = "公开信", b = "时光信件";
                        $("#delete_letter").append(
                            "<blockquote class='layui-elem-quote'>"+k+"、"+key['title']+"&nbsp;--&nbsp;写信时间："+key['create_time']+"&nbsp;--&nbsp;取信时间（时间戳）："+key['delivery_time']+"&nbsp;--&nbsp;</blockquote>" +
                            "<i class='icon-action-redo'></i>" +
                            "<a onclick=recoveryLetter("+key['id']+",\'"+a+"\') href='#'>恢复成公开信</a>&nbsp;--&nbsp;" +
                            "<i class='icon-action-redo'></i>" +
                            "<a onclick=recoveryLetter("+key['id']+",\'"+b+"\') href='#'>恢复成时光信件</a>"
                        );
                        k++;
                    }

                }
            }
        }
    });

});

function recoveryLetter(id, status) {

    $.ajax({
        type : "POST",
        contentType : "application/x-www-form-urlencoded",
        url : "/origin/TimePostal/recoveryMail",
        data : {
            id:id,
            status:status
        },
        success : function(res) {
            if(res.status == 200){
                layer.msg("操作成功！");
                window.parent.location.reload();
            }
        }
    });
}

function deleteLetter(id) {
    $.ajax({
        type : "POST",
        contentType : "application/x-www-form-urlencoded",
        url : "/origin/TimePostal/deleteMail",
        data : {
            id:id
        },
        success : function(res) {
            if(res.status == 200){
                layer.msg("操作成功！");
                window.parent.location.reload();
            }
        }
    });
}