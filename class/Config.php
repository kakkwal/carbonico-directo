<?php
namespace App;

use App\CustomPostType;

class Config
{

    public function __construct()
    {
        $this->customPostType();
    }

    /**

     * Custom post type

     *

     * @return void

     */

    public function customPostType(): void
    {

        add_action('init', function () {

            $postType = new CustomPostType;

            $postType->createPostType([

                'typeName'     => 'products',

                'name'         => __('Products', TRANSLATE_DOMAIN),

                'singular'     => __('Product', TRANSLATE_DOMAIN),

                'all'          => __('All products', TRANSLATE_DOMAIN),

                'add'          => __('Add a product', TRANSLATE_DOMAIN),

                'new'          => __('New product', TRANSLATE_DOMAIN),

                'edit'         => __('Edit product', TRANSLATE_DOMAIN),

                'slug'         => 'products',

                'visibleFront' => false,

                'icon'         => 'dashicons-cart',

            ]);

        });

    }
}
