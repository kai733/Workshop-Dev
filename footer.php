<footer>
  <?php
  $footer = get_field(selector: "footer");
  ?>
  <?php dynamic_sidebar('footer-sidebar'); ?>
  <div class="footer">
    <div class="wrapper">
      <div class="footer-wrapper">
        <div class="footer-top">
          <div class="footer-1">
            <a href="<?php echo $footer["emanciper_link"] ?>"><img src="<?php echo $footer["emanciper_logo"]["url"] ?>"
                alt="<?php echo $footer["emanciper_logo"]["alt"] ?>"></a>
            <p><?php echo $footer["baseline_emanciper"] ?></p>
          </div>
          <div class="footer-2">
            <p><?php echo $footer["contact"] ?></p>
            <div class="footer-logos">
              <?php foreach ($footer["social_medias_logos"] as $logo): ?>
                <a href="<?php echo $logo["social_media_link"]["url"] ?>"><img
                    src="<?php echo $logo["social_media_logo"]["url"] ?>"
                    alt="<?php echo $logo["social_media_logo"]["alt"] ?>"></a>
              <?php endforeach ?>
            </div>
          </div>
          <div class="footer-3">
            <div class="line"><img src="<?php echo $footer["mail_logo"]["url"] ?>"
                alt="<?php echo $footer["mail_logo"]["alt"] ?>">
              <a href="<?php echo 'mailto:' . $footer["emanciper_mail"] ?>"><?php echo $footer["emanciper_mail"] ?></a>
            </div>
            <div class="line"><img style="margin-left: 3px;" src="<?php echo $footer["adress_logo"]["url"] ?>"
                alt="<?php echo $footer["adress_logo"]["alt"] ?>">
              <a
                href="<?php echo 'https://www.google.com/maps/search/' . $footer["emanciper_adress"] ?>"><?php echo $footer["emanciper_adress"] ?></a>
            </div>


          </div>
          <div class="footer-4">
            <a href="<?php $footer["legal"]["url"] ?>"><?php echo $footer["legal"]["title"] ?></a>
            <a href="<?php echo $footer["politique"]["url"] ?>"><?php echo $footer["politique"]["title"] ?></a>
          </div>
        </div>
        <div class="footer-bottom">
          <p><?php echo $footer["talented_students"] . date("Y") ?></p>
        </div>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>