<?php
echo file_get_contents('./includes/header.html');

require_once './includes/database.php';
$dbcnx = garth_get_db_connection();
?>

<!--Start of Banner Header-->
<?php

if (isset($_GET['project'])) { $project = intval($_GET['project']); }
if (isset($_GET['page'])) { $page = intval($_GET['page']); }
if (isset($_GET['schematic'])) { $schematic = intval($_GET['schematic']); }

// Get the list of Garth's projects from the database.
$result = $dbcnx->query("SELECT id, name, short_name FROM GarthWilson_Projects");
garth_exit_if_db_error($result);

// Get the ID of the last project
$result = $dbcnx->query("SELECT id FROM GarthWilson_Projects ORDER BY id DESC LIMIT 1");
garth_exit_if_db_error($result);

$row = $result->fetch();
$last_project_id = $row['id'];

// If no valid project ID was not select, default to 1.
if ((!isset($project)) or ($project < 1) or ($project > $last_project_id) ) {
	$project = 1;
}

// Get the name, shortened name, and ID of this project.
$result = $dbcnx->query("SELECT name, short_name FROM GarthWilson_Projects WHERE id='$project'");
garth_exit_if_db_error($result);
$row =$result->fetch();
$project_name = $row['name'];
$project_shortname = $row['short_name'];
$project_id = $project;

// Get the ID number of the previous project
$prev_project_id = $project_id-1;
if ($prev_project_id < 1) { $prev_project_id = $last_project_id; }

// If the previous project is valid, get its name.
$result = $dbcnx->query("SELECT name, short_name FROM GarthWilson_Projects WHERE id='$prev_project_id'");
garth_exit_if_db_error($result);

$row = $result->fetch();
$prev_project_name = $row['short_name'];

// Get the ID number of the next project
$next_project_id = $project_id+1;
if ($next_project_id > $last_project_id) { $next_project_id = 1; }

// If the next project is valid, get its name.
$result = $dbcnx->query("SELECT name, short_name FROM GarthWilson_Projects WHERE id='$next_project_id'");
garth_exit_if_db_error($result);
$row = $result->fetch();
$next_project_name = $row['short_name'];

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

<tr><td bgcolor = "#033B67" colspan="4" width="174"><img src = "images/spacer.gif" width="174" height = "1"></td></tr>
<tr><td bgcolor = "#033B67" width="1" height="16"><img src = "images/spacer.gif" width="1" height="16"></td>
<td bgcolor="BDD6F7" width="3" height="16"><img src = "images/spacer.gif" width="1" height="16"></td>
<td bgcolor="BDD6F7" width="173" height="16">Garth Wilson's Projects</td>
<td bgcolor = "#033B67" width="1" height="16"><img src = "images/spacer.gif" width="1" height = "16"></td></tr>
<tr><td bgcolor = "#033B67" colspan="4"><img src = "images/spacer.gif" width="174" height = "1"></td></tr>

<?php if (!$next_project_id==0): ?>
<tr><td bgcolor = "#033B67" width="1" height="16"><img src = "images/spacer.gif" width="1" height="16"></td>
<td bgcolor="F5F5F5" width="3" height="16"><img src = "images/spacer.gif" width="1" height="16"></td>
<td bgcolor="F5F5F5" width="173" height="16"><a href="projects.php?project=<?php echo htmlentities($next_project_id) ?>">Next: <?php echo htmlentities($next_project_name) ?></a></td>
<td bgcolor = "#033B67" width="1" height="16"><img src = "images/spacer.gif" width="1" height = "16"></td></tr>
<tr><td bgcolor = "#033B67" colspan="4"><img src = "images/spacer.gif" width="174" height = "1"></td></tr>
<?php endif; ?>

<?php if (!$prev_project_id==0): ?>
<tr><td bgcolor = "#033B67" width="1" height="16"><img src = "images/spacer.gif" width="1" height="16"></td>
<td bgcolor="F5F5F5" width="3" height="16"><img src = "images/spacer.gif" width="1" height="16"></td>
<td bgcolor="F5F5F5" width="173" height="16"><a href="projects.php?project=<?php echo htmlentities($prev_project_id) ?>">Prev: <?php echo htmlentities($prev_project_name) ?></a></td>
<td bgcolor = "#033B67" width="1" height="16"><img src = "images/spacer.gif" width="1" height = "16"></td></tr>
<tr><td bgcolor = "#033B67" colspan="4"><img src = "images/spacer.gif" width="174" height = "1"></td></tr>
<?php endif; ?>

<tr><td bgcolor = "#033B67" width="1" height="16"><img src = "images/spacer.gif" width="1" height="16"></td>
<td bgcolor="F5F5F5" width="3" height="16"><img src = "images/spacer.gif" width="1" height="16"></td>
<td bgcolor="F5F5F5" width="173" height="16"><a href="index.php">Back to Projects Index</a></td>
<td bgcolor = "#033B67" width="1" height="16"><img src = "images/spacer.gif" width="1" height = "16"></td></tr>
<tr><td bgcolor = "#033B67" colspan="4"><img src = "images/spacer.gif" width="174" height = "1"></td></tr>

<!-- End of Navigation -->

<tr><td width="1" height="14"><img src = "images/spacer.gif" width="1" height="14"></td></tr>

<!--- Start of "Garth Wilson's Projects" --->

<?php
// If information pages exist for this project, display the "Schematics" selection table.

// Get names and id numbers of schematics for this project

$result = $dbcnx->query("SELECT id, title FROM GarthWilson_Pages WHERE project_id=$project ORDER BY title ASC");
garth_exit_if_db_error($result);

$all_rows = $result->fetchAll();

if (count($all_rows)): ?>

	<tr><td bgcolor = "#033B67" colspan="4" width="174"><img src = "images/spacer.gif" width="174" height = "1"></td></tr>
	<tr><td bgcolor = "#033B67" width="1" height="16"><img src = "images/spacer.gif" width="1" height="16"></td>
	<td bgcolor="BDD6F7" width="3" height="16"><img src = "images/spacer.gif" width="1" height="16"></td>
	<td bgcolor="BDD6F7" width="173" height="16"><?php echo htmlentities($project_shortname) ?> Pages</td>
	<td bgcolor = "#033B67" width="1" height="16"><img src = "images/spacer.gif" width="1" height = "16"></td></tr>
	<tr><td bgcolor = "#033B67" colspan="4"><img src = "images/spacer.gif" width="174" height = "1"></td></tr>

	<?php

	// Display each schematic link in the "Schematics" selection table.

	foreach ($all_rows as $row) {
		echo("<tr><td bgcolor = \"#033B67\" width=\"1\" height=\"16\"><img src = \"images/spacer.gif\" width=\"1\" height=\"16\"></td>\n");
		echo("<td bgcolor=\"F5F5F5\" width=\"3\" height=\"16\"><img src=\"images/spacer.gif\" width=\"1\" height=\"16\"></td>\n");
		echo("<td bgcolor=\"F5F5F5\" width=\"173\" height=\"16\">");
		echo ("<a href=\"projects.php?project=$project&page=${row['id']}\">${row['title']}</a></td>\n");
		echo("<td bgcolor = \"#033B67\" width=\"1\" height=\"16\"><img src = \"images/spacer.gif\" width=\"1\" height = \"16\"></td></tr>\n");
		echo("<tr><td bgcolor = \"#033B67\" colspan=\"4\"><img src = \"images/spacer.gif\" width=\"174\" height = \"1\"></td></tr>\n");
		}
	endif;
?>

<!--- End of "Garth Wilson's" Projects --->

<tr><td width="1" height="14"><img src = "images/spacer.gif" width="1" height="14"></td></tr>

<!--- Start of "Garth's Bench-1 Schematics" --->

<?php

// Get names and id numbers of schematics for this project

$result = $dbcnx->query("SELECT id, title FROM GarthWilson_Schematics WHERE project_id=$project ORDER BY sort_order, title ASC");
garth_exit_if_db_error($result);

// If schematics exist for this project, display the "Schematics" selection table.
$all_rows = $result->fetchAll();

if (count($all_rows)): ?>

	<tr><td bgcolor = "#033B67" colspan="4" width="174"><img src = "images/spacer.gif" width="174" height = "1"></td></tr>
	<tr><td bgcolor = "#033B67" width="1" height="16"><img src = "images/spacer.gif" width="1" height="16"></td>
	<td bgcolor="BDD6F7" width="3" height="16"><img src = "images/spacer.gif" width="1" height="16"></td>
	<td bgcolor="BDD6F7" width="173" height="16"><?=$project_shortname?> Drawings</td>
	<td bgcolor = "#033B67" width="1" height="16"><img src = "images/spacer.gif" width="1" height = "16"></td></tr>
	<tr><td bgcolor = "#033B67" colspan="4"><img src = "images/spacer.gif" width="174" height = "1"></td></tr>

	<?php

	// Display each schematic link in the "Schematics" selection table.

	foreach ($all_rows as $row) {
		echo("<tr><td bgcolor = \"#033B67\" width=\"1\" height=\"16\"><img src = \"images/spacer.gif\" width=\"1\" height=\"16\"></td>\n");
		echo("<td bgcolor=\"F5F5F5\" width=\"3\" height=\"16\"><img src=\"images/spacer.gif\" width=\"1\" height=\"16\"></td>\n");
		echo("<td bgcolor=\"F5F5F5\" width=\"173\" height=\"16\">");
		echo ("<a href=\"projects.php?project=$project&schematic=${row['id']}\">${row['title']}</a></td>\n");
		echo("<td bgcolor = \"#033B67\" width=\"1\" height=\"16\"><img src = \"images/spacer.gif\" width=\"1\" height = \"16\"></td></tr>\n");
		echo("<tr><td bgcolor = \"#033B67\" colspan=\"4\"><img src = \"images/spacer.gif\" width=\"174\" height = \"1\"></td></tr>\n");
		}
	endif;
?>

<!--- End of "Garth's Bench-1 Schematics" --->

</table>

</td></tr>
</table>
</td>
<!--End Left Navigation Table-->

<!--Start of separator between left nav & right content-->
<td width="8"><img src="images/spacer.gif" width = "8"></td>
<td width="100%">

<!--Start Right Content Table-->
<table border = "0" cellpadding = "0" cellspacing = "0" width="100%">
<tr><td>

<?php
if (isset($schematic)) { // Display a schematic page
	$result = $dbcnx->query("SELECT title,description,image_filename FROM GarthWilson_Schematics WHERE id=$schematic AND project_id=$project");
	garth_exit_if_db_error($result);

	if ($row = $result->fetch()) {
		echo("<b>$project_name Drawings: ${row['title']}</b><p>");
		echo("${row['description']}<p>");
		echo("<img src=\"diagrams/${row['image_filename']}\">");
		}
	else {
		echo("Schematic not found.  Please select a schematic from the menu at left.");
		}
	}
else {
	if (!isset($page)) { // Display an information page
		$result = $dbcnx->query("SELECT id FROM GarthWilson_Pages WHERE project_id='$project'");
		garth_exit_if_db_error($result);

		$row=$result->fetch();
		$page=$row['id'];
		}

	$result = $dbcnx->query("SELECT title,filename FROM GarthWilson_Pages WHERE id='$page' AND project_id='$project'");
	garth_exit_if_db_error($result);

	if ($row=$result->fetch()) {
		echo("<b>$project_name Pages: ${row['title']}</b><p>");

		$file_content = fread(fopen("descriptions/${row['filename']}","r"),
		filesize("descriptions/bench-1.html"));
		echo($file_content);

		}
	else {
		echo("Page not found.  Please select a page from the menu at left.");
		}

	}

?>


</td></tr></table>
<!--End Bottom Content Table-->
</td></tr></table>

<BR clear=all><HR>
<BR><FONT SIZE=-1>Last updated September 13, 2003.</FONT>
</HTML>
