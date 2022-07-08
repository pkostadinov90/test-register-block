<?php

add_action( 'init', 'test_register_block_scripts', 0 );
// add_action( 'wp_enqueue_scripts', 'test_register_block_scripts' );
function test_register_block_scripts() {
	wp_register_style(
		'component-1',
		get_stylesheet_directory_uri() . '/component-1.css'
	);

	wp_register_style(
		'component-2',
		get_stylesheet_directory_uri() . '/component-2.css'
	);

	wp_register_style(
		'block-1',
		get_stylesheet_directory_uri() . '/block-1.css',
		array(
			'component-1',
		)
	);

	wp_register_style(
		'block-2',
		get_stylesheet_directory_uri() . '/block-2.css',
		array(
			'component-2',
		)
	);

	wp_register_script(
		'test-blocks-editor-script',
		get_stylesheet_directory_uri() . '/test-blocks-editor-script.js',
		array(
			'wp-blocks',
		)
	);
}

add_action( 'init', 'test_register_block_type' );
function test_register_block_type() {
	if ( ! function_exists( 'register_block_type' ) ) {
		// Block editor is not available.
		return;
	}

	register_block_type(
		'test/block-1',
		array(
			'editor_script'   => 'test-blocks-editor-script',
			'title'           => 'Block 1',
			'style'           => 'block-1',
			'icon'            => 'admin-home',
			'category'        => 'test',
			'description'     => 'A custom block',
			'render_callback' => 'test_render_callback',
		)
	);

	register_block_type(
		'test/block-2',
		array(
			'editor_script'   => 'test-blocks-editor-script',
			'title'           => 'Block 2',
			'style'           => 'block-2',
			'icon'            => 'admin-home',
			'category'        => 'test',
			'description'     => 'A custom block',
			'render_callback' => 'test_render_callback',
		)
	);
}

function test_render_callback( $attributes, $content = '', $wp_block = null ) {
	ob_start();
	?>
	<div class="wp-block wp-block-<?php echo esc_attr( sanitize_title( $wp_block->name ) ); ?>">
		<?php echo wptexturize($wp_block->name); ?>

		<div class="component-1">Component 1</div>
		<div class="component-2">Component 2</div>
	</div>
	<?php
	$html = ob_get_clean();

	return $html;
}

add_filter( 'block_categories_all', 'test_block_categories', 10, 1 );
function test_block_categories( $categories ) {
	$categories[] = array(
		'slug'  => 'test',
		'title' => __( 'Test', 'test' ),
		'icon'  => null,
	);

	return $categories;
}
