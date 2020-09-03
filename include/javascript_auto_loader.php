<?php

function javascript_auto_loader($main_folder) {
  $content_list = scandir($main_folder);

  foreach ($content_list as $content) { if ($content !== '.' && $content !== '..') {
    if (is_dir($main_folder . DIRECTORY_SEPARATOR . $content) === TRUE) {
      javascript_auto_loader($main_folder . DIRECTORY_SEPARATOR . $content);
    }
    else {
      ?>
      <script type="text/javascript" src="<?= $main_folder . DIRECTORY_SEPARATOR . $content ?>"></script>
      <?php
    }
  }}
}


javascript_auto_loader('javascript');
