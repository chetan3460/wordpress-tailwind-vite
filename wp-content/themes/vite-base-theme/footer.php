  <footer class="p-4 bg-gray-100 text-center text-sm">
    <?php bloginfo('name'); ?> is proudly powered by WordPress
  </footer>
  <?php wp_footer();
  // footer.php or wp_footer hook
  if (is_dev_mode()) {
    echo '<script type="module" src="http://localhost:3000/js/main.js"></script>';
  }
  ?>

  </body>

  </html>