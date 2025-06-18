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
$loop = $block->loop()->isTrue();
$controls = $block->controls()->isTrue();
?>

<figure class="block-video <?= $block->blockClass()->html() ?>"<?= $block->blockId()->isNotEmpty() ? ' id="' . $block->blockId()->html() . '"' : '' ?>>
  <?php if ($url->isNotEmpty()): ?>
  <div class="video-container">
    <?php 
    if (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) {
        // Extract YouTube video ID
        $videoId = null;
        if (preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $url, $matches)) {
            $videoId = $matches[1];
        } elseif (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            $videoId = $matches[1];
        }
        
        if ($videoId) {
            // Build YouTube embed URL with parameters
            $embedUrl = 'https://www.youtube.com/embed/' . $videoId;
            $params = [];
            
            if ($autoplay) {
                $params[] = 'autoplay=1';
                $params[] = 'mute=1'; // Required for autoplay
            }
            
            if ($loop) {
                $params[] = 'loop=1';
                $params[] = 'playlist=' . $videoId; // Required for loop to work
                $params[] = 'rel=0'; // Hide related videos
            }
            
            if (!$controls) {
                $params[] = 'controls=0';
            }
            
            if (!empty($params)) {
                $embedUrl .= '?' . implode('&', $params);
            }
            
            // Generate iframe with proper allow attribute
            $allowAttr = $autoplay ? 'autoplay; encrypted-media; picture-in-picture' : 'encrypted-media; picture-in-picture';
            echo '<iframe src="' . $embedUrl . '" allow="' . $allowAttr . '" allowfullscreen></iframe>';
        }
    } elseif (strpos($url, 'vimeo.com') !== false) {
        // Extract Vimeo video ID
        $videoId = null;
        if (preg_match('/vimeo\.com\/([0-9]+)/', $url, $matches)) {
            $videoId = $matches[1];
        }
        
        if ($videoId) {
            // Build Vimeo embed URL with parameters
            $embedUrl = 'https://player.vimeo.com/video/' . $videoId;
            $params = [];
            
            if ($autoplay) {
                $params[] = 'autoplay=1';
                $params[] = 'muted=1'; // Required for autoplay
            }
            
            if ($loop) {
                $params[] = 'loop=1';
            }
            
            if (!$controls) {
                $params[] = 'controls=0';
            }
            
            if (!empty($params)) {
                $embedUrl .= '?' . implode('&', $params);
            }
            
            // Generate iframe with proper allow attribute
            $allowAttr = $autoplay ? 'autoplay; fullscreen; picture-in-picture' : 'fullscreen; picture-in-picture';
            echo '<iframe src="' . $embedUrl . '" allow="' . $allowAttr . '" allowfullscreen></iframe>';
        }
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
