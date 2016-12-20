<script src=<?php echo asset_url()."js/clipboard.min.js";?> ></script>





  <!-- CONTENT  -->
  <div class="client-header">
    <div class="client-information2">
      <div class="client-logo" >
        <img src=<?php echo asset_url()."images/logo-placeholder.jpeg";?> />
      </div>
      <p class="client2-job"><?php if(isset( $job['title_job'])) echo $job['title_job']; ?></p>
      <p class="client-location"><?php if(isset( $job['location'])) echo $job['location']; ?></p>
      <?php if(isset( $job['salary'])) {
            echo '<p class="client-salary">SALARY: ';
            echo $job['salary']; 
            echo '</p>';
          }
      ?>
      <div class="apply-container">
        <button class="apply-button" onclick=<?php echo "window.location.href='".base_url()."explore/job/".$job['job_code']."'";?> type="button">APPLY</button>
        <button class="apply-button2" id="nudj-button" type="button">Nudj TO A FRIEND</button>
        <button class="copy-button" data-clipboard-text=<?php echo current_url();?> id="copy-button" type="button">COPY LINK TO CLIPBOARD</button>
        <div class="addthis_inline_share_toolbox"></div>
        <!--<button class="nudj-button" type="button">Nudj to a Friend</button>-->
      </div>
    </div>

    <div class="client-photo">
        <img class="photo1" src=<?php echo asset_url()."images/placeholder.png";?> />
        <img class="photo2" src=<?php echo asset_url()."images/placeholder.png";?> />
    </div>

    <div class="find-more">
      <button  id="find-more2" class="arrow-down-button"><img src=<?php echo asset_url()."images/arrow-down.png";?> /></button>
    </div>

  </div>



  <div class = "client-section1">

    <p class="client-section-title max-width530">Overview</p>
    <p class="client-section-description max-width850"><?php if(isset( $job['description_job'])) echo $job['description_job']; ?></p>
    <div class="client-section-button-container">
      <button id="learn-more" class="client-section-button">LEARN MORE</button>
    </div>
  </div>

  <div class="delimiter margin-bottom0">
  </div>

<?php
    
    if(isset($job['brief'])) {

      echo '<div class = "client-section2 padding-top100">
        <p class = "client-section-pretitle">WHAT WE\'RE LOOKING FOR</p>';

      echo '<p class="client-section-title max-width920">'.$job['brief'].'</p>';
      echo '<div class = "vertical-delimiter margin-top45"></div>
        </div>

        <div class="delimiter">
        </div>';
    }

  ?>

<?php
    if(isset($job['skills']) || isset($job['preferences'])) {
        echo '<div class = "client-section3">';


     
      if(isset($job['skills'])) {
        
        echo '
             <p class = "client-section-pretitle">The responsibilities</p>
             <p class="client-section-title">CORE RESPONSABILITIES</p>
             <ul class="client-list-description max-width530">';

        $skills = json_decode($job['skills']);

        foreach($skills as $skill) {
          echo '<li><p class="list-lines">'.$skill.'</p></li>';
        }


        echo '    
            </ul>
            <div class = "vertical-delimiter margin-top45 margin-bottom45"></div>';
        
      }

  
      if(isset($job['preferences'])) {

        echo '
        <p class = "client-section-pretitle">The person</p>
            <p class="client-section-title">OUR PERFECT MATCH HAS</p>
            <ul class="client-list-description max-width530">';

        $preferences = json_decode($job['preferences']);
        foreach($preferences as $preference) {
          echo '<li><p class="list-lines">'.$preference.'</p></li>';
        }

        echo '
            </ul>
            <div class = "vertical-delimiter margin-top45 margin-bottom45"></div>';
      }


    echo'
      <div class="delimiter">
      </div>
    </div>';
  }
?>


  <div class = "client-section5">
    <p class="client-section-title">SO WHAT ARE YOU WAITING FOR</p>
    <div class="client-section-button-containerB">
      <button class="apply-buttonB" onclick=<?php echo "window.location.href='".base_url()."explore/job/".$job['job_code']."'";?> type="button">APPLY</button>
      <button class="apply-button2B" id="nudj-buttonB" type="button">Nudj TO A FRIEND</button>
        <button class="copy-buttonB" data-clipboard-text=<?php echo current_url();?> id="copy-buttonB" type="button">COPY LINK TO CLIPBOARD</button>
        <div class="addthis_inline_share_toolbox margin-left33"></div>
      <br/>
      <!-- <button class="client-nudj-button">NUDJ TO A FRIEND</button> -->
    </div>
     <?php
          if(isset($job['referral_bonus'])) {
              echo '<p class="referral-bonus-client"><span>PS.</span> IF YOUR REFERRAL IS SUCCESSFUL YOU\'LL EARN ';
              echo $job['referral_bonus'];
              echo '</p>';
            }
        ?>
  </div>



<div class="popup-referral">
</div>

<div class="referral-box">
    
</div>



    <script type="text/javascript">

    $( document ).ready(function() {
        console.log( "ready!" );

       $('#find-more2').click(function(){
         $('html,body').animate({
            scrollTop: $(".client-section1").offset().top},
            'slow');
      });
      $('#learn-more').click(function(){
         $('html,body').animate({
            scrollTop: $(".client-section2").offset().top},
            'slow');
      });

      new Clipboard('#copy-button');

      $('#nudj-button').click(function(){
        $('#copy-button').fadeIn();
      });

      $('#copy-button').click(function(){
        $('#copy-button').fadeOut();
      });

      new Clipboard('#copy-buttonB');

      $('#nudj-buttonB').click(function(){
        $('#copy-buttonB').fadeIn();
      });

      $('#copy-buttonB').click(function(){
        $('#copy-buttonB').fadeOut();
      });
});
</script>





<script src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-583eb0fd3cb92ff2"></script>
