<!DOCTYPE HTML>
<html>
    <head>
        <title>Comics Bulletin</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" type="text/css" href="<?php static_url(); ?>css/screen.css" media="screen">
        <script type="text/javascript" src="/static/js/jquery.js"></script>
    </head>
    <body>
        <header class="l-header">
            <div class="grid">
                <div class="row">
                    <div class="col-9">
                    <h1 class="logo"><a href="<?php echo APP::url('pages.home'); ?>"><img src="<?php static_url() ?>images/comicsbulletin_logo_header.png" alt="Comics Bulletin Logo" /></a></h1>
                    </div><!-- .col-9 -->
                    <div class="col-3">
                        <form method="post" class="search" action="search">
                            <input type="text" name="query" placeholder="Search...">
                            <input type="submit" value="Search">
                        </form>
                    </div><!-- .col-3 -->
                </div><!-- .row -->
            </div><!-- .grid -->
        </header>
        <nav class="l-nav">
            <div class="grid">
                <div class="row">
                    <?php echo render('_nav.php'); ?>
                </div><!-- .row -->
            </div><!-- .grid -->
        </nav>
        <div class="l-content">
