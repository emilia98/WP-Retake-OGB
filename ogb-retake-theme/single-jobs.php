<?php get_header();?>

<div class="container">
    <h1 class="page-title"><?php the_title()?> <hr/></h1>
   

    <div class="row">
        <div class="col-md-5">
        <?php if(has_post_thumbnail()): ?>
        <img src="<?php the_post_thumbnail_url(); ?>" class="img-thumbnail"/>
    <?php endif;?>
    <p class="custom-field">
       <span class="label">Location: </span>
       <span class="value"><?php echo get_post_meta($post->ID, 'location', true); ?></span>
    </p>
    <p class="custom-field">
       <span class="label">Salary: </span>
       <span class="value"><?php echo get_post_meta($post->ID, 'salary', true); ?></span>
    </p>
        </div>
        <div class="col-md-7">
        <?php 
        if(have_posts()) 
            : while(have_posts()) : the_post(); ?>
    <?php the_content();?>
   
    <?php endwhile; endif; ?>
        </div>
    </div>
   
   
</div>
 <?php get_footer();?>