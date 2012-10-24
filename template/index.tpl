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
                {$ss_maincontent}
        </div>
        <div id="footer">
            <div id="footercolorbars">
                <div id="footercontent">
                    These borders were...<br/>
                    ...testing out the color transition scheme from the Jerseys, I think it looks ugly and terrible so I'll think of something else.
                </div>
            </div>
        </div>
    </div>
</body>
</html>