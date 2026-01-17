<?php

get_header();

$history = get_field("history_content");
?>

<div class="wrapper">
    <div class="breadcrumb">
        <?php get_breadcrumb(); ?>
    </div>
    <div class="history">
        <h2>
            <?php echo $history["page_title"]; ?>
        </h2>
        <p><?php echo $history["description"]; ?></p>

        <div class="history-cards">
            <?php if ($history["events"]): ?>
                <?php foreach ($history["events"] as $event): ?>
                    <div class="history-card">
                        <div class="history-card-left">
                            <h4>
                                <?php echo $event["event_date"] ?>
                            </h4>
                            <div class="history-card-p">
                                <?php echo $event["event_description"] ?>
                            </div>
                        </div>
                        <div class="history-card-right">
                            <img src="<?php echo $event["event_image"]["url"] ?>" alt="
                    <?php echo $event["event_image"]["alt"] ?>">
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>



<?php

get_footer();

?>