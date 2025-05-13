<?php 
$level = $block->level()->or('h2'); 
?>
<<?= $level ?> class="block-heading <?= $block->blockClass()->html() ?>"<?= $block->blockId()->isNotEmpty() ? ' id="' . $block->blockId()->html() . '"' : '' ?>>
  <?= $block->text()->html() ?>
</<?= $level ?>> 