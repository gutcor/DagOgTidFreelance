<?php 
	
	require_once('./header.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Bur du i utlandet? </title>
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
    text-align: left;
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
    left: 3%;
    margin-right: 3%;
    width: 88%;
    margin-left: 0;
    padding-left: 3%;
    padding-right: 3%;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    min-height: 300px;
    z-index: 100!important;
    position: relative;
}

a.emailStyle {
    font-size: 0.8em;
    color: #F48B11;
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
    z-index: 100!important;
    position: relative;
}
}

@media only screen and (max-width: 414px) {
	#thankyou {
		margin-top: 100px;
        z-index: 100!important;
        position: relative;
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
	<h3>Abonnementsprisen er den same i utlandet som i Noreg, men dessverre kan du ikkje registrere tinginga direkte. Send ein e-post til <a class="emailStyle" href="mailto:tinging@dagogtid.no" target="_top">tinging@dagogtid.no</a> og opplys kva for abonnement du ynskjer saman med den fullstendige postadressa di, så ordnar vi resten.</h3>
	
</div>
</body>
</html>