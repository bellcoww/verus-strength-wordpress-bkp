<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); 

add_filter( 'block_categories', function( $categories, $post ) {

return array_merge(
	$categories,
	array(
		array(
			'slug' => 'wpwdfy',
			'title' => __( 'Wodify', 'wp-wdfy-integration-of-wodify' ),
		),
	)
);
}, 10, 2 );

function wpwdfy_blocks() {
    wp_register_script(
        'wpwdfy-blocks',
        plugins_url( 'js/block-wod.js', __FILE__ ),
        array( 'wp-i18n','wp-blocks', 'wp-element','wp-components','wp-editor')
    );
	wp_set_script_translations('wpwdfy-blocks','wp-wdfy-integration-of-wodify');
    register_block_type( 'wp-wdfy-integration-of-wodify/wod', 
		array(
			'editor_script' => 'wpwdfy-blocks',
			'render_callback' => 'wpwdfy_render_block_wod',
		
			'attributes' => 	array(
					'date' => 		array	(
										'type'      => 'string',
										'default'   => '+0',
									),
				
					'program' => 	array(
										'type'      => 'string',
									'default'   => '',
									),
					
					'location' => 	array	(
										'type'      => 'string',
										'default'   => '',
									),
								)
		)
    );
	
	 register_block_type( 'wp-wdfy-integration-of-wodify/events', 
		array(
			'editor_script' => 'wpwdfy-blocks',
			'render_callback' => 'wpwdfy_render_block_events',
		
			'attributes' => 	array(
					
				
					'program' => 	array(
										'type'      => 'string',
									'default'   => '',
									),
					'numdays' => 	array(
									'type'      => 'string',
									'default'   => '',
									),
					'showheader' => 	array(
									'type'      => 'string',
									'default'   => '',
									),														
									
									
								)
		)
    );
	
	
}
add_action( 'init', 'wpwdfy_blocks' );

function wpwdfy_render_block_events( $attributes, $content ) {
    if (isset($attributes["numdays"])&&$attributes["numdays"]!="")
		$numdays = $attributes["numdays"];
	else
		$numdays = "7";
	if (isset($attributes["program"])&&$attributes["program"]!="")
		$program = $attributes["program"];
	else
		$program = get_option('wodify_program');
	
	if (isset($attributes["showheader"])&&$attributes["showheader"]!="")
		$showheader = $attributes["showheader"];
	else
		$showheader = "false";
	
	return  (	
		do_shortcode("[wdfyevents numdays=\"$numdays\" includeprograms=\"$program\" schemaorg=\"true\" showheader=\"$showheader\"]"));
}


function wpwdfy_render_block_wod( $attributes, $content ) {
    if (isset($attributes["date"])&&$attributes["date"]!="")
		$woddate = $attributes["date"];
	else
		$woddate = "+0";
	if (isset($attributes["program"])&&$attributes["program"]!="")
		$program = $attributes["program"];
	else
		$program = get_option('wodify_program');
	
	if (isset($attributes["location"])&&$attributes["location"]!="")
		$location = $attributes["location"];
	else
		$location = get_option('wodify_location');
	
	return  (	
		do_shortcode("[wdfywod date=\"$woddate\" program=\"$program\" location=\"$location\" ]"));
    
}

add_action( 'rest_api_init', function () {
  register_rest_route( 'wp-integration-of-wodify/v1', '/lookups/', array(
    'methods' => 'GET,POST',
    'callback' => 'wpwdfy_blockLookups',
	'permission_callback' => function () {return (current_user_can('edit_posts'));}
  ) );
} );

function wpwdfy_blockLookups($args)
{	
	$resultstr1="";
	$programs=SOS_Wodify_API::wodifyPrograms();
	if ($programs )
	{
		if (is_array($programs))
			{
				foreach ($programs as $prog)
				{
					if ($resultstr1!="")
						$resultstr1.=",";
					$resultstr1.=$prog->Name;
				}
			}
		
	}
	$resultstr2="";
	$locations=SOS_Wodify_API::wodifyLocations();
	if ($locations )
	{
		if (is_array($locations))
			{
				foreach ($locations as $loc)
				{
					if ($resultstr2!="")
						$resultstr2.=",";
					$resultstr2.=$loc->Name;
				}
			}
		
	}
	return ($resultstr1.";".$resultstr2);
}
