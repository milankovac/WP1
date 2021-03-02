<?php get_header()?>
    <section class="content">
        <?php if(has_post_thumbnail()): ?>
            <div class="col-md-6 page-img"><?php the_post_thumbnail(); ?></div>
        <?php endif; ?>
          <div class="page-content col-md-5"><p><?php the_content(); ?></p></div>

    </section>

<?php get_footer()?>