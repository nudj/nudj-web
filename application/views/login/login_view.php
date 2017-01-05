<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
    <base href="/">
    <meta charset="utf-8">
    <title>Nudj</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>-->

    <link rel="stylesheet" href=<?php echo asset_url()."css/style.css"; ?>>
    <link rel="stylesheet" href=<?php echo asset_url()."css/job-style.css";?>>
    <link rel="stylesheet" href=<?php echo asset_url()."css/apply-style.css";?>>
    <link rel="stylesheet" href=<?php echo asset_url()."css/responsive-style.css";?>>
    <link rel="stylesheet" href=<?php echo asset_url()."css/login-style.css";?>>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-route.js"></script>
-->

	<script
			  src="https://code.jquery.com/jquery-3.1.1.min.js"
			  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
			  crossorigin="anonymous"></script>



			  <!--  GOOGLE    -->
    <script src="https://apis.google.com/js/api:client.js"></script>
	<script>

		var subfolder = "";
	    var base_url = document.location.origin;
	    if(base_url.includes("carmen")) {
	    	subfolder = "/nudj-php";
	    } else if(base_url.includes("zudent")){
	    	subfolder = "/dev.nudj";
	    }

	  var googleUser = {};
	  var startApp = function() {
	    gapi.load('auth2', function(){
	      // Retrieve the singleton for the GoogleAuth library and set up the client.
	      auth2 = gapi.auth2.init({
	        client_id: '1018534519510-6u8v9a1183dnud6lh8t1lputpj983b8q.apps.googleusercontent.com',
	        cookiepolicy: 'single_host_origin',
	        // Request scopes in addition to 'profile' and 'email'
	        //scope: 'additional_scope'
	      });
	      attachSignin(document.getElementById('google-button'));
	    });
	  };

	  function attachSignin(element) {
	    console.log(element.id);
	    auth2.attachClickHandler(element, {},
	        function(googleUser) {

	        	var profile = googleUser.getBasicProfile();
			    console.log('ID: ' + profile.getId()); 
			    console.log('Name: ' + profile.getName());
			    console.log('Email: ' + profile.getEmail());
			    console.log('Image URL: ' + profile.getImageUrl());
			    

	          //document.getElementById('name').innerText = "Signed in: " + googleUser.getBasicProfile().getName();
	          var name = profile.getName();
	          var profile_url = profile.getImageUrl();
	          var email = profile.getEmail();

	          var url = window.location + "/google_auth";
	          var redirect = subfolder+ "/dashboard";

	          //alert('url:' + url);

	          //$.post(url, { 'name': name, 'profile_url':profile_url, 'google_email':email, 'google_auth':true });


	          $.ajax({
			    type: 'POST',
			    url: url, //this should be url to your PHP file
			    dataType: 'html',
			    data: { 'name': name, 'profile_url':profile_url, 'google_email':email, 'google_auth':true },
			    complete: function() { console.log("complete?");},
			    success: function() { $(location).attr('href', redirect);}
			});

	        }, function(error) {
	          alert(JSON.stringify(error, undefined, 2));
	        });
	  }
	  </script>



	  <!--  LINKEDIN   -->
	  <script type="text/javascript" src="//platform.linkedin.com/in.js"> 
	    api_key:86lnk250lhvlkr
	    authorize: true
    	onLoad: onLinkedInLoad
	</script>


<script type="text/javascript">
    
    // Setup an event listener to make an API call once auth is complete
    function onLinkedInLoad() {
        IN.Event.on(IN, "auth", getProfileData);
    }

    // Handle the successful return from the API call
    function onSuccess(data) {
        console.log(data);

        //var profile = googleUser.getBasicProfile();
		//console.log('headline: ' + data['headline']); 
	    //console.log('Name: ' + data['formattedName']);
	    //console.log('Email: ' + profile.getEmail());
	    //console.log('Image URL: ' + data['pictureUrls']['values'][0]);


	    var name = data['formattedName'];
	    var firstname = data['firstName'];
	    var lastname = data['lastName'];
      	var photo_url = data['pictureUrls']['values'][0];
      	var email = data['emailAddress'];
      	var headline = data['headline'];
      	var profile_url = data['siteStandardProfileRequest']['url'];

      	var url = window.location + "/linkedin_auth";
      	var redirect = subfolder+ "/dashboard";

  		$.ajax({
		    type: 'POST',
		    url: url, //this should be url to your PHP file
		    dataType: 'html',
		    data: { 'name': name, 'photo_url':photo_url, 'linkedin_email':email, 'linkedin_auth':true, 'firstname':firstname, 'lastname':lastname, 'headline':headline, 'profile_url':profile_url },
		    complete: function() { console.log("complete?");},
		    success: function() { $(location).attr('href', redirect);}
		});
    }

    // Handle an error response from the API call
    function onError(error) {
        console.log(error);
    }

    // Use the API call wrapper to request the member's basic profile data
    function getProfileData() {
        IN.API.Raw("/people/~:(email-address,first-name,last-name,formatted-name,pictureUrls::(original),siteStandardProfileRequest,headline)").result(onSuccess).error(onError);
    }


    https://api.linkedin.com/v1/people/~:(id,email-address,first-name,last-name,formatted-name,picture-url)?format=json

    function liAuth(){
        IN.User.authorize(function(){
        });
    }

</script>

</head>

<body>





<div class="signup-container">

	<div class="signin-box">
		<p class="nudj-title">Sign In</p>
		<p class="nudj-description">Lorem ipsum dolore sit amet text here that's all I know from lorem text i choose bulbasaur lorem ipsum dolore sit amet.</p>

		<div class="login-buttons">
			<div id="google-button" class="customGPlusSignIn"></div>
			<button onclick="liAuth()" class="linkedin-button"></button>
		</div>

		<div class="clear"></div>

		<div class="horizontal-delimiter"></div>

		<div class="form-container">
			<!-- <form id="form-signup" class="form-signup" action="" method="post"> -->
			<?php echo form_open('signin'); ?>
			<div class="form-signup">
				<?php if( isset($error) && $error) echo '<p class="error">Incorrect credentials.</p>';?>
				<input  class="input-signup" placeholder="E-Mail" name="email" type="text" value=<?php if(isset($email)) echo $email;?> >
				<input class="input-signup" placeholder="Password" name="password" type="password" >
				<input class="submit" value="Sign In" name="submit" type="submit" >
			</div>
			</form>
		</div>

		<div class="already-access">
			<p><span class="nudj-description">Don't have an account?</span> <a href=<?php echo base_url()."signup"; ?>>Sign up</a></p>
		</div>
	</div>
	
</div>

<script>startApp();</script>
