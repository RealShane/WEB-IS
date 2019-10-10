define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'openletter/index' + location.search,
                    add_url: 'openletter/add',
                    edit_url: 'openletter/edit',
                    del_url: 'openletter/del',
                    multi_url: 'openletter/multi',
                    table: 'openletter',
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
                        {field: 'name', title: __('Name')},
                        {field: 'myid', title: __('Myid')},
                        {field: 'title', title: __('Title')},
                        {field: 'time', title: __('Time'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'classes', title: __('Classes')},
                        {field: 'type', title: __('Type'), searchList: {"正式成员":__('正式成员'),"管理员":__('管理员')}, formatter: Table.api.formatter.normal},
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