$(document).ready(function(){

    $(document).ready(function(){

        $.ajax({
            type : "POST",
            contentType : "application/x-www-form-urlencoded",
            url : "/admin/AdminTable/getAllTable",
            success : function(res) {
                for (let key of res.result){

                    $("#tables_name").append(
                        "<option>"+key['Tables_in_tp6']+"</option>"
                    );
                }
            }
        });

        $.ajax({
            type : "POST",
            contentType : "application/x-www-form-urlencoded",
            url : "/admin/AdminCatalogue/seeAll",
            success : function(res) {
                for (let key of res.result){
                    $("#catalogue").append(
                        "<option value="+key['id']+">├ "+key['catalogue_name']+"</option>"
                    );
                }
            }
        });

    });

    $("#send").click(function(){

        var tableName = $("#tables_name").val();
        var catalogue = $("#catalogue").val();
        $.ajax({
            type : "POST",
            contentType : "application/x-www-form-urlencoded",
            url : "/admin/AdminTable/codeGenerator",
            data : {
                tableName:tableName,
                catalogue:catalogue
            },
            success : function(res) {
                if(res.status == 200){
                    window.parent.location.reload();
                }
            }
        });

    });

});