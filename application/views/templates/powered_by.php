    <div class="poweredby">
      <div class="poweredby-content">
        <div class="poweredby-text">POWERED BY</div>
        <button type="button" class="poweredby-logo">
            <img src=<?php echo asset_url()."images/nudj-logo.png";?> />
        </button>

        <?php if(isset($preview_mode)) { 
	  		echo "<div class='right-side'>
	  			<button class='green-button' id='preview-post-job' >Post Job</button>
        		<button class='grey-button' id='edit-job' onclick='goBack()'>Edit Job</button>
	  		</div>"; 
	  	} 

	  	?>
      </div>

     
	  	
    </div>

<script>
    function goBack() {
        window.history.back();
    }

    $( document ).ready(function() {
        console.log( "resdfdsfady!" );

        $('#preview-post-job').click(function( event ) {

            console.log('que esta pasando');
            
            //alert( "Handler for .submit() called." );
            //event.preventDefault();

            $(this).attr('disabled','disabled');
            
            var subfolder = "";
            var base_url = document.location.origin;
            if(base_url.includes("localhost")) { // if local environment
                subfolder = "/nudj-php";
            } else if(base_url.includes("zudent")){ // if test environment
                subfolder = "/dev.nudj"; 
            }

              var title = "<?php if(isset($job['title_job'])) echo $job['title_job']; ?>";
              var description = "<?php if(isset($job['description_job'])) echo $job['description_job']; ?>";
              var salary = "<?php if(isset($job['salary'])) echo $job['salary']; ?>";
              var referral_bonus = "<?php if(isset($job['referral_bonus'])) echo $job['referral_bonus']; ?>";
              var location = "<?php if(isset($job['location_job'])) echo $job['location_job']; ?>";
              var brief = "<?php if(isset($job['brief'])) echo $job['brief']; ?>";

              var preferences = <?php echo json_encode($job['preferences']); ?>;
              var skills = <?php echo json_encode($job['skills']); ?>;

              var url = base_url + subfolder + "/add-job/create-job"; 
              var redirect = var redirect = base_url + subfolder + "/add-job/ask-for-referral/";

              console.log('url  ----   ' + url);

              $.ajax({
                type: 'POST',
                url: url, //this should be url to your PHP file 
                dataType: 'html',
                data: { 'brief':brief, 'preferences': preferences, 'skills':skills, 'title': title, 'description':description, 'location':location, 'salary':salary, 'referral_bonus':referral_bonus },
                complete: function() { console.log("complete?");},
                success: function(stream) { window.location.href = redirect + stream; }
            });



        });

    });

</script>