<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
    <base href="/">
    <meta charset="utf-8">
    <title>Nudj</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <link rel="stylesheet" href=<?php echo asset_url()."css/style.css"; ?>>
    <link rel="stylesheet" href=<?php echo asset_url()."css/client-style.css";?>>
    <link rel="stylesheet" href=<?php echo asset_url()."css/apply-style.css";?>>
    <link rel="stylesheet" href=<?php echo asset_url()."css/responsive-style.css";?>>

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-route.js"></script>
</head>

<body>




<!-- MENU  -->

    <div class="menu">
      <div class="menu-content">
        <button type="button" class="menu-logo">
            <img src=<?php echo asset_url()."images/nudj-logo.png";?> />
        </button>

      </div>
    </div>

<!-- CONTENT  -->

    <div class="berightback">
      <div class="cotent-back">
        <div class="back">
          <img src=<?php echo asset_url()."images/Nudj-Coming-Soon-Icon.png";?> />
        </div>
        <p class="home-section-title">Coming Soon</p>
        <p class="beback-subcaption">We're almost ready to unveil the new Nudj</p>
        <p class="beback-description">But that doesn't mean it's not business as usual, if you're connected enough to have received a Nudj from a friend follow that link to the role and start your next chapter.</p>
      <div class="short-delimiter"></div>
      <div class="center-twitter">
        <iframe ng-show="user.twitter" allowtransparency="true" frameborder="0" scrolling="no"
              src="//platform.twitter.com/widgets/follow_button.html?screen_name=NudjHQ"
              style="width:208px; height:20px;"></iframe>
      </div>
      </div>
    </div>


</body>
</html>