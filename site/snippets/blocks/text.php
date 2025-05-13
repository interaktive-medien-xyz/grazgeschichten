<div class="block-text <?= $block->blockClass()->html() ?>"<?= $block->blockId()->isNotEmpty() ? ' id="' . $block->blockId()->html() . '"' : '' ?>>
  <?= $block->text()->kt() ?>
</div> 