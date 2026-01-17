<?php get_header(); ?>

<div class="wrapper">
    <div class="breadcrumb">
        <?php get_breadcrumb(); ?>
    </div>

    <h1>Résultats de recherche pour : "<?php echo get_search_query(); ?>"</h1>

    <?php
    $s = get_search_query();
    
    // --- Query for Events ---
    $args_events = array(
        'post_type' => 'event',
        's' => $s,
        'posts_per_page' => -1
    );
    $events_query = new WP_Query($args_events);

    // --- Query for Articles (Posts) ---
    // Strategy: (Search LIKE %s%) OR (Category LIKE %s%)
    // 1. Find Term IDs where name LIKE %s%
    $matching_terms = get_terms(array(
        'taxonomy' => 'category',
        'name__like' => $s,
        'fields' => 'ids'
    ));

    $post_ids_from_terms = array();
    if (!empty($matching_terms) && !is_wp_error($matching_terms)) {
        $term_query = new WP_Query(array(
            'post_type' => 'post',
            'tax_query' => array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'term_id',
                    'terms' => $matching_terms
                )
            ),
            'fields' => 'ids',
            'posts_per_page' => -1
        ));
        $post_ids_from_terms = $term_query->posts;
    }

    // 2. Find Post IDs from standard search
    $search_query_args = array(
        'post_type' => 'post',
        's' => $s,
        'fields' => 'ids',
        'posts_per_page' => -1
    );
    $search_ids_query = new WP_Query($search_query_args);
    $post_ids_from_search = $search_ids_query->posts;

    // 3. Merge IDs
    $all_post_ids = array_unique(array_merge($post_ids_from_terms, $post_ids_from_search));

    // 4. Final Query
    if (!empty($all_post_ids)) {
        $args_posts = array(
            'post_type' => 'post',
            'post__in' => $all_post_ids,
            'posts_per_page' => -1,
            'orderby' => 'post__in' // Optional: keep order or date? Default date usually fine
        );
        $posts_query = new WP_Query($args_posts);
    } else {
        // Empty query
        $posts_query = new WP_Query(array('post_type' => 'post', 'post__in' => [0]));
    }    
    // --- Query for Pages ---
    $args_pages = array(
        'post_type' => 'page',
        's' => $s,
        'posts_per_page' => -1
    );
    $pages_query = new WP_Query($args_pages);
    ?>

    <?php if (!$events_query->have_posts() && !$posts_query->have_posts() && !$pages_query->have_posts()): ?>
        <p>Aucun résultat trouvé.</p>
    <?php endif; ?>

    <!-- EVENTS SECTION -->
    <?php if ($events_query->have_posts()): ?>
        <div class="search-section">
            <h2>Événements</h2>
            <div class="upcoming-events">
                <?php while ($events_query->have_posts()): $events_query->the_post(); 
                    $postId = get_the_ID();
                    $event_day = get_field('event_day', $postId);
                    $description = get_field('event_description', $postId);
                    $image = get_field('event_image', $postId);
                    $event_start_hour = get_field('event_start_hour', $postId);
                    $event_end_hour = get_field('event_end_hour', $postId);
                    $event_place = get_field('event_place', $postId);
                ?>
                    <div class="agenda-event-card">
                        <div class="agenda-card-1">
                            <?php echo get_formatted_date_html($event_day); ?>
                        </div>
                        <div class="agenda-card-2">
                            <h3><?php the_title(); ?></h3>
                            <p><?php echo $description; ?></p>
                        </div>
                        <div class="agenda-card-3">
                            <?php if($image): ?><img src="<?php echo $image["url"]; ?>" alt="<?php echo $image["alt"]; ?>"><?php endif; ?>
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
                            <a class="button-3" href="<?php the_permalink(); ?>">On va plus loin ?</a>
                        </div>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- ARTICLES SECTION -->
    <?php if ($posts_query->have_posts()): ?>
        <div class="search-section">
            <h2>Articles</h2>
            <div class="blog-grid">
                <?php while ($posts_query->have_posts()): $posts_query->the_post(); 
                    $categories = get_the_category();
                    $image = get_field('image', get_the_ID());
                    $description = get_field('description', get_the_ID());
                ?>
                <a href="<?php the_permalink(); ?>" class="blog-card">
                    <div class="blog-card-inner">
                        <div class="card-top">
                            <div class="card-badges">
                                <?php foreach ($categories as $category): ?>
                                    <span class="badge <?php echo strtolower($category->name); ?>">
                                        <?php echo $category->name; ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                            <h3><?php the_title(); ?></h3>
                        </div>
                        <div class="card-below-image">
                            <div class="card-content">
                                <?php if($image): ?>
                                    <div class="card-image-wrapper">
                                        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                                    </div>
                                <?php endif; ?>
                                <p><?php echo $description; ?></p>
                            </div>
                            <div class="card-footer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="49" height="49" viewBox="0 0 49 49" fill="none">
                                    <path d="M14.2915 34.7085L34.7082 14.2918M34.7082 14.2918V34.7085M34.7082 14.2918H14.2915"
                                        stroke="#E7DCCF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- PAGES SECTION -->
    <?php if ($pages_query->have_posts()): ?>
        <div class="search-section">
            <h2>Pages</h2>
            <ul>
                <?php while ($pages_query->have_posts()): $pages_query->the_post(); ?>
                    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                <?php endwhile; wp_reset_postdata(); ?>
            </ul>
        </div>
    <?php endif; ?>

</div>

<?php get_footer(); ?>
