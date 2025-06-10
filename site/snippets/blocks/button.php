<?php
$target = $block->target()->isNotEmpty() ? '#' . $block->target()->html() : '';
$offset = $block->scrollOffset()->or(0);
$behavior = $block->scrollBehavior()->or('smooth');
?>

<button 
  class="block-button <?= $block->blockClass()->html() ?>"
  <?= $block->blockId()->isNotEmpty() ? ' id="' . $block->blockId()->html() . '"' : '' ?>
  <?= $target ? ' data-scroll-target="' . $target . '"' : '' ?>
  <?= $target ? ' data-scroll-offset="' . $offset . '"' : '' ?>
  <?= $target ? ' data-scroll-behavior="' . $behavior . '"' : '' ?>
  <?= $target ? ' type="button"' : ' type="submit"' ?>
>
  <?= $block->text()->html() ?>
</button>

<?php if ($target): ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const buttons = document.querySelectorAll('[data-scroll-target]');
  
  buttons.forEach(button => {
    button.addEventListener('click', function(e) {
      e.preventDefault();
      
      const target = this.dataset.scrollTarget;
      const offset = parseInt(this.dataset.scrollOffset) || 0;
      const behavior = this.dataset.scrollBehavior || 'smooth';
      
      const targetElement = document.querySelector(target);
      if (targetElement) {
        const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - offset;
        
        window.scrollTo({
          top: targetPosition,
          behavior: behavior
        });
      }
    });
  });
});
</script>

<style>
.block-button {
  display: inline-block;
  padding: 0.75rem 1.5rem;
  background: #000;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 1rem;
  font-weight: 500;
  text-decoration: none;
  transition: background-color 0.3s ease;
}

.block-button:hover {
  background: #333;
}

.block-button:focus {
  outline: none;
  box-shadow: 0 0 0 3px rgba(0,0,0,0.2);
}
</style>
<?php endif ?> 