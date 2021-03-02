<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet">
    <link href="<?php bloginfo('template_url'); ?>/css/bootstrap.css" rel="stylesheet">
    <link href="<?php bloginfo('template_url'); ?>/css/font-awesome.css" rel="stylesheet">
    <title><?php bloginfo('name'); ?></title>

    <style>
      header
        {
            background-image: url(<?php echo get_theme_mod('image_header',get_bloginfo('template_url').'/img/ficus.jpg'); ?>) !important;
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            height: auto;


        }
    </style>
    
</head>
<body>
    
    <header >
    
        <nav class="navbar navbar-default animate__animated animate__backInLeft " >
            <div class="container-fluid">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <?php if(has_custom_logo()) : ?>
                  <a class="navbar-brand"><?php the_custom_logo(); ?></a>
                <?php else:?>
                  <a class="navbar-brand" id="navbar-brand" href="#">Ficus</a>
                <?php endif; ?>
              
              </div>
              <div class="collapse navbar-collapse" id="myNavbar">
                <ul >
                <?php
                    wp_nav_menu(array(
                    'theme_location'  => 'primary',
                    'depth'           => 2,
                    'container'       => false,
                    'menu_class'      => 'nav navbar-nav',
                   
                    ));
                ?>
                        
                </ul>
            
                    <form class="navbar-form navbar-right" method="get"  action="<?php esc_url(home_url('/')); ?>">
                        <div class="form-group">
                          <input type="text" class="form-control" name="s" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default-navbar">Submit</button>
                      </form>
          
              </div>
            </div>
          </nav>
          <div class="hero-content  animate__animated animate__backInRight col-6">
              <h1><?php echo get_theme_mod('title_header','FICUS MICROCARPA GINSENG'); ?></h1>
              <a href="<?php echo get_theme_mod('fb_link','https://www.facebook.com/'); ?>" class="btn btn-default">Facebook</a>
              <a href="<?php echo get_theme_mod('instagram_link','https://www.instagram.com/'); ?>" class="btn btn-default">Instagram</a>
              <a href="<?php echo get_theme_mod('linkedin_link','https://www.linkedin.com/'); ?>" class="btn btn-default">Linkedin</a>
         </div>
    </header>