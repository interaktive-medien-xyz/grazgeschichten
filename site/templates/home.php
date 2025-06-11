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
<?php
/*
<header class="home-header">
  <a href="<?= $site->url() ?>" class="logo">
  <h1 class="logo-graz">GRAZ</h1>
  <h1 class="logo-geschichten">GESCHICHTEN</h1>
  </a>

  <a class="about-link" href="">Über das Projekt</a>
</header>

*/
?>
<?php
/*
<header class="home-header">
  <a href="<?= $site->url() ?>" class="logo">
  <h1 class="logo-graz">GRAZ</h1>
  <h1 class="logo-geschichten">GESCHICHTEN</h1>
  </a>

  <a href="">Über das Projekt</a>
</header>
*/
?>

<div class="home-hero">
</div>

<section class="home-info">
  <div class="home-about">
    <p>GRAZGESCHICHTEN ist das Ergebnis eines gemeinsamen Projekts der FH Joanneum und der Ostfalia Hochschule. Eine Woche lang hatten die Studierenden aus Österreich und Deutschland Zeit, Wege und Perspektiven zu entwickeln, um Graz neu zu erzählen.
    Die Website versammelt elf eigenständige Beiträge, die einen neuen und erfrischenden Blick auf die Stadt mit den roten Dächern werfen.</p>
  </div>
  <div class="home-daten">
  <p>47° 4' 0.12 N 15° 25' 59.88 E <br>
  RESIDENTS: 302.479 <br>
  ALTITUDE: 353m</p>
  </div>
</section>


<!-- GESCHICHTEN GRID -->

<h1 class="home-subhead">Die Geschichten</h1>

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
