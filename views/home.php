<?php echo render('_header.php'); ?>
<section class="featured" id="rotator">
    <div class="container">
        <div class="story-box">
            <span class="total">
                <span class="progress"></span>
            </span>
        </div><!-- .story-box -->
        <ol>
            <?php while( $featured->has_rows() ): $article = $featured->row(); ?>
            <li>
                <div class="title">
                    <h2><a href="<?php $article->url(); ?>"><?php $article->the('title'); ?></a></h2>
                </div><!-- .title -->
                <div class="story">
                    <span class="image">
                        <a href="<?php $article->url(); ?>"><img src="<?php $article->the('slider_image'); ?>" /></a>
                    </span><!-- .image -->
                    <p class="caption">
                        <?php $article->the('slider_caption'); ?>
                    </p>
                </div><!-- .story -->
            </li>
            <?php endwhile; ?>
        </ol>
    </div><!-- .container -->
</section>
<div class="grid">
    <div class="row">
        <section class="topstories">
            <ol>
                <?php while( $articles->has_rows() ): $article = $articles->row(); ?>
                <li>
                    <a href="<?php $article->url() ?>"><img src="<?php $article->the('cover_image'); ?>" width="140" /></a>
                    <article>
                        <header>
                            <h2><a href="<?php $article->url() ?>"><?php $article->the('title') ?></a></h2>
                        </header>
                        <div class="details">
                            <span class="type"><?php $article->the_type(); ?></span>
                            <?php if($article->author): ?>
                                <span class="author">By: <?php $article->author() ?> on <?php $article->the('pub_date') ?></span>
                            <?php else: ?>
                                <span class="date">Published: <?php $article->the('pub_date') ?></span>
                            <?php endif; ?>
                        </div><!-- .details -->
                        <div class="content"><?php $article->the_summary(2) ?></div>
                        <div class="details">
                            <?php if( $article->node_type == "review" ): ?>
                            <img src="<?php $article->rating_image(); ?>" alt="<?php $article->the('rating') ?>" />
                            <?php endif; ?>
                            <span class="views"><?php $article->the('totalcount'); ?> Views</span>
                        </div><!-- .details -->
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
                    <li class="active"><a href="#!/columns">Newest Columns</a></li>
                    <li><a href="#!/reviews">Latest Reviews</a></li>
                    <li><a href="#!/interviews">Recent Interviews</a></li>
                    <li><a href="#!/news">Fresh News</a></li>
                </ul>
            </nav>
        </div><!-- .row -->
        <?php echo render('home/_columns.php', array('columns' => $columns)); ?> 
        <?php echo render('home/_reviews.php', array('reviews' => $reviews)); ?> 
        <?php echo render('home/_interviews.php', array('interviews' => $interviews)); ?> 
        <?php echo render('home/_news.php', array('news' => $news)); ?> 
    </div><!-- .secondary -->
    <div class="row community">
        <div class="col-6">
            <section class="comments">
                <header><h4>Community Discussions</h4></header>
                <div id="dsq-recentcomments" class="dsq-widget"><script type="text/javascript" src="http://disqus.com/forums/comicsbulletin/recent_comments_widget.js?num_items=11&amp;excerpt_length=200&avatar_size=32"></script></div> 
            </section>
        </div><!-- .col-6 -->
        <div class="col-6">
            <section class="comments">
                <header><h4>Latest Tweets</h4></header>
                <ol id="twitter_update_list">
                </ol>
            </section>
        </div><!-- .col-6 -->
    </div>
</div><!-- .grid -->
<script type="text/javascript" src="/static/js/rotator.js"></script>
<script type="text/javascript" src="/static/js/twitter.js"></script>
<script type="text/javascript">
    $(document).ready(function(){ 
        var hash = window.location.hash;
        if( $('.tabs nav a[href="' + hash + '"]').length )
        {    
            $('.tabs .active').removeClass('active');
            $('.tabs nav a[href="' + hash + '"]').parents('li').addClass('active');
            var index = $('.tabs nav a[href="' + hash + '"]').parents('li').index();
            $('.tabs section:eq(' + index + ')').addClass('active');

        }
        $('.tabs nav a').on('click', function(){
            var object = $('.tabs .active');
            object.removeClass('active');
            var index = $(this).parents('li').index();
            $(this).parents('li').addClass('active');

            $('.tabs section:eq(' + index + ')').addClass('active');
        });
        var rotator = new Rotator($('.featured'), {});
    });
</script>
<script type="text/javascript" src="http://search.twitter.com/search.json?q=@comicsbulletin&rpp=10&include_entities=true&result_type=recent&show_user=true&callback=twitterCallback2"></script>
<?php echo render('_footer.php'); ?>
