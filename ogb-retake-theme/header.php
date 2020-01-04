<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>OGB - New responsive theme for Wordpress</title>

  <?php wp_head();?>
</head>

<body <?php body_class();?>>

<header>
<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">Start Bootstrap</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto my-2 my-lg-0">
          <?php 
          $items = wp_get_nav_menu_items('top-menu')
        //   ( 
        //     array(
        //         'theme_location' => ,
        //         'menu_class' => 'navbar-nav ml-auto my-2 my-lg-0'
        //     )
        //   )
          ;

          foreach($items as $item) {
            echo '<li class="nav-item"><a href="'.$item->url.'" title="'.$item->title.'" class="nav-link js-scroll-trigger">'.$item->title.'</a></li>';
          }

           
    ?>


          </ul>
        <!-- <ul class="">
         
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#services">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#portfolio">Portfolio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
          </li>
        </ul> -->
      </div>
    </div>
  </nav>

    
</header>