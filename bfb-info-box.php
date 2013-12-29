<?php
/**
 * Plugin Name: Blogging For Benjamin Info Box
 * Plugin URI: https://github.com/BFTrick/blogging-for-benjamin-info-box
 * Description: Add an information box at the top of any post published during the Blogging for Benjamin competition.
 * Author: Patrick Rauland
 * Author URI: http://patrickrauland.com/
 * Version: 1.0
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 */
 
 
/**
 * Add an information box at the top of any Blogging for Benjamin post
 *
 * @return string
 * @since 1.0
 */
function wtbfb_add_info_box( $content ){

	// check to make sure we should add the info box
	$add_info_box = wtbfb_check_add_info_box();

	if ( $add_info_box ) { 
		// get the content we want to add
		$info_box_content = wtbfb_info_box_content();

		// format the content
		$info_box_content = wpautop( $info_box_content );

		// prepend it to the content
		$content = $info_box_content . $content;
	}

	return $content;
}
add_filter( 'the_content', 'wtbfb_add_info_box' );


/**
 * Check to make sure we should add the info box. True to add - false to not add
 *
 * @return bool
 * @since 1.0
 */
function wtbfb_check_add_info_box( ) {

	$result = false;

	// get post type
	$post_type = get_post_type( get_the_ID() );

	// check to make sure we're adding this to regular posts - not other post types.
	if( 'post' == $post_type ) {
		// get all of the dates into a DateTime object
		$post_time_epoch = get_post_time('U');
		$post_date = new DateTime("@$post_time_epoch");
		$start_date = DateTime::createFromFormat('d/m/Y', '01/12/2013');
		$end_date = DateTime::createFromFormat('d/m/Y', '31/12/2013');

		// make sure the dates are in a valid range
		if ( $post_date >= $start_date && $post_date <= $end_date ) {
			$result = true;
		}
	}

	// return the result
	return apply_filters( 'wtbfb_add_info_box', $result );
}


/**
 * Get the content for the info box
 *
 * @return string
 * @since 1.0
 */
function wtbfb_info_box_content( ) {

	// get total posts during the WTBFB competition
	$args = array( 'posts_per_page' => 31, 'year' => 2013, 'monthnum' => 12, 'order' => "ASC" );	
	$all_posts = get_posts( $args );
	$total_posts = count( $all_posts );

	// get the current post number.
	$current_post_number = -1;
	foreach ( $all_posts as $key => $value) {
		if ( get_the_ID() == $value->ID ) {
			$current_post_number = $key + 1;
			break;
		}
	}

	// get permalink for Bloggin for Benjamin competition post
	$permalink = apply_filters( 'wtbfb_info_box_permalink', 'http://speakinginbytes.com/2013/12/blogging-competition/' );

	// format the string
	$string = __( '%%WRAPPEROPEN%% This is post #%1$s out of %2$s in the <a href="%3$s">Blogging for Benjamin competition</a>. %%WRAPPERCLOSE%%', 'wtbfbib');
	$result = sprintf( $string, $current_post_number, $total_posts, $permalink );

	// format the wrappers
	$opening_wrapper = apply_filters( 'wtbfb_open_wrapper', '<div class="wtbfb_info_box">' );
	$closing_wrapper = apply_filters( 'wtbfb_close_wrapper', '</div>' );

	// replace wrapper place holders with actual wrappers
	$result = str_replace( "%WRAPPEROPEN%", $opening_wrapper, $result );
	$result = str_replace( "%WRAPPERCLOSE%", $closing_wrapper, $result );

	return apply_filters( 'wtbfb_info_box', $result );
}

 
// That's all folks!