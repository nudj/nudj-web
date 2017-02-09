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


	<!--  GOOGLE LOGIN -->
    <script src="https://apis.google.com/js/api:client.js"></script>
	<script>

		var subfolder = "";
	    var base_url = document.location.origin;
	    if(base_url.includes("localhost")) {
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
	          var photo_url = profile.getImageUrl();
	          var email = profile.getEmail();

	          var url = window.location + "/google_auth";
	          var redirect = subfolder+ "/dashboard";


	          $.ajax({
			    type: 'POST',
			    url: url, //this should be url to your PHP file
			    dataType: 'html',
			    data: { 'name': name, 'photo_url':photo_url, 'google_email':email, 'google_auth':true },
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

<script>
        window['_fs_debug'] = false;
        window['_fs_host'] = 'www.fullstory.com';
        window['_fs_org'] = '3127D';
        window['_fs_namespace'] = 'FS';
        (function(m,n,e,t,l,o,g,y){
            if (e in m && m.console && m.console.log) { m.console.log('FullStory namespace conflict. Please set window["_fs_namespace"].'); return;}
            g=m[e]=function(a,b){g.q?g.q.push([a,b]):g._api(a,b);};g.q=[];
            o=n.createElement(t);o.async=1;o.src='https://'+_fs_host+'/s/fs.js';
            y=n.getElementsByTagName(t)[0];y.parentNode.insertBefore(o,y);
            g.identify=function(i,v){g(l,{uid:i});if(v)g(l,v)};g.setUserVars=function(v){g(l,v)};
            g.identifyAccount=function(i,v){o='account';v=v||{};v.acctId=i;g(o,v)};
            g.clearUserCookie=function(c,d,i){if(!c || document.cookie.match('fs_uid=[`;`]*`[`;`]*`[`;`]*`')){
            d=n.domain;while(1){n.cookie='fs_uid=;domain='+d+
            ';path=/;expires='+new Date(0).toUTCString();i=d.indexOf('.');if(i<0)break;d=d.slice(i+1)}}};
        })(window,document,window['_fs_namespace'],'script','user');
    </script>

    <script>
  window.intercomSettings = {
    app_id: "jmk9ujo0"
  };
</script>
<script>(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',intercomSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Intercom=i;function l(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/jmk9ujo0';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);}if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})()</script>

</head>

<body>



<div class="signup-container">

	<div class="signup-box">
		<p class="nudj-title">Request Access</p>
		<p class="nudj-description">Nudj is the easiest and most effective way to hire via referrals. To try out the platform today, sign up below.</p>

		<div class="login-buttons">
			<div id="google-button" class="customGPlusSignIn"></div>
			<button onclick="liAuth()" class="linkedin-button"></button>


		</div>

		<div class="clear"></div>

		<div class="horizontal-delimiter"></div>

		<div class="form-container">

			<?php echo form_open('signup'); ?>
				<div class="form-signup">
					<?php if( isset($errors)) echo '<p class="error">'.$errors[0].'</p>';?>
					<input class="input-signup" placeholder="Full Name" name="fullname" type="text"  value="<?php if(isset($fullname)) echo $fullname;?>" >
					<input class="input-signup" placeholder="E-Mail" name="email" type="text"  value="<?php if(isset($email)) echo $email;?>" >
					<input class="input-signup" placeholder="Company Name" name="company_name" type="text"  value="<?php if(isset($company_name)) echo $company_name;?>" >
					<input class="input-signup" placeholder="Password" name="password" type="password" >
					<input class="input-signup" placeholder="Re-type Password" name="repassword" type="password" >
					<input class="submit" value="Request Access" name="submit" type="submit" >
				</div>
			</form>
		</div>

		<div class="already-access">
			<p><span class="nudj-description">Already have Access?</span> <a href=<?php echo base_url()."signin"; ?>>Sign in</a></p>
		</div>
	</div>
	
</div>

<script>startApp();</script>
