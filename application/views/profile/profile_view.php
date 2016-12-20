
<script src="https://apis.google.com/js/api:client.js"></script>

<script>

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
	    });
	  };

  function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
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

	function onLinkedInLoad() {
		$("#logoutbutton").show();
	}

	function signOutLinkedin() {
		console.log("works");
		try {
		    IN.User.logout();//goToHome());
		} catch (err) {
		    console.log(err);
		}
		setTimeout("goToHome()", 1000);

	    //window.location = '/nudj-php/logout';	
	    	
	}

	function goToHome() {

		var subfolder = "";
	    var base_url = document.location.origin;
	    if(base_url.includes("carmen")) {
	    	subfolder = "/nudj-php";
	    } else if(base_url.includes("zudent")){
	    	subfolder = "/dev.nudj";
	    }

		console.log("logged out...")
	  	location.href = subfolder+'/logout';
	}

	</script>

<div class="dashboard-content">
<br/><br/><br/><br/><br/>
<p class="nudj-title">Temporary Profile Page</p>
<br/>

<p style="text-align:center;font-family:Avenir;">Name: <?php echo $this->session->userdata('fullname');?><br/>Email: <?php echo $this->session->userdata('email'); ?></p>
<br/>
<?php if ($this->session->has_userdata('google_auth') && $this->session->userdata('google_auth') == true) {
		echo '<p style="text-align: center;font-family:Avenir;" ><a onclick="signOut();" href="'.base_url().'/logout" >Logout</a></p>';
	} else if ($this->session->has_userdata('linkedin_auth') && $this->session->userdata('linkedin_auth') == true) {
		echo '<p style="text-align: center;font-family:Avenir;" ><button id="logoutbutton" style="display:none;color:#26c883;font-size:12px;" onclick="signOutLinkedin();" >Logout</button></p>';
	} else {
		echo '<p style="text-align: center;font-family:Avenir;" ><a href="'.base_url().'/logout">Logout</a></p>';
	}

//href="'.base_url().'/logout"

?>
</div>




<script>startApp();</script>


