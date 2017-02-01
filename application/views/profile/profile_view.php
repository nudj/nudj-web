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
	    if(base_url.includes("localhost")) {
	    	subfolder = "/nudj-php";
	    } else if(base_url.includes("zudent")){
	    	subfolder = "/dev.nudj";
	    }

		console.log("logged out...")
	  	location.href = subfolder+'/logout';
	}

	</script>




<form id="form-profile" method="post" autocomplete="on" enctype="multipart/form-data">

<div class="dashboard-content padding-bottom130">

	<div class="content">

		<div class="form-container">
			 
			<div class="form-add-job">
				<label class="big-label">Personal Details</label><br/>
				<br/><label>Your Name</label>
				<input  class="input-job" placeholder="Your Name" name="fullname" type="text" value="<?php if(isset($fullname)) echo $fullname;?>" >
				<br/><label>Your Email</label>
				<input  class="input-job" placeholder="Your Email" name="email" type="text" disabled value="<?php if(isset($email)) echo $email;?>" >
				

				<br/><br/><label class="big-label">Company Details</label><br/>
				<br/><label>Company Name</label>
				<input  class="input-job" placeholder="Company's Name" name="company_name" type="text" value="<?php if(isset($company_name)) echo $company_name;?>" >
				<br/><label>Company Website</label>
				<input  class="input-job" placeholder="Company's Website" name="company_website" type="text" value="<?php if(isset($company_website)) echo $company_website;?>" >
				<br/><label>Company Header</label>
				<input  class="input-job" placeholder="Company Header" name="company_about_header" type="text" value="<?php if(isset($company_about_header)) echo $company_about_header;?>" >
				<br/><label>Company About</label>
				<textarea class="textarea-job" cols="40" rows="10" name="company_about" type="text" ><?php if(isset($company_about)) echo $company_about;?></textarea>
				<br/><label>Company Logo</label>
					<div class="company-logo" >
						<input name="company_logo" id="company_logo_input" onchange="readURL(this);" type="file" class="input-file" accept="image/*"> 
			        	
						<?php 
								if(isset($company_logo)) {
									echo '<img id="company_logo" src="'.base_url().'uploads/'.$company_logo.'" />';
								} else {
									echo '<img id="company_logo" src="'.asset_url().'images/logo-placeholder.jpeg" />';
								}
						?>
			      	</div>
				<br/><label>Company Cover</label>
					<div class="company-cover" >
						<input name="company_cover" id="company_cover_input" onchange="readURL(this);" type="file" class="input-file" accept="image/*"> 
						<?php 
								if(isset($company_cover)) {
									echo '<img id="company_cover" src="'.base_url().'uploads/'.$company_cover.'" />';
								} else {
									echo '<img id="company_cover" src="'.asset_url().'images/placeholder.png" />';
								}
						?>
			        	
			      	</div>

				<div class="clear"></div>
				<br/>
				<p class="info">Looking good. The company details will feature on the top of every job page so make sure you shout about how great you are. Personal details will be kept hidden.</p>
				<br/>
				
				<?php /*if ($this->session->has_userdata('google_auth') && $this->session->userdata('google_auth') == true) {
						echo '<p style="font-family:Avenir;" ><a onclick="signOut();" href="'.base_url().'logout" >Logout</a></p>';
					} else if ($this->session->has_userdata('linkedin_auth') && $this->session->userdata('linkedin_auth') == true) {
						echo '<p style="font-family:Avenir;" ><button id="logoutbutton" style="display:none;color:#26c883;font-size:12px;" onclick="signOutLinkedin();" >Logout</button></p>';
					} else {
						echo '<p style="font-family:Avenir;" ><a href="'.base_url().'/logout">Logout</a></p>';
					}*/

				?>

			</div>
			
		</div>
		
	</div>
</div>


<div class="footer-dashboard">
    <div class="full-delimiter">
    </div>

    <div class="footer-content">
      <div class="left-side">
        <p>Profile</p>
        <a href=<?php echo base_url()."dashboard" ?>>Back to Dashboard</a>
      </div>
      <div class="right-side">
      	<input class="green-button" value="Save Profile" id="save-profile" name="submit" type="submit" >
        <!-- <button class="grey-button" id="preview-job" onclick=<?php echo base_url() ?> >Sign out</button> -->
      </div>
    </div>
</div>
</form>





<script>

	$( document ).ready(function() {
        console.log( "fgdhredfghdfhdhady!" );


        $( "#form-profile" ).submit(function( event ) {
          //alert( "Handler for .submit() called." );
          event.preventDefault();
          //console.log('dsffdgssd');

          $('input[type="submit"]').attr('disabled','disabled');
          
          var subfolder = "";
          var base_url = document.location.origin;
          if(base_url.includes("localhost")) {
            subfolder = "/nudj-php";
          } else if(base_url.includes("zudent")){
            subfolder = "/dev.nudj";
          }

          var fullname = $('[name="fullname"]').val();
          var email = $('[name="email"]').val();
          var company_name = $('[name="company_name"]').val();
          var company_about = $('[name="company_about"]').val();
          var company_about_header = $('[name="company_about_header"]').val();
          var company_website = $('[name="company_website"]').val();

			          

          var url = base_url + subfolder + "/profile/update";
          var redirect = base_url + subfolder + "/profile";

          console.log('url --- ' + url);

          var file_data_cover = $('#company_cover_input').prop("files")[0];   
		  var form_data = new FormData();                  
		  form_data.append('cover', file_data_cover);

		  var file_data_logo = $('#company_logo_input').prop("files")[0];                 
		  form_data.append('logo', file_data_logo);

		  	form_data.append('fullname',fullname);
		  	form_data.append('email',email);
		  	form_data.append('company_name',company_name);
		  	form_data.append('company_website',company_website);
		  	form_data.append('company_about',company_about);
		  	form_data.append('company_about_header',company_about_header);
		  //console.log(form_data);


          $.ajax({
            type: 'POST',
            url: url, //this should be url to your PHP file 
            dataType: 'text',
            data: form_data,
            processData: false,  // tell jQuery not to process the data
    		contentType: false,   // tell jQuery not to set contentType
            complete: function() { console.log("complete?");$('input[type="submit"]').removeAttr("disabled");},
            success: function(stream) { 
            		window.location.href = redirect;
                    $('input[type="submit"]').removeAttr("disabled");
                  }
          });
      });
    });

	function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var name = input.name;

            if(name == 'company_cover') {
	            reader.onload = function (e) {
    	            $('#company_cover')
        	            .attr('src', e.target.result);
           		};
           	}

           	if(name == 'company_logo') {
	            reader.onload = function (e) {
    	            $('#company_logo')
        	            .attr('src', e.target.result);
           		};
           	}

            reader.readAsDataURL(input.files[0]);
        }
    }


</script>


<script>startApp();</script>

</body>
</html>
