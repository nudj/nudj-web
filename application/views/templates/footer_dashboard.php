<!-- FOOTER  -->


<script src="https://apis.google.com/js/api:client.js"></script>

<script>

  var googleUser = {};
    var startApp = function() {
      gapi.load('auth2', function(){
        // Retrieve the singleton for the GoogleAuth library and set up the client.
        auth2 = gapi.auth2.init({
          client_id: '319494144728-fbrhrh30onvjofnujeagc07l4ppk3ukk.apps.googleusercontent.com',
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
      api_key:77kzipb6vhl8c1
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

  var subfolder = "";
  var base_url = document.location.origin;
  if(base_url.includes("localhost")) {
    subfolder = "/nudj-php";
  } else if(base_url.includes("zudent")){
    subfolder = "/dev.nudj";
  }

  function goToHome() {
    console.log("logged out...")
      location.href=subfolder+'/logout';
  }

  </script>



<div class="footer-dashboard">
    <div class="full-delimiter">
    </div>


      <div class="footer-content">
        <div class="left-side">
          <p>Welcome to the Dashboard<?php if(isset($firstname)) echo ", ".ucwords($firstname);?></p>
          <?php

          if ($this->session->has_userdata('google_auth') && $this->session->userdata('google_auth') == true) {
              echo '<a onclick="signOut();" href="'.base_url().'logout" >';
              if(isset($firstname)) echo "Not ".ucwords($firstname)."? ";
              echo 'Sign in as a different user</a>';
            } else if ($this->session->has_userdata('linkedin_auth') && $this->session->userdata('linkedin_auth') == true) {
              echo '<button id="logoutbutton" style="display:none;" onclick="signOutLinkedin();" >';
              if(isset($firstname)) echo "Not ".ucwords($firstname)."? ";
              echo 'Sign in as a different user</button>';
            } else {
              echo '<a href="'.base_url().'logout">';
              if(isset($firstname)) echo "Not ".ucwords($firstname)."? ";
              echo 'Sign in as a different user</a>';
            }
          //href="'.base_url().'/logout"
          ?>
        </div>
        <div class="right-side">

          <!-- RIGHT -->

        </div>
      </div>




</div>




<script>startApp();</script>


</body>
</html>
