

<!-- MENU  -->

    <div class="poweredby">
      <div class="poweredby-content">
        <div class="poweredby-text">POWERED BY</div>
        <button type="button" class="poweredby-logo">
            <img src=<?php echo asset_url()."images/nudj-logo.png";?> />
        </button>
      </div>
    </div>


  <!-- CONTENT  -->

  <div class="apply-header">
     <div class="client-logo" >
      <?php 
            if(isset($logo_filename)) {
              echo '<img src="'.base_url().'uploads/'.$logo_filename.'" />';
            } else {
              echo '<img src="'.asset_url().'images/logo-placeholder.jpeg" />';
            }
        ?>
      
    </div>
    <p class="client-job"><?php if(isset( $job['title_job'])) echo $job['title_job']; ?></p>
    <p class="client-location"><?php if(isset( $job['location'])) echo $job['location']; ?></p>
    <p class="client-details max-width520">Leave your details below
      and we'll be in touch to tell you more.</p>
    <div class = "vertical-delimiter"></div>
  </div>

  <div>
    <form class="contaform" id="heroForm" action="" method="post" enctype="multipart/form-data">
      <div class="nudj-form">
        <?php if(isset($referred_from)) {
          echo '<input type="hidden" value="'.$referred_from.'" name="referred_from" >';
        }
        ?>
        <input type="hidden" value=<?php echo $job['job_code'];?> name="job_id" >
        <label class="form-label">NAME</label><br/>
        <input class="input-field" type="text" placeholder="Jane Smith"
        name="name"/>
        <br/><label class="form-label">E-MAIL</label><br/>
        <input class="input-field" type="text"
        placeholder="janesmith1@gmail.com" name="email" />
        <br/><label class="form-label">LINKEDIN</label><br/>
        <input class="input-field" type="text"
        placeholder="http://www.linkedin.com/jane-smith/1jd90.html"
        name="linkedin" />
        <br/><label class="form-label">CV</label>
        <div class="upload-container">
          <button class="upload-button">UPLOAD</button>
          <input class="upload-input" name="file" type="file" />
        </div>
        <br/>
        <input class="client-section-button cursor-pointer" name="submit" type="submit" value="FIND OUT MORE" /> 
       <!--<button id="submit" type="submit" class="client-section-button" [disabled]="!heroForm.form.valid">FIND OUT MORE</button>-->
      </div>
    </form>
  </div>



<script type="text/javascript">

    $( document ).ready(function() {
        console.log( "ready!" );


        $( "#heroForm" ).submit(function( event ) {
          //alert( "Handler for .submit() called." );
          event.preventDefault();
          //console.log('dsffdgssd');

          $('input[type="submit"]').attr('disabled','disabled');
          
          var subfolder = "";
          var base_url = document.location.origin;
          if(base_url.includes("localhost")) {
            subfolder = "/nudj-web";
          } else if(base_url.includes("zudent")){
            subfolder = "/dev.nudj";
          }

          // var referred_from = "";

          // var name = $('[name="name"]').val();
          // var email = $('[name="email"]').val();
          // var linkedin = $('[name="linkedin"]').val();
          // var job_id = $('[name="job-id"]').val();
          
          // if($('[name="referred-from"]').length) {
          //   referred_from = $('[name="referred-from"]').val();
          // }

          //console.log(referred_from + " are?");

          // var pathArray = window.location.pathname.split( '/' );
          // var count = pathArray.length;
          // var job_id = pathArray[count - 1];
          //console.log('path ' + pathArray[count - 1]);

          var url = base_url + subfolder + "/apply/applyJobEmail";
          var redirect = base_url + subfolder + "/success";

          var formData = new FormData($(this)[0]);
          //formData.append( 'linkedin', linkedin);
          //console.log("WHAT? " + formData);

          $.ajax({
            type: 'POST',
            url: url, //this should be url to your PHP file 
            dataType: 'html',
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            cache: false,
            data: formData,
            complete: function() { console.log("complete?");},
            success: function() { window.location.href=redirect;}//$(location).attr('href', redirect);}
          });
      });
});
</script>


