<?php
get_header(); ?>
<main class="main-block">
    <div class="main-sect inv-sect bg-grey">
        <div class="container">
            <h1 class="text-center">Analyst Reports</h1>
        </div>
        <div class="menu-second margin-md color-white">
            <div class="container">
                <div class="toggle-menu-s">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <?php
                wp_nav_menu( [
                    'container'       => '',
                    'menu_class'      => '',
                    'theme_location'  => 'financial-menu'
                ] );?>
            </div>
        </div>
        <div class="container max-width-sm">
            <div class="filter-asx">
                <div class="btn-group bootstrap-select">
                    <button type="button" class="btn dropdown-toggle btn-default" data-toggle="dropdown" role="button" title="All" aria-expanded="false">
                        <span class="filter-option pull-left"><?php single_cat_title(); ?></span>
                        <span class="bs-caret">
                            <span class="caret"></span>
                        </span>
                    </button>
                    <div class="dropdown-menu open" role="combobox" style="max-height: 433px; overflow: hidden; min-height: 0px;">
                        <ul class="dropdown-menu inner" role="listbox" aria-expanded="false" style="max-height: 433px; overflow-y: auto; min-height: 0px;">
                            <li >
                                <a href="/analyst-reports">
                                    <span class="text">All</span>
                                    <span class="glyphicon glyphicon-ok check-mark"></span>
                                </a>
                            </li>
                            <?php
                            $categories = get_terms( 'reports_category', array(
                                'hide_empty' => 0,
                                ) );
                                $subcategories = $categories;
                                $subsubcategories = $subcategories;
                                foreach ( $categories as $category ) {
                                    if ( 0 != $category->parent ) {
                                    continue;
                                    }
                                    echo '<li> <a href="/reports_category/'. $category->slug .'"><span class="text">' . $category->name . '</span></a></li>';
                                }                    
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="ul-inv asx-list">
                <?php
                    $tax = get_query_var('taxonomy');
                    $term = get_query_var('term');
                    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                    $loop = new WP_Query(array(
                        'tax_query' => array(
                              array(
                              'terms' => $term,
                              'taxonomy' => $tax,
                              'field' => 'slug',
                              'posts_per_page' => -1,
                              'paged' => $paged
                              
                           )
                        )
                     ));

                    while ( $loop->have_posts() ) : $loop->the_post(); ?>

                     <li>
                           <a class="opena">
                              <span><?php echo get_the_date();?></span><p><?php the_title();?></p><i><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M13.8333 8V13.8333H2.16667V8H0.5V13.8333C0.5 14.75 1.25 15.5 2.16667 15.5H13.8333C14.75 15.5 15.5 14.75 15.5 13.8333V8H13.8333ZM8.83333 8.55833L10.9917 6.40833L12.1667 7.58333L8 11.75L3.83333 7.58333L5.00833 6.40833L7.16667 8.55833V0.5H8.83333V8.55833Z" fill="url(#paint0_linear)"/>
                                       <defs>
                                          <linearGradient id="paint0_linear" x1="0.5" y1="0.5" x2="18.1687" y2="4.76466" gradientUnits="userSpaceOnUse">
                                             <stop stop-color="#AE18E8"/>
                                             <stop offset="1" stop-color="#F05A28"/>
                                          </linearGradient>
                                       </defs>
                                 </svg>
                              </i>
                           </a>
                           <div class="textopen">
                              <div class="text ">
                                 <span></span>
                                 <div>
                                       <?php the_field('description');?>
                                       <?php if( get_field('url_for_button') ): ?>
                                          <a href="<?php the_field('url_for_button');?>" class="btn"><?php the_field('title_of_button');?> <i class="la la-angle-right"></i> </a>
                                       <?php endif; ?>
                                 </div>
                              </div>
                           </div>
                     </li>

                    <?php endwhile;
                    ?>
                    <nav class="pagination">
                        <?php
                        $big = 999999999;
                        echo paginate_links( array(
                            'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                            'format' => '?paged=%#%',
                            'current' => max( 1, get_query_var('paged') ),
                            'total' => $loop->max_num_pages,
                            'prev_text' => '<i class="la la-angle-left"></i>',
                            'next_text' => '<i class="la la-angle-right"></i>'
                        ) );
                    ?>
                    </nav>
                <?php wp_reset_postdata(); ?>
            </ul>
            <!-- <div class="pagination">
                <a href="#"><i class="la la-angle-left"></i> </a>
                <a href="#" class="active">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#"><i class="la la-angle-right"></i> </a>
            </div> -->
        </div>
    </div>
    <?php get_template_part( 'parts/info-bloks' ); ?>
</main>
<?php get_footer(); ?>
