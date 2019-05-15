
<div class="form-field">
    <label for="name">Title</label>
    <br>
    <input type="text" name="lite_seo[lite_seo_title]" value="<?php echo get_post_meta($post->ID, 'lite_seo_title', 1); ?>"/>
    <br><br>
</div>

<div class="form-field">
    <label for="name">Keywords</label>
    <br>
    <input type="text" name="lite_seo[lite_seo_keywords]" value="<?php echo get_post_meta($post->ID, 'lite_seo_keywords', 1); ?>"/>
    <br><br>
</div>

<div class="form-field">
    <label for="name">Description</label>
    <br>
    <textarea type="text" name="lite_seo[lite_seo_description]"><?php echo get_post_meta($post->ID, 'lite_seo_description', 1); ?></textarea>
</div>


<input type="hidden" name="lite_seo_fields_nonce" value="<?php echo wp_create_nonce('Df#FcdSf34Dfs'); ?>"/>


