<?php
/*
  Templates render the content of your pages.

  They contain the markup together with some control structures
  like loops or if-statements. The `$page` variable always
  refers to the currently active page.

  To fetch the content from each field we call the field name as a
  method on the `$page` object, e.g. `$page->title()`.

  This home template renders content from others pages, the children of
  the `photography` page to display a nice gallery grid.

  Snippets like the header and footer contain markup used in
  multiple templates. They also help to keep templates clean.

  More about templates: https://getkirby.com/docs/guide/templates/basics
*/

// Lade alle veröffentlichten Notes
$notes = page('notes')->children()->listed()->sortBy('date', 'desc');
?>

<?php snippet('header') ?> 

<div class="home-hero">
  <h1>GRAZGESCHICHTEN</h1>
</div>

<section class="home-info">
  <div class="home-about">
    <h2>Hier sollte was anderes stehen</h2> 
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias mollitia illo consequuntur veniam eum nobis itaque nesciunt assumenda totam culpa. Asperiores libero dolores, omnis praesentium cupiditate in voluptas eius at, placeat sequi repellendus officia saepe laboriosam esse expedita corporis animi atque! Dignissimos omnis dolore accusantium vitae blanditiis deleniti necessitatibus excepturi, adipisci officia ipsum animi explicabo doloribus sint illum atque odit praesentium voluptates ad molestiae, laboriosam sed? Odio magnam blanditiis saepe accusantium, sit repellat libero assumenda hic maiores? Similique quaerat, labore laudantium minus iusto velit vel, corporis eum quibusdam repellat sed soluta ab explicabo. Error non, nesciunt vero similique velit animi.</p>
  </div>
  <div class="home-daten">
  <h2>Hier sollte was anderes stehen</h2>
  <p>47° 4' 0.12 N 15° 25' 59.88 E <br>
  RESIDENTS: 302.479 <br>
  ALTITUDE: 353m</p>
  </div>
</section>


<!-- GESCHICHTEN GRID -->

<h1 class="home-subhead">Die Stories</h1>

<main class="home">
  <div class="notes-grid">
    <?php foreach ($notes as $note): ?>
      <article class="note-card">
        <a href="<?= $note->url() ?>" class="note-link">
          <div class="note-content">
            <h2 class="note-title"><?= $note->title()->html() ?></h2>
            <?php if ($cover = $note->cover()): ?>
              <figure class="note-cover">
                <img src="<?= $cover->url() ?>" 
                     alt="<?= $note->title()->html() ?>"
                     loading="lazy">
              </figure>
            <?php endif ?>
          </div>
        </a>
      </article>
    <?php endforeach ?>
  </div>
</main>

<?php snippet('footer') ?>
