<div class="blog-cat-main-area">

    <div class="cat-blog-thumb">
        <?php the_post_thumbnail();?>
    </div>

    <div class="cat-blog-main">

        <h2 class="cat-blog-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <div class="entry-meta">
            <?php bb_niche_posted_on(); ?>
            by
            <a href=""> <?php the_author();?></a>
        </div><!-- .entry-meta -->



        <div class="cat-blog-content"><?php the_excerpt(); ?></div>

    </div>
</div>