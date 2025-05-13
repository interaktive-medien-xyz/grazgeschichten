<blockquote class="block-quote <?= $block->blockClass()->html() ?>"<?= $block->blockId()->isNotEmpty() ? ' id="' . $block->blockId()->html() . '"' : '' ?>>
  <?= $block->text()->kt() ?>
  <?php if($block->citation()->isNotEmpty()): ?>
    <footer>
      <cite><?= $block->citation()->html() ?></cite>
    </footer>
  <?php endif ?>
</blockquote> 