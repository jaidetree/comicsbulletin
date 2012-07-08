<ul class="pagination">
    <?php if( $current_page > 1 ): ?>
        <li><a href="?page=1" class="first"><span>&lt;&lt;</span></a></li>
    <?php endif; ?>
    <?php if( $current_page > 1 ): ?>
        <li><a href="?page=<?php echo $current_page - 1 ?>"><span>&lt;</span></a></li>
    <?php endif; ?>
    <?php if( $total_pages < 25 ): ?>
        <?php for( $i=1; $i<=$total_pages; $i++): ?>
            <li><a href="?page=<?php echo $i ?>"<?php if( $i == $current_page ): ?> class="active"<?php endif; ?>><?php echo $i ?></a></li>
        <?php endfor; ?>
    <?php elseif( $current_page < 7 ): ?>
        <?php for( $i=1; $i<=$current_page+3; $i++ ): ?>
            <li><a href="?page=<?php echo $i ?>"<?php if( $i == $current_page ): ?> class="active"<?php endif; ?>><?php echo $i ?></a></li>
        <?php endfor; ?>
        &hellip;
        <?php for( $i=floor($total_pages / 2) - 1; $i <= floor($total_pages / 2) + 1; $i++ ): ?>
            <li><a href="?page=<?php echo $i ?>"><?php echo $i ?></a></li>
        <?php endfor; ?>
        &hellip;
        <?php for( $i=floor($total_pages) - 3; $i <= $total_pages; $i++ ): ?>
            <li><a href="?page=<?php echo $i ?>"><?php echo $i ?></a></li>
        <?php endfor; ?>
    <?php elseif( $current_page < $total_pages - 3 ): ?>
        <?php for( $i=1; $i<=3; $i++ ): ?>
            <li><a href="?page=<?php echo $i ?>"<?php if( $i == $current_page ): ?> class="active"<?php endif; ?>><?php echo $i ?></a></li>
        <?php endfor; ?>
        &hellip;
        <?php for( $i=$current_page - 1; $i<=$current_page + 1; $i++ ): ?>
            <li><a href="?page=<?php echo $i ?>"<?php if( $i == $current_page ): ?> class="active"<?php endif; ?>><?php echo $i ?></a></li>
        <?php endfor; ?>
        &hellip;
        <?php for( $i=floor($total_pages) - 3; $i < $total_pages; $i++ ): ?>
            <li><a href="?page=<?php echo $i ?>"><?php echo $i ?></a></li>
        <?php endfor; ?>
    <?php elseif( $current_page > $total_pages - 2): ?>
        <?php for( $i=1; $i<=3; $i++ ): ?>
            <li><a href="?page=<?php echo $i ?>"<?php if( $i == $current_page ): ?> class="active"<?php endif; ?>><?php echo $i ?></a></li>
        <?php endfor; ?>
        &hellip;
        <?php for( $i=floor($total_pages / 2) - 1; $i <= floor($total_pages / 2) + 1; $i++ ): ?>
            <li><a href="?page=<?php echo $i ?>"<?php if( $i == $current_page ): ?> class="active"<?php endif; ?>><?php echo $i ?></a></li>
        <?php endfor; ?>
        &hellip;
        <?php for( $i=$total_pages - 2; $i <= $total_pages; $i++ ): ?>
            <li><a href="?page=<?php echo $i ?>"<?php if( $i == $current_page ): ?> class="active"<?php endif; ?>><?php echo $i ?></a></li>
        <?php endfor; ?>
    <?php else: ?>
        <?php for( $i=1; $i<=3; $i++ ): ?>
            <li><a href="?page=<?php echo $i ?>"<?php if( $i == $current_page ): ?> class="active"<?php endif; ?>><?php echo $i ?></a></li>
        <?php endfor; ?>
        &hellip;
        <?php for( $i=$total_pages - 6; $i <= $total_pages - 4; $i++ ): ?>
            <li><a href="?page=<?php echo $i ?>"<?php if( $i == $current_page ): ?> class="active"<?php endif; ?>><?php echo $i ?></a></li>
        <?php endfor; ?>
        <?php for( $i=$total_pages - 3; $i <= $total_pages; $i++ ): ?>
            <li><a href="?page=<?php echo $i ?>"<?php if( $i == $current_page ): ?> class="active"<?php endif; ?>><?php echo $i ?></a></li>
        <?php endfor; ?>
    <?php endif; ?>
    <?php if( $current_page < $total_pages - 1 ): ?>
        <li><a href="?page=<?php echo $current_page + 1 ?>"><span>&gt;</span></a></li>
    <?php endif; ?>
    <?php if( $current_page < $total_pages ): ?>
        <li><a href="?page=<?php echo $total_pages ?>" class="last"><span>&gt;&gt;</span></a></li>
    <?php endif; ?>
</ul>
