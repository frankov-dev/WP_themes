<article class="tech-card">
    <div class="tech-card-image">
        <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'medium' ); ?>
        <?php else : ?>
            <img src="https://picsum.photos/600/400?random=<?php echo get_the_ID(); ?>" alt="<?php the_title_attribute(); ?>">
        <?php endif; ?>
    </div>

    <div class="tech-card-content">
        <span class="tech-card-category"><?php the_category( ', ' ); ?></span>

        <h3 class="tech-card-title">
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h3>

        <div class="tech-card-excerpt">
            <?php the_excerpt(); ?>
        </div>

        <a href="<?php the_permalink(); ?>" class="tech-card-link">Читати далі →</a>
    </div>

</article>