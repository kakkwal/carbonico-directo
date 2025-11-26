<?php
namespace App;

/**
 * Custom WPML plugin config
 */
class Wpml
{

    //Custom language selector
    public static function languageSelector(): string
    {
        $languages = icl_get_languages('skip_missing=0');
        $content   = '';

        foreach ($languages as $key => $value):
            if ($value['active']):

                $current = $value;
                break;
            endif;
        endforeach;

        if (! empty($languages)):

            foreach ($languages as $key => $value):

                $content .= '<a href="' . $value['url'] . '">' . ucfirst($value['translated_name']) . '</a>';
                
            endforeach;
        endif;

        return $content;
    }
}
