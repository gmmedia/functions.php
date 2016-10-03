// Add featured image column to admin panel - posts AND pages
// Add new column as second
function j0e_add_image_column($columns){

	$columns = array(
		'cb' => '<input type="checkbox">',
		'j0e_image_thumb' => __('Image'),
		'title' => __( 'Title' ),
		'author' => __( 'Author' ),
		'categories' => __( 'Categories' ),
		'tags' => __( 'Tags' ),
		'comments' => __( 'Comments' ),
		'date' => __( 'Date' )
	);

	return $columns;
}
add_filter('manage_posts_columns', 'j0e_add_image_column', 5);
add_filter('manage_pages_columns', 'j0e_add_image_column', 5);

// Give the new column a value
function j0e_display_image_column($column_name, $post_id){
  switch($column_name){
    case 'j0e_image_thumb':
      $post_thumbnail_id = get_post_thumbnail_id($post_id);
      if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src( $post_thumbnail_id, 'thumbnail' );
        echo '<img width="40" src="' . $post_thumbnail_img[0] . '">';
      }
      break;
  }
}
add_action('manage_posts_custom_column', 'j0e_display_image_column', 5, 2);
add_action('manage_pages_custom_column', 'j0e_display_image_column', 5, 2);

// Format the column width with CSS
function j0e_add_admin_styles() {
	echo '<style>.column-j0e_image_thumb {width: 40px;}</style>';
}
add_action('admin_head', 'j0e_add_admin_styles');
