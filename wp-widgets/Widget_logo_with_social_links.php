<?php
// Footer Logo Sections
class Rave_Widget_logo_with_social_links extends WP_Widget {

    public function __construct()  { // 'Banner Ad' Widget Defined
        parent::__construct('rave_logo_with_social_link',
            esc_html__('(Rave) Logo', 'rave-core'),
            array(
                'description' => esc_html__('Logo Area', 'rave-core'),
                'classname' => 'footer_logo_area',
            ));
    }

    // Front End
    public function widget($args, $instance) {

        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }

        $logo = function_exists('get_field') ? get_field( 'footer_logo',  'widget_'.$args['widget_id']) : '';
        $logo_text = function_exists('get_field') ? get_field( 'logo_text',  'widget_'.$args['widget_id']) : '';
        $contents = function_exists('get_field') ? get_field( 'contents',  'widget_'.$args['widget_id']) : '';
        $social_links = function_exists('get_field') ? get_field( 'social_links',  'widget_'.$args['widget_id']) : '';

        echo $args['before_widget'];

        if ( $logo ) {
            ?>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
                <?php echo !empty($logo['id']) ? wp_get_attachment_image($logo['id'], 'full') : ''; ?>
                <?php echo !empty($logo_text) ? '<h3>'.esc_html($logo_text).'</h3>' : ''; ?>
            </a>
            <?php
        }
        if ( $contents ) {
            ?>
            <p class="content"><?php echo esc_html($contents) ?></p>
            <?php
        }
        if ( $social_links == '1' ) {
            ?>
            <ul class="list-unstyled f_social_icon">
                <?php Rave_helper()->social_links(); ?>
            </ul>
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