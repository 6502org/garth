<?php 
echo file_get_contents('./includes/header.html');

require_once './includes/database.php';
$dbcnx = garth_get_db_connection();
?>

<link rel="Stylesheet" href="styles.css">
<title>6502.org: Garth Wilson's Projects</title>

<!--Start Bottom Content Table-->
<table border = "0" cellpadding = "0" cellspacing = "0" width = "100%">

<!--Start of separator between left side of browser window & left nav-->
<tr><td width="5"><img src = "images/spacer.gif" width = "5"></td>

<!--Start Left Navigation Table-->
<td valign = "top">
<table border = "0" cellpadding = "0" cellspacing = "0" width = "174">
<tr><td>

<table width="174" cellpadding="0" cellspacing="0">

<!-- Start of Navigation -->

<tr><td bgcolor = "#033B67" colspan="4" width="174"><img src = "spacer.gif" width="174" height = "1"></td></tr>
<tr><td bgcolor = "#033B67" width="1" height="16"><img src = "spacer.gif" width="1" height="16"></td>
<td bgcolor="BDD6F7" width="3" height="16"><img src="spacer.gif" width="1" height="16"></td>
<td bgcolor="BDD6F7" width="173" height="16">Garth Wilson's Projects</td>
<td bgcolor = "#033B67" width="1" height="16"><img src = "spacer.gif" width="1" height = "16"></td></tr>
<tr><td bgcolor = "#033B67" colspan="4"><img src = "spacer.gif" width="174" height = "1"></td></tr>

<tr><td bgcolor = "#033B67" width="1" height="16"><img src = "spacer.gif" width="1" height="16"></td>
<td bgcolor="F5F5F5" width="3" height="16"><img src="spacer.gif" width="1" height="16"></td>
<td bgcolor="F5F5F5" width="173" height="16"><a href="projects.php">First: Bench-1 Computer</a></td>
<td bgcolor = "#033B67" width="1" height="16"><img src = "spacer.gif" width="1" height = "16"></td></tr>
<tr><td bgcolor = "#033B67" colspan="4"><img src = "spacer.gif" width="174" height = "1"></td></tr>

<tr><td bgcolor = "#033B67" width="1" height="16"><img src = "spacer.gif" width="1" height="16"></td>
<td bgcolor="F5F5F5" width="3" height="16"><img src="spacer.gif" width="1" height="16"></td>
<td bgcolor="F5F5F5" width="173" height="16"><a href="http://6502.org/">Return to 6502.org</a></td>
<td bgcolor = "#033B67" width="1" height="16"><img src = "spacer.gif" width="1" height = "16"></td></tr>
<tr><td bgcolor = "#033B67" colspan="4"><img src = "spacer.gif" width="174" height = "1"></td></tr>

<!-- End of Navigation -->

<tr><td width="1" height="14"><img src="spacer.gif" width="1" height="14"></td></tr>

<!--- Start of "Garth Wilson's Projects" --->

<tr><td bgcolor = "#033B67" colspan="4" width="174"><img src = "spacer.gif" width="174" height = "1"></td></tr>
<tr><td bgcolor = "#033B67" width="1" height="16"><img src = "spacer.gif" width="1" height="16"></td>
<td bgcolor="BDD6F7" width="3" height="16"><img src="spacer.gif" width="1" height="16"></td>
<td bgcolor="BDD6F7" width="173" height="16">Project Index</td>
<td bgcolor = "#033B67" width="1" height="16"><img src = "spacer.gif" width="1" height = "16"></td></tr>
<tr><td bgcolor = "#033B67" colspan="4"><img src = "spacer.gif" width="174" height = "1"></td></tr>

<?php
// Get the list of Garth's projects from the database.
$result = @mysql_query("SELECT id, name, short_name, description, thumbnail_image FROM GarthWilson_Projects");
if (!$result) {
	echo("<p>Error performing query: " . mysql_error() . "<p>");
	exit();
	}

while ( $row = mysql_fetch_array($result) ) {
	echo("<tr><td bgcolor = \"#033B67\" width=\"1\" height=\"16\"><img src = \"spacer.gif\" width=\"1\" height=\"16\"></td>");
	echo("<td bgcolor=\"F5F5F5\" width=\"3\" height=\"16\"><img src=\"spacer.gif\" width=\"1\" height=\"16\"></td>");
	echo("<td bgcolor=\"F5F5F5\" width=\"173\" height=\"16\"><a href=\"projects.php?project=${row['id']}\">${row['name']}</a></td>");
	echo("<td bgcolor = \"#033B67\" width=\"1\" height=\"16\"><img src = \"spacer.gif\" width=\"1\" height = \"16\"></td></tr>");
	echo("<tr><td bgcolor = \"#033B67\" colspan=\"4\"><img src = \"spacer.gif\" width=\"174\" height = \"1\"></td></tr>");
	}

?>

<!--- End of "Garth Wilson's Projects --->

</table>

</td></tr>
</table>
</td>
<!--End Left Navigation Table-->

<!--Start of separator between left nav & right content-->
<td width="8"><img src = "spacer.gif" width = "8"></td>
<td width="100%">

<!--Start Right Content Table-->
<table border = "0" cellpadding = "0" cellspacing = "0" width="100%">
<tr><td>

<b>Introduction</b>&nbsp;by Garth Wilson (<script type="text/javascript">eval(unescape('%64%6f%63%75%6d%65%6e%74%2e%77%72%69%74%65%28%27%3c%61%20%68%72%65%66%3d%22%6d%61%69%6c%74%6f%3a%77%69%6c%73%6f%6e%6d%69%6e%65%73%40%64%73%6c%65%78%74%72%65%6d%65%2e%63%6f%6d%22%20%3e%77%69%6c%73%6f%6e%6d%69%6e%65%73%40%64%73%6c%65%78%74%72%65%6d%65%2e%63%6f%6d%3c%2f%61%3e%27%29%3b'))</script>)
<BR clear=all><P>
<table><tr><td width="650">
Here are some pictures of the workbench computer I've mentioned several
times on the forum, along with other computer projects (some completed, some
not), home-made modules for the next workbench computer, and the two
hand-held HP computers that have been sources of inspiration.
</td></tr></table>

<p>
<table border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="20" height="120"><img src="spacer.gif" width="20" height="120"></td>

<?php 
// Get the list of Garth's projects from the database.
$result = @mysql_query("SELECT id, name, short_name, description, thumbnail_image FROM GarthWilson_Projects");
if (!$result) {
	echo("<p>Error performing query: " . mysql_error() . "<p>");
	exit();
	}

$thumb_count = 1;
   while ( $row = mysql_fetch_array($result) ) {

      echo("<td width=\"180\" align=\"left\" valign=\"top\" class=\"smallblack\">");
      echo("<a href=\"projects.php?project=${row['id']}\"><img src=\"thumbnails/${row['thumbnail_image']}\" width=\"180\" height=\"120\" border=\"1\"></a><br clear=all>");
      echo("<img src=\"spacer.gif\" width=\"5\" height=\"5\"><br clear=all>");
      echo("<a href=\"projects.php?project=${row['id']}\">${row['name']}</a>: ${row['description']}</td>");
      echo("<td width=\"20\" height=\"120\"><img src=\"spacer.gif\" width=\"20\" height=\"120\"></td>");

      $thumb_count++;
      if ($thumb_count == 4) {
         $thumb_count = 1;
         echo("</tr><tr><td colspan=\"7\" height=\"20\"><img src=\"spacer.gif\" height=\"20\"></td></tr>");
         echo("<tr><td width=\"20\" height=\"120\"><img src=\"spacer.gif\" width=\"20\" height=\"120\"></td>");
         }
   }
?>        
</table>

</td></tr></table>
<!--End Bottom Content Table-->
</td></tr></table>
<BR clear=all><HR>
<FONT SIZE=-1>&nbsp;Last updated June 2, 2003.</FONT>
</HTML>
