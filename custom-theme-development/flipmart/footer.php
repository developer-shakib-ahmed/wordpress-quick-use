
    <!-- FOOTER -->
    <footer id="footer" class="footer color-bg">
      <div class="footer-bottom">
        <div class="container">
          <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-3">
              <?php dynamic_sidebar( 'footer-top-1' ); ?>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
              <?php dynamic_sidebar( 'footer-top-2' ); ?>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
              <?php dynamic_sidebar( 'footer-top-3' ); ?>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
              <?php dynamic_sidebar( 'footer-top-4' ); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="copyright-bar">
        <div class="container">
          <div class="col-xs-12 col-sm-6 no-padding social">
            <?php dynamic_sidebar( 'footer-bottom-1' ); ?>
          </div>
          <div class="col-xs-12 col-sm-6 no-padding">
            <?php dynamic_sidebar( 'footer-bottom-2' ); ?>
          </div>
        </div>
      </div>
    </footer>

    <?php wp_footer(); ?>
  </body>
</html>