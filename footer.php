                <?php if(get_post_meta( $post->ID, '_wp_page_template', true ) != 'template-contact.php'): ?>
                <div class="get-in-touch">
                    <span class="icon-phone"></span>
                    <h3 class="times italic no-text-transform"><a class="dark-grey" href="<?php bloginfo('url') ?>/contact/"><?php _e("Get in touch with us for a chat about how we can help you secure the talent you need.", 'major_talent') ?></a></h3>
                </div>
                <?php endif; ?>
                <div class="bottom"></div>
            </div><!-- #main -->
        </div><!--.inner-->
        <footer id="footer">
            <div class="header-bottom">
                <a href="<?php bloginfo('url') ?>" class="footer-logo"><img src="<?php bloginfo('template_url'); ?>/images/logos/mjr_footer.png" title="MJR Talent" alt="MJR Talent"></a>
            </div>
            <div class="footer-container clearfix">
                <div class="contact clearfix">
                    <div class="span three alpha"><p><span class="label"><?php _e("Email", 'major_talent'); ?></span><a href="mailto: info@mjrtalent.com" class="uppercase white"><?php _e("info@mjrtalent.COM", 'major_talent'); ?></a></p></div>
                    <div class="span three"><p><span class="label"><?php _e("London", 'major_talent'); ?></span><?php _e("+44 (0) 7957 909 396", 'major_talent'); ?></p></div>
                    <div class="span two"><p><span class="label"><?php _e("Sydney", 'major_talent'); ?></span><?php _e("+61 (0) 468 936 587", 'major_talent'); ?></p></div>
                    <div class="span two omega text-right">
                        <a href="#" class="share-btn twitter ir"><?php _e("MJR Talent on Twitter", 'major_talent'); ?></a>
                        <a href="#" class="share-btn facebook ir"><?php _e("MJR Talent on Facebook", 'major_talent'); ?></a>
                    </div>
                </div>
                <div class="newsletter clearfix">
                    <?php gravity_form(1); ?>
                 </div>
                <div class="footer-text">
                    <span><?php _e("&copy; Copyright MJR Talent", 'major_talent'); ?></span>
                    <span><?php _e("Company Reg. No: 07672088 / ABN: 59 161 440 240", 'major_talent'); ?></span>                
                </div>
            </div>
        </footer>
    </div>
    <?php wp_footer(); ?>

    <script type="text/javascript">

      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-31161098-1']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();

    </script>
</body>
</html>