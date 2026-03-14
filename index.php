<?php
require_once './includes/data.php';
$projects = garth_load_projects();

include './includes/header.php';
?>
  <title>Garth Wilson's Project Pages</title>
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
        <?php foreach ($projects as $i => $row): ?>
          <li><a href="/projects/<?= garth_slugify($row['name']) ?>"><?= htmlspecialchars($row['name']) ?></a></li>
        <?php endforeach; ?>
      </ul>
    </nav>

    <?php include './includes/sidebar_wilson_mines.php'; ?>
  </aside>

  <main class="main-content">
    <h2>Introduction</h2>
    <p class="intro-text">
      Here are some pictures of the workbench computer I've mentioned several
      times on the forum, along with other computer projects (some completed, some
      not), home-made modules for the next workbench computer, and the two
      hand-held HP computers that have been sources of inspiration.
    </p>

    <div class="project-grid">
      <?php foreach ($projects as $i => $row): ?>
        <div class="project-card">
          <a href="/projects/<?= garth_slugify($row['name']) ?>">
            <img src="/projects/<?= garth_slugify($row['name']) ?>/thumbnail.jpg"
                 alt="<?= htmlspecialchars($row['name']) ?>">
            <div class="card-body">
              <h3><?= htmlspecialchars($row['name']) ?></h3>
              <p><?= htmlspecialchars($row['description']) ?></p>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </main>

</div>

<?php include './includes/footer.php'; ?>
