<div class="row">
    <div class="col-9">
        <a href="/" class="logo">Comics Bulletin</a>
    </div><!-- .col-9 -->
    <div class="col-3 top">
        <a href="back to top">Back to Top</a>
    </div><!-- .col-3 -->
</div><!-- .row -->
<div class="row">
    <nav class="col-10">
        <ul>
            <li><a href="<?php echo APP::url('pages.home') ?>">Home</a></li>
            <li><a href="<?php echo APP::url('articles.comics') ?>">Comics</a></li>
            <li><a href="<?php echo APP::url('articles.tv') ?>">TV</a></li>
            <li><a href="<?php echo APP::url('articles.movies') ?>">Movies</a></li>
            <li><a href="<?php echo APP::url('articles.games') ?>">Games</a></li>
            <li><a href="<?php echo APP::url('articles.reviews') ?>">Reviews</a></li>
            <li><a href="<?php echo APP::url('articles.columns') ?>">Columns</a></li>
            <li><a href="<?php echo APP::url('articles.interviews') ?>">Interviews</a></li>
            <li><a href="<?php echo APP::url('pages.podcasts') ?>">Podcast</a></li>
            <li><a href="<?php echo APP::url('articles.news') ?>">News</a></li>
            <li><a href="<?php echo APP::url('pages.archive') ?>">Archives</a></li>
        </ul>
    </nav>
    <ul class="social-links col-2">
        <li><a href="#/rss/">RSS</a></li>
        <li><a class="fb" href="https://www.facebook.com/pages/Comics-Bulletin/22427511701">Facebook</a></li>
        <li><a class="tw" href="http://twitter.com/#!/ComicsBulletin">Twitter</a></li>
        <li><a class="tb" href="http://www.tumblr.com/tagged/comics+bulletin">Tumblr</a></li>
    </ul>
</div><!-- .row -->
<div class="row columns">
    <ul class="col-12">
        <?php $columns = Columns::all(); ?>
        <?php while( $columns->has_rows() ): $column = $columns->row(); ?>
        <li><a href="<?php echo APP::url('articles.column', array( $column->slug )); ?>"><?php $column->the('title') ?></a></li>
        <?php endwhile; ?>
    </ul>
</div><!-- .row .columns -->
<div class="row attribution">
    <div class="col-7">
        <p class="copyright">&copy; 2012 Comics Bulletin</p>
    </div>
    <div class="col-5 credits">
        Designed by <a href="http://xugostudios.com/" target="_blank">Xugo Studios</a>
    </div>
</div><!-- .row .attribution -->
