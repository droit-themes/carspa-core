<?php if('category' == $this->get_pro_blogs_settings('_dl_pro_blog_post_type_one')): ?>
<div class="dl_container">
    <div class="dl_row">
        <div class="dl_col_lg_12">
            <?php 
                $this->add_render_attribute(
                    'tab_pro_wrap',
                    [
                        'id' => "droit-blog-tabs-{$this->get_id()}",
                        'class' => [
                            'dl_tab_container',
                            'droit-blog-tabs-container',
                            'droit-advance-tabs',
                            'dl_style_12',
                            'droit__pro_blog',
                            'style_01',
                            '_skin_one',
                        ],
                        'data-tabid' => $this->get_id(),
                    ]
                );
            
            ?>
            <div <?php echo $this->get_render_attribute_string('tab_pro_wrap'); ?>>
                <div class="droit-tabs-nav droit-advance-tabs-navs">
                    <ul class="dl_tab_menu droit-tabs-nav">
                    <?php
                     $id_int = substr( $this->get_id_int(), 0, 4 );
                     $include_cats = $this->get_pro_blogs_settings('_dl_pro_blog_post_include_category_one');
                     $category_include = !empty($include_cats) ? $include_cats : array_keys(DROIT_ELEMENTOR_PRO\Core\Utils::droit_pro_categories()) ;
                     $category_exclude = $this->get_pro_blogs_settings('_dl_pro_blog_post_exclude_category_one');

                     $selected_categories = !empty($category_exclude) ? array_diff($category_include, $category_exclude) : $category_include; 
                    
                     $tab_count = 1;
                     foreach( $selected_categories as $cats_id ) :
                        $active_default = ($tab_count == 1) ? '' : '';
                     ?>
                     <li id="droit-tab-title-<?php echo $id_int . $tab_count ?>" role="droitlab" data-tab="<?php echo $tab_count; ?>" class="dl_tab_menu_item droit-tab-nav-items <?php echo $active_default; ?>" aria-controls="droit-tab-content-<?php echo $tab_count; ?>"><span class="post__tab--title"><?php echo DROIT_ELEMENTOR_PRO\Core\Utils::droit_pro_categories($cats_id); ?></span></li>
                     
                     <?php 
                    $tab_count++;
                    endforeach; 
                    ?>
                    </ul>
                </div>
                <div class="tab_container">
                <?php 
                $tab_content_count = 1;
                foreach( $selected_categories as $cats_id ) : 
                    $active_default = ($tab_content_count == 1) ? '' : '';
                    ?>
                    <div id="tab_<?php echo esc_attr($cats_id); ?>" class="dl_tab_content_wrapper <?php echo $active_default; ?>" >
                        <div class="dl_row">
                            <?php 
                            $post_source = ( ! empty( $this->get_pro_blogs_settings('_dl_pro_blog_post_type_one') ) ) ? $this->get_pro_blogs_settings('_dl_pro_blog_post_type_one') : '';
                            $exclude_ids =  ! empty( $this->get_pro_blogs_settings('_dl_pro_blog_exclude_post_id_one') ) ? $this->get_pro_blogs_settings('_dl_pro_blog_exclude_post_id_one') : '';
                            $post_exclude_id = ! empty( $exclude_ids ) ? $exclude_ids : array();
                            $cat_include_id = ( ! empty( $this->get_pro_blogs_settings('_dl_pro_blog_post_include_category_one') )) ? $this->get_pro_blogs_settings('_dl_pro_blog_post_include_category_one') : '';
                            $cat_exclude_id = ( ! empty( $this->get_pro_blogs_settings('_dl_pro_blog_category_exclude_one') )) ? $this->get_pro_blogs_settings('_dl_pro_blog_category_exclude_one') : '';
                            $offset = $this->get_pro_blogs_settings('_dl_pro_blog_post_offset_one');

                            $query = array(			
                                'orderby'             => !empty($this->get_pro_blogs_settings('_dl_pro_blog_order_by_one')) ? $this->get_pro_blogs_settings('_dl_pro_blog_order_by_one') : 'date',
                                'order'               => !empty($this->get_pro_blogs_settings('_dl_pro_blog_order_one')) ? $this->get_pro_blogs_settings('_dl_pro_blog_order_one') : 'asc',
                                'posts_per_page'      => !empty($this->get_pro_blogs_settings('_dl_pro_blog_posts_per_page_one')) ? $this->get_pro_blogs_settings('_dl_pro_blog_posts_per_page_one') : 4,
                                'post_status'         => 'publish',
                                'cat'                 => $cats_id,
                                'offset'              => $offset,
                            );
                            if( 'caregory' == $post_source && !empty( $post_exclude_id ) ){
                                $post__not_in = array(
                                    'post__not_in' => $post_exclude_id
                                );
                    
                                $query = array_merge( $query, $post__not_in );
                            }
                            if( 'caregory' == $post_source && !empty( $cat_exclude_id ) ) {
                                $tax_query[] = array(
                                    'taxonomy' => 'category',
                                    'terms'    => $cat_exclude_id,
                                    'operator' => 'NOT IN',
                                );
                            }
                            $tax_query[] = array(
                                'taxonomy' => 'post_format',
                                'field'    => 'slug',
                                'terms' => array( 'post-format-quote', 'post-format-link' ),
                                'operator' => 'NOT IN'
                            );
                            
                            // Combine taxonomy query with main query
                            if( ! empty( $tax_query ) ) {
                                $tax_query = array_merge( array( 'relation' => 'AND' ), $tax_query );
                                $query = array_merge( $query, array( 'tax_query' => $tax_query ) );
                            }
                            if('yes' === $this->get_pro_blogs_settings('_dl_pro_blog_ignore_sticky_posts_one') ){
                                $ignore_sticky_posts = array(
                                    'ignore_sticky_posts' => true
                                );
                    
                                $query = array_merge( $query, $ignore_sticky_posts );
                            }
                            // Query by date
                            $select_date = $this->get_pro_blogs_settings('_dl_pro_blog_post_select_date_one');
                                if (!empty($select_date)) {
                                    $date_query = [];
                                    switch ($select_date) {
                                        case 'today':
                                            $date_query['after'] = '-1 day';
                                            break;
                                        case 'week':
                                            $date_query['after'] = '-1 week';
                                            break;
                                        case 'month':
                                            $date_query['after'] = '-1 month';
                                            break;
                                        case 'quarter':
                                            $date_query['after'] = '-3 month';
                                            break;
                                        case 'year':
                                            $date_query['after'] = '-1 year';
                                            break;
                                        case 'exact':
                                            $after_date = $this->get_pro_blogs_settings('_dl_pro_blog_post_date_after_one');
                                            if (!empty($after_date)) {
                                                $date_query['after'] = $after_date;
                                            }
                                            $before_date = $this->get_pro_blogs_settings('_dl_pro_blog_post_date_before_one');
                                            if (!empty($before_date)) {
                                                $date_query['before'] = $before_date;
                                            }
                                            $date_query['inclusive'] = true;
                                            break;
                                    }
                                    $query_by_date = array(
                                        'date_query' => $date_query
                                    );
                        
                                    $query = array_merge( $query, $query_by_date );
                                }
                            $tab_query = new WP_Query( $query );;
                            ?>
                             <?php if ( $tab_query->have_posts() ): 
                                while ( $tab_query->have_posts() ) : $tab_query->the_post();
                                ?>
                                <div class="dl_col_lg_6">
                                    <div class="dl_tab_item">
                                    <?php if('yes' === $this->get_pro_blogs_settings('_dl_pro_blog_show_thumb_one') ): ?>
                                        <div class="dl_tab_thumb">
                                            <?php 
                                            if ( has_post_thumbnail() ) :
                                                $size = $this->get_pro_blogs_settings('thumbnail_one_size');
                                                the_post_thumbnail( $size, array( 'class' =>'dl_img_res' ) );
                                            endif;
                                            ?>
                                        </div>
                                        <?php endif; ?>
                                        <div class="dl_tab_content_inner">
                                        <?php if('yes' === $this->get_pro_blogs_settings('_dl_pro_blog_show_title_one') ): ?>
                                            <?php 
                                                if(!empty($this->get_pro_blogs_settings('dl_pro_blog_one_title_length'))){
                                                    $title_content = wp_trim_words( get_the_title(), $this->get_pro_blogs_settings('dl_pro_blog_one_title_length'), '' );
                                                }else{
                                                    $title_content = get_the_title();
                                                }
                                            ?>
                                            <<?php echo esc_attr($this->get_pro_blogs_settings('_dl_pro_blog_title_tag_one')); ?> class="tab__post--title"><?php echo $title_content; ?></<?php echo esc_attr($this->get_pro_blogs_settings('_dl_pro_blog_title_tag_one')); ?>>
                                            <?php endif; ?>
                                                <?php if('yes' === $this->get_pro_blogs_settings('_dl_pro_blog_show_excerpt_one')): ?>
                                                    <?php     
                                                        $excerpt_content = strip_shortcodes( droit_shorten_text( get_the_excerpt(), $this->get_pro_blogs_settings('dl_pro_blog_one_excerpt_length') ) ); 
                                                        $content = strip_shortcodes( droit_shorten_text( get_the_content(), $this->get_pro_blogs_settings('dl_pro_blog_one_excerpt_length') ) ); 
                                                    
                                                    if ( ! has_excerpt() ) {
                                                        echo '<p class="tab__post--content">' . $content . '</p>';
                                                    } else { 
                                                        echo '<p class="tab__post--content">' . $excerpt_content . '</p>';
                                                    }
                                                    ?>
                                                <?php endif; ?>
                                                <?php if('yes' === $this->get_pro_blogs_settings('_dl_pro_blog_show_read_more_one') && !empty($this->get_pro_blogs_settings('_dl_pro_blog_read_more_text_one'))): ?>
                                                    <a href="<?php echo esc_url(get_the_permalink()); ?>" class="dl_travel_btn dl_hover_style1 tab__post--button"><?php echo esc_html($this->get_pro_blogs_settings('_dl_pro_blog_read_more_text_one'), 'droit-elementor-addons-pro');?></a>
                                                <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; wp_reset_postdata(); ?>
                        <?php endif ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php else: ?>
    <h3><?php echo esc_html('Select category first.', 'droit-elementor-addons-pro');?></h3>
<?php endif; ?>