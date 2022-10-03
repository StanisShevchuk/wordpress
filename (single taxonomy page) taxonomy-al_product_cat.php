<?php
    get_header();

    $al_cat_slug = get_queried_object()->slug;
    $al_cat_name = get_queried_object()->name;
?>
    <h2><?php echo $al_cat_name; ?></h2>
<?php
    $al_tax_post_args = array(
        'post_type' => 'Your Post Type', // Your Post type Name that You Registered
        'posts_per_page' => 999,
        'order' => 'ASC',
        'tax_query' => array(
            array(
                'taxonomy' => 'al_product_cat',
                'field' => 'slug',
                'terms' => $al_cat_slug
            )
        )
    );
    $al_tax_post_qry = new WP_Query($al_tax_post_args);

    if($al_tax_post_qry->have_posts()) :
       while($al_tax_post_qry->have_posts()) :
            $al_tax_post_qry->the_post();
?>
            <a href="<?php the_permalink(); ?>">
                 <?php the_title(); ?>
            </a>
<?php
       endwhile;
    endif;
get_footer();
?>
