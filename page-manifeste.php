<?php

get_header();

$manifest = get_field("manifest");
?>

<div class="wrapper">
    <div class="breadcrumb">
        <?php get_breadcrumb(); ?>
    </div>
    <div class="manifest">
        <h2><?php echo single_post_title(); ?></h2>
        <?php foreach ($manifest as $section): ?>
            <div class="manifest-card">
                <div class="manifest-card-left">
                    <?php if ($section["section_description"]): ?>
                        <div class="manifest-card-p"><?php echo $section["section_description"] ?></div>
                    <?php endif ?>
                </div>
                <div class="manifest-card-right">
                    <div class="reason-card-right">
                        <?php if ($section["section_image"]): ?>
                            <img src="<?php echo $section["section_image"]["url"] ?>"
                                alt="<?php echo $section["section_image"]["alt"] ?>">
                        <?php endif ?>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php

get_footer();

?>