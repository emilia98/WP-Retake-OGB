<?php get_header();?>


    <div class="container">

    <h1 class="page-title"><?php the_title()?> <hr/></h1>
    
    <div class="row" id="jobs">
        <?php 
        $type = 'team_members';
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
   
            <div class="col-md-3 col-lg-3">
            <div class="card" style="width: 18rem;">
  <img src="<?php the_post_thumbnail_url()?>" class="card-img-top" alt="">
  <div class="card-body">
    <h5 class="card-title"><?php the_title() ?></h5>
    <p class="card-text">
    <?php 
                   
                   $categories = wp_get_post_terms(get_the_ID(), array(
                       'taxonomy' => 'member_category',
                    )); 
                    
                    foreach ($categories as $term) :
                    ?>
                    
                    <span ><a href="<?php echo get_term_link($term) ?>" class="badge badge-term badge-light"><?php echo $term->name ?></a></span>
                    <?php endforeach; ?>
    </p>
    <a href="<?php the_permalink();?>" class="btn btn-success">Meet</a>
  </div>
</div>
        </div>
        <?php endwhile; endif;  wp_reset_query();?>
    </div>
</div>

<?php get_footer();?>