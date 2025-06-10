<?php
/** @var \Kirby\Cms\Block $block */
$images = $block->images()->toFiles();
$imageCount = $images->count();
?>

<?php if ($imageCount > 0): ?>
<div class="block-scroll-slider <?= $block->blockClass()->html() ?>"<?= $block->blockId()->isNotEmpty() ? ' id="' . $block->blockId()->html() . '"' : '' ?>>
  <div class="scroll-slider-container">
    <div class="scroll-slider-content">
      <?php foreach ($images as $image): ?>
      <div class="scroll-slider-item">
        <img src="<?= $image->url() ?>" 
             alt="<?= $image->alt()->escape() ?>"
             loading="lazy">
      </div>
      <?php endforeach ?>
    </div>
  </div>

  <?php if ($block->caption()->isNotEmpty()): ?>
  <figcaption class="scroll-slider-caption">
    <?= $block->caption()->kt() ?>
  </figcaption>
  <?php endif ?>
</div>
<?php endif ?> 