<?php

get_header();

?>

<?php


$arg = array(
    "post_type" => "event",
    "post_per_page" => "-1",
);

$events = get_posts($arg);

?>

<div class="wrapper">
    <div class="breadcrumb">
        <?php get_breadcrumb(); ?>
    </div>
    <div class="upcoming-events">
        <h2>Prochains événements</h2>
        <?php
        $today = date('Ymd');
        $upcoming_events = [];
        $past_events = [];

        $months_map = [
            'janvier' => '01',
            'février' => '02',
            'mars' => '03',
            'avril' => '04',
            'mai' => '05',
            'juin' => '06',
            'juillet' => '07',
            'août' => '08',
            'aout' => '08',
            'septembre' => '09',
            'octobre' => '10',
            'novembre' => '11',
            'décembre' => '12'
        ];

        foreach ($events as $post_object) {
            $postId = $post_object->ID;
            $event_day_str = get_field('event_day', $postId); 
            // Expected format: "Day Number Month Year" e.g., "Lundi 12 Octobre 2025"
            // or maybe just "12 Octobre 2025"? 
            // Based on get_formatted_date_html, it expects 3 or 4 parts.
            // Let's parse it safely.
            
            $parts = preg_split('/\s+/', trim($event_day_str));
            $event_ymd = '';

            if (count($parts) >= 3) {
                 // Assuming: [DayName] [DayNum] [MonthName] [Year]
                 // Or: [DayNum] [MonthName] [Year] ?
                 // get_formatted_date_html uses parts[0] as DayName (3 chars), parts[1] as Number, parts[2] as Month.
                 // So format is: "DayName DayNum MonthName Year" (4 parts usually)
                 
                 $day_num = str_pad($parts[1], 2, '0', STR_PAD_LEFT);
                 $month_name = strtolower(str_replace('.', '', $parts[2]));
                 $month_num = isset($months_map[$month_name]) ? $months_map[$month_name] : '00';
                 
                 // Year is usually part 3 ($parts[3])
                 $year = isset($parts[3]) ? $parts[3] : date('Y');
                 
                 $event_ymd = $year . $month_num . $day_num;
            }

            if ($event_ymd >= $today) {
                $upcoming_events[] = $post_object;
            } else {
                $past_events[] = $post_object;
            }
        }

        if (empty($upcoming_events)) {
            echo '<p>Pas d\'événements à venir</p>';
        } else {
            foreach ($upcoming_events as $post_object):
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
            <?php endforeach;
        } ?>
    </div>

    <div class="past-events">
        <h2>Événements passés</h2>
        <?php
        if (empty($past_events)) {
            echo '<p>Pas d\'événements passés</p>';
        } else {
            foreach ($past_events as $post_object):
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
            <?php endforeach;
        } ?>
    </div>

</div>


<?php

get_footer();

?>