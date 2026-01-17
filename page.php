<?php

get_header();

?>

<div class="wrapper">
    <div class="breadcrumb">
        <?php get_breadcrumb(); ?>
    </div>
    <div class="cms">
        <?php
        if (have_posts()):
            while (have_posts()):
                the_post();
                the_content();
            endwhile;
        endif;
        ?>
    </div>
</div>

<?php

get_footer();

?>