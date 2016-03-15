
 var uname;
 var flag=0;

$(document).ready(function() 
					{

					   			  
					  $.ajax({
		                              type: "POST",
		                              url: "loginsession.php",
			                          
		                              success: function(html){    
			                         if(html!="false")     {
			                          	  									     
                                        $("#idlogin").text("Logout: " +html);
											
			                         }
			                         
		 		           }}); 
                      $(".button").click(function(e) 
					   {  					   
          				  var str = $("#idlogin").text();
						  str= str.substr(0,6);
                          if(str=="Logout" )
						  {
                          $("#idlogin").text("Login");
						  }
						  else 
						   { 
						     $("body").append('');
						     $(".popup").show(); 
						   }

					      $(".close").click(function(e) 
						  {


						    $(".popup, .overlay").hide();

						    $.ajax({
		                              type: "POST",
		                              url: "loginsessionout.php",
			                          
		                              success: function(html){    
			                         if(html=="false")     {
			                          	  									     
                                        $("#idlogin").text("Logout: " +html);
											
			                         }
			                         
		 		           }});  
				          });  //close
					      $(".login").click(function(e) 
						  {   
						  	  
						     
							 var username = $(".name1").val();
							  var password = $(".pwd").val();
							  if(username.length!=0 && password.length!=0)
							  {
							  $.ajax({
		                              type: "POST",
		                              url: "usrauthentication.php",
			                          data: "name="+username+"&pwd="+password,
		                              success: function(html){    
			                         if(html!="false")     {
			                          	   $("input:hidden").val(html);
									    $(".popup, .overlay").hide(); 
                                        $("#idlogin").text("Logout: " +username);
										flag=1;
										uname=username;
			                         }
			                      if (flag=0)  alert("Invalid credentials");     
		 		           }}); 
						 
			               }         
						   else
						     alert("provide credentials!!");
				          });  // login event
						  
				       });													
					}); //button); // ready