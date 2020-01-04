<?php get_header();?>

<div class="container m-t-100">

    <?php /* the_title() */?> 
    <!-- <h1 class="page-title">   <hr/></h1> -->
    <h1 class="page-title">Our Amazing Team<hr/></h1>
    <div class="row">
        <div class="col-lg-8 mx-auto text-center">
          <p class="large text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>
        </div>
      </div>

    <section class="page-section-custom" id="team">
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
   
            <div class="col-sm-4">
                <div class="team-member">
                    <img src="<?php echo has_post_thumbnail() == true ? the_post_thumbnail_url() : 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/1024px-No_image_available.svg.png' ?>" class="card-img-top mx-auto rounded-circle" alt="">
                    <h4><?php the_title() ?></h4>
                    <p class="text-muted">
                    <?php 
                        $categories = wp_get_post_terms(get_the_ID(), array(
                        'taxonomy' => 'member_category',
                        )); 
                    
                        foreach ($categories as $term) :
                        ?>
                            <span ><a href="<?php echo get_term_link($term) ?>" class="badge badge-term badge-light"><?php echo $term->name ?></a></span>
                        <?php endforeach; ?>
                    </p>
                    <ul class="list-inline social-buttons">
                        <?php $metaFields = get_post_meta($post->ID, 'your_fields', true);?>
                        <li class="list-inline-item">
                            <a href="<?php echo 'https://'.$metaFields['instagram']?>">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                          <a href="<?php echo 'https://'.$metaFields['facebook']?>">
                            <i class="fab fa-facebook-f"></i>
                          </a>
                        </li>
                        <li class="list-inline-item">
                          <a href="<?php echo 'https://'.$metaFields['linkedin']?>">
                            <i class="fab fa-linkedin-in"></i>
                          </a>
                        </li>
                    </ul>
                    <div class="meet-btn">
                        <a href="<?php the_permalink();?>" class="btn btn-warning">Meet</a>
                    </div>
                </div>
         
            </div>
            <?php endwhile; endif;  wp_reset_query();?>
    </div>  
  </section>    
</div>

<?php get_footer();?>