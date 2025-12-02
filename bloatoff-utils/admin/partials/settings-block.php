<?php
/**
 * Settings Block Template
 * Reusable template for individual setting blocks
 * 
 * Expected variables:
 * @var string $title - Summary title
 * @var string $description - Main description text
 * @var string $savings - Optional savings description (can be empty)
 * @var string $warning - Optional warning description (can be empty)
 * @var string $readmore - Optional URL, additional informations mostly on external sources
 * @var string $setting_id - Checkbox setting ID (e.g., 'emojis', 'gutenberg')
 * @var string $label - Checkbox label text
 * @var array $options - Settings options array
 */

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    die;
}
?>

<div class="single-bou-block">

    <details>
        <summary>
            <?php echo esc_html($title); ?> 
            <span class="more" data-tooltip="<?php esc_html_e( 'Click to show more info.', 'bloatoff-utils' ); ?>">[?]</span>
            <?php if (!empty($warning)): echo '<span class="bou-warning-asterisk">*</span>'; endif; ?>
        </summary>
        <aside>
            <p> 
                <?php if (!empty($description)): // Description or extensive instructions ?>
                    <span class="description extensive-instructions">
                        <?php
                            // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                            echo bou_ext_txt( sprintf( $description, '<strong>', '</strong>', '<br>' )); ?>
                    </span>
                <?php endif; ?>
                <?php if (!empty($savings)): // Savings - green font ?>
                    <br>
                    <span class="description bou-savings">
                        <?php
                            // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                            echo bou_ext_txt( sprintf( $savings, '<strong>', '</strong>', '<br>' )); 
                        ?>
                    </span>
                <?php endif; ?>
                <?php if (!empty($warning)): // Warning - red font ?>
                    <br>
                    <span class="description bou-warning">
                        <?php
                            // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                            echo bou_ext_txt( sprintf( $warning, '<strong>', '</strong>', '<br>' )); 
                        ?>
                    </span>
                <?php endif; ?>
                <?php if (!empty($readmore)): // Read more link ?>
                    <br>
                    <span class="description bou-readmore">
                        <a 
                            href="<?php echo esc_url($readmore); ?>" 
                            rel="nofollow external" 
                            target="_blank">[<?php esc_html_e( 'Read more', 'bloatoff-utils' ); ?>]
                        </a>
                    </span>
                <?php endif; ?>
            </p>
        </aside>
    </details>

    <div class="bou-checkbox-wrap">
        <label>
            <input type="checkbox" 
                class="bou-chbx" 
                name="bloatoff_settings[<?php echo esc_attr($setting_id); ?>]" 
                value="1"
                <?php checked(!empty($options[$setting_id]), true); ?>>
            <?php echo esc_html($label); ?>
        </label>
    </div>

</div>