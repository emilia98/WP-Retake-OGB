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

<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">TopRecruitment</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
        <?php 
          $items = wp_get_nav_menu_items('top-menu');

          foreach($items as $item) {
            echo '<li class="nav-item"><a href="'.$item->url.'" title="'.$item->title.'" class="nav-link js-scroll-trigger">'.$item->title.'</a></li>';
          }   
    ?>
        </ul>
      </div>
    </div>
  </nav>