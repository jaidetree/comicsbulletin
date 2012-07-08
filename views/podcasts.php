<?php echo render('_header', array( 'page_title' => 'Podcasts' )); ?>
<div class="grid" id="page-comics">
    <div class="row">
        <section class="main col-8">
            <h1>Podcasts</h1>
            <?php echo $articles->paginator; ?>
            <div class="articles <?php echo $class ?>">
                <ol>
                    <?php while( $articles->has_rows() ): $article = $articles->row(); ?>
                    <li>
                        <article>
                            <header>
                                <a href="<?php $article->url(); ?>"><img class="cover" src="<?php $article->the('cover_image') ?>" alt="<?php $article->the('title') ?> Cover Image" /></a>
                            </header>
                            <div class="content">
                                <h2><a href="<?php $article->url(); ?>"><?php $article->the('title'); ?></a></h2>
                                <p><?php $article->the_summary(1); ?></p>
                                <div class="details">
                                    <span><?php $article->the_type(); ?></span>
                                    <span><strong><?php $article->author(); ?></strong> <?php $article->the('pub_date'); ?></span>
                                </div><!-- .details -->
                            </div><!-- .content -->
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
