<?php
/** @var \Kirby\Cms\Block $block */
$images = $block->images()->toFiles();
$imageCount = $images->count();
?>

<?php if ($imageCount > 0): ?>
<div class="block-image-slider <?= $block->blockClass()->html() ?>"<?= $block->blockId()->isNotEmpty() ? ' id="' . $block->blockId()->html() . '"' : '' ?>>
  <div class="image-slider">
    <div class="image-slider-container">
      <?php foreach ($images as $index => $image): ?>
      <div class="image-slide <?= $index === 0 ? 'active' : '' ?>" data-slide="<?= $index ?>">
        <img src="<?= $image->url() ?>" 
             alt="<?= $image->alt()->escape() ?>"
             loading="<?= $index === 0 ? 'eager' : 'lazy' ?>">
      </div>
      <?php endforeach ?>
    </div>
    
    <?php if ($imageCount > 1): ?>
    <div class="image-slider-nav">
      <button class="image-slider-prev" aria-label="Previous image">‹</button>
      <button class="image-slider-next" aria-label="Next image">›</button>
    </div>
    
    <div class="image-slider-dots">
      <?php for ($i = 0; $i < $imageCount; $i++): ?>
      <button class="image-slider-dot <?= $i === 0 ? 'active' : '' ?>" 
              data-slide="<?= $i ?>" 
              aria-label="Go to image <?= $i + 1 ?>"></button>
      <?php endfor ?>
    </div>
    <?php endif ?>
  </div>

  <?php if ($block->caption()->isNotEmpty()): ?>
  <figcaption class="image-slider-caption">
    <?= $block->caption()->kt() ?>
  </figcaption>
  <?php endif ?>
</div>

<?php if (!isset($imageSliderScriptLoaded)): ?>
<script>
// Prevent multiple script execution
if (!window.imageSliderInitialized) {
  window.imageSliderInitialized = true;
  
  document.addEventListener('DOMContentLoaded', function() {
    const sliders = document.querySelectorAll('.block-image-slider');
    
    sliders.forEach(function(slider) {
      const container = slider.querySelector('.image-slider-container');
      const slides = slider.querySelectorAll('.image-slide');
      const prevBtn = slider.querySelector('.image-slider-prev');
      const nextBtn = slider.querySelector('.image-slider-next');
      const dots = slider.querySelectorAll('.image-slider-dot');
      
      let currentSlide = 0;
      const totalSlides = slides.length;
      
      function showSlide(index) {
        // Hide all slides
        slides.forEach(slide => {
          slide.classList.remove('active');
          slide.style.visibility = 'hidden';
          slide.style.opacity = '0';
        });
        dots.forEach(dot => dot.classList.remove('active'));
        
        // Show current slide
        slides[index].classList.add('active');
        slides[index].style.visibility = 'visible';
        slides[index].style.opacity = '1';
        dots[index].classList.add('active');
        
        currentSlide = index;
      }
      
      function nextSlide() {
        const next = (currentSlide + 1) % totalSlides;
        showSlide(next);
      }
      
      function prevSlide() {
        const prev = (currentSlide - 1 + totalSlides) % totalSlides;
        showSlide(prev);
      }
      
      // Initialize first slide immediately
      if (slides.length > 0) {
        showSlide(0);
      }
      
      // Event listeners
      if (nextBtn) nextBtn.addEventListener('click', nextSlide);
      if (prevBtn) prevBtn.addEventListener('click', prevSlide);
      
      dots.forEach(function(dot, index) {
        dot.addEventListener('click', function() {
          showSlide(index);
        });
      });
    });
  });
}
</script>
<?php 
  $imageSliderScriptLoaded = true;
endif; 
?>
<?php endif ?> 