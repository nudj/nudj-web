<div class="dashboard-content">

	<div class="content">

		<div onclick=<?php echo "window.location.href='".base_url()."add-job'";?> id="add_job_tile" class="tile">
			<img src=<?php echo asset_url()."images/add_job_icon_inactive.png";?> >
			<p>Create Job</p>
		</div>

		<div onclick=<?php echo "window.location.href='".base_url()."jobs'";?> id="manage_jobs_tile" class="tile">
			<img src=<?php echo asset_url()."images/manage_jobs_icon_inactive.png";?> >
			<p>View Jobs</p>
		</div>

		<div onclick=<?php echo "window.location.href='".base_url()."profile'";?> id="edit_profile_tile" class="tile">
			<img src=<?php echo asset_url()."images/edit_profile_icon_inactive.png";?> >
			<p>Edit Profile</p>
		</div>
	</div>
</div>


<script type="text/javascript">
	$( document ).ready(function() {
	    console.log( "ready!" );

	    var subfolder = "";
	    var base_url = document.location.origin;
	    if(base_url.includes("localhost")) {
	    	subfolder = "/nudj-web";
	    } else if(base_url.includes("zudent")){
	    	subfolder = "/dev.nudj";
	    }

	    $('#add_job_tile').hover(function(){ // hover in

	    	 $("#add_job_tile img").fadeTo(50,1.0, function() {
			      $('#add_job_tile img').attr("src", base_url+subfolder+"/assets/images/add_job_icon_active.png");
			  });
		}, function(){ // hover out

			$("#add_job_tile img").fadeTo(100,1.0, function() {
			      $('#add_job_tile img').attr("src", base_url+subfolder+"/assets/images/add_job_icon_inactive.png");
			  });
		});

		$('#manage_jobs_tile').hover(function(){ // hover in

			$("#manage_jobs_tile img").fadeTo(50,1.0, function() {
			      $('#manage_jobs_tile img').attr("src", base_url+subfolder+"/assets/images/manage_jobs_icon_active.png");
			  });
		}, function(){ // hover out

			$("#manage_jobs_tile img").fadeTo(100,1.0, function() {
			      $('#manage_jobs_tile img').attr("src", base_url+subfolder+"/assets/images/manage_jobs_icon_inactive.png");
			  });
		});

		$('#edit_profile_tile').hover(function(){ // hover in

			$("#edit_profile_tile img").fadeTo(50,1.0, function() {
			      $('#edit_profile_tile img').attr("src", base_url+subfolder+"/assets/images/edit_profile_icon_active.png");
			  });

		    $('#edit_profile_tile img').attr("src", base_url+subfolder+"/assets/images/edit_profile_icon_active.png");
		}, function(){ // hover out

			$("#edit_profile_tile img").fadeTo(100,1.0, function() {
			      $('#edit_profile_tile img').attr("src", base_url+subfolder+"/assets/images/edit_profile_icon_inactive.png");
			  });
		});

	});
</script>