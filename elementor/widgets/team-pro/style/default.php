<?php
$classFormat = ($settings['_dl_pro_position_control']) ?? '';
$this->add_render_attribute(
    '_dl_pro_teams_wrapper',
    [
        'id' => "teams-{$this->get_id()}",
        'class' => ['dl-team-member-wrapper-pro', $skin, $skin_mode,$classFormat],
    ]
);
if ($this->get_pro_teams_settings('_dl_pro_teams_skin_mood')) {
    $this->add_render_attribute('_dl_pro_teams_wrapper', 'class', $this->get_pro_teams_settings('_dl_pro_teams_skin_mood'));
}
// Image sectionn
$image = wp_get_attachment_image_url($this->get_pro_teams_settings('_dl_pro_team_image')['id'], $this->get_pro_teams_settings('thumbnail_size'));
if (!$image) {
    $image = $this->get_pro_teams_settings('_dl_pro_team_image')['url'];
}
$this->add_render_attribute(
    '_dl_team_image',
    [
        'class' => ['dl_team_member_thumb'],
    ]
);
if($this->get_pro_teams_settings('_dl_pro_teams_hover_animation')){
    $this->add_render_attribute( '_dl_team_image', 'class', ['elementor-animation-' . $this->get_pro_teams_settings('_dl_pro_teams_hover_animation') ] );
}
?>
<div <?php $this->print_render_attribute_string('_dl_pro_teams_wrapper');?> >
    <?php if (!empty($image)): ?>
    <div <?php $this->print_render_attribute_string('_dl_team_image');?>>
        <img src="<?php echo esc_url($image); ?>" alt="<?php echo __($this->get_pro_teams_settings('_dl_pro_team_name'), 'droit-elementor-addons-pro'); ?>">
    </div>
    <?php endif;?>
    <div class="dl_team_member_info">
        <?php if (!empty($this->get_pro_teams_settings('_dl_pro_team_name'))): ?>
            <h4 class="dl_name team--name"> <?php esc_html_e($this->get_pro_teams_settings('_dl_pro_team_name'), 'droit-elementor-addons-pro');?></h4>
        <?php endif;?>
        <?php if (!empty($this->get_pro_teams_settings('_dl_pro_team_designation'))): ?>
            <p class="dl_position team--designation"> <?php esc_html_e($this->get_pro_teams_settings('_dl_pro_team_designation'), 'droit-elementor-addons-pro');?></p>
        <?php endif;?>
        <?php 
        if (!empty($this->get_pro_teams_settings('_dl_pro_team_description'))):
            $editor_content = $this->parse_text_editor($this->get_pro_teams_settings('_dl_pro_team_description'));
        ?>
	        <div class="dl_team_desc team--content"><?php echo $editor_content; ?></div>
		<?php endif;?>

        <?php if ('yes' === $this->get_pro_teams_settings('_dl_pro_team_social_show')): ?>

        <div class="dl_social_icon">
        <?php
            $migration_allowed = \Elementor\Icons_Manager::is_migration_allowed();
            foreach ($this->get_pro_teams_settings('_dl_pro_teams_socials') as $index => $item) {

                $migrated = isset($item['__fa4_migrated']['_dl_pro_teams_socials']);
                $is_new = empty($item['social']) && $migration_allowed;
                $social = '';
                if (!empty($item['social'])) {
                    $social = str_replace('fa fa-', '', $item['social']);
                }

                if (($is_new || $migrated) && 'svg' !== $item['_dl_pro_team_social_icon']['library']) {
                    $social = explode(' ', $item['_dl_pro_team_social_icon']['value'], 2);
                    if (empty($social[1])) {
                        $social = '';
                    } else {
                        $social = str_replace('fa-', '', $social[1]);
                    }
                }
                if ('svg' === $item['_dl_pro_team_social_icon']['library']) {
                    $social = get_post_meta($item['_dl_pro_team_social_icon']['value']['id'], '_wp_attachment_image_alt', true);
                }

                $link_key = 'link_' . $index;

                $this->add_render_attribute($link_key, 'class', [
                    'elementor-repeater-item-' . $item['_id'],
                ]);

                $this->add_link_attributes($link_key, $item['_dl_pro_team_social_link']);
                ?>
                <a <?php echo $this->get_render_attribute_string($link_key); ?>>
                    <?php
                    if ($is_new || $migrated) {
                        \Elementor\Icons_Manager::render_icon($item['_dl_pro_team_social_icon']);
                    } else {
                    ?>
                    <i class="<?php echo esc_attr($item['social']); ?>"></i>
                    <?php
                    }
                    ?>
                    </a>
            <?php }?>
        </div>

        <?php endif;?>
    </div>
</div>