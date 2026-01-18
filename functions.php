<?php

function dd($vars)
{
  echo '<pre>';
  var_dump($vars);
  echo '<pre>';
  die('END');
}

function add_style()
{
  wp_enqueue_style('main-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'add_style');

function add_script()
{
  wp_enqueue_script('main-js', get_template_directory_uri() . '/main.js', array(), false, true);
  
  // Enqueue category filter script on blog page
  if (is_page('parlons-en')) {
    wp_enqueue_script('category-filter', get_template_directory_uri() . '/assets/js/category-filter.js', array(), false, true);
  }
  
  // Enqueue hamburger menu script globally
  wp_enqueue_script('hamburger-menu', get_template_directory_uri() . '/assets/js/hamburger-menu.js', array(), false, true);
}
add_action('wp_enqueue_scripts', 'add_script');

function custom_register_nav_menu()
{
  register_nav_menus(array(
    'primary_menu' => 'Menu principal',
  ));
}
add_action('after_setup_theme', 'custom_register_nav_menu', 0);

function my_custom_event_cpt()
{
  $labels = array(
    'name' => _x('Événements', 'Post Type General Name', 'text_domain'),
    'singular_name' => _x('Événement', 'Post Type Singular Name', 'text_domain'),
    'menu_name' => __('Événement', 'text_domain'),
    'name_admin_bar' => __('Événement', 'text_domain'),
    'archives' => __('Archives des Événements', 'text_domain'),
    'attributes' => __('Attributs des Événement', 'text_domain'),
    'parent_item_colon' => __('Parent Event:', 'text_domain'),
    'all_items' => __('Tous les événements', 'text_domain'),
    'add_new_item' => __('Ajouter un événement', 'text_domain'),
    'add_new' => __('Ajouter nouveau', 'text_domain'),
    'new_item' => __('Nouveau Événement', 'text_domain'),
    'edit_item' => __('Modifier Événement', 'text_domain'),
    'update_item' => __('Mettre à jour événement', 'text_domain'),
    'view_item' => __('Voir Événement', 'text_domain'),
    'view_items' => __('Voir Événements', 'text_domain'),
    'search_items' => __('Chercher Événements', 'text_domain'),
    'not_found' => __("Pas d'événements trouvé", 'text_domain'),
    'not_found_in_trash' => __("Pas d'événements trouvé dans la corbeille", 'text_domain'),
    'featured_image' => __('Flyer / Image', 'text_domain'),
    'set_featured_image' => __("Définir l'image d'événement", 'text_domain'),
    'remove_featured_image' => __("Enlever l'image d'événement", 'text_domain'),
    'use_featured_image' => __("Utiliser comme image d'événement", 'text_domain'),
    'insert_into_item' => __("Insérer dans l'événement", 'text_domain'),
    'uploaded_to_this_item' => __('Uploadeder dans cet événement', 'text_domain'),
    'items_list' => __("Liste des événements", 'text_domain'),
    'items_list_navigation' => __('Navigation liste des événements', 'text_domain'),
    'filter_items_list' => __('Filtrer liste des événements', 'text_domain'),
  );
  $args = array(
    'label' => __('Événement', 'text_domain'),
    'description' => __('Type de post pour les événements', 'text_domain'),
    'labels' => $labels,
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
    'taxonomies' => array('category', 'post_tag'), // Uses standard WP categories?
    'hierarchical' => false,
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'menu_icon' => 'dashicons-calendar-alt', // calendar icon
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'can_export' => true,
    'has_archive' => true,
    'exclude_from_search' => false,
    'publicly_queryable' => true,
    'capability_type' => 'post',
    'show_in_rest' => true,
    'rewrite' => array('slug' => 'evenements', 'with_front' => false),
  );
  register_post_type('event', $args);
}
add_action('init', 'my_custom_event_cpt', 0);

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

function get_breadcrumb()
{
  echo '<a href="' . home_url() . '" rel="nofollow">Accueil</a>';

  if (is_home() || is_front_page()) {
      return;
  }

  // Separator
  $sep = ' &nbsp;&nbsp;&#187;&nbsp;&nbsp; ';

  if (is_singular('post')) {
      // For Blog Posts: Accueil >> Parlons en >> Title
      // "Parlons en" page ID or slug. Assuming we can fallback to finding it or hardcoded slug if needed.
      // Better to find the page by path 'parlons-en' ideally, or assume ID.
      // Let's try to get page by path.
      $parlons_en = get_page_by_path('parlons-en');
      $parlons_en_link = $parlons_en ? get_permalink($parlons_en->ID) : home_url('/parlons-en');
      
      echo $sep;
      echo '<a href="' . $parlons_en_link . '">Parlons en</a>';
      echo $sep;
      the_title();

  } elseif (is_singular('event')) {
      // For Events: Accueil >> Agenda >> Title
      $agenda = get_page_by_path('agenda');
      $agenda_link = $agenda ? get_permalink($agenda->ID) : home_url('/agenda');

      echo $sep;
      echo '<a href="' . $agenda_link . '">Agenda</a>';
      echo $sep;
      the_title();

  } elseif (is_category()) {
      echo $sep;
      the_category(' &bull; ');

  } elseif (is_page()) {
      echo $sep;
      the_title();

  } elseif (is_search()) {
      echo $sep . "Search Results for... ";
      echo '"<em>';
      echo get_search_query();
      echo '</em>"';
  }
}

?>