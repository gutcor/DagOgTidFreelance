function getCookie(cname) {

    var name = cname + "=";

    var ca = document.cookie.split(';');

    for(var i = 0; i < ca.length; i++) {

        var c = ca[i];

        while (c.charAt(0)==' ') c = c.substring(1);

        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);

    }

    return "";

} 



function setCookie(cname, cvalue, exdays) {

    var d = new Date();

    d.setTime(d.getTime() + (exdays*24*60*60*1000));

    var expires = "expires=" + d.toUTCString();

    document.cookie = cname + "=" + cvalue + "; " + expires;

}



var j = jQuery.noConflict();

j(document).ready(function(){

	var radioButton = j('#id6348');



  	j('.vilkaar').click(function(){

  		var id = '#dialog';

	

		//Get the screen height and width

		var maskHeight = j(document).height();

		var maskWidth = j(window).width();

	

		//Set heigth and width to mask to fill up the whole screen

	

		

		//transition effect		

		j('#mask').fadeIn(500);	

		j('#mask').fadeTo("slow",0.9);	

	

		//Get the window height and width

		var winH = j(window).height();

		var winW = j(window).width();

              

		//Set the popup window to center

		

	

		//transition effect

		j(id).fadeIn(2000); 	

	

	//if close button is clicked

	j('.window .close').click(function (e) {

		//Cancel the link behavior

		e.preventDefault();

		

		j('#mask').hide();

		j('.window').hide();

	});		

	

	//if mask is clicked

	j('#mask').click(function () {

		j(this).hide();

		j('.window').hide();

	});		



});





		/* Prevent someone hittin Enter on their keyboard for submitting the form */

  	  	j(window).keydown(function(event){

  	  		if(event.keyCode == 13) {

  	  			event.preventDefault();

  	  			return false;

  	  		}

	  	});

	  	j("#address").keyup(function(){
	  		
	  		var filterAddress = /^[a-zA-Z\d=Ã†Ã¦Ã˜Ã¸Ã…Ã¥ ]+$/;
			    			if (filterAddress.test(j(this).val()) && j(this).val().trim()!=="") {
			    				j(".name-help-address").css('display' , 'none');
			    			}
			    			else {
			    				j(".name-help-address").slideDown(500);
				        		j(".name-help-address").css('color' , '#fe5544');
			    			}
		});

  	  	j("#place").keyup(function(){
	  		
	  		var filterPlace = /^[a-zA-ZÃ†Ã¦Ã˜Ã¸Ã…Ã¥Ã Ã¡Ã¢Ã¤Ã£Ã¥Ä…Ä�Ä‡Ä™Ã¨Ã©ÃªÃ«Ä—Ä¯Ã¬Ã­Ã®Ã¯Å‚Å„Ã²Ã³Ã´Ã¶ÃµÃ¸Ã¹ÃºÃ»Ã¼Å³Å«Ã¿Ã½Å¼ÅºÃ±Ã§Ä�Å¡Å¾Ã€Ã�Ã‚Ã„ÃƒÃ…Ä„Ä†ÄŒÄ–Ä˜ÃˆÃ‰ÃŠÃ‹ÃŒÃ�ÃŽÃ�Ä®Å�ÅƒÃ’Ã“Ã”Ã–Ã•Ã˜Ã™ÃšÃ›ÃœÅ²ÅªÅ¸Ã�Å»Å¹Ã‘ÃŸÃ‡Å’Ã†ÄŒÅ Å½âˆ‚Ã° ,.'-]+$/i;
			    			if (filterPlace.test(j(this).val()) && j(this).val().trim()!=="") {
			    				j(".name-help-place").css('display' , 'none');
			    			}
			    			else {
			    				j(".name-help-place").slideDown(500);
				        		j(".name-help-place").css('color' , '#fe5544');
			    			}
		});


	  	j("#postzip").keyup(function(){
	  		
	  		var filterPostZip = /^(?!9999|9998|9997|9996|9995|9994|9993|9992)\d{4,4}$/;
			    			if (filterPostZip.test(j(this).val()) && j(this).val().trim()!=="") {
			    				j(".name-help-place").css('display' , 'none');
			    			}
			    			else {
			    				j(".name-help-place").slideDown(500);
				        		j(".name-help-place").css('color' , '#fe5544');
			    			}
		});

	  	j("#email").keyup(function(){
	  		
	  		var filter = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
			    			if (filter.test(j(this).val()) && j(this).val().trim()!=="") {
			    				j(".name-help-email").css('display' , 'none');
			    			}
			    			else {
			    				j(".name-help-email").slideDown(500);
				        		j(".name-help-email").css('color' , '#fe5544');
			    			}
		});

		j("#name").keyup(function(){
	  		
	  		var filterName = /^[a-zA-ZÃ†Ã¦Ã˜Ã¸Ã…Ã¥Ã Ã¡Ã¢Ã¤Ã£Ã¥Ä…Ä�Ä‡Ä™Ã¨Ã©ÃªÃ«Ä—Ä¯Ã¬Ã­Ã®Ã¯Å‚Å„Ã²Ã³Ã´Ã¶ÃµÃ¸Ã¹ÃºÃ»Ã¼Å³Å«Ã¿Ã½Å¼ÅºÃ±Ã§Ä�Å¡Å¾Ã€Ã�Ã‚Ã„ÃƒÃ…Ä„Ä†ÄŒÄ–Ä˜ÃˆÃ‰ÃŠÃ‹ÃŒÃ�ÃŽÃ�Ä®Å�ÅƒÃ’Ã“Ã”Ã–Ã•Ã˜Ã™ÃšÃ›ÃœÅ²ÅªÅ¸Ã�Å»Å¹Ã‘ÃŸÃ‡Å’Ã†ÄŒÅ Å½âˆ‚Ã° ,.'-]+$/i;
			    			if (filterName.test(j(this).val()) && j(this).val().trim()!=="") {
			    				j(".name-help-name").css('display' , 'none');
			    			}
			    			else {
			    				j(".name-help-name").slideDown(500);
				        		j(".name-help-name").css('color' , '#fe5544');
			    			}
		});

		j("#lastname").keyup(function(){
	  		
	  		var filterLastName = /^[a-zA-ZÃ†Ã¦Ã˜Ã¸Ã…Ã¥Ã Ã¡Ã¢Ã¤Ã£Ã¥Ä…Ä�Ä‡Ä™Ã¨Ã©ÃªÃ«Ä—Ä¯Ã¬Ã­Ã®Ã¯Å‚Å„Ã²Ã³Ã´Ã¶ÃµÃ¸Ã¹ÃºÃ»Ã¼Å³Å«Ã¿Ã½Å¼ÅºÃ±Ã§Ä�Å¡Å¾Ã€Ã�Ã‚Ã„ÃƒÃ…Ä„Ä†ÄŒÄ–Ä˜ÃˆÃ‰ÃŠÃ‹ÃŒÃ�ÃŽÃ�Ä®Å�ÅƒÃ’Ã“Ã”Ã–Ã•Ã˜Ã™ÃšÃ›ÃœÅ²ÅªÅ¸Ã�Å»Å¹Ã‘ÃŸÃ‡Å’Ã†ÄŒÅ Å½âˆ‚Ã° ,.'-]+$/i;
			    			if (filterLastName.test(j(this).val()) && j(this).val().trim()!=="") {
			    				j(".name-help-lastname").css('display' , 'none');
			    			}
			    			else {
			    				j(".name-help-lastname").slideDown(500);
				        		j(".name-help-lastname").css('color' , '#fe5544');
			    			}
		});

  	  	function validateEmail(email , postzip , place , address , name , lastname) {

  	  			var l = document.getElementById(lastname).value;
  	  			var n = document.getElementById(name).value;
	            var d = document.getElementById(address).value;
  	  			var z = document.getElementById(postzip).value;
			    var a = document.getElementById(email).value;
			    var p = document.getElementById(place).value;

			    var filterLastName = /^[a-zA-ZÃ†Ã¦Ã˜Ã¸Ã…Ã¥Ã Ã¡Ã¢Ã¤Ã£Ã¥Ä…Ä�Ä‡Ä™Ã¨Ã©ÃªÃ«Ä—Ä¯Ã¬Ã­Ã®Ã¯Å‚Å„Ã²Ã³Ã´Ã¶ÃµÃ¸Ã¹ÃºÃ»Ã¼Å³Å«Ã¿Ã½Å¼ÅºÃ±Ã§Ä�Å¡Å¾Ã€Ã�Ã‚Ã„ÃƒÃ…Ä„Ä†ÄŒÄ–Ä˜ÃˆÃ‰ÃŠÃ‹ÃŒÃ�ÃŽÃ�Ä®Å�ÅƒÃ’Ã“Ã”Ã–Ã•Ã˜Ã™ÃšÃ›ÃœÅ²ÅªÅ¸Ã�Å»Å¹Ã‘ÃŸÃ‡Å’Ã†ÄŒÅ Å½âˆ‚Ã° ,.'-]+$/i;
			    var filterName = /^[a-zA-ZÃ†Ã¦Ã˜Ã¸Ã…Ã¥Ã Ã¡Ã¢Ã¤Ã£Ã¥Ä…Ä�Ä‡Ä™Ã¨Ã©ÃªÃ«Ä—Ä¯Ã¬Ã­Ã®Ã¯Å‚Å„Ã²Ã³Ã´Ã¶ÃµÃ¸Ã¹ÃºÃ»Ã¼Å³Å«Ã¿Ã½Å¼ÅºÃ±Ã§Ä�Å¡Å¾Ã€Ã�Ã‚Ã„ÃƒÃ…Ä„Ä†ÄŒÄ–Ä˜ÃˆÃ‰ÃŠÃ‹ÃŒÃ�ÃŽÃ�Ä®Å�ÅƒÃ’Ã“Ã”Ã–Ã•Ã˜Ã™ÃšÃ›ÃœÅ²ÅªÅ¸Ã�Å»Å¹Ã‘ÃŸÃ‡Å’Ã†ÄŒÅ Å½âˆ‚Ã° ,.'-]+$/i;
			    var filterAddress = /^[a-zA-Z\d=Ã†Ã¦Ã˜Ã¸Ã…Ã¥ ]+$/;
			    var filterPlace = /^[a-zA-ZÃ†Ã¦Ã˜Ã¸Ã…Ã¥Ã Ã¡Ã¢Ã¤Ã£Ã¥Ä…Ä�Ä‡Ä™Ã¨Ã©ÃªÃ«Ä—Ä¯Ã¬Ã­Ã®Ã¯Å‚Å„Ã²Ã³Ã´Ã¶ÃµÃ¸Ã¹ÃºÃ»Ã¼Å³Å«Ã¿Ã½Å¼ÅºÃ±Ã§Ä�Å¡Å¾Ã€Ã�Ã‚Ã„ÃƒÃ…Ä„Ä†ÄŒÄ–Ä˜ÃˆÃ‰ÃŠÃ‹ÃŒÃ�ÃŽÃ�Ä®Å�ÅƒÃ’Ã“Ã”Ã–Ã•Ã˜Ã™ÃšÃ›ÃœÅ²ÅªÅ¸Ã�Å»Å¹Ã‘ÃŸÃ‡Å’Ã†ÄŒÅ Å½âˆ‚Ã° ,.'-]+$/i;
			    var filterPostZip = /^(?!9999|9998|9997|9996|9995|9994|9993|9992)\d{4,4}$/;
			    var filter = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

			    if (filter.test(a) && filterPostZip.test(z) && filterPlace.test(p) && filterAddress.test(d) && filterName.test(n) && filterLastName.test(l)) 
			    {
			    	/* save everything to cookies */

		        	var order = new Object;
		        	
		        	order.option = j(".eksponeringFacebook input[type='radio']:checked").val();
		        	order.phone = j("#phhm").val();
		        	order.email = j("#email").val();
		        	order.name = j('#name').val();
		        	order.lastname = j('#lastname').val();
		        	order.postzip = j('#postzip').val();
		        	order.place = j('#place').val();
		        	order.address = j("#address").val(); 
		        	order.streetNumber = j('#addressNumber').val();
		        	order.co = j('#c-o').val();
		        	order.entrance = j('#oppgang').val(); 
		        	order.id = j('#result_id').val();
		        	
		        	//alert(JSON.stringify(order));
		        	
		        	setCookie('order', JSON.stringify(order) , 1);
		        	window.location = j('#BestillWidget').attr('action');

	 				//j("#BestillWidget").unbind('submit').submit();
	 			}
			    else 
			    {
			    	if(!filterPostZip.test(z)) 
			    	{
				    	j('#postzip').html('Invalid');
				        /*j('#email').css('background-color', '#fe5544');*/
				        j(".name-help-place").slideDown(500);
				        j(".name-help-place").css('color' , '#fe5544');
			        }

			        if(!filter.test(a)) {

				    	j('#email').html('Invalid');

				        /*j('#email').css('background-color', '#fe5544');*/

				        j(".name-help-email").slideDown(500);
				        j(".name-help-email").css('color' , '#fe5544');

			        }

			        if(!filterPlace.test(p)) {

				    	j('#place').html('Invalid');

				        /*j('#email').css('background-color', '#fe5544');*/

				        j(".name-help-place").slideDown(500);
				        j(".name-help-place").css('color' , '#fe5544');

			        }

			        if(!filterAddress.test(d)) {

				    	j('#address').html('Invalid');

				        /*j('#email').css('background-color', '#fe5544');*/

				        j(".name-help-address").slideDown(500);
				        j(".name-help-address").css('color' , '#fe5544');

			        }


			        if(!filterName.test(n)) {

				    	j('#name').html('Invalid');

				        /*j('#email').css('background-color', '#fe5544');*/

				        j(".name-help-name").slideDown(500);
				        j(".name-help-name").css('color' , '#fe5544');

			        }

			        if(!filterLastName.test(l)) {

				    	j('#lastname').html('Invalid');

				        /*j('#email').css('background-color', '#fe5544');*/

				        j(".name-help-lastname").slideDown(500);
				        j(".name-help-lastname").css('color' , '#fe5544');

			        }

				}

		}

  	  	/* Put todays date into calendars value */



  	  	function dagensDato() {

	  	  	var d = new Date();

		  	var month = d.getMonth()+1;

	      	var day = d.getDate();



	      	var output = ((''+day).length<2 ? '0' : '') +  day + '.' +

	          ((''+month).length<2 ? '0' : '') + month + '.' +

	          d.getFullYear();

	          j("#id6345_text").val(output);

  	  	}



  	  	dagensDato();

  		

  	  	j(function(){

	    j("#BestillWidget").validate();    

	    j("#BestillWidget").on('submit', function(e){

	    	e.preventDefault();

	        var isvalidate=j("#BestillWidget").valid();
	       
	        

	    	if(isvalidate)

	        {



	        	if(radioButton.is(':checked')) {
	        	
	        	
	  			validateEmail('email' , 'postzip' , 'place' , 'address' , 'name' , 'lastname');
	  			

	  		}



	  		else {

	  			j('.name-help-radio1').slideDown(500);

	  			e.preventDefault();



	  		}



	        	

	        }

	         

	    });

	});



	function getvalues(f)

	{

	    var form=j("#"+f);

	    var str='';

	    j("input:not('input:submit')", form).each(function(i){

	        str+='\n'+j(this).prop('name')+': '+j(this).val();

	    });

	    return str;

	}



  		/*j("#email").focusout(function(){



  		});*/



      /* Phone Number Validation */    

  	  j("#button-blue").click(function(e){



	function validatePhone(phhm) {

    var a = document.getElementById(phhm).value;

    var filter = /^\d{8}/;

    if (filter.test(a)) {

            j("#button-blue").click(function(){
            j("#button-blue").fadeOut(300);

            j(".phone").fadeOut(300 , function(){
               j(".do-not-show").fadeIn(300);
               j(".submit").css("display","none");

            });

        });

        return true;

    }

}

	   /* j('#phhm').blur(function(e) {

        if (validatePhone('phhm')) {

            j('.errorPhone').html('Gyldig');

            j('#phhm').css('color', '#fff');

            j('#phhm').css('background-color', '#4CAF50');

            j(".name-help").slideUp(500);  

        }

        else {

            j('#phhm').html('Invalid');

            j('#phhm').css('background-color', '#fe5544');

            j(".name-help").slideDown(500);

        }

    })*/
		/*var phone = parseInt(j("#phhm").val().trim());*/

		if( validatePhone('phhm'))
		{
			j('.errorPhone').html('Gyldig');
            /*j('#phhm').css('color', '#fff');*/
            j('#phhm').css('background-color', '#fff');
            j(".name-help").slideUp(500); 
            j("#button-blue").fadeOut(300);
            j(".submit").css("display","none");
            j(".phone").fadeOut(300);
            j(".do-not-show").fadeIn(600);

			j.ajax({
				 method: 'GET'
				,url : 'get_number.php'
				,data : { 'phhm' : j("#phhm").val().trim() }
			}).done(function(data){

				var out = j.parseJSON(data);
				
				if(out.success)
				{
					j("#postzip").val(out.postnr);
					j("#lastname").val(out.etternavn);
					j("#name").val(out.fornavn);
					j("#address").val(out.veinavn);
					j("#addressNumber").val(out.husnr);
					j("#place").val(out.poststed);
					j("#oppgang").val(out.oppgang);
					j("#result_id").val(out.res_id);	
				} 
				else 
				{
					e.preventDefault();
				}

			});


		} 
		else 
		{
			j('#phhm').html('Invalid');
            j('#phhm').css('background-color', '#fe5544');
            j(".name-help").slideDown(500);
			e.preventDefault();
		}
	
	});


});













