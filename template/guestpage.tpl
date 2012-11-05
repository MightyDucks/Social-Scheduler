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
        <div id="maincontent">
                <a href='{$ss_loginurl}'>Log in</a>
        </div>
        <div id="footer">
            <iframe src="https://www.facebook.com/plugins/like.php?href=sdd.steifel.net"
                        scrolling="no" frameborder="0"
                        style="border:none; width:450px; height:80px"></iframe>
            <span>&copy; "The Mighty Ducks" - An SD&D project, Fall 2012</span>
        </div>
    </div>
</body>
</html>
