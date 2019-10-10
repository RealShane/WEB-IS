define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'article/index' + location.search,
                    add_url: 'article/add',
                    edit_url: 'article/edit',
                    del_url: 'article/del',
                    multi_url: 'article/multi',
                    table: 'article',
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
                        {field: 'author', title: __('Author')},
                      	{field: 'titlecontent', title: __('titlecontent')},
                        {field: 'user_type', title: __('User_type'), searchList: {"正式成员":__('正式成员'),"管理员":__('管理员')}, formatter: Table.api.formatter.normal},
                        {field: 'classes', title: __('Classes')},
                        {field: 'link', title: __('Link')},
                        {field: 'time', title: __('Time'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'type', title: __('Type')},
                        {field: 'verify', title: __('Verify'), searchList: {"通过":__('通过'),"不过":__('不过')}, formatter: Table.api.formatter.normal},
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