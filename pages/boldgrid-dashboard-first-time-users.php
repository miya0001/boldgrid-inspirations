<?php defined( 'WPINC' ) ? : die; // Don't let this page get loaded directly. ?>
<div class="youtube-container">
	<div class="youtube-player" data-id="qAz3UEJquSk"></div>
</div>
<p>Creating a site with BoldGrid is done in 3 steps:</p>
<ol class="boldgrid-counter">
	<li>Go to 
			<?php
			// Get BoldGrid settings:
			$boldgrid_settings = get_option( 'boldgrid_settings' );
			
			// Show eiher Inspirations lightbulb or BoldGrid Logo depending on their
			// menu settings.
			( 1 == $boldgrid_settings['boldgrid_menu_option'] ? printf( 
				' <a href="%s" class="dashicons-before dashicons-lightbulb">' .
					 esc_html__( 'Inspirations', 'boldgrid-inspirations' ) . '</a> ', 
					esc_url( 
						add_query_arg( 'page', 'boldgrid-inspirations', 
							admin_url( 'admin.php' ) ) ) ) : printf( 
				' <a href="%s" class="dashicons-before boldgrid-icon"> ' .
				 esc_html__( 'BoldGrid', 'boldgrid-inspirations' ) . '</a>', 
				esc_url( 
					add_query_arg( 'page', 'boldgrid-inspirations', 
						admin_url( 'admin.php' ) ) ) ) );
			?>
		to install your starter website and pages typical for your industry.</li>
	<li>
		<?php 
			printf( ' <a href="%s" class="dashicons-before dashicons-admin-customize">' .
				esc_html__( 'Customize', 'boldgrid-inspirations' ) . '</a> ', 
				// build URL and make sure it's escaped to avoid XSS attacks
				esc_url( 	
					// build our query
					add_query_arg( 
						// we want to get the proper URL encoded and without slashes since
						// we are escaping our URL
						'return', urlencode( wp_unslash( $_SERVER['REQUEST_URI'] ) ),
						// root page to apply our query to
						admin_url( 'customize.php' )
					)// End of query
				)// End of escape
			); //End of printf
		?>
		site wide settings like business name, colors, menus and content in your header and footer.</li>
	<li>Edit your  
		<?php 
			printf( ' <a href="%s" class="dashicons-before dashicons-admin-page">' .
				esc_html__( 'Pages', 'boldgrid-inspirations' ) . '</a> ', 
				esc_url( add_query_arg( 'post_type', 'page', admin_url( 'edit.php' ) ) )
			); 
		?>
		to add your content and photos.</li>
</ol>
<p>
Watching the video above is recommended.  You can also visit 

<?php
// Use printf to separate out the actual words from HTML
// so it can be sent through translate.
printf( 
	' <a href="%s" class="dashicons-before dashicons-welcome-learn-more"> %s</a> ', 
	
	// Escape the URL to avoid XSS
	esc_url( 
		
		// Add our query arguments
		add_query_arg( 
			
			array (
				
				// The page we are linking to (BoldGrid Tutorials).
				'page' => 'boldgrid-tutorials',
				
				// The tab we are linking to, "Customization - Get it
				// Done (1-2 hrs)."
				'tab' => 'inspirations' 
			), 
			// The root page we are building our query off of.
			'admin.php' ) ), 
	
	// End of Query Argument
	
	// End of Escaping
	
	// Link title is by itself, esc_html() escapes this output,
	// then __() allows it to be sent to translate.
	// 'boldgrid-inspirations'
	// is our text domain.
	esc_html__( 'Tutorials', 'boldgrid-inspirations' ) );

// End of printf()

?>							
	to learn more.
</p>
<div class="boldgrid-button-wrapper-left">
<?php
// Use printf to separate out the actual words from HTML
// so it can be sent through translate.
printf( 
	'
		<a href="%s">
			<span class="button button-secondary button-hero">%s</span>
		</a>', 
	
	// Escape the URL to avoid XSS
	esc_url( 
		
		// Add our query arguments
		add_query_arg( 
			
			array (
				
				// The page we are linking to (BoldGrid Tutorials).
				'page' => 'boldgrid-tutorials',
				
				// The tab we are linking to, "Advanced For WordPress
				// Users"
				'tab' => 'inspiration' 
			), 
			
			// The root page we are building our query off of.
			'admin.php' ) ), 
	
	// End of Query Argument
	
	// End of Escaping
	
	// Link title is by itself, esc_html() escapes this output,
	// then __() allows it to be sent to translate.
	// 'boldgrid-inspirations'
	// is our text domain.
	esc_html__( 'Learn More', 'boldgrid-inspirations' ) );

// End of printf()

?>
	<span class="boldgrid-between-buttons">or</span>
	<?php
	
	printf( 
		'<a href="%s"><span class="button button-primary button-hero">' .
			 esc_html__( 'Get Started', 'boldgrid-inspirations' ) .
			 '</span></a>', 
			esc_url( 
				add_query_arg( 
					array (
						'page' => 'boldgrid-inspirations',
						'boldgrid-tab' => 'install' 
					), admin_url( 'admin.php' ) ) ) );
	?>
</div>
<!-- End of First Time Users Section -->
