<?php
/**
 * SVG Map Block Snippet
 */

// Get the SVG file
$svg = $block->svg()->toFile();
if (!$svg) return;

// Define size classes
$sizeClass = match($block->size()->or('medium')) {
  'small' => 'map-small',
  'large' => 'map-large',
  'full' => 'map-full',
  default => 'map-medium'
};

// Combine all classes
$classes = ['block-map', $sizeClass];
if ($block->blockClass()->isNotEmpty()) {
  $classes[] = $block->blockClass()->value();
}
if ($block->interactive()->isTrue()) {
  $classes[] = 'is-interactive';
}
if ($block->zoom()->isTrue()) {
  $classes[] = 'is-zoomable';
}
?>

<figure class="<?= implode(' ', $classes) ?>"<?= $block->blockId()->isNotEmpty() ? ' id="' . $block->blockId() . '"' : '' ?>>
  <?php if ($block->title()->isNotEmpty()): ?>
  <h3 class="map-title"><?= $block->title() ?></h3>
  <?php endif ?>
  
  <div class="map-wrapper">
    <div class="map-container">
      <?php 
      // SVG mit Alt-Text einbinden
      $svgContent = $svg->read();
      // Füge role="img" und aria-label hinzu, wenn Alt-Text vorhanden ist
      if ($block->alt()->isNotEmpty()) {
        $svgContent = preg_replace('/<svg/', '<svg role="img" aria-label="' . esc($block->alt(), 'attr') . '"', $svgContent, 1);
      }
      echo $svgContent;
      ?>
    </div>
  </div>
  
  <?php if ($block->description()->isNotEmpty()): ?>
  <figcaption class="map-description">
    <?= $block->description()->kt() ?>
  </figcaption>
  <?php endif ?>
</figure>

<style>
.block-map {
  margin: 2rem auto;
  max-width: var(--content-width, 800px);
}

.block-map .map-title {
  margin-bottom: 1rem;
}

.block-map .map-wrapper {
  position: relative;
  width: 100%;
  height: 500px; /* Feste Höhe für den sichtbaren Bereich */
  overflow: auto; /* Scrollbar aktivieren */
  border: 1px solid #eee;
  border-radius: 4px;
  background: #f9f9f9;
}

.block-map .map-container {
  position: relative;
  min-width: 100%;
  min-height: 100%;
  cursor: grab;
}

.block-map .map-container:active {
  cursor: grabbing;
}

.block-map .map-container svg {
  width: auto;
  height: auto;
  max-width: none; /* Erlaubt der SVG ihre natürliche Größe zu behalten */
}

.block-map .map-description {
  margin-top: 1rem;
  font-size: 0.9em;
  color: #666;
}

/* Größenvarianten für den Wrapper */
.block-map.map-small .map-wrapper { height: 300px; }
.block-map.map-medium .map-wrapper { height: 500px; }
.block-map.map-large .map-wrapper { height: 700px; }
.block-map.map-full .map-wrapper { height: 800px; }

/* Interaktive Funktionen */
.block-map.is-interactive svg * {
  transition: all 0.2s ease;
}

.block-map.is-interactive svg [data-interactive]:hover {
  opacity: 0.8;
  cursor: pointer;
}

/* Zoom-Funktionalität */
.block-map.is-zoomable .map-container {
  transform-origin: 0 0;
}

/* Anpassung der Scrollbar */
.block-map .map-wrapper::-webkit-scrollbar {
  width: 8px;
  height: 8px;
}

.block-map .map-wrapper::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 4px;
}

.block-map .map-wrapper::-webkit-scrollbar-thumb {
  background: #888;
  border-radius: 4px;
}

.block-map .map-wrapper::-webkit-scrollbar-thumb:hover {
  background: #555;
}
</style>

<?php if ($block->interactive()->isTrue() || $block->zoom()->isTrue()): ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const map = document.querySelector('<?= $block->blockId()->isNotEmpty() ? "#" . $block->blockId() : ".block-map" ?>');
  const container = map.querySelector('.map-container');
  let isDragging = false;
  let startX, startY, scrollLeft, scrollTop;

  // Drag-Funktionalität
  container.addEventListener('mousedown', function(e) {
    isDragging = true;
    container.style.cursor = 'grabbing';
    
    startX = e.pageX - container.offsetLeft;
    startY = e.pageY - container.offsetTop;
    scrollLeft = container.parentElement.scrollLeft;
    scrollTop = container.parentElement.scrollTop;
  });

  container.addEventListener('mouseleave', function() {
    isDragging = false;
    container.style.cursor = 'grab';
  });

  container.addEventListener('mouseup', function() {
    isDragging = false;
    container.style.cursor = 'grab';
  });

  container.addEventListener('mousemove', function(e) {
    if (!isDragging) return;

    e.preventDefault();
    const x = e.pageX - container.offsetLeft;
    const y = e.pageY - container.offsetTop;
    const moveX = x - startX;
    const moveY = y - startY;

    container.parentElement.scrollLeft = scrollLeft - moveX;
    container.parentElement.scrollTop = scrollTop - moveY;
  });

  <?php if ($block->interactive()->isTrue()): ?>
  // Interaktive Elemente
  map.querySelectorAll('[data-interactive]').forEach(element => {
    element.addEventListener('click', function(e) {
      if (!isDragging) {
        const action = this.getAttribute('data-action');
        if (action) {
          console.log('Aktion ausgelöst:', action);
        }
      }
    });
  });
  <?php endif ?>
  
  <?php if ($block->zoom()->isTrue()): ?>
  // Zoom-Funktionalität mit Mausrad
  container.addEventListener('wheel', function(e) {
    e.preventDefault();
    
    const svg = container.querySelector('svg');
    const scale = svg.style.transform ? parseFloat(svg.style.transform.replace('scale(', '')) : 1;
    const delta = e.deltaY > 0 ? 0.9 : 1.1;
    const newScale = Math.min(Math.max(scale * delta, 0.5), 3);
    
    svg.style.transform = `scale(${newScale})`;
  });
  <?php endif ?>
});
</script>
<?php endif ?> 