<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
    <base href="/">
    <meta charset="utf-8">
    <title>Nudj</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script
              src="https://code.jquery.com/jquery-3.1.1.min.js"
              integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
              crossorigin="anonymous"></script>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> -->

    <link rel="stylesheet" href=<?php echo asset_url()."css/style.css"; ?>>
    <link rel="stylesheet" href=<?php echo asset_url()."css/dashboard-style.css"; ?>>
    <link rel="stylesheet" href=<?php echo asset_url()."css/addjob-style.css"; ?>>
    <link rel="stylesheet" href=<?php echo asset_url()."css/candidates-style.css"; ?>>
    <link rel="stylesheet" href=<?php echo asset_url()."css/jobs-style.css"; ?>>
    <link rel="stylesheet" href=<?php echo asset_url()."css/profile-style.css"; ?>>
    <link rel="stylesheet" href=<?php echo asset_url()."css/job-style.css";?>>
    <link rel="stylesheet" href=<?php echo asset_url()."css/apply-style.css";?>>
    <link rel="stylesheet" href=<?php echo asset_url()."css/responsive-style.css";?>>
    <link rel="stylesheet" href=<?php echo asset_url()."css/login-style.css";?>>
<!--
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-route.js"></script> -->

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
