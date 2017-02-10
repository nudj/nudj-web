<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
    <base href="/">
    <meta charset="utf-8">
    <title>Nudj</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href=<?php echo asset_url()."css/style.css"; ?>>

	<script
			  src="https://code.jquery.com/jquery-3.1.1.min.js"
			  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
			  crossorigin="anonymous"></script>


        <!-- Intercom -->
        <script>
            window.intercomSettings = {
                app_id: "jmk9ujo0",
                custom_launcher_selector: '#open-intercom'
            };
        </script>
        <script>
            (function() {
                var w = window;
                var ic = w.Intercom;
                if (typeof ic === "function") {
                    ic('reattach_activator');
                    ic('update', intercomSettings);
                } else {
                    var d = document;
                    var i = function() {
                        i.c(arguments)
                    };
                    i.q = [];
                    i.c = function(args) {
                        i.q.push(args)
                    };
                    w.Intercom = i;

                    function l() {
                        var s = d.createElement('script');
                        s.type = 'text/javascript';
                        s.async = true;
                        s.src = 'https://widget.intercom.io/widget/fwqdxwzg';
                        var x = d.getElementsByTagName('script')[0];
                        x.parentNode.insertBefore(s, x);
                    }
                    if (w.attachEvent) {
                        w.attachEvent('onload', l);
                    } else {
                        w.addEventListener('load', l, false);
                    }
                }
            })()
        </script>

<script>
        window['_fs_debug'] = false;
        window['_fs_host'] = 'www.fullstory.com';
        window['_fs_org'] = '3127D';
        window['_fs_namespace'] = 'FS';
        (function(m,n,e,t,l,o,g,y){
            if (e in m && m.console && m.console.log) { m.console.log('FullStory namespace conflict. Please set window["_fs_namespace"].'); return;}
            g=m[e]=function(a,b){g.q?g.q.push([a,b]):g._api(a,b);};g.q=[];
            o=n.createElement(t);o.async=1;o.src='https://'+_fs_host+'/s/fs.js';
            y=n.getElementsByTagName(t)[0];y.parentNode.insertBefore(o,y);
            g.identify=function(i,v){g(l,{uid:i});if(v)g(l,v)};g.setUserVars=function(v){g(l,v)};
            g.identifyAccount=function(i,v){o='account';v=v||{};v.acctId=i;g(o,v)};
            g.clearUserCookie=function(c,d,i){if(!c || document.cookie.match('fs_uid=[`;`]*`[`;`]*`[`;`]*`')){
            d=n.domain;while(1){n.cookie='fs_uid=;domain='+d+
            ';path=/;expires='+new Date(0).toUTCString();i=d.indexOf('.');if(i<0)break;d=d.slice(i+1)}}};
        })(window,document,window['_fs_namespace'],'script','user');
    </script>

    <script>
  window.intercomSettings = {
    app_id: "jmk9ujo0"
  };
</script>
<script>(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',intercomSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Intercom=i;function l(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/jmk9ujo0';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);}if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})()</script>

</head>

<body>

  <body class="avenir">

      <div class="vh-100 dt w-100 black">
          <div class="absolute w-100">

              <nav class="dt w-100 mw8 center">
                  <div class="dtc w2 v-mid pa3">
                      <a href="/" class="dib w3 grow">
                          <img src=<?php echo asset_url()."images/nudj-logo.png";?>></img>
                      </a>
                  </div>
                  <div class="dtc v-mid tr pa3">
                      <a class="fw6 f6 no-underline black dn dib-ns ph4 pv3" href=<?php echo base_url(). "signin"; ?>>Login</a>
                  </div>
              </nav>

          </div>
          <div class="dtc v-mid ph3 ph6-l">
              <form class="form-signup measure center avenir" action="" method="post">
                  <p class="f3 fw6 ph0 mh0">Good things come to those who... Nudj 👊</p>
                  <div class="pb2 pt bb b--near-white bw1">
                  <p>
                    Just enter your details below and we'll get back to you asap.
                  </p>
                  </div>
                  <?php echo form_open('signup'); ?>
                  <div class="mt3">
                      <label class="db fw6 lh-copy f6" for="email-address">Name</label>
                      <input class="input-signup pa2 ba bg-transparent light-silver w-100 br1 b--light-silver" name="fullname" type="text" value="<?php if(isset($fullname)) echo $fullname;?>" >
                  </div>
                  <div class="mt3">
                      <label class="db fw6 lh-copy f6" for="email-address">Email</label>
                      <input class="input-signup pa2 ba bg-transparent light-silver w-100 br1 b--light-silver" name="email" type="text" value="<?php if(isset($email)) echo $email;?>" >
                  </div>
                  <div class="mv3">
                      <label class="db fw6 lh-copy f6" for="password">Company</label>
                      <input class="input-signup pa2 ba bg-transparent light-silver w-100 br1 b--light-silver" name="company_name" type="text" value="<?php if(isset($company_name)) echo $company_name;?>">
                  </div>
                  <div>
                  </div>
                  <div class="avenir">
                      <?php if( isset($errors)) echo '<p class="error">'.$errors[0].'</p>';?>
                      <input class="submit fw6 ph3 pv2 input-reset ba b--green bg-green grow pointer f6 dib white br1 avenir" value="Request access" name="submit" type="submit">
                  </div>
                  <div class="lh-copy mt3">
                      <p class="f6">Already have an account? <a class="f6 link dim green" <a href=<?php echo base_url()."signin"; ?>>Sign in</a></p>
                  </div>
          </div>
      </div>
      </form>
      </div>
      </div>
      </div>

<!-- Insert footer -->

<script>
    startApp();
</script>
