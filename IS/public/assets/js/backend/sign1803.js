define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'sign1803/index' + location.search,
                    add_url: 'sign1803/add',
                    edit_url: 'sign1803/edit',
                    del_url: 'sign1803/del',
                    multi_url: 'sign1803/multi',
                    table: 'sign1803',
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
                        {field: 'course_id', title: __('Course_id')},
                        {field: 'classes_id', title: __('Classes_id')},
                        {field: 'signmark', title: __('Signmark')},
                        {field: 'tutorialmark', title: __('Tutorialmark')},
                        {field: 'allmark', title: __('Allmark')},
                        {field: 'year', title: __('Year')},
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