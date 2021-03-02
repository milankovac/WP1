<?php get_header();?>
<section class="content">
    <div class="col-md-4 text-center  animate__animated  animate__zoomIn content-div2">
                    <div class="card-body">
                    <?php if(has_post_thumbnail()): ?>
                        <?php the_post_thumbnail('medium'); ?>
                    <?php endif; ?>
                        <h3 class="card-title"><?php the_title(); ?></h3>
                        <p class="card-text"> <?php the_content(); ?></p>
                        
                    </div>
            </div>
 </section>


<?php get_footer()?>