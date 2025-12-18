<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
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
            <a href="<?php echo $header["emanciper_link"] ?>">
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
            <?php foreach ($header["links_2"] as $link): ?>
              <a href="<?php echo $link["page_link"]["url"] ?>"><?php echo $link["page_link"]["title"] ?></a>
            <?php endforeach ?>
          </div>
        </div>
      </div>
    </div>
  </header>
  <?php ?>