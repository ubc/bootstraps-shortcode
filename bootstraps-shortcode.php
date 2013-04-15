<?php
/*
Plugin Name: Bootstraps shortcode
Plugin URI: 
Description: A brief description of the Plugin.
Version: The Plugin's Version Number, e.g.: 1.0
Author: Name Of The Plugin Author
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/
//shows parent link and title
function ed_parent($atts) {
return '<a href="' . get_bloginfo('url') . '" title="'. get_bloginfo() . '">Home</a> >
<a href="'. get_permalink($post->post_parent) . '">'. get_the_title($post->post_parent) .'</a>';
}
add_shortcode( 'parent', 'ed_parent' );

//thumbnails short with class works should work with column shortcode
function thumbnails_shortcode( $atts, $content = null ) {
   return '<div class="thumbnails">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'thumbnails', 'thumbnails_shortcode' );

//Div class filler for custom boxes
function container_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
      'style' => 'class',
      ), $atts ) );
   return '<div class="' . esc_attr($style) . '">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'container', 'container_shortcode' );

//labels shortcode
function label_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
      'name' => 'block',
      ), $atts ) );
   return '<span class="label label-' . esc_attr($class) . '">' . do_shortcode($content) . '</span>';
}
add_shortcode( 'label', 'label_shortcode' );

//alert shortcode
function alert_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
      'name' => 'block',
      ), $atts ) );
   return '<span class="alert alert-' . esc_attr($class) . '">' . do_shortcode($content) . '</span>';
}
add_shortcode( 'alert', 'alert_shortcode' );

//link with href button shortcode
function button_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
      'name' => 'primary',
	  'link' => 'href'
      ), $atts ) );
   return '<a href="' . esc_attr($link) . '" class="btn btn-' . esc_attr($name) . '">' . do_shortcode($content) . '</a>';
}
add_shortcode( 'button', 'button_shortcode' );

//span button shortcode
function spanbutton_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
      'name' => 'primary',
      ), $atts ) );
   return '<span class="btn btn-' . esc_attr($class) . '">' . do_shortcode($content) . '</span>';
}
add_shortcode( 'buttoncon', 'spanbutton_shortcode' );

//icon button shortcode, use the icon name without the icon-. Defaults to the globe.
function icon_shortcode( $atts ) {
	extract( shortcode_atts( array(
      'name' => 'plane',
      ), $atts ) );
   return '<i class="icon-' . esc_attr($name) . '"></i>';
}
add_shortcode( 'icon', 'icon_shortcode' );


//shows breadcurmbs
function wp_bac_breadcrumb($atts) {   
    //Variable (symbol >> encoded) and can be styled separately.
    //Use >> for different level categories (parent >> child >> grandchild)
            $delimiter = '<span class="delimiter"> &raquo; </span>'; 
    //Use bullets for same level categories ( parent . parent )
    $delimiter1 = '<span class="delimiter1"> &bull; </span>';
     
    //text link for the 'Home' page
            $main = 'Home';  
    //Display only the first 30 characters of the post title.
            $maxLength= 30;
     
    //variable for archived year 
    $arc_year = get_the_time('Y'); 
    //variable for archived month 
    $arc_month = get_the_time('F'); 
    //variables for archived day number + full
    $arc_day = get_the_time('d');
    $arc_day_full = get_the_time('l');  
     
    //variable for the URL for the Year
    $url_year = get_year_link($arc_year);
    //variable for the URL for the Month    
    $url_month = get_month_link($arc_year,$arc_month);
 
    /*is_front_page(): If the front of the site is displayed, whether it is posts or a Page. This is true 
    when the main blog page is being displayed and the 'Settings > Reading ->Front page displays' 
    is set to "Your latest posts", or when 'Settings > Reading ->Front page displays' is set to 
    "A static page" and the "Front Page" value is the current Page being displayed. In this case 
    no need to add breadcrumb navigation. is_home() is a subset of is_front_page() */
     
    //Check if NOT the front page (whether your latest posts or a static page) is displayed. Then add breadcrumb trail.
    if (!is_front_page()) {         
        //If Breadcrump exists, wrap it up in a div container for styling. 
        //You need to define the breadcrumb class in CSS file.
        return '<div class="breadcrumb">';
         
        //global WordPress variable $post. Needed to display multi-page navigations. 
        global $post, $cat;         
        //A safe way of getting values for a named option from the options database table. 
        $homeLink = get_option('home'); //same as: $homeLink = get_bloginfo('url');
        //If you don't like "You are here:", just remove it.
        return 'You are here: <a href="' . $homeLink . '">' . $main . '</a>' . $delimiter;    
         
        //Display breadcrumb for single post
        if (is_single()) { //check if any single post is being displayed.           
            //Returns an array of objects, one object for each category assigned to the post.
            //This code does not work well (wrong delimiters) if a single post is listed 
            //at the same time in a top category AND in a sub-category. But this is highly unlikely.
            $category = get_the_category();
            $num_cat = count($category); //counts the number of categories the post is listed in.
             
            //If you have a single post assigned to one category.
            //If you don't set a post to a category, WordPress will assign it a default category.
            if ($num_cat <=1)  //I put less or equal than 1 just in case the variable is not set (a catch all).
            {
                return get_category_parents($category[0],  true,' ' . $delimiter . ' ');
                //Display the full post title.
                return ' ' . get_the_title(); 
            }
            //then the post is listed in more than 1 category.  
            else { 
                //Put bullets between categories, since they are at the same level in the hierarchy.
                return the_category( $delimiter1, multiple); 
                    //Display partial post title, in order to save space.
                    if (strlen(get_the_title()) >= $maxLength) { //If the title is long, then don't display it all.
                        return ' ' . $delimiter . trim(substr(get_the_title(), 0, $maxLength)) . ' ...';
                    }                         
                    else { //the title is short, display all post title.
                        return ' ' . $delimiter . get_the_title(); 
                    } 
            }           
        } 
        //Display breadcrumb for category and sub-category archive
        elseif (is_category()) { //Check if Category archive page is being displayed.
            //returns the category title for the current page. 
            //If it is a subcategory, it will display the full path to the subcategory. 
            //Returns the parent categories of the current category with links separated by '»'
            return 'Archive Category: "' . get_category_parents($cat, true,' ' . $delimiter . ' ') . '"' ;
        }       
        //Display breadcrumb for tag archive        
        elseif ( is_tag() ) { //Check if a Tag archive page is being displayed.
            //returns the current tag title for the current page. 
            return 'Posts Tagged: "' . single_tag_title("", false) . '"';
        }        
        //Display breadcrumb for calendar (day, month, year) archive
        elseif ( is_day()) { //Check if the page is a date (day) based archive page.
            return '<a href="' . $url_year . '">' . $arc_year . '</a> ' . $delimiter . ' ';
            return '<a href="' . $url_month . '">' . $arc_month . '</a> ' . $delimiter . $arc_day . ' (' . $arc_day_full . ')';
        } 
        elseif ( is_month() ) {  //Check if the page is a date (month) based archive page.
            return '<a href="' . $url_year . '">' . $arc_year . '</a> ' . $delimiter . $arc_month;
        } 
        elseif ( is_year() ) {  //Check if the page is a date (year) based archive page.
            return $arc_year;
        }       
        //Display breadcrumb for search result page
        elseif ( is_search() ) {  //Check if search result page archive is being displayed. 
            return 'Search Results for: "' . get_search_query() . '"';
        }       
        //Display breadcrumb for top-level pages (top-level menu)
        elseif ( is_page() && !$post->post_parent ) { //Check if this is a top Level page being displayed.
            return get_the_title();
        }           
        //Display breadcrumb trail for multi-level subpages (multi-level submenus)
        elseif ( is_page() && $post->post_parent ) {  //Check if this is a subpage (submenu) being displayed.
            //get the ancestor of the current page/post_id, with the numeric ID 
            //of the current post as the argument. 
            //get_post_ancestors() returns an indexed array containing the list of all the parent categories.                
            $post_array = get_post_ancestors($post);
             
            //Sorts in descending order by key, since the array is from top category to bottom.
            krsort($post_array); 
             
            //Loop through every post id which we pass as an argument to the get_post() function. 
            //$post_ids contains a lot of info about the post, but we only need the title. 
            foreach($post_array as $key=>$postid){
                //returns the object $post_ids
                $post_ids = get_post($postid);
                //returns the name of the currently created objects 
                $title = $post_ids->post_title; 
                //Create the permalink of $post_ids
                return '<a href="' . get_permalink($post_ids) . '">' . $title . '</a>' . $delimiter;
            }
            the_title(); //returns the title of the current page.               
        }           
        //Display breadcrumb for author archive   
        elseif ( is_author() ) {//Check if an Author archive page is being displayed.
            global $author;
            //returns the user's data, where it can be retrieved using member variables. 
            $user_info = get_userdata($author);
            return  'Archived Article(s) by Author: ' . $user_info->display_name ;
        }       
        //Display breadcrumb for 404 Error 
        elseif ( is_404() ) {//checks if 404 error is being displayed 
            return  'Error 404 - Not Found.';
        }       
        else {
            //All other cases that I missed. No Breadcrumb trail.
        }
       return '</div>';     
    }   
}
add_shortcode( 'breadcrumbs', 'wp_bac_breadcrumb' );

