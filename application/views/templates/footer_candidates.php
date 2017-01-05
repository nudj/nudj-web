<!-- FOOTER  -->



<div class="footer-dashboard">
    <div class="full-delimiter">
    </div>


    <div class="footer-content">
      <div class="left-side">
        <p><?php echo $job_title; ?></p>
        <a class="not-active" href="" ><?php echo strtoupper($job_id);?></a>
      </div>
      <div class="right-side">
        <button class="green-button" onclick=<?php echo "window.location.href='".base_url()."job/".$job_id."'";?> >View Job</button>
        <button class="grey-button" onclick=<?php echo "window.location.href='".base_url()."jobs'"?> >Manage Jobs</button>
      </div>
    </div>

</div>



</body>
</html>

