<?php
/*
  Snippets are a great way to store code snippets for reuse
  or to keep your templates clean.

  Block snippets control the HTML for individual blocks
  in the blocks field. This video snippet overwrites
  Kirby's default video block to add custom classes
  and style attributes.

  More about snippets:
  https://getkirby.com/docs/guide/templates/snippets
*/
?>
<?php
$url = $block->url();
$caption = $block->caption();
$autoplay = $block->autoplay()->isTrue();
$controls = $block->controls()->isTrue();
?>

<figure class="block-video <?= $block->blockClass()->html() ?>"<?= $block->blockId()->isNotEmpty() ? ' id="' . $block->blockId()->html() . '"' : '' ?>>
  <?php if ($url->isNotEmpty()): ?>
  <div class="video-container">
    <?php 
    if (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) {
        echo kirby()->kirbytags('(video: ' . $url . ' autoplay: ' . ($autoplay ? 'true' : 'false') . ' controls: ' . ($controls ? 'true' : 'false') . ')');
    } elseif (strpos($url, 'vimeo.com') !== false) {
        echo kirby()->kirbytags('(video: ' . $url . ' autoplay: ' . ($autoplay ? 'true' : 'false') . ' controls: ' . ($controls ? 'true' : 'false') . ')');
    }
    ?>
  </div>
  <?php endif ?>

  <?php if ($caption->isNotEmpty()): ?>
  <figcaption class="video-caption">
    <?= $caption->kt() ?>
  </figcaption>
  <?php endif ?>
</figure>
