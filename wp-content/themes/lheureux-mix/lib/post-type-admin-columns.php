<?php

// == Add custom columns to post type
function heureux_mix_custom_post_type_columns($columns)
{
    $columns['taxonomy_column'] = __('Taxonomy', 'heureux-mix');
    return $columns;
}
add_filter('manage_question_posts_columns', 'heureux_mix_custom_post_type_columns');

// == Populate custom columns
function heureux_mix_custom_post_type_column_content($column, $post_id)
{
    if ($column == 'taxonomy_column') {
        $terms = get_the_terms($post_id, 'question-taxonomy');
        if (!empty($terms) && !is_wp_error($terms)) {
            $term_names = wp_list_pluck($terms, 'name');
            echo implode(', ', $term_names);
        } else {
            echo __('No terms', 'textdomain');
        }
    }
}
add_action('manage_question_posts_custom_column', 'heureux_mix_custom_post_type_column_content', 10, 2);
