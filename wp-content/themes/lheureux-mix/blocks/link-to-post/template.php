<?php
$post_id = get_field('hm_post');
$post = get_post($post_id);

$post_thumbnail_url = get_the_post_thumbnail_url($post_id);
$excerpt = wp_strip_all_tags($post->post_content);
$excerpt = substr($excerpt, 0, 125);
$excerpt = substr($excerpt, 0, strrpos($excerpt, ' '));
$excerpt = $excerpt . ' ...';
?>

<a class="hm-block-link-to-post" href="<?php echo get_permalink($post_id); ?>" target="_blank">
    <?php if ($post_thumbnail_url): ?>
        <div class="hm-block-link-to-post__image">
            <img src="<?php echo get_the_post_thumbnail_url($post_id); ?>" alt="Image de l'article <?php echo $post->post_title; ?>">
        </div>
    <?php endif; ?>

    <div class="hm-block-link-to-post__content">
        <span class="hm-block-link-to-post__title"><?php echo $post->post_title; ?></span>
        <p class="hm-block-link-to-post__excerpt"><?php echo $excerpt; ?></p>
        <span class="hm-block-link-to-post__read-more"><?php _e("Lire l'article", "heureux-mix"); ?></span>
    </div>
</a>