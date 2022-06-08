<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Shapely
 */

get_header(); ?>
    <?php $layout_class = ( function_exists('shapely_get_layout_class') ) ? shapely_get_layout_class(): ''; ?>  
    <div id="primary" class="col-md-9 mb-xs-24 <?php echo $layout_class; ?>">

            <div id="domain_page">         

                <div id="page_content">   
                    <?php while ( have_posts() ) : the_post() ; $count++;
                        $id = get_the_ID();

                         $terms = get_the_terms( $id , 'domain_cat' );

                         if($terms != null){
                            $domain_cat = $terms ;
                         }else{
                            $domain_cat = "No Category";
                         }

                         foreach ( $domain_cat as $term ) { 
                            $domain_cat = $term->name;
                            $domain_cat_id = $term->term_id;
                            $link = get_term_link($term);
                         }
                     endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                    <?php // Get total number of posts in post-type-name
                        $count_posts = wp_count_posts('domains');
                        $total_posts = $count_posts->publish;
                        
                        if ($count != 0) {
                            echo "<h6 style='margin-left:10px;'>Displaying: " ."<b>". $count ." ". $domain_cat."</b>". " Posts Of " ."<b>". $total_posts ."</b>". " Domain Posts.</h6>";
                        }else {
                            echo "<h6 style='margin-left:10px;text-transform:capitalize;'>Displaying: " ."<b> Zero ".$domain_cat."</b>". " Post Of " ."<b>". $total_posts ."</b>". " Domain Posts.</h6>";
                        }
                    ?>            
                    <table>
                            <tr id="table_head">
                                <td>DOMAIN NAME</td>
                                <td>CATEGORY</td>
                                <td>BUY NOW</td>
                                <td>LEASE NOW</td>
                            </tr>

                        <?php
                            //list terms in a given taxonomy (useful as a widget for twentyten)
                            // $taxonomy = 'domain_cat';
                            // $tax_terms = get_terms($taxonomy);
                        
                        while ( have_posts() ) : the_post() ;                         

                        // $prefix = '_cmb_';

                        $pricebox = get_post_meta($id, 'priceBox', true);   
                        $domainselect = get_post_meta($id, 'domainSelect', true);   

                        if ($pricebox){ $set_pricebox = $pricebox;}
                        else{ $set_pricebox = "price";}     

                        if ($domainselect){ $set_domain = $domainselect;}
                        else{ $set_domain = ".domain";}                      

                        ?>              
                        
                            <tr>
                                <td><a id="domain" href="<?php the_permalink(); ?>"><?php the_title(); ?><span><?php echo $set_domain; ?></span></a></td>
                                <td><a id="category" href="<?php echo $link; ?>" title="<?php echo $domain_cat; ?>"><?php echo $domain_cat; ?></a></td>
                                <td><a id="buy" href="<?php the_permalink(); ?>">buy now</a></td>
                                <td><a id="lease">$ <?php echo $set_pricebox; ?></a></td>
                            </tr>

                        <?php endwhile; ?>


                    </table>
                    <br>
                    <?php wp_pagenavi(); ?>
                    <br><br>
                </div>

            </div>       
    </div><!-- #primary -->
    
<aside id="domain_aside" class="widget-area col-md-3 hidden-sm" role="complementary">
  <?php dynamic_sidebar( 'domain_page_sidebar' ); ?>
</aside>

<?php get_footer(); ?>
