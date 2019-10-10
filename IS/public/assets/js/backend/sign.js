define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'sign/index' + location.search,
                    add_url: 'sign/add',
                    edit_url: 'sign/edit',
                    del_url: 'sign/del',
                    multi_url: 'sign/multi',
                    table: 'sign',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'signid',
                sortName: 'signid',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'signid', title: __('Signid'),visible:false},
                        {field: 'studentid', title: __('Studentid')},
                        {field: 'studentname', title: __('Studentname')},
                        {field: 'course_id', title: __('Course_id'),visible:false},
                        {field: 'classes_id', title: __('Classes_id'),visible:false},
                        {field: 'signmark', title: __('Signmark')},
                        {field: 'year', title: __('Year')},
                        {field: 'classes.name', title: __('Classes.name')},
                        {field: 'course.name', title: __('Course.name')},
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