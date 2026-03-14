<?php
require_once './includes/data.php';
$all_projects = garth_load_projects();

// Look up project by slug
$project_slug = $_GET['project'] ?? '';
$project_id = garth_find_by_slug($all_projects, $project_slug);
if ($project_id === null) {
    http_response_code(404);
    include './includes/header.php';
    echo '<title>Not Found</title></head><body>';
    echo '<p>Project not found.</p>';
    echo '</body></html>';
    exit;
}

$current = $all_projects[$project_id];
$project_name = $current['name'];
$project_shortname = $current['short_name'];
$project_slug = garth_slugify($project_name);
$drawings = $current['drawings'] ?? [];

// Look up drawing by slug
$drawing_slug = $_GET['drawing'] ?? '';
$drawing_id = $drawing_slug ? garth_find_by_slug($drawings, $drawing_slug) : null;

if ($drawing_slug && $drawing_id === null) {
    http_response_code(404);
    include './includes/header.php';
    echo '<title>Not Found</title></head><body>';
    echo '<p>Drawing not found.</p>';
    echo '</body></html>';
    exit;
}

include './includes/header.php';
?>
  <title>Garth Wilson's Project Pages &mdash; <?= htmlspecialchars($project_name) ?></title>
</head>
<body>

<header class="site-header">
  <h1><a href="/">Garth Wilson's Project Pages</a></h1>
  <div class="header-right">
    <a href="http://6502.org/" class="header-link">Back to 6502.org</a>
    <button class="menu-toggle" aria-label="Toggle navigation">&#9776;</button>
  </div>
</header>

<div class="page-layout">

  <aside class="sidebar">
    <nav class="sidebar-section">
      <h2>Project Index</h2>
      <ul>
        <?php foreach ($all_projects as $i => $proj): ?>
          <li<?= ($i === $project_id) ? ' class="active"' : '' ?>>
            <a href="/projects/<?= garth_slugify($proj['name']) ?>"><?= htmlspecialchars($proj['name']) ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
    </nav>

    <nav class="sidebar-section">
      <h2><?= htmlspecialchars($project_shortname) ?> Pages</h2>
      <ul>
        <li<?= ($drawing_id === null) ? ' class="active"' : '' ?>>
          <a href="/projects/<?= $project_slug ?>">Project Description</a>
        </li>
        <?php foreach ($drawings as $i => $d): ?>
          <li<?= ($drawing_id === $i) ? ' class="active"' : '' ?>>
            <a href="/projects/<?= $project_slug ?>/drawing/<?= garth_slugify($d['title']) ?>"><?= htmlspecialchars($d['title']) ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
    </nav>

    <?php include './includes/sidebar_wilson_mines.php'; ?>
  </aside>

  <main class="main-content">
    <?php
    if ($drawing_id !== null && isset($drawings[$drawing_id])) {
        // Display a drawing
        $drawing = $drawings[$drawing_id];
        $img_src = '/projects/' . $project_slug . '/drawings/' . htmlspecialchars($drawing['image']);
        $img_alt = htmlspecialchars($drawing['title']);
        echo '<h2>' . htmlspecialchars($project_name) . ' Drawings: ' . $img_alt . '</h2>';
        echo '<div class="schematic-view">';
        if (!empty($drawing['description'])) {
            echo '<p class="schematic-description">' . $drawing['description'] . '</p>';
        }
        echo '<img src="' . $img_src . '" alt="' . $img_alt . '">';
        echo '<p class="schematic-hint">Click the drawing to view it larger.</p>';
        echo '</div>';
    } else {
        // Display the project description
        echo '<h2>' . htmlspecialchars($project_name) . '</h2>';
        echo '<div class="project-description">';
        $filepath = "projects/" . $project_slug . "/index.html";
        if (file_exists($filepath)) {
            $html = file_get_contents($filepath);
            $html = str_replace('src="photos/', 'src="/projects/' . $project_slug . '/photos/', $html);
            $html = str_replace('src="drawings/', 'src="/projects/' . $project_slug . '/drawings/', $html);
            echo $html;
        }
        echo '</div>';
    }

    if ($drawing_id !== null) {
        // Next drawing, or back to project description after the last one
        $next_drawing_id = $drawing_id + 1;
        if ($next_drawing_id < count($drawings)) {
            $next_drawing = $drawings[$next_drawing_id];
            $next_url = '/projects/' . $project_slug . '/drawing/' . garth_slugify($next_drawing['title']);
            $next_label = 'Next Drawing: ' . htmlspecialchars($next_drawing['title']);
        } else {
            $next_url = '/projects/' . $project_slug;
            $next_label = 'Back to ' . htmlspecialchars($project_shortname) . ' Description';
        }
    } elseif (count($drawings) > 0) {
        // First drawing
        $first_drawing = $drawings[0];
        $next_url = '/projects/' . $project_slug . '/drawing/' . garth_slugify($first_drawing['title']);
        $next_label = 'First Drawing: ' . htmlspecialchars($first_drawing['title']);
    }

    if (isset($next_url)) {
    ?>
    <p class="next-project"><a href="<?= $next_url ?>"><?= $next_label ?> &rarr;</a></p>
    <?php } ?>
  </main>

</div>

<?php include './includes/footer.php'; ?>
