<?php

function ficus_customize_register($wp_customize){
	//HEADER*******************************************************************
        $wp_customize->add_section('header', array(
            'title'          => __('Header', 'ficus'),
            'description'    => sprintf( __('Options for showcase area', 'Ficus')
            ),
            'priority'       => 130,
        ));

        // Image Header Setting
		  $wp_customize->add_setting('image_header', array(
		    'default' => get_bloginfo('template_directory') . '/img/ficus.jpg',
		    'type'    => 'theme_mod'

		 ));

		 // Image Header Control
		 $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'image_header', array(
		     'label'    => __('Background Image', 'Ficus'),
		     'section'  => 'header',
		     'settings' => 'image_header',
		     'priority' => 1,
		 )));
        
		// Text Setting
		$wp_customize->add_setting( 'title_header', array(
			'default'              => _x('FICUS MICROCARPA GINSENG', 'Ficus'),
			'type'                 => 'theme_mod'
		));

		// Text Control
		$wp_customize->add_control( 'title_header', array(
			'label'    => __('Title header', 'Ficus'),
			'section'  => 'header',
			'priority' => 4,
        ));
        
        // Facebook Setting
		$wp_customize->add_setting( 'fb_link', array(
			'default'              => _x('https://www.facebook.com/', 'Ficus'),
			'type'                 => 'theme_mod'
		));

		// Facebook Control
		$wp_customize->add_control( 'fb_link', array(
			'label'    => __('Facebook link', 'Ficus'),
			'section'  => 'header',
			'priority' => 4,
        ));
        
        // Instagram Setting
		$wp_customize->add_setting( 'instagram_link', array(
			'default'              => _x('https://www.instagram.com/', 'Ficus'),
			'type'                 => 'theme_mod'
		));

		// Instagram Control
		$wp_customize->add_control( 'instagram_link', array(
			'label'    => __('Instagram link', 'Ficus'),
			'section'  => 'header',
			'priority' => 4,
        ));
        
        // Linkedin Setting
		$wp_customize->add_setting( 'linkedin_link', array(
			'default'              => _x('https://www.linkedin.com/', 'Ficus'),
			'type'                 => 'theme_mod'
		));

		// Linkedin Control
		$wp_customize->add_control( 'linkedin_link', array(
			'label'    => __('Linkedin link', 'Ficus'),
			'section'  => 'header',
			'priority' => 4,
		));
	 //END HEADER*******************************************************************
	 
	 //FOOTER *******************************************************************
	 $wp_customize->add_section('footer', array(
		'title'          => __('Footer', 'cleancut'),
		'description'    => sprintf( __('Options for showcase area', 'Ficus')
		),
		'priority'       => 130,
	));

    //Title Footer Setting
	$wp_customize->add_setting( 'title_footer', array(
		'default'              => _x('FOOTER CONTENT', 'Ficus'),
		'type'                 => 'theme_mod'
	));
	//Title Footer Control
	$wp_customize->add_control( 'title_footer', array(
		'label'    => __('Title footer', 'Ficus'),
		'section'  => 'footer',
		'priority' => 4,
	));
	//Text Footer Setting
	$wp_customize->add_setting( 'text_footer', array(
		'default'              => _x('FOOTER TXT', 'Ficus'),
		'type'                 => 'theme_mod'
	));
	//Text Footer Control
	$wp_customize->add_control( 'text_footer', array(
		'label'    => __('Text footer', 'Ficus'),
		'section'  => 'footer',
		'priority' => 4,
	));

		//Link1 Footer Setting
		$wp_customize->add_setting( 'link1_footer', array(
			'default'              => _x('Link 1', 'Ficus'),
			'type'                 => 'theme_mod'
		));
		//Link1 Footer Control
		$wp_customize->add_control( 'link1_footer', array(
			'label'    => __('Link1 footer', 'Ficus'),
			'section'  => 'footer',
			'priority' => 4,
		));


		//Link2 Footer Setting
		$wp_customize->add_setting( 'link2_footer', array(
			'default'              => _x('Link 2', 'Ficus'),
			'type'                 => 'theme_mod'
		));
		//Link2 Footer Control
		$wp_customize->add_control( 'link2_footer', array(
			'label'    => __('Link2 footer', 'Ficus'),
			'section'  => 'footer',
			'priority' => 4,
		));

		//Link3 Footer Setting
	   $wp_customize->add_setting( 'link3_footer', array(
			'default'              => _x('Link 3', 'Ficus'),
			'type'                 => 'theme_mod'
		));
		//Link3 Footer Control
		$wp_customize->add_control( 'link3_footer', array(
		'label'    => __('Link3 footer', 'Ficus'),
		'section'  => 'footer',
		'priority' => 4,
		));


		//Link4 Footer Setting
		$wp_customize->add_setting( 'link4_footer', array(
			'default'              => _x('Link 4', 'Ficus'),
			'type'                 => 'theme_mod'
		));
		//Link4 Footer Control
		$wp_customize->add_control( 'link4_footer', array(
			'label'    => __('Link4 footer', 'Ficus'),
			'section'  => 'footer',
			'priority' => 4,
		));

    }
add_action('customize_register','ficus_customize_register');