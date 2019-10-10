<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:101:"/www/wwwroot/serv.huihuagongxue.top/IS/public/../application/origin/view/pofficefetch/openletter.html";i:1566196878;s:79:"/www/wwwroot/serv.huihuagongxue.top/IS/application/origin/view/public/head.html";i:1564733160;s:84:"/www/wwwroot/serv.huihuagongxue.top/IS/application/origin/view/public/nav_login.html";i:1566468789;s:79:"/www/wwwroot/serv.huihuagongxue.top/IS/application/origin/view/public/foot.html";i:1566445837;}*/ ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="format-detection" content="telephone=no">
<meta name="theme-color" content="#282828"/>
<meta property="og:type" content="website">
<!-- 图标 -->
<link href="/IS/public/static/ico/apple-touch-icon-144-precomposed.png" rel="apple-touch-icon" sizes="144x144">
<link href="/IS/public/static/ico/apple-touch-icon-114-precomposed.png" rel="apple-touch-icon" sizes="114x114">
<link href="/IS/public/static/ico/apple-touch-icon-72-precomposed.png" rel="apple-touch-icon" sizes="72x72">
<link href="/IS/public/static/ico/apple-touch-icon-57-precomposed.png" rel="apple-touch-icon">
<link href="/IS/public/static/ico/favicon.png" rel="shortcut icon">
<!-- jQuery (Bootstrap 插件需要引入) -->
<script src="/IS/public/static/js/runoob.jquery.js"></script>
<script src="/IS/public/static/js/jquery.cookie.js"></script>
<!-- LayUI-->
<script src="/IS/public/static/layui/layui.all.js"></script>
<link rel="stylesheet" href="/IS/public/static/layui/css/layui.css">
<!-- CSS 文件 -->
<link rel="stylesheet" href="/IS/public/static/css/fontawesome.min.css">
<link rel="stylesheet" href="/IS/public/static/css/animate.min.css">
<link rel="stylesheet" href="/IS/public/static/css/fancybox.min.css">
<link rel="stylesheet" href="/IS/public/static/css/odometer.min.css">
<link rel="stylesheet" href="/IS/public/static/css/swiper.min.css">
<link rel="stylesheet" href="/IS/public/static/css/bootstrap.min.css">
<link rel="stylesheet" href="/IS/public/static/css/style.css">
<link rel="stylesheet" href="/IS/public/static/css/simple-line-icons.css">
<title>工学部综合系统-时光邮箱</title>
<script type="text/javascript">
	//监测是否登录
	var seed=$.cookie();
	$().ready(function(){
		if(seed.status!=0){
			document.cookie="email_type=index";
			var a=$("<small><a href=''>登录</a></small>");
            a.appendTo("#a");
		}else{
			var a=$("<h4>你好："+seed.name+"&nbsp;&nbsp;"+seed.user_type+"</h4>");
            a.appendTo("#a");
			var b=$("<small><a href='' id='quit'>退出登录</a></small>");
            b.appendTo("#a");
		}
	});
	$().ready(function(){
		var url = location.search; //获取url中"?"符后的字串  
   		var theRequest = new Object();  
		if (url.indexOf("?") != -1) {  
			var str = url.substr(1);  
			strs = str.split("&");  
      		for(var i = 0; i < strs.length; i ++) {  
				theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]);  
      		}  
		}  
		var creed=theRequest.id;
		$.ajax({
			url:"<?php echo url('origin/poffice/letter_info'); ?>",
	  		async:true,
			type:'post',
			dataType:'json',
			data:{
				id:creed
			},
			success(res){
				var bigtitle=$("<h1>"+res.title+"</h1><p>"+res.classes+"</p></figcaption></figure></div>");
				bigtitle.appendTo("#bigtitle");
				var title=$("<h2>"+res.title+"</h2>");
				title.appendTo("#title");
				var info=$("<small>寄信人："+res.name+"&nbsp;&nbsp;"+res.type+"</small>&nbsp;&nbsp;<small>班级："+res.classes+"</small>&nbsp;&nbsp;<small>发布寄信时间："+res.time+"</small>");
				info.appendTo("#title");
				var txt=$("<p>"+res.letter+"</p>");
				txt.appendTo("#txt");
			}	
		});
		$("#quit").click(function(){
			document.cookie="email_type=index";
			document.cookie = "id=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
			document.cookie = "name=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
			document.cookie = "myid=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
			document.cookie = "classes=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
			document.cookie = "status=1; expires=Thu, 01 Jan 1970 00:00:00 GMT";
			document.cookie = "rand_num=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
			document.cookie = "user_type=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
			setTimeout("location.href='/IS/public/login_PO'");//跳转
  		});
	});
	
</script>
</head>
<body>
	<!--加载动画-->
<script type="text/javascript">
	var seed=$.cookie();
	$().ready(function(){
		var id=seed.id;
		var rand_num=seed.rand_num;
		$.ajax({
			url:"<?php echo url('origin/issimlogin/is_sim_login'); ?>",
			async:true,
			type:'post',
			dataType:'json',
			data:{
				id:id,
				rand_num:rand_num
			},
			success(res){
				if(res.is_sim_login==true){
					alert("此账号在其他地方登录！请重新登录！");
					document.cookie = "id=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
					document.cookie = "name=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
					document.cookie = "myid=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
					document.cookie = "classes=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
					document.cookie = "status=1; expires=Thu, 01 Jan 1970 00:00:00 GMT";
					document.cookie = "rand_num=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
					document.cookie = "user_type=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
					setTimeout("location.href='/IS/public/'");
				}
			}	
		});
	});
</script>
	<div class="preloader">
		<div class="layer"></div>
  		<div class="inner">
    		<figure><img src="/IS/public/static/images/preloader.gif" alt="Image"></figure>
    		<p><span class="text-rotater" data-text="汇华学院 | 工学部 | 极客联盟">加载</span></p>
  		</div> 
	</div>
	<!--/加载动画-->
	<div class="transition-overlay">
  		<div class="layer"></div>
	</div>
	<!--手机版本侧边栏-->
	<div class="side-navigation">
		<!--手机版本导航栏-->
  		<div class="menu">
    		<ul>
      			<li><a href="/IS/public/">主页</a></li>
      			<li>
					<a>第二课堂</a>
        			<ul>
          				<li><a href="/IS/public/secondclass">新课程</a></li>
          				<li><a href="/IS/public/lecturers">讲师列表</a></li>
						<li><a href="/IS/public/tutoriallist">微课堂报名</a></li>
          				<li><a href="/IS/public/search">查讯报名情况</a></li>
        			</ul>
      			</li>
      			<li>
					<a>综合测评</a>
        			<ul>
          				<li><a href="/IS/public/origin">综合测评</a></li>
          				<li><a href="/IS/public/sign_PK">贫困生报名</a></li>
          				<li><a href="/IS/public/origin_PK">贫困生测评</a></li>
          				<li><a href="/IS/public/origin_BW">班委测评</a></li>
        			</ul>
      			</li>
      			<li>
					<a>时光信箱</a>
        			<ul>
          				<li><a href="/IS/public/TimePoffice">公开信</a></li>
          				<li><a href="/IS/public/TimeLetter">时光信件</a></li>
          				<li><a href="/IS/public/FutureLetterList">信件提取</a></li>
        			</ul>
      			</li>
				<li><a href="/IS/public/SDC">自律委查勤系统</a></li>
      			<li><a href="/IS/public/forum">论坛</a></li>
      			<li><a href="">联系我们</a></li>
    		</ul>
  		</div>
  		<!--/手机版本导航栏-->
  		<div class="side-content">
    		<figure> <img src="/IS/public/static/images/logo-light.png" alt="Image"> </figure>
    		<p>开发者：Shane</p>
    		<ul class="gallery">
      			<li><a href="/IS/public/static/images/developer1.jpg" data-fancybox><img src="/IS/public/static/images/developer1.jpg" alt="Image"></a></li>
    		</ul>
    		<address>河北师范大学汇华学院</address>
    		<h6>QQ：1109571639</h6>
    		<p><a>特别感谢：Rex</a></p>
			<ul class="gallery">
      			<li><a href="/IS/public/static/images/developer2.jpg" data-fancybox><img src="/IS/public/static/images/developer2.jpg" alt="Image"></a></li>
    		</ul>
			<h6>QQ：321257088</h6>
    		<ul class="social-media">
      			<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
      			<li><a href="#"><i class="fab fa-twitter"></i></a></li>
      			<li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
      			<li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
      			<li><a href="#"><i class="fab fa-youtube"></i></a></li>
    		</ul>
    		<small>© 2019 汇华学院 | 极客联盟Shane</small> 
		</div> 
	</div>
	<!--/手机版本侧边栏-->
	<!-- 电脑本导航栏 -->
	<nav class="navbar">
  		<div class="container">
    		<div class="upper-side">
				<!--图标-->
      			<div class="logo"> 
					<a href="/IS/public/"><img src="/IS/public/static/images/logo-light.png" alt="Image"></a> 
				</div>
				<div class="phone-email" id="a"> 
					<!--姓名放在这里-->
						<!--退出按钮放这里-->
				</div>
				<div class="language"> <a>CH</a><small>Only For CH</small></div>
      			<div class="hamburger"> <span></span> <span></span> <span></span><span></span> </div> 
    		</div>
    		<!-- 一级导航栏 -->
    		<div class="menu">
      			<ul>
        			<li><a href="/IS/public/">主页</a></li>
        			<li>
						<a>第二课堂</a>
          				<ul>
            				<li><a href="/IS/public/secondclass">新课程</a></li>
            				<li><a href="/IS/public/lecturers">讲师列表</a></li>
							<li><a href="/IS/public/tutoriallist">微课堂报名</a></li>
            				<li><a href="/IS/public/search">查讯报名情况</a></li>
          				</ul>
        			</li>
        			<li>
						<a>综合测评</a>
          				<ul>
            				<li><a href="/IS/public/origin">综合测评</a></li>
            				<li><a href="/IS/public/sign_PK">贫困生报名</a></li>
            				<li><a href="/IS/public/origin_PK">贫困生测评</a></li>
							<li><a href="/IS/public/origin_BW">班委测评</a></li>
          				</ul>
        			</li>
        			<li>
						<a>时光信箱</a>
          				<ul>
            				<li><a href="/IS/public/TimePoffice">公开信</a></li>
          					<li><a href="/IS/public/TimeLetter">时光信件</a></li>
          					<li><a href="/IS/public/FutureLetterList">信件提取</a></li>
          				</ul>
        			</li>
					<li><a href="/IS/public/SDC">自律委查勤系统</a></li>
        			<li><a href="/IS/public/forum">论坛</a></li>
        			<li><a href="">联系我们</a></li>
      			</ul>
    		</div>
    		<!-- / 一级导航栏 -->
  		</div>
	</nav>
	<!-- /电脑版本导航栏 -->
	<header class="page-header" data-background="/IS/public/static/images/time.jpg" data-stellar-background-ratio="1.15">
		<div class="container" id="bigtitle">
		  	<ol class="breadcrumb">
    			<li class="breadcrumb-item"><a>信内容</a></li>
    			<li class="breadcrumb-item active" aria-current="page"><a href="/IS/public/TimePoffice">Back</a></li>
  			</ol>
		</div>
	</header>
	<section class="about-content">
		<div class="container">
			<div class="row">
				<div class="col-12" id="title">
					<!--文章标题-->
					<!--作者-->
					<!--班级-->
					<!--时间-->
				</div>
     			<div class="col-12" id="txt">
        			<br>
       			</div>
			</div>
		</div>
	</section>
	<!--脚部-->
	<footer class="footer">
  		<div class="container">
    		<div class="row">
      			<div class="col-lg-4 wow fadeInUp" data-wow-delay="0.05s"> 
					<img src="/IS/public/static/images/logo-light.png" alt="Image" class="logo">
        			<p>工学部综合系统IS</p>
      			</div>
      			<div class="col-lg-2 col-md-6 wow fadeInUp" data-wow-delay="0.10s">
        			<ul class="footer-menu">
          				<li><a href="/IS/public/secondclass">第二课堂</a></li>
          				<li><a href="/IS/public/origin">综合测评</a></li>
          				<li><a href="/IS/public/TimePoffice">时光信箱</a></li>
          				<li><a href="/IS/public/forum">论坛</a></li>
          				<li><a href="#">联系我们</a></li>
        			</ul>
      			</div>
      			<div class="col-lg-2 col-md-6 wow fadeInUp" data-wow-delay="0.15s">
        			<ul class="footer-menu">
          				<li><a href="http://huihua.hebtu.edu.cn/xxgcxb/">工学部网站</a></li>
          				<li><a href="http://huihua.hebtu.edu.cn/">汇华学院网站</a></li>
          				<li><a href="http://huihua.hebtu.edu.cn/xfz/">学分制系统</a></li>
          				<li><a href="/IS/public/SDC">自律委查勤系统</a></li>
        			</ul>
      			</div>
      			<div class="col-lg-4 wow fadeInUp" data-wow-delay="0.20s">
        			<div class="contact-box">
          				<h5>遇到问题？快联系我</h5>
          				<h3>13315926692</h3>
          				<p><a>1109571639@qq.com</a></p>
          				<ul>
            				<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
            				<li><a href="#"><i class="fab fa-twitter"></i></a></li>
            				<li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
            				<li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
            				<li><a href="#"><i class="fab fa-youtube"></i></a></li>
          				</ul>
        			</div>
      			</div>
      			<div class="col-12"> 
					<span class="copyright">© 2019 汇华学院 | 极客联盟Shane</span> 
				</div>
   			 </div>
		</div> 
	</footer>
<!-- JS 文件 --> 
<script src="/IS/public/static/js/jquery.min.js"></script> 
<script src="/IS/public/static/js/popper.min.js"></script> 
<script src="/IS/public/static/js/bootstrap.min.js"></script> 
<script src="/IS/public/static/js/swiper.min.js"></script> 
<script src="/IS/public/static/js/fancybox.min.js"></script> 
<script src="/IS/public/static/js/odometer.min.js"></script> 
<script src="/IS/public/static/js/wow.min.js"></script> 
<script src="/IS/public/static/js/text-rotater.js"></script> 
<script src="/IS/public/static/js/jquery.stellar.js"></script> 
<script src="/IS/public/static/js/isotope.min.js"></script> 
<script src="/IS/public/static/js/scripts.js"></script>

</body>
</html>