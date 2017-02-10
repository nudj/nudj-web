<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>

<head>
    <base href="/">
    <meta charset="utf-8">
    <title>Nudj</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href=<?php echo asset_url(). "css/style.css"; ?>>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

    <!--  Google Sign On -->
    <script src="https://apis.google.com/js/api:client.js"></script>
    <script>
        var subfolder = "";
        var base_url = document.location.origin;
        if (base_url.includes("localhost")) {
            subfolder = "/nudj-php";
        } else if (base_url.includes("zudent")) {
            subfolder = "/dev.nudj";
        }

        var googleUser = {};
        var startApp = function() {
            gapi.load('auth2', function() {
                // Retrieve the singleton for the GoogleAuth library and set up the client.
                auth2 = gapi.auth2.init({
                    client_id: '1018534519510-6u8v9a1183dnud6lh8t1lputpj983b8q.apps.googleusercontent.com',
                    cookiepolicy: 'single_host_origin',
                    // Request scopes in addition to 'profile' and 'email'
                    //scope: 'additional_scope'
                });
                attachSignin(document.getElementById('google-button'));
            });
        };

        function attachSignin(element) {
            console.log(element.id);
            auth2.attachClickHandler(element, {},
                function(googleUser) {

                    var profile = googleUser.getBasicProfile();
                    console.log('ID: ' + profile.getId());
                    console.log('Name: ' + profile.getName());
                    console.log('Email: ' + profile.getEmail());
                    console.log('Image URL: ' + profile.getImageUrl());


                    //document.getElementById('name').innerText = "Signed in: " + googleUser.getBasicProfile().getName();
                    var name = profile.getName();
                    var profile_url = profile.getImageUrl();
                    var email = profile.getEmail();

                    var url = window.location + "/google_auth";
                    var redirect = subfolder + "/dashboard";

                    //alert('url:' + url);

                    //$.post(url, { 'name': name, 'profile_url':profile_url, 'google_email':email, 'google_auth':true });


                    $.ajax({
                        type: 'POST',
                        url: url, //this should be url to your PHP file
                        dataType: 'html',
                        data: {
                            'name': name,
                            'profile_url': profile_url,
                            'google_email': email,
                            'google_auth': true
                        },
                        complete: function() {
                            console.log("complete?");
                        },
                        success: function() {
                            $(location).attr('href', redirect);
                        }
                    });

                },
                function(error) {
                    alert(JSON.stringify(error, undefined, 2));
                });
        }
    </script>

    <!--  LinkedIn Sign On  -->
    <script type="text/javascript" src="//platform.linkedin.com/in.js">
        api_key: 86 lnk250lhvlkr
        authorize: true
        onLoad: onLinkedInLoad
    </script>


    <script type="text/javascript">
        // Setup an event listener to make an API call once auth is complete
        function onLinkedInLoad() {
            IN.Event.on(IN, "auth", getProfileData);
        }

        // Handle the successful return from the API call
        function onSuccess(data) {
            console.log(data);

            //var profile = googleUser.getBasicProfile();
            //console.log('headline: ' + data['headline']);
            //console.log('Name: ' + data['formattedName']);
            //console.log('Email: ' + profile.getEmail());
            //console.log('Image URL: ' + data['pictureUrls']['values'][0]);


            var name = data['formattedName'];
            var firstname = data['firstName'];
            var lastname = data['lastName'];
            var photo_url = data['pictureUrls']['values'][0];
            var email = data['emailAddress'];
            var headline = data['headline'];
            var profile_url = data['siteStandardProfileRequest']['url'];

            var url = window.location + "/linkedin_auth";
            var redirect = subfolder + "/dashboard";

            $.ajax({
                type: 'POST',
                url: url, //this should be url to your PHP file
                dataType: 'html',
                data: {
                    'name': name,
                    'photo_url': photo_url,
                    'linkedin_email': email,
                    'linkedin_auth': true,
                    'firstname': firstname,
                    'lastname': lastname,
                    'headline': headline,
                    'profile_url': profile_url
                },
                complete: function() {
                    console.log("complete?");
                },
                success: function() {
                    $(location).attr('href', redirect);
                }
            });
        }

        // Handle an error response from the API call
        function onError(error) {
            console.log(error);
        }

        // Use the API call wrapper to request the member's basic profile data
        function getProfileData() {
            IN.API.Raw("/people/~:(email-address,first-name,last-name,formatted-name,pictureUrls::(original),siteStandardProfileRequest,headline)").result(onSuccess).error(onError);
        }


        https: //api.linkedin.com/v1/people/~:(id,email-address,first-name,last-name,formatted-name,picture-url)?format=json

            function liAuth() {
                IN.User.authorize(function() {});
            }
    </script>

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
                    <a class="f6 fw6 no-underline bl dib ml2 pv2 ph3 ba br1 black" href=<?php echo base_url(). "signup"; ?>>Request access</a>
                </div>
            </nav>

        </div>
        <div class="dtc v-mid ph3 ph6-l">
            <form class="form-signup measure center avenir" action="" method="post">
                <p class="f3 fw6 ph0 mh0">Welcome back! 👋</p>
                <div class="pb2 pt1 bb b--near-white bw1">
                    <button id="google-button" class="f6 no-underline dib v-mid white ba bg-transparent b--light-silver ph3 pv2 mb2 br1 grow w-30 tc mr2" href="#"><img class="w-70 v-mid" src=<?php echo asset_url()."images/google-icon2.png";?>></img></button>
                    <button onclick="liAuth()" class="f6 no-underline dib v-mid white ba bg-transparent b--light-silver ph3 pv2 mb2 br1 grow w-30 tc" href="#"><img class="w-70 v-mid" src=<?php echo asset_url()."images/linkedin-icon.png";?>></img></button>
                </div>
                <?php echo form_open('signin'); ?>
                <div class="mt3">
                    <label class="db fw6 lh-copy f6" for="email-address">Email</label>
                    <input class="input-signup pa2 ba bg-transparent light-silver w-100 br1 b--light-silver" name="email" type="text" value="<?php if(isset($email)) echo $email;?>" >
                </div>
                <div class="mv3">
                    <label class="db fw6 lh-copy f6" for="password">Password</label>
                    <input class="input-signup pa2 ba bg-transparent light-silver w-100 br1 b--light-silver" name="password" type="password">
                </div>
                <div>
                </div>
                <div class="avenir">
                    <?php if( isset($error) && $error) echo '<p class="error">Hmm... That doesn\'t look right. Try again.</p>';?>
                    <input class="submit fw6 ph3 pv2 input-reset ba b--green bg-green grow pointer f6 dib white br1 avenir" value="Sign In" name="submit" type="submit">
                </div>
                <div class="lh-copy mt3">
                    <p class="f6">Don't have an account? <a class="f6 link dim green" href=<?php echo base_url(). "signup"; ?>>Request access</a></p>
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
