<?php

get_header();

$offer = get_field("offer");
?>

<div class="wrapper">
    <div class="breadcrumb">
        <?php get_breadcrumb(); ?>
    </div>
    <div class="offer">
        <h2><?php echo single_post_title(); ?></h2>
        <?php foreach ($offer as $section): ?>
            <div class="offer-card">
                <div class="offer-card-left">
                    <h3><?php echo $section["section_title"] ?></h3>
                    <div class="offer-card-p"><?php echo $section["section_description"] ?></div>
                </div>
                <div class="offer-card-right">
                    <img src="<?php echo $section["section_image"]["url"] ?>"
                        alt="<?php echo $section["section_image"]["alt"] ?>">
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>



<?php

get_footer();

?>