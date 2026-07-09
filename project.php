<?php
require_once __DIR__ . '/includes/functions.php';

$project = project_by_id((int)($_GET['id'] ?? 0));
if (!$project) {
    http_response_code(404);
    $pageTitle = 'Project niet gevonden';
    require __DIR__ . '/includes/header.php';
    echo '<section class="page-hero"><div class="container"><h1 class="display-xl">Project niet gevonden</h1>'
       . '<p class="lead"><a class="link-arrow" href="projecten.php">Terug naar alle projecten</a></p></div></section>';
    require __DIR__ . '/includes/footer.php';
    exit;
}

$pageTitle = $project['title'];

// Vorig/volgend project binnen de volledige lijst
$all = projects();
$idx = array_search($project['id'], array_column($all, 'id'), true);
$prev = $all[$idx - 1] ?? null;
$next = $all[$idx + 1] ?? null;

require __DIR__ . '/includes/header.php';
?>

<section class="page-hero">
    <div class="container">
        <p class="kicker"><a href="projecten.php?cat=<?= urlencode($project['category']) ?>"><?= e($project['category']) ?></a></p>
        <h1 class="display-xl"><?= e($project['title']) ?></h1>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="gallery reveal">
            <?php foreach ($project['images'] as $i => $img): ?>
                <figure class="gallery-item<?= $i === 0 ? ' gallery-item-lead' : '' ?>">
                    <img src="<?= e($img['file']) ?>" alt="<?= e($img['name']) ?>"
                         data-caption="<?= e($img['name']) ?>" <?= $i > 0 ? 'loading="lazy"' : '' ?>>
                    <figcaption><?= e($img['name']) ?></figcaption>
                </figure>
            <?php endforeach; ?>
        </div>

        <?php if ($project['description'] !== ''): ?>
        <div class="split project-info">
            <div class="split-label reveal">
                <p class="kicker">Projectinfo</p>
            </div>
            <div class="split-body reveal">
                <div class="rich-text">
                    <?= $project['description'] ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <nav class="project-pager reveal" aria-label="Meer projecten">
            <?php if ($prev): ?>
                <a class="pager-prev" href="project.php?id=<?= $prev['id'] ?>"><span>&larr; Vorige</span><?= e($prev['title']) ?></a>
            <?php else: ?><span></span><?php endif; ?>
            <a class="pager-all" href="projecten.php">Alle projecten</a>
            <?php if ($next): ?>
                <a class="pager-next" href="project.php?id=<?= $next['id'] ?>"><span>Volgende &rarr;</span><?= e($next['title']) ?></a>
            <?php else: ?><span></span><?php endif; ?>
        </nav>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
