<?php echo render('_header'); ?>
<div class="grid" id="page-comics">
    <div class="row">
        <section class="main col-8">
            <h1>Reviews</h1>
            <div class="articles reviews">
                <ol>
                    <?php while( $articles->has_rows() ): $article = $articles->row(); ?>
                    <li>
                        <article>
                            <header>
                                <a href="<?php $article->url(); ?>"><span class="rating"><img src="<?php $article->rating_image(); ?>" alt="<?php $article->the('rating') ?>" /></span><img src="<?php $article->the('cover_image'); ?>" alt="<?php $article->the('title'); ?> Image" class="cover" /></a>
                            </header>
                            <div class="content">
                                <h2><a href="<?php $article->url(); ?>"><?php $article->the('title'); ?></a></h2>
                                <p><?php $article->the_summary(1); ?></p>
                                <div class="by">Reviewd by <strong><?php $article->author(); ?></strong></div>
                                <div class="date">
                                    <strong><?php $article->the_type(); ?></strong> <?php $article->the('totalcount'); ?> Views
                                </div>
                            </div>
                        </article>
                    </li>    
                    <?php endwhile; ?>
                </ol>
            </div><!-- .articles .comics -->
        </section>
        <section class="sidebar col-4">
            <?php echo render('_sidebar'); ?>
        </section>
    </div><!-- .row -->
</div><!-- .grid #page-comics -->
<?php echo render('_footer'); ?>
