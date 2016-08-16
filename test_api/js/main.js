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
  
		/* Prevent someone hittin Enter on their keyboard for submitting the form */
  	  	j(window).keydown(function(event){
  	  		if(event.keyCode == 13) {
  	  			event.preventDefault();
  	  			return false;
  	  		}
	  	});

  	  	function validateEmail(email) {
	            
			    var a = document.getElementById(email).value;
			    var filter = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
			    if (filter.test(a)) 
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
		        	
		        	//alert(JSON.stringify(order));
		        	setCookie('order', JSON.stringify(order) , 1);
		        	window.location = j('#BestillWidget').attr('action');
	 				//j("#BestillWidget").unbind('submit').submit();
	 			}
			    else 
			    {
			    	j('#email').html('Invalid');
			        j('#email').css('background-color', '#fe5544');
			        j(".name-help-email").slideDown(500);
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
	        	validateEmail('email');
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
		
		
			
		if( validatePhone('phhm')){
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
				if(out.success){
					j("#postzip").val(out.postnr);
					j("#lastname").val(out.etternavn);
					j("#name").val(out.fornavn);
					j("#address").val(out.veinavn);
					j("#addressNumber").val(out.husnr);
					j("#place").val(out.poststed);
					j("#oppgang").val(out.oppgang);
					
				} else {
					
					e.preventDefault();
				}
			});


			
		} else {
			j('#phhm').html('Invalid');
            j('#phhm').css('background-color', '#fe5544');
            j(".name-help").slideDown(500);
			e.preventDefault();
	
		}
		
		
	});

});






