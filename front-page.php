<?php

get_header();
$introduction = get_field(selector: "introduction");
$quiz = get_field(selector: "quiz");

?>
<?php // var_dump($introduction); ?>
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
    <?php foreach ($quiz["questions"] as $key => $question): ?>
        <div class="question-card">
            <h3><?php echo $key + 1; ?> / <?php echo count($question["answers"]); ?></h3>
            <h3><?php echo $question["question"] ?></h3>
            <div class="answer-list">
                <?php
                $labels = [0 => 'A', 1 => 'B', 2 => 'C'];
                ?>
                <?php foreach ($question["answers"] as $key => $answer_data): ?>
                    <div class="answer">
                        <div class="answer-label">
                            <h4><?php echo $labels[$key]; ?></h4>
                        </div>
                        <h4><?php echo $answer_data["answer"]; ?></h4>
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="button-2">Suivant</button>
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
    <pre><?php //var_dump($quiz); ?></pre>
</div>
<?php

get_footer();

?>

<?php ?>