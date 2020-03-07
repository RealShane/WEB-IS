
$(document).ready(function(){

    $(document).ready(function(){

        $.ajax({
            type : "POST",
            contentType : "application/x-www-form-urlencoded",
            url : "/admin/Synthesize1803/seeAll",
            success : function(res) {
                var i = 1;
                $("#data_num").append(
                    "<strong>"+res.result.length+"</strong>"
                );
                for(let key of res.result){

                    $("#dataRoom").append(
                        "<tr>" +
                            "<td><input type='checkbox' name='multiple' value="+key['id']+"></td>>" +
                            "<td>"+key['id']+"</td>" +"<td>"+key['name']+"</td>" +"<td>"+key['student_id']+"</td>" +"<td>"+key['situation']+"</td>" +"<td>"+key['message']+"</td>" +"<td>"+key['zc2018510429']+"</td>" +"<td>"+key['zc2018510435']+"</td>" +"<td>"+key['zc2018510438']+"</td>" +"<td>"+key['zc2018510447']+"</td>" +"<td>"+key['zc2018510448']+"</td>" +"<td>"+key['zc2018510450']+"</td>" +"<td>"+key['zc2018510452']+"</td>" +"<td>"+key['zc2018510456']+"</td>" +"<td>"+key['zc2018510458']+"</td>" +"<td>"+key['zc2018510463']+"</td>" +"<td>"+key['zc2018510465']+"</td>" +"<td>"+key['zc2018510469']+"</td>" +"<td>"+key['zc2018510479']+"</td>" +"<td>"+key['zc2018510490']+"</td>" +"<td>"+key['zc2018510496']+"</td>" +"<td>"+key['zc2018510498']+"</td>" +"<td>"+key['zc2018510499']+"</td>" +"<td>"+key['zc2018510520']+"</td>" +"<td>"+key['zc2018510524']+"</td>" +"<td>"+key['zc2018510534']+"</td>" +"<td>"+key['zc2018510537']+"</td>" +"<td>"+key['zc2018510541']+"</td>" +"<td>"+key['zc2018510543']+"</td>" +"<td>"+key['zc2018510552']+"</td>" +"<td>"+key['zc2018510564']+"</td>" +"<td>"+key['zc2018510568']+"</td>" +"<td>"+key['zc2018510569']+"</td>" +"<td>"+key['zc2018510579']+"</td>" +"<td>"+key['zc2018510588']+"</td>" +"<td>"+key['zc2018510591']+"</td>" +"<td>"+key['zc2018510592']+"</td>" +"<td>"+key['zc2018510594']+"</td>" +"<td>"+key['zc2018510596']+"</td>" +"<td>"+key['zc2018510600']+"</td>" +"<td>"+key['zc2018510601']+"</td>" +"<td>"+key['zc2018510616']+"</td>" +"<td>"+key['zc2018510618']+"</td>" +"<td>"+key['zc2018510620']+"</td>" +"<td>"+key['zc2018510625']+"</td>" +"<td>"+key['zc2018510628']+"</td>" +"<td>"+key['zc2018510636']+"</td>" +"<td>"+key['zc2018510640']+"</td>" +"<td>"+key['zc2018510643']+"</td>" +"<td>"+key['zc2018510647']+"</td>" +"<td>"+key['zc2018510664']+"</td>" +"<td>"+key['zc2018510666']+"</td>" +"<td>"+key['zc2018510668']+"</td>" +"<td>"+key['zc2018510671']+"</td>" +"<td>"+key['zc2018510672']+"</td>" +"<td>"+key['zc2018510679']+"</td>" +"<td>"+key['zc2018510681']+"</td>" +"<td>"+key['zc2018510691']+"</td>" +"<td>"+key['zc2018510695']+"</td>" +"<td>"+key['zc2018510696']+"</td>" +"<td>"+key['zc2018510705']+"</td>" +"<td>"+key['zc2018510708']+"</td>" +"<td>"+key['zc2018510713']+"</td>" +"<td>"+key['zc2018510721']+"</td>" +"<td>"+key['zc2018510722']+"</td>" +"<td>"+key['zc2018510728']+"</td>" +"<td>"+key['zc2018510729']+"</td>" +"<td>"+key['zc2018510752']+"</td>" +"<td>"+key['zc2018510753']+"</td>" +"<td>"+key['zc2018510755']+"</td>" +"<td>"+key['final']+"</td>" +
                            "<td class='td-manage'>" +
                                "<span class='label label - success radius'><a onClick='edit("+key['id']+")'>编辑</a></span>" +
                                "<span class='label radius'><a onClick='delete_single("+key['id']+")'>删除</a></span>" +
                            "</td>" +
                        "</tr>"
                    );
                    i++;
                }

            }
        });

    });
    $("#add").click(function(){
        layer_show('代码生成','/admin/Synthesize1803/viewAddEdit?id=-1',800,500);
    })
    $("#batchDelete").click(function(){
        var ids = [], i = 1;
        $("input[name='multiple']:checked").each(function(index, key){
            ids[i] = $(key).val();
            i++;
        });

        $.ajax({
            type : "POST",
            contentType: "application/x-www-form-urlencoded",
            url : "/admin/Synthesize1803/batchDeleteData",
            data : {
                ids:ids
            },
            success : function(res) {
                if(res.status == 200){
                    window.parent.location.reload();
                }
            }
        });
    })
});
$("#search_send").click(function(){
    var searchKey = $("#searchKey").val();
    var searchValue = $("#searchValue").val();
    $.ajax({
        type : "POST",
        contentType: "application/x-www-form-urlencoded",
        url : "/admin/Synthesize1803/retrieveData",
        data : {
            key:searchKey,
            value:searchValue
        },
        success : function(res) {
            if(res.status == 200){
                $("#data_num").remove();
                $("#dataRoom").remove();
                $("#num_room").append(
                    "<strong id='data_num'>"+res.result.length+"</strong>"
                );
                $("#dataSingleSet").append(
                    "<tbody id='dataRoom'></tbody>"
                );
                var i = 1;
                for(let key of res.result){
                    $("#dataRoom").append(
                        "<tr>" +
                            "<td><input type='checkbox' name='multiple' value="+key['id']+"></td>" +
                            "<td>"+key['id']+"</td>" +"<td>"+key['name']+"</td>" +"<td>"+key['student_id']+"</td>" +"<td>"+key['situation']+"</td>" +"<td>"+key['message']+"</td>" +"<td>"+key['zc2018510429']+"</td>" +"<td>"+key['zc2018510435']+"</td>" +"<td>"+key['zc2018510438']+"</td>" +"<td>"+key['zc2018510447']+"</td>" +"<td>"+key['zc2018510448']+"</td>" +"<td>"+key['zc2018510450']+"</td>" +"<td>"+key['zc2018510452']+"</td>" +"<td>"+key['zc2018510456']+"</td>" +"<td>"+key['zc2018510458']+"</td>" +"<td>"+key['zc2018510463']+"</td>" +"<td>"+key['zc2018510465']+"</td>" +"<td>"+key['zc2018510469']+"</td>" +"<td>"+key['zc2018510479']+"</td>" +"<td>"+key['zc2018510490']+"</td>" +"<td>"+key['zc2018510496']+"</td>" +"<td>"+key['zc2018510498']+"</td>" +"<td>"+key['zc2018510499']+"</td>" +"<td>"+key['zc2018510520']+"</td>" +"<td>"+key['zc2018510524']+"</td>" +"<td>"+key['zc2018510534']+"</td>" +"<td>"+key['zc2018510537']+"</td>" +"<td>"+key['zc2018510541']+"</td>" +"<td>"+key['zc2018510543']+"</td>" +"<td>"+key['zc2018510552']+"</td>" +"<td>"+key['zc2018510564']+"</td>" +"<td>"+key['zc2018510568']+"</td>" +"<td>"+key['zc2018510569']+"</td>" +"<td>"+key['zc2018510579']+"</td>" +"<td>"+key['zc2018510588']+"</td>" +"<td>"+key['zc2018510591']+"</td>" +"<td>"+key['zc2018510592']+"</td>" +"<td>"+key['zc2018510594']+"</td>" +"<td>"+key['zc2018510596']+"</td>" +"<td>"+key['zc2018510600']+"</td>" +"<td>"+key['zc2018510601']+"</td>" +"<td>"+key['zc2018510616']+"</td>" +"<td>"+key['zc2018510618']+"</td>" +"<td>"+key['zc2018510620']+"</td>" +"<td>"+key['zc2018510625']+"</td>" +"<td>"+key['zc2018510628']+"</td>" +"<td>"+key['zc2018510636']+"</td>" +"<td>"+key['zc2018510640']+"</td>" +"<td>"+key['zc2018510643']+"</td>" +"<td>"+key['zc2018510647']+"</td>" +"<td>"+key['zc2018510664']+"</td>" +"<td>"+key['zc2018510666']+"</td>" +"<td>"+key['zc2018510668']+"</td>" +"<td>"+key['zc2018510671']+"</td>" +"<td>"+key['zc2018510672']+"</td>" +"<td>"+key['zc2018510679']+"</td>" +"<td>"+key['zc2018510681']+"</td>" +"<td>"+key['zc2018510691']+"</td>" +"<td>"+key['zc2018510695']+"</td>" +"<td>"+key['zc2018510696']+"</td>" +"<td>"+key['zc2018510705']+"</td>" +"<td>"+key['zc2018510708']+"</td>" +"<td>"+key['zc2018510713']+"</td>" +"<td>"+key['zc2018510721']+"</td>" +"<td>"+key['zc2018510722']+"</td>" +"<td>"+key['zc2018510728']+"</td>" +"<td>"+key['zc2018510729']+"</td>" +"<td>"+key['zc2018510752']+"</td>" +"<td>"+key['zc2018510753']+"</td>" +"<td>"+key['zc2018510755']+"</td>" +"<td>"+key['final']+"</td>" +
                            "<td class='td-manage'>" +
                                "<span class='label label - success radius'><a onClick='edit("+key['id']+")'>编辑</a></span>" +
                                "<span class='label radius'><a onClick='delete_single("+key['id']+")'>删除</a></span>" +
                            "</td>" +
                        "</tr>"
                    );
                    i++;
                }
            }
        }
    });
})
function edit(id) {
    layer_show('代码生成','/admin/Synthesize1803/viewAddEdit?id='+id,800,500);
}

function delete_single(id) {

    $.ajax({
        type : "POST",
        contentType: "application/x-www-form-urlencoded",
        url : "/admin/Synthesize1803/deleteData",
        data : {
            target:id
        },
        success : function(res) {
            if(res.status == 200){
                window.parent.location.reload();
            }
        }
    });

}

