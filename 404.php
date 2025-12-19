<?php
get_header();

$fourOfour = get_field("404", "options");
$image_url = $fourOfour["404_image"]["url"];
?>

<style>
    body {
        display: flex;
        flex-direction: column;
        min-height: 160vh;
        background-image: url('<?php echo esc_url($image_url); ?>');
        background-position: center 100px;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .content-404 {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        align-items: center;
        text-align: center;
        padding-top: 100px;
        color: #E7DCCF;

        h1 {
            background: rgba(0, 0, 0, 0.7);
        }

        h2 {
            background: rgba(0, 0, 0, 0.7);
        }
    }

    footer,
    .site-footer {
        margin-top: auto;
        width: 100%;
    }
</style>

<div class="content-404">
    <h1><?php echo $fourOfour["texte_1"] ?></h1>
    <h2><?php echo $fourOfour["texte_2"] ?></h2>
</div>

<?php
get_footer();
?>