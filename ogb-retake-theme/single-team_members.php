<?php get_header();?>

<div class="container m-t-100">
    <h1 class="page-title"><?php the_title()?> <hr/></h1>
   
    <div class="row">
        <div class="col-md-6">
            <img src="<?php echo has_post_thumbnail() == true ? the_post_thumbnail_url() : 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/1024px-No_image_available.svg.png' ?>" class="img-thumbnail"/>
        
            <div class="team-member-social">
                <ul class="list-inline social-buttons">
                    <?php $metaFields = get_post_meta($post->ID, 'your_fields', true);?>
                    <li class="list-inline-item">
                        <a href="<?php echo 'https://'.$metaFields['instagram']?>" class="text-center">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                      <a href="<?php echo 'https://'.$metaFields['facebook']?>" class="text-center">
                        <i class="fab fa-facebook-f"></i>
                      </a>
                    </li>
                    <li class="list-inline-item">
                      <a href="<?php echo 'https://'.$metaFields['linkedin']?>" class="text-center">
                        <i class="fab fa-linkedin-in"></i>
                      </a>
                    </li>
                </ul>
            </div>
            <div class="team-member-info">
                <p class="custom-field">
                    <span class="label">Email: </span>
                    <span class="value"><?php echo $metaFields['email']?></span>
                </p>
            </div> 
            <div class="team-member-info">
                <p class="custom-field">
                    <span class="label">Positions: </span>
                    <span class="value">
                    <?php 
                        $categories = wp_get_post_terms(get_the_ID(), array(
                        'taxonomy' => 'member_category',
                        )); 
                    
                        foreach ($categories as $term) :
                        ?>
                            <span>
                                <a href="<?php echo get_term_link($term) ?>" class="badge badge-term badge-warning">
                                    <?php echo $term->name ?>
                                </a>
                            </span>
                        <?php endforeach; ?>
                    </span>
                </p>
            </div>     
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