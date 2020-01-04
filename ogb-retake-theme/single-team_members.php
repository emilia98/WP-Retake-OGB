<?php get_header();?>

<div class="container">
    <h1 class="page-title"><?php the_title()?> <hr/></h1>
   

    <div class="row">
        <div class="col-md-6">
        <?php if(has_post_thumbnail()): ?>
        <img src="<?php the_post_thumbnail_url(); ?>" class="img-thumbnail"/>
    <?php endif;?>
        </div>
        <div class="col-md-6">
        <?php 
        if(have_posts()) 
            : while(have_posts()) : the_post(); ?>
    <?php the_content();?>
    <?php endwhile; endif; ?>
        </div>
    </div>
   
   
</div>
 <?php get_footer();?>