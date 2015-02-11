<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	global $page, $paged;
	wp_title( '|', true, 'right' );
	bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'tie' ), max( $paged, $page ) );
	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>
    


</head>
<body id="top" <?php body_class(); ?>>
	<div class="background-cover"></div>
	<div class="wrapper">
	<?php $fixed = $transparent = $logo_margin = $head_layout = ''; ?>
	<?php if( tie_get_option( 'haeder_fix' ) ) $fixed = ' fixed-head' ?>
	<?php if( tie_get_option( 'haeder_transparent' ) ) $transparent = ' trans' ?>
	<?php if( tie_get_option( 'header_layout' )== 2 ) $head_layout = ' layout2' ?>
	<header class="header<?php echo $head_layout . $fixed . $transparent?>">
		<div class="header-bar"></div>
		<div class="header-content">
            <a title="<?php bloginfo('name'); ?>" href="<?php echo home_url(); ?>/">
            <?php
            if(header_image()) { ?>
                
                <h1 class="logo"><img src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>"  height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" /></h1>
               
            <?php } else { ?>
            
                <h1 class="logo"><?php bloginfo('name'); ?></h1>
                <h2 class="tagline"><?php bloginfo('description'); ?></h2>
                        
            <?php } ?> 
            </a>   
			
			<?php tie_get_social( 'yes' , 24 , 'tooldown' ); ?>
			<div class="search-block">
				<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
					<input class="search-button" type="submit" value="<?php __( 'Search' , 'tie' ) ?>" />	
					<input type="text" id="s" name="s" value="<?php _e( 'Search...' , 'tie' ) ?>" onfocus="if (this.value == '<?php _e( 'Search...' , 'tie' ) ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e( 'Search...' , 'tie' ) ?>';}"  />
				</form>
			</div><!-- .search-block /-->
			
			<div class="clear"></div>
		</div>	
		
		<nav id="main-nav">
			<?php wp_nav_menu( array( 'container_class' => 'main-menu', 'theme_location' => 'primary' ,'fallback_cb' => 'tie_nav_fallback'  ) ); ?>
			<?php echo tie_alternate_menu( array( 'menu_name' => 'primary', 'id' => 'main-menu-mob' ) ) ?>
		</nav><!-- .main-nav /-->
	</header><!-- #header /-->

	<?php tie_include( 'welcome' ); // Get Welcome Message template ?>	
	<?php tie_banner('banner_top' , '<div class="ads-top">' , '</div>' ); ?>

<?php 
$sidebar = '';

if( tie_get_option( 'sidebar_pos' ) == 'left' ) $sidebar = ' sidebar-left';
if( is_single() || is_page() ){
	$get_meta = get_post_custom($post->ID);
	
	if( !empty($get_meta["tie_sidebar_pos"][0]) ){
		$sidebar_pos = $get_meta["tie_sidebar_pos"][0];

		if( $sidebar_pos == 'left' ) $sidebar = ' sidebar-left';
		elseif( $sidebar_pos == 'full' ) $sidebar = ' full-width';
		elseif( $sidebar_pos == 'right' ) $sidebar = ' sidebar-right';
	}
}
$container = "content-container";
if( tie_get_option( 'on_home' ) == 'grid' && !is_singular() ) {
	$container = 'main-content';
	$sidebar = '';
}

?>
	<div id="<?php echo $container ; ?>" class="container<?php echo $sidebar ; ?>">