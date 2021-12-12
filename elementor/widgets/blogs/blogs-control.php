<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Modules\Widgets\Blogs;

use \DROIT_ELEMENTOR\Utils as Droit_Utils;
use \DROIT_ELEMENTOR_PRO\Module\Query\Posts_Query as Query_Module;
use \DROIT_ELEMENTOR_PRO\Content_Typography;
use \DROIT_ELEMENTOR_PRO\Button;
use \DROIT_ELEMENTOR_PRO\Button_Size;
use \DROIT_ELEMENTOR_PRO\Button_Hover;
use \DROIT_ELEMENTOR_PRO\Image;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Scheme_Typography;
use \Elementor\Widget_Base;

if (!defined('ABSPATH')) {exit;}

abstract class Blogs_Control extends Widget_Base
{

    // Get Control ID
    protected function get_control_id($control_id)
    {
        return $control_id;
    }
    public function get_pro_blogs_settings($control_key)
    {
        $control_id = $this->get_control_id($control_key);
        return $this->get_settings($control_id);
    }
    //Preset
    public function _dl_pro_blogs_preset_controls()
    {
        $this->start_controls_section(
            '_dl_pr_blogs_preset_section',
            [
                'label' => __('Preset', 'droit-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            '_dl_pro_blogs_skin',
            [
                'label' => esc_html__('Design Layout', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => apply_filters('dl_widgets/pro/blog/masonry/control_presets', [
                    '_skin_1' => 'Default',
                ]),
                'default' => '_skin_1',
            ]
        );
        
        $this->end_controls_section();
    }

    public function _dl_pro_blogs_style_one_controls()
    {
        $this->_dl_pro_blog_layouts_one_controls();
        $this->_dl_pro_blogs_repeater_ordering_controls();
        $this->_dl_pro_blog_query_one_controls();
        $this->_dl_pro_blog_masonary_layout_one_controls();
        $this->_dl_pro_blog_pagination_one_controls();
        $this->_dl_pro_blog_read_more_one_controls();
        $this->_dl_pro_blog_show_hide_one_controls();
        $this->_dl_pro_bog_general_style_one_controls();
        $this->_dl_pro_blog_title_style_one_controls();
        $this->_dl_pro_blog_content_style_one_controls();
        $this->_dl_pro_blog_button_style_one_controls();
        $this->_dl_pro_blogs_thumbnail_style_one_controls();
    }
    // Blog Query
    public function _dl_pro_blog_query_one_controls()
    {
        do_action('dl_widgets/blog/pro_one/section/query/before', $this);
        $this->start_controls_section(
            '_dl_pro_blog_one_query_section',
            [
                'label' => esc_html__('Query', 'droit-elementor-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    $this->get_control_id('_dl_pro_blogs_skin') => ['_skin_1'],
                ],
            ]
        );

        $post_types = Query_Module::_get_post_types();

        $this->add_control(
            '_dl_pro_post_type_filter_one',
            array(
                'label' => __('Source', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SELECT,
                'options' => $post_types,
                'default' => 'post',
            )
        );
        $this->start_controls_tabs('_dl_pro_blog_category_tabs');

        $this->start_controls_tab('_dl_pro_blog_category_include_one',
            [
                'label' => esc_html__('Include', 'droit-elementor-addons-pro'),
                'condition' => [
                    $this->get_control_id('_dl_pro_post_type_filter_one!') => ['by_id'],
                ],
            ]
        );
        foreach ($post_types as $key => $type) {
            $taxonomy = Query_Module::get_taxnomies($key);

            if (!empty($taxonomy)) {
                foreach ($taxonomy as $index => $tax) {

                    $terms = get_terms($index, array('hide_empty' => false));

                    $related_tax = array();

                    if (!empty($terms)) {

                        foreach ($terms as $t_index => $t_obj) {

                            $related_tax[$t_obj->slug] = $t_obj->name;
                        }

                        $this->add_control(
                            'tax_' . $index . '_' . $key . '_include_one',
                            array(
                                'label' => sprintf(__('By %s', 'droit-elementor-addons-pro'), $tax->label),
                                'type' => Controls_Manager::SELECT2,
                                'default' => '',
                                'multiple' => true,
                                'label_block' => true,
                                'options' => $related_tax,
                                'condition' => [
                                    $this->get_control_id('_dl_pro_post_type_filter_one') => $key,
                                    $this->get_control_id('_dl_pro_post_type_filter_one!') => ['by_id'],
                                ],
                            )
                        );
                    }
                }
            }
        }
        $this->end_controls_tab();

        $this->start_controls_tab('_dl_pro_blog_category_exclude_one',
            [
                'label' => esc_html__('Exclude', 'droit-elementor-addons-pro'),
                'condition' => [
                    $this->get_control_id('_dl_pro_post_type_filter_one!') => ['by_id'],
                ],
            ]
        );
        foreach ($post_types as $key => $type) {
            $taxonomy = Query_Module::get_taxnomies($key);

            if (!empty($taxonomy)) {
                foreach ($taxonomy as $index => $tax) {

                    $terms = get_terms($index, array('hide_empty' => false));

                    $related_tax = array();

                    if (!empty($terms)) {

                        foreach ($terms as $t_index => $t_obj) {

                            $related_tax[$t_obj->slug] = $t_obj->name;
                        }

                        $this->add_control(
                            'tax_' . $index . '_' . $key . '_exclude_one',
                            array(
                                'label' => sprintf(__('By %s', 'droit-elementor-addons-pro'), $tax->label),
                                'type' => Controls_Manager::SELECT2,
                                'default' => '',
                                'multiple' => true,
                                'label_block' => true,
                                'options' => $related_tax,
                                'condition' => [
                                    $this->get_control_id('_dl_pro_post_type_filter_one') => $key,
                                    $this->get_control_id('_dl_pro_post_type_filter_one!') => ['by_id'],
                                ],
                            )
                        );
                    }
                }
            }
        }
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->start_controls_tabs('_dl_pro_blog_authors_tabs');

        $this->start_controls_tab('_dl_pro_blog_authors_include_one',
            [
                'label' => esc_html__('Include', 'droit-elementor-addons-pro'),
                'condition' => [
                    $this->get_control_id('_dl_pro_post_type_filter_one!') => ['by_id'],
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_blog_include_authors_one',
            array(
                'label' => __('Authors', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => Query_Module::get_authors(),
                'condition' => [
                    $this->get_control_id('_dl_pro_post_type_filter_one!') => ['by_id'],
                ],
            )
        );
        $this->end_controls_tab();

        $this->start_controls_tab('_dl_pro_blog_authors_exclude_one',
            [
                'label' => esc_html__('Exclude', 'droit-elementor-addons-pro'),
                'condition' => [
                    $this->get_control_id('_dl_pro_post_type_filter_one!') => ['by_id'],
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_blog_exclude_authors_one',
            array(
                'label' => __('Authors', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => Query_Module::get_authors(),
                'condition' => [
                    $this->get_control_id('_dl_pro_post_type_filter_one!') => ['by_id'],
                ],
            )
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->start_controls_tabs('_dl_pro_blog_category_posts_tabs');

        $this->start_controls_tab('_dl_pro_blog_category_posts_include_one',
            [
                'label' => esc_html__('Include', 'droit-elementor-addons-pro'),
                'condition' => [
                    $this->get_control_id('_dl_pro_post_type_filter_one') => ['by_id'],
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_blog_include_posts_one',
            [
                'label' => __('Posts', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => Query_Module::get_posts_list(),
                'condition' => [
                    $this->get_control_id('_dl_pro_post_type_filter_one') => ['by_id'],
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab('_dl_pro_blog_category_posts_exclude_one',
            [
                'label' => esc_html__('Exclude', 'droit-elementor-addons-pro'),
                'condition' => [
                    $this->get_control_id('_dl_pro_post_type_filter_one') => ['by_id'],
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_blog_exclude_posts_one',
            [
                'label' => __('Posts', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => Query_Module::get_posts_list(),
                'condition' => [
                    $this->get_control_id('_dl_pro_post_type_filter_one') => ['by_id'],
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            '_dl_pro_blog_ignore_sticky_posts_one', [
                'label' => __('Ignore Sticky Posts', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'description' => __('Sticky-posts ordering is visible on frontend only', 'droit-elementor-addons-pro'),
                'condition' => [
                    $this->get_control_id('_dl_pro_post_type_filter_one!') => ['by_id'],
                ],
            ]
        );

        $this->add_control(
            '_dl_pro_post_offset_one', [
                'label' => esc_html__('Offset', 'droit-elementor-addons-pro'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 0,
                'min' => '0',
                'label_block' => false,
                'description' => __('This option is used to exclude number of initial posts from being display.)', 'droit-elementor-addons-pro'),
                'condition' => [
                    $this->get_control_id('_dl_pro_post_type_filter_one!') => ['by_id'],
                ],
            ]
        );

        $this->add_control(
            '_dl_pro_post_query_exclude_current',
            array(
                'label' => __('Exclude Current Post', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'description' => __('This option will remove the current post from the query.', 'droit-elementor-addons-pro'),
                'label_on' => __('Yes', 'droit-elementor-addons-pro'),
                'label_off' => __('No', 'droit-elementor-addons-pro'),
                'condition' => [
                    $this->get_control_id('_dl_pro_post_type_filter_one!') => ['by_id'],
                ],
            )
        );
        $this->add_control(
            '_dl_pro_blog_post_select_date_one',
            [
                'label' => __('Date', 'droit-elementor-addons-pro'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'post_type' => '',
                'default' => 'anytime',
                'options' => [
                    'anytime' => __('All', 'droit-elementor-addons-pro'),
                    'today' => __('Past Day', 'droit-elementor-addons-pro'),
                    'week' => __('Past Week', 'droit-elementor-addons-pro'),
                    'month' => __('Past Month', 'droit-elementor-addons-pro'),
                    'quarter' => __('Past Quarter', 'droit-elementor-addons-pro'),
                    'year' => __('Past Year', 'droit-elementor-addons-pro'),
                    'exact' => __('Custom', 'droit-elementor-addons-pro'),
                ],
                'label_block' => false,
                'multiple' => false,
                'separator' => 'before',
                'condition' => [
                    $this->get_control_id('_dl_pro_post_type_filter_one!') => ['by_id'],
                ],
            ]
        );

        $this->add_control(
            '_dl_pro_blog_post_date_before_one',
            [
                'label' => __('Before', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::DATE_TIME,
                'post_type' => '',
                'label_block' => false,
                'multiple' => false,
                'placeholder' => __('Choose', 'droit-elementor-addons-pro'),
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_post_select_date_one') => ['exact'],
                    $this->get_control_id('_dl_pro_post_type_filter_one!') => ['by_id'],
                ],
                'description' => __('Setting a ‘Before’ date will show all the posts published until the chosen date (inclusive).', 'droit-elementor-addons-pro'),
            ]
        );
        $this->add_control(
            '_dl_pro_blog_post_date_after_one',
            [
                'label' => __('After', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::DATE_TIME,
                'post_type' => '',
                'label_block' => false,
                'multiple' => false,
                'placeholder' => __('Choose', 'droit-elementor-addons-pro'),
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_post_select_date_one') => ['exact'],
                    $this->get_control_id('_dl_pro_post_type_filter_one!') => ['by_id'],
                ],
                'description' => __('Setting an ‘After’ date will show all the posts published since the chosen date (inclusive).', 'droit-elementor-addons-pro'),
            ]
        );
        $this->add_control(
            '_dl_pro_blog_posts_per_page_one', [
                'label' => esc_html__('Posts Per Page', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::NUMBER,
                'placeholder' => esc_html__('Enter Number', 'droit-elementor-addons-pro'),
                'default' => 5,
                'condition' => [
                    $this->get_control_id('_dl_pro_post_type_filter_one!') => ['by_id'],
                ],
            ]
        );
        $this->_dl_pro_blog_order_orderby_one_controls();

        $this->add_control(
            'empty_query_text',
            array(
                'label' => __('Empty Query Text', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'condition' => [
                    $this->get_control_id('_dl_pro_post_type_filter_one!') => ['by_id'],
                ],
            )
        );
        do_action('dl_widgets/blog/pro_one/section/query/inner', $this);
        $this->end_controls_section();
        do_action('dl_widgets/blog/pro_one/section/query/after', $this);
    }

    // Blog Layouts
    public function _dl_pro_blog_layouts_one_controls()
    {
        do_action('dl_widgets/blog/pro_one/section/layout/before', $this);
        $this->start_controls_section(
            '_dl_pro_blog_one_layouts_section',
            [
                'label' => esc_html__('Layouts', 'droit-elementor-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    $this->get_control_id('_dl_pro_blogs_skin') => ['_skin_1'],
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_blogs_design_skin',
            [
                'label' => esc_html__('Skin', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    'masonry' => 'Masonry',
                ],
                'default' => 'masonry',
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_one',
                'default' => 'full',
            ]
        );
        $this->add_control(
            '_dl_pro_blog_one_title_length',
            [
                'label' => __('Title Length', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::NUMBER,
                'default' => '',
                'description' => __('Keep empty for display full title', 'droit-elementor-addons-pro'),
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_show_title_one') => 'yes',
                ],

            ]
        );
        $this->add_control(
            '_dl_pro_blog_one_excerpt_length',
            [
                'label' => __('Excerpt Length', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::NUMBER,
                'default' => apply_filters('excerpt_length', 50),
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_show_excerpt_one') => 'yes',
                ],

            ]
        );
        $this->add_control(
            '_dl_pro_blog_one_meta_data',
            [
                'label' => __('Meta Data', 'droit-elementor-addons-pro'),
                'label_block' => true,
                'type' => Controls_Manager::SELECT2,
                'default' => [],
                'multiple' => true,
                'options' => [
                    'author' => __('Author', 'droit-elementor-addons-pro'),
                    'date' => __('Date', 'droit-elementor-addons-pro'),
                    'time' => __('Time', 'droit-elementor-addons-pro'),
                    'comments' => __('Comments', 'droit-elementor-addons-pro'),
                    'modified' => __('Date Modified', 'droit-elementor-addons-pro'),
                ],
                'separator' => 'before',
            ]
        );
        do_action('dl_widgets/blog/pro_one/section/layout/inner', $this);
        $this->end_controls_section();
        do_action('dl_widgets/blog/pro_one/section/layout/after', $this);
    }
    // Blog Order Repeater
    public function _dl_pro_blogs_repeater_ordering_controls(){
        $this->start_controls_section(
            '_dl_pro_blog_one_repeater_order_section',
            [
                'label' => esc_html__('Content Ordering', 'droit-elementor-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    $this->get_control_id('_dl_pro_blogs_skin') => ['_skin_1'],
                ],
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            '_dl_pro_blog_order_enable',
            [
                'label' => __('Enable', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
            ]
        );
        $repeater->add_control(
            '_dl_pro_blog_order_label',
            [
                'label' => __('Label', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::HIDDEN,
            ]
        );
        $repeater->add_control(
            '_dl_pro_blog_order_id',
            [
                'label' => __('Id', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::HIDDEN,
            ]
        );
        
        $this->add_control(
            '_dl_pro_blog_ordering_data_one',
            [
                'label' => __('Re-order', 'droit-elementor-addons-pro'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'item_actions' =>[
                    'duplicate' => false,
                    'add' => false,
                    'remove' => false
                ],
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        '_dl_pro_blog_order_enable' => 'yes',
                        '_dl_pro_blog_order_label' => 'Title',
                        '_dl_pro_blog_order_id' => 'title',
                    ],
                    [
                        '_dl_pro_blog_order_enable' => 'yes',
                        '_dl_pro_blog_order_label' => 'Content',
                        '_dl_pro_blog_order_id' => 'content',
                    ],
                    [
                        '_dl_pro_blog_order_enable' => 'yes',
                        '_dl_pro_blog_order_label' => 'Meta',
                        '_dl_pro_blog_order_id' => 'meta',
                    ],
                    [
                        '_dl_pro_blog_order_enable' => 'yes',
                        '_dl_pro_blog_order_label' => 'Feature',
                        '_dl_pro_blog_order_id' => 'feature_image',
                    ],
                    [
                        '_dl_pro_blog_order_enable' => 'yes',
                        '_dl_pro_blog_order_label' => 'Read More',
                        '_dl_pro_blog_order_id' => 'read_more',
                    ], 
                ],
                'title_field' => '<i class="eicon-editor-list-ul"></i>{{{ _dl_pro_blog_order_label }}}',
            ]
        );
        $this->end_controls_section();
    }
    // Masonary
    public function _dl_pro_blog_masonary_layout_one_controls()
    {
        do_action('dl_widgets/blog/pro_one/section/masonry/before', $this);
        $this->start_controls_section(
            '_dl_pro_blog_masonry_section',
            [
                'label' => esc_html__('Masonry Layout', 'droit-elementor-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    $this->get_control_id('_dl_pro_blogs_skin') => ['_skin_1'],
                    $this->get_control_id('_dl_pro_blogs_design_skin') => ['masonry'],
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_masonary_type_one',
            [
                'label' => __('Masonary Type', 'droit-elementor-addons-pro'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'metro',
                'options' => [
                    'metro' => __('Metro', 'droit-elementor-addons-pro'),
                    'masonry' => __('Masonry', 'droit-elementor-addons-pro'),
                ],
            ]
        );
        $this->add_responsive_control(
            '_dl_pro_blog_zigzag_height_one',
            [
                'label' => esc_html__('Zigzag Height', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::NUMBER,
                'step' => 1,
            ]
        );

        $this->add_control(
            '_dl_pro_blog_zigzag_reversed_one',
            [
                'label' => esc_html__('Zigzag Reversed?', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_responsive_control(
            '_dl_pro_blog_grid_columns_one',
            [
                'label' => esc_html__('Columns', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 12,
                'step' => 1,
                'default' => 4,
                'tablet_default' => 2,
                'mobile_default' => 1,
            ]);

        $this->add_responsive_control(
            '_dl_pro_blog_grid_gutter_one',
            [
                'label' => esc_html__('Gutter', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 200,
                'step' => 1,
                'default' => '',
            ]);

        $layout_repeater = new \Elementor\Repeater();

        $layout_repeater->add_control(
            '_dl_pro_blog_size_one',
            [
                'label' => esc_html__('Item Size', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SELECT,
                'default' => '1:1',
                'options' => Droit_Utils::get_grid_metro_size(),
            ]);

        $this->add_control(
            '_dl_pro_blog_grid_metro_layout_one',
            [
                'label' => esc_html__('Metro Layout', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $layout_repeater->get_controls(),
                'default' => [
                    ['size' => '2:2'],
                    ['size' => '1:1'],
                    ['size' => '1:1'],
                    ['size' => '1:1'],
                    ['size' => '1:1'],
                ],
                'title_field' => '{{{ _dl_pro_blog_size_one }}}',
            ]);
            do_action('dl_widgets/blog/pro_one/section/masonry/inner', $this);
        $this->end_controls_section();
        do_action('dl_widgets/blog/pro_one/section/masonry/after', $this);
    }
    // Blog Pagination
    public function _dl_pro_blog_pagination_one_controls()
    {
        do_action('dl_widgets/blog/pro_one/section/pagination/before', $this);
        $this->start_controls_section(
            '_dl_pro_blog_one_pagination_section',
            [
                'label' => esc_html__('Pagination', 'droit-elementor-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    $this->get_control_id('_dl_pro_blogs_skin') => ['_skin_1'],
                    $this->get_control_id('_dl_pro_blogs_design_skin!') => ['masonry'],
                ],
            ]
        );

        $this->add_control(
            '_dl_pro_blog_paging_one',
            [
                'label' => __('Enable Pagination', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'description' => __('Pagination is the process of dividing the posts into discrete pages', 'droit-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            '_dl_pro_blog_max_pages_one',
            [
                'label' => __('Page Limit', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::NUMBER,
                'default' => 5,
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_paging_one') => ['yes'],
                ],
            ]
        );

        $this->add_control(
            '_dl_pro_blog_pagination_strings_one',
            [
                'label' => __('Enable Pagination Next/Prev Strings', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_paging_one') => ['yes'],
                ],
            ]
        );

        $this->add_control(
            '_dl_pro_blog_prev_text_one',
            [
                'label' => __('Previous Page String', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Previous', 'droit-elementor-addons-pro'),
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_paging_one') => ['yes'],
                    $this->get_control_id('_dl_pro_blog_pagination_strings_one') => ['yes'],
                ],
            ]
        );

        $this->add_control(
            '_dl_pro_blog_next_text_one',
            [
                'label' => __('Next Page String', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Next', 'droit-elementor-addons-pro'),
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_paging_one') => ['yes'],
                    $this->get_control_id('_dl_pro_blog_pagination_strings_one') => ['yes'],
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_pro_blog_pagination_align_one',
            [
                'label' => __('Alignment', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::CHOOSE,
                'options' => array(
                    'left' => array(
                        'title' => __('Left', 'droit-elementor-addons-pro'),
                        'icon' => 'fa fa-align-left',
                    ),
                    'center' => array(
                        'title' => __('Center', 'droit-elementor-addons-pro'),
                        'icon' => 'fa fa-align-center',
                    ),
                    'right' => array(
                        'title' => __('Right', 'droit-elementor-addons-pro'),
                        'icon' => 'fa fa-align-right',
                    ),
                ),
                'default' => 'right',
                'toggle' => false,
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_paging_one') => ['yes'],
                ],
                'selectors' => array(
                    '{{WRAPPER}} .droit' => 'text-align: {{VALUE}}',
                ),
            ]
        );
        do_action('dl_widgets/blog/pro_one/section/pagination/inner', $this);
        $this->end_controls_section();
        do_action('dl_widgets/blog/pro_one/section/pagination/after', $this);
    }
    // Order
    protected function _dl_pro_blog_order_orderby_one_controls()
    {
        $this->add_control(
            '_dl_pro_blog_order_by_one',
            [
                'label' => __('Order By', 'droit-elementor-addons-pro'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'modified' => __('Modified', 'droit-elementor-addons-pro'),
                    'date' => __('Date', 'droit-elementor-addons-pro'),
                    'rand' => __('Rand', 'droit-elementor-addons-pro'),
                    'ID' => __('ID', 'droit-elementor-addons-pro'),
                    'title' => __('Title', 'droit-elementor-addons-pro'),
                    'author' => __('Author', 'droit-elementor-addons-pro'),
                    'name' => __('Name', 'droit-elementor-addons-pro'),
                    'parent' => __('Parent', 'droit-elementor-addons-pro'),
                    'menu_order' => __('Menu Order', 'droit-elementor-addons-pro'),
                ],
                'separator' => 'before',
                'condition' => [
                    $this->get_control_id('_dl_pro_post_type_filter_one!') => ['by_id'],
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_blog_order_one',
            [
                'label' => __('Order', 'droit-elementor-addons-pro'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'ase',
                'options' => [
                    'ase' => __('Ascending Order', 'droit-elementor-addons-pro'),
                    'desc' => __('Descending Order', 'droit-elementor-addons-pro'),
                ],
                'condition' => [
                    $this->get_control_id('_dl_pro_post_type_filter_one!') => ['by_id'],
                ],
            ]
        );
    }
    // Read More
    public function _dl_pro_blog_read_more_one_controls()
    {
        do_action('dl_widgets/blog/pro_one/section/read_more/before', $this);
        $this->start_controls_section(
            '_dl_pro_blog_read_one_section',
            [
                'label' => esc_html__('Read More', 'droit-elementor-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    $this->get_control_id('_dl_pro_blogs_skin') => ['_skin_1'],
                    $this->get_control_id('_dl_pro_blog_show_read_more_one') => ['yes'],
                ],
            ]
        );

        $this->add_control(
            '_dl_pro_blog_read_more_text_one',
            [
                'label' => __('Read More Text', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Learn More »', 'droit-elementor-addons-pro'),
                
            ]
        );
        $this->add_control(
            '_dl_pro_blog_read_more_new_tab_one',
            [
                'label' => __('New Tab', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default'     => 'yes',
                'separator' => 'after',
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_read_more_text_one!') => '',
                ]
            ]
        );
        do_action('dl_widgets/blog/pro_one/section/read_more/inner', $this);
        $this->end_controls_section();
        do_action('dl_widgets/blog/pro_one/section/read_more/after', $this);
    }
    // Show Hide
    public function _dl_pro_blog_show_hide_one_controls()
    {
        do_action('dl_widgets/blog/pro_one/section/options/before', $this);
        $this->start_controls_section(
            '_dl_pro_blog_option_one_section',
            [
                'label' => esc_html__('Show/Hide', 'droit-elementor-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    $this->get_control_id('_dl_pro_blogs_skin') => ['_skin_1'],
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_blog_show_title_one',
            [
                'label' => __('Title', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'droit-elementor-addons-pro'),
                'label_off' => __('Hide', 'droit-elementor-addons-pro'),
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            '_dl_pro_blog_title_tag_one',
            [
                'label' => __('Title HTML Tag', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h3',
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_show_title_one') => ['yes'],
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_blog_show_excerpt_one',
            [
                'label' => __('Excerpt', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_off' => __('Hide', 'droit-elementor-addons-pro'),
                'label_on' => __('Show', 'droit-elementor-addons-pro'),
            ]
        );
        $this->add_control(
            '_dl_pro_blog_show_thumb_one',
            [
                'label' => __('Show Image', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_off' => __('Hide', 'droit-elementor-addons-pro'),
                'label_on' => __('Show', 'droit-elementor-addons-pro'),
            ]
        );
        $this->add_control(
            '_dl_pro_blog_show_read_more_one',
            [
                'label' => __('Read More', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'droit-elementor-addons-pro'),
                'label_off' => __('Hide', 'droit-elementor-addons-pro'),
                'default' => 'yes',
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_read_more_text_one!') => '',
                ]
            ]
        );
        $this->add_control(
            '_dl_pro_blog_show_meta_more_one',
            [
                'label' => __('Meta', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'droit-elementor-addons-pro'),
                'label_off' => __('Hide', 'droit-elementor-addons-pro'),
                'default' => 'yes',
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_one_meta_data!') => [],
                ]
            ]
        );
        do_action('dl_widgets/blog/pro_one/section/options/inner', $this);
        $this->end_controls_section();
        do_action('dl_widgets/blog/pro_one/section/options/after', $this);
    }
    // General
    public function _dl_pro_bog_general_style_one_controls()
    {
        do_action('dl_widgets/blog/pro_one/section/style/general/before', $this);
        $this->start_controls_section(
            '_dl_pro_bog_general_style_one_section',
            [
                'label' => esc_html__('General', 'droit-elementor-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    $this->get_control_id('_dl_pro_blogs_skin') => ['_skin_1'],
                ],
            ]
        );
        $this->add_responsive_control(
            '_dl_pro_bog_align_one',
            [
                'label' => __('Alignment', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'droit-elementor-addons-pro'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'droit-elementor-addons-pro'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'droit-elementor-addons-pro'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => '',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .droit__blog--wrap .dl_travel_gallery_content' => 'text-align: {{VALUE}}',
                ],
            ]
        );
        do_action('dl_widgets/blog/pro_one/section/style/general/inner', $this);
        $this->end_controls_section();
        do_action('dl_widgets/blog/pro_one/section/style/general/after', $this);
    }
    //Blog Title
    public function _dl_pro_blog_title_style_one_controls()
    {
        do_action('dl_widgets/blog/pro_one/section/style/title/before', $this);
        $this->start_controls_section(
            '_dl_pro_blogs_title_style_one_section',
            [
                'label' => esc_html__('Title', 'droit-elementor-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    $this->get_control_id('_dl_pro_blogs_skin') => ['_skin_1'],
                    $this->get_control_id('_dl_pro_blog_show_title_one') => ['yes'],
                ],
            ]
        );

        $this->start_controls_tabs('_dl_pro_blogs_title_tabs_one');

        $this->start_controls_tab('_dl_pro_blogs_title_normal_tab_one',
            [
                'label' => esc_html__('Normal', 'droit-elementor-addons-pro'),
            ]
        );
        $this->_dl_pro_blogs_title_normal_one_controls();
        $this->end_controls_tab();

        $this->end_controls_tab();

        $this->start_controls_tab('_dl_pro_blogs_title_hover_one',
            [
                'label' => esc_html__('Hover', 'droit-elementor-addons-pro'),
            ]
        );
        $this->_dl_pro_blog_title_hover_one_controls();
        $this->end_controls_tab();

        $this->end_controls_tabs();
        do_action('dl_widgets/blog/pro_one/section/style/title/inner', $this);
        $this->end_controls_section();
        do_action('dl_widgets/blog/pro_one/section/style/title/after', $this);
    }
    //Blog Title Normal
    protected function _dl_pro_blogs_title_normal_one_controls()
    {
        
        $this->add_group_control(
            Content_Typography::get_type(),
            [
                'name' => 'dl_pro_blog_title_style',
                'label' => __('Typography', 'droit-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .droit__blog--wrap .droit-blog-entry-title',
                'fields_options' => [
                    'typography' => [
                        'default' => '',
                    ],
                    'dl_pro_blog_title_style' => 'custom',
                    'font_family' => [
                        'default' => '',
                    ],
                    'font_color' => [
                        'default' => '',
                    ],
                    'font_size' => [
                        'desktop_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'tablet_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'mobile_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                    ],
                    'font_weight' => [
                        'default' => '',
                    ],
                    'text_transform' => [
                        'default' => '', // uppercase, lowercase, capitalize, none
                    ],
                    'font_style' => [
                        'default' => '', // normal, italic, oblique
                    ],
                    'text_decoration' => [
                        'default' => '', // underline, overline, line-through, none
                    ],
                    'line_height' => [
                        'desktop_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'tablet_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'mobile_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                    ],
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_blogs_title_offset_style_position_toggle',
            [
                'label' => __( 'Gaping', 'droit-elementor-addons-pro' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __( 'None', 'droit-elementor-addons-pro' ),
                'label_on' => __( 'Custom', 'droit-elementor-addons-pro' ),
                'return_value' => 'yes',
                'default' => '',
            ]
        );
        $this->start_popover();
        $this->add_responsive_control(
            '_dl_pro_blog_title_horizontal',
            [
                'label'       => __('Horizontal', 'droit-elementor-addons-pro'),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => ['px', '%', 'em', 'rem'],
                'condition'   => [
                    $this->get_control_id('_dl_pro_blogs_title_offset_style_position_toggle') => ['yes'],
                ],
                'range'       => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'render_type' => 'ui',
                'selectors'  => [
                    '{{WRAPPER}} .droit__blog--wrap .droit-blog-entry-title' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_dl_pro_blog_title_vertical',
            [
                'label'      => __('Vertical', 'droit-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                
                'range'      => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .droit__blog--wrap .droit-blog-entry-title' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        do_action('dl_widgets/blog/pro_one/section/style/title/normal/gaping', $this);
        $this->end_popover();
        do_action('dl_widgets/blog/pro_one/section/style/title/normal/bottom', $this);
    }
    
    //Blog Title Hover
    protected function _dl_pro_blog_title_hover_one_controls()
    {

        $this->add_control(
            '_dl_pro_blogs_hover_title_color_one',
            [
                'label' => __('Color', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit__blog--wrap .droit-blog-entry-title:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            '_dl_pro_blogs_hover_title_letter_spacing_one',
            [
                'label' => __('Letter Spacing', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'desktop_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .droit__blog--wrap .droit-blog-entry-title:hover' => 'letter-spacing: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        do_action('dl_widgets/blog/pro_one/section/style/title/hover', $this);
    }
    //Blog Content
    public function _dl_pro_blog_content_style_one_controls()
    {
        do_action('dl_widgets/blog/pro_one/section/style/content/before', $this);
        $this->start_controls_section(
            '_dl_pro_blogs_content_style_one_section',
            [
                'label' => esc_html__('Content', 'droit-elementor-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    $this->get_control_id('_dl_pro_blogs_skin') => ['_skin_1'],
                    $this->get_control_id('_dl_pro_blog_show_excerpt_one') => ['yes'],
                ],
            ]
        );

        $this->start_controls_tabs('_dl_pro_blogs_content_tabs_one');

        $this->start_controls_tab('_dl_pro_blogs_content_normal_tab_one',
            [
                'label' => esc_html__('Normal', 'droit-elementor-addons-pro'),
            ]
        );
        $this->_dl_pro_blogs_content_normal_one_controls();
        $this->end_controls_tab();

        $this->end_controls_tab();

        $this->start_controls_tab('_dl_pro_blogs_content_hover_one',
            [
                'label' => esc_html__('Hover', 'droit-elementor-addons-pro'),
            ]
        );
        $this->_dl_pro_blog_content_hover_one_controls();
        $this->end_controls_tab();

        $this->end_controls_tabs();
        do_action('dl_widgets/blog/pro_one/section/style/content/inner', $this);
        $this->end_controls_section();
        do_action('dl_widgets/blog/pro_one/section/style/content/after', $this);
    }
    //Blog Content Normal
    protected function _dl_pro_blogs_content_normal_one_controls()
    {
        
        $this->add_group_control(
            Content_Typography::get_type(),
            [
                'name' => 'dl_pro_blog_content_style',
                'label' => __('Typography', 'droit-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .droit__blog--wrap .droit__post--content',
                'fields_options' => [
                    'typography' => [
                        'default' => '',
                    ],
                    'dl_pro_blog_content_style' => 'custom',
                    'font_family' => [
                        'default' => '',
                    ],
                    'font_color' => [
                        'default' => '',
                    ],
                    'font_size' => [
                        'desktop_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'tablet_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'mobile_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                    ],
                    'font_weight' => [
                        'default' => '',
                    ],
                    'text_transform' => [
                        'default' => '', // uppercase, lowercase, capitalize, none
                    ],
                    'font_style' => [
                        'default' => '', // normal, italic, oblique
                    ],
                    'text_decoration' => [
                        'default' => '', // underline, overline, line-through, none
                    ],
                    'line_height' => [
                        'desktop_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'tablet_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'mobile_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                    ],
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_blogs_content_offset_style_position_toggle',
            [
                'label' => __( 'Gaping', 'droit-elementor-addons-pro' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __( 'None', 'droit-elementor-addons-pro' ),
                'label_on' => __( 'Custom', 'droit-elementor-addons-pro' ),
                'return_value' => 'yes',
                'default' => '',
            ]
        );
        $this->start_popover();
        $this->add_responsive_control(
            '_dl_pro_blog_content_horizontal',
            [
                'label'       => __('Horizontal', 'droit-elementor-addons-pro'),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => ['px', '%', 'em', 'rem'],
                'condition'   => [
                    $this->get_control_id('_dl_pro_blogs_content_offset_style_position_toggle') => ['yes'],
                ],
                'range'       => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'render_type' => 'ui',
                'selectors'  => [
                    '{{WRAPPER}} .droit__blog--wrap .droit__post--content' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_dl_pro_blog_content_vertical',
            [
                'label'      => __('Vertical', 'droit-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                
                'range'      => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .droit__blog--wrap .droit__post--content' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        do_action('dl_widgets/blog/pro_one/section/style/content/gaping', $this);
        $this->end_popover();
        do_action('dl_widgets/blog/pro_one/section/style/content/bottom', $this);
    }
    //Blog Content Hover
    protected function _dl_pro_blog_content_hover_one_controls()
    {

        $this->add_control(
            '_dl_pro_blogs_hover_content_color_one',
            [
                'label' => __('Color', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit__blog--wrap .droit__post--content:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            '_dl_pro_blogs_hover_content_letter_spacing_one',
            [
                'label' => __('Letter Spacing', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'desktop_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .droit__blog--wrap .droit__post--content:hover' => 'letter-spacing: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        do_action('dl_widgets/blog/pro_one/section/style/content/hover', $this);
    }
    //Blog Button
    public function _dl_pro_blog_button_style_one_controls()
    {
        do_action('dl_widgets/blog/pro_one/section/style/button/before', $this);
        $this->start_controls_section(
            '_dl_pro_blogs_button_style_one_section',
            [
                'label' => esc_html__('Button', 'droit-elementor-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    $this->get_control_id('_dl_pro_blogs_skin') => ['_skin_1'],
                    $this->get_control_id('_dl_pro_blog_show_read_more_one') => ['yes'],
                ],
            ]
        );

        $this->start_controls_tabs('_dl_pro_blogs_button_tabs_one');

        $this->start_controls_tab('_dl_pro_blogs_button_normal_tab_one',
            [
                'label' => esc_html__('Normal', 'droit-elementor-addons-pro'),
            ]
        );
        $this->_dl_pro_blogs_button_normal_one_controls();
        $this->end_controls_tab();

        $this->end_controls_tab();

        $this->start_controls_tab('_dl_pro_blogs_button_hover_one',
            [
                'label' => esc_html__('Hover', 'droit-elementor-addons-pro'),
            ]
        );
        $this->_dl_pro_blog_button_hover_one_controls();
        $this->end_controls_tab();

        $this->end_controls_tabs();
        do_action('dl_widgets/blog/pro_one/section/style/button/inner', $this);
        $this->end_controls_section();
        do_action('dl_widgets/blog/pro_one/section/style/button/after', $this);
    }
    //Blog Button Normal
    protected function _dl_pro_blogs_button_normal_one_controls()
    {
        
        $this->add_group_control(
            Button_Size::get_type(),
            [
                'name' => 'dl_pro_blog_btn_sizes',
                'label' => __('Size', 'droit-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .droit__blog--wrap .droit-blog-entry-read-more',
                'fields_options' => [
                    'button_size' => [
                        'default' => '',
                    ],
                    'dl_pro_blog_btn_sizes' => 'custom',
                    'button_width' => [
                        'default' => [
                            'size' => '',
                            'unit' => 'px',
                        ],
                    ],
                    'button_height' => [
                        'default' => [
                            'size' => '',
                            'unit' => 'px',
                        ],
                    ],
                ],
            ]
        );
        $this->add_group_control(
            Content_Typography::get_type(),
            [
                'name' => 'dl_pro_blog_btn_content_typography',
                'label' => __('Typography', 'droit-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .droit__blog--wrap .droit-blog-entry-read-more',
                'fields_options' => [
                    'typography' => [
                        'default' => '',
                    ],
                    'dl_pro_btn_content_typography' => 'custom',
                    'font_family' => [
                        'default' => '',
                    ],
                    'font_color' => [
                        'default' => '',
                    ],
                    'font_size' => [
                        'desktop_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'tablet_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'mobile_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                    ],
                    'font_weight' => [
                        'default' => '',
                    ],
                    'text_transform' => [
                        'default' => '', // uppercase, lowercase, capitalize, none
                    ],
                    'font_style' => [
                        'default' => '', // normal, italic, oblique
                    ],
                    'text_decoration' => [
                        'default' => '', // underline, overline, line-through, none
                    ],
                    'line_height' => [
                        'desktop_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'tablet_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'mobile_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                    ],
                ],
            ]
        );
        $this->add_group_control(
            Button::get_type(),
            [
                'name' => 'dl_pro_blog_btn_style_setting',
                'label' => __('Button Setting', 'droit-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .droit__blog--wrap .droit-blog-entry-read-more',
            ]
        );
        $this->add_control(
            '_dl_pro_blogs_button_offset_style_position_toggle',
            [
                'label' => __( 'Gaping', 'droit-elementor-addons-pro' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __( 'None', 'droit-elementor-addons-pro' ),
                'label_on' => __( 'Custom', 'droit-elementor-addons-pro' ),
                'return_value' => 'yes',
                'default' => '',
            ]
        );
        $this->start_popover();
        $this->add_responsive_control(
            '_dl_pro_blog_button_horizontal',
            [
                'label'       => __('Horizontal', 'droit-elementor-addons-pro'),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => ['px', '%', 'em', 'rem'],
                'condition'   => [
                    $this->get_control_id('_dl_pro_blogs_button_offset_style_position_toggle') => ['yes'],
                ],
                'range'       => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'render_type' => 'ui',
                'selectors'  => [
                    '{{WRAPPER}} .droit__blog--wrap .droit-blog-entry-read-more' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_dl_pro_blog_button_vertical',
            [
                'label'      => __('Vertical', 'droit-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                
                'range'      => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .droit__blog--wrap .droit-blog-entry-read-more' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        do_action('dl_widgets/blog/pro_one/section/style/button/gaping', $this);
        $this->end_popover();
        do_action('dl_widgets/blog/pro_one/section/style/button/bottom', $this);
    }
    //Blog Button Hover
    protected function _dl_pro_blog_button_hover_one_controls()
    {
        $this->add_group_control(
            Button_Hover::get_type(),
            [
                'name' => '_dl_pro_blogs_button_hover_bg_one',
                'label' => __('Hover Setting', 'droit-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .droit__blog--wrap .droit-blog-entry-read-more:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => '__dl_pro_blogs_button_hover_bg_one',
                'label' => __('Background(After)', 'droit-elementor-addons-pro'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .droit__blog--wrap .droit-blog-entry-read-more:after',
                'fields_options' => [
                    'background' => [
                        'label' => __('Background Color', 'droit-elementor-addons-pro'),
                        'default' => '',
                    ],
                    'color' => [
                        'default' => '',
                    ],
                ],

            ]
        );
        
        do_action('dl_widgets/blog/pro_one/section/style/button/hover', $this);
    }
    //Blog Image
    public function _dl_pro_blogs_thumbnail_style_one_controls()
    {
        $this->start_controls_section(
            '_dl_pro_blogs_thumbnail_style_one_section',
            [
                'label' => esc_html__('Thumbnail', 'droit-elementor-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    $this->get_control_id('_dl_pro_blogs_skin') => ['_skin_1'],
                    $this->get_control_id('_dl_pro_blog_show_thumb_one') => ['yes'],
                ],
            ]
        );
        $this->add_group_control(
            Image::get_type(),
            [
                'name' => '_dl_pro_blog_btn_image_setting',
                'label' => __('Image Setting', 'droit-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .droit__blog--wrap .dl_tab_thumb img',
                'fields_options' => [
                    'image_setting' => [
                        'default' => '',
                    ],
                    '_dl_pro_blog_btn_image_setting' => 'custom',
                    'image_width' => [
                        'default' => [
                            'size' => '',
                            'unit' => 'px',
                        ],
                    ],
                ],
                
            ]
        );
        do_action('dl_pro_acco_thumbnail_style_one', $this);
        $this->end_controls_section();
    }
}