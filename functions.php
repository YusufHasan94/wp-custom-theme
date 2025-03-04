<?php
/*
* My theme function
*/

//theme title
add_theme_support('title-tag');


//theme css and  js files
function yusuf_css_js_calling(){
    wp_enqueue_style('raj-style', get_stylesheet_uri());
    wp_register_style('bootstrap', get_template_directory_uri().'/css/bootstrap.css', array(), '5.3.3', 'all');
    wp_enqueue_style('bootstrap');
    
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap', get_template_directory_uri().'/js/bootstrap.js', array(), '5.3.3', 'true');
    
};

add_action( 'wp_enqueue_scripts', 'yusuf_css_js_calling');

//theme logo customize
function yusuf_customizer_register($wp_customize){
    $wp_customize->add_section('yusuf_header_area', array(
        'title'=>_('Header Area', 'customrajtheme'),
        'description'=> 'If you interested to update your header area, you can do it here.',
    ));

    $wp_customize->add_setting('yusuf_logo', array(
        'default'=>get_bloginfo('template_directory').'/img/logo1.png',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'yusuf_logo', array(
        'label'=> 'logo upload',
        'setting'=> 'yusuf_logo',
        'section'=> 'yusuf_header_area',
    ) ));

    //menu control
    $wp_customize->add_section('yusuf_menu_option', array(
        'title'=>__('Menu Position Option', 'customrajtheme'),
    ));
    $wp_customize->add_setting('yusuf_menu_position', array(
        'default'=> 'right_menu',
    ));
    $wp_customize->add_control('yusuf_menu_position', array(
        'label'=> 'Menu Position',
        'description'=> 'Change your menu position',
        'setting'=> 'yusuf_menu_position',
        'section'=> 'yusuf_menu_option',
        'type'=> 'radio',
        'choices'=> array(
            'right_menu'=> 'Right Menu',
            'left_menu'=> 'Left Menu',
            'center_menu'=> 'Center Menu'
        )
    ));
    
    //footer section
    $wp_customize->add_section('yusuf_footer_option', array(
        'title'=>__('Footer Area', 'customrajtheme'),
    ));
    $wp_customize->add_setting('yusuf_copyright_section', array(
        'default'=> '&copy; all rights reserved.',
    ));
    $wp_customize->add_control('yusuf_copyright_section', array(
        'label'=> 'Copyright Text',
        'description'=> 'Change your copyright message',
        'setting'=> 'yusuf_copyright_section',
        'section'=> 'yusuf_footer_option',
    ));

} 

add_action('customize_register', 'yusuf_customizer_register');

register_nav_menu( 'main_menu', __('Main Menu', 'customrajtheme'));

//walker nav

function yusuf_walker_nav($item_output, $item, $args){
    if(!$itme->description){
        $item_output = str_replace($args->link_after . '</a>', '<span class="walker_nav">'.$item->description.'</span>' . $args->link_after . '</a>', $item_output);
    }
    return $item_output;
}

add_filter( 'walker_nav_menu_start_el', 'yusuf_walker_nav', 10, 3);