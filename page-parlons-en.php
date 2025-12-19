<?php

get_header();

?>

<div class="wrapper">

    <div class="blog-header">
        <h2>Parlons-en !</h2>
    </div>

    <div class="blog-grid">
        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 8,
            'paged' => $paged,
            'orderby' => 'date',
            'order' => 'DESC',
        );

        $blog_query = new WP_Query($args);

        if ($blog_query->have_posts()):
            while ($blog_query->have_posts()):
                $blog_query->the_post();

                $post_id = get_the_ID();
                $categories = get_the_category();
                $link = get_permalink();
                $title = get_the_title();
                $desc = get_field('description', $post_id);
                $image = get_field('image', $post_id);
                ?>

                <article class="blog-card">
                    <div class="blog-card-inner">

                        <div class="card-top">
                            <div class="card-badges">
                                <?php if ($categories): ?>
                                    <?php foreach ($categories as $cat): ?>
                                        <span class="badge <?php echo esc_attr($cat->slug); ?>">
                                            <?php echo esc_html($cat->name); ?>
                                        </span>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>

                            <?php if ($image): ?>
                                <div class="card-image-wrapper">
                                    <?php if (is_array($image)): ?>
                                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                                    <?php else: ?>
                                        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>">
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-below-image">
                            <div class="card-content">
                                <h3><?php echo $title; ?></h3>

                                <div class="description">
                                    <p><?php echo wp_trim_words($desc, 20, '...'); ?></p>
                                </div>
                            </div>

                            <div class="card-footer">
                                <a href="<?php echo $link; ?>" class="button-2">Creusons un peu</a>
                            </div>
                        </div>
                    </div>
                </article>
                <?php
            endwhile;
            wp_reset_postdata();
        else:
            echo '<p>Aucun article trouvé.</p>';
        endif;
        ?>
    </div>
    <div class="pagination">
        <?php
        echo paginate_links(array(
            'total' => $blog_query->max_num_pages,
            'current' => $paged,
            'prev_text' => __('Précédent'),
            'next_text' => __('Suivant'),
        ));
        ?>
    </div>
</div>
</div>

<?php get_footer(); ?>