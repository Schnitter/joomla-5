<?php
defined('_JEXEC') or die;
$images = array_filter(array_map('trim', explode("\n", $params->get('images'))));
$interval = (int) $params->get('interval', 5000);
$carouselId = 'carousel-' . uniqid();
?>
<div id="<?php echo $carouselId; ?>" class="carousel slide" data-bs-ride="carousel" data-bs-interval="<?php echo $interval; ?>">
    <div class="carousel-indicators">
        <?php foreach ($images as $i => $url): ?>
            <button type="button" data-bs-target="#<?php echo $carouselId; ?>" data-bs-slide-to="<?php echo $i; ?>" <?php echo $i === 0 ? 'class="active" aria-current="true"' : ''; ?> aria-label="Slide <?php echo $i+1; ?>"></button>
        <?php endforeach; ?>
    </div>
    <div class="carousel-inner">
        <?php foreach ($images as $i => $url): ?>
            <div class="carousel-item <?php echo $i === 0 ? 'active' : ''; ?>">
                <img src="<?php echo htmlspecialchars($url, ENT_QUOTES); ?>" class="d-block w-100" alt="Slide <?php echo $i+1; ?>">
            </div>
        <?php endforeach; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#<?php echo $carouselId; ?>" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Vorherige</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#<?php echo $carouselId; ?>" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Nächste</span>
    </button>
</div>
