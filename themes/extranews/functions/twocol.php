<?php 
    /* Get All Initial Variables */
    if ( !($reviewstyle = of_get_option('of_review_style') ) ) { $reviewstyle = 'percentage'; } else { $reviewstyle = of_get_option('of_review_style'); }
    if ( !($reviewnum = of_get_option('of_review_number') ) ) { $reviewnum = '5'; } else { $reviewnum = of_get_option('of_review_number'); } 
    if ( !($sidebar = of_get_option('of_sidebar_width') ) ) { $sidebar = 'default'; } else { $sidebar = of_get_option('of_sidebar_width'); } 

?>
<div id="isonormal">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                
    <div class="one_col isobrick">
        <div class="articleinner">

            <div class="categories">
                <?php echo ag_get_cats(3); ?>
            </div>

            <h2 class="indextitle">
                <a href="<?php the_permalink(); ?>" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>">
                    <?php the_title(); ?>
                </a>
            </h2>

            <span class="date">
                <?php 
                    the_time(get_option('date_format')); ?> | <?php the_author_posts_link();
                    $num_comments = get_comments_number(); // get_comments_number returns only a numeric value
                    if ( comments_open() && ($num_comments != 0) ) : ?>
                        <a class="bubble" href="<?php comments_link(); ?>"><?php comments_number('0', '1', '%'); ?></a>
                    <?php endif; 
                ?>
            </span>

                <!-- Post Image
                ================================================== -->
                <?php /* if the post has a WP 2.9+ Thumbnail */
                    if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
                        <div class="thumbnailarea">
                                <?php echo ag_review_post_home($post->ID, $reviewnum, $reviewstyle); ?>
                            <a class="thumblink" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>" href="<?php the_permalink(); ?>">
                                <?php if ($sidebar == 'extended') {
                                the_post_thumbnail('blogonecol', array('class' => 'scale-with-grid')); /* post thumbnail settings configured in functions.php */ 
                                } else {
                                the_post_thumbnail('blog', array('class' => 'scale-with-grid')); /* post thumbnail settings configured in functions.php */ 
                                } ?>
                            </a>
                        </div>
                    <?php endif; 
                ?>
                
                <?php if ( (!function_exists('has_post_thumbnail')) || (!has_post_thumbnail()) ) : ?>
                    <a title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>" href="<?php the_permalink(); ?>">
                        <?php echo ag_review_post_home($post->ID, 3, $reviewstyle); ?>
                    </a>
                <?php endif; ?>

                <!-- Post Content
                ================================================== -->
                <?php 
				global $more; $more = 0;
				if (preg_match('/<!--more/', $post->post_content)) {
					$content = apply_filters('the_content',get_the_content(__('Read More', 'framework')));
					echo $content;
				} else {
					the_excerpt(__('Read More', 'framework'));
				}
				?>

             <div class="clear"></div>

        </div> <!-- End articleinner -->
    </div> <!-- End full_col -->
    <?php endwhile; else : ?>
	<?php if (is_search()) {?>
    <div class="one_col isobrick">
			<h4><?php _e('Nothing Found.', 'framework'); ?> <br /><?php _e('Try Another Search:', 'framework'); ?></h4>
        	<p><?php get_search_form(true); ?></p>
    </div>
     <?php }?>       
	<?php endif; wp_reset_query(); ?>
    <div class="clear"></div>

</div><!-- End isonormal -->