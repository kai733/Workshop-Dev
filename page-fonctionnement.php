<?php

get_header();

$fonction = get_field("fonction");
?>

<div class="wrapper">
    <div class="breadcrumb">
        <?php get_breadcrumb(); ?>
    </div>
    <div class="fonction">
        <h2><?php echo single_post_title(); ?></h2>
        <?php foreach ($fonction as $section): ?>
            <div class="fonction-card">
                <?php if ($section["section_title"]): ?>
                    <h3><?php echo $section["section_title"] ?></h3>
                <?php endif ?>
                <?php if ($section["section_description"]): ?>
                    <div class="fonction-card-p"><?php echo $section["section_description"] ?></div>
                <?php endif ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php

get_footer();

?>