define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'bw1804/index' + location.search,
                    add_url: 'bw1804/add',
                    edit_url: 'bw1804/edit',
                    del_url: 'bw1804/del',
                    multi_url: 'bw1804/multi',
                    table: 'bw1804',
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
                        {field: 'zc2018510794', title: __('Zc2018510794')},
                        {field: 'zc2018510795', title: __('Zc2018510795')},
                        {field: 'zc2018510796', title: __('Zc2018510796')},
                        {field: 'zc2018510798', title: __('Zc2018510798')},
                        {field: 'zc2018510799', title: __('Zc2018510799')},
                        {field: 'zc2018510800', title: __('Zc2018510800')},
                        {field: 'zc2018510801', title: __('Zc2018510801')},
                        {field: 'zc2018510802', title: __('Zc2018510802')},
                        {field: 'zc2018510803', title: __('Zc2018510803')},
                        {field: 'zc2018510804', title: __('Zc2018510804')},
                        {field: 'zc2018510805', title: __('Zc2018510805')},
                        {field: 'zc2018510806', title: __('Zc2018510806')},
                        {field: 'zc2018510807', title: __('Zc2018510807')},
                        {field: 'zc2018510808', title: __('Zc2018510808')},
                        {field: 'zc2018510809', title: __('Zc2018510809')},
                        {field: 'zc2018510810', title: __('Zc2018510810')},
                        {field: 'zc2018510811', title: __('Zc2018510811')},
                        {field: 'zc2018510812', title: __('Zc2018510812')},
                        {field: 'zc2018510813', title: __('Zc2018510813')},
                        {field: 'zc2018510814', title: __('Zc2018510814')},
                        {field: 'zc2018510816', title: __('Zc2018510816')},
                        {field: 'zc2018510817', title: __('Zc2018510817')},
                        {field: 'zc2018510818', title: __('Zc2018510818')},
                        {field: 'zc2018510819', title: __('Zc2018510819')},
                        {field: 'zc2018510820', title: __('Zc2018510820')},
                        {field: 'zc2018510821', title: __('Zc2018510821')},
                        {field: 'zc2018510822', title: __('Zc2018510822')},
                        {field: 'zc2018510823', title: __('Zc2018510823')},
                        {field: 'zc2018510824', title: __('Zc2018510824')},
                        {field: 'zc2018510825', title: __('Zc2018510825')},
                        {field: 'zc2018510826', title: __('Zc2018510826')},
                        {field: 'zc2018510827', title: __('Zc2018510827')},
                        {field: 'zc2018510828', title: __('Zc2018510828')},
                        {field: 'zc2018510829', title: __('Zc2018510829')},
                        {field: 'zc2018510830', title: __('Zc2018510830')},
                        {field: 'zc2018510832', title: __('Zc2018510832')},
                        {field: 'zc2018510833', title: __('Zc2018510833')},
                        {field: 'zc2018510834', title: __('Zc2018510834')},
                        {field: 'zc2018510835', title: __('Zc2018510835')},
                        {field: 'zc2018510836', title: __('Zc2018510836')},
                        {field: 'zc2018510837', title: __('Zc2018510837')},
                        {field: 'zc2018510838', title: __('Zc2018510838')},
                        {field: 'zc2018510839', title: __('Zc2018510839')},
                        {field: 'zc2018510840', title: __('Zc2018510840')},
                        {field: 'zc2018510841', title: __('Zc2018510841')},
                        {field: 'zc2018510842', title: __('Zc2018510842')},
                        {field: 'zc2018510843', title: __('Zc2018510843')},
                        {field: 'zc2018510844', title: __('Zc2018510844')},
                        {field: 'zc2018510845', title: __('Zc2018510845')},
                        {field: 'zc2018510846', title: __('Zc2018510846')},
                        {field: 'zc2018510847', title: __('Zc2018510847')},
                        {field: 'zc2018510848', title: __('Zc2018510848')},
                        {field: 'zc2018510849', title: __('Zc2018510849')},
                        {field: 'zc2018510851', title: __('Zc2018510851')},
                        {field: 'zc2018510853', title: __('Zc2018510853')},
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