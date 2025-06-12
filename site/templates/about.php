<?php
/*
  Templates render the content of your pages.

  They contain the markup together with some control structures
  like loops or if-statements. The `$page` variable always
  refers to the currently active page.

  To fetch the content from each field we call the field name as a
  method on the `$page` object, e.g. `$page->title()`.

  This about page example uses the content from our layout field
  to create most parts of the page and keeps it modular. Only the
  contact box at the bottom is pre-defined with a set of fields
  in the about.yml blueprint.

  Snippets like the header and footer contain markup used in
  multiple templates. They also help to keep templates clean.

  More about templates: https://getkirby.com/docs/guide/templates/basics
*/
?>
<?php snippet('header') ?>
<div class="spacer"></div>

<p class="about-text">
  GRAZGESCHICHTEN ist das Ergebnis eines gemeinsamen Projekts der FH Joanneum und der Ostfalia Hochschule. Eine Woche lang hatten die Studierenden aus Österreich und Deutschland Zeit, Wege und Perspektiven zu entwickeln, um Graz neu zu erzählen. Die Website versammelt elf eigenständige Beiträge, die einen neuen und erfrischenden Blick auf die Stadt mit den roten Dächern werfen.
  <br><br>
  Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
</p>
<main>
<img class="gruppenfoto"src="https://froh.ngo/wp-content/uploads/2022/09/DSC_7404.jpg">
<p class="text">
Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
</p>
<p>Team<br><br></p>
<div class="namen">
  <div class="studierende">
    <p>Studierende:<br>
      Prof. Klaus Neuburg<br>
      Moritz Winkler<br>
      Andreas Kölmel<br>
      Tonio Vakalopoulus<br>
      Prof. Wolfgang Graz<br>
      Prof. Klaus Neuburg<br>
      Moritz Winkler</p>
  </div>
  <div class="studierende">
    <p>Prof. Klaus Neuburg<br>
      Moritz Winkler<br>
      Andreas Kölmel<br>
      Tonio Vakalopoulus<br>
      Prof. Wolfgang Graz<br>
      Prof. Klaus Neuburg<br>
      Moritz Winkler<br>
      Prof. Günni Graz</p>
      </div>
    <div class="studierende">
    <p>Lehrende:<br>
      Prof. Klaus Neuburg<br>
      Moritz Winkler<br>
      Andreas Kölmel<br>
      Tonio Vakalopoulus<br>
      Prof. Wolfgang Graz<br>
    </p>
  </div>
  </div>
</div>
<div class="namen-mobil">
  <section>
    <p>
      Studierende:<br>
      Prof. Klaus Neuburg<br>
      Moritz Winkler<br>
      Andreas Kölmel<br>
      Tonio Vakalopoulus<br>
      Prof. Wolfgang Graz<br>
      Prof. Günni Graz<br>
      Prof. Klaus Neuburg<br>
      Moritz Winkler<br>
      Prof. Klaus Neuburg<br>
      Moritz Winkler<br>
      Andreas Kölmel<br>
      Tonio Vakalopoulus<br>
      Prof. Wolfgang Graz<br>
      Prof. Günni Graz<br>
      Prof. Klaus Neuburg<br>
      Moritz Winkler<br>
      Prof. Günni Graz<br>
    </p>
  </section>
  <section>
    <p>
      Lehrende:<br>
      Prof. Klaus Neuburg<br>
      Moritz Winkler<br>
      Andreas Kölmel<br>
      Tonio Vakalopoulus<br>
      Prof. Wolfgang Graz<br>
      Prof. Günni Graz<br>
    </p>
  </section>
</div>
</main>


<?php snippet('footer') ?>
