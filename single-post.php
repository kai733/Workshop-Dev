<?php

get_header();

$description = get_field('description');
$content = get_field('content');
$image = get_field('image');
$file = get_field('post_file');

?>

<div class="wrapper">
    <div class="breadcrumb">
        <?php get_breadcrumb(); ?>
    </div>
    <h2><?php the_title(); ?></h2>
    <div class="single-post-wrapper">
        <div class="single-post-top">
            <div class="post-description">
                <p><?php echo $description ?></p>
            </div>
            <div class="post-image">
                <img src="<?php echo $image["url"] ?>" alt="<?php echo $image["alt"] ?>">
            </div>
        </div>
        <div class="single-post-bottom">
            <?php echo $content; ?>
        </div>
    </div>
    <?php
    if ($file):
        $url = $file['url'];
        $mime = $file['mime_type'];
        ?>

        <div class="media-container">
            <?php
            // CASE 1: VIDEO (mp4, mov, etc.) 
            if (strpos($mime, 'video') !== false): ?>

                <video controls playsinline width="100%">
                    <source src="<?php echo esc_url($url); ?>" type="<?php echo esc_attr($mime); ?>">
                    Votre navigateur ne supporte pas la lecture de vidéos.
                </video>

                <?php
                // CASE 2: AUDIO (mp3, wav, etc.)
            elseif (strpos($mime, 'audio') !== false): ?>

                <audio controls style="width: 100%;">
                    <source src="<?php echo esc_url($url); ?>" type="<?php echo esc_attr($mime); ?>">
                    Votre navigateur ne supporte pas l'audio.
                </audio>

                <?php
                // CASE 3: PDF
            elseif ($mime === 'application/pdf'): ?>

                <iframe src="<?php echo esc_url($url); ?>" width="100%" height="600px" style="border:none;"></iframe>

                <p style="text-align:center; font-size:0.9em; margin-top:10px;">
                    <a class="button-1" href="<?php echo esc_url($url); ?>" target="_blank">Télécharger le PDF</a>
                </p>

                <?php
                // CASE 4: IMAGE (Just in case they upload a JPG)
            elseif (strpos($mime, 'image') !== false): ?>

                <img src="<?php echo esc_url($url); ?>" alt="<?php echo esc_attr($file['title']); ?>"
                    style="max-width:100%; height:auto;">

                <?php
                // CASE 5: FALLBACK (Zip, Docx, or anything else)
            else: ?>

                <a class="button-1" href="<?php echo esc_url($url); ?>" class="button download-btn">
                    Télécharger le fichier (<?php echo esc_html($file['subtype']); ?>)
                </a>

            <?php endif; ?>

        </div>

    <?php endif; ?>
    <div class="post-return">
        <a class="button-1" href="<?php echo wp_get_referer() ?>">Autres articles</a>
    </div>
</div>
<?php

get_footer();

?>