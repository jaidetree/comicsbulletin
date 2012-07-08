<?php echo render('_header', array( 'page_title' => 'Archives' )); ?>
<div class="grid" id="page-archive">
    <div class="row">
        <section class="main col-12">
            <h1>Archive <?php echo $archive_date ?></h1>
            <?php echo $articles->paginator ?>
            <div class="archive">
                <ol>
                    <?php while( $articles->has_rows() ): $article = $articles->row(); ?>
                    <li>
                        <article>
                            <header>
                                <h2><a href="<?php $article->url(); ?>"><?php $article->the('title'); ?></a></h2>
                            </header>
                            <div class="content">
                            <div class="by"><?php $article->the_type(); ?> <?php if( $article->author ): ?> by <strong><?php $article->author(); ?> <?php endif; ?></strong></div>
                            </div>
                        </article>
                    </li>    
                    <?php endwhile; ?>
                </ol>
            </div><!-- .articles .comics -->
            <?php echo $articles->paginator ?>
        </section>
    </div><!-- .row -->
</div><!-- .grid #page-comics -->
<?php echo render('_footer'); ?>
