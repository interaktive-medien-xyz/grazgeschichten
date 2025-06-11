<?php
/**
 * iframe Block Snippet
 */
?>

<div class="block-iframe<?= $block->blockClass()->isNotEmpty() ? ' ' . $block->blockClass() : '' ?>"<?= $block->blockId()->isNotEmpty() ? ' id="' . $block->blockId() . '"' : '' ?>>
  <iframe
    src="<?= $block->url() ?>"
    height="<?= $block->height()->or(400) ?>"
    frameborder="0"
    allow="<?= $block->allow() ?>"
    allowfullscreen
    loading="lazy"
  ></iframe>
</div>

<style>
.block-iframe {
  position: relative;
  width: 100%;
  height: 0;
  padding-bottom: calc(100% / (<?php
    switch($block->ratio()->or('16/9')):
      case '4/3': echo '4/3'; break;
      case '1/1': echo '1/1'; break;
      default: echo '16/9';
    endswitch;
  ?>));
}

.block-iframe iframe {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border: 0;
}</style> 