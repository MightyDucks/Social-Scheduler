<!DOCTYPE html>
<html lang="en">
<head>
<title>Social Scheduler</title>
<script type="text/javascript" src="resources/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="resources/script1.js"></script>
<link type="text/css" href="resources/style1.css" rel="stylesheet">

</head>
<body>
    <div id="container">
        <div id="header">
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=119211698227030";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
            {$ss_header}
        </div>
        <div id="nav">
            {$ss_navigation}
        </div>
        
        <div id="maincontent">
                {$ss_maincontent}
        </div>

        <div id="footer">
            <span>&copy; "The Mighty Ducks" - An SD&D project, Fall 2012</span>
        </div>
        <div class="fb-like" data-href="http://sdd.steifel.net" data-send="true" data-width="450" data-show-faces="true"></div>

    </div>
</body>
</html>
