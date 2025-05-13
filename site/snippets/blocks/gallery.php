<?php
/** @var \Kirby\Cms\Block $block */
$columns = $block->columns()->or('3');
?>

<figure class="block-gallery columns-<?= $columns ?> <?= $block->blockClass()->html() ?>"<?= $block->blockId()->isNotEmpty() ? ' id="' . $block->blockId()->html() . '"' : '' ?>>
  <div class="gallery-grid">
    <?php foreach ($block->images()->toFiles() as $image): ?>
    <a href="<?= $image->url() ?>" class="gallery-item">
      <img src="<?= $image->crop(600, 600)->url() ?>" 
           alt="<?= $image->alt()->escape() ?>"
           loading="lazy">
    </a>
    <?php endforeach ?>
  </div>

  <?php if ($block->caption()->isNotEmpty()): ?>
  <figcaption class="gallery-caption">
    <?= $block->caption()->kt() ?>
  </figcaption>
  <?php endif ?>
</figure>
