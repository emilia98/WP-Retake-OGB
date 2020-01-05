<?php get_header();?>

<div class="container m-t-100">
    <h1 class="page-title"><?php the_title()?> <hr/></h1>
   

    <div class="row">
        <div class="text-align">
            <?php if(has_post_thumbnail()): ?>
                <img src="<?php the_post_thumbnail_url(); ?>" class="img-thumbnail"/>
            <?php endif;?>
        </div>
        <div class="w-100 article-meta-data">
        <p class="custom-field text-center">
            <span class="label">Date: </span>
            <span class="value"><?php echo get_the_date(); ?></span>
        </p>
        <p class="custom-field text-center">
            <span class="label">Categories: </span>
            <span class="value">
                <?php 
                    $categories = wp_get_post_terms(get_the_ID(), array(
                        'taxonomy' => 'article_category',
                    )); 
                    
                    foreach ($categories as $term) :
                ?>
                    
                <span ><a href="<?php echo get_term_link($term) ?>" class="badge badge-term badge-light"><?php echo $term->name ?></a></span>
                <?php endforeach; ?>
                            
            </span>
        </p>
            </div>
        
        
        <div class="">
        <?php 
        if(have_posts()) 
            : while(have_posts()) : the_post(); ?>
    <?php the_content();?>
   
    <?php endwhile; endif; ?>
        </div>
    </div>
   
   
</div>
 <?php get_footer();?>