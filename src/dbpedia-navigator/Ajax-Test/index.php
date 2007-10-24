<?php
session_start();

require("ajax.php");
 ini_set('error_reporting',E_ALL);
 ini_set('max_execution_time',200);
 
echo '<?xml version="1.0" encoding="UTF-8"?>'
?>
<html>
  <head>
    <title>DL Learner</title>
    <meta http-equiv=\"content-type\" content=\"text/html; charset=ISO-8859-1\"/>
    <link rel="stylesheet" href="default.css"/>
	<?php $xajax->printJavascript('xajax/'); ?>
	<script type="text/javascript">
        showLoadingSubjects = function() {
            xajax.$('loadingSubject').style.display='block';
            xajax.$('searchcontent').style.display = 'none';
        };
        hideLoadingSubjects = function() {
            xajax.$('loadingSubject').style.display = 'none';
            xajax.$('searchcontent').style.display='block';
        };
        showLoadingArticle = function() {
            xajax.$('loadingArticle').style.display='block';
        };
        hideLoadingArticle = function() {
            xajax.$('loadingArticle').style.display = 'none';
        }
  </script>
   </head>
  <body>
<h3>DBPedia-Navigator-Test</h3>
<div id="wrapper">
<div id="leftSidebar">

<div class="box" id="search">
  <div class="boxtitle">Search</div>
  <div class="boxcontent">
	<form action="index.php" method="GET" id="searchForm">
	<table border="0">
	<tr><tb>Search:<br/></tb></tr>
	<tr><tb><input type="textfield" name="label" id="label">&nbsp;&nbsp;&nbsp;<select name="limit" size="1" id="limit">
      		<option>1</option>
      		<option selected="selected">5</option>
      		<option>10</option>
      		<option>15</option>
      		</select><br/></tb></tr>
			<tr><tb><input type="button" value="Search" class="button" onclick="xajax_getsubjects(document.getElementById('label').value,document.getElementById('limit').value);return false;" /></tb></tr>
			</table>
			</form>
  </div> <!-- boxcontent -->
</div> <!-- box -->

<div class="box" id="search">
  <div class="boxtitle">Searchresults</div>
  <div class="boxcontent">
  <div id="searchcontent" style="display:none"></div>
  <div id="loadingSubject" style="display:none"><img src="ajax-loader.gif" alt="Loading..."/></div>
  </div> <!-- boxcontent -->
</div> <!-- box -->

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div><!-- END leftSidebar -->

<div id="content">
<div class="box" id="search">
  <div class="boxtitle">Content<div id="contentbuttons"></div></div>
  <div class="boxcontent" id="article">
  <div id="loadingArticle" style="display:none"><img src="ajax-loader.gif" alt="Loading..."/></div>
  </div> <!-- boxcontent -->
</div> <!-- box -->

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div><!-- content -->
<div id="rightSidebar">

<div class="box">
  <div class="boxtitle">Positives</div>
  <div class="boxcontent" id="Positives">
  </div> <!-- boxcontent -->
</div> <!-- box -->

<div class="box">
  <div class="boxtitle">Negatives</div>
  <div class="boxcontent" id="Negatives">
  </div> <!-- boxcontent -->
</div> <!-- box -->

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>      
</div><!-- rightSidebar -->
<div id="clear"></div>
</div>
  </body>
</html>
			