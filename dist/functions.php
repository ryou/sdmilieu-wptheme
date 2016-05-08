<?php

// アイキャッチ画像のサポート
add_theme_support('post-thumbnails');

// カスタムメニューのサポート
register_nav_menu('g-nav', 'グローバルナビ');


/***********************************************************************
index.phpへ遷移するパターンの際に、404ページへ誘導する
**********************************************************************/
add_filter('template_include', function($template) {
  if (basename($template) === 'index.php') {
    header("HTTP/1.0 404 Not Found");
    return get_404_template();
  }
  return $template;
});


/***********************************************************************
トップページには記事一覧を表示させたいのでarchiveテンプレートを使用
**********************************************************************/
add_filter('template_include', function($template) {
  if (basename($template) === 'home.php') {
    return get_archive_template();
  }
  return $template;
});


add_filter('template_include', function($template) {
  if (basename($template) === 'single.php' || basename($template) === 'page.php') {
    return get_query_template('singular');
  }
  return $template;
});


/***********************************************************************
ページネーションを出力
**********************************************************************/
function echo_paginate() {
  global $wp_query;

  $big = 999999999;

  echo paginate_links(array(
    'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format'    => '?paged=%#%',
    'current'   => max( 1, get_query_var('paged') ),
    'total'     => $wp_query->max_num_pages,
    'prev_text' => 'PREV',
    'next_text' => 'NEXT'
  ));
}
