<?php echo render('_header', array('page_title' => 'Reviews')); ?>
<div class="grid" id="page-comics">
    <div class="row">
        <section class="main col-8">
            <h1>Reviews</h1>
            <?php echo $articles->paginator; ?>
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
                                <div class="details">
                                    <strong><?php $article->the_type(); ?></strong>
                                    <span class="by">Reviewd by <strong><?php $article->author(); ?></strong> <?php $article->the('pub_date'); ?></span>
                                </div>
                            </div>
                        </article>
                    </li>    
                    <?php endwhile; ?>
                </ol>
            </div><!-- .articles .comics -->
            <?php echo $articles->paginator; ?>
        </section>
        <section class="sidebar col-4">
            <?php echo render('_sidebar'); ?>
        </section>
    </div><!-- .row -->
</div><!-- .grid #page-comics -->
<?php echo render('_footer'); ?>
