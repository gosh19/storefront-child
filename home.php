<?php
/**
 * The template for displaying the blog home page
 *
 * @package Storefront_Child
 */

get_header(); ?>

<div class="blog-home-container">
    <header class="blog-header">
        <h1 class="blog-title page-width">PARTY BLOG</h1>
        <!-- <p class="blog-description"><?php bloginfo( 'description' ); ?></p> -->
    </header>
    <div class="container page-width">
        <div class="blog-description">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vel vehicula dui. Vestibulum euismod, mi quis dictum porta, felis libero tincidunt leo, a facilisis dui orci eget mi consectetur.</p>
        </div>
        
        <div class="parent-categories">
            <h2 class="categories-title">TEMAS DESTACADOS</h2>
            <div class="categories-grid">
                <?php
                // Get up to 6 blog categories
                $parent_categories = get_terms(array(
                    'taxonomy' => 'category',
                    'orderby' => 'name',
                    'order' => 'ASC',
                    'hide_empty' => true,
                    'number' => 6 // Limit to 6 categories
                ));
                
                if ($parent_categories && !is_wp_error($parent_categories)) {
                    foreach ($parent_categories as $category) {
                        echo '<div class="category-card">';
                        echo '<a href="' . esc_url(get_term_link($category)) . '" class="category-link">';
                        
                        // Get category image if exists
                        $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                        if ($thumbnail_id) {
                            $image = wp_get_attachment_image_src($thumbnail_id, 'medium');
                            if ($image) {
                                echo '<div class="category-image">';
                                echo '<img src="' . esc_url($image[0]) . '" alt="' . esc_attr($category->name) . '">';
                                echo '</div>';
                            } else {
                                echo '<div class="category-icon">';
                                echo '<i class="fas fa-shopping-bag"></i>';
                                echo '</div>';
                            }
                        } else {
                            echo '<div class="category-icon">';
                            echo '<i class="fas fa-shopping-bag"></i>';
                            echo '</div>';
                        }
                        
                        echo '<h3 class="category-name">' . esc_html($category->name) . '</h3>';
                        echo '</a>';
                        echo '</div>';
                    }
                } else {
                    echo '<p class="no-categories">No hay categorías de blog disponibles</p>';
                }
                ?>
            </div>
        </div>
        <div class="blog-layout">
            <div class="blog-main">
                <div class="blog-content">
                    <?php 
                    // Get all posts first
                    $all_posts = get_posts(array(
                        'post_type' => 'post',
                        'numberposts' => -1,
                        'post_status' => 'publish'
                    ));
                    
                    // Set up pagination using URL parameter
                    $paged = isset($_GET['paged']) ? intval($_GET['paged']) : 1;
                    $posts_per_page = 3;
                    $total_posts = count($all_posts);
                    $total_pages = ceil($total_posts / $posts_per_page);
                    
                    // Get posts for current page
                    $offset = ($paged - 1) * $posts_per_page;
                    $current_page_posts = array_slice($all_posts, $offset, $posts_per_page);
                    ?>
                    
                    <div id="blog-posts-container">
                        <?php if ( !empty($current_page_posts) ) : ?>
                            
                            <div class="blog-grid">
                                <?php
                                /* Start the Loop */
                                foreach ( $current_page_posts as $post ) :
                                    setup_postdata($post);
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
                                                
                                                
                                                <div class="entry-meta">

                                                    <?php if ( has_category() ) : ?>
                                                        <span class="cat-links">

                                                            <?php the_category( ', ' ); ?>
                                                        </span>
                                                    <?php endif; ?>
                                                    <span class="byline">
   
                                                        <?php echo get_the_author(); ?>
                                                    </span>
                                                </div>
                                                <?php
                                                    the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                                                ?>
                                            </header>
                                        </div>
                                    </article>
                                    
                                <?php endforeach; ?>
                            </div>

                        <?php else : ?>
                            
                            <div class="no-posts">
                                <h2>No hay posts aún</h2>
                                <p>¡Sé el primero en publicar algo en este blog!</p>
                                <?php if ( current_user_can( 'publish_posts' ) ) : ?>
                                    <a href="<?php echo esc_url( admin_url( 'post-new.php' ) ); ?>" class="btn btn-primary">
                                        Crear primer post
                                    </a>
                                <?php endif; ?>
                            </div>

                        <?php endif; ?>
                    </div>

                    <div class="blog-navigation">
                        <?php
                        echo '<nav class="navigation pagination" role="navigation" aria-label="Posts">';
                        echo '<h2 class="screen-reader-text">Posts navigation</h2>';
                        echo '<div class="nav-links">';
                        
                        // Previous button
                        if ($paged > 1) {
                            echo '<a class="prev page-numbers" href="#" data-page="' . ($paged - 1) . '"><i class="fas fa-chevron-left"></i> Anterior</a>';
                        }
                        
                        // Page numbers
                        for ($i = 1; $i <= $total_pages; $i++) {
                            $class = ($i == $paged) ? 'current' : '';
                            echo '<a class="page-numbers ' . $class . '" href="#" data-page="' . $i . '">' . $i . '</a>';
                        }
                        
                        // Next button
                        if ($paged < $total_pages) {
                            echo '<a class="next page-numbers" href="#" data-page="' . ($paged + 1) . '">Siguiente <i class="fas fa-chevron-right"></i></a>';
                        }
                        
                        echo '</div>';
                        echo '</nav>';
                        ?>
                    </div>

                    <script>
                    jQuery(document).ready(function($) {
                        $('.blog-navigation .page-numbers').on('click', function(e) {
                            e.preventDefault();
                            
                            var page = $(this).data('page');
                            var container = $('#blog-posts-container');
                            
                            // Show loading
                            container.html('<div class="loading">Cargando...</div>');
                            
                            // Make AJAX request
                            $.ajax({
                                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                                type: 'POST',
                                data: {
                                    action: 'load_blog_posts',
                                    page: page,
                                    nonce: '<?php echo wp_create_nonce('blog_pagination_nonce'); ?>'
                                },
                                success: function(response) {
                                    container.html(response);
                                    
                                    // Update pagination active state
                                    $('.page-numbers').removeClass('current');
                                    $('.page-numbers[data-page="' + page + '"]').addClass('current');
                                    
                                    // Update URL without page reload
                                    var url = new URL(window.location);
                                    if (page == 1) {
                                        url.searchParams.delete('paged');
                                    } else {
                                        url.searchParams.set('paged', page);
                                    }
                                    window.history.pushState({}, '', url);
                                },
                                error: function() {
                                    container.html('<div class="error">Error al cargar los posts</div>');
                                }
                            });
                        });
                    });
                    </script>
                    
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>

            <div class="blog-sidebar">
                <div class="sidebar-widget search-widget">
                    <form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
                        <div class="search-input-group">
                            <input type="search" class="search-field" placeholder="Buscar" value="<?php echo get_search_query(); ?>" name="s" />
                            <button type="submit" class="search-submit">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/iconos/search.svg" alt="Buscar">
                            </button>
                        </div>
                    </form>
                </div>

                <div class="sidebar-widget categories-widget">
                    <h3 class="widget-title">Categorías</h3>
                    <ul class="categories-list">
                        <?php
                        $categories = get_categories(array(
                            'orderby' => 'name',
                            'order' => 'ASC',
                            'hide_empty' => true
                        ));
                        
                        if ($categories) {
                            foreach ($categories as $category) {
                                echo '<li class="category-item">';
                                echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="category-link">';
                                echo '<span class="category-name">' . esc_html($category->name) . '</span>';
                                //echo '<span class="category-count">(' . $category->count . ')</span>';
                                echo '</a>';
                                echo '</li>';
                            }
                        } else {
                            echo '<li class="no-categories">No hay categorías disponibles</li>';
                        }
                        ?>
                    </ul>
                </div>
                <?php
                    $block = get_posts(array(
                        'post_type' => 'wp_block',
                        'name' => 'cta-blog'
                    ));

                    if (!empty($block)) {
                        echo do_blocks($block[0]->post_content);
                    }
                ?>

                <div class="sidebar-widget recent-posts-widget">
                    <h3 class="widget-title">Posts Destacados</h3>
                    <ul class="recent-posts-list">
                        <?php
                        $featured_posts = get_posts(array(
                            'numberposts' => 5,
                            'post_status' => 'publish',
                            'tag' => 'featured'
                        ));
                        
                        if ($featured_posts) {
                            foreach ($featured_posts as $post) {
                                setup_postdata($post);
                                echo '<li class="category-item">';
                                echo '<a href="' . get_permalink() . '" class="category-link">';
                                echo '<span class="category-name">' . get_the_title() . '</span>';
                                echo '</a>';
                                echo '</li>';
                            }
                        } else {
                            echo '<li class="no-posts">No hay posts destacados</li>';
                        }
                        wp_reset_postdata();
                        ?>
                    </ul>
                </div>

                <?php
                    $block = get_posts(array(
                        'post_type' => 'wp_block',
                        'name' => 'cta-yellow'
                    ));

                    if (!empty($block)) {
                        echo do_blocks($block[0]->post_content);
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
