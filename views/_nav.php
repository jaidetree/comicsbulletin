<ul class="nav col-10">
    <li><a href="<?php echo APP::url('pages.home'); ?>" class="<?php is_page('pages.home'); ?>">Home</a></li>
    <li><a href="<?php echo APP::url('articles.comics'); ?>" class="<?php is_page('articles.comics'); ?>">Comics</a></li>
    <li><a href="<?php echo APP::url('articles.tv'); ?>" class="<?php is_page('articles.tv'); ?>">TV</a></li>
    <li>
        <a href="<?php echo APP::url('articles.movies'); ?>" class="<?php is_page('articles.movies'); ?>">Movies</a>
        <ul>
            <?php foreach( ColumnSeries::get_column_by_type('Movie Column') as $column ): ?>
            <li><a href="<?php echo APP::url('articles.column', array( $column['slug'] )); ?>"><?php echo $column['title']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </li>
    <li>
        <a href="<?php echo APP::url('articles.games'); ?>" class="<?php is_page('articles.games'); ?>">Games</a>
        <ul>
            <?php foreach( ColumnSeries::get_column_by_type('Game Column') as $column ): ?>
            <li><a href="<?php echo APP::url('articles.column', array( $column['slug'] )); ?>"><?php echo $column['title']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </li>
    <li>
        <a href="<?php echo APP::url('articles.reviews'); ?>" class="<?php is_page('articles.reviews'); ?>">Reviews</a>
    </li>
    <li>
        <a href="<?php echo APP::url('articles.columns') ?>" class="<?php is_page('articles.columns'); ?>">Columns</a>
        <ol>
            <?php $columns = Columns::all(); ?>
            <?php while( $columns->has_rows() ): $column = $columns->row(); ?>
            <li><a href="<?php echo APP::URL( 'articles.column', array( $column->slug ) ) ?>"><?php $column->the('title') ?></a></li>
            <?php endwhile; ?>
        </ol>
    </li>
    <li><a href="<?php echo APP::url('articles.interviews'); ?>" class="<?php is_page('articles.interviews'); ?>">Interviews</a></li>
    <li><a href="<?php echo APP::url('pages.podcasts'); ?>" class="<?php is_page('pages.podcasts'); ?>">Podcast</a></li>
    <li><a href="<?php echo APP::url('articles.news'); ?>" class="<?php is_page('articles.news'); ?>">News</a></li>
    <li><a href="<?php echo APP::url('pages.archive'); ?>" class="<?php is_page('pages.archive'); ?>">Archive</a></li>
</ul>
<ul class="social-links col-2">
    <li><a href="#/rss/">RSS</a></li>
    <li><a class="fb" href="https://www.facebook.com/pages/Comics-Bulletin/22427511701">Facebook</a></li>
    <li><a class="tw" href="http://twitter.com/#!/ComicsBulletin">Twitter</a></li>
    <li><a class="tb" href="http://www.tumblr.com/tagged/comics+bulletin">Tumblr</a></li>
</ul>
