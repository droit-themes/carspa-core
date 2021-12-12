<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Widgets;

use \DROIT_ELEMENTOR_PRO\Modules\Widgets\Blogs\Blogs_Control as Control;
use \DROIT_ELEMENTOR_PRO\Modules\Widgets\Blogs\Blogs_Module as Module;
use \ELEMENTOR\Icons_Manager;
use \Elementor\Plugin;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Blogs extends Control
{
    
    public function get_name()
    {
        return Module::get_name();
    }

    public function get_title()
    {
        return Module::get_title();
    }

    public function get_icon()
    {
        return Module::get_icon();
    }

    public function get_categories()
    {
        return Module::get_categories();
    }

    public function get_keywords()
    {
        return Module::get_keywords();
    }

    protected function _register_controls()
    {
        $this->_dl_pro_blogs_preset_controls();
        $this->_dl_pro_blogs_style_one_controls();
        do_action('dl_widget/section/style/custom_css', $this);
    }

    //Html render
    protected function render()
    {   
       
        $settings = $this->get_settings();

        $settings['widget_id'] = $this->get_id();

        $blog_helper = \DROIT_ELEMENTOR_PRO\Module\Query\Posts_Query::getInstance();

        $blog_helper->set_widget_settings( $settings );
        $query_postss = $blog_helper->get_query_args();
        $query_posts = $blog_helper->get_query_posts();
        
        if ( ! $query_posts->have_posts() ) {

            $query_notice = $this->get_pro_blogs_settings('empty_query_text');

            $this->get_empty_query_message( $query_notice );
            return;
        }
        $skin = $this->get_pro_blogs_settings('_dl_pro_blogs_skin');
        $skin_layouts = $this->get_pro_blogs_settings('_dl_pro_blogs_design_skin');

        $this->add_render_attribute(
            '_dl_pro_blog_wrapper',
            [
                'id' => "droit-id-{$this->get_id()}",
                'class' => ['droit__blog--wrap', $skin],
            ]
        );
        //Layouts
        if ( in_array( $skin, array( '_skin_1' ), true ) && in_array( $skin_layouts, array( 'masonry' ), true )  ) {
            $this->add_render_attribute( 
                '_dl_pro_blog_wrapper', 
                [
                    'class' => [$skin_layouts],
                    'data-layout' => $skin_layouts
                ]
            );
        }
        if ( in_array( $skin, array( '_skin_2' ), true ) ) {
            $this->add_render_attribute( 
                '_dl_pro_blog_wrapper', 
                [
                    'class' => ['tab'],
                    'data-layout'=> 'tab'
                ]
            );
        }
        $page_id = '';
		if ( null !== \Elementor\Plugin::$instance->documents->get_current() ) {
			$page_id = \Elementor\Plugin::$instance->documents->get_current()->get_main_id();
		}
		$this->add_render_attribute( '_dl_pro_blog_wrapper', 'data-page', $page_id );
        $this->add_render_attribute( '_dl_pro_blog_wrapper_inner', 
            'class', [
                'droit__blog---inner-wrap',
                ] 
            );
            if ( 'yes' === $this->get_pro_blogs_settings('_dl_pro_blog_paging_one') ) {

                $total_pages = $query_posts->max_num_pages;
    
                if ( ! empty( $this->get_pro_blogs_settings('_dl_pro_blog_max_pages_one') ) ) {
                    $total_pages = min( $this->get_pro_blogs_settings('_dl_pro_blog_max_pages_one'), $total_pages );
                }
            }
        if ( 'yes' === $this->get_pro_blogs_settings('_dl_pro_blog_paging_one') && $total_pages > 1 ) {

            $this->add_render_attribute( '_dl_pro_blog_wrapper', 'data-pagination', 'true' );

        }
        if ( in_array( $skin, array( '_skin_1' ), true ) && in_array( $skin_layouts, array( 'masonry' ), true )  ) {
            $grid_options = $this->get_grid_options( $settings );
            $this->add_render_attribute( '_dl_pro_blog_wrapper_inner', [
                'class' => [ 'dl_addons_grid_wrapper', 'dl_grid_metro', ],
                'data-grid'      => wp_json_encode( $grid_options ),
            ] );
        }
        ?>
        <div <?php $this->print_render_attribute_string( '_dl_pro_blog_wrapper' ); ?> >
            <div <?php $this->print_render_attribute_string( '_dl_pro_blog_wrapper_inner' ); ?> >
                <?php
                    if ( in_array( $skin, array( '_skin_1' ), true ) ) {
                        include 'style/'.$skin_layouts.'.php'; 	
                    }elseif ( in_array( $skin, array( '_skin_2' ), true ) ) {
                        include 'style/tab.php';
                    }
                ?>
            </div>
        </div>
        <?php
        if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) {

            if ( in_array( $skin, array( '_skin_1' ), true ) && in_array( $skin_layouts, array( 'masonry' ), true )  ) {
					$this->render_editor_script();
				}
		}
    }

	protected function get_empty_query_message( $notice ) {

		if ( empty( $notice ) ) {
			$notice = __( 'The current query has no posts. Please make sure you have published items matching your query.', 'droit-elementor-addons-pro' );
		}

		?>
		<div class="droit-error-notice">
			<?php echo wp_kses_post( $notice ); ?>
		</div>
		<?php
    }

    protected function get_grid_options( array $settings ) {
        $grid_options = [
            'type'  => $this->get_pro_blogs_settings('_dl_pro_masonary_type_one'),
        ];
    
        // Columns.
        if ( ! empty( $this->get_pro_blogs_settings('_dl_pro_blog_grid_columns_one') ) ) {
            $grid_options['columns'] = $this->get_pro_blogs_settings('_dl_pro_blog_grid_columns_one');
        }
    
        if ( ! empty( $this->get_pro_blogs_settings('_dl_pro_blog_grid_columns_one_tablet') ) ) {
            $grid_options['columnsTablet'] = $this->get_pro_blogs_settings('_dl_pro_blog_grid_columns_one_tablet');
        }
    
        if ( ! empty( $this->get_pro_blogs_settings('_dl_pro_blog_grid_columns_one_mobile') ) ) {
            $grid_options['columnsMobile'] = $this->get_pro_blogs_settings('_dl_pro_blog_grid_columns_one_mobile');
        }
    
        // Gutter
        if ( ! empty( $this->get_pro_blogs_settings('_dl_pro_blog_grid_gutter_one') ) ) {
            $grid_options['gutter'] = $this->get_pro_blogs_settings('_dl_pro_blog_grid_gutter_one');
        }
    
        if ( ! empty( $this->get_pro_blogs_settings('_dl_pro_blog_grid_gutter_one_tablet') ) ) {
            $grid_options['gutterTablet'] = $this->get_pro_blogs_settings('_dl_pro_blog_grid_gutter_one_tablet');
        }
    
        if ( ! empty( $this->get_pro_blogs_settings('_dl_pro_blog_grid_gutter_one_mobile') ) ) {
            $grid_options['gutterMobile'] = $this->get_pro_blogs_settings('_dl_pro_blog_grid_gutter_one_mobile');
        }
    
        // Zigzag height.
        if ( ! empty( $this->get_pro_blogs_settings('_dl_pro_blog_zigzag_height_one') ) ) {
            $grid_options['zigzagHeight'] = $this->get_pro_blogs_settings('_dl_pro_blog_zigzag_height_one');
        }
    
        if ( ! empty( $this->get_pro_blogs_settings('_dl_pro_blog_zigzag_height_one_tablet') ) ) {
            $grid_options['zigzagHeightTablet'] = $this->get_pro_blogs_settings('_dl_pro_blog_zigzag_height_one_tablet');
        }
    
        if ( ! empty( $this->get_pro_blogs_settings('_dl_pro_blog_zigzag_height_one_mobile') ) ) {
            $grid_options['zigzagHeightMobile'] = $this->get_pro_blogs_settings('_dl_pro_blog_zigzag_height_one_mobile');
        }
    
        if ( ! empty( $this->get_pro_blogs_settings('_dl_pro_blog_zigzag_reversed_one') ) && 'yes' === $this->get_pro_blogs_settings('_dl_pro_blog_zigzag_reversed_one') ) {
            $grid_options['zigzagReversed'] = 1;
        }
    
        return $grid_options;
    }

    protected function render_editor_script() {

		?>
		<script type="text/javascript">
			jQuery(".droit__blog---inner-wrap").each(function () {
                var dl_addons_grid_wrapper = jQuery('.droit__blog---inner-wrap');
                if (dl_addons_grid_wrapper.length) {
                    jQuery(this).dlAddonsGridLayout();
                }
            });
		</script>
		<?php
	}
    protected function content_template()
    {}
}