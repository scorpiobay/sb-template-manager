<?php function templates_used() {
   add_menu_page(
       __( 'Templates Used', 'textdomain' ),
       'Templates Used',
       'manage_options',
       'templates-used.php',
       'list_templates_used',
       plugins_url( '' ),
       999
   );
}
add_action( 'admin_menu', 'templates_used' );

function list_templates_used( ) {
   global $post;
   echo "<br><b><h1>Templates Used</h1></b>";
   list_templates_by_type( 'page' );
   list_templates_by_type( 'post' );
   //list_templates_by_type( 'custom-post-type' );
}

function list_templates_by_type( $type = 'page' ) {
   
   $args = array( 'post_type' => $type, 'posts_per_page' => -1 );
   $posts = get_posts( $args );
   $count = 0;
   
   $output = '';
   $output .= '<br><h3>\''. $type .'\' List</h3>';
   
   foreach ($posts as $post) {
       setup_postdata( $post );
       if ( get_page_template_slug( $post->ID ) ) {
           if ( $count == 0 ) {
               $output .= ' <span>Every '. $type .' not listed below has template "Default".</span></b></br><br>';
               $output .= ' <table style="border-collapse: collapse;">';
               $output .= ' <tr><th>ID</th><th>Name</th><th>Slug</th><th>Template</th></tr>';
           }
           $count++;
           $output .= '<tr style="background-color: white;">';
           $output .= '<td style="border: 1px solid black;padding: 4px;">' . $post->ID . '</td>';
           $output .= '<td style="border: 1px solid black;padding: 4px;">' . $post->post_title . '</td>';
           $output .= '<td style="border: 1px solid black;padding: 4px;">' . $post->post_name . '</td>';
           $output .= '<td style="border: 1px solid black;padding: 4px;">' . get_page_template_slug( $post->ID ) . '</td>';
           $output .= '</tr>';
       }

   }
   $output .= '</tr>';
   $output .= '</table>';
   
   if ( $count == 0 ) {
       $output .= '<span> Either there are no posts with type "' . $type . '", or none of them have custom templates set (and have the Default template). </span>';
   }
   
   
   wp_reset_postdata();
   echo $output;
} ?>