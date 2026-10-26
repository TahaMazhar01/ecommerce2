<?php get_header();?><main id="main" class="ns-standard"><?php while(have_posts()):the_post();?><h1><?php the_title();?></h1><?php the_content();endwhile;?></main><?php get_footer();?>
