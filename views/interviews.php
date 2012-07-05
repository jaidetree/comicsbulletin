<?php echo render('_header'); ?>
<div class="grid" id="page-comics">
    <div class="row">
        <section class="main col-8">
            <h1>Interviews</h1>
            <div class="articles interviews">
                <ol>
                    <?php while( $articles->has_rows() ): $article = $articles->row(); ?>
                    <li>
                        <article>
                            <header>
                                <a href="<?php $article->url(); ?>"><img src="<?php $article->the('cover_image'); ?>" alt="<?php $article->the('title'); ?> Image" class="cover" /></a>
                            </header>
                            <div class="content">
                                <h2><a href="<?php $article->url(); ?>"><?php $article->the('title'); ?></a></h2>
                                <p><?php $article->the_summary(1); ?></p>
                                <div class="by"><strong><?php $article->author(); ?></strong> interviews <strong><?php $article->the_interviewee(); ?></strong></div>
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
