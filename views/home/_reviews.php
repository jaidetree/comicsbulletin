<section class="reviews">
    <div class="row">
        <div class="col-12">
            <ol>
                <?php while($reviews->has_rows()): $article = $reviews->row(); ?>
                <li>
                    <article>
                        <header style="background: url(<?php $article->the('cover_image'); ?>);">
                            <a href="<?php $article->url(); ?>"><span class="rating"><img src="<?php $article->rating_image(); ?>" alt="<?php $article->the('rating') ?>" /></span></a>
                        </header>
                        <div class="content">
                            <h2><a href="<?php $article->url(); ?>"><?php $article->the('title'); ?></a></h2>
                            <p><?php $article->the_summary(1); ?></p>
                            <div class="by">Reviewd by <?php $article->author(); ?></div>
                            <div class="date">
                                <?php $article->the_type(); ?>
                            </div>
                        </div>
                    </article>
                </li>    
                <?php endwhile; ?>
            </ol>
        </div><!-- .col-12 -->
    </div><!-- .row -->
</section>
