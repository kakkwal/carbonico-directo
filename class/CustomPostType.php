<?php
namespace App;

class CustomPostType
{

    public function createPostType($data)
    {
        register_post_type($data['typeName'], [
            'labels'              => [
                'name'          => $data['name'],
                'singular_name' => $data['singular'],
                'all_items'     => $data['all'],
                'add_new_item'  => $data['add'],
                'new_item'      => $data['new'],
                'edit_item'     => $data['edit'],
            ],
            'public'              => false,
            'publicly_queryable'  => $data['visibleFront'],
            'show_ui'             => true,
            'exclude_from_search' => (! empty($data['exclude_from_search'])) ? $data['exclude_from_search'] : false,
            'show_in_menu'        => (! empty($data['showInMenu'])) ? $data['showInMenu'] : true,
            'query_var'           => $data['visibleFront'],
            'rewrite'             => false,
            'capability_type'     => 'post',
            'has_archive'         => false,
            'hierarchical'        => false,
            'show_in_rest'        => true,
            'menu_position'       => 10,
            'menu_icon'           => $data['icon'],
            'supports'            => ['title', 'revisions'],
        ]);
    }
}
