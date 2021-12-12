<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Widgets;

use \DROIT_ELEMENTOR_PRO\Modules\Widgets\Subscriber\Subscriber_Control as Control;
use \DROIT_ELEMENTOR_PRO\Modules\Widgets\Subscriber\Subscriber_Module as Module;
use \ELEMENTOR\Icons_Manager;
use \ELEMENTOR\Controls_Manager;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Subscriber extends Control
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
        do_action('dl_widgets/subscriber/register_control/start', $this);

        // add content 
        $this->_content_control();
        
        //style
        $this->_dl_pro_subscriber_style_controls();
        
        do_action('dl_widgets/subscriber/register_control/end', $this);

        do_action('dl_widget/section/style/custom_css', $this);
        
    }

    public function _content_control(){
        //start subscribe layout
        $this->start_controls_section(
            '_dl_pr_subscriber_layout_section',
            [
                'label' => __('Layout', 'droit-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            '_dl_pro_subscriber_skin',
            [
                'label' => esc_html__('Preset', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => apply_filters('dl_widgets/subscriber/control_presets', [
                    'dl-pro-sub-inline' => __('Inline', 'droit-elementor-addons-pro'),
                    'dl-pro-sub-block' => __('Block', 'droit-elementor-addons-pro'),
                ]),
                'default' => 'dl-pro-sub-inline',
            ]
        );

        $this->add_control(
			'_dl_pro_subs_form_block_colum',
			[
				'label' => __( 'Form Colum', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 12,
				'step' => 1,
				'default' => 2,
                'selectors' => [
                    '{{WRAPPER}} .dl_pro_subscribe_form_action.dl-pro-sub-block .dl_pro_subscribe_form' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
                'condition' => [
                    $this->get_control_id('_dl_pro_subscriber_skin') => ['dl-pro-sub-block'],
                ],
			]
		);

        $this->add_control(
			'_dl_pro_subs_form_block_colum_gap',
			[
				'label' => __( 'Form Colum Gap', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 5,
				'max' => 100,
				'step' => 2,
				'default' => 20,
                'selectors' => [
                    '{{WRAPPER}} .dl_pro_subscribe_form_action.dl-pro-sub-block .dl_pro_subscribe_form' => 'column-gap: {{VALUE}}px;',
                ],
                'condition' => [
                    $this->get_control_id('_dl_pro_subscriber_skin') => ['dl-pro-sub-block'],
                ],
			]
		);

        $this->add_control(
            '_nextmail_missing_notice',
            [
                'type' => Controls_Manager::RAW_HTML,
                'raw' => sprintf(
                    __( 'Hello %2$s, At first connect with API. Please click on the link for %1$s.', 'droit-elementor-addons-pro' ),
                    '<a href="'.esc_url( admin_url('admin.php?page=droit-addons#api') ).'" target="_blank" rel="noopener">config</a>',
                    \wp_get_current_user()->display_name
                ),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-danger',
            ]
        );

        do_action('dl_widgets/subscriber/layout/content', $this);

        $this->end_controls_section();
        //start subscribe layout end

        //start subscribe fields render
        $this->start_controls_section(
            '_dl_pr_subscriber_fields_section',
            [
                'label' => __('Fields', 'droit-elementor-addons-pro'),
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            '_dl_field_enable',
            [
                'label' => __('Enable', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'return_value' => 'yes',
            ]
        );
        
        $repeater->add_control(
            '_dl_field_title',
            [
                'label' => __('Label', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            '_dl_field_require',
            [
                'label' => __('Require', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'return_value' => 'yes',
            ]
        );
        $repeater->add_control(
            '_dl_field_place',
            [
                'label' => __('Placeholder', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            '_dl_field_id',
            [
                'label' => __('Id', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::HIDDEN,
            ]
        );
        
        $this->add_control(
            '_dl_pro_subscriber_fields',
            [
                'label' => __('Setup Fields', 'droit-elementor-addons-pro'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'item_actions' =>[
                    'duplicate' => false,
                    'add' => false,
                    'remove' => false
                ],
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        '_dl_field_enable' => 'no',
                        '_dl_field_title' => 'First Name',
                        '_dl_field_id' => 'first_name',
                    ],
                    [
                        '_dl_field_enable' => 'no',
                        '_dl_field_title' => 'Last Name',
                        '_dl_field_id' => 'last_name',
                    ],
                    [
                        '_dl_field_enable' => 'yes',
                        '_dl_field_title' => 'Email',
                        '_dl_field_id' => 'email',
                        '_dl_field_require' => 'yes',
                        '_dl_field_place' => 'Email'
                    ],
                    [
                        '_dl_field_enable' => 'no',
                        '_dl_field_title' => 'Phone',
                        '_dl_field_id' => 'phone',
                    ],
                    [
                        '_dl_field_enable' => 'no',
                        '_dl_field_title' => 'Address',
                        '_dl_field_id' => 'address',
                    ],
                    [
                        '_dl_field_enable' => 'no',
                        '_dl_field_title' => 'City',
                        '_dl_field_id' => 'city',
                    ],
                    [
                        '_dl_field_enable' => 'no',
                        '_dl_field_title' => 'State',
                        '_dl_field_id' => 'state',
                    ],
                    [
                        '_dl_field_enable' => 'no',
                        '_dl_field_title' => 'Zip',
                        '_dl_field_id' => 'zip',
                    ],
                    [
                        '_dl_field_enable' => 'no',
                        '_dl_field_title' => 'Country',
                        '_dl_field_id' => 'country',
                    ],
                    
                ],
                'title_field' => '<i class="eicon-editor-list-ul"></i> {{{ _dl_field_title }}} [{{{ _dl_field_id }}}]',
            ]
        );

        do_action('dl_widgets/subscriber/fields/content', $this);

        $this->end_controls_section();
        //start subscribe layout end


         //start intregration
        $this->start_controls_section(
            '_dl_pr_subscriber_integration_section',
            [
                'label' => __('Integration with', 'droit-elementor-addons-pro'),
            ]
        );
        $this->add_control(
			'_dl_pr_sub_inte_chimp',
			[
				'label' => __( 'Mailchimp', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
            '_dl_pr_sub_inte_chimp_enable',
            [
                'label' => __('Enable', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'Yes',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            '_dl_pr_sub_inte_chimp_list',
            [
                'label' => esc_html__('Select List', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => $this->_get_list('mailchimp'),
                'condition' => [ '_dl_pr_sub_inte_chimp_enable' => 'yes']
            ]
        );

        $this->add_control(
			'_dl_pr_sub_inte_response',
			[
				'label' => __( 'Get Response', 'droit-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
            '_dl_pr_sub_inte_response_enable',
            [
                'label' => __('Enable', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'Yes',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            '_dl_pr_sub_inte_response_list',
            [
                'label' => esc_html__('Select List', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => $this->_get_list('response'),
                'condition' => [ '_dl_pr_sub_inte_response_enable' => 'yes']
            ]
        );

        do_action('dl_widgets/subscriber/integration/content', $this);

        $this->end_controls_section();
        //start intregration end

        // form settings
        $this->start_controls_section(
            '_dl_pr_subscriber_form_section',
            [
                'label' => __('Form settings', 'droit-elementor-addons-pro'),
            ]
        );
        $this->add_control(
            '_dl_sub_button_text',
            [
                'label' => __('Button Text', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Check Now', 'droit-elementor-addons-pro'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            '_dl_sub_success_text',
            [
                'label' => __('Success message', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Successfully listed.', 'droit-elementor-addons-pro'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            '_dl_sub_error_text',
            [
                'label' => __('Error message', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Please enter correct info.', 'droit-elementor-addons-pro'),
                'label_block' => true,
            ]
        );
         

        $this->add_control(
            '_dl_pr_sub_inte_confirm_enable',
            [
                'label' => __('Confirm Checkbox', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'return_value' => 'yes',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            '_dl_pr_sub_inte_confirm_message',
            [
                'label' => __('Error message', 'droit-elementor-addons-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Agree with our terms & conditions.', 'droit-elementor-addons-pro'),
                'label_block' => true,
                'condition' => [ '_dl_pr_sub_inte_confirm_enable' => 'yes']
            ]
        );
         

        $this->end_controls_section();
        // form settings end


    }

    public function _dl_pro_subscriber_style_controls()
    {
        $this->_dl_pro_subscriber_content_controls();
        $this->_dl_pro_subscriber_btn_controls();
        $this->_dl_pro_subscriber_input_style_controls();
        $this->_dl_pro_subscriber_checkbox_style_controls();
    }

    public function _get_list( $provider = 'mailchimp'){
        return \DROIT_ELEMENTOR_PRO\Dl_Subscribe::instance()->_get_list($provider);
    }

    //Html render
    protected function render()
    {   
        $settings = $this->get_settings_for_display();
        extract($settings);

        $dl_sub_type = [];
        // mailchimp
        if( $_dl_pr_sub_inte_chimp_enable == 'yes'){
            $dl_sub_type['providers']['mailchimp'] = [
                'enable' => 'yes',
                'listid' => $_dl_pr_sub_inte_chimp_list
            ];
        }
        // get response
        if( $_dl_pr_sub_inte_response_enable == 'yes'){
            $dl_sub_type['providers']['response'] = [
                'enable' => 'yes',
                'listid' => $_dl_pr_sub_inte_response_list
            ];
        }
        $require = [];
        foreach($_dl_pro_subscriber_fields as $f){
            if( $f['_dl_field_enable'] == 'yes' ){
                $require[$f['_dl_field_id']] = $f['_dl_field_require'];
            }
        }
        $dl_sub_type['require'] = $require;
        $dl_sub_type['setup']['success'] = $_dl_sub_success_text;
        $dl_sub_type['setup']['error'] = $_dl_sub_error_text;
        if( $_dl_pr_sub_inte_confirm_enable == 'yes'){
            $dl_sub_type['confirm_submit'] = 'yes';
        }

        include 'style/default.php'; 	
    }

    protected function content_template()
    {}
}