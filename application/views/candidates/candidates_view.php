<div class="dashboard-content padding-bottom130">

	<div class="content">
		<p class="title-dashboard margin0-38">Active Candidates</p>

		<?php

		if(isset($candidates)) {

			foreach ($candidates as $candidate) {

				$referral_chain = [];
				$referral_chain_string = "";

				if(isset($candidate['referral_chain'])) {

					$referral_chain = json_decode($candidate['referral_chain'], true);

					foreach($referral_chain as $referral) {
						if(strlen($referral_chain_string) <= 0) {
							if(isset($referral['name'])) {
								$referral_chain_string = $referral['name'];
							}
						} else {
							if(isset($referral['name'])) {
								$referral_chain_string =  $referral['name']. ", ".$referral_chain_string;
							}
						}
					}

					if(strlen($referral_chain_string) <= 0) {
							if(isset($referral_chain['name'])) {
								$referral_chain_string = $referral_chain['name'];
							}
						} else {
							if(isset($referral_chain['name'])) {
								$referral_chain_string =  $referral_chain['name']. ", ".$referral_chain_string;
							}
						}


				}

				$name = (isset($candidate['name'])) ? $candidate['name'] : "John Doe" ;
				
				echo
				'<div class="active-job-container">
		
					<div class="left-side">
						<p class="title-dashboard margin5-0">'.$name.'</p>';

						if(strlen($referral_chain_string)) {
							echo '<p class="grey-subtitle margin-top0">
							<b>Referrer:</b> 
							'.$referral_chain_string.'
							</p>';
						}

					echo '</div>

					<div class="right-side padding-top22">
						<!-- <button class="button-options" onclick="window.location.href=\''.base_url().'job/'.$candidate['job_id'].'\'" type="button">View</button>
						<button class="button-options" type="button">Candidates</button>
						<button class="button-options" type="button">Manage</button> -->
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