<script src=<?php echo asset_url()."js/clipboard.min.js";?> ></script>


  <?php 
    
    $url = '';
    $tinyURL = '';
    
    if($this->session->userdata('referral_url')) {
      $url = $this->session->userdata('referral_url');
      $tinyURL = file_get_contents('http://tinyurl.com/api-create.php?url='.$url);
    }

  ?>

<div class="referral-unique-link">
  <div class="referral-unique-link-content">
    <div class="referral-link-description">Tap link to copy to clipboard</div>
    <div id="copy-referral-url" class="referral-url"><?php echo $url;?></div>
    <div id="referral-addthis" class="addthis_inline_share_toolbox" data-url="<?php echo $tinyURL; ?>" data-title="<?php if($this->session->userdata('companyName') !== null) echo $this->session->userdata('companyName'); ?> is hiring and are looking for referrals. Check out the job here:" ></div> 
  </div>
  <button id="dismiss-referral-link" class="referral-go-back" type="button" onclick="window.history.back();">Return to Job</button>
</div>



    <script type="text/javascript">

    $( document ).ready(function() {
        console.log( "ready!" );

      $('#copy-referral-url').click(function(){

        CopyToClipboard('copy-referral-url');

        $(this).fadeOut(200).fadeIn(200);
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
