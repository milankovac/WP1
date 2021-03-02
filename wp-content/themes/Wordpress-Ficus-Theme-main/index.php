<?php get_header();?>
        
  <section class="content">
    <?php if(have_posts()) : ?>

        <?php while(have_posts()) : the_post(); ?>
         <div class="col-md-4 text-center  animate__animated  animate__zoomIn content-div">
           <p id="time"><?php the_time('F j, Y g:i a'); ?></p>
              
                <div class="card-body">
                <?php if(has_post_thumbnail()): ?>
                    <?php the_post_thumbnail('medium'); ?>
                  <?php endif; ?>
                    <h4 class="card-title"><?php the_title(); ?></h4>
                    <p class="card-text"> <?php the_excerpt(); ?></p>
                    <a href="<?php the_permalink(); ?>" class="btn btn-default">Read More</a>
                </div>
                <p id="author">By: 
                  <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                      <?php the_author(); ?>
                    </a></p>

          </div>
                <?php endwhile; ?>
			<?php else : ?>
				<?php echo 'Sorry, no posts were found'; ?>
			<?php endif; ?>


    </section>

  
<?php get_footer()?>

    