<?php
/*
  Snippets are a great way to store code snippets for reuse
  or to keep your templates clean.

  This footer snippet is reused in all templates.

  More about snippets:
  https://getkirby.com/docs/guide/templates/snippets
*/
?>
  </main>

  <footer class="footer">
    <div class="footer-about-wrapper">
    <h1>Grazgeschichten</h1>
    <section class="footer-about">
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae, voluptatem nesciunt. Fugiat doloremque ducimus facere maxime architecto sed enim, vero pariatur in recusandae corporis molestiae quaerat vel quod quam sit? </p>
    </section>
    </div>

    <section class="footer-nav">
      <h1>Navigation</h1>
      <a href="">Home</a>
      <a href="">About</a>
      <a href="">Impressum</a>
    </section>

    <section class="footer-partner">
      <h1>Ein Partnerprojekt von</h1>
      <a href="https://www.ostfalia.de/" target="_blank"><img class="footer-logo" src="../assets/images/ostfalia.png" alt="Logo Ostfalia HaW"></a>
      <a href="https://www.fh-joanneum.at/" target="_blank"><img class="footer-logo" src="../assets/images/logo_FHJ_100mm_rgb.png" alt="Logo FH Joanneum"></a>
    </section>
    
  </footer>

  <?= js([
    'assets/js/prism.js',
    'assets/js/lightbox.js',
    'assets/js/index.js',
    '@auto'
  ]) ?>

</body>
</html>
