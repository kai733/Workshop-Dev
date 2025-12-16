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
  wp_enqueue_style('main-style', get_template_directory_uri() . '/style.css', false);
}
add_action('wp_enqueue_scripts', 'add_style');

function add_script()
{
  wp_enqueue_script('main-js', get_template_directory_uri() . '/main.js', array(), false, true);
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
?>