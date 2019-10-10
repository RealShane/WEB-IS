define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'forum_module/index' + location.search,
                    add_url: 'forum_module/add',
                    edit_url: 'forum_module/edit',
                    del_url: 'forum_module/del',
                    multi_url: 'forum_module/multi',
                    table: 'forum_module',
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
                        {field: 'id', title: __('Id')},
                        {field: 'module', title: __('Module')},
                        {field: 'imgavatar', title: __('Imgavatar'), events: Table.api.events.image, formatter: Table.api.formatter.image},
                        {field: 'description', title: __('Description')},
                        {field: 'type', title: __('Type')},
                        {field: 'link', title: __('Link')},
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