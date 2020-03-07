$(document).ready(function(){

    $.ajax({
        type : "POST",
        contentType : "application/x-www-form-urlencoded",
        url : "/admin/AdminBaseAccess/adminInfo",
        success : function(res) {
            if(res.status == 200){
                $("#admin_name").append(
                    "<strong>"+res.result['username']+"</strong>"
                );
                $("#admin_group").append(
                    "<strong>"+res.result['group']+"</strong>"
                );

            }

        }
    });



});