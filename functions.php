<?php

use App\Autoloader;
use App\Config;
use Timber\Timber;

require 'vendor/autoload.php';

require 'class/Autoloader.php';

Autoloader::autoload();

Timber::init();

register_nav_menus([
'headerLeft'   => "encabezado izquierda",
'headerRight'  => "encabezado derecha",
'footer'       => "pie",
'footerBottom' => "pie inferior",
]);

function cf7_products_form_shortcode()
{
    $args = [
        'post_type'      => 'products',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'title',
        'order'          => 'ASC',
        'suppress_filters' => false,
    ];

    $products = get_posts($args);
    ob_start();
    ?>
    
    <div class="products-list">
        <?php foreach ($products as $product):?>
            <div class="product" id="<?php echo esc_html($product->post_name); ?>">
                <div class="product__top">
                    <h3><?php echo esc_html($product->post_title); ?></h3>
                    <svg class="add" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M256 112v288M400 256H112"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon-minus" viewbox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M400 256H112"/>
                    </svg>
                </div>
                <div class="more">
                    <div class="big-wrapper">
                        <label>
                            <?php _e('Large 10.6M³', 'cd'); ?>
                        </label>
                        <div class="number-input">
                            <button type="button" class="decrease">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-minus" viewbox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M400 256H112"/>
                                </svg>
                            </button>
                            <input type="number" name="product[<?php echo esc_attr($product->ID); ?>][big]" value="0" min="0" class="big">
                            <button type="button" class="increase">
                                <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M256 112v288M400 256H112"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="medium-wrapper">
                        <label>
                            <?php _e('Medium', 'cd'); ?>
                        </label>
                        <div class="number-input">
                            <button type="button" class="decrease">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-minus" viewbox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M400 256H112"/>
                                </svg>
                            </button>
                            <input type="number" name="product[<?php echo esc_attr($product->ID); ?>][medium]" value="0" min="0" class="medium">
                            <button type="button" class="increase">
                                <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M256 112v288M400 256H112"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="return">
        <h3><?php _e('Number of bottles to be returned', 'cd'); ?></h3>
        <div class="returns">
            <div class="big-wrapper">
                <label>
                    <?php _e('Large 10.6M³', 'cd'); ?>
                </label>
                <div class="number-input">
                    <button type="button" class="decrease">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon-minus" viewbox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M400 256H112"/>
                        </svg>
                    </button>
                    <input type="number" name="return_big" value="0" min="0">
                    <button type="button" class="increase">
                        <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M256 112v288M400 256H112"/>
                        </svg>
                    </button>
                </div>
            </div>
            
            <div class="medium-wrapper">
                <label>
                    <?php _e('Medium', 'cd'); ?>
                </label>
                <div class="number-input">
                    <button type="button" class="decrease">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon-minus" viewbox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M400 256H112"/>
                        </svg>
                    </button>
                    <input type="number" name="return_medium" value="0" min="0">
                    <button type="button" class="increase">
                        <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M256 112v288M400 256H112"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('cf7_products', 'cf7_products_form_shortcode');



function cf7_cart_shortcode()
{
    ob_start();
    ?>
    <div class="cart__wrapper" 
        data-empty-text="<?php _e('There are no products selected', 'cd'); ?>"
        data-big-text="<?php _e('Large 10.6M³', 'cd'); ?>"
        data-medium-text="<?php _e('Medium', 'cd'); ?>"
        data-return-text="<?php _e('Bottles to be returned', 'cd'); ?>">
        <h2><?php _e('Your order', 'cd'); ?></h2>
        <ul class="cart-items" id="cart-items"></ul>
        <input type="hidden" name="cart_data" value="">
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('cf7_cart', 'cf7_cart_shortcode');

add_filter('wpcf7_mail_components', function ($components, $contact_form, $mail) {
    $submission = WPCF7_Submission::get_instance();
    if (!$submission) return $components;

    $data = $submission->get_posted_data();
    if (empty($data['cart_data'])) return $components;

    $cart_data = json_decode($data['cart_data'], true);
    if (!$cart_data) return $components;

    $sizes = [
        'big' => __('Large 10.6M³', 'cd'),
        'medium' => __('Medium', 'cd')
    ];

    $cart_html = '<br><br><table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 600px;">';
    $cart_html .= '<thead><tr style="background-color: #f0f0f0;">';
    $cart_html .= '<th style="padding: 10px; text-align: left;">' . esc_html__('Product', 'cd') . '</th>';
    $cart_html .= '<th style="padding: 10px; text-align: center;">' . esc_html($sizes['big']) . '</th>';
    $cart_html .= '<th style="padding: 10px; text-align: center;">' . esc_html($sizes['medium']) . '</th>';
    $cart_html .= '</tr></thead><tbody>';

    if (!empty($cart_data['products'])) {
        foreach ($cart_data['products'] as $product) {
            $cart_html .= '<tr>';
            $cart_html .= '<td style="padding: 10px; border: 1px solid #ddd;">' . esc_html($product['name'] ?? __('Unknown product', 'cd')) . '</td>';
            $cart_html .= '<td style="padding: 10px; text-align: center; border: 1px solid #ddd;">' . intval($product['big'] ?? 0) . '</td>';
            $cart_html .= '<td style="padding: 10px; text-align: center; border: 1px solid #ddd;">' . intval($product['medium'] ?? 0) . '</td>';
            $cart_html .= '</tr>';
        }
    }

    if (!empty($cart_data['return']) && (intval($cart_data['return']['big'] ?? 0) > 0 || intval($cart_data['return']['medium'] ?? 0) > 0)) {
        $cart_html .= '<tr>';
        $cart_html .= '<td style="padding: 10px; border: 1px solid #ddd;"><strong>' . esc_html__('Bottles to be returned', 'cd') . '</strong></td>';
        $cart_html .= '<td style="padding: 10px; text-align: center; border: 1px solid #ddd;"><strong>' . intval($cart_data['return']['big'] ?? 0) . '</strong></td>';
        $cart_html .= '<td style="padding: 10px; text-align: center; border: 1px solid #ddd;"><strong>' . intval($cart_data['return']['medium'] ?? 0) . '</strong></td>';
        $cart_html .= '</tr>';
    }

    $cart_html .= '</tbody></table><br><br>';

    if (isset($components['body'])) {
        $components['body'] = str_replace('{{CART_HTML}}', $cart_html, $components['body']);
    }

    $components['content_type'] = 'text/html';

    return $components;
}, 20, 3);


add_filter('wpcf7_form_elements', function ($content) {
    return do_shortcode($content);
});

// Config of theme

define('TRANSLATE_DOMAIN', 'cd');

new Config;