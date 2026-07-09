<?php
require_once __DIR__ . '/includes/functions.php';

$item = isset($_GET['id']) ? news_by_id((int)$_GET['id']) : null;
$pageTitle = $item ? $item['title'] : 'Nieuws';
require __DIR__ . '/includes/header.php';
?>

<?php if ($item): ?>

<section class="page-hero">
    <div class="container">
        <p class="kicker"><a href="nieuws.php">Nieuws</a> &middot; <?= e($item['date']) ?></p>
        <h1 class="display-xl"><?= e($item['title']) ?></h1>
    </div>
</section>

<section class="section">
    <div class="container split">
        <div class="split-label reveal">
            <p class="kicker"><?= e($item['date']) ?></p>
        </div>
        <div class="split-body reveal">
            <?php if ($item['image']): ?>
                <figure class="news-figure">
                    <img src="<?= e($item['image']) ?>" alt="">
                </figure>
            <?php endif; ?>
            <div class="rich-text">
                <?= $item['body'] ?>
            </div>
            <?php if ($item['attachments']): ?>
                <h3 class="attachment-head">Bijlagen</h3>
                <ul class="attachment-list">
                    <?php foreach ($item['attachments'] as $att): ?>
                        <li><a class="link-arrow" href="<?= e($att['file']) ?>" target="_blank" rel="noopener"><?= e($att['label']) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <p class="back-link"><a class="link-arrow" href="nieuws.php">Terug naar al het nieuws</a></p>
        </div>
    </div>
</section>

<?php else: ?>

<section class="page-hero">
    <div class="container">
        <p class="kicker">Actueel</p>
        <h1 class="display-xl">Nieuws</h1>
        <p class="lead">Berichten en publicaties van Studio Vendrig.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="news-grid">
            <?php foreach (news_items() as $n): ?>
            <a class="news-card reveal" href="nieuws.php?id=<?= $n['id'] ?>">
                <div class="news-card-img">
                    <img src="<?= e($n['image']) ?>" alt="" loading="lazy">
                </div>
                <div class="news-card-body">
                    <span class="news-date"><?= e($n['date']) ?></span>
                    <h3><?= e($n['title']) ?></h3>
                    <p><?= e($n['summary']) ?></p>
                    <span class="link-arrow">Lees meer</span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php endif; ?>

<?php require __DIR__ . '/includes/footer.php'; ?>
