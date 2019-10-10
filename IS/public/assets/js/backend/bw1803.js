define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'bw1803/index' + location.search,
                    add_url: 'bw1803/add',
                    edit_url: 'bw1803/edit',
                    del_url: 'bw1803/del',
                    multi_url: 'bw1803/multi',
                    table: 'bw1803',
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
                        {field: 'zc2018510429', title: __('Zc2018510429')},
                        {field: 'zc2018510435', title: __('Zc2018510435')},
                        {field: 'zc2018510438', title: __('Zc2018510438')},
                        {field: 'zc2018510447', title: __('Zc2018510447')},
                        {field: 'zc2018510448', title: __('Zc2018510448')},
                        {field: 'zc2018510450', title: __('Zc2018510450')},
                        {field: 'zc2018510452', title: __('Zc2018510452')},
                        {field: 'zc2018510456', title: __('Zc2018510456')},
                        {field: 'zc2018510458', title: __('Zc2018510458')},
                        {field: 'zc2018510463', title: __('Zc2018510463')},
                        {field: 'zc2018510465', title: __('Zc2018510465')},
                        {field: 'zc2018510469', title: __('Zc2018510469')},
                        {field: 'zc2018510479', title: __('Zc2018510479')},
                        {field: 'zc2018510490', title: __('Zc2018510490')},
                        {field: 'zc2018510496', title: __('Zc2018510496')},
                        {field: 'zc2018510498', title: __('Zc2018510498')},
                        {field: 'zc2018510499', title: __('Zc2018510499')},
                        {field: 'zc2018510520', title: __('Zc2018510520')},
                        {field: 'zc2018510524', title: __('Zc2018510524')},
                        {field: 'zc201510534', title: __('Zc201510534')},
                        {field: 'zc2018510537', title: __('Zc2018510537')},
                        {field: 'zc2018510541', title: __('Zc2018510541')},
                        {field: 'zc2018510543', title: __('Zc2018510543')},
                        {field: 'zc2018510552', title: __('Zc2018510552')},
                        {field: 'zc2018510564', title: __('Zc2018510564')},
                        {field: 'zc2018510568', title: __('Zc2018510568')},
                        {field: 'zc2018510569', title: __('Zc2018510569')},
                        {field: 'zc2018510579', title: __('Zc2018510579')},
                        {field: 'zc2018510588', title: __('Zc2018510588')},
                        {field: 'zc2018510591', title: __('Zc2018510591')},
                        {field: 'zc2018510592', title: __('Zc2018510592')},
                        {field: 'zc2018510594', title: __('Zc2018510594')},
                        {field: 'zc2018510596', title: __('Zc2018510596')},
                        {field: 'zc2018510600', title: __('Zc2018510600')},
                        {field: 'zc2018510601', title: __('Zc2018510601')},
                        {field: 'zc2018510616', title: __('Zc2018510616')},
                        {field: 'zc2018510618', title: __('Zc2018510618')},
                        {field: 'zc2018510620', title: __('Zc2018510620')},
                        {field: 'zc2018510625', title: __('Zc2018510625')},
                        {field: 'zc2018510628', title: __('Zc2018510628')},
                        {field: 'zc2018510636', title: __('Zc2018510636')},
                        {field: 'zc2018510640', title: __('Zc2018510640')},
                        {field: 'zc2018510643', title: __('Zc2018510643')},
                        {field: 'zc2018510647', title: __('Zc2018510647')},
                        {field: 'zc2018510664', title: __('Zc2018510664')},
                        {field: 'zc2018510666', title: __('Zc2018510666')},
                        {field: 'zc2018510668', title: __('Zc2018510668')},
                        {field: 'zc2018510671', title: __('Zc2018510671')},
                        {field: 'zc2018510672', title: __('Zc2018510672')},
                        {field: 'zc2018510679', title: __('Zc2018510679')},
                        {field: 'zc2018510681', title: __('Zc2018510681')},
                        {field: 'zc2018510691', title: __('Zc2018510691')},
                        {field: 'zc2018510695', title: __('Zc2018510695')},
                        {field: 'zc2018510696', title: __('Zc2018510696')},
                        {field: 'zc2018510705', title: __('Zc2018510705')},
                        {field: 'zc2018510708', title: __('Zc2018510708')},
                        {field: 'zc2018510713', title: __('Zc2018510713')},
                        {field: 'zc2018510721', title: __('Zc2018510721')},
                        {field: 'zc2018510722', title: __('Zc2018510722')},
                        {field: 'zc2018510728', title: __('Zc2018510728')},
                        {field: 'zc2018510729', title: __('Zc2018510729')},
                        {field: 'zc2018510752', title: __('Zc2018510752')},
                        {field: 'zc2018510753', title: __('Zc2018510753')},
                        {field: 'zc2018510755', title: __('Zc2018510755')},
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