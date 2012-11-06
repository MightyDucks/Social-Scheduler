<!DOCTYPE html>
<html lang="en">
<head>
<title>UI Mockup #1</title>
<script type="text/javascript" src="resources/jquery-1.8.2.min.js"></script>
<link type="text/css" href="resources/style1.css" rel="stylesheet">


</head>
<body>
    <div id="container">
        <div id="header">
                {$ss_header}
        </div>
        <div id="nav">
                {$ss_navigation}
        </div>
        <!-- Above could be a php include? I haven't worked much with php as I've said. -->
        <div class="fb-login-button" data-show-faces="true" data-width="200" data-max-rows="1"></div>
        <div id="maincontent">
                <a href='{$ss_loginurl}'>Log in</a>
        </div>
        <div id="footer">
            <span>&copy; "The Mighty Ducks" - An SD&D project, Fall 2012</span>
        </div>
        <div id="fb-root"></div>
            <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=119211698227030";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
        <div class="fb-like" data-href="http://sdd.steifel.net/" data-send="true" data-width="450" data-show-faces="true" data-font="segoe ui">
        </div>
    </div>
</body>
</html>
