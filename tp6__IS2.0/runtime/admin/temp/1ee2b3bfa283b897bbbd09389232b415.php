<?php /*a:3:{s:82:"/library/WebServer/Documents/tp6/app/admin/view/generate/ojsetspaper/add_edit.html";i:1581063382;s:65:"/library/WebServer/Documents/tp6/app/admin/view/public/_meta.html";i:1579946887;s:67:"/library/WebServer/Documents/tp6/app/admin/view/public/_footer.html";i:1579951299;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
    <script type="text/javascript" src="/lib/html5.js"></script>
    <script type="text/javascript" src="/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/static/h-ui.admin.pro/css/h-ui.admin.pro.iframe.min.css" />
<link rel="stylesheet" type="text/css" href="/lib/Hui-iconfont/1.0.9/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/static/business/css/style.css" />
<link rel="stylesheet" type="text/css" href="/assets/css/public/tip.css" />
<!--[if IE 6]>
    <script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
<![endif]-->

</head>
<body style="background-color:#fff">
<div class="wap-container">
	<div class="panel">
		<div class="panel-body">
			<form class="form form-horizontal" id="form-admin-add">
				<div id="four_button">
					<input id='add_base_info' class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;添加试卷信息&nbsp;&nbsp;">
					<input id='add_single' class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;添加单选题&nbsp;&nbsp;">
					<input id='add_multiple' class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;添加多选题&nbsp;&nbsp;">
					<input id='add_judge' class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;添加判断题&nbsp;&nbsp;">
					<input id='commit' class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
				</div>
				<div id="were_set">
					<div class="row clearfix" id="singles_set">
						<strong>单选题</strong>
						<div id="singles_remove">

						</div>
					</div>
					<div class="row clearfix" id="multiples_set">
						<strong>多选题</strong>
						<div id="multiples_remove">

						</div>
					</div>
					<div class="row clearfix" id="judges_set">
						<strong>判断题</strong>
						<div id="judges_remove">

						</div>
					</div>
				</div>

				<div id="add_base_info_unit">
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3">试卷名</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" id="head">
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3">开始时间</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" id="bornline">
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3">截止时间</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" id="deadline">
						</div>
					</div>
					<strong>时间请用时间戳填写</strong>
					<div class="row clearfix">
						<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
							<input id='confirm_base_info' class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;确定添加&nbsp;&nbsp;">
						</div>
					</div>
					<div class="row clearfix">
						<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
							<input id='back_base_info' class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;返回&nbsp;&nbsp;">
						</div>
					</div>
				</div>

				<div id="add_single_unit">
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3">单选题目</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" id="title_single">
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3">A选项</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" id="a_single">
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3">B选项</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" id="b_single">
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3">C选项</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" id="c_single">
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3">D选项</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" id="d_single">
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3">正确选项</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" id="answer_single">
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3">答案解析</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" id="analysis_single">
						</div>
					</div>
					<div class="row clearfix">
						<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
							<input id='confirm_single' class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;确定添加&nbsp;&nbsp;">
						</div>
					</div>
					<div class="row clearfix">
						<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
							<input id='back_single' class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;返回&nbsp;&nbsp;">
						</div>
					</div>
				</div>


				<div id="add_multiple_unit">
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3">多选题目</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" id="title_multiple">
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3">A选项</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" id="a_multiple">
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3">B选项</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" id="b_multiple">
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3">C选项</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" id="c_multiple">
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3">D选项</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" id="d_multiple">
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3">正确选项</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" id="answer_multiple">
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3">答案解析</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" id="analysis_multiple">
						</div>
					</div>
					<strong>多选正确选项用：选项-选项 例如：a-b</strong>
					<div class="row clearfix">
						<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
							<input id='confirm_multiple' class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;确定添加&nbsp;&nbsp;">
						</div>
					</div>
					<div class="row clearfix">
						<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
							<input id='back_multiple' class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;返回&nbsp;&nbsp;">
						</div>
					</div>
				</div>



				<div id="add_judge_unit">
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3">判断题目</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" id="title_judge">
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3">A选项</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" id="a_judge">
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3">B选项</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" id="b_judge">
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3">正确选项</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" id="answer_judge">
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3">答案解析</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" id="analysis_judge">
						</div>
					</div>
					<div class="row clearfix">
						<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
							<input id='confirm_judge' class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;确定添加&nbsp;&nbsp;">
						</div>
					</div>
					<div class="row clearfix">
						<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
							<input id='back_judge' class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;返回&nbsp;&nbsp;">
						</div>
					</div>
				</div>

			</form>
		</div>
	</div>
</div>
<script type="text/javascript" src="/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/lib/layer/3.1.1/layer.js"></script>
<script type="text/javascript" src="/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/static/h-ui.admin.pro/js/h-ui.admin.pro.iframe.min.js"></script>
<!--我的assets-->
<script type="text/javascript" src="/assets/js/public/tip.js"></script>
<script type="text/javascript" src="/assets/js/admin/admin_public/admin.menu.js"></script>
<script type="text/javascript" src="/assets/js/admin/admin_public/admin.header.js"></script>
<script src="/assets/js/admin/generate/ojsetspaper/add.edit.js"></script>
</body>
</html>
