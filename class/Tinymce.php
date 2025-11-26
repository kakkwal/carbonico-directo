<?php
namespace App;

class Tinymce
{

    public function __construct()
    {
        add_filter('acf/fields/wysiwyg/toolbars', [$this, 'toolbars']);
        add_filter('tiny_mce_before_init', [$this, 'configTinymce']);
        add_filter('mce_buttons', [$this, 'configTinymceBtn']);
    }

    public function toolbars(array $toolbars): array
    {
        $toolbars['Basic'][1] = ['bold', 'italic', 'underline', 'bullist', 'link', 'unlink', 'removeformat' /*, 'forecolor'*/];

        if (($key = array_search('code', $toolbars['Full'][2])) !== false):
            unset($toolbars['Full'][2][$key]);
        endif;

        $toolbars['Full'][2] = ['bullist', 'pastetext'];

        return $toolbars;
    }

    // Configure Tinymce format
    public function configTinymce(array $args): array
    {
        $args['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3';

        return $args;
    }

    // Configure Tinymce buttons
    public function configTinymceBtn($args): array
    {
        $buttons = [
            'formatselect',
            'bold',
            'italic',
            'underline',
            'bullist',
            'numlist',
            'removeformat',
            'link',
            'unlink',
            //'forecolor'
            /*'alignleft',
			'aligncenter',
			'alignright',
			'alignjustify',*/
        ];

        return $buttons;
    }
}

new Tinymce;
