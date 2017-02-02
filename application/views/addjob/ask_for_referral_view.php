<div class="ask-referral-background"> </div>
<?php
    $url = '';
    $tinyReferralURL = '';

    if($this->session->userdata('referral_url')) {
      $url = $this->session->userdata('referral_url');
      $tinyReferralURL = file_get_contents('http://tinyurl.com/api-create.php?url='.$url);
    }
    //$this->session->userdata('companyName');
    //$this->session->userdata('job_url');
?>

<div class = "ask-referral-nudj">
	<div class="ask-referral-content">

        <!--

        JG: Removing icon until we can find something more appropriate / designer joins.

        <img class="ask-referral-icon" src="<?php echo asset_url().'images/referrer-icon.png'; ?>" /> -->

        <?php
          if(isset($unique_link)) {
            echo '<p class="ask-referral-title">Nudj to a friend</p>';
          } else {
            echo '<p class="ask-referral-title">Ask for an introduction</p>';
          }

        ?>


       	<div class="ask-referral-message">
       			You are nearly there. Time to ask your network to help your hunt for the perfect candidate.
        </div>

        <?php
          if(isset($unique_link)) {
            echo '<div id="referral-link-hidden">'.$url.'</div>';
          } else {
            echo '<div id="referral-link-hidden">'.base_url().'job/';
              if(isset($job['job_code']))
                echo $job['job_code'];
              echo '</div>';
          }

        ?>


        <button class="green-button" type="button" id="copy-to-clipboard">Copy link to clipboard</button>

        <?php
          if(!isset($unique_link)) {
            $jobURL = "";
            if(isset($job['job_code'])) {
              $jobURL = base_url()."job/".$job['job_code'];
              if(isset($referred_from)) {
                $jobURL = $jobURL."/referral/".$referred_from;
              }
            }

            $tinyURL = file_get_contents('http://tinyurl.com/api-create.php?url='.$jobURL);
          }
      ?>

      <div class="addthis_inline_share_toolbox" data-url="<?php if(isset($unique_link)) { echo $tinyReferralURL ;} else { echo $tinyURL; } ?>" data-title="<?php if(isset($unique_link)) { if($this->session->userdata('companyName') !== null ) echo $this->session->userdata('companyName'); } else { if(isset($createdByUser['company_name'])) echo $createdByUser['company_name']; } ?> is hiring and are looking for referrals. Check out the job here: " ></div>

      <?php if(!isset($unique_link)) {
       echo '<div class="horizontal-divider"></div>
          <p class="ask-referral-title">Send it to the Nudj network</p>
          <p class="ask-referral-message">Increase the reach of your
          job by inviting nudj\'s carefully curated network of referrers to introduce candidates to the job.</p>
          <a class="green-button" href="mailto:robyn@nudj.co?Subject=I want to use the Nudj network">Send to network</a>';
        }
        ?>

    <!--

    JG: Temporarily commenting out sending of email to webmaster@nudj.co on clicking of button. Replaced with the above code.

    <div class="horizontal-divider"></div>

        <form id="send-entire-network">
        	<label class="emphasize">Looking for more reach? Why not send it to the Nudj Network</label>
          <br><br>
          <button class="green-button" type></button> type="submit" class="referral-submit" name="send-entire-network" value="Send to Nudj Network" />
        </form>
        <p class="ask-referral-message">Increase the reach of your
        job by inviting nudj\'s curated network of referrers to introduce candidates to the job.</p>

    -->

        <div class="horizontal-divider"></div>

        <p class="emphasize">Pro Tip</p>
        <?php

          if(!isset($unique_link)) {
            echo '<p class="ask-referral-message">Tailored and personal requests are 75% more likely to get a response so take the time to put in a little bit of effort.</p>';
          } else {
            echo '<p class="ask-referral-message">Don\'t overthink it. Send to those you think would be good for the job. Even if they aren\'t looking they will appreciate you thinking of them..</p>';
          }
        ?>

        <?php
          if(!isset($unique_link)) {

		        echo '<button class="grey-button" onclick="window.location.href=\''.base_url().'dashboard\'" type="button">Back to Dashboard</button>';
		      } else {
            echo '<button class="grey-button" onclick="window.history.back();" type="button">Return to Job</button>';
          }
          ?>

    <br/><br/><br/>
	</div>
</div>

<script src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-583eb0fd3cb92ff2"></script>

<script type="text/javascript">
$( document ).ready(function() {
        console.log( "Ready!" );

	$('#copy-to-clipboard').click(function(){
        CopyToClipboard('referral-link-hidden');
        $(this).fadeOut(200).fadeIn(200);
      });


    // $( "#send-entire-network" ).submit(function( event ) {
    //       //alert( "Handler for .submit() called." );
    //       event.preventDefault();
    //       //console.log('dsffdgssd');
    //
    //       $('input[type="submit"]').attr('disabled','disabled');
    //
    //       var subfolder = "";
    //       var base_url = document.location.origin;
    //       if(base_url.includes("localhost")) {
    //         subfolder = "/nudj-php";
    //       } else if(base_url.includes("zudent")){
    //         subfolder = "/dev.nudj";
    //       }
    //
    //       var job_url = $('#referral-link-hidden').text();
    //
    //       console.log("job_url  " + job_url);
    //
    //       var url = base_url + subfolder + "/add-job/ask-referral-network";//window.location + "job/create-referral";
    //       //var redirect = base_url + subfolder + "/add-job";
    //
    //       $.ajax({
    //         type: 'POST',
    //         url: url, //this should be url to your PHP file
    //         dataType: 'html',
    //         data: { 'job_url':job_url},
    //         complete: function() { console.log("complete?");$('input[type="submit"]').removeAttr("disabled");},
    //         success: function(stream) {
    //                  $('input[type="submit"]').removeAttr("disabled");
    //                  $('input[type="submit"]').value("Sent");
    //               }
    //       });
    //   });

});

function CopyToClipboard(containerid) {
if (document.selection) {
    var range = document.body.createTextRange();
    range.moveToElementText(document.getElementById(containerid));
    range.select().createTextRange();
    document.execCommand("Copy");

} else if (window.getSelection) {
    var range = document.createRange();
     range.selectNode(document.getElementById(containerid));
     window.getSelection().addRange(range);
     document.execCommand("Copy");

     if (window.getSelection) {
        if (window.getSelection().empty) {  // Chrome
          window.getSelection().empty();
        } else if (window.getSelection().removeAllRanges) {  // Firefox
          window.getSelection().removeAllRanges();
        }
      } else if (document.selection) {  // IE?
        document.selection.empty();
      }
      }
}

</script>
