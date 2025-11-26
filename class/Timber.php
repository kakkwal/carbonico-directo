<?php
namespace App;

use App\Wpml;
use Symfony\Component\VarDumper\VarDumper;
use Twig\Environment;
use Twig\TwigFunction;

class Timber
{

    public function __construct()
    {
        $this->breadcrumb();
        $this->dump();
        $this->languageSelector();
    }

    private function breadcrumb()
    {
        add_filter('timber/twig', function (Environment $twig) {
            $twig->addFunction(new TwigFunction('breadcrumb', function () {
                if (! is_page()) {
                    return '';
                }

                global $post;

                $breadcrumb = '<nav id="breadcrumb"><ul>';
                $home_url   = apply_filters('wpml_home_url', home_url()); 
                $breadcrumb .= '<li><a href="' . esc_url($home_url) . '">' . __('Home', 'cd') . '</a></li>';

                $ancestors = get_post_ancestors($post->ID);
                $ancestors = array_reverse($ancestors);

                foreach ($ancestors as $ancestor_id) {
                    $ancestor_translated_id = apply_filters('wpml_object_id', $ancestor_id, 'page', true);
                    $ancestor_title         = get_the_title($ancestor_translated_id);
                    $ancestor_url           = get_permalink($ancestor_translated_id);
                    $breadcrumb .= '<li><a href="' . esc_url($ancestor_url) . '">' . esc_html($ancestor_title) . '</a></li>';
                }

                $breadcrumb .= '<li>' . esc_html(get_the_title()) . '</li>';
                $breadcrumb .= '</ul></nav>';

                return $breadcrumb;
            }));

            return $twig;
        });
    }

    /**
     * Config dump
     *
     * @return void
     */
    private function dump(): void
    {
        add_filter('timber/twig', function (Environment $twig) {

            $twig->addFunction(new \Twig\TwigFunction('dump', function ($var) {
                VarDumper::dump($var);
            }));

            return $twig;
        });
    }

    /**
     * WPML Selector languages
     */
    private function languageSelector()
    {
        add_filter('timber/twig', function (Environment $twig) {
            $twig->addFunction(new TwigFunction('languageselector', function () {
                return Wpml::languageSelector();
            }));

            return $twig;
        });
    }
}

new Timber;
