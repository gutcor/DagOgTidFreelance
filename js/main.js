$(document).ready(function(){
	
	$("#getNumber").submit(function(e){
		var phone = parseInt($("#phone").val().trim());
		if( isNaN(phone) ){
			alert("Please provide a phone number");
		} else {
			$.ajax({
				 method: 'GET'
				,url : 'get_number.php'
				,data : $('#getNumber').serialize()	
			}).done(function(data){
				var out = $.parseJSON(data);
				if(out.success){
					$("#result #postnr").val(out.postnr);
					$("#result #etternavn").val(out.etternavn);
					$("#result #fornavn").val(out.fornavn);
				} else {
					alert("Please provide a different number");
				}
			});
		}
		e.preventDefault();
	});
	
});