<?php echo render('_header.php'); ?>
<section class="featured">
    <ol>

    </ol>
</section>
<div class="grid">
    <div class="row">
        <section class="topstories">
            <ol>
                <?php while( $articles->has_rows() ): $article = $articles->row(); ?>
                <li>
                    <img src="/tmp/th/primary.png" width="140" />
                    <article>
                        <header>
                            <h2><?php $article->the('title') ?></h2>
                            <div class="details">
                                <span class="author">By: <?php $article->author() ?></span>
                            </div><!-- .details -->
                        </header>
                        <div class="content"><?php $article->the_summary(2) ?></div>
                    </article>
                </li>
                <?php endwhile; ?>
            </ol>
        </section>
    </div>
    <div class="secondary tabs">
        <div class="row">
            <nav class="col-12">
                <ul>
                    <li class="active"><a href="#!/columns">Newest Coumns</a></li>
                    <li><a href="#!/reviews">Latest Reviews</a></li>
                    <li><a href="#!/interviews">Recent Interviews</a></li>
                    <li><a href="#!/news">Fresh News</a></li>
                    <li><a href="#!/today">Today&rsquo;s Popular Articles</a></li>
                    <li><a href="#!/alltime">All Time Popular Articles</a></li>
                </ul>
            </nav>
        </div><!-- .row -->
        <?php render('pages/home/_columns.php'); ?> 
        <?php render('pages/home/_reviews.php'); ?> 
        <?php render('pages/home/_interviews.php'); ?> 
        <?php render('pages/home/_news.php'); ?> 
        <?php render('pages/home/_pop_today.php'); ?> 
        <?php render('pages/home/_pop_alltime.php'); ?> 
    </div><!-- .secondary -->
    <div class="row community">
        <div class="col-6">
            <section class="comments">
                <header><h4>Community Discussions</h4></header>
                <ol>
                    <li>
                        <a href="#"><img src="/tmp/th/secondary.png" width="60" height="60" alt="Someone's Avatar" /></a>
                        <div class="comment">
                            <em>Username:</em><p>This is a comment from a form post rendered by drupal. Well hypothetically.</p>
                        </div>
                    </li>
                    <li>
                        <a href="#"><img src="/tmp/th/secondary.png" width="60" height="60" alt="Someone's Avatar" /></a>
                        <div class="comment">
                            <em>Username:</em><p>This is a comment from a form post rendered by drupal. Well hypothetically.</p>
                        </div>
                    </li>
                    <li>
                        <a href="#"><img src="/tmp/th/secondary.png" width="60" height="60" alt="Someone's Avatar" /></a>
                        <div class="comment">
                            <em>Username:</em><p>This is a comment from a form post rendered by drupal. Well hypothetically.</p>
                        </div>
                    </li>
                    <li>
                        <a href="#"><img src="/tmp/th/secondary.png" width="60" height="60" alt="Someone's Avatar" /></a>
                        <div class="comment">
                            <em>Username:</em><p>This is a comment from a form post rendered by drupal. Well hypothetically.</p>
                        </div>
                    </li>
                    <li>
                        <a href="#"><img src="/tmp/th/secondary.png" width="60" height="60" alt="Someone's Avatar" /></a>
                        <div class="comment">
                            <em>Username:</em><p>This is a comment from a form post rendered by drupal. Well hypothetically.</p>
                        </div>
                    </li>
                </ol>
            </section>
        </div><!-- .col-6 -->
        <div class="col-6">
            <section class="comments">
                <header><h4>Latest Tweets</h4></header>
                <ol>
                    <li>
                        <a href="#"><img src="/tmp/th/secondary.png" width="60" height="60" alt="Someone's Avatar" /></a>
                        <div class="comment">
                            <em>Username:</em><p>This is a comment from a form post rendered by drupal. Well hypothetically.</p>
                        </div>
                    </li>
                    <li>
                        <a href="#"><img src="/tmp/th/secondary.png" width="60" height="60" alt="Someone's Avatar" /></a>
                        <div class="comment">
                            <em>Username:</em><p>This is a comment from a form post rendered by drupal. Well hypothetically.</p>
                        </div>
                    </li>
                    <li>
                        <a href="#"><img src="/tmp/th/secondary.png" width="60" height="60" alt="Someone's Avatar" /></a>
                        <div class="comment">
                            <em>Username:</em><p>This is a comment from a form post rendered by drupal. Well hypothetically.</p>
                        </div>
                    </li>
                    <li>
                        <a href="#"><img src="/tmp/th/secondary.png" width="60" height="60" alt="Someone's Avatar" /></a>
                        <div class="comment">
                            <em>Username:</em><p>This is a comment from a form post rendered by drupal. Well hypothetically.</p>
                        </div>
                    </li>
                    <li>
                        <a href="#"><img src="/tmp/th/secondary.png" width="60" height="60" alt="Someone's Avatar" /></a>
                        <div class="comment">
                            <em>Username:</em><p>This is a comment from a form post rendered by drupal. Well hypothetically.</p>
                        </div>
                    </li>
                </ol>
            </section>
        </div><!-- .col-6 -->
    </div>
</div><!-- .grid -->
<script type="text/javascript">
    $(document).ready(function(){ 
        $('.tabs a').on('click', function(){
            var object = $('.tabs .active');
            object.removeClass('active');
            var index = $(this).parents('li').index();
            $(this).parents('li').addClass('active');

            $('.tabs section:eq(' + index + ')').addClass('active');
        });
    });
</script>
<?php echo render('_footer.php'); ?>
