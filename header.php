<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php bloginfo('name'); ?></title>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <header>
    <?php
    $header = get_field("header", "options");
    ?>
    <div class="header">
      <div class="header-wrapper">
        <div class="header-left">
          <div class="header-1">
            <a href="<?php echo $header["emanciper_link"]["url"] ?>">
              <img src="<?php echo $header["emanciper_logo"]["url"] ?>"
                alt="<?php echo $header["emanciper_logo"]["alt"] ?>">
            </a>
          </div>
          <div class="header-2">
            <?php foreach ($header["links_1"] as $link): ?>
              <a href="<?php echo $link["page_link"]["url"] ?>"><?php echo $link["page_link"]["title"] ?></a>
            <?php endforeach ?>
          </div>
        </div>
        <div class="header-right">
          <div class="header-3">
            <form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
              <input type="search" class="search-field" placeholder="Rechercher..." value="<?php echo get_search_query(); ?>" name="s" />
              <button type="submit" class="search-submit">
                <!-- SVG Icon for Search -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="11" cy="11" r="8"></circle>
                  <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
              </button>
            </form>
            <?php foreach ($header["links_2"] as $link): ?>
              <a href="<?php echo $link["page_link"]["url"] ?>"><?php echo $link["page_link"]["title"] ?></a>
            <?php endforeach ?>
          </div>
        </div>
        
        <!-- Hamburger Button -->
        <button class="hamburger-btn" aria-label="Toggle menu" aria-expanded="false">
          <span></span>
          <span></span>
          <span></span>
        </button>
      </div>
      
      <!-- Mobile Navigation -->
      <div class="mobile-nav">
        <div class="mobile-nav-content">
          <form role="search" method="get" class="search-form mobile-search" action="<?php echo home_url('/'); ?>">
            <input type="search" class="search-field" placeholder="Rechercher..." value="<?php echo get_search_query(); ?>" name="s" />
            <button type="submit" class="search-submit">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
              </svg>
            </button>
          </form>
          
          <nav class="mobile-nav-links">
            <?php foreach ($header["links_1"] as $link): ?>
              <a href="<?php echo $link["page_link"]["url"] ?>"><?php echo $link["page_link"]["title"] ?></a>
            <?php endforeach ?>
            <?php foreach ($header["links_2"] as $link): ?>
              <a href="<?php echo $link["page_link"]["url"] ?>"><?php echo $link["page_link"]["title"] ?></a>
            <?php endforeach ?>
          </nav>
        </div>
      </div>
    </div>
  </header>
  <?php ?>