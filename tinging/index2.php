<?php require_once('./header.php'); ?>
<!DOCTYPE html>
<html lang="en" class="not_logged_in order">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
  <link rel="stylesheet" type="text/css" href="./css/common.css">
  <link rel="stylesheet" type="text/css" href="./css/custom.css">

    
  <link rel="stylesheet" type="text/css" href="./css/exposure.css">
  <link rel="stylesheet" type="text/css" href="./css/nett.css">
  <link rel="stylesheet" type="text/css" href="./css/main.css">
 
  <title>Dag Og Tid Sommarkampanje</title>


  <script type="text/javascript" src="./js/prototype.js"></script>
  <script type="text/javascript">
        var i18n = {
        "error.update.prefix" : "Det oppsto en feil.",
        "error.update.suffix" : "Hvis problemet vedvarer, prøv å logge ut og inn igjen.",
        "error.update.notsaved" : "Endringene ble ikke lagret.",
        "calendar.holidays" : "01.01:1. nyttårsdag;01.05:Offentlig høytidsdag;17.05:Grunnlovsdag;24.12:Julaften;25.12:1. juledag;26.12:2. juledag;31.12:Nyttårsaften",
        "calendar.months.full" : "Januar;Februar;Mars;April;Mai;Juni;Juli;August;September;Oktober;November;Desember",
        "calendar.months.abbr" : "JAN;FEB;MAR;APR;MAI;JUN;JUL;AUG;SEP;OKT;NOV;DES",
        "calendar.days.abbr.sunday.first" : "Søn;Man;Tir;Ons;Tor;Fre;Lør",
        "calendar.gotoString" : "Gå til innevårende måned",
        "calendar.todayString" : "Dagens dato:",
        "calendar.weekString" : "Uke",
        "calendar.scrollLeftMessage" : "Klikk for å gå til forrige måned, hold ned ventre museknapp for bla fort bakover.",
        "calendar.scrollRightMessage" : "Klikk for å gå til neste måned, hold ned ventre museknapp for bla fort fremover.",
        "calendar.selectMonthMessage" : "Klikk for å velge måned.",
        "calendar.selectYearMessage" : "Klikk for å velge år.",
        "calendar.selectDateMessage" : "Velg [date] som dato."
        };
</script>
 <script type="text/javascript" src="./js/form.js"></script>
  


  <script type="text/javascript">
      // Disable ajax-definitions in form.js
      function buttonClick() { return true; }
    </script>

  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>-->

</head>

<body>
<div id="boxes">
  <div style="display: none; color:#000;" id="dialog" class="window"> Abonnementsvilkår for Dag og Tid
    <div id="lorem">
      <p class="vilkaar-para">* Eit abonnement på vekeavisa Dag og Tid består av anten papiravisa eller ei elektronisk utgåve av denne. (Ikkje kombinasjon).</p>
      <p class="vilkaar-para">* Abonnementsprisen er den same i heile verda.</p>
      <p class="vilkaar-para">* Abonnementet er løpande fram til det vert sagt opp av abonnenten. Manglande betaling vert ikkje rekna som oppseiing.</p>
      <p class="vilkaar-para">* Eit unntak frå dette er gåveabonnement, som stoppar automatisk dersom ikkje gjevaren har meldt frå at han vil betale det fast.</p>
      <p class="vilkaar-para">* Varsel om fornying av abonnementet vert sendt om lag ein månad før forfall. Betaling må skje innan forfall for å unngå opphald i leveringa.</p>
      <p class="vilkaar-para">* Dag og Tid vert levert med Posten, og det er viktig at abonnenten passar på at leveringsadressa er korrekt og at postkassa er godt merka.</p>
      <p class="vilkaar-para">* Ved stopp på grunn av manglande betaling av tilbod, vil det verte sendt faktura basert på fullpris for den perioden avisa er levert.</p>
    </div>
    <div id="popupfoot"> <a href="#" class="close agree">LUKK</a> </div>
  </div>
  <div style="width: 100%; font-size: 32pt; color:white; height: 2000px; display: none; opacity: 0.8;" id="mask"></div>
</div>
<div id="bg">
  <img src="./img/dag-og-tid-background.jpg" alt="dag og tid backgrounds blilde">
</div>
  <script type="text/javascript" src="./js/effects.js"></script>
  <script type="text/javascript">
    var dateFormat = "dd.mm.yyyy";
  	var calendarImgDir = "./img/";
  	var imagesBaseDir = "./img/";
</script>
<script type="text/javascript" src="./js/popcalendar.js"></script>
<div onclick="bShow=true" id="calendar" 

style="z-index:+999;position:absolute;visibility:hidden;border-width:1px;border-style:solid;border-color:#a0a0a0">

<table width="250" style="font-family:arial;font-size:11px;font-family:arial; font-size:11px" bgcolor="#ffffff">

<tbody>
<tr bgcolor="#0000aa">
<td>
<table width="248">
<tbody>
<tr>
<td style="padding:2px;font-family:arial; font-size:11px;">
<font color="#ffffff"><b>
<span id="caption">
<span id="spanLeft" style="border-style:solid;border-width:1px;border-color:#3366FF;cursor:pointer" onmouseover="swapImage(&quot;changeLeft&quot;,&quot;left2.gif&quot;);this.style.borderColor=&quot;#88AAFF&quot;;window.status=&quot;Klikk for å gå til forrige måned, hold ned ventre museknapp for bla fort bakover.&quot;" onclick="javascript:decMonth()" onmouseout="clearInterval(intervalID1);swapImage(&quot;changeLeft&quot;,&quot;left1.gif&quot;);this.style.borderColor=&quot;#3366FF&quot;;window.status=&quot;&quot;" onmousedown="clearTimeout(timeoutID1);timeoutID1=setTimeout(&quot;StartDecMonth()&quot;,500)" onmouseup="clearTimeout(timeoutID1);clearInterval(intervalID1)">&nbsp;<img id="changeLeft" src="./img/left1.gif" width="10" height="11" border="0">&nbsp;</span>&nbsp;<span id="spanRight" style="border-style:solid;border-width:1px;border-color:#3366FF;cursor:pointer" onmouseover="swapImage(&quot;changeRight&quot;,&quot;right2.gif&quot;);this.style.borderColor=&quot;#88AAFF&quot;;window.status=&quot;Klikk for å gå til neste måned, hold ned ventre museknapp for bla fort fremover.&quot;" onmouseout="clearInterval(intervalID1);swapImage(&quot;changeRight&quot;,&quot;right1.gif&quot;);this.style.borderColor=&quot;#3366FF&quot;;window.status=&quot;&quot;" onclick="incMonth()" onmousedown="clearTimeout(timeoutID1);timeoutID1=setTimeout(&quot;StartIncMonth()&quot;,500)" onmouseup="clearTimeout(timeoutID1);clearInterval(intervalID1)">&nbsp;<img id="changeRight" src="./img/right1.gif" width="10" height="11" border="0">&nbsp;</span>&nbsp;<span id="spanMonth" style="border-style:solid;border-width:1px;border-color:#3366FF;cursor:pointer" onmouseover="swapImage(&quot;changeMonth&quot;,&quot;drop2.gif&quot;);this.style.borderColor=&quot;#88AAFF&quot;;window.status=&quot;Klikk for å velge måned.&quot;" onmouseout="swapImage(&quot;changeMonth&quot;,&quot;drop1.gif&quot;);this.style.borderColor=&quot;#3366FF&quot;;window.status=&quot;&quot;" onclick="popUpMonth()"></span>&nbsp;<span id="spanYear" style="border-style:solid;border-width:1px;border-color:#3366FF;cursor:pointer" onmouseover="swapImage(&quot;changeYear&quot;,&quot;drop2.gif&quot;);this.style.borderColor=&quot;#88AAFF&quot;;window.status=&quot;Klikk for å velge år.&quot;" onmouseout="swapImage(&quot;changeYear&quot;,&quot;drop1.gif&quot;);this.style.borderColor=&quot;#3366FF&quot;;window.status=&quot;&quot;" onclick="popUpYear()"></span>&nbsp;</span></b></font></td><td align="right"><a href="javascript:hideCalendar()"><img src="./img/close.gif" width="15" height="13" border="0" alt="Close the Calendar"></a></td></tr></tbody></table></td></tr><tr><td style="padding:5px" bgcolor="#ffffff"><span id="content"></span></td></tr><tr bgcolor="#f0f0f0"><td style="padding:5px" align="center"><span id="lblToday">Dagens dato:  <a onmousemove="window.status=&quot;Gå til innevårende måned&quot;" onmouseout="window.status=&quot;&quot;" title="Gå til innevårende måned" style="text-decoration:none;color:black;" href="javascript:monthSelected=monthNow;yearSelected=yearNow;constructCalendar();">Ons, 6 Apr  2016</a></span></td></tr></tbody></table></div><div id="selectMonth" style="z-index:+999;position:absolute;visibility:hidden;"></div><div id="selectYear" style="z-index:+999;position:absolute;visibility:hidden;"></div>
  <div id="form-main">
  <div id="form-div">
  <div class="subscribe">
  <span class="configurableText configurableText_ORDER_PRODUCT_DESCRIPTION" style="display: none;">Velkomen til Dag og Tid, vekeavisa som i 2014 hadde opplagsvekst for tolvte året på rad. Siste året var auken på 12,5 %, til 10.778 eksemplar.<div>&nbsp;&nbsp;<div>Her kan du enkelt tinge avisa for levering i
   postkassa di.</div>
  </div>
  </span>
	<form id="BestillWidget" class="BestillWidget" action="<?php print $url; ?>" method="get">
  		<input type="hidden" name="formWidgetId" value="BestillWidget">
  		<div class="border">
  		<div class="radioOverskrift">Sommarkampanje</div>
  		<table class="FieldsetWidget VelgAbonnementFieldset" border="0" cellspacing="0" cellpadding="0">
		<tbody>
			<tr class="eksponeringFacebook">
		  		<td class="fieldParent">
		  			<span class="field radio nobr" onclick="document.getElementById(&quot;id6341&quot;).click()">
		  			<input checked id="id6341" type="radio" name="endring.selectProduct" value="13"><label for="id6341"> 4 mnd. spesialpris kr 199 </label></span>
		  		</td>
		  	</tr>
		  	<tr class="eksponeringFacebook">
		  		<td class="fieldParent"><span class="field radio nobr" onclick="document.getElementById(&quot;id6342&quot;).click()">
		  		<input id="id6342" type="radio" name="endring.selectProduct" value="24"><label for="id6342"> 4 mnd. studentpris kr 149 </label></span>
		  		</td>
		  	</tr>
		  	<tr class="eksponering">
		  		<td class="fieldParent"><span class="field radio nobr" onclick="document.getElementById(&quot;id2889&quot;).click()">
		  		<input id="id2889" type="radio" name="endring.selectProduct" value="10"><label for="id2889">  Studentabonnement fire månader 395 kroner</label></span>
		  		</td>
		  	</tr>
		  	<tr class="eksponering">
		  		<td class="fieldParent"><span class="field radio nobr" onclick="document.getElementById(&quot;id2890&quot;).click()">
		  		<input id="id2890" type="radio" name="endring.selectProduct" value="6"><label for="id2890"> Vanleg abonnement eit halvt år 1090 kroner</label></span>
		  		</td>
		  	</tr>
		  	<tr class="eksponering">
		  		<td class="fieldParent"><span class="field radio nobr" onclick="document.getElementById(&quot;id2891&quot;).click()">
		  		<input id="id2891" type="radio" name="endring.selectProduct" value="9"><label for="id2891"> Studentabonnement eit halvt år 545 kroner</label></span>
		  		</td>
		  	</tr>
		  	<tr class="eksponering">
		  		<td class="fieldParent"><span class="field radio nobr" onclick="document.getElementById(&quot;id2892&quot;).click()">
		  		<input id="id2892" type="radio" name="endring.selectProduct" value="2"><label for="id2892"> Vanleg abonnement eitt år 2095 kroner</label></span>
		  		</td>
		  	</tr>
		  	<tr class="eksponering">
		  		<td class="fieldParent"><span class="field radio nobr" onclick="document.getElementById(&quot;id2893&quot;).click()">
		  		<input id="id2893" type="radio" name="endring.selectProduct" value="8"><label for="id2893"> Studentabonnement eitt år 1045 kroner</label></span>
		  		</td>
		  	</tr>
		  </tbody>
  		</table>
  </div>
  <!--<div class="marg">
  <span class="configurableText configurableText_ORDER_FORM_EXTRA_INFO">
  <p>For å kunne sende gratis prøvenummer til deg, treng vi nokre kontaktopplysningar. Vi ber difor om at du fyller ut skjemaet under så nøyaktig som mogleg. Dag og Tid vert distribuert med Posten, så dersom du har postboks, er det den adressa&nbsp;som skal brukast.</p>
  <p><font size="1"><font size="5"></font></font></p>
  <p>NB: Dersom du vil ha avisa sendt <strong>til utlandet</strong>, kan du dessverre&nbsp;ikkje bruke denne automatiske funksjonen. Skriv då ein e-post&nbsp;til&nbsp;<a href="mailto:tinging@dagogtid.no">tinging@dagogtid.no</a>&nbsp;med nøyaktig postadresse og telefonnummer og be om å få sendt tre gratis prøvenummer dit.</p><p><strong><font size="2">Gratis prøvenummer er like gratis til utlandet som heime. Og abonnementsprisen er også lik i heile verda.</font></strong></p>

  </span>
  </div>-->
  <table class="FieldsetWidget PrivatpersonFieldset" border="0" cellspacing="0" cellpadding="0">
  <tbody style="display:none">
  <tr>
  <td class="fieldParent">
  <span class="field radio nobr" onclick="document.getElementById(&quot;id6343&quot;).click()">
  <input id="id6343" type="radio" name="endring.privatperson" value="true" checked="checked" onclick="visPrivatperson(this, true, &quot;#ffffff&quot;)">Privatperson</span></td>
  <td class="fieldParent"><span class="field radio nobr" onclick="document.getElementById(&quot;id6344&quot;).click()">
  <input id="id6344" type="radio" name="endring.privatperson" value="false" onclick="visPrivatperson(this, false, &quot;#ffffff&quot;)">Firma</span>
  </td>
  </tr>
  </tbody>
  </table>
  <table class="FieldsetWidget AdresseFieldset autojuster" border="0" cellspacing="0" cellpadding="0">
  <tbody>
  <tr class="tableHeader">
  <td class="firstColumn"></td>
  <td class="otherColumn"></td>
  <td class="otherColumn"></td>
  <td class="otherColumn"></td>
  <td class="otherColumn"></td>
  <td class="otherColumn"></td>

  </tr>

  <p class="phone">
        <input name="endring.privat.mobil" type="tel" class="validate[required,custom[phone]] feedback-input field errorField" id="phhm" placeholder="Skriv inn telefonnummeret ditt her"/>
  </p>
      <div>
      <p class="name-help">Gjer vel og bruk eit gyldig telefonnummer</p>
    </div>

      <div style="display: none;">
<p class="label">Frå dato&nbsp;:</p>
<p class="field date nobr"><input id="id6345_text" type="text" name="endring.privat.fraDato" value="">
  <a href="https://connect.mediaconnect.no/selfservice/WEB-INF/felles/layout.jsp#" class="field" onclick="calendarClick(this, function() {null}); return false;" id="id6345_cal">
  <img alt="Velg en dag i kalenderen" src="./img/cal.gif" border="0" align="middle"></a>
  </p>
  </div>


      <div class="submit">
        <input type="button" value="Vidare >>" id="button-blue"/>
        <div class="ease"></div>
      </div>

      <div class="do-not-show">

          <p class="name">
            <input name="endring.privat.fornavn" type="text" class="validate[required,custom[onlyLetter],length[0,100]] feedback-input field errorField" placeholder="Førenamn" id="name" />
          </p>
          <div>
            <p class="name-help-name" style="display: none;">Gjer vel og rett opp Førenamn di dersom ho ikkje vart korrekt førehandsutfylt.</p>
          </div>
      
          
          <p class="lastname">
            <input name="endring.privat.etternavn" type="text" class="validate[required,custom[email]] feedback-input field errorField" id="lastname" placeholder="Etternamn" />
          </p>
          <div>
            <p class="name-help-lastname" style="display: none;">Gjer vel og rett opp Etternamn di dersom ho ikkje vart korrekt førehandsutfylt.</p>
          </div>

          <p class="c-o">
            <input name="endring.privat.co" type="text" class="validate[required,custom[email]] feedback-input field errorField" id="c-o" placeholder="c/o" />
          </p>
          
          <p class="address">
            <input name="endring.privat.gate" type="text" class="validate[required,custom[email]] feedback-input field errorField" id="address" placeholder="Gate/veg" />
          </p>
          <div>
            <p class="name-help-address" style="display: none;">Gjer vel og rett opp adressa di dersom ho ikkje vart korrekt førehandsutfylt.</p>
          </div>
         
          <p class="addressNumber">
            <input name="endring.privat.gatenummer" type="text" class="validate[required,custom[email]] feedback-input-small field errorField" id="addressNumber" placeholder="Nr." />
            <p class="oppgang">
            <input name="endring.privat.oppgang" type="text" class="validate[required,custom[email]] feedback-input-small field errorField" id="oppgang" placeholder="Oppgang" />
          </p>  
          </p>

          <p class="postzip">
            <input name="endring.privat.postnummer" type="text" class="validate[required,custom[email]] feedback-input field errorField" id="postzip" placeholder="Postnummer" />
          </p>

          <p class="place">
            <input name="endring.privat.sted" type="text" class="validate[required,custom[email]] feedback-input field errorField" id="place" placeholder="Stad" />
          </p>
          <div>
            <p class="name-help-place" style="display: none;">Gjer vel og rett opp postadressa di dersom ho ikkje vart korrekt førehandsutfylt.</p>
          </div>
          <p class="email">
            <input name="endring.privat.epost" type="email" class="validate[required,custom[email]] feedback-input field errorField" id="email" placeholder="Skriv inn e-postadressa di her" />
          </p>
           <div>
            <p class="name-help-email" style="display: none;">Gjer vel og bruk ei gyldig e-postadresse</p>
          </div>
          <div>
          	<input type="hidden" name="result_id" id="result_id" value="0" />
          </div>
  <div id="akseptfelt">
          <a href="http://dagogtid.com/test_api/bur-du-i-utlandet.php" class="utlandetMail" target="_top">Bur du i utlandet?</a>
          
            <div id="akseptfelt2"><span class="field checkbox nobr">
  <input id="id6348" type="checkbox" name="endring.generalPermission">
  <span onclick="document.getElementById(&quot;id6348&quot;).click()">
  <span class="configurableText configurableText_SELFSERVICE_PBM_COMBINED_TEXT">
  <span class="field checkbox nobr">Eg godtek <a href="#dialog" class="vilkaar">vilkåra</a></span>
  </span>
  </span>
  <p class="name-help-radio1" style="display: none; color:#FE5544;">Gjer vel og godta vilkåra</p>
  </div>
   <input id="id6348" type="checkbox" name="endring.generalPermission">
  <span onclick="document.getElementById(&quot;id6348&quot;).click()">
  <span class="configurableText configurableText_SELFSERVICE_PBM_COMBINED_TEXT">
  <span class="field checkbox nobr">Eg godtek at Dag og Tid kontaktar meg på e-post og sms med tilbod og informasjon</span>
  </span>
  </span>
  <p class="name-help-radio2" style="display: none;">Gjer vel og godta vilkåra</p>
  </div><!-- End Akseptfelt -->
         

          

         
        
     
      </div>
  
  <!--<tr><td class="labelParent phone"><span class="label">Førenamn&nbsp;:</span></td>
  <td class="fieldParent" colspan="5"><input class="field" type="text" name="endring.privat.fornavn" value=""></td>

  </tr>

  <tr>
  <td class="labelParent"><span class="label">Mellomnavn&nbsp;:</span>
  </td>
  <td class="fieldParent" colspan="5"><input class="field" type="text" name="endring.privat.mellomnavn" value=""></td>
  </tr>
  <tr><td class="labelParent"><span class="label">Etternamn&nbsp;:</span>
  </td>
  <td class="fieldParent" colspan="5"><input class="field" type="text" name="endring.privat.etternavn" value=""></td>
  </tr>
  <tr><td class="fieldParent" colspan="6"><input class="field" type="hidden" name="endring.privat.addressCategoryFreeValue" value=""></td>
  </tr>
  <tr><td class="labelParent"><span class="label">Firma&nbsp;:</span>
  </td>
  <td class="fieldParent" colspan="5"><input class="field" type="text" name="endring.privat.firma" value=""></td>
  </tr>
  <tr><td class="labelParent"><span class="label">c/o&nbsp;:</span>
  </td>
  <td class="fieldParent" colspan="5"><input class="field" type="text" name="endring.privat.co" value=""></td>
  </tr>
  <tr><td class="labelParent"><span class="label">Gate/veg&nbsp;:</span>
  </td>
  <td class="fieldParent" colspan="5"><input class="field" type="text" name="endring.privat.gate" value=""></td>
  </tr>
  <tr><td class="labelParent"><span class="label">Gatenr.&nbsp;:</span>
  </td><td class="fieldParent"><input class="field" type="text" name="endring.privat.gatenummer" value="">
  </td>
  <td class="labelParent"><span class="label">Oppg.&nbsp;:</span>
  </td>
  <td class="fieldParent"><input class="field" type="text" name="endring.privat.oppgang" value=""></td>
  <td class="labelParent"><span class="label">Etasje&nbsp;:</span>
  </td>
  <td class="fieldParent"><input class="field" type="text" name="endring.privat.etasje" value=""></td>
  </tr>
  <tr><td class="labelParent"><span class="label">Postnummer&nbsp;:</span></td>
  <td class="fieldParent"><input class="field" type="text" name="endring.privat.postnummer" value=""></td>-->
  <!--<td class="labelParent"><span class="label">Stad&nbsp;:</span>
  </td>
  <td class="fieldParent" colspan="3"><input class="field" type="text" name="endring.privat.sted" value=""></td>
  </tr>-->
 
  <!--<td class="labelParent"><span class="label">Tlf.&nbsp;:</span>
  </td>
  <td class="fieldParent" colspan="2"><input class="field" type="text" name="endring.privat.telefon" value=""></td>
  </tr>
  <tr>
  <td class="labelParent"><span class="label">E-post*&nbsp;:</span></td>
  <td class="fieldParent" colspan="5"><input class="field" type="text" name="endring.privat.epost" value=""></td>
  </tr>-->

  </tbody>
  </table>

    <div class="note" style="display:none">
  <span class="configurableText configurableText_ORDER_ADDRESS_HELP_TEXT">
  <strong><big>*&nbsp;</big></strong>Du må registrere mobilnummer og/eller e-postadressa di for seinare å kunne nytte deg av dei elektroniske tenestene våre, t.d. for å melde inn ferieomadressering.</span>
  </div>
  <table class="FieldsetWidget UtfyllFakturaadresseFieldset" border="0" cellspacing="0" cellpadding="0" style="display:none">
  <tbody>
  <tr>
  <td class="fieldParent" colspan="5"></td></tr>
  <tr><td class="fieldParent" colspan="5">
  <span class="field checkbox nobr">
  <input id="id6347" type="checkbox" name="endring.utfyllFakturaadresse" onclick="visUtfyllFakturaadresse(this)">
  <span onclick="document.getElementById(&quot;id6347&quot;).click()">
  <span class="configurableText configurableText_ORDER_INVOICE_RENEWAL_CHECKBOX">Oppgje fakturaadresse</span>
  </span>
  </span>
  </td>
  </tr>
  </tbody>
  </table>

  <div class="aksept">
  <table class="FieldsetWidget FieldsetWidget" border="0" cellspacing="0" cellpadding="0">
  <tbody style="display: none;">
  <tr>
  <td class="fieldParent">
  <input class="field" type="hidden" name="endring.exposureCode" value="NETT">
  </td>
  </tr>
  <tr>
  <td class="fieldParent">
  <span class="field checkbox nobr">
  <input id="id6348" type="checkbox" name="endring.generalPermission">
  <span onclick="document.getElementById(&quot;id6348&quot;).click()">
  <span class="configurableText configurableText_SELFSERVICE_PBM_COMBINED_TEXT">
  <span class="field checkbox nobr">Eg godtek at Dag og Tid kontaktar meg på e-post og sms med tilbod og informasjon</span>
  </span>

  <span class="field checkbox nobr">
  <input id="id6348" type="checkbox" name="endring.generalPermission">
  <span onclick="document.getElementById(&quot;id6348&quot;).click()">
  <span class="configurableText configurableText_SELFSERVICE_PBM_COMBINED_TEXT">
  <span class="field checkbox nobr">Eg godtek at Dag og Tid kontaktar meg på e-post og sms med tilbod og informasjon</span>
  </span>

  </span>
  </span>
  </td>
  </tr>
  </tbody>
  </table>
  <div class="litenskrift"><span class="configurableText configurableText_ORDER_BOTTOM_SMALL_INFO"><br></span></div><div class="ErrorWidget hidden"></div><button id="bestilling" class="button do-not-show" type="submit" onclick="return buttonClick(this)">Send tinginga di &gt;&gt;</button>
  <div class="easeBestilling"></div>
      </div>
  <img class="logo" src="./img/logo-dag-og-tid-250px.png" alt="logo fordag og tid" title="">
  </div>
  </div>
  </div><!--END NEW-->

  

  </form>
  


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script type="text/javascript" src="./js/jquery.validate.min.js"></script>
<script type="text/javascript" src="./js/additional-methods.js"></script>
  <script type="text/javascript" src="./js/main.js"></script>


  
<script type="text/javascript">
  
  /* Korriger visning ved reload i Firefox */
  var formElem = document.getElementById("BestillWidget");
  if(formElem) {
    var elem = findField(formElem, "privatperson");
    if(elem) { visPrivatperson(elem, elem.checked, null, true, true); }
    elem = findField(formElem, "utfyllFakturaadresse");
    if(elem) { visUtfyllFakturaadresse(elem, true); }
  }
        
</script>

        </div>
              <div class="minimumBredde">&nbsp;</div>
      </td>
      <td class="hoyreBanner">&nbsp;</td>
    </tr></tbody></table>
    <script type="text/javascript">

    
    var url = "http://bumpybones.no/DagOgTid/index2.html?eksponering=vanlig";
    var eksponeringsUrl = "https://connect.mediaconnect.no/selfservice/abonner/sendBestilling.do?tittel=DT&miljo=159"
    
    if(window.location.href === url) {
      j(".eksponeringFacebook").css('display' , 'none');
      j(".eksponering").css('display' , 'block');
      j("#BestillWidget").attr('action' , eksponeringsUrl);
    }
    
      /*focusFirstInput();*/
    </script>
    <script src="//platform.twitter.com/oct.js" type="text/javascript"></script>
<script type="text/javascript">twttr.conversion.trackPid('nu5gs', { tw_sale_amount: 0, tw_order_quantity: 0 });</script>
<noscript>
<img height="1" width="1" style="display:none;" alt="" src="https://analytics.twitter.com/i/adsct?txn_id=nu5gs&p_id=Twitter&tw_sale_amount=0&tw_order_quantity=0" />
<img height="1" width="1" style="display:none;" alt="" src="//t.co/i/adsct?txn_id=nu5gs&p_id=Twitter&tw_sale_amount=0&tw_order_quantity=0" />
</noscript>
 
 
 
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
    <!--[if IE]></div><![endif]--><!--[if lte IE 6]></div><![endif]-->
   <div class="script_LIVECHAT"></div>
    
</body>



</html>
