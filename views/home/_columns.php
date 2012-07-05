<section class="columns active">
    <div class="row">
        <header class="header col-12">
            <a href="#subscribe">Subscribe</a>
            <a href="#top">Back to Top</a>
        </header>
    </div><!-- .row -->
    <div class="row">
        <ol>
            <?php while( $columns->has_rows() ): $article = $columns->row(); ?>
            <li class="col-4">
                <article style="background-image: url(<?php $article->the('cover_image') ?>);">
                    <div>
                        <header>
                            <h3><a href="<?php $article->url(); ?>"><?php $article->the('title') ?></a></h3>
                        </header>
                        <span><?php $article->the('column_series') ?> <cite><?php $article->author(); ?></cite></span>
                    </div>
                </article>
            </li>
            <?php endwhile; ?>
        </ol>
    </div><!-- .row -->
</section>
