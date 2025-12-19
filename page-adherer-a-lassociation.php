<?php

get_header();
$joinUsTop = get_field("join_us_top");
$joinUsBottom = get_field("join_us_bottom");

?>

<div class="joinUsTop">
    <div class="wrapper">
        <div class="joinUsTop-links">
            <a class="button-1"
                href="<?php echo $joinUsTop["lien_1"]["url"] ?>"><?php echo $joinUsTop["lien_1"]["title"] ?></a>
            <a class="button-3"
                href="<?php echo $joinUsTop["lien_2"]["url"] ?>"><?php echo $joinUsTop["lien_2"]["title"] ?></a>
        </div>
        <div class="joinUsTop-wrapper">
            <div class="joinUsTop-left">
                <?php foreach ($joinUsTop["explanation"] as $line): ?>
                    <div class="joinUs-container">
                        <h5><?php echo $line["title"] ?></h5>
                        <div class="joinUsTop-p"><?php echo $line["description"] ?></div>
                    </div>
                <?php endforeach ?>
            </div>
            <div class="joinUsTop-right">
                <?php foreach ($joinUsTop["platforms"] as $line): ?>
                    <div class="joinUs-container">
                        <h5><?php echo $line["title"] ?></h5>
                        <div class="joinUsTop-p"><?php echo $line["description"] ?></div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
<div class="joinUsBottom">
    <div class="wrapper">
        <div class="joinUsBottom-wrapper">
            <h3><?php echo $joinUsBottom["section_title"] ?></h3>
            <?php echo do_shortcode($joinUsBottom["newsletter_code"]); ?>
            <p><?php echo $joinUsBottom["data_collection"] ?></p>
        </div>
    </div>
</div>
<pre><?php // var_dump($joinUsTop["lien_1"]) ?></pre>
<?php

get_footer();

?>