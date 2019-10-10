define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'sdc1804/index' + location.search,
                    add_url: 'sdc1804/add',
                    edit_url: 'sdc1804/edit',
                    del_url: 'sdc1804/del',
                    multi_url: 'sdc1804/multi',
                    table: 'sdc1804',
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
                        {field: 'classes', title: __('Classes')},
                        {field: 'ps', title: __('Ps')},
                        {field: 'is_afl', title: __('Is_afl'), searchList: {"有":__('有'),"无":__('无')}, formatter: Table.api.formatter.normal},
                        {field: 'time', title: __('Time'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'judge', title: __('Judge')},
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