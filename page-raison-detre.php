<?php

get_header();

$reason = get_field("reason_living");
?>

<div class="wrapper">
    <div class="breadcrumb">
        <?php get_breadcrumb(); ?>
    </div>
    <div class="reason">
        <h2><?php echo single_post_title(); ?></h2>
        <?php foreach ($reason as $section): ?>
            <div class="reason-card">
                <div class="reason-card-left">
                    <?php if ($section["section_title"]): ?>
                        <h3><?php echo $section["section_title"] ?></h3>
                    <?php endif ?>
                    <?php if ($section["section_description"]): ?>
                        <div class="reason-card-p"><?php echo $section["section_description"] ?></div>
                    <?php endif ?>
                    <div class="reason-card-links">
                        <?php if ($section["link_1"]): ?>
                            <a class="button-1"
                                href="<?php echo $section["link_1"]["url"] ?>"><?php echo $section["link_1"]["title"] ?></a>
                        <?php endif ?>
                        <?php if ($section["link_2"]): ?>
                            <a class="button-3"
                                href="<?php echo $section["link_2"]["url"] ?>"><?php echo $section["link_2"]["title"] ?></a>
                        <?php endif ?>
                    </div>
                </div>
                <div class="reason-card-right">
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