
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
            url : "/admin/Isuniteuser/retrieveData",
            data : {
                key:'id',
                value:target
            },
            success : function(res) {
                $('#id').val(res.result[0]['id']);$('#name').val(res.result[0]['name']);$('#student_id').val(res.result[0]['student_id']);$('#email').val(res.result[0]['email']);$('#password').val(res.result[0]['password']);$('#password_salt').val(res.result[0]['password_salt']);$('#classes_id').val(res.result[0]['classes_id']);$('#forum_comment').val(res.result[0]['forum_comment']);$('#user_type').val(res.result[0]['user_type']);$('#last_login_ip').val(res.result[0]['last_login_ip']);$('#last_login_time').val(res.result[0]['last_login_time']);$('#create_time').val(res.result[0]['create_time']);$('#update_time').val(res.result[0]['update_time']);$('#status').val(res.result[0]['status']);
            }
        });
    
        $("#commit").click(function() {
            var id = $('#id').val();var name = $('#name').val();var student_id = $('#student_id').val();var email = $('#email').val();var password = $('#password').val();var password_salt = $('#password_salt').val();var classes_id = $('#classes_id').val();var forum_comment = $('#forum_comment').val();var user_type = $('#user_type').val();var last_login_ip = $('#last_login_ip').val();var last_login_time = $('#last_login_time').val();var create_time = $('#create_time').val();var update_time = $('#update_time').val();var status = $('#status').val();

            $.ajax({
                type : "POST",
                contentType: "application/x-www-form-urlencoded",
                url : "/admin/Isuniteuser/updateData",
                data : {
                    target:target,
                    id:id,name:name,student_id:student_id,email:email,password:password,password_salt:password_salt,classes_id:classes_id,forum_comment:forum_comment,user_type:user_type,last_login_ip:last_login_ip,last_login_time:last_login_time,create_time:create_time,update_time:update_time,status:status
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
            var id = $('#id').val();var name = $('#name').val();var student_id = $('#student_id').val();var email = $('#email').val();var password = $('#password').val();var password_salt = $('#password_salt').val();var classes_id = $('#classes_id').val();var forum_comment = $('#forum_comment').val();var user_type = $('#user_type').val();var last_login_ip = $('#last_login_ip').val();var last_login_time = $('#last_login_time').val();var create_time = $('#create_time').val();var update_time = $('#update_time').val();var status = $('#status').val();
            $.ajax({
                type : "POST",
                contentType: "application/x-www-form-urlencoded",
                url : "/admin/Isuniteuser/createData",
                data : {
                    id:id,name:name,student_id:student_id,email:email,password:password,password_salt:password_salt,classes_id:classes_id,forum_comment:forum_comment,user_type:user_type,last_login_ip:last_login_ip,last_login_time:last_login_time,create_time:create_time,update_time:update_time,status:status
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

