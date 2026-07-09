<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = 'Projecten';

$categories = array_keys(project_categories());
$activeCat  = isset($_GET['cat']) && in_array($_GET['cat'], $categories, true) ? $_GET['cat'] : null;
$list = $activeCat
    ? array_values(array_filter(projects(), fn($p) => $p['category'] === $activeCat))
    : projects();

require __DIR__ . '/includes/header.php';
?>

<section class="page-hero">
    <div class="container">
        <p class="kicker">Portfolio</p>
        <h1 class="display-xl">Projecten</h1>
        <p class="lead">Van woningbouw tot gezondheidszorg, van verbouw tot nieuwbouw. Laat u inspireren.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <nav class="filter-bar reveal" aria-label="Projectcategorie&euml;n">
            <a href="projecten.php" class="<?= $activeCat === null ? 'active' : '' ?>">Alle</a>
            <?php foreach ($categories as $cat): ?>
                <a href="projecten.php?cat=<?= urlencode($cat) ?>" class="<?= $activeCat === $cat ? 'active' : '' ?>"><?= e($cat) ?></a>
            <?php endforeach; ?>
        </nav>

        <div class="project-grid">
            <?php foreach ($list as $n => $p): if (!$p['images']) continue; ?>
            <a class="project-card reveal" href="project.php?id=<?= $p['id'] ?>">
                <div class="project-card-img">
                    <img src="<?= e($p['images'][0]['file']) ?>" alt="<?= e($p['title']) ?>" loading="lazy">
                </div>
                <div class="project-card-body">
                    <span class="project-card-cat"><?= e($p['category']) ?></span>
                    <h3><?= e($p['title']) ?></h3>
                    <span class="project-card-num">(<?= str_pad((string)($n + 1), 2, '0', STR_PAD_LEFT) ?>)</span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
