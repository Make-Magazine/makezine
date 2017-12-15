<?php
/**
 * @var string $language
 * @var string $head
 */
?><!DOCTYPE html>
<html lang="<?php print $language; ?>">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <?php print $head; ?>
</head>
<body class="contextly-overlay">
<script type="text/javascript">
  Contextly.ready('load', <?php print $this->kit->exportJsVar('overlay-dialogs/' . $type); ?>, function() {
    jQuery(function() {
      Contextly.overlayDialog.Controller.render(<?php print $this->kit->exportJsVar($type); ?>);
    });
  });
</script>
</body>
</html>
