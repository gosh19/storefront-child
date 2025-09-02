<?php
/**
 * The template for displaying archive pages
 *
 * @package Storefront_Child
 */

get_header(); ?>

<div class="blog-home-container">
    <div class="container">
        <header class="blog-header">
            <?php
            the_archive_title( '<h1 class="blog-title">', '</h1>' );
            the_archive_description( '<p class="blog-description">', '</p>' );
            ?>
        </header>

        <div class="blog-content">
            <?php if ( have_posts() ) : ?>
                
                <div class="blog-grid">
                    <?php
                    /* Start the Loop */
                    while ( have_posts() ) :
                        the_post();
                        ?>
                        
                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post-card' ); ?>>
                            
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail( 'medium_large' ); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="post-content">
                                <header class="entry-header">
                                    <?php
                                    the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                                    ?>
                                    
                                    <div class="entry-meta">
                                        <span class="posted-on">
                                            <i class="fas fa-calendar"></i>
                                            <?php echo get_the_date(); ?>
                                        </span>
                                        <span class="byline">
                                            <i class="fas fa-user"></i>
                                            <?php echo get_the_author(); ?>
                                        </span>
                                        <?php if ( has_category() ) : ?>
                                            <span class="cat-links">
                                                <i class="fas fa-folder"></i>
                                                <?php the_category( ', ' ); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </header>

                                <div class="entry-summary">
                                    <?php the_excerpt(); ?>
                                </div>

                                <footer class="entry-footer">
                                    <a href="<?php the_permalink(); ?>" class="read-more-btn">
                                        Leer más <i class="fas fa-arrow-right"></i>
                                    </a>
                                </footer>
                            </div>
                        </article>
                        
                    <?php endwhile; ?>
                </div>

                <div class="blog-navigation">
                    <?php
                    the_posts_pagination( array(
                        'mid_size'  => 2,
                        'prev_text' => '<i class="fas fa-chevron-left"></i> Anterior',
                        'next_text' => 'Siguiente <i class="fas fa-chevron-right"></i>',
                    ) );
                    ?>
                </div>

            <?php else : ?>
                
                <div class="no-posts">
                    <h2>No se encontraron posts</h2>
                    <p>No hay posts en esta categoría o etiqueta.</p>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">
                        Volver al inicio
                    </a>
                </div>

            <?php endif; ?>
        </div>
    </div>
</div>

<?php
get_footer();
