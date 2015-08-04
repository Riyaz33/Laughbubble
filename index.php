<?php  include_once("/analytic.php");/*Google analystics */?>
<html>
    <ded><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
        <title>LaughBubble</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  <!--Data used by browser to show how to display information on the page, in this case it is telling the browser to load the page using the device width as a base -->
        <meta name="keywords" content="photo, funny, 9gag, laugh, fun">
        <meta name="description" content="Laughbubble is the best website to post and view funny pictures! Sign up and start laughing!">
         <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link href = "/design/css/Styles.css" rel="stylesheet"><!--links to style css sheet -->
        <link rel="apple-touch-icon" href="http://www.laughbubble.com/lol3.ico">
        <link rel="icon" type="image/ico" href="http://www.laughbubble.com/lol3.ico">
        
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
      
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    </head>
    
    
    <body>
       <div class = "navbar navbar-inverse navbar-static-top">    <!-- navbar div --> 
            <div class = "container"> <!-- New "row" on page -->
                <a href = "/" class = "navbar-brand text-center">LaughBubble</a> 		<!-- Laughbubble logo in header-->
                <button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse"> <!-- toggles dropdown menu when a certain screen size-->
                    <span class = "icon-bar"></span>
                    <span class = "icon-bar"></span>
                    <span class = "icon-bar"></span>
                </button>
                 <div class = "collapse navbar-collapse navHeaderCollapse">  <!-- adds class to be toggled during collapse-->
                <ul class = "nav navbar-nav navbar-right">       
                    <li class = "dropdown">                         <!-- Login drop-down menu-->
        		<a href = "#" class = "dropdown-toggle" data-toggle = "dropdown">Login<span class = "caret"></span></a>
                            	<ul class = "dropdown-menu" role="menu">
                           		<form role="form" method="post"><div class="smallspac"></div>      <!-- class adds spacing between input boxes-->
                                        <li>
                                            <div class="input-group">
                                                <span class="input-group-addon">@</span>
                                                <input class="form-control" type="text" placeholder="username" name="username" id="logUser">
                                            </div>
                                        </li><div class="smallspac"></div>                       <!-- input boxes for username and password-->
                                        <li>
                                            <div class="input-group">
                                               <span class="input-group-addon">!</span>
                                                <input class="form-control" type="password" placeholder="password" name="password" id="logPass" >
                                            </div>
                                        </li><div class="largespac"></div>
                                        <li>
                                        	<div class="form-group text-center">
                                        		<button type="button" id="sb" name="submit1" class="btn btn-warning">Submit</button> <!-- login button-->
                                        		
                                        	</div>
                                        </li>   
                                    </form>
					
					<!-- forgot password-->	
                                    <li class="remIo"><a href = "/main/retrieve-password.php">Forgot your password?</a></li>
                        	</ul>
            	</ul>
           </div>
          </div>
        </div>
        
      
        
        
 	<div class="container">
            <div class="col-md-8">   <!-Welcome and Site Name [left side] -->
            <div class="hidden-xs">
                 <div class="text-center">
                 	
                         <h2>Welcome to</h2>		<!-- Visible when screen size sm or larger-->
                        <h1 class="hmHeader">LaughBubble</h1>
                </div>
                
                </div>
                <div class="visible-xs">
                		<div class="sBox text-center"><h5 class="indexHeader">Laughbubble</h5></div> <!--Visible when screen size xs -->
                </div>
            </div>
     
            <div class="col-md-4">  <!-- Sign up box [right side]-->
                 
                   
                        <div class="sBox text-center">
                            <form role="form" method="post">
                            	<div class="hidden-xs"><h2>Sign Up!</h2></div>   <!-- Visible when screen size sm or larger-->
					<div class="visible-xs"><h2 style="font-size: 10vw">Sign Up!</h2></div>     <!-- Visible when screen size sm or larger-->
					<div class="row">
						<div class="form-group " id="email">
						  <label class="control-label sr-only" for="input"></label>                         <!-- email input-->
						  <input type="email" class="form-control" id="email1" placeholder="Email">
						  <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true" id="email2" style="display:none"></span>
						
						</div>
						<p class="text-warning" id="email3"></p>
					</div>
					
					<div class="row">
						<div class="form-group " id="username">
						  <label class="control-label sr-only" for="input"></label>
						  <input type="text" class="form-control" id="username1" placeholder="Username">             <!--username input -->
						  <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true" id="username2" style="display:none"></span>
						
						</div>
						<p class="text-warning" id="username3"></p>
					</div>
					
					<div class="row">
						<div class="form-group " id="password">
						  <label class="control-label sr-only" for="input"></label>                  <!-- password input-->
						  <input type="password" class="form-control" id="password1" placeholder="Password">
						  <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true" id="password2" style="display:none"></span>
						
						</div>
						<p class="text-warning" id="password3"></p>
					</div>
			
                                <div class="row">
                                    <label>
                                        <input type="checkbox" name="terms" id="check"></input> I agree with the <a  data-toggle="modal" data-target ="#myModal">Terms and Conditions</a>.</label>  <!--links to TC popup -->
  <p class="text-warning" id="final"></p>
                                        <input type="button" value="Signup" id="btmbutton" class="btn btn-warning btn-lg btn-block"></input><div class="xlgspac"></div>   <!--signup button -->
                                      
                                     
                                        
                                        
                                        		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" arialabelledby="myModalLablel" aria-hidden="true">  <!--TC popup -->
                                        		<div class="modal-dialog">
   								 <div class="modal-content">
     									 <div class="modal-header">
        							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button> <!-- creates close button-->
      			  <h3 class="modal-title" id="myModalLabel">Terms and Conditions</h3> <!--Title of popup -->
     				 </div>
      					<div class="modal-body">
       							  <div class="text-center">
									<div id="terms">    <!-- body paragraph for terms and conditions (is added using jQuery)-->
									   
									</div>  
      							</div>
      							<div class="modal-footer">
       				 <center><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></center> <!--footer and another close button -->
				        
      </div>

    </div>
  </div>
</div>
                                </div>
                                
				
				<script>
		
				//redirects the user to posts.php if user_id exists. 
				$.get("/check.php?q=checkID",function(data){
					     
					     if (data==1) {
					     window.location.href = '/main/posts.php';
					     } 
					     
					      });
					      
				//calls function when page has been loaded	      
				$(document).ready(function(){
				
				//Attempted login tries
				var failed = 0;
				
				//opens up text.txt if function is clicked
				  $(function(){
				      $("#terms").load("Text.txt"); 
				    });
				    
				//calls function if button id "sb" is clicked    
				$("#sb").click(function() {
				
				
				//sets the username and password
				var username = $("#logUser").val();
				var password = $("#logPass").val();
				
				//checks the length of username and length of password
					if (username.length==0 || password.length==0) {
						
					alert("Please complete all fields");
				} else {
				/*if username and password are both set, then make a jquery php request.
				If data from request returned is 0, then username or password is incorrect. If not, then redirect the posts.php
				*/
				
					    $.post("http://laughbubble.com/check.php?q=login",
						    {
						     
						      username:$("#logUser").val(),
						      password:$("#logPass").val(),
						    },
						    function(data,status){
						      if (data=="0") {
						      alert("Incorrect username or password");
						      failed++;						  
						      	if(failed > 2){ //After third try, it will redirect to the captcha page
						      		window.location.href="/main/humanCheck.php"
						     	}
						      } else {
						      window.location.href = 'http://laughbubble.com/main/posts.php';
						      }
						    });
				}
				});
				
				/*Variables set to check if email, username, or password is true.
				*/
				
				var e = false;
				var u = false;
				var p = false;
				
				/*
				When the button #email1 has been clicked, runs the function. It first looks to see if email has even been inputted or not.
				Then run the function validateEmail (code for validateEmail has been taken from an online source). 
				*/
					$( "#email1" ).focusout(function() {
					var email = $("#email1").val();
					if (email.length !== 0) {
					function validateEmail(email){
						var emailReg = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
						var valid = emailReg.test(email);
					
						if(!valid) {
					        return false;
					    } else {
					    	return true;
					    }
					}
					
					/*
					If email is valid, then send a jquery get request from check.php
					Depending on the information that came back, change the div #email3
					If request data is not 1, then variable e =true.
					*/
					if (validateEmail(email)) {
					      $.get("/check.php?q=email&info="+email,function(data){
					      if (data=="1") {
						      //already taken
						      $("#email3").html("Sorry, "+email+" is already in use.");
						      $( "#email" ).addClass("has-error has-feedback");
						      e = false;
					      } else {
						      $( "#email" ).removeClass("has-error has-feedback" );
						      $("#email2").hide();
						      e = true;
					      }
					    });
					} else {
						 $( "#email" ).addClass("has-error has-feedback" );
	 					 $("#email2").show();
						 $("#email3").html("Please enter a valid email address.");
						 e = false;
					}
					} else {
					 $( "#email" ).addClass("has-error has-feedback" );
	 					 $("#email2").show();
	 					 e = false;
					}
					
					});
					
					/*If email is textbox get clicked, div #email3 will have nothing in it.*/
					
					$( "#email1" ).focus(function() {
						$("#email3").html("");
						e = false;
						});
					
					//username
					/*
					Once username textbox focuses out, check username length. If username length passes requirements, may
					a request to the database to see if username has been taken or not. If yes, then textbox will have error sign.
					If not, then variable u equals true
					*/
					$( "#username1" ).focusout(function() {
					var username = $("#username1").val();
					if (username.length!==0) {
						if (username.length<6 || username.length>14) {
							      $( "#username" ).addClass("has-error has-feedback" );
	 					 	      $("#username2").show();
	 					 	      $("#username3").html("Username length must be between 6 and 14 characters");
	 					 	       u = false;
						} else {
							      $.get("http://laughbubble.com/check.php?q=username&info="+username,function(data){
						      	      if (data=="1") {
							      //already taken
									      $("#username3").html("Sorry, "+username+" is already in use.");
									      $( "#username" ).addClass("has-error has-feedback");
									       $("#username2").show();
									       u = false;
							      	} else {
									      $( "#username" ).removeClass("has-error has-feedback" );
									      $("#username2").hide();
									      u = true;
							      }
								});
						}
 					 } else {
 					  $( "#username" ).addClass("has-error has-feedback" );
 					 $("#username2").show();
 					 u = false;
 					 }
 					 
					});
					
					/*
					After the user focuses on the textbox, username help = nothing
					*/
					$( "#username1" ).focus(function() {
						$("#username3").html("");
						
						});
						
						
						
					//password
					/*When password textbox is focused out, check password length. If password length passes requirements, the variable
					p equals true;
					
					*/
					$( "#password1" ).focusout(function() {
					var password = $("#password1").val();
					if (password.length!==0) {
						if (password.length<6 || password.length>20) {
							      $( "#password" ).addClass("has-error has-feedback" );
	 					 	      $("#password2").show();
	 					 	      $("#password3").html("Password length must be between 6 and 20 characters");
	 					 	      p = false;
						} else {
							    $( "#password" ).removeClass("has-error has-feedback" );
									      $("#password2").hide();   
									      p = true;
						}
 					 } else {
 					  $( "#password" ).addClass("has-error has-feedback" );
 					 $("#password2").show();
 					 p = false;
 					 }
 					 
					});
					
					/*
					After username focuses in, then password help equals nothing.
					*/
					$( "#password1" ).focus(function() {
						$("#password3").html("");
						p = false;
						});
					
					/*
					If all three variables are truel then make a final request to the database and insert the values into the database.
					*/
					
				$("#btmbutton").click(function() {
					if (check.checked) {
						if (u && p && e) {
						
						  $.post("http://laughbubble.com/check.php?q=final",
						    {
						      email:$("#email1").val(),
						      username:$("#username1").val(),
						      password:$("#password1").val(),
						    },
						    function(data,status){
						    
						      if (status=="success") {
						      window.location.href = '/main/posts.php';
						      }
						    });
						    
						} else {
						$("#final").html("Please ensure that you have completed all fields.");
						}
					} else {
						$("#final").html("Please agree with Terms and Conditions");
					}
					
				});
				
				});
				
				
				</script>
                                
                                
                                        
                  	</form>
                             
                     </div>
                    
               </div>
                 
          
           </div>
         
        <div class ="navbar navbar-default navbar-fixed-bottom">   <!-- Fixed bottom header  -->
            <div class = "container">
               <span class="hidden-xs"> <p class = "navbar-text pull-left"> LaughBubble Co.</p></span>
                <p class="navbar-text">
                	<span class="hidden-xs"><a href="http://laughbubble.com/main/about-us.php"> About Us</a></span>
                </p>
                <p class = "navbar-text pull-right"> Property of LaughBubble Co.</p>
                
            </div>
        </div>    
        
            
     
      
    </body>
    
</html> 