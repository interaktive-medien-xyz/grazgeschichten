<?php
/*
  Templates render the content of your pages.

  They contain the markup together with some control structures
  like loops or if-statements. The `$page` variable always
  refers to the currently active page.

  To fetch the content from each field we call the field name as a
  method on the `$page` object, e.g. `$page->title()`.

  This note template renders a blog article. It uses the `$page->cover()`
  method from the `note.php` page model (/site/models/page.php)

  It also receives the `$tag` variable from its controller
  (/site/controllers/note.php) if a tag filter is activated.

  Snippets like the header and footer contain markup used in
  multiple templates. They also help to keep templates clean.

  More about templates: https://getkirby.com/docs/guide/templates/basics
*/
?>
<?php snippet('header') ?>

<div class="spacer"></div>

<h1 class="note-title"><?= $page->title()->esc() ?></h1>
<?php if ($page->subheading()->isNotEmpty()): ?>
  <p class="note-subheading"><small><?= $page->subheading()->esc() ?></small></p>
<?php endif ?>

<?php if ($cover = $page->cover()): ?>
  <?php 
  // Check if the cover image is a GIF
  $isGif = strtolower($cover->extension()) === 'gif';
  ?>
  <a href="<?= $cover->url() ?>" data-lightbox class="img hero" style="--w:2; --h:1">
    <?php if ($isGif): ?>
      <!-- For GIFs, use the original file to preserve animation -->
      <img src="<?= $cover->url() ?>" alt="<?= $cover->alt()->esc() ?>">
    <?php else: ?>
      <!-- For static images, use the cropped version -->
      <img src="<?= $cover->crop(1200, 600)->url() ?>" alt="<?= $cover->alt()->esc() ?>">
    <?php endif ?>
  </a>
<?php endif ?>

<article class="note">

<?php /*
  <header class="note-header h1">

    <?php if ($page->author()->isNotEmpty()): ?>
    <?php $authors = $page->author()->toUsers(); ?>
    <?php if ($authors->count()): ?>
        <p class="note-author">
            <small class="author">Von 
            <?= implode(', ', $authors->pluck('name')) ?>
            </small>
        </p>
    <?php endif ?>
<?php endif ?>

*/ ?>

  </header>
  
  <div class="note text">
    <?php foreach ($page->layouts() as $layout): ?>
      <div class="layout layout--<?= $layout->type() ?>">
        <div class="columns columns--<?= $layout->columns()->count() ?>">
          <?php foreach ($layout->columns() as $column): ?>
            <div class="column column--<?= $column->span() ?>">
              <?php foreach ($column->blocks() as $block): ?>
                <?= $block ?>
              <?php endforeach ?>
            </div>
          <?php endforeach ?>
        </div>
      </div>
    <?php endforeach ?>
  </div>
  <footer class="note-footer">
    <?php if (!empty($tags)): ?>
      <ul class="note-tags">
        <?php foreach ($tags as $tag): ?>
          <li>
            <a href="<?= $page->parent()->url(['params' => ['tag' => $tag]]) ?>"><?= esc($tag) ?></a>
          </li>
        <?php endforeach ?>
      </ul>
    <?php endif ?>

    <time class="note-date" datetime="<?= $page->date()->toDate('c') ?>">Published on <?= $page->date()->esc() ?></time>
  </footer>

  <?php snippet('prevnext') ?>
</article>

<?php snippet('footer') ?>