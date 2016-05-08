<!DOCTYPE html>
<html lang="ja" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
  <head>
    <meta charset="utf-8">
    <title>SD MILIEU</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic,700italic">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/common.css" media="all">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/archive.css" media="all">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="./assets/js/lib/jquery.min.js"><\\/script>')</script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/common.js"></script>
  </head>
  <body>
    <div class="lContainer">
      <header id="GHead">
        <p class="logo"><a href="<?php echo site_url(); ?>"><span class="logoTxt">SDMILIEU</span></a></p>
        <div class="gnav"><?php wp_nav_menu( array ( 'theme_location' => 'g-nav' ) ); ?>
        </div>
      </header>
      <div id="Contents"><?php if (have_posts()) : ?>
        <ul class="articleList"><?php while (have_posts()) : the_post(); ?>
          <li>
            <div class="mArticle">
              <div class="lRow">
                <div class="lRow_side">
                  <div class="mArticle_side">
                    <time datetime="<?php the_time("Y-m-j"); ?>" class="mArticle_date"><?php the_time("m月 j, Y"); ?></time>
                    <p class="mArticle_author">by <?php the_author(); ?></p>
                  </div>
                </div>
                <div class="lRow_main">
                  <div class="mArticle_main">
                    <h2 class="mArticle_tit"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="mArticle_categories"><?php the_category(); ?>
                    </div>
                    <p class="mArticle_kv"><?php the_post_thumbnail(); ?></p>
                    <div class="mArticle_content">
                      <p><?php the_excerpt(); ?></p>
                    </div>
                    <div class="mArticle_more"><a href="<?php the_permalink(); ?>" class="mBtn mBtn-link">続きを読む…</a></div>
                  </div>
                </div>
              </div>
            </div>
          </li><?php endwhile; ?>
        </ul><?php endif; ?>
        <div class="lRow">
          <div class="lRow_main">
            <div class="pagination"><?php echo_paginate(); ?>
            </div>
          </div>
        </div>
      </div>
      <footer id="GFoot">
        <p class="copy">Copyright(C) 2014-2016 SD MILIEU</p>
      </footer>
    </div>
  </body>
</html>