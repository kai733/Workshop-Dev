<?php

get_header();

?>

<section>
    <h1><?php echo get_the_title();?></h1>
    <div>
        <?php echo get_the_content(); ?>
    </div>
</section>

<?php

get_footer();

?>