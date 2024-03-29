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


<!-- CONTENT  -->

<body class="avenir">
    <section class="vh-100 dt w-100 bg-green relative">
        <div class="absolute w-100">
            <nav class="dt w-100 mw8 center">
                <div class="dtc w2 v-mid pa3">
                    <a href=<?php echo base_url(). ""; ?>  class="dib w3 grow-large">
                        <img src=<?php echo asset_url()."images/nudj-logo-white.png";?>></img>
                    </a>
                </div>
                <div class="dtc v-mid tr pa3">
                    <a class="fw6 f6 hover-white no-underline white dn dib-ns pv2 ph3" href=<?php echo base_url(). "signin"; ?>>Login</a>
                    <a class="fw6 f6 hover-white no-underline white dib ml2 pv2 ph3 ba br1" href=<?php echo base_url(). "request"; ?>>Request access</a>
                </div>
            </nav>
        </div>
        <div class="dtc v-mid tc white ph3 ph6-l">
            <h1 class="f2-m f-subheadline-l fw6 tc white">Having trouble attracting the best talent to your business?</h1>
        </div>
        <div class="absolute" style="top: 90%; left: 50%; margin-left: -18px;">
            <div class="f2 no-underline">🤔</div>
        </div>
    </section>
    <section class="vh-100 dt w-100 bg-purple relative">
        <div class="dtc v-mid tc white ph3 ph6-l">
            <h1 class="f2-m f-subheadline-l fw6 tc white">Sick of dealing with recruiters?</h1>
        </div>
        <div class="absolute" style="top: 90%; left: 50%; margin-left: -18px;">
            <div class="f2 no-underline">😡</div>
        </div>
    </section>
    <section class="vh-100 dt w-100 bg-blue relative">
        <div class="dtc v-mid tc white ph3 ph6-l">
            <h1 class="f2-m f-subheadline-l fw6 tc white">Job boards just not cutting it?</h1>
        </div>
        <div class="absolute" style="top: 90%; left: 50%; margin-left: -18px;">
            <div class="f2 no-underline">😔</div>
        </div>
    </section>
    <section class="vh-100 dt w-100 bg-light-red relative">
        <div class="dtc v-mid tc white ph3 ph6-l">
            <h1 class="f2-m f-subheadline-l fw6 tc white">We're building something that will help. Interested?</h1>
            <a class="fw6 f6 no-underline grow dib v-mid bg-green white ba b--green ph4 pv3 ma2 br1" href=<?php echo base_url(). "request"; ?>>Request access</a>
            <a class="fw6 f6 no-underline grow dib v-mid white ba b--white ph4 pv3 ma2 br1" href="#" id="open-intercom">Get in touch</a>
        </div>
        <div class="absolute" style="top: 90%; left: 50%; margin-left: -18px;">
            <div class="f2 no-underline">😎</div>
        </div>
    </section>


    <footer class="pa4 pa5-l black-70">
        <section class="cf mb1 tc tl-ns">
            <a href="mailto:hello@nudj.co" class="link b f3 f2-ns dim black-70 lh-solid">hello@nudj.co</a>
        </section>
        <div class="dt dt--fixed w-100">
            <div class="dn dtc-ns v-mid">
                <p class="f7 black-70 dib pr3 mb3">
                    Copyright © Nudj 2017
                </p>
            </div>
            <div class="db dtc-ns black-70 tc tr-ns v-mid pa3">
                <a href="https://www.facebook.com/nudjapp.co/" class="link dim dib mr3 black-70" title="Nudj App on Facebook">
                    <svg class="db w2 h2" data-icon="facebook" viewBox="0 0 32 32" fill="currentColor">
      <title >facebook icon</title>
      <path d="M8 12 L13 12 L13 8 C13 2 17 1 24 2 L24 7 C20 7 19 7 19 10 L19 12 L24 12 L23 18 L19 18 L19 30 L13 30 L13 18 L8 18 z"
      ></path>
    </svg>
                </a>
                <a href="https://twitter.com/NudjHQ" class="link dim dib mr3 black-70">
                    <svg class="db w2 h2" data-icon="twitter" viewBox="0 0 32 32" fill="currentColor">
      <title >twitter icon</title>
      <path d="M2 4 C6 8 10 12 15 11 A6 6 0 0 1 22 4 A6 6 0 0 1 26 6 A8 8 0 0 0 31 4 A8 8 0 0 1 28 8 A8 8 0 0 0 32 7 A8 8 0 0 1 28 11 A18 18 0 0 1 10 30 A18 18 0 0 1 0 27 A12 12 0 0 0 8 24 A8 8 0 0 1 3 20 A8 8 0 0 0 6 19.5 A8 8 0 0 1 0 12 A8 8 0 0 0 3 13 A8 8 0 0 1 2 4"
      ></path>
    </svg>
                </a>
                </a>
            </div>
        </div>
        <div class="db dn-ns">
            <p class="f7 black-70 mt4 tc">
                Copyright © Nudj 2017
            </p>
        </div>
    </footer>
