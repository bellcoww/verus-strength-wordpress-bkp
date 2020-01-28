<?php
/**
 * Valedictorians back compat functionality
 *
 * @package Valedictorians
	
 */

if ( ! function_exists( 'get_parent_theme_file_path' ) ) {
	/**
	 * Retrieves the path of a file in the parent theme.
	 *
	 * @param  string $file Optional. File to return the path for in the template directory.
	 * @return string       The path of the file.
	 */
	function get_parent_theme_file_path( $file = '' ) {
		$file = ltrim( $file, '/' );

		if ( empty( $file ) ) {
			$path = get_template_directory();
		} else {
			$path = get_template_directory() . '/' . $file;
		}

		/**
		 * Filters the path to a file in the parent theme.
		 *
		 * @param string $path The file path.
		 * @param string $file The requested file to search for.
		 */
		return apply_filters( 'parent_theme_file_path', $path, $file );
	}
}