<section class="news">
    <div class="row">
        <div class="col-12">
            <ol>
                <?php while( $news->has_rows() ): $article = $news->row(); ?>
                <li>
                    <article>
                        <h3><a href="<?php $article->url(); ?>"><?php $article->the('title'); ?></a></h3>
                        <div class="details">
                            <span><?php $article->the('pub_date'); ?></span>
                            <span><?php $article->the_type(); ?></span>
                        </div>
                    </article>
                </li>    
                <?php endwhile; ?>
            </ol>
        </div><!-- .col-12 -->
    </div><!-- .row -->
</section>
