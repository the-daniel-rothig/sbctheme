<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
  <!--[if IE 8]>
    <script>
      (function(){if(window.opera){return;}
       setTimeout(function(){var a=document,g,b={families:(g=
       ["nta"]),urls:["<?php get_template_directory_uri() . '/css/fonts-ie8.css'; ?>"]},
      c="<?php get_template_directory_uri() . '/js/vendor/goog/webfont-debug.js'; ?>",d="script",
      e=a.createElement(d),f=a.getElementsByTagName(d)[0],h=g.length;WebFontConfig
      ={custom:b},e.src=c,f.parentNode.insertBefore(e,f);for(;h=h-1;a.documentElement
      .className+=' wf-'+g[h].replace(/\s/g,'').toLowerCase()+'-n4-loading');},0)
      })()
    </script>
  <![endif]-->	
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>

  <link rel="shortcut icon" href="<?php get_template_directory_uri() . '/images/favicon.ico'; ?>" type="image/x-icon" />
  <link rel="mask-icon" href="<?php get_template_directory_uri() . '/images/gov.uk_logotype_crown.svg';?>" color="#0b0c0c">
  <link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php get_template_directory_uri() . '/images/apple-touch-icon-152x152.png'?>">
  <link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php get_template_directory_uri() . '/images/apple-touch-icon-120x120.png'?>">
  <link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?php get_template_directory_uri() . '/images/apple-touch-icon-76x76.png';?>">
  <link rel="apple-touch-icon-precomposed" href="<?php get_template_directory_uri() . '/images/apple-touch-icon-60x60.png';?>">
  
	<?php wp_head(); ?>
</head>

<body class="js-disabled">
<script>document.body.className = ((document.body.className) ? document.body.className.replace(" js-disabled","") + ' js-enabled' : 'js-enabled');</script>
    <div id="skiplink-container">
      <div>
        <a href="#content" class="skiplink">"Skip to main content"</a>
      </div>
    </div>

    <div id="global-cookie-message">
      <p>This site uses cookies to make the site simpler. <a href="https://www.gov.uk/help/cookies">Find out more about cookies</a></p>
    </div>
      <div role="banner" id="global-header" class="with-proposition">
      <div class="header-wrapper">
        <div class="header-global">
          <div class="header-logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" id="logo" class="content">
              <img src="<?php echo get_template_directory_uri() . '/images/gov.uk_logotype_crown_invert_trans.png'; ?>" width="35" height="31" alt=""> SBC
            </a>
          </div>
        </div>
        <div class="header-proposition">
          <div class="content">
            <a href="#proposition-links" class="js-header-toggle menu">Menu</a>
            <nav id="proposition-menu">
              <a href="<?php echo esc_url( home_url( '/' ) ); ?>" id="proposition-name">Small Business Commissioner</a>
              <ul id="proposition-links">
                <?php wp_list_pages(array(
                    'depth' => 1,
                    'title_li' =>null,
                    'exclude' =>get_page_by_title('home')->ID
                )); ?>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <div id="global-header-bar"></div>

<div id="page" class="site">
	<div class="site-inner">
		<div id="content" class="site-content">
