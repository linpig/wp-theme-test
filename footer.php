

<footer>
  <p>This is my footer</p>

  <?php
        wp_nav_menu(array(
          'theme_location'=>'secondary',
          'container' => 'ul',
          'menu_class' => 'nav navbar-nav'

        )
      );
   ?>
</footer>


  <?php wp_footer() ?>
 </body>
</html>
