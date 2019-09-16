<?php
/* Template Name: Toepassingen pagina */

get_header();

?>
			<article id="featured">
				<h2><?php the_field("titel"); ?></h2>
			</article>
			<article id="content">
				<header class="heading-a">
            <h3><span class="small"><?php the_field("titel_rood"); ?></span></h3>
				</header>

          <?php

          $posts = "sectoren";
          $terms = "categorie";
          $count = -1;
          $tax_terms = get_terms( $terms, 'orderby=menu_order');

          if(!empty( $tax_terms)) {
          foreach ( $tax_terms as $term ) {
          echo '<header class="heading-a"><p>' . $term->name . '</p></header> <ul class="gallery-b">';

              $args = array(
              'posts_per_page' => $count,
               $terms => $term->slug,
              'post_type' => $posts,
              'lang'      => pll_current_language( 'slug' ),
               );
              $tax_terms_posts = get_posts( $args );
              foreach ( $tax_terms_posts as $post ) { ?>
                  <li><a href="<?php the_permalink(); ?>"><img src="<?php $image = get_field('foto_iphone');
                       echo $image['sizes']['medium']; ?>" alt="Foto uitleg" width="300" height="300"> </a>
                    <div>
                      <h4><span><?php the_title(); ?></span> <?php pll_e("Klik voor meer info"); ?></h4>
                    </div>
                  </li>
              <?php }
          echo '</ul>';
          }
          wp_reset_postdata();
          } else {
              echo "<p>";
              pll_e("Momenteel zijn er geen sectoren gevonden.");
              echo "</p>";
             } ?>

          <?php

          
          $args = array(
              'posts_per_page' => $count,
              'post_type' => $posts,
              'lang'      => pll_current_language( 'slug' ),
          'tax_query' => [
                  [
                      'taxonomy' => $terms,
                      'terms'    => get_terms( $terms, [ 'fields' => 'ids'  ] ),
                      'operator' => 'NOT IN'
                  ]
              ]
               );
              $overschot = get_posts( $args );
              if(!empty( $overschot)) {
			echo '<header class="heading-a"><p>';
          pll_e("Andere");
          echo '</p></header> <ul class="gallery-b">';
              foreach ( $overschot as $post ) { ?>
                  <li><a href="<?php the_permalink(); ?>"><img src="<?php $image = get_field('foto_iphone');
                       echo $image['sizes']['medium']; ?>" alt="Foto uitleg" width="300" height="300"> </a>
                    <div>
                      <h4><span><?php the_title(); ?></span> <?php pll_e("Klik voor meer info"); ?></h4>
                    </div>
                  </li>
              <?php }
          echo '</ul>';
          wp_reset_postdata();
          } ?>
			</article><?php
get_footer();
?>
