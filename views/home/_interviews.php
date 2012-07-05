<section class="interviews">
    <div class="row">
        <div class="col-12">
            <ol>
                <?php while( $interviews->has_rows() ): $article = $interviews->row(); ?>
                <li>
                    <article>
                        <header>
                            <a href="<?php $article->url(); ?>"><img src="<?php $article->the('cover_image'); ?>" alt="<?php $article->the('title'); ?> Thumbnail" /></a>
                        </header>
                        <div class="content">
                            <h3><a href="<?php $article->url(); ?>"><?php $article->the('title'); ?></a></h3>
                            <p><?php $article->the_summary(1); ?></p>
                            <div class="by"><?php $article->the_interviewee(); ?> Interviewed by <?php $article->author(); ?></div>
                        </div>
                    </article>
                </li>    
                <?php endwhile; ?>
            </ol>
        </div><!-- .col-12 -->
    </div><!-- .row -->
</section>
