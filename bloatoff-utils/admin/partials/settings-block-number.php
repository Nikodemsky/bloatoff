<?php
/**
 * Settings Block with Number Input Template
 * Reusable template for settings with checkbox + number input
 * 
 * Expected variables:
 * @var string $title - Summary title
 * @var string $description - Main description text
 * @var string $savings - Optional savings description
 * @var string $setting_id - Setting ID (e.g., 'heartbeat', 'autosave')
 * @var string $checkbox_label - Checkbox label text
 * @var string $number_label - Number input label text
 * @var int $number_min - Minimum number value
 * @var int $number_max - Maximum number value
 * @var int $number_default - Default number value
 * @var string $number_description - Description for the number input
 * @var array $options - Settings options array
 * @var string $warning - Optional warning description (can be empty)
 * @var string $readmore - Optional URL, additional informations mostly on external sources
 */

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    die;
}

$enabled = !empty($options[$setting_id . '_enabled']);
$number_value = isset($options[$setting_id . '_interval']) ? $options[$setting_id . '_interval'] : $number_default;
?>

<div class="single-bou-block">

    <details>
        <summary>
            <?php echo esc_html($title); ?>
            <span class="more">[?]</span>
            <?php if (!empty($warning)): echo '<span class="bou-warning-asterisk">*</span>'; endif; ?>
        </summary>
        <aside>
            <p>
                <span class="description"><?php echo esc_html($description); ?></span>
                <?php if (!empty($savings)): ?>
                    <br>
                    <span class="description bou-savings"><?php echo esc_html($savings); ?></span>
                <?php endif; ?>
                <?php if (!empty($warning)): ?>
                    <br>
                    <span class="description bou-warning"><?php echo esc_html($warning); ?></span>
                <?php endif; ?>
                <?php if (!empty($readmore)): ?>
                    <br>
                    <span class="description bou-readmore"><a href="<?php echo esc_url($readmore); ?>" rel="nofollow external" target="_blank">[<?php esc_html_e( 'Read more', 'bloatoff-utils' ); ?>]</a></span>
                <?php endif; ?>
            </p>
        </aside>
    </details>

    <div class="bou-checkbox-wrap bou-number-wrap">
        <label>
            <input type="checkbox" 
                class="bou-chbx" 
                name="bloatoff_settings[<?php echo esc_attr($setting_id); ?>_enabled]" 
                id="<?php echo esc_attr($setting_id); ?>_enabled"
                value="1"
                <?php checked($enabled, true); ?>>
            <?php echo esc_html($checkbox_label); ?>
        </label>
        
        <div class="bou-number-input-wrap">
            <label for="<?php echo esc_attr($setting_id); ?>_interval">
                <?php echo esc_html($number_label); ?>
            </label>
            <input type="number" 
                name="bloatoff_settings[<?php echo esc_attr($setting_id); ?>_interval]" 
                id="<?php echo esc_attr($setting_id); ?>_interval"
                class="small-text"
                min="<?php echo esc_attr($number_min); ?>" 
                max="<?php echo esc_attr($number_max); ?>" 
                value="<?php echo esc_attr($number_value); ?>"
                <?php disabled($enabled, false); ?>>
            <span class="description">
                <?php echo esc_html($number_description); ?>
            </span>
        </div>
    </div>

</div>