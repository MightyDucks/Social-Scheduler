<!DOCTYPE html>
<html lang="en">
<head>
<title>UI Mockup #1</title>
<script type="text/javascript" src="resources/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="resources/script1.js"></script>
<link type="text/css" href="resources/style1.css" rel="stylesheet">
<link type="text/png" href="resources/facebook_login_button.png" rel="stylesheet">


</head>
<body>
    <div id="container">
        <div id="fb-root"></div>
            <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=119211698227030";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
        <div id="header">
                {$ss_header}
                
        </div>
        <div id="nav">
                {$ss_navigation}
                <div onclick=\"location.href='{$ss_loginurl}'\"><img src = "resources/facebook_login_button.png" /></div>
        </div>
        <!-- Above could be a php include? I haven't worked much with php as I've said. -->
        <div id="maincontent">
        </div>
        <div id="footer">
            <span>&copy; "The Mighty Ducks" - An SD&D project, Fall 2012</span>
        </div>
        <div class="fb-like" data-href="http://sdd.steifel.net/" data-send="true" data-width="450" data-show-faces="true" data-font="segoe ui">
        </div>
    </div>
</body>
</html>
