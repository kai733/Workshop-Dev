<?php

get_header();
$introduction = get_field(selector: "introduction");
$quiz = get_field(selector: "quiz");
$about = get_field(selector: "about");
$agenda = get_field(selector: "agenda");
$blog = get_field(selector: "blog");
$our_friends = get_field(selector: "our_friends");

?>

<?php
function get_formatted_date_html($date_string)
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
?>



<div class="intro">
    <div class="wrapper intro-wrapper">
        <?php foreach ($introduction["cards"] as $card): ?>
            <div style="background-image: url('<?php echo $card["image"]["url"] ?>')" class="intro-card">
                <label class="tag"><?php echo $card["tag"] ?></label>
                <h3 class="title"><?php echo $card["title"] ?></h3>
                <a class="button-1" href="<?php echo $card["button"]["url"] ?>"
                    target="<?php echo $card["button"]["target"] ?>"><?php echo $card["button"]["title"] ?> </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="quiz">
    <h2><?php echo $quiz["title"] ?></h2>
    <p><?php echo $quiz["description"] ?></p>
    <?php $counter = 0; ?>
    <?php foreach ($quiz["questions"] as $key => $question): ?>
        <?php
        $counter++;
        $active_class = ($counter === 1) ? 'active' : '';
        ?>
        <div class="question-card <?php echo $active_class; ?>">
            <h3><?php echo $key + 1; ?> / <?php echo count($question["answers"]); ?></h3>
            <h3><?php echo $question["question"] ?></h3>
            <div class="answer-list">
                <?php
                $labels = [0 => 'A', 1 => 'B', 2 => 'C'];
                ?>
                <?php foreach ($question["answers"] as $key => $answer_data): ?>
                    <button class="answer">
                        <div class="answer-label">
                            <h4><?php echo $labels[$key]; ?></h4>
                        </div>
                        <h4><?php echo $answer_data["answer"]; ?></h4>
                    </button>
                <?php endforeach; ?>
            </div>
            <div class="control">
                <button class="button-2 prev-btn">Précédent</button>
                <button class="button-2 next-btn">Suivant</button>
            </div>
        </div>
    <?php endforeach; ?>
    <?php
    $result_1 = $quiz["result_1"];
    $result_2 = $quiz["result_2"];
    $result_3 = $quiz["result_3"]
        ?>
    <div class="result">
        <h2><?php echo $result_1["title"] ?></h2>
        <img src="<?php echo $result_1["image"] ?>">
        <p><?php echo $result_1["description_1"] ?></p>
        <p><?php echo $result_1["description_2"] ?></p>
        <a class="button-1"
            href="<?php echo $result_1["button"]["url"] ?>"><?php echo $result_1["button"]["title"] ?></a>
    </div>
    <div class="result">
        <h2><?php echo $result_2["title"] ?></h2>
        <img src="<?php echo $result_2["image"] ?>">
        <p><?php echo $result_2["description_1"] ?></p>
        <p><?php echo $result_2["description_2"] ?></p>
        <a class="button-1"
            href="<?php echo $result_2["button"]["url"] ?>"><?php echo $result_2["button"]["title"] ?></a>
    </div>
    <div class="result">
        <h2><?php echo $result_3["title"] ?></h2>
        <img src="<?php echo $result_3["image"] ?>">
        <p><?php echo $result_3["description_1"] ?></p>
        <p><?php echo $result_3["description_2"] ?></p>
        <a class="button-1"
            href="<?php echo $result_3["button"]["url"] ?>"><?php echo $result_3["button"]["title"] ?></a>
    </div>
</div>
<div class="about">
    <div class="wrapper">
        <div class="about-wrapper">
            <div class="about-left">
                <?php echo $about["presentation_video"] ?>
            </div>
            <div class="about-right">
                <h5><?php echo $about["section_title"] ?></h5>
                <h2><?php echo $about["title"] ?></h2>
                <p><?php echo $about["description"] ?></p>
                <a class="button-1"
                    href="<?php echo $about["button"]["url"] ?>"><?php echo $about["button"]["title"] ?></a>
            </div>
        </div>
    </div>
</div>
<div class="agenda">
    <div class="wrapper">
        <div class="agenda-wrapper">
            <div class="agenda-left">
                <h5><?php echo $agenda["section_title"] ?></h5>
                <h2><?php echo $agenda["title"] ?></h2>
                <p><?php echo $agenda["description"] ?></p>
                <a class="button-1"
                    href="<?php echo $agenda["button"]["url"] ?>"><?php echo $agenda["button"]["title"] ?></a>
            </div>
            <div class="agenda-right">
                <?php
                $counter = 0;
                ?>
                <?php foreach ($agenda["event"] as $events):
                    $postId = $events->ID;
                    $description = get_field('event_description', $postId);
                    $event_day = get_field('event_day', $postId);
                    $event_start_hour = get_field('event_start_hour', $postId);
                    $event_end_hour = get_field('event_end_hour', $postId);
                    $event_place = get_field('event_place', $postId);
                    $counter++;
                    ?>
                    <div class="event-card">
                        <div class="event-card-1">
                            <?php
                            echo get_formatted_date_html($event_day);
                            ?>
                        </div>
                        <div class="event-card-2">
                            <h3><?php echo $events->post_title ?></h3>
                            <p><?php echo $description ?></p>
                        </div>
                        <div class="event-card-3">
                            <div class="event-hour">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/Group.svg"
                                    alt="Icone heure">
                                <p><?php echo $event_start_hour . "&nbsp;-" ?></p>
                                <p><?php echo $event_end_hour ?></p>
                            </div>
                            <div class="event-adress">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/adress.svg"
                                    alt="Icone adresse">
                                <p><?php echo $event_place ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
<div class="blog">
    <div class="wrapper">
        <div class="blog-wrapper">
            <div class="blog-top">
                <div class="blog-top-left">
                    <h5><?php echo $blog["section_title"] ?></h5>
                    <h2><?php echo $blog["title"] ?></h2>
                </div>
                <div class="blog-top-right">
                    <a class="button-1"
                        href="<?php echo $blog["button"]["url"] ?>"><?php echo $blog["button"]["title"] ?></a>
                </div>
            </div>
            <div class="blog-bottom">
                <?php foreach ($blog["un_blog"] as $card): ?>
                    <div class="blog-card">
                        <div class="blog-card-top">
                            <div class="blog-categories">
                                <?php
                                $categories = get_the_category($card->ID);
                                if (!empty($categories)) {
                                    foreach ($categories as $cat) {
                                        echo '<label class="' . $cat->slug . ' my-custom-class">';
                                        echo $cat->name;
                                        echo '</label> ';
                                    }
                                }
                                ?>
                            </div>
                            <h3><?php echo $card->post_title ?></h3>
                            <p><?php echo $card->post_content ?></p>
                        </div>
                        <div class="blog-card-bottom">
                            <a class="button-2" href="<?php echo $card->guid ?>">Creusons un peu</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<div class="our-friends">
    <div class="wrapper">
        <div class="wrapper-our-friends">
            <div class="our-friends-left">
                <h2><?php echo $our_friends["title"] ?></h2>
                <p><?php echo $our_friends["description"] ?></p>
            </div>
            <div class="our-friends-middle">
                <?php foreach ($our_friends["friends_logo"] as $logo): ?>
                    <a href="<?php echo $logo["link"]["url"] ?>"><img src="<?php echo $logo["logo"]["url"] ?>"
                            alt="<?php echo $logo["logo"]["alt"] ?>"></a>
                <?php endforeach ?>
            </div>
            <div class="our-friends-right">
                <a class="button-1"
                    href="<?php echo $our_friends["button"]["url"] ?>"><?php echo $our_friends["button"]["title"] ?></a>
            </div>
        </div>
    </div>
</div>
<?php

get_footer();

?>