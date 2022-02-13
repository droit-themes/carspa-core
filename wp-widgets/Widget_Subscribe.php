<?php
// About us
class Rave_Widget_Subscribe extends WP_Widget {
    public function __construct()  { // 'About us' Widget Defined
        parent::__construct( 'subscribe', esc_html__( '(Rave) Subscribe Form', 'rave-core'), array(
            'description'   => esc_html__( 'MailChimp Subscribe form.', 'rave-core'),
            'classname'     => 'subscribe_widget'
        ));
    }

    // Front End
    public function widget($args, $instance) {
        $title      = isset($instance['title']) ? $instance['title'] : '';
        $btn_title      = isset($instance['btn_title']) ? $instance['btn_title'] : esc_html__( 'Subscribe', 'rave-core');
        $action_url = !empty($instance['action_url']) ? $instance['action_url'] : '#';
        $allowed_html = array(
            'div' => array(
                'id' => array(),
                'class' => array(),
            ),
            'h3' => array(
                'class' => array(),
            ),
            'h4' => array(
                'class' => array(),
            ),
            'h5' => array(
                'class' => array(),
            ),
            'h6' => array(
                'class' => array(),
            ),
        );

        wp_enqueue_script( 'ajax-chimp');

        echo wp_kses($args['before_widget'], $allowed_html);
        echo wp_kses($args['before_title'], $allowed_html).esc_html($title).wp_kses($args['after_title'], $allowed_html);
        ?>

        <form action="<?php echo esc_url($action_url) ?>" class="blog_subscribe_info" method="post">
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="<?php esc_attr_e( 'Your Name*', 'rave-core'); ?>">
            </div>
            <div class="form-group email">
                <input type="text" name="EMAIL" class="form-control memail" placeholder="<?php esc_attr_e( 'Email Address*', 'rave-core'); ?>">
            </div>
            <button type="submit" class="home_btn_hover hover_style1">
                <?php echo esc_html($btn_title); ?>
                <i class="icon-arrow-right-2"></i>
            </button>
            <p class="mchimp-errmessage" style="display: none;"></p>
            <p class="mchimp-sucmessage" style="display: none;"></p>
        </form>


        <script>
            ;(function($){
                "use strict";
                $(document).ready(function () {
                    // MAILCHIMP
                    if ($(".mailchimp").length > 0) {
                        $(".mailchimp").ajaxChimp({
                            callback: mailchimpCallback,
                            url: "<?php echo esc_js($action_url); ?>"
                        });
                    }
                    $(".memail").on("focus", function () {
                        $(".mchimp-errmessage").fadeOut();
                        $(".mchimp-sucmessage").fadeOut();
                    });
                    $(".memail").on("keydown", function () {
                        $(".mchimp-errmessage").fadeOut();
                        $(".mchimp-sucmessage").fadeOut();
                    });
                    $(".memail").on("click", function () {
                        $(".memail").val("");
                    });

                    function mailchimpCallback(resp) {
                        if (resp.result === "success") {
                            $(".mchimp-errmessage").html(resp.msg).fadeIn(1000);
                            $(".mchimp-sucmessage").fadeOut(500);
                        } else if (resp.result === "error") {
                            $(".mchimp-errmessage").html(resp.msg).fadeIn(1000);
                        }
                    }
                });
            })(jQuery)
        </script>

        <?php
        echo wp_kses($args['after_widget'], $allowed_html);
    }

    // Backend
    public function form($instance) {
        $title      = isset($instance['title']) ? $instance['title'] : esc_html__( 'Keep Updated', 'rave-core');
        $btn_title      = isset($instance['btn_title']) ? $instance['btn_title'] : esc_html__( 'Subscribe', 'rave-core');
        $action_url = isset($instance['action_url']) ? $instance['action_url'] : '';
        ?>
        <table style="width:100%">
            <!-- Title -->
            <tr> <th style="text-align: left"> <label for="<?php echo esc_attr($this->get_field_id( 'title')); ?>"><?php esc_html_e( 'Title', 'rave-core') ?></label> </th> </tr>
            <tr> <td> <input type="text" name="<?php echo esc_attr($this->get_field_name( 'title')); ?>" id="<?php echo esc_attr($this->get_field_id( 'title')); ?>"
                             class="widefat" value="<?php echo esc_attr($title); ?>" placeholder="<?php esc_attr_e( 'Enter the widget title', 'rave-core'); ?>"> </td> </tr>

            <!-- Button Label -->
            <tr> <th style="text-align: left"> <label for="<?php echo esc_attr($this->get_field_id( 'btn_title')); ?>"> <?php esc_html_e( 'Button Title', 'rave-core') ?> </label> </th> </tr>
            <tr> <td> <input type="text" name="<?php echo esc_attr($this->get_field_name( 'btn_title')); ?>" id="<?php echo esc_attr($this->get_field_id( 'btn_title')); ?>"
                             class="widefat" value="<?php echo esc_attr($btn_title); ?>"> </td> </tr>


            <!-- Action URL -->
            <tr> <th style="text-align: left"> <label for="<?php echo esc_attr($this->get_field_id( 'action_url')); ?>"><?php esc_html_e( 'MailChimp From Action URL', 'rave-core') ?></label> </th> </tr>
            <tr> <td> <input type="text" name="<?php echo esc_attr($this->get_field_name( 'action_url')); ?>" id="<?php echo esc_attr($this->get_field_id( 'action_url')); ?>"
                             class="widefat" value="<?php echo esc_attr($action_url); ?>" placeholder="<?php esc_attr_e( 'Enter MailChimp URL.', 'rave-core'); ?>">
                    <br/>
                    <small> <?php echo wp_kses_post(__( 'Please follow <a href="https://goo.gl/k5a2tA" target="_blank">this guide</a> to find your Mailchimp form action URL', 'rave-core')); ?> </small>
                </td>
            </tr>

        </table>
    <?php
    }

    // Update Data
    public function update($new_instance, $old_instance){
        $instance = $old_instance;
        $instance['title']      = $new_instance['title'];
        $instance['btn_title']      = $new_instance['btn_title'];
        $instance['action_url'] = $new_instance['action_url'];

        return $instance;
    }

}