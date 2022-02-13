<?php
// Banner Ad
class Rave_Widget_Banner_Ad extends WP_Widget {

    public function __construct()  { // 'Banner Ad' Widget Defined
        parent::__construct('banner_ad',
            esc_html__('(Rave) Banner Ad', 'rave-core'),
            array(
                'description' => esc_html__('Banner Ad', 'rave-core'),
                'classname' => 'add_widget',
            ));
    }

    // Front End
    public function widget($args, $instance) {
        wp_enqueue_script( 'ajax-chimp');
        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }
        $title = function_exists('get_field') ? get_field( 'title',  'widget_'.$args['widget_id']) : '';
        $subtitle = function_exists('get_field') ? get_field( 'subtitle',  'widget_'.$args['widget_id']) : '';
        $banner_image = function_exists('get_field') ? get_field( 'banner_image',  'widget_'.$args['widget_id']) : '';
        $link = function_exists('get_field') ? get_field( 'banner_url',  'widget_'.$args['widget_id']) : '';
        $link_url = !empty($link['url']) ? $link['url'] : '#';
        $link_target = !empty($link['target']) ? $link['target'] : '_self';
        echo $args['before_widget'];

        if ( $banner_image ) {
            ?>
            <a href="<?php echo esc_url($link_url) ?>" target="<?php echo esc_attr($link_target) ?>">
                <?php echo !empty($banner_image['id']) ? wp_get_attachment_image($banner_image['id'], 'full') : ''; ?>
                <div class="content">
                    <?php
                    echo !empty($title) ? '<h5>'.esc_html($title).'</h5>' : '';
                    echo !empty($subtitle) ? '<h2>'.esc_html($subtitle).'</h2>' : '';
                    ?>
                </div>
            </a>
            <?php
        }

        echo $args['after_widget'];
    }

    public function form( $instance ) {

    }

    // Update Data
    public function update($new_instance, $old_instance){
        $instance = $old_instance;
        return $instance;
    }

}