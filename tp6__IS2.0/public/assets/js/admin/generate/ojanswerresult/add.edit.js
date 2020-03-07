
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
    if(target != -1){
        $.ajax({
            type : "POST",
            contentType : "application/x-www-form-urlencoded",
            url : "/admin/Ojanswerresult/retrieveData",
            data : {
                key:'id',
                value:target
            },
            success : function(res) {
                $('#id').val(res.result[0]['id']);$('#name').val(res.result[0]['name']);$('#student_id').val(res.result[0]['student_id']);$('#paper_id').val(res.result[0]['paper_id']);$('#answer').val(res.result[0]['answer']);$('#mark').val(res.result[0]['mark']);$('#status').val(res.result[0]['status']);
            }
        });
    
        $("#commit").click(function() {
            var id = $('#id').val();var name = $('#name').val();var student_id = $('#student_id').val();var paper_id = $('#paper_id').val();var answer = $('#answer').val();var mark = $('#mark').val();var status = $('#status').val();

            $.ajax({
                type : "POST",
                contentType: "application/x-www-form-urlencoded",
                url : "/admin/Ojanswerresult/updateData",
                data : {
                    target:target,
                    id:id,name:name,student_id:student_id,paper_id:paper_id,answer:answer,mark:mark,status:status
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
            var id = $('#id').val();var name = $('#name').val();var student_id = $('#student_id').val();var paper_id = $('#paper_id').val();var answer = $('#answer').val();var mark = $('#mark').val();var status = $('#status').val();
            $.ajax({
                type : "POST",
                contentType: "application/x-www-form-urlencoded",
                url : "/admin/Ojanswerresult/createData",
                data : {
                    id:id,name:name,student_id:student_id,paper_id:paper_id,answer:answer,mark:mark,status:status
                },
                success : function(res) {
                    if(res.status == 200){
                        window.parent.location.reload();
                    }
                }
            });
        })
    }
})

