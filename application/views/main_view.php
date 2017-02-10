<div class="header">
          <p class="header-title">Putting your connections to work</p>
          <p class="header-description">The World's Most Innovative P2P Recruitment Network</p>

          <div class="find-more">
            <button type="button" id="find-more" class="arrow-down-button"><img src=<?php echo asset_url()."images/arrow-down.png";?> /></button>
          </div>
        </div>



        <div class = "home-section1">
          <div class="home-section1-logo">
            <img src=<?php echo asset_url()."images/nudj-logo.png";?> />
          </div>
          <p class="home-section-title max-width340">THE BEST RECRUITER IS NOT A RECRUITER</p>
          <p class="home-section-description max-width340">Less than 10% of recruiter spam sent through LinkedIn or E-mail gets openedby the recipient.</p>
          <div class="home-section-button-container">
            <button class="home-section-button">LEARN MORE</button>
          </div>
        </div>

        <div class="delimiter">
        </div>

        <div class = "home-section2">
        <!--  <div id="frame2">
              <div class="slidee"> -->
                <p class = "home-section-pretitle">HOWEVER</p>
                <p class="home-section-title max-width370">81% OF TOP TALENT WOULD FOLLOW UP ON A JOB LEAD FROM A FRIEND.</p>
                <div class = "vertical-delimiter"></div>
          <!--    </div>
              <div class="slidee">
                <p class = "home-section-pretitle">THIS MEANS THAT</p>
                <p class="home-section-title max-width370">NUDJ TURN YOUR ... AND PERSONAL NETWORK ....</p>
                <div class = "vertical-delimiter"></div>
              </div>

              <div class="slidee">
                <p class = "home-section-pretitle">OTHER TEXT</p>
                <p class="home-section-title max-width370">OTHER PRETTY TEXT.</p>
                <div class = "vertical-delimiter"></div>
              </div>
          </div>-->

        </div>

        <div class="delimiter">
        </div>

        <div class = "home-section3">
          <!--<div class="home-gallery-img">
            <img src="images/home1.png" />
          </div>-->
          <p class = "home-section-pretitle">IN RETURN YOU GET</p>
          <!--  <div id="frame">
              <div class="slidee"> -->
                <p class="home-section-title">PEER VETTED CANDIDATES.</p>
              <!--  </div>
              <div class="slidee">
                <p class="home-section-title">and other stuff too</p>
              </div>
              <div class="slidee">
                <p class="home-section-title">like bananas.</p>
              </div>

          </div> -->

          <div class = "vertical-delimiter"></div>
        </div>

        <div class="delimiter">
        </div>

        <div class = "home-section4">
          <p class = "home-section-pretitle">THIS MEANS THAT</p>
          <p class="home-section-title max-width520 padding-top15-bottom25">NUDJ HAS HELPED THESE CLIENTS SAVE THOUSANDS OF DOLLARS IN AGENCY FEES THROUGH OUR REFERRAL MODEL</p>
          <div class = "vertical-delimiter"></div>

          <div class="home-client-gallery">
            <img src=<?php echo asset_url()."images/Nudj-Clients.png";?> />
          </div>

        </div>

        <div class="delimiter">
        </div>

        <div class="home-section5">
          <div class="home-section5-button-container">
            <button class="home-section5-button" onclick=<?php echo "window.location.href='".base_url()."signin'";?> type="button">GET STARTED WITH NUDJ</button>
          </div>
        </div>

  <!-- FOOTER  -->

        <div class="full-delimiter">
        </div>
        <div class="footer">
          <div class="footer-content">
            <button type="button" class="footer-logo">
                <img src=<?php echo asset_url()."images/nudj-logo.png";?> />
            </button>

            <div class="footer-options">
              <button class="footer-regular-button" type="button">EXPLORE</button>
              <button class="footer-regular-button" type="button">ABOUT</button>
              <button class="footer-regular-button" type="button">CONTACT</button>
            </div>

            <div class="footer-social-icons">
              <button type="button">
                <img src=<?php echo asset_url()."images/fb-icon.png";?> />
              </button>
              <button type="button">
                <img src=<?php echo asset_url()."images/twitter-icon.png";?> />
              </button>
              <button type="button">
                <img src=<?php echo asset_url()."images/mail-icon.png";?> />
              </button>
            </div>

          </div>
        </div>

<script type="text/javascript">

$( document ).ready(function() {
    console.log( "ready!" );

    $('#find-more').click(function(){
      $('html,body').animate({
         scrollTop: $(".home-section1").offset().top},
         'slow');
   });


});
</script>