<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package SBC
 * @subpackage SBCTheme
 * @since SBC Theme 1.0
 */
?>

		</div><!-- .site-content -->

    <footer class="group js-footer" id="footer" role="contentinfo">

      <div class="footer-wrapper">
       

        <div class="footer-meta">
          <div class="footer-meta-inner">
            <div class="open-government-licence">
              <p class="logo"><a href="https://www.nationalarchives.gov.uk/doc/open-government-licence/version/3/" rel="license">Open Government Licence</a></p>

              <p>All content is available under the <a rel="license" href="https://www.nationalarchives.gov.uk/doc/open-government-licence/version/3/">Open Government Licence v3.0</a>, except where otherwise stated</p>

            </div>
          </div>

          <div class="copyright">
            <a href="http://www.nationalarchives.gov.uk/information-management/re-using-public-sector-information/copyright-and-re-use/crown-copyright/">&copy; Crown copyright</a>
          </div>
        </div>
      </div>
    </footer>


	</div><!-- .site-inner -->
</div><!-- .site -->

<div id="global-app-error" class="app-error hidden"></div>

<script src="<?php echo get_template_directory_uri() . '/js/govuk-template.js'; ?>"></script>
<script src="<?php echo get_template_directory_uri() . '/js/vendor/details.polyfill.js'; ?>"></script>


<?php wp_footer(); ?>
</body>
</html>
