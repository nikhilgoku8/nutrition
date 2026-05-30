<!DOCTYPE html>
<html>
<head>
  
<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1998748663982420');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1998748663982420&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->
 
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Thank You</title>
<style>

*{
	margin: 0;
	padding: 0;
}
.thank_you_page{
	background: #55754e;
	min-height: 100vh;
	display: flex;
	flex-direction: column;
	align-items: center;
	justify-content: center;
}
.thank_you_page .inner_container{
	padding: 10vw;
	text-align: center;
	color: #fff;
}
.thank_you_page .logo_box{
	text-align: center;
}
.thank_you_page .logo_box img{
	width: 300px;
	max-width: 90%;
}
.thank_you_page .inner_container .line_1{
	padding: 2vw 0;
	font-size: 18px;
}
.thank_you_page .inner_container .line_2{
	font-size: 2em;	
	padding: 0 0 2vw 0;
}

</style>
</head>
<body>

<div class="thank_you_page">
	<div class="inner_container">
		<div class="logo_box">
			<a href="./">
				<img src="images/logo.png">
			</a>
		</div>
		<h1 class="line_1">Thank you for taking the first step.</h1>
		<p class="line_2">Now book your FREE consultation slot - absolutely no cost, only your time.</p>

		

		<!-- Cal inline embed code begins -->
		<div style="width:100%;height:100%;overflow:scroll" id="my-cal-inline-15min"></div>
		<script type="text/javascript">
		(function (C, A, L) { let p = function (a, ar) { a.q.push(ar); }; let d = C.document; C.Cal = C.Cal || function () { let cal = C.Cal; let ar = arguments; if (!cal.loaded) { cal.ns = {}; cal.q = cal.q || []; d.head.appendChild(d.createElement("script")).src = A; cal.loaded = true; } if (ar[0] === L) { const api = function () { p(api, arguments); }; const namespace = ar[1]; api.q = api.q || []; if(typeof namespace === "string"){cal.ns[namespace] = cal.ns[namespace] || api;p(cal.ns[namespace], ar);p(cal, ["initNamespace", namespace]);} else p(cal, ar); return;} p(cal, ar); }; })(window, "https://app.cal.com/embed/embed.js", "init");
		Cal("init", "15min", {origin:"https://app.cal.com"});

		Cal.ns["15min"]("inline", {
			elementOrSelector:"#my-cal-inline-15min",
			config: {"layout":"month_view","useSlotsViewOnSmallScreen":"true"},
			calLink: "nutrition-with-vibha/15min",
		});

		Cal.ns["15min"]("ui", {"hideEventTypeDetails":false,"layout":"month_view"});
		</script>
		<!-- Cal inline embed code ends -->


	</div>
</div>

</body>
</html>