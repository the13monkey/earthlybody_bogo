<?php 

    get_header(); 

?>

<div class="container py-md-5 my-md-5 px-md-5">

    <?php 

        if(have_posts()) : while(have_posts()) : the_post();

        
        if ( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
        }
    
        ?>

        <div class="post-thumbnail text-center mb-md-5">
            <?php 
                if ( has_post_thumbnail() ) {
                    the_post_thumbnail();
                }
            ?>
        </div>

    <h2 class="post-title">

        <?php echo get_the_title() ?>
        
    </h2>

    <div class="post-meta mb-md-3">
    
        <ul class="list-group list-group-horizontal border-top border-bottom my-md-5">
            <li class="list-group-item border-0"><em>by&nbsp;&nbsp;</em><b><?php echo get_author_name() ?></b></li>
            <li class="list-group-item border-0"><?php echo get_the_date() ?></li>
            <li class="list-group-item border-0"><?php echo get_comments_number() ?>&nbsp;&nbsp;Comments</li>
            <li class="list-group-item border-0"><a class="p-2 my-2" href="#"><i class="fab fa-facebook-f facebook-blue"></i></a></li>
            <li class="list-group-item border-0"><a class="p-2 text-dark" href="#"><i class="fab fa-instagram inst_purple"></i></a></li>
            <li class="list-group-item border-0"><a class="p-2 text-dark" href="#"><i class="fab fa-youtube youtube-red"></i></a></li>
            <li class="list-group-item border-0"><a class="p-2 text-dark" href="#"><i class="fab fa-twitter twitter_blue"></i></a></li>
        </ul>

    </div>
      
    <div class="post-body mb-md-5 pb-md-5">

        <?php 
            the_content();
            endwhile; else: endif; 
        ?>
    
    </div>

    <div class="row justify-content-between align-items-center border-top border-bottom">
        <div style="width: 18rem" class="pl-md-3">
            <p class="mb-0">Share This Story, Choose Your Platform!</p>
        </div>
        <ul class="list-group list-group-horizontal">
            <li class="list-group-item border-0"><a class="p-2 my-2" href="#"><i class="fab fa-facebook-f facebook-blue"></i></a></li>
            <li class="list-group-item border-0"><a class="p-2 text-dark" href="#"><i class="fab fa-instagram inst_purple"></i></a></li>
            <li class="list-group-item border-0"><a class="p-2 text-dark" href="#"><i class="fab fa-youtube youtube-red"></i></a></li>
            <li class="list-group-item border-0"><a class="p-2 text-dark" href="#"><i class="fab fa-twitter twitter_blue"></i></a></li>
        </ul>
    </div>

    <div class="related-posts">

        <h3 class="text-center text-dark-green my-md-5">Related stories</h3>
        
        <ul class="list-group list-group-horizontal">
            <?php
            // Default arguments
            $args = array(
	            'posts_per_page' => 3, // How many items to display
	            'post__not_in'   => array( get_the_ID() ), // Exclude current post
	            'no_found_rows'  => true, // We don't ned pagination so this speeds up the query
            );

            // Check for current post category and add tax_query to the query arguments
            $cats = wp_get_post_terms( get_the_ID(), 'category' ); 
            $cats_ids = array();  
            foreach( $cats as $wpex_related_cat ) {
	            $cats_ids[] = $wpex_related_cat->term_id; 
            }
            if ( ! empty( $cats_ids ) ) {
	            $args['category__in'] = $cats_ids;
            }

            // Query posts
            $wpex_query = new wp_query( $args );

            // Loop through posts
            foreach( $wpex_query->posts as $post ) : setup_postdata( $post ); ?>

            <li class="list-group-item border-0">
                <div class="card" style="width: 18rem;">
                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) ) ?>
                    <img src="<?php echo $image[0] ?>" class="card-img-top" />
                    <div class="card-body">
                        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>"><h5 class="card-title text-dark-green"><?php the_title(); ?></h5></a>
                    </div>
                </div>
            </li>    

            <?php
            // End loop
            endforeach;

            // Reset post data
            wp_reset_postdata(); ?>
        </ul>

       <?php do_action( 'comment_form' ) ?>
        

    </div>


</div>

    
<?php   
    get_footer(); 
