<?php echo render('_header', array( 'page_title' => 'News' )); ?>
<div class="grid" id="page-news">
    <div class="row">
        <section class="main col-8">
            <h1>News</h1>
            <?php echo $articles->paginator ?>
            <div class="news">
                <ol>
                    <?php while( $articles->has_rows() ): $article = $articles->row(); ?>
                    <li>
                        <article>
                            <header>
                                <a href="<?php $article->url(); ?>"><img class="cover" src="<?php $article->the('cover_image') ?>" alt="<?php $article->the('title') ?> Cover Image" /></a>
                            </header>
                            <div class="content">
                                <h2><a href="<?php $article->url(); ?>"><?php $article->the('title'); ?></a></h2>
                                <div class="details">
                                    <span><?php $article->the_type(); ?></span> 
                                    <span><?php $article->author(); ?> <strong><?php $article->the('pub_date'); ?></strong></span>
                                </div><!-- .details -->
                            </div><!-- .content -->
                        </article>
                    </li>
                    <?php endwhile; ?>
                </ol>
            </div><!-- .articles .comics -->
            <?php echo $articles->paginator ?>
        </section>
        <section class="sidebar col-4">
            <?php echo render('_sidebar'); ?>
        </section>
    </div><!-- .row -->
</div><!-- .grid #page-comics -->
<?php echo render('_footer'); ?>
