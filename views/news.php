<?php echo render('_header'); ?>
<div class="grid" id="page-news">
    <div class="row">
        <section class="main col-8">
            <h1>News</h1>
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
                                    <span><?php $article->author(); ?> <strong><?php $article->the('pub_date'); ?></strong> <?php $article->the('totalcount'); ?> Views</span>
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
