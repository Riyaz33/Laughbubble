<?php require($_SERVER['DOCUMENT_ROOT'] . '/header.php' ); ?>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

</head>

<body>

<div class="spacer"></div>

	<div class="container">
	<h1>Settings</h1>
	
	
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">


    
      <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
          Change Password
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
   
		<input class="form-control" placeholder="Old Password" type="text" id="oldPassword">
		<div class="smallspac"></div>
		<input class="form-control" placeholder="New Password" type="password" id="newPassword">
		<div class="smallspac"></div>
		<input class="form-control" placeholder="Confirm New Password" type="password" id="confirmPassword">
		
		<div class="largespac"></div>
		<p id="passinfo"></p>
		<button id="button1" type="submit1" value="submit1" class="btn btn-warning">Submit</button>
		
      </div>
    </div>
  </div>
  
       <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Change Username
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
       <input id="nu" class="form-control" placeholder="New Username" type="text" >
		<div class="smallspac"></div>
		<p id="nuh"></p>
		<button  id="button2" type="submit1" value="submit1" class="btn btn-warning">Submit</button>	
      </div>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Change Biography
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
        
        <textarea class="form-control" rows="4" id="bioh" placeholder="Tell us about yourself."></textarea>
       
		<div class="smallspac"></div>
		<p id="count">150</p>
		<button id="button3" type="button" class="btn btn-warning">Submit</button>
      </div>
    </div>
  </div>
  
         <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingFour">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          Change Profile Picture
        </a>
      </h4>
    </div>
    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
      <div class="panel-body">
      Coming Soon!
   	<input id="chose" type="file" name="image" class="btn btn-danger">
		<div class="smallspac"></div>
	<input type="submit" name="submit" value="Upload Image" id="uploadPic" class="btn btn-warning btn-lg"> </input> 
      </div>
    </div>
  </div>
  
 
  
</div>
</div>

<script>

$(document).ready(function() {
/*
After button is clicked, check if all fields are set. If the new password equals the confirm password, use jquery posts to send a request.
*/
$("#button1").click(function(){

		var op = $("#oldPassword").val();
		var np = $("#newPassword").val();
		var cp = $("#confirmPassword").val();
		if (op.length==0 || np.length==0 || cp.length == 0) {
		$("#passinfo").text("Please fill in all fields.");
		} else {
			if (np==cp) {
			
				if (np.length<6 || np.length>20) {
					$("#passinfo").text("Password length must be between 6 and 20 characters");
				} else {
			$.post("look.php?q=password",
		 	{
			np: $("#newPassword").val(),
			op: $("#oldPassword").val(),	
			},
			function(data,status){
			
			$("#passinfo").text(data);	
			});
					
			}
			} else {
			$("#passinfo").text("New Password and Confirm Password do not match");
			}
		}
		
});
/*
If change username button is clicked, check if username field has an input and if it fills all requirements. Make a jquery posts request to the database and
print out information that has been received by that page. 
*/
//change Username
	$("#button2").click(function(){
		var nu = $("#nu").val();
		if (nu.length<6 || nu.length>14) {
		$("#nuh").text("Username length must be between 6 and 14 characters");
		} else{
		$.post("look.php?q=username",
		 {
			NewUsername:$("#nu").val(),
				
			},
			function(data,status){
			
			$("#nuh").text(data);	
			});	

		}
		
	});

/*Biography hint checker allows users to know how many characters that are allowed to input. */
/*Whenever a key is pressed, check the amount of characters. Subtract that amount from the total amount of 150 characters. Change hint
checker color to red if character count is over 150. */
		$("#bioh").keyup(function(){
		var biohl = $("#bioh").val().length;
	 	$("#count").text(150-biohl);
	 	
	 		if (biohl>150) {
		 		$( "#count" ).addClass("text-danger");
		 		$( "#button3" ).addClass("disabled");
	 		} else {
		 		$( "#count" ).removeClass();
		 		$("#button3").removeClass("disabled");
	 		}
	 		
	 	});
	
	/*If biography change button is pressed, send a jquery post request to the database to update the biography. */
	$("#button3").click(function(){
	var biohl = $("#bioh").val();
		 $.post("look.php?q=bio",
		 {
			bio:$("#bioh").val(),
				
			},
			function(data,status){
			if (status=="success") {
			
			$("#count").text("Changed Successfully. New Biography: "+ $("#bioh").val());	
				      
				}
				});	
		});

});

</script>

</body>
</html>