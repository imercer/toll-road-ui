<head>
<script src="https://storage.googleapis.com/code.getmdl.io/1.0.1/material.min.js"></script>
    <script src="/analytics.js"></script>
<link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.1/material.indigo-pink.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="/css/iframe.css">
<link rel="stylesheet" href="/css/styles.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script> 
$.ajax({
    type: "GET", 
    url: "https://tollingonline.nzta.govt.nz/#/purchasetrips/prerequisites",
    contentType: "application/html",
    Host: "tollingonline.nzta.govt.nz",
    Origin: "http://tollingonline.nzta.govt.nz",
    beforeSend: function(xhr, settings){
            xhr.setRequestHeader("Origin", "*");},
    success: function(data){
        $("#output_iframe_id").attr('src',"/")
        $("#output_iframe_id").contents().find('html').html(data); 
    }
});
    </script> 
</head>
<body>
<!-- Always shows a header, even in smaller screens. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title">Pay a Toll</span>
      <!-- Add spacer, to align navigation to the right -->
      <div class="mdl-layout-spacer"></div>
      <!-- Navigation. We hide it in small screens. -->
      <!--<nav class="mdl-navigation mdl-layout--large-screen-only">

        <a class="mdl-navigation__link" href=""><b>Pay a Toll</b></a>
        <a class="mdl-navigation__link" href="/account.html">View Account</a>
        <a class="mdl-navigation__link" href="/notice.html">Pay a Notice</a>
      </nav>-->
    </div>
  </header>
  <div class="mdl-layout__drawer">
    <span class="mdl-layout-title"><a href="/">Toll Road</a></span>
    <nav class="mdl-navigation">
        <a class="mdl-navigation__link" href="">Pay a Toll</a>
        <a class="mdl-navigation__link" href="/account.html">View Account</a>
        <a class="mdl-navigation__link" href="/notice.html">Pay a Notice</a>
    </nav>
  </div>
  <main class="mdl-layout__content">
    <div class="page-content">
        <!--<iframe scrolling="no" id="output_iframe_id" style="border: 0px none; margin-left: -185px; height: 859px; margin-top: -533px; width: 926px;">-->
       <!-- Actual local page-->
        <iframe src="tollflowdeclare.html"></iframe>
      </div>
  </main>
</div>
</body>