

				
   $(document).ready(function(){
		
	$(".fancybox").fancybox({
		openEffect  : 'none',
		closeEffect : 'none',
		iframe : {
			preload: false
		}
	});
	
	
	
	$(".various").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});
	
	
	
	$('.fancybox-media').fancybox({
		openEffect  : 'none',
		closeEffect : 'none',
		helpers : {
			media : {}
		}
	});
	
	
	$(".button").click(function(e) 
	{  	

							 var username = $(".uname").val();
							 var password = $(".pswd1").val();
							 var password1 = $(".pswd2").val();
							 var email = $(".email").val();
		            		 var keyword = $(".keyword").val();
						    // var profileop= window.testCheckbox;
  
                              //alert(profileop);
							  var profileop="";
							var checkedIds = $(":checkbox:checked").map(function() {
        return this.value;
    }).get();
	
	 $.each(checkedIds, function( index, value ) {
	 profileop=profileop+value;


});
if (profileop.length==0) profileop=0;

                if(password==password1)
                {

					  if(username.length!=0 && password.length!=0 && email.length!=0 && keyword.length!=0)  
					              
	                  {											  
							$.ajax({
		                              type: "POST",
		                              url: "register.php",
			                          data: "name="+username+"&pwd="+password+"&email="+email+"&keyword="+keyword+"&a11yop="+profileop,
		                              success: function(html){    
			                             
		 		                                             }
		 		                   });  

		 		                   alert("Record entered successfully");  
					}

				}
	           else
				alert("password Mismatch!!!");  					
	});
														
});



function testCheckbox()
{


	var profiles = document.getElementsByName('dp');
    var txt;
    var i;
    for (i = 0; i < profiles.length; i++) {
        if (profiles[i].checked) {
            txt = txt + profiles[i].value;
        }
    }

if (txt.length==0) txt=0;

	return txt;
	alert("indisede function"+txt);

 
}
	
