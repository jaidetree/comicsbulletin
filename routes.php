<?php
$routes = array(
    array( '^$', 'pages.home' ),
    array( '^(articles|reviews|titles|columns|news|interviews)/([0-9]+)/([-_a-z0-9]+)/$', 'articles.show' ),
    array( '^comics/$', 'articles.comics' ),
    array( '^tv/$', 'articles.tv' ),
    array( '^movies/$', 'articles.movies' ),
    array( '^games/$', 'articles.games' ),
    array( '^reviews/$', 'articles.reviews' ),
    array( '^columns/$', 'articles.columns' ),
    array( '^column/([-_a-z0-9]+)/$', 'articles.column' ),
    array( '^interviews/$', 'articles.interviews' ),
    array( '^news/$', 'articles.news' ),
    array( '^archive/$', 'pages.archive' ),
    array( '^archive/([-0-9]+)/$', 'pages.archive_date' ),
    array( '^podcasts/$', 'pages.podcasts' ),
    array( '^search/(.*)$', 'articles.search' ),
    array( '^author/([-%\+a-z0-9]+)/$', 'articles.author' ),
);
?>
