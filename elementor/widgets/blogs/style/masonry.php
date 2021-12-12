<?php
$settings = $this->get_settings();

$settings['widget_id'] = $this->get_id();
$blog_helper = \DROIT_ELEMENTOR_PRO\Module\Query\Posts_Query::getInstance();

$blog_helper->set_widget_settings($settings);
$query_posts = $blog_helper->get_query_posts();

$this->add_render_attribute('_dl_pro_blog_wrapper', 'data-grid', wp_json_encode($grid_options));

if (isset($settings['_dl_pro_blog_grid_metro_layout_one']) && !empty($settings['_dl_pro_blog_grid_metro_layout_one'])) {
    $metro_layout = [];

    foreach ($this->get_pro_blogs_settings('_dl_pro_blog_grid_metro_layout_one') as $key => $value) {
        $metro_layout[] = $value['_dl_pro_blog_size_one'];

    }
} else {
    $metro_layout = [
        '2:2',
        '1:1',
        '1:1',
        '1:1',
        '1:1',
        '1:1',
    ];
}
if (count($metro_layout) < 1) {
    return;
}
$metro_layout_count = count($metro_layout);
$metro_item_count = 0;
$count = $query_posts->post_count;

?>
    <div class="dl_addons_grid dl_travel_package_style_one dl_travel_gallery_info dl_travel_gallery_area">
        <div class="grid-sizer" data-width="1"></div>
        <?php
while ($query_posts->have_posts()):
    $query_posts->the_post();

    $size = $metro_layout[$metro_item_count];

    $ratio = explode(':', $size);

    $ratioW = $ratio[0];
    $ratioH = $ratio[1];
    ?>
        <div data-width="<?php echo esc_attr($ratioW); ?>" class="grid-item">
            <div class="dl_travel_gallery_item wow fadeInUp" data-wow-delay="0.1s">
                <?php $blog_helper->get_post_thumbnail();?>
                <div class="dl_overlay_bg"></div>
                <div class="dl_travel_gallery_content">
                    <div class="dl_content">
                        <?php $blog_helper->ordering()?>
                    </div>
                </div>
            </div>
        </div>
    <?php
    $metro_item_count++;
    if ($metro_item_count == $count || $metro_layout_count == $metro_item_count) {
        $metro_item_count = null;
    }
endwhile;
wp_reset_postdata();
?>
    </div>
