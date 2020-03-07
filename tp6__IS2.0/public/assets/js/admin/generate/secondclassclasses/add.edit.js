
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
            url : "/admin/Secondclassclasses/retrieveData",
            data : {
                key:'id',
                value:target
            },
            success : function(res) {
                $('#id').val(res.result[0]['id']);$('#classes_id').val(res.result[0]['classes_id']);$('#classes_name').val(res.result[0]['classes_name']);$('#grade').val(res.result[0]['grade']);$('#year').val(res.result[0]['year']);
            }
        });
    
        $("#commit").click(function() {
            var id = $('#id').val();var classes_id = $('#classes_id').val();var classes_name = $('#classes_name').val();var grade = $('#grade').val();var year = $('#year').val();

            $.ajax({
                type : "POST",
                contentType: "application/x-www-form-urlencoded",
                url : "/admin/Secondclassclasses/updateData",
                data : {
                    target:target,
                    id:id,classes_id:classes_id,classes_name:classes_name,grade:grade,year:year
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
            var id = $('#id').val();var classes_id = $('#classes_id').val();var classes_name = $('#classes_name').val();var grade = $('#grade').val();var year = $('#year').val();
            $.ajax({
                type : "POST",
                contentType: "application/x-www-form-urlencoded",
                url : "/admin/Secondclassclasses/createData",
                data : {
                    id:id,classes_id:classes_id,classes_name:classes_name,grade:grade,year:year
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

