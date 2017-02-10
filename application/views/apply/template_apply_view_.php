

<?php
  error_reporting(E_ERROR);

  //Send mail function
  function send_mail($to,$subject,$message,$headers){
    if(@mail($to,$subject,$message,$headers)){
      
      header("Location: ".base_url()."success");
      exit;
    } else {
      header("Location: ".base_url()."success");
      exit;
    }
  }

  //Check e-mail validation
  function check_email($email){
    if(!@eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email)){
      return false;
    } else {
      return true;
    }
  }

  //Get post data
  if(isset($_POST['name']) and isset($_POST['email']) and isset($_POST['linkedin'])){
    $name    = $_POST['name'];
    $mail    = $_POST['email'];
    $comment = $_POST['linkedin'];

    // if($name == '') {
    //   //echo json_encode(array('info' => 'error', 'msg' => "Please enter your name."));
    //   //exit();
    // } else if($mail == '' or check_email($mail) == false){
    //   //echo json_encode(array('info' => 'error', 'msg' => "Please enter valid e-mail."));
    //   //exit();
    // } else if($comment == ''){
    //   //echo json_encode(array('info' => 'error', 'msg' => "Please enter your Linkedin."));
    //   //exit();
    // } else {
      //Send Mail
      $messageC = '
      <html>
      <head>
        <title>Mail from '. $name .'</title>
      </head>
      <body>
      <br/>
        <table style="width: 600px; font-family: arial; font-size: 14px;border:1px solid #999;" border="0">
        <tr style="height: 50px;">
          <th align="right" style="width:150px; padding-right:15px;border:1px solid #999;">Name:</th>
          <td align="left" style="padding-left:15px; line-height: 20px;border:1px solid #999;">'. $name .'</td>
        </tr>
        <tr style="height: 50px;">
          <th align="right" style="width:150px; padding-right:15px;border:1px solid #999;">E-mail:</th>
          <td align="left" style="padding-left:15px; line-height: 20px;border:1px solid #999;">'. $mail .'</td>
        </tr>
        <tr style="height: 50px;">
          <th align="right" style="width:150px; padding-right:15px;border:1px solid #999;">Linkedin:</th>
          <td align="left" style="padding-left:15px; line-height: 20px;border:1px solid #999;">'. $comment .'</td>
        </tr>
        </table>
        <br/><br/><br/>
      </body>
      </html>
      ';




      //The form has been submitted, prep a nice thank you message
        $output = '<h1>Thanks for your file and message!</h1>';
        //Set the form flag to no display (cheap way!)
        $flags = 'style="display:none;"';

        //Deal with the email
        $to = 'robyn@nudj.co';//'carmenelena.albu@gmail.com';//
        $subject = 'Application - Charlotte Tilbury';

        $message = $messageC;
        $attachment = chunk_split(base64_encode(file_get_contents($_FILES['file']['tmp_name'])));
        $filename = $_FILES['file']['name'];

        $boundary =md5(date('r', time()));

        $headers = "From: hello@nudj.co\r\nReply-To: hello@nudj.co";
        $headers .= "\r\nMIME-Version: 1.0\r\nContent-Type: multipart/mixed; boundary=\"_1_$boundary\"";

        $message="This is a multi-part message in MIME format.

--_1_$boundary
Content-Type: multipart/alternative; boundary=\"_2_$boundary\"

--_2_$boundary
Content-Type: text/html; charset=\"iso-8859-1\"
Content-Transfer-Encoding: 7bit

$message

--_2_$boundary--
--_1_$boundary
Content-Type: application/octet-stream; name=\"$filename\"
Content-Transfer-Encoding: base64
Content-Disposition: attachment

$attachment
--_1_$boundary--";

        mail($to, $subject, $message, $headers);

        header("Location: ".base_url()."success");

      //$url='http://nudj.co/success';
      //echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';

      exit;
        // $url='http://nudj.co/success';
        // header('Location: http://nudj.co/success');




    //  $headers  = 'MIME-Version: 1.0' . "\r\n";
    //  $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    //  $headers .= 'From: ' . $mail . "\r\n";

      //send_mail($to,$subject,$message,$headers);
    //}
  } else {
    //echo json_encode(array('info' => 'error', 'msg' => __MESSAGE_EMPTY_FILDS__));
  }
 ?>


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
      <img src=<?php echo asset_url()."images/logo-placeholder.jpeg";?> />
    </div>
    <p class="client-job"><?php if(isset( $job['title_job'])) echo $job['title_job']; ?></p>
    <p class="client-location"><?php if(isset( $job['location'])) echo $job['location']; ?></p>
    <p class="client-details max-width520">Leave your details below
      and we'll be in touch to tell you more.</p>
    <div class = "vertical-delimiter"></div>
  </div>


  <div>
    <form class="contaform" id="heroForm" action="" method="post" enctype="multipart/form-data" >
      <div class="nudj-form">
        <label class="form-label">NAME</label><br/>
        <input class="input-field" type="text" placeholder="Jane Smith"
        name="name" />
        <br/><label class="form-label">E-MAIL</label><br/>
        <input class="input-field" type="text"
        placeholder="janesmith1@gmail.com" name="email" />
        <br/><label class="form-label">LINKEDIN</label><br/>
        <input class="input-field"  type="text"
        placeholder="http://www.linkedin.com/jane-smith/1jd90.html"
        name="linkedin" />
        <br/>
        <input class="client-section-button" type="submit" value="FIND OUT MORE" /> 
       <!--<button id="submit" type="submit" class="client-section-button" >FIND OUT MORE</button>-->
      </div>
    </form>
  </div>




