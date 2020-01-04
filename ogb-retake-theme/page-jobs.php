<?php get_header();?>
    <div class="container m-t-100">

    <h1 class="page-title"><?php the_title()?> <hr/></h1>
    
    <div class="row" id="jobs">
        <?php 
        $type = 'jobs';
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
   
            <div class="col-sm-6 col-md-4 col-lg-4 job-col">
                <div class="job">
                    <div>
                        <img src="<?php the_post_thumbnail_url()?>" alt="HERE" class="job-img"/>
                    </div>
                    <h3 class="job-title"><?php the_title() ?></h3>
                    <p class="job-date"><?php echo get_the_date(); ?></p>
                    <p class="job-custom-field"><?php echo get_post_meta($post->ID, 'location', true); ?></p>
                    <p class="job-custom-field"><?php echo get_post_meta($post->ID, 'salary', true); ?></p>
                    <div class="job-categories">
                   <?php 
                   
                   $categories = wp_get_post_terms(get_the_ID(), array(
                       'taxonomy' => 'job_category',
                    )); 
                    
                    foreach ($categories as $term) :
                    ?>
                    
                    <span ><a href="<?php echo get_term_link($term) ?>" class="badge badge-term badge-light"><?php echo $term->name ?></a></span>
                    <?php endforeach; ?>
                </div>
                
                <a href="<?php the_permalink();?>" class="btn btn-dark btn-sm">Read More</a>
            </div>
        </div>
        <?php endwhile; endif;  wp_reset_query();?>
    </div>
</div>

<?php get_footer();?>