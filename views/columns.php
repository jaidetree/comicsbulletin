<?php echo render('_header', array( 'page_title' => 'Columns' )); ?>
<div class="grid" id="page-columns">
    <div class="row">
        <section class="main">
            <h1>Comics Bulletin Columns</h1>
            <div class="columns">
                <ol>
                    <?php while( $columns->has_rows() ): $column = $columns->row(); ?>
                    <li class="col-4">
                        <article>
                            <header>
                                <a href="<?php echo APP::url('articles.column', array( $column->slug )) ?>"><img class="logo" src="<?php $column->logo() ?>" alt="" /></a>
                            </header>
                            <div class="content">
                                <h2><a href="<?php echo APP::url('articles.column', array( $column->slug )) ?>"><?php $column->the('title'); ?></a></h2>
                            </div><!-- .content -->
                        </article>
                    </li>
                    <?php endwhile; ?>
                </ol>
            </div><!-- .articles .comics -->
        </section>
    </div><!-- .row -->
</div><!-- .grid #page-comics -->
<?php echo render('_footer'); ?>
