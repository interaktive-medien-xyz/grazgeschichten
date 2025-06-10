<?php if ($block->audio()->isNotEmpty()): ?>
  <?php $audio = $block->audio()->toFile(); ?>
  <?php if ($audio): ?>
    <figure class="audio-block <?= $block->blockClass()->html() ?>"<?= $block->blockId()->isNotEmpty() ? ' id="' . $block->blockId()->html() . '"' : '' ?>>
      <audio class="note-audio" controls>
        <source src="<?= $audio->url() ?>" type="<?= $audio->mime() ?>">
        Your browser does not support the audio element.
      </audio>
      <?php if ($block->caption()->isNotEmpty()): ?>
        <figcaption><?= $block->caption()->esc() ?></figcaption>
      <?php endif ?>
    </figure>
  <?php endif ?>
<?php endif ?>