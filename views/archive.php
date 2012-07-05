<?php echo render('_header'); ?>
<div class="grid" id="page-archive">
    <div class="row">
        <section class="main">
            <h1>Archive</h1>
            <div class="archive">
                <ol>
                    <?php while( $articles->has_rows() ): $article = $articles->row(); ?>
                    <li class="col-6">
                        <article>
                            <header>
                                <h2><a href="<?php $article->url(); ?>"><?php $article->the('title'); ?></a></h2>
                            </header>
                            <div class="content">
                                <div class="by"><?php $article->the_type(); ?> by <strong><?php $article->author(); ?></strong></div>
                            </div>
                        </article>
                    </li>    
                    <?php endwhile; ?>
                </ol>
            </div><!-- .articles .comics -->
        </section>
    </div><!-- .row -->
</div><!-- .grid #page-comics -->
<?php echo render('_footer'); ?>
