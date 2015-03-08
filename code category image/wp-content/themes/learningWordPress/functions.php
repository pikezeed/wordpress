 <?php 
//function get_images_from_media_library() {
//    $args = array(
//        'post_type' => 'attachment',
//        'post_mime_type' =>'image',
//        'post_status' => 'inherit',
//        'posts_per_page' => 5,
//        
//        'orderby' => 'rand'
//    );
//    $query_images = new WP_Query( $args );
//    print_r($query_images->guid);
//    $images = array();
//    
//    foreach ( $query_images->posts as $image) {
//        $images[]= $image->guid;
//    }
//    return $images;
//}
add_filter( 'wpmediacategory_taxonomy', function(){ return 'category_media'; } ); //requires PHP 5.3 or newer
function get_images_from_media_library() {
    $args = array(
        'post_type' => 'attachment',
        'post_mime_type' =>'image',
        'post_parent' => null,
        'posts_per_page' => 5,
        'tax_query' => array(
            array('taxonomy' => 'category_media',
                  'field' => 'slug',
                  'terms' => array('test-cat')
                ),

        ),
        'post_status' => 'inherit'
       

    );
    $query_images = new WP_Query( $args );
    print_r($query_images->posts);
//     print_r($query_images->);
    $images = array();
    
    foreach ( $query_images->posts as $image) {
        $images[]= $image->guid;
    }
    return $images;
}
function display_images_from_media_library() {

	$imgs = get_images_from_media_library();
	$html = '<div id="media-gallery">';
	
	foreach($imgs as $img) {
	
		$html .= '<img src="' . $img . '" alt="" />';
	
	}
	
	$html .= '</div>';
	
	return $html;

}
 
 ?>

