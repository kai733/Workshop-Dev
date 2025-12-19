<?php

get_header();

$about = get_field("abou_content");
?>

<div class="wrapper">
    <div class="breadcrumb">
        <?php get_breadcrumb(); ?>
    </div>
    <div class="about">
        <h2><?php echo single_post_title(); ?></h2>
        <?php foreach ($about as $section): ?>
            <div class="about-card">
                <div class="about-card-left">
                    <h3><?php echo $section["section_title"] ?></h3>
                    <div class="about-card-p"><?php echo $section["section_description"] ?></div>
                    <div class="about-card-links">
                        <a class="button-1"
                            href="<?php echo $section["link_1"]["url"] ?>"><?php echo $section["link_1"]["title"] ?></a>
                        <?php if ($section["link_2"]): ?>
                            <a class="button-3"
                                href="<?php echo $section["link_2"]["url"] ?>"><?php echo $section["link_2"]["title"] ?></a>
                        <?php endif ?>
                    </div>
                </div>
                <div class="about-card-right">
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