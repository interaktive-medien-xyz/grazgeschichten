<?php
$items = $block->items()->toStructure();
?>

<div class="block-accordion <?= $block->blockClass()->html() ?>"<?= $block->blockId()->isNotEmpty() ? ' id="' . $block->blockId()->html() . '"' : '' ?>>
  <?php foreach ($items as $item): ?>
    <div class="accordion-item">
      <button class="accordion-header" aria-expanded="false">
        <?= $item->title()->html() ?>
        <span class="accordion-icon"></span>
      </button>
      <div class="accordion-content">
        <?php if ($image = $item->image()->toFile()): ?>
          <figure class="accordion-image">
            <img src="<?= $image->url() ?>" 
                 alt="<?= $image->alt()->or($item->title())->escape() ?>"
                 loading="lazy">
          </figure>
        <?php endif ?>
        <div class="accordion-text">
          <?= $item->text()->kt() ?>
        </div>
      </div>
    </div>
  <?php endforeach ?>
</div>

<?php if (!isset($accordionScriptLoaded)): ?>
<script>
// Prevent multiple script execution
if (!window.accordionInitialized) {
  window.accordionInitialized = true;
  
  document.addEventListener('DOMContentLoaded', function() {
    const accordions = document.querySelectorAll('.block-accordion');
    
    accordions.forEach(accordion => {
      const headers = accordion.querySelectorAll('.accordion-header');
      
      headers.forEach(header => {
        // Remove any existing event listeners to prevent duplicates
        header.removeEventListener('click', handleAccordionClick);
        header.addEventListener('click', handleAccordionClick);
      });
    });
    
    function handleAccordionClick() {
      const isExpanded = this.getAttribute('aria-expanded') === 'true';
      const content = this.nextElementSibling;
      
      // Toggle current item
      this.setAttribute('aria-expanded', !isExpanded);
      content.style.maxHeight = isExpanded ? null : content.scrollHeight + 'px';
      
      // Optional: Close other items in the same accordion
      // const parentAccordion = this.closest('.block-accordion');
      // const otherHeaders = parentAccordion.querySelectorAll('.accordion-header');
      // otherHeaders.forEach(otherHeader => {
      //   if (otherHeader !== this) {
      //     otherHeader.setAttribute('aria-expanded', 'false');
      //     otherHeader.nextElementSibling.style.maxHeight = null;
      //   }
      // });
    }
  });
}
</script>
<?php 
  $accordionScriptLoaded = true;
endif; 
?>

<style>
.block-accordion {
  width: 100%;
}

.accordion-item {
  border: 1px solid #ddd;
  margin-bottom: 0.5rem;
  border-radius: 4px;
}

.accordion-header {
  width: 100%;
  padding: 1rem;
  background: #f5f5f5;
  border: none;
  text-align: left;
  cursor: pointer;
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-weight: bold;
}

.accordion-icon {
  position: relative;
  width: 20px;
  height: 20px;
}

.accordion-icon::before,
.accordion-icon::after {
  content: '';
  position: absolute;
  background-color: currentColor;
  transition: transform 0.3s ease;
}

.accordion-icon::before {
  top: 50%;
  left: 0;
  width: 100%;
  height: 2px;
  transform: translateY(-50%);
}

.accordion-icon::after {
  top: 0;
  left: 50%;
  width: 2px;
  height: 100%;
  transform: translateX(-50%);
}

.accordion-header[aria-expanded="true"] .accordion-icon::after {
  transform: translateX(-50%) rotate(90deg);
}

.accordion-content {
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.3s ease;
  padding: 0 1rem;
}

.accordion-content > * {
  padding: 1rem 0;
}

.accordion-image {
  margin: 0;
  padding: 1rem 0;
}

.accordion-image img {
  max-width: 100%;
  height: auto;
  display: block;
}

.accordion-text {
  padding-bottom: 1rem;
}
</style> 