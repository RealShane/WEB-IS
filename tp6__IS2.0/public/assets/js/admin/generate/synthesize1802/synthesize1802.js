
$(document).ready(function(){

    $(document).ready(function(){

        $.ajax({
            type : "POST",
            contentType : "application/x-www-form-urlencoded",
            url : "/admin/Synthesize1802/seeAll",
            success : function(res) {
                var i = 1;
                $("#data_num").append(
                    "<strong>"+res.result.length+"</strong>"
                );
                for(let key of res.result){

                    $("#dataRoom").append(
                        "<tr>" +
                            "<td><input type='checkbox' name='multiple' value="+key['id']+"></td>>" +
                            "<td>"+key['id']+"</td>" +"<td>"+key['name']+"</td>" +"<td>"+key['student_id']+"</td>" +"<td>"+key['situation']+"</td>" +"<td>"+key['message']+"</td>" +"<td>"+key['zc2018510431']+"</td>" +"<td>"+key['zc2018510432']+"</td>" +"<td>"+key['zc2018510436']+"</td>" +"<td>"+key['zc2018510439']+"</td>" +"<td>"+key['zc2018510444']+"</td>" +"<td>"+key['zc2018510453']+"</td>" +"<td>"+key['zc2018510462']+"</td>" +"<td>"+key['zc2018510464']+"</td>" +"<td>"+key['zc2018510475']+"</td>" +"<td>"+key['zc2018510481']+"</td>" +"<td>"+key['zc2018510482']+"</td>" +"<td>"+key['zc2018510488']+"</td>" +"<td>"+key['zc2018510489']+"</td>" +"<td>"+key['zc2018510495']+"</td>" +"<td>"+key['zc2018510500']+"</td>" +"<td>"+key['zc2018510504']+"</td>" +"<td>"+key['zc2018510510']+"</td>" +"<td>"+key['zc2018510513']+"</td>" +"<td>"+key['zc2018510531']+"</td>" +"<td>"+key['zc2018510533']+"</td>" +"<td>"+key['zc2018510535']+"</td>" +"<td>"+key['zc2018510540']+"</td>" +"<td>"+key['zc2018510542']+"</td>" +"<td>"+key['zc2018510546']+"</td>" +"<td>"+key['zc2018510553']+"</td>" +"<td>"+key['zc2018510554']+"</td>" +"<td>"+key['zc2018510559']+"</td>" +"<td>"+key['zc2018510560']+"</td>" +"<td>"+key['zc2018510563']+"</td>" +"<td>"+key['zc2018510566']+"</td>" +"<td>"+key['zc2018510584']+"</td>" +"<td>"+key['zc2018510589']+"</td>" +"<td>"+key['zc2018510590']+"</td>" +"<td>"+key['zc2018510595']+"</td>" +"<td>"+key['zc2018510597']+"</td>" +"<td>"+key['zc2018510605']+"</td>" +"<td>"+key['zc2018510606']+"</td>" +"<td>"+key['zc2018510613']+"</td>" +"<td>"+key['zc2018510615']+"</td>" +"<td>"+key['zc2018510617']+"</td>" +"<td>"+key['zc2018510622']+"</td>" +"<td>"+key['zc2018510651']+"</td>" +"<td>"+key['zc2018510659']+"</td>" +"<td>"+key['zc2018510660']+"</td>" +"<td>"+key['zc2018510669']+"</td>" +"<td>"+key['zc2018510676']+"</td>" +"<td>"+key['zc2018510684']+"</td>" +"<td>"+key['zc2018510686']+"</td>" +"<td>"+key['zc2018510699']+"</td>" +"<td>"+key['zc2018510716']+"</td>" +"<td>"+key['zc2018510720']+"</td>" +"<td>"+key['zc2018510724']+"</td>" +"<td>"+key['zc2018510726']+"</td>" +"<td>"+key['zc2018510727']+"</td>" +"<td>"+key['zc2018510730']+"</td>" +"<td>"+key['zc2018510731']+"</td>" +"<td>"+key['zc2018510739']+"</td>" +"<td>"+key['zc2018510740']+"</td>" +"<td>"+key['zc2018510744']+"</td>" +"<td>"+key['zc2018510745']+"</td>" +"<td>"+key['zc2018510748']+"</td>" +"<td>"+key['zc2018510750']+"</td>" +"<td>"+key['zc2018512964']+"</td>" +"<td>"+key['final']+"</td>" +
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
        layer_show('代码生成','/admin/Synthesize1802/viewAddEdit?id=-1',800,500);
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
            url : "/admin/Synthesize1802/batchDeleteData",
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
        url : "/admin/Synthesize1802/retrieveData",
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
                            "<td>"+key['id']+"</td>" +"<td>"+key['name']+"</td>" +"<td>"+key['student_id']+"</td>" +"<td>"+key['situation']+"</td>" +"<td>"+key['message']+"</td>" +"<td>"+key['zc2018510431']+"</td>" +"<td>"+key['zc2018510432']+"</td>" +"<td>"+key['zc2018510436']+"</td>" +"<td>"+key['zc2018510439']+"</td>" +"<td>"+key['zc2018510444']+"</td>" +"<td>"+key['zc2018510453']+"</td>" +"<td>"+key['zc2018510462']+"</td>" +"<td>"+key['zc2018510464']+"</td>" +"<td>"+key['zc2018510475']+"</td>" +"<td>"+key['zc2018510481']+"</td>" +"<td>"+key['zc2018510482']+"</td>" +"<td>"+key['zc2018510488']+"</td>" +"<td>"+key['zc2018510489']+"</td>" +"<td>"+key['zc2018510495']+"</td>" +"<td>"+key['zc2018510500']+"</td>" +"<td>"+key['zc2018510504']+"</td>" +"<td>"+key['zc2018510510']+"</td>" +"<td>"+key['zc2018510513']+"</td>" +"<td>"+key['zc2018510531']+"</td>" +"<td>"+key['zc2018510533']+"</td>" +"<td>"+key['zc2018510535']+"</td>" +"<td>"+key['zc2018510540']+"</td>" +"<td>"+key['zc2018510542']+"</td>" +"<td>"+key['zc2018510546']+"</td>" +"<td>"+key['zc2018510553']+"</td>" +"<td>"+key['zc2018510554']+"</td>" +"<td>"+key['zc2018510559']+"</td>" +"<td>"+key['zc2018510560']+"</td>" +"<td>"+key['zc2018510563']+"</td>" +"<td>"+key['zc2018510566']+"</td>" +"<td>"+key['zc2018510584']+"</td>" +"<td>"+key['zc2018510589']+"</td>" +"<td>"+key['zc2018510590']+"</td>" +"<td>"+key['zc2018510595']+"</td>" +"<td>"+key['zc2018510597']+"</td>" +"<td>"+key['zc2018510605']+"</td>" +"<td>"+key['zc2018510606']+"</td>" +"<td>"+key['zc2018510613']+"</td>" +"<td>"+key['zc2018510615']+"</td>" +"<td>"+key['zc2018510617']+"</td>" +"<td>"+key['zc2018510622']+"</td>" +"<td>"+key['zc2018510651']+"</td>" +"<td>"+key['zc2018510659']+"</td>" +"<td>"+key['zc2018510660']+"</td>" +"<td>"+key['zc2018510669']+"</td>" +"<td>"+key['zc2018510676']+"</td>" +"<td>"+key['zc2018510684']+"</td>" +"<td>"+key['zc2018510686']+"</td>" +"<td>"+key['zc2018510699']+"</td>" +"<td>"+key['zc2018510716']+"</td>" +"<td>"+key['zc2018510720']+"</td>" +"<td>"+key['zc2018510724']+"</td>" +"<td>"+key['zc2018510726']+"</td>" +"<td>"+key['zc2018510727']+"</td>" +"<td>"+key['zc2018510730']+"</td>" +"<td>"+key['zc2018510731']+"</td>" +"<td>"+key['zc2018510739']+"</td>" +"<td>"+key['zc2018510740']+"</td>" +"<td>"+key['zc2018510744']+"</td>" +"<td>"+key['zc2018510745']+"</td>" +"<td>"+key['zc2018510748']+"</td>" +"<td>"+key['zc2018510750']+"</td>" +"<td>"+key['zc2018512964']+"</td>" +"<td>"+key['final']+"</td>" +
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

$("#search_data_export_file").click(function(){
    var searchKey = $("#searchKey").val();
    var searchValue = $("#searchValue").val();
    setTimeout(location.href="/admin/Synthesize1802/export_file?key="+searchKey+"&value="+searchValue, 1000);
})

function edit(id) {
    layer_show('代码生成','/admin/Synthesize1802/viewAddEdit?id='+id,800,500);
}

function delete_single(id) {

    $.ajax({
        type : "POST",
        contentType: "application/x-www-form-urlencoded",
        url : "/admin/Synthesize1802/deleteData",
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

