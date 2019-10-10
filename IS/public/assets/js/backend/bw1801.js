define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'bw1801/index' + location.search,
                    add_url: 'bw1801/add',
                    edit_url: 'bw1801/edit',
                    del_url: 'bw1801/del',
                    multi_url: 'bw1801/multi',
                    table: 'bw1801',
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
                        {field: 'message', title: __('Message')},
                        {field: 'type', title: __('Type'), searchList: {"新一届":__('新一届'),"上一届":__('上一届')}, formatter: Table.api.formatter.normal},
                        {field: 'zc2018510428', title: __('Zc2018510428')},
                        {field: 'zc2018510440', title: __('Zc2018510440')},
                        {field: 'zc2018510441', title: __('Zc2018510441')},
                        {field: 'zc2018510459', title: __('Zc2018510459')},
                        {field: 'zc2018510460', title: __('Zc2018510460')},
                        {field: 'zc2018510466', title: __('Zc2018510466')},
                        {field: 'zc2018510467', title: __('Zc2018510467')},
                        {field: 'zc2018510471', title: __('Zc2018510471')},
                        {field: 'zc2018510472', title: __('Zc2018510472')},
                        {field: 'zc2018510474', title: __('Zc2018510474')},
                        {field: 'zc2018510476', title: __('Zc2018510476')},
                        {field: 'zc2018510477', title: __('Zc2018510477')},
                        {field: 'zc2018510483', title: __('Zc2018510483')},
                        {field: 'zc2018510485', title: __('Zc2018510485')},
                        {field: 'zc2018510486', title: __('Zc2018510486')},
                        {field: 'zc2018510492', title: __('Zc2018510492')},
                        {field: 'zc2018510493', title: __('Zc2018510493')},
                        {field: 'zc2018510497', title: __('Zc2018510497')},
                        {field: 'zc2018510521', title: __('Zc2018510521')},
                        {field: 'zc2018510523', title: __('Zc2018510523')},
                        {field: 'zc2018510527', title: __('Zc2018510527')},
                        {field: 'zc2018510530', title: __('Zc2018510530')},
                        {field: 'zc2018510547', title: __('Zc2018510547')},
                        {field: 'zc2018510548', title: __('Zc2018510548')},
                        {field: 'zc2018510550', title: __('Zc2018510550')},
                        {field: 'zc2018510561', title: __('Zc2018510561')},
                        {field: 'zc2018510570', title: __('Zc2018510570')},
                        {field: 'zc2018510576', title: __('Zc2018510576')},
                        {field: 'zc2018510577', title: __('Zc2018510577')},
                        {field: 'zc2018510581', title: __('Zc2018510581')},
                        {field: 'zc2018510582', title: __('Zc2018510582')},
                        {field: 'zc2018510583', title: __('Zc2018510583')},
                        {field: 'zc2018510587', title: __('Zc2018510587')},
                        {field: 'zc2018510598', title: __('Zc2018510598')},
                        {field: 'zc2018510599', title: __('Zc2018510599')},
                        {field: 'zc2018510603', title: __('Zc2018510603')},
                        {field: 'zc2018510612', title: __('Zc2018510612')},
                        {field: 'zc2018510619', title: __('Zc2018510619')},
                        {field: 'zc2018510621', title: __('Zc2018510621')},
                        {field: 'zc2018510624', title: __('Zc2018510624')},
                        {field: 'zc2018510632', title: __('Zc2018510632')},
                        {field: 'zc2018510635', title: __('Zc2018510635')},
                        {field: 'zc2018510637', title: __('Zc2018510637')},
                        {field: 'zc2018510646', title: __('Zc2018510646')},
                        {field: 'zc2018510648', title: __('Zc2018510648')},
                        {field: 'zc2018510650', title: __('Zc2018510650')},
                        {field: 'zc2018510654', title: __('Zc2018510654')},
                        {field: 'zc2018510656', title: __('Zc2018510656')},
                        {field: 'zc2018510658', title: __('Zc2018510658')},
                        {field: 'zc2018510663', title: __('Zc2018510663')},
                        {field: 'zc2018510665', title: __('Zc2018510665')},
                        {field: 'zc2018510667', title: __('Zc2018510667')},
                        {field: 'zc2018510673', title: __('Zc2018510673')},
                        {field: 'zc2018510675', title: __('Zc2018510675')},
                        {field: 'zc2018510677', title: __('Zc2018510677')},
                        {field: 'zc2018510682', title: __('Zc2018510682')},
                        {field: 'zc2018510683', title: __('Zc2018510683')},
                        {field: 'zc2018510687', title: __('Zc2018510687')},
                        {field: 'zc2018510689', title: __('Zc2018510689')},
                        {field: 'zc2018510693', title: __('Zc2018510693')},
                        {field: 'zc2018510703', title: __('Zc2018510703')},
                        {field: 'zc2018510712', title: __('Zc2018510712')},
                        {field: 'zc2018510725', title: __('Zc2018510725')},
                        {field: 'zc2018510736', title: __('Zc2018510736')},
                        {field: 'zc2018510737', title: __('Zc2018510737')},
                        {field: 'zc2018510738', title: __('Zc2018510738')},
                        {field: 'zc2018510746', title: __('Zc2018510746')},
                        {field: 'zc2018512998', title: __('Zc2018512998')},
                        {field: 'zc2018512962', title: __('Zc2018512962')},
                        {field: 'final', title: __('Final')},
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