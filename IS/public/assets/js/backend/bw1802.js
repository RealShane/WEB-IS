define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'bw1802/index' + location.search,
                    add_url: 'bw1802/add',
                    edit_url: 'bw1802/edit',
                    del_url: 'bw1802/del',
                    multi_url: 'bw1802/multi',
                    table: 'bw1802',
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
                        {field: 'zc2018510431', title: __('Zc2018510431')},
                        {field: 'zc2018510432', title: __('Zc2018510432')},
                        {field: 'zc2018510436', title: __('Zc2018510436')},
                        {field: 'zc2018510439', title: __('Zc2018510439')},
                        {field: 'zc2018510444', title: __('Zc2018510444')},
                        {field: 'zc2018510453', title: __('Zc2018510453')},
                        {field: 'zc2018510462', title: __('Zc2018510462')},
                        {field: 'zc2018510464', title: __('Zc2018510464')},
                        {field: 'zc2018510475', title: __('Zc2018510475')},
                        {field: 'zc2018510481', title: __('Zc2018510481')},
                        {field: 'zc2018510482', title: __('Zc2018510482')},
                        {field: 'zc2018510488', title: __('Zc2018510488')},
                        {field: 'zc2018510489', title: __('Zc2018510489')},
                        {field: 'zc2018510495', title: __('Zc2018510495')},
                        {field: 'zc2018510500', title: __('Zc2018510500')},
                        {field: 'zc2018510504', title: __('Zc2018510504')},
                        {field: 'zc2018510510', title: __('Zc2018510510')},
                        {field: 'zc2018510513', title: __('Zc2018510513')},
                        {field: 'zc2018510531', title: __('Zc2018510531')},
                        {field: 'zc2018510533', title: __('Zc2018510533')},
                        {field: 'zc2018510535', title: __('Zc2018510535')},
                        {field: 'zc2018510540', title: __('Zc2018510540')},
                        {field: 'zc2018510542', title: __('Zc2018510542')},
                        {field: 'zc2018510546', title: __('Zc2018510546')},
                        {field: 'zc2018510553', title: __('Zc2018510553')},
                        {field: 'zc2018510554', title: __('Zc2018510554')},
                        {field: 'zc2018510559', title: __('Zc2018510559')},
                        {field: 'zc2018510560', title: __('Zc2018510560')},
                        {field: 'zc2018510563', title: __('Zc2018510563')},
                        {field: 'zc2018510566', title: __('Zc2018510566')},
                        {field: 'zc2018510584', title: __('Zc2018510584')},
                        {field: 'zc2018510589', title: __('Zc2018510589')},
                        {field: 'zc2018510590', title: __('Zc2018510590')},
                        {field: 'zc2018510595', title: __('Zc2018510595')},
                        {field: 'zc2018510597', title: __('Zc2018510597')},
                        {field: 'zc2018510605', title: __('Zc2018510605')},
                        {field: 'zc2018510606', title: __('Zc2018510606')},
                        {field: 'zc2018510613', title: __('Zc2018510613')},
                        {field: 'zc2018510615', title: __('Zc2018510615')},
                        {field: 'zc2018510617', title: __('Zc2018510617')},
                        {field: 'zc2018510622', title: __('Zc2018510622')},
                        {field: 'zc2018510651', title: __('Zc2018510651')},
                        {field: 'zc2018510659', title: __('Zc2018510659')},
                        {field: 'zc2018510660', title: __('Zc2018510660')},
                        {field: 'zc2018510669', title: __('Zc2018510669')},
                        {field: 'zc2018510676', title: __('Zc2018510676')},
                        {field: 'zc2018510684', title: __('Zc2018510684')},
                        {field: 'zc2018510686', title: __('Zc2018510686')},
                        {field: 'zc2018510699', title: __('Zc2018510699')},
                        {field: 'zc2018510716', title: __('Zc2018510716')},
                        {field: 'zc2018510720', title: __('Zc2018510720')},
                        {field: 'zc2018510724', title: __('Zc2018510724')},
                        {field: 'zc2018510726', title: __('Zc2018510726')},
                        {field: 'zc2018510727', title: __('Zc2018510727')},
                        {field: 'zc2018510730', title: __('Zc2018510730')},
                        {field: 'zc2018510731', title: __('Zc2018510731')},
                        {field: 'zc2018510739', title: __('Zc2018510739')},
                        {field: 'zc2018510740', title: __('Zc2018510740')},
                        {field: 'zc2018510744', title: __('Zc2018510744')},
                        {field: 'zc2018510745', title: __('Zc2018510745')},
                        {field: 'zc2018510748', title: __('Zc2018510748')},
                        {field: 'zc2018510750', title: __('Zc2018510750')},
                        {field: 'zc2018512964', title: __('Zc2018512964')},
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