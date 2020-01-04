<?php get_header();?>

<div class="container">
    <h1 class="page-title">Results for: <span class="f-results"><?php single_cat_title();?></span> <hr/></h1>

    <div class="row archive-row">
    <?php 
        if(have_posts()) 
            : while(have_posts()) : the_post(); ?>
            <div class="col-md-3">
            <div class="card mb-4">
     <div class="card-body">
        <?php if(has_post_thumbnail()): ?>
            <img src="<?php the_post_thumbnail_url('smallest'); ?>" class="img-fluid" />
        <?php endif;?>
        <h4><?php the_title();?></h4>
        <?php the_excerpt()?>
        <a href="<?php the_permalink();?>" class="btn btn-success">Read More</a>
     </div>
    </div>
            </div>
    <?php endwhile; endif; ?>
    </div>
    
</div>
 <?php get_footer();?>