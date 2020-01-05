<?php get_header();?>

<div class="container m-t-100" id="articles">
    <h1 class="page-title"><?php post_type_archive_title();?> Articles<hr/></h1>

    <div class="row archive-row">
    <?php 
         $type = 'articles';
         $args = array(
             'post_type' => $type,
             'post_status' => 'publish',
             'posts_per_page' => -1,
             'ignore_sticky_posts'=> true
         );
         $my_query = null;
         $my_query = new WP_Query($args);

         if($my_query->have_posts()) 
           : while($my_query->have_posts()) : $my_query->the_post();?>
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body row">
                        <div class="col-md-4">
                            <?php if(has_post_thumbnail()): ?>
                                <img src="<?php the_post_thumbnail_url('smallest'); ?>" class="img-fluid" />
                            <?php endif;?>
                        </div> 
                        <div class="col-md-8">
                            <h4><?php the_title();?></h4>
                            <div class="categories">
                                <?php 
                                    $categories = wp_get_post_terms(get_the_ID(), array(
                                        'taxonomy' => 'article_category',
                                    )); 
                    
                                    foreach ($categories as $term) :
                                ?>
                    
                                <span ><a href="<?php echo get_term_link($term) ?>" class="badge badge-term badge-light"><?php echo $term->name ?></a></span>
                                <?php endforeach; ?>
                            </div>
                            <p class="text-muted"><?php echo get_the_date(); ?></p>
                            
                            <?php the_excerpt()?>
                            <a href="<?php the_permalink();?>" class="btn btn-success">Read More</a>
                        </div>
        
     </div>
                    
                     
     
    </div>
            </div>
    <?php endwhile; endif; ?>
    </div>
    
</div>
 <?php get_footer();?>