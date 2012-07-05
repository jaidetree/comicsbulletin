<?php echo render('_header') ?>
<div class="grid" id="page-article">
    <div class="row">
        <section class="main col-8">
            <article>
                <h1><?php $article->the('title'); ?></h1>
                <span class="type">A <?php $article->the_type('strtolower'); ?> by: <strong><?php $article->author(); ?></strong></span>
                <div class="story">
                    <?php $article->the('body_value'); ?>
                </div><!-- story -->
                <div class="comments">
                    <h2>Community Discussion</h2>
                    <div id="disqus_thread"></div>
                    <script type="text/javascript">
                        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
                        var disqus_shortname = 'comicsbulletin'; // required: replace example with your forum shortname
                        var disqus_url = '<?php $article->disqus_url() ?>';

                        /* * * DON'T EDIT BELOW THIS LINE * * */
                        (function() {
                            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                            dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
                            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                        })();
                    </script>
                </div><!-- .comments -->
            </article> 
        </section>
        <section class="sidebar col-4">
            <!-- sidebar -->
            <?php if( $article->node_type == "review" ): ?>
            <div class="review section">
                <div>
                    <span class="score"><?php $article->the('rating') ?></span> / <span class="total">5.0</span>
                    <img src="<?php $article->rating_image(); ?>" alt="<?php $article->the('rating') ?>" />
                </div>
            </div><!-- .review .section -->
            <?php endif; ?>
            <?php if( $article->details ): ?>
            <aside class="details section">
                <h3>Details, Details</h3>
                <ul>
                    <?php foreach( $article->details() as $name => $value ): ?>
                    <li><?php echo $name; ?> <strong><?php echo $value; ?></strong></li>
                    <?php endforeach; ?>
                </ul>
            </aside>
            <?php endif; ?>
            <img src="<?php echo $article->cover_image ?>" alt="<?php $article->the('title'); ?> Cover Image" class="cover-image" />
            <?php if( $article->logo_image ): ?>
            <div class="section column">
                <h3><?php $article->the('column_series') ?></h3>
                <img src="<?php echo $article->logo_image ?>" alt="<?php $article->the('column_series'); ?> Logo" class="cover-image" />
            </div>
            <?php endif; ?>
            <?php echo render('_sidebar'); ?>
        </section>
    </div><!-- .row -->
</div><!-- .grid -->
<?php echo render('_footer') ?>
