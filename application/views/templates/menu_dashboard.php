    <div class="menu">
      <div class="menu-dashboard">
        <button type="button" class="menu-logo">
            <img src=<?php echo asset_url()."images/nudj-logo.png";?> />
        </button>

        <div class="menu-options-dashboard">
        	<button class=<?php if(isset($acronym)) {echo '"notifications-button top8"';} else {echo "notifications-button";}?> >Notifications</button>
        	<button onclick=<?php echo "window.location.href='".base_url()."profile'";?> type="button" class="profile-button">
                <?php 
                    if(isset($photo_url)) {
                        echo '<img src="'.$photo_url.'" >';
                    } else if(isset($acronym)) {
                        echo '<div class="acronym"><span>'.$acronym.'</span></div>';
                    } else {
                        echo '<div class="acronym"></div>';
                    }
                ?>
        </button>
        	<button class="dropdown-button"></button>
        </div>
      </div>
    </div>

    <div >

    </div>