<?php
/** @var \Kirby\Cms\Block $block */
$columns = $block->columns()->or('3');
$galleryItems = $block->gallery_items()->toStructure();
?>

<figure class="block-gallery columns-<?= $columns ?> <?= $block->blockClass()->html() ?>"<?= $block->blockId()->isNotEmpty() ? ' id="' . $block->blockId()->html() . '"' : '' ?>>
  <div class="gallery-grid">
    <?php foreach ($galleryItems as $item): ?>
      <?php if ($image = $item->image()->toFile()): ?>
      <div class="gallery-item-wrapper">
        <a href="<?= $image->url() ?>" class="gallery-item">
          <img src="<?= $image->crop(600, 600)->url() ?>" 
               alt="<?= $image->alt()->escape() ?>"
               loading="lazy">
        </a>
        <?php if ($item->caption()->isNotEmpty()): ?>
        <figcaption class="gallery-item-caption">
          <?= $item->caption()->kt() ?>
        </figcaption>
        <?php endif ?>
      </div>
      <?php endif ?>
    <?php endforeach ?>
  </div>
</figure>
