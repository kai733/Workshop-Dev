<?php

get_header();

$volunteer = get_field("volunteer");
$volunteerTop = get_field("volunteer_top");
?>

<div class="wrapper">
    <div class="volunteer">
        <div class="volunteer-top">
            <h2><?php echo single_post_title(); ?></h2>
            <p><?php echo $volunteerTop["description"] ?></p>
        </div>
        <h3><?php echo $volunteerTop["subtitle"] ?></h3>
        <?php foreach ($volunteer as $section): ?>
            <div class="volunteer-card">
                <div class="volunteer-card-left">
                    <h3><?php echo $section["section_title"] ?></h3>
                    <div class="volunteer-card-p"><?php echo $section["section_description"] ?></div>
                    <div class="volunteer-card-links">
                        <a class="button-1"
                            href="<?php echo $section["link_1"]["url"] ?>"><?php echo $section["link_1"]["title"] ?></a>
                        <?php if ($section["link_2"]): ?>
                            <a class="button-3"
                                href="<?php echo $section["link_2"]["url"] ?>"><?php echo $section["link_2"]["title"] ?></a>
                        <?php endif ?>
                    </div>
                </div>
                <div class="volunteer-card-right">
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