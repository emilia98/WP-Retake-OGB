<?php get_header();?>

<div class="container">
<h1 class="page-title"><?php the_title()?> <hr/></h1>

    <?php 
        if(have_posts()) 
            : while(have_posts()) : the_post(); ?>
    <?php the_content();?>
    <?php endwhile; endif; ?>
</div>
 <?php get_footer();?>