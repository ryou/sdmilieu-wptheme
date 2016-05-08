<!DOCTYPE html>
<html lang="ja" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
  <head>
    <meta charset="utf-8">
    <title><?php the_title(); ?> | SD MILIEU</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic,700italic">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/common.css" media="all">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/singular.css" media="all">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/js/lib/google-code-prettify/prettify.min.css" media="all">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="./assets/js/lib/jquery.min.js"><\\/script>')</script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/common.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/lib/google-code-prettify/prettify.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/lib/google-code-prettify/run_prettify.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/singular.js"></script>
  </head>
  <body>
    <div class="lContainer">
      <header id="GHead">
        <p class="logo"><a href="<?php echo site_url(); ?>"><span class="logoTxt">SDMILIEU</span></a></p>
        <div class="gnav"><?php wp_nav_menu( array ( 'theme_location' => 'g-nav' ) ); ?>
        </div>
      </header>
      <div id="Contents"><?php the_post(); ?>
        <main class="mainWrapper">
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
                  <h1 class="mArticle_tit"><?php the_title(); ?></h1>
                  <div class="mArticle_categories"><?php the_category(); ?>
                  </div>
                  <p class="mArticle_kv"><?php the_post_thumbnail(); ?></p>
                  <section class="mArticle_content"><?php the_content(); ?>
                  </section>
                  <ul class="mArticle_snsBtns">
                    <li><a href="https://twitter.com/share?text=<?php the_title(); ?>｜<?php bloginfo("name"); ?>&url=<?php the_permalink(); ?>" target="_blank" class="mArticle_snsBtn mArticle_snsBtn-tw"><i class="fa fa-twitter"></i>&nbsp;ツイート</a></li>
                    <li><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&t=<?php the_title(); ?>｜<?php bloginfo("name"); ?>" target="_blank" class="mArticle_snsBtn mArticle_snsBtn-fb"><i class="fa fa-facebook"></i>&nbsp;シェア</a></li>
                    <li><a href="http://b.hatena.ne.jp/add?mode=confirm&url=<?php the_permalink(); ?>" target="_blank" class="mArticle_snsBtn mArticle_snsBtn-hb">B!&nbsp;ブックマーク</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </main>
        <div class="subWrapper">
          <div class="lRow">
            <div class="lRow_main">
              <nav class="mSubNav">
                <h1 class="mSubNav_tit">最近の投稿</h1>
                <ul class="mSubNav_items">
                  <?php
                  $args = array('posts_per_page' => 5);
                  $myposts = get_posts( $args );
                  foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
                     <li>
                         <a href="<?php the_permalink(); ?>"><div class="mSubNav_itemInner"><?php the_title(); ?></div></a>
                     </li>
                  <?php endforeach;
                  wp_reset_postdata();?>
                </ul>
              </nav>
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