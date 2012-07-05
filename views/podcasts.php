<?php echo render('_header'); ?>
<div class="grid" id="page-comics">
    <div class="row">
        <section class="main col-8">
            <h1>Podcasts</h1>
            <div class="articles <?php echo $class ?>">
                <ol>
                    <?php while( $articles->has_rows() ): $article = $articles->row(); ?>
                    <li>
                        <article>
                            <header>
                                <a href="<?php $article->url(); ?>"><img class="cover" src="<?php $article->the('logo') ?>" alt="<?php $article->the('title') ?> Cover Image" /></a>
                            </header>
                            <div class="content">
                                <h2><a href="<?php $article->url(); ?>"><?php $article->the('title'); ?></a></h2>
                                <p><?php $article->the_summary(1); ?></p>
                                <div class="details">
                                    <?php $article->the_type(); ?> <strong><?php $article->author(); ?></strong>
                                </div><!-- .details -->
                            </div><!-- .content -->
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
