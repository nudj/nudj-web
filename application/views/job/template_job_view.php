<script src=<?php echo asset_url()."js/clipboard.min.js";?> ></script>



  <!-- CONTENT  -->
  <div id="client-header" class="client-header2">
    <div class="header-container">
    <div class="client-information3">
      <div class="client-logo" >
        <?php
            if(isset($logo_filename)) {
              echo '<img src="'.base_url().'uploads/'.$logo_filename.'" />';
            } else {
              echo '<img src="'.asset_url().'images/logo-placeholder.jpeg" />';
            }
        ?>
      </div>
      <p class="client2-job"><?php if(isset( $job['title_job'])) echo $job['title_job']; ?></p>
      <p class="client-location"><?php if(isset( $job['location'])) echo $job['location']; ?></p>
      <?php if(isset( $job['salary'])) {
            echo '<p class="client-salary">SALARY: ';
            echo $job['salary'];

            if(isset( $job['referral_bonus'])) {
              echo '<span><img src="'.asset_url().'images/nudj-logo.png" /> BONUS: '.$job['referral_bonus'].'</span>';
            }

            echo '</p>';
          }
      ?>
      <div class="apply-container">

      <?php
        $applyURL = "";
        $jobURL = "";
        if(isset($job['job_code'])) {
          $applyURL = base_url()."explore/job/".$job['job_code'];
          $jobURL = base_url()."job/".$job['job_code'];
          if(isset($referred_from)) {
            $applyURL = $applyURL."/referral/".$referred_from;
            $jobURL = $jobURL."/referral/".$referred_from;
          }
        }

        $tinyURL = file_get_contents('http://tinyurl.com/api-create.php?url='.$jobURL);
      ?>

        <button <?php if(isset($preview_mode)) { echo "disabled"; } ?> class="apply-button" onclick=<?php echo "window.location.href='".$applyURL."'";?> type="button">Apply</button>
        <button <?php if(isset($preview_mode)) { echo "disabled"; } ?> class="apply-button2" id="nudj-button" type="button">Nudj to friend</button>
        <button <?php if(isset($preview_mode)) { echo "disabled"; } ?> class="copy-button" data-clipboard-text=<?php echo current_url();?> id="copy-button" type="button">COPY LINK TO CLIPBOARD</button>
        <div class="addthis_inline_share_toolbox" data-url="<?php echo $tinyURL; ?>" data-title="<?php if(isset($createdByUser['company_name'])) echo $createdByUser['company_name']; ?> is hiring and are looking for referrals. Check out the job here: " ></div>

        <!--  data-url="http://google.com" data-description="Description DESCRIPTION" data-title="THE TITLE" data-media="http://www.w3schools.com/css/img_fjords.jpg" -->

        <!-- addthis:url="http://google.com" addthis:title="THE TITLE" addthis:media="http://www.w3schools.com/css/img_fjords.jpg" -->
        <!--  addthis:url="THE URL" addthis:title="THE TITLE" addthis:media="THE IMAGE"  -->
        <!--<button class="nudj-button" type="button">Nudj to a Friend</button>-->
      </div>
    </div>

    <div class="client-photo2">
      <div class="inside-photo">
        <?php
            if(isset($cover_filename)) {
              echo '<img  class="photo4" src="'.base_url().'uploads/'.$cover_filename.'" />';
            } else {
              echo '<img  class="photo4" src="'.asset_url().'images/placeholder.png" />';
            }
        ?>
      </div>
    </div>

    <div class="find-more">
      <button id="find-more2" class="arrow-down-button"><img src=<?php echo asset_url()."images/arrow-down.png";?> /></button>
    </div>

  </div>
  </div>


<?php

    if(isset($createdByUser['company_about']) || isset($createdByUser['company_about_header'])) {

        echo '<div class = "client-section1">';

        if(isset($createdByUser['company_about_header'])) {
          echo '<p class="client-section-title max-width530">'.$createdByUser['company_about_header'].'</p>';
        }

        if(isset($createdByUser['company_about'])) {
          echo '<p class="client-section-description max-width850">'.$createdByUser['company_about'].'</p>';
        }

        if(isset($createdByUser['company_website'])) {

          $url = $createdByUser['company_website'];
          if(strpos( $url , 'http' ) !== false) {

          } else {
            $url = 'http://'.$createdByUser['company_website'];
          }

          echo '<div class="client-section-button-container">
                  <button onclick="window.open(\''.$url.'\')" class="client-section-button">LEARN MORE</button>
                </div>';
        }

    echo '</div>
          <div class="delimiter margin-bottom0">
          </div>';
    }
?>

<?php

    if(isset($job['brief']) || isset($job['description_job'])) {

      echo '<div class = "client-section2 padding-top100">
        <p class = "client-section-pretitle">WHAT WE\'RE LOOKING FOR</p>';

      echo '<p class="client-section-title max-width920">'.$job['brief'].'</p>';

      echo '<p class="client-section-description max-width850">';
        if(isset( $job['description_job'])) echo $job['description_job'];
      echo '</p>';

      echo '<div class = "vertical-delimiter margin-top45"></div>
        </div>

        <div class="delimiter">
        </div>';
    }

  ?>

<?php
    if(isset($job['skills']) || isset($job['preferences'])) {

      $skills = array();
      $preferences = array();

      if(isset($job['skills']) && !empty($job['skills'])) {

        //print_r($job['skills']);

        if(!is_array($job['skills'])) {
          $skills = json_decode($job['skills']);
        } else {
          $skills = $job['skills'];
        }

        //print_r($skills);
      }

      if(isset($job['preferences']) && !empty($job['preferences'])) {

        //print_r($job['preferences']);

        if(!is_array($job['preferences'])) {
          $preferences = json_decode($job['preferences']);
        } else {
          $preferences = $job['preferences'];
        }

        //print_r($preferences);
      }

      if(count($skills) || count($preferences)) {
        echo '<div class = "client-section3">';



      if(count($skills)) {

        //print_r($job['skills']);
        //print_r($skills);

        if(!empty($skills)) {
                  echo '
                     <p class = "client-section-pretitle">The responsibilities</p>
                     <p class="client-section-title">CORE RESPONSIBILITIES</p>
                     <ul class="client-list-description max-width530">';


                foreach($skills as $skill) {
                  echo '<li><p class="list-lines">'.$skill.'</p></li>';
                }


                echo '
                    </ul>
                    <div class = "vertical-delimiter margin-top45 margin-bottom45"></div>';
        }


      }


      if(count($preferences)) {

        if(!empty($preferences)) {
                echo '
                  <p class = "client-section-pretitle">The person</p>
                  <p class="client-section-title">OUR PERFECT MATCH HAS</p>
                  <ul class="client-list-description max-width530">';

            foreach($preferences as $preference) {
              echo '<li><p class="list-lines">'.$preference.'</p></li>';
            }

            echo '
                </ul>
                <div class = "vertical-delimiter margin-top45 margin-bottom45"></div>';
          }
      }


    echo'
      <div class="delimiter">
      </div>
    </div>';
  }
  }
?>


  <div class = "client-section5">
    <p class="client-section-title">SO WHAT ARE YOU WAITING FOR</p>
    <div class="client-section-button-containerB">
      <button <?php if(isset($preview_mode)) { echo "disabled"; } ?> class="apply-buttonB" onclick=<?php echo "window.location.href='".$applyURL."'";?> type="button">Apply</button>
      <button <?php if(isset($preview_mode)) { echo "disabled"; } ?> class="apply-button2B" id="nudj-buttonB" type="button">Nudj to friend</button>
      <button <?php if(isset($preview_mode)) { echo "disabled"; } ?> class="copy-buttonB" data-clipboard-text=<?php echo current_url();?> id="copy-buttonB" type="button">COPY LINK TO CLIPBOARD</button>
      <div class="addthis_inline_share_toolbox" data-url="<?php echo $tinyURL; ?>" data-title="<?php if(isset($createdByUser['company_name'])) echo $createdByUser['company_name']; ?> is hiring and are looking for referrals. Check out the job here: " ></div>
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
    <div class="referral-title">Get paid for your recommendation</div>
    <div class="referral-description">If the person you refer gets the job we want to make sure you get the reward, so we need to know who you are.</div>
    <form id="form-ref" class="referral-form">
      <?php if(isset($referred_from)) {
        echo '<input type="hidden" value="'.$referred_from.'" name="referred-from" >';
      }
      ?>
      <input type="hidden" value=<?php if (isset($job['job_code'])) echo $job['job_code'];?> name="job-id" >
      <input class="referral-input" type="text" placeholder="Your Name" autocomplete="off" name="name-referral">
      <input class="referral-input" type="text" placeholder="Your E-mail Address" autocomplete="off" name="email-referral">
      <!-- <div id="relationship-options">
        <ul>
          <li>Friend</li>
          <li>Family</li>
          <li>Colleague</li>
        </ul>
      </div> -->

      <input class="referral-submit" type="submit" value="Get Unique Nudj Link" name="submit-referral">
    </form>
</div>





<?php if(isset($referred_from)) {

        //if has referral and it did not come back from url

        //echo "$('.popup-referral').show();
        //      $('body').addClass('stop-scrolling');";

        $preposition = 'a';

        if (ctype_alpha($job['title_job']) && preg_match('/^[aeiou]/i', $job['title_job'])) {
          $preposition = 'an';
        }

        echo '<div class = "referral-received-nudj">
                <img class="referral-nudjed-icon" src="'.asset_url().'images/nudjed-icon.png"; />';

                $companyName = '';
                $createdByFirstname = '';

                //print_r($createdByUser);

                if(isset($createdByUser['company_name'])) {
                  $companyName = $createdByUser['company_name'];
                }

                if(isset($createdByUser['fullname'])) {

                  $names_arr = explode(' ',trim($createdByUser['fullname']));
                  $createdByFirstname = $names_arr[0];
                }

              if(count($referral_chain) > 1 && isset($referral_chain[0]['name'])) {

                echo '<div class="referral-nudj-message">
                  <span class="referral-emphasize">'.$companyName.'</span> are hiring. They asked me who I would recommend, I thought of you :-).
                </div>';

                echo '<div class="referral-nudj-small-message">
                  Nudj is a hidden job network. Companies who are hiring ask their friends
                  and employees to recommend those they think are awesome. You will only
                  hear about the best job opportunities from people you know. So you can
                  say goodbye to recruiter spam once and for all.
                </div>';

                echo '<br/><div class="referral-nudj-small-message display-inline">
                      *Not looking? You can still nudj the job on again.
                      </div>

                      <button class="green-button" id="nudj-buttonC" type="button">Nudj To a Friend</button>';


              } else {

                echo '<div class="referral-nudj-message">
                  <span class="referral-emphasize">'.$createdByFirstname.'</span> at <span class="referral-emphasize">'.$companyName.'</span> is hiring '.$preposition.' <span class="referral-emphasize">'.$job['title_job'].'</span>
                  and you\'re the one to help them find the perfect person.
                </div>';

                echo   '<div class="referral-nudj-submessage">
                  Nudj is a new referral platform where you can recommend your
                  friends to cool opportunities with some awesome companies.
                </div>';
                if(isset($job['referral_bonus'])) {

                  echo '<div class="referral-nudj-bonus">
                          If they get hired you\'ll earn '.$job['referral_bonus'].'
                        </div>
                        <br/>';
                }

              }

              echo '<div class="clear-both"></div>
                    <br/>
                      <button id="dismiss-referral-nudj" class="green-button">View Job</div>

              </div>';
      }
?>





    <script type="text/javascript">

    $( document ).ready(function() {
        console.log( "ready!" );

        //check if has referral - we need to show the referral message and stop body from scrolling
        if($('[name="referred-from"]').length) {
          //referred_from = $('[name="referred-from"]').val();

          //first time from unique url
          var job_url = "<?php if( $this->session->userdata('job_url') !== null ) echo $this->session->userdata('job_url'); ?>";
          if(job_url.length) {
            "<?php if( $this->session->userdata('job_url') !== null ) $this->session->unset_userdata('job_url'); ?>";
            "<?php if( $this->session->userdata('companyName') !== null ) $this->session->unset_userdata('companyName'); ?>";
            "<?php if( $this->session->userdata('referral_url') !== null ) $this->session->unset_userdata('referral_url'); ?>";
          } else {
            $('.popup-referral').fadeIn('fast');
            $('.referral-received-nudj').fadeIn('fast');
            $('body').addClass('stop-scrolling');
          }
        }



        // $(document).on('click', function (e) {
        //   if ($(e.target).closest("#relationship-options").length === 0 ) {
        //       $("#relationship-options").slideUp();
        //   }
        // }

        /*$("#relationship-options ul li").click(function(e) {

          $("#relationship-options").slideUp();
          var text = $(this).text();

          $("#relationship-referral").text(text);
          $("#relationship-referral").css('color', '#000');

        });*/


        /*$("#relationship-referral").click(function(e) {

          if($("#relationship-options").css('display') == 'none') {
            $('#relationship-options').width( $("#skills").width() );
            $('#relationship-options').slideDown();
          } else {
            $("#relationship-options").slideUp();
          }
        });*/


        $( "#form-ref" ).submit(function( event ) {

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

          var referred_from = "";

          var name = $('[name="name-referral"]').val();
          var email = $('[name="email-referral"]').val();
          var relationship = $('[name="relationship-referral"]').val();//$('#relationship-referral').text();
          var companyName = "<?php if(isset($createdByUser['company_name'])) echo $createdByUser['company_name']; ?>";
          /*if(relationship != 'Friend' && relationship != 'Colleague' && relationship != 'Family') {
            relationship = "";
          }*/

          console.log("rel " + relationship);

          var job_id = $('[name="job-id"]').val();

          if($('[name="referred-from"]').length) {
            referred_from = $('[name="referred-from"]').val();
          }

          var url = base_url + subfolder + "/job/create-referral";//window.location + "job/create-referral";
          var redirect = base_url + subfolder + "/job/unique-link";

          var result_url = base_url + subfolder + "/job/" + job_id + "/referral/";

          $.ajax({
            type: 'POST',
            url: url, //this should be url to your PHP file
            dataType: 'html',
            data: { 'name':name, 'job_url':window.location.href, 'companyName':companyName, 'email': email, 'relationship':relationship, 'referred_from': referred_from, 'job_id':job_id},
            complete: function() { console.log("complete?");$('input[type="submit"]').removeAttr("disabled");},
            success: function(stream) {
                    $('input[type="submit"]').removeAttr("disabled");
                    $('#form-ref')[0].reset();
                    //$('.referral-unique-link').fadeIn('fast');
                    //$('.referral-box').fadeOut('fast');
                    //$('.popup-referral').fadeOut('fast');
                    //$('.referral-url').empty();
                    //$('.referral-url').append(result_url+stream);
                    //var urlResult = result_url+stream;
                    window.location.href = redirect;
                    //getTinyURL(urlResult);

                    //$('body').addClass('stop-scrolling');
                  }
          });
      });

      function getTinyURL (url) {
        //'http://tinyurl.com/api-create.php?url='
        var response = "<?php echo file_get_contents('http://tinyurl.com/api-create.php?url="+url+"') ?>";

        $('#referral-addthis').attr("data-url",response);
      }

      $('#find-more2').click(function(){
         $('html,body').animate({
            scrollTop: $(".client-section1").offset().top},
            'slow');
      });

      new Clipboard('#copy-button');

      $('#nudj-button').click(function(){

        $('.referral-box').fadeIn('fast');
        $('.popup-referral').fadeIn('fast');
        $('body').addClass('stop-scrolling');

        //$('#copy-button').fadeIn();
      });

      $('#nudj-buttonC').click(function(){

        $('.referral-received-nudj').fadeOut(200);
        $('.referral-box').fadeIn('fast');
        $('.popup-referral').fadeIn('fast');
        $('body').addClass('stop-scrolling');

        //$('#copy-button').fadeIn();
      });

      $('#copy-button').click(function(){
        //$('#copy-button').fadeOut();
      });

      new Clipboard('#copy-buttonB');

      $('#nudj-buttonB').click(function(){

        $('.referral-box').fadeIn('fast');
        $('.popup-referral').fadeIn('fast');
        $('body').addClass('stop-scrolling');

        //$('#copy-buttonB').fadeIn();
      });

      $('.popup-referral').click(function(){
        $('.referral-box').fadeOut('fast');
        $('.referral-received-nudj').fadeOut('fast');
        $('.popup-referral').fadeOut('fast');
        $('body').removeClass('stop-scrolling')
      });

      $('#copy-buttonB').click(function(){
        //$('#copy-buttonB').fadeOut();
      });

      new Clipboard('#copy-referral-url');

      $('#copy-referral-url').click(function(){

        CopyToClipboard('copy-referral-url');

        $(this).fadeOut(200).fadeIn(200);
      });

      $('#dismiss-referral-link').click(function(){

        $('.referral-unique-link').fadeOut('fast');
        $('body').removeClass('stop-scrolling')
      });

      $('#dismiss-referral-nudj').click(function(){
        $('.referral-received-nudj').fadeOut(200);
        $('.popup-referral').fadeOut(200);
        $('body').removeClass('stop-scrolling');
      });
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





<script src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-583eb0fd3cb92ff2"></script>
