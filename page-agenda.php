<?php

get_header();

?>

<?php
function get_formatted_date_html($date_string)// <-- fonction généré par IA
{
    // 1. Clean whitespace and split
    $parts = preg_split('/\s+/', trim($date_string));

    if (count($parts) < 3) {
        return '';
    }

    // --- DAY ---
    $day_raw = mb_substr($parts[0], 0, 3, 'UTF-8');
    $day = mb_strtoupper($day_raw, 'UTF-8') . '.';

    // --- NUMBER ---
    $number = $parts[1];

    // --- MONTH (Smart Logic) ---
    $month_raw = str_replace('.', '', $parts[2]); // Remove dots
    $month_clean = mb_strtolower($month_raw, 'UTF-8');

    $full_months = ['mai', 'mars', 'juin', 'août', 'aout'];

    if (in_array($month_clean, $full_months)) {
        // Keep Full (Mai, Juin, Mars)
        $month = mb_strtoupper($month_clean, 'UTF-8');
    } else {
        // Truncate (Jan., Fév., Déc.)
        $month = mb_strtoupper(mb_substr($month_clean, 0, 3, 'UTF-8'), 'UTF-8') . '.';
    }

    // --- YEAR (New) ---
    // Check if the string has a 4th part (the year)
    if (isset($parts[3])) {
        $year = $parts[3];
    } else {
        // Fallback: If no year is in the string, use current year or leave empty
        $year = date('Y');
    }

    // --- HTML STRUCTURE ---
    // Use output buffering or concatenation to build the HTML
    $html = '<div class="date_left">';
    $html .= '<div class="day">' . $day . '</div>';
    $html .= '<div class="number">' . $number . '</div>';
    $html .= '<div class="month">' . $month . '</div>';
    $html .= '</div>'; // Close Left

    $html .= '<div class="date_right">';
    $html .= '<div class="year">' . $year . '</div>';
    $html .= '</div>'; // Close Right

    return $html;
}

$arg = array(
    "post_type" => "event",
    "post_per_page" => "-1",
);

$events = get_posts($arg);

?>

<div class="wrapper">
    <div class="upcoming-events">
        <h2>Prochains événements</h2>
        <?php
        foreach ($events as $post_object):
            $postId = $post_object->ID;
            $event_day = get_field('event_day', $postId);
            $description = get_field('event_description', $postId);
            $image = get_field('event_image', $postId);
            $event_start_hour = get_field('event_start_hour', $postId);
            $event_end_hour = get_field('event_end_hour', $postId);
            $event_place = get_field('event_place', $postId);
            ?>
            <div class="agenda-event-card">
                <div class="agenda-card-1">
                    <?php
                    echo get_formatted_date_html($event_day);
                    ?>
                </div>
                <div class="agenda-card-2">
                    <h3><?php echo get_the_title($postId); ?></h3>
                    <p><?php echo $description ?></p>
                </div>
                <div class="agenda-card-3">
                    <img src="<?php echo $image["url"] ?>" alt="<?php echo $image["alt"] ?>">
                </div>
                <div class="agenda-card-4">
                    <div class="event-hour">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/Group.svg" alt="Icone heure">
                        <p><?php echo $event_start_hour . "&nbsp;-" ?></p>
                        <p><?php echo $event_end_hour ?></p>
                    </div>
                    <div class="event-adress">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/adress.svg" alt="Icone adresse">
                        <p><?php echo $event_place ?></p>
                    </div>
                    <a class="button-3" href="<?php echo get_permalink($postId) ?>">On va plus loin ?</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="past-events">
        <h2>Événements passés</h2>
        <?php
        foreach ($events as $post_object):
            $postId = $post_object->ID;
            $event_day = get_field('event_day', $postId);
            $description = get_field('event_description', $postId);
            $image = get_field('event_image', $postId);
            $event_start_hour = get_field('event_start_hour', $postId);
            $event_end_hour = get_field('event_end_hour', $postId);
            $event_place = get_field('event_place', $postId);
            ?>
            <div class="agenda-event-card">
                <div class="agenda-card-1">
                    <?php
                    echo get_formatted_date_html($event_day);
                    ?>
                </div>
                <div class="agenda-card-2">
                    <h3><?php echo get_the_title($postId); ?></h3>
                    <p><?php echo $description ?></p>
                </div>
                <div class="agenda-card-3">
                    <img src="<?php echo $image["url"] ?>" alt="<?php echo $image["alt"] ?>">
                </div>
                <div class="agenda-card-4">
                    <div class="event-hour">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/Group.svg" alt="Icone heure">
                        <p><?php echo $event_start_hour . "&nbsp;-" ?></p>
                        <p><?php echo $event_end_hour ?></p>
                    </div>
                    <div class="event-adress">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/adress.svg" alt="Icone adresse">
                        <p><?php echo $event_place ?></p>
                    </div>
                    <a class="button-3" href="<?php echo get_permalink($postId) ?>">On va plus loin ?</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>


<?php

get_footer();

?>