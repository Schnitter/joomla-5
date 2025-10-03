<?php defined('_JEXEC') or die;
$container = $params->get('container_type', 'container');
$showDesktop = $params->get('show_desktop', 1);
$showTablet = $params->get('show_tablet', 0);
$showMobile = $params->get('show_mobile', 0);

$displayClass = 'd-none ';
if ($showDesktop) $displayClass .= 'd-lg-block ';
if ($showTablet)  $displayClass .= 'd-md-block ';
if ($showMobile)  $displayClass .= 'd-block ';

$cards = $params->get('cards', []);
?>

<?php if ($container !== 'none') : ?>
<div class="<?= $container ?> py-5 <?= $displayClass ?>">
<?php else : ?>
<div class="py-5 <?= $displayClass ?>">
<?php endif; ?>
  <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 justify-content-center g-4">
    <?php foreach ($cards as $card): ?>
    <div class="col">
      <div class="card h-100 text-center shadow-sm">
        <img src="<?= htmlspecialchars($card->image) ?>" class="card-img-top" alt="<?= JText::_($card->title) ?>">
        <div class="card-body">
          <h5 class="card-title"><?= JText::_($card->title) ?></h5>
          <p class="card-text"><?= JText::_($card->text) ?></p>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>