<?php
defined('_JEXEC') or die;

$bgimage        = $params->get('bgimage');
$height         = $params->get('height', '400px');
$container      = $params->get('container', 'container');
$content        = $params->get('content');
$bootstrapcheck = $params->get('bootstrapcheck', 'console'); // neu
?>
<div class="mod-jumbotron d-flex align-items-center"
     style="background: url('<?php echo $bgimage; ?>') center/cover no-repeat; height: <?php echo htmlspecialchars($height, ENT_QUOTES, 'UTF-8'); ?>;">
    <div class="<?php echo $container; ?> text-center text-white">
        <?php echo $content; ?>
    </div>
</div>

<?php if ($bootstrapcheck !== 'none') : ?>
<script>
document.addEventListener("DOMContentLoaded", function () {
    let bootstrapLoaded = false;

    if (window.bootstrap !== undefined) {
        bootstrapLoaded = true;
    } else {
        for (let sheet of document.styleSheets) {
            if (sheet.href && sheet.href.includes("bootstrap")) {
                bootstrapLoaded = true;
                break;
            }
        }
    }

    if (!bootstrapLoaded) {
        <?php if ($bootstrapcheck === 'alert') : ?>
            alert("⚠️ Achtung: Bootstrap ist nicht geladen! Das Jumbotron-Modul benötigt Bootstrap CSS.");
        <?php else : ?>
            console.warn("⚠️ Bootstrap ist nicht geladen! Das Jumbotron-Modul benötigt Bootstrap CSS.");
        <?php endif; ?>
    }
});
</script>
<?php endif; ?>
