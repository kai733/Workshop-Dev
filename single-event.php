<?php

get_header();

$raw_date_string = get_field('event_day');
$description = get_field('event_description');
$descriptionLong = get_field('event_description_long');
$image = get_field('event_image');
$start_hour = get_field('event_start_hour');
$end_hour = get_field('event_end_hour');
$place = get_field('event_place');

?>

<div class="wrapper">
    <div class="breadcrumb">
        <?php get_breadcrumb(); ?>
    </div>
    <h2><?php the_title(); ?></h2>
    <div class="single-event-wrapper">
        <div class="single-event-top">
            <img src="<?php echo $image["url"] ?>" alt="<?php echo $image["alt"] ?>">
        </div>
        <div class="single-event-bottom">
            <div class="single-event-left">
                <h2>Description</h2>
                <p><?php echo $description ?></p>
                <?php echo $descriptionLong; ?>
            </div>
            <div class="single-event-right">
                <div class="event-day">
                    <?php echo get_formatted_date_html($raw_date_string); ?>
                </div>
                <div class="single-event-info">
                    <div class="event-hour">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/Group.svg" alt="Icone heure">
                        <p><?php echo $start_hour . "&nbsp;-" ?></p>
                        <p><?php echo $end_hour ?></p>
                    </div>
                    <div class="event-adress">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/adress.svg"
                            alt="Icone adresse">
                        <p><?php echo $place ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="event-return">
            <a class="button-1" href="<?php echo wp_get_referer() ?>">Retour</a>
        </div>
    </div>
</div>

<?php

get_footer();

?>