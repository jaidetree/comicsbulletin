<?php echo render('_header', array( 'page_title' => 'Archives' )); ?>
<div class="grid" id="page-archives">
    <div class="row">
        <section class="main col-12">
            <h1>Archive</h1>
            <?php echo $archives->paginator ?>
            <div class="archives">
                <ol>
                    <?php while( $archives->has_rows() ): $archive = $archives->row(); ?>
                    <?php if( $last_year != $archive->archive_year ): ?>
                        <?php if( ! $archive->is_first() ): ?>
                        </ol>
                    </li>
                        <?php endif; ?>
                    <li class="year">
                        <h2><?php $archive->the('archive_year'); ?></h2>
                        <ol class="months">
                    <?php endif; ?>
                            <li><a href="<?php $archive->url(); ?>"><?php $archive->the('archive_month'); ?> <span>(<strong><?php $archive->the('total'); ?></strong>)</span></a></li>
                    <?php $last_year = $archive->archive_year ?>
                    <?php endwhile; ?>
                        </ol>
                    </li>
                </ol>
            </div><!-- .articles .comics -->
            <?php echo $archives->paginator ?>
        </section>
    </div><!-- .row -->
</div><!-- .grid #page-comics -->
<?php echo render('_footer'); ?>
