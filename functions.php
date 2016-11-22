<?php
/**
 * SBC Theme functinos
 *
 * @package SBC
 * @subpackage SBCTheme
 * @since SBC Theme 1.0
 */

/**
 * SBC Theme only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'sbctheme_setup' ) ) :
function sbctheme_setup() {
	load_theme_textdomain( 'twentysixteen' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

	add_editor_style( array( 'css/editor-style.css', 'css/govuk-template.css', 'css/main.css', 'css/sbctheme.css', 'css/sbctheme_editor.css' ) );
  
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'sbctheme_setup' );

/**
 * Registers a widget area.
 */
function sbctheme_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'twentysixteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'sbctheme_widgets_init' );

/**
 * Enqueues scripts and styles.
 *
 * @since SBCTheme 1.0
 */
function sbc_scripts() {
	wp_enqueue_style( 'twentysixteen-sbctemplatecss', get_template_directory_uri() . '/css/govuk-template.css', array(), false, 'screen');
	
	wp_enqueue_style( 'twentysixteen-sbctemplatecss6', get_template_directory_uri() . '/css/govuk-template-ie6.css', array('twentysixteen-sbctemplatecss'), false, 'screen');
	wp_style_add_data('twentysixteen-sbctemplatecss6', 'conditional', 'IE 6');

	wp_enqueue_style( 'twentysixteen-sbctemplatecss7', get_template_directory_uri() . '/css/govuk-template-ie7.css', array('twentysixteen-sbctemplatecss'), false, 'screen');
	wp_style_add_data('twentysixteen-sbctemplatecss7', 'conditional', 'IE 7');

	wp_enqueue_style( 'twentysixteen-sbctemplatecss8', get_template_directory_uri() . '/css/govuk-template-ie8.css', array('twentysixteen-sbctemplatecss'), false, 'screen');
	wp_style_add_data('twentysixteen-sbctemplatecss8', 'conditional', 'IE 8');

	wp_enqueue_style( 'twentysixteen-sbctemplatecssprint', get_template_directory_uri() . '/css/govuk-template-print.css', array('twentysixteen-sbctemplatecss'), false, 'print');

	wp_enqueue_style( 'twentysixteen-sbctemplatecss-main', get_template_directory_uri() . '/css/main.css', array(), false, 'screen');

	wp_enqueue_style( 'twentysixteen-sbctemplatefonts', get_template_directory_uri() . '/css/fonts.css', array('twentysixteen-sbctemplatecss'), false, 'all');
	
	wp_enqueue_style( 'twentysixteen-sbctemplatefontsie8', get_template_directory_uri() . '/css/fonts-ie8.css', array('twentysixteen-sbctemplatecss'), false, 'all');
	wp_style_add_data( 'twentysixteen-sbctemplatefontsie8', 'conditional', 'lt IE 9');

	wp_enqueue_style( 'twentysixteen-sbctheme', get_template_directory_uri() . '/css/sbctheme.css', array('twentysixteen-sbctemplatecss'), false, 'all');


	wp_enqueue_script( 'twentysixteen-sbctemplateiejs', get_template_directory_uri() . '/js/ie.js', array('twentysixteen-sbctemplatecss'));
	wp_script_add_data( 'twentysixteen-sbctemplateiejs', 'conditional', 'lt IE 9');

}
add_action( 'wp_enqueue_scripts', 'sbc_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

//adds govuk classes to content

function sbctheme_govukcontent( $content ) {
	if (''===$content) {
		return $content;
	}
	$dom = new DOMDocument;
	$dom -> loadHtml($content);

	$tagsToClasses = array(
		'blockquote' => 'panel panel-border-wide',
		'h1' => 'heading-xlarge',
		'h2' => 'heading-large',
		'h3' => 'heading-medium',
		'h4' => 'heading-small',
		'h5' => 'heading-xsmall',
		'ol' => 'list list-number',
		'ul' => 'list list-bullet'
	);

	foreach($tagsToClasses as $tagname => $classname) {
		foreach ($dom->getElementsByTagName($tagname) as $tag) {
			$tag->setAttribute('class', $tag->getAttribute('class') . ' ' . $classname);
		}
	}

	//make first non-empty paragraph the lede
	if (is_single()) {
		foreach ($dom->getElementsByTagName('p') as $key => $tag) {
			if ($tag->nodeValue !== '') {
				$tag->setAttribute('class', $tag->getAttribute('class') . ' lede');
				break 1;
			}		
		}
  }

	return $dom->saveHtml();
}
add_filter ('the_content', 'sbctheme_govukcontent');


require get_template_directory() .'/deskpro-api-php-master/deskpro-api.php';

	
function sbctheme_trycreateticket() {
	if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
		return null;
	}
	$deskpro_url   = isset($_ENV['DESKPRO_URI']) ? $_ENV['DESKPRO_URI'] : 'http://sbctrial.deskpro.com';  
	$api_key       = isset($_ENV['DESKPRO_KEY']) ? $_ENV['DESKPRO_KEY'] : '1:YYPDA88C5X36CS32P3WQSRJM4';                  
	$api = new \DeskPRO\Api($deskpro_url, $api_key);

	$ticket = $api->tickets->createBuilder();
	$person = $api->people->createPersonEditor();

	$person->setName($_POST['sbcform_name']);

	try {	
		$person->setEmail($_POST['sbcform_email']);		
	} catch (Exception $e) {
		return array('isError' => true, 'errorMessage' => 'Email address not valid');
	}

	$ticket->setCreatedBy($person)
			->setSubject($_POST['sbcform_subject'])
			->setMessage($_POST['sbcform_message'], false);

	$result = $api->tickets->save($ticket);
	if ($result->isError()) {
		return array('isError' => true, 'errorMessage' => $result->getErrorMessage());
	}

	$secondresult = $api->tickets->findById($result->getData()['ticket_id']);
	
	if ($secondresult->isError()) {
		return array('isError' => true, 'errorMessage' => $secondresult->getErrorMessage());
	}

	return array('isError' => false, 'data' => $secondresult->getData()['ticket']);

}

function sbctheme_trygetticket() {
	if ($_SERVER['REQUEST_METHOD'] !== 'GET' || !isset($_GET['ticket'])) {
		return null;
	}
	$deskpro_url   = isset($_ENV['DESKPRO_URI']) ? $_ENV['DESKPRO_URI'] : 'http://sbctrial.deskpro.com';  
	$api_key       = isset($_ENV['DESKPRO_KEY']) ? $_ENV['DESKPRO_KEY'] : '1:YYPDA88C5X36CS32P3WQSRJM4';                       
	$api = new \DeskPRO\Api($deskpro_url, $api_key);

	$criteria = $api->tickets->createCriteria()->addRef($_GET['ticket']);
	$result = $api->tickets->find($criteria);

	if ($result->isError() || $result->getData()['total'] !== 1) {
		return array('isError' => true);
	}

	$result2 = $api->tickets->getLogs(array_keys($result->getData()['tickets'])[0]);

	if ($result2->isError()) {
		return array('isError' => true);
	}

	return array(
		'isError' => false, 
		'ticket' => array_values($result->getData()['tickets'])[0], 
		'log' => $result2->getData());
}
