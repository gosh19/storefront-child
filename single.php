<?php
/**
 * The template for displaying all single posts
 *
 * @package Storefront_Child
 */

get_header(); ?>

<div class="single-post-container">
    <div class="container">
        <?php while ( have_posts() ) : the_post(); ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post' ); ?>>
                
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                    
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
                        <?php if ( has_tag() ) : ?>
                            <span class="tags-links">
                                <i class="fas fa-tags"></i>
                                <?php the_tags( '', ', ' ); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </header>

                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail( 'large' ); ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content">
                    <?php
                    the_content();

                    wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__( 'Páginas:', 'storefront-child' ),
                        'after'  => '</div>',
                    ) );
                    ?>
                </div>

                <footer class="entry-footer">
                    <?php
                    // Author bio
                    $author_id = get_the_author_meta( 'ID' );
                    if ( get_the_author_meta( 'description', $author_id ) ) :
                        ?>
                        <div class="author-bio">
                            <div class="author-avatar">
                                <?php echo get_avatar( $author_id, 80 ); ?>
                            </div>
                            <div class="author-info">
                                <h3>Acerca de <?php the_author(); ?></h3>
                                <p><?php the_author_meta( 'description', $author_id ); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="post-navigation">
                        <div class="nav-links">
                            <div class="nav-previous">
                                <?php previous_post_link( '<i class="fas fa-chevron-left"></i> %link' ); ?>
                            </div>
                            <div class="nav-next">
                                <?php next_post_link( '%link <i class="fas fa-chevron-right"></i>' ); ?>
                            </div>
                        </div>
                    </div>
                </footer>

            </article>

            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
            ?>

        <?php endwhile; ?>
    </div>
</div>

<?php
get_footer();
