<html>
<head>
<title>Class search</title>
<script type="text/javascript" src="resources/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="resources/script1.js"></script>
<link type="text/css" href="resources/style1.css" rel="stylesheet">
<link type="text/png" href="resources/facebook_login_button.png" rel="stylesheet">


</head>
<body>
  <div id="container">
    <div id="header">
      {$ss_header}
    </div>
    <div id="nav">
      {$ss_navigation}
    </div>
    <div id="maincontent">
      <form action='classsearch.php' method='get'>
        <input type='text' name='query' /> <input type='submit' value='Search' />
      </form>
      {$ss_results}
    </div>
    <div id="footer">
        <span>&copy; "The Mighty Ducks" - An SD&D project, Fall 2012</span>
    </div>
    <div class="fb-like" data-href="http://sdd.steifel.net/" data-send="true" data-width="450" data-show-faces="true" data-font="segoe ui">
    </div>
  </div>
</body>
</html>
