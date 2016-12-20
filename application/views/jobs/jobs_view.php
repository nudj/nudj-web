<div class="dashboard-content padding-bottom130">

	<div class="content">
		<p class="title-dashboard margin0-38">Active Jobs</p>

		<?php

		if(isset($jobs)) {

			foreach ($jobs as $job) {
				
				echo
				'<div class="active-job-container">
		
					<div class="left-side">
						<p class="grey-pretitle margin-bottom0">Role</p>
						<p class="title-dashboard margin5-0">'.$job['title_job'].'</p>
						<p class="grey-subtitle margin-top0">'.$job['job_code'].'</p>
					</div>

					<div class="right-side padding-top22">
						<button class="button-options" onclick="window.location.href=\''.base_url().'job/'.$job['job_code'].'\'" type="button">View</button>
						<button class="button-options" type="button">Candidates</button>
						<button class="button-options" type="button">Manage</button>
					</div>

					<div style="clear-both"></div>
				</div>';

			}
		}

		?>
		

	</div>
</div>







<script type="text/javascript">
	$( document ).ready(function() {
	    console.log( "ready!" );

	    

	});
</script>