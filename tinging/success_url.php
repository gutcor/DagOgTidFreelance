<?php 
	
	require_once('./header.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Takk for tinginga og velkomen som lesar av Dag og Tid </title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
</head>
<style type="text/css">

/*@font-face {
  font-family: 'Conv_FedraSansCondAltStd-Medium';
  src: url('../fonts/FedraSansCondAltStd-Medium.eot');
  src: local('☺'), url('../fonts/FedraSansCondAltStd-Medium.woff') format('woff'), url('../fonts/FedraSansCondAltStd-Medium.ttf') format('truetype'), url('../fonts/FedraSansCondAltStd-Medium.svg') format('svg');
  font-weight: normal;
  font-style: normal;
}*/

h1 {
	text-align: center;
    font-size: 200px;
    margin: 0px;
    color: #66cc33;
}

h3 {
	text-transform: uppercase;
    text-align: center;
    font-size: 1.5em;
    font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;
	color:#fff;
	padding: 0 20px;
    line-height: 2em;
}

#bg {
    position: fixed;
    top: -56%;
    left: -50%;
    width: 200%;
    height: 200%;
}

#bg img {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    margin: auto;
    min-width: 50%;
    min-height: 50%;
}

#thankyou {
	background: #00d2ff;
    background: -webkit-linear-gradient(to left, #183F7F , #114E91);
    background: linear-gradient(to left, #183F7F , #114E91);
    padding-left: 35px;
    padding-right: 35px;
    padding-top: 35px;
    padding-bottom: 50px;
    width: 450px;
    float: left;
    left: 50%;
    position: absolute;
    margin-top: 30px;
    margin-left: -260px;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    min-height: 300px;
}

@media only screen and (min-width: 768px) {
	#thankyou {
		margin-top: 300px;
	}
}

@media only screen and (max-width: 580px) {
  #bg {
    top: -50%;
    left: -170%;
}

#thankyou {
	left: 3%;
    margin-right: 3%;
    width: 88%;
    margin-left: 0;
    padding-left: 3%;
    padding-right: 3%;
    margin-top: 300px;
}
}

@media only screen and (max-width: 414px) {
	#thankyou {
		margin-top: 100px;
	}

	h1 {
		font-size: 50px;
	}
}

</style>
<body>
<div id="bg">
	<img src="./img/Rannveig-dag-og-tid-bg.jpg" alt="bilde av rannveig larsen som leser dag og tid"/>
</div>
<div id="thankyou">
	<h3>TAKK FOR TINGINGA OG VELKOMEN SOM LESAR AV DAG OG TID!</h3>
	<h1>&#10003;</h1>
</div>
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','//connect.facebook.net/en_US/fbevents.js');
 
fbq('init', '1255663171116647');
fbq('track', "PageView");</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1255663171116647&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
 
 
 
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
 
  ga('create', 'UA-77712643-1', 'auto');
  ga('send', 'pageview');
 
</script>
</body>
</html>