define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'course/index' + location.search,
                    add_url: 'course/add',
                    edit_url: 'course/edit',
                    del_url: 'course/del',
                    multi_url: 'course/multi',
                    table: 'course',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id'),visible:false},
                        {field: 'name', title: __('Name')},
                        {field: 'myname', title: __('Myname')},
                        {field: 'location', title: __('Location')},
                        {field: 'time', title: __('Time')},
                        {field: 'imgimage', title: __('Imgimage'), events: Table.api.events.image, formatter: Table.api.formatter.image},
                        {field: 'description', title: __('Description')},
                        {field: 'link', title: __('Link')},
                        {field: 'limitid', title: __('Limitid')},
                        {field: 'limitsize', title: __('Limitsize')},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});