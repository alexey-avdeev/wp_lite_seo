<tbody>
<tr class="form-field">
    <th scope="row"><label for="name">Title</label></th>
    <td><input type="text" name="lite_seo[lite_seo_title]" value="<?php echo get_term_meta($taxonomy->term_id,'lite_seo_title',1); ?>"/>
    </td>
</tr>
<tr class="form-field">
    <th scope="row"><label for="slug">Keywords</label></th>
    <td>
        <input type="text" name="lite_seo[lite_seo_keywords]" value="<?php echo get_term_meta($taxonomy->term_id,'lite_seo_keywords',1); ?>"/>
    </td>

</tr>
<tr class="form-field">
    <th scope="row"><label for="description">Description</label></th>
    <td>
        <textarea type="text" name="lite_seo[lite_seo_description]"/><?php echo get_term_meta($taxonomy->term_id,'lite_seo_description',1); ?></textarea>
    </td>
</tr>

<input type="hidden" name="lite_seo_fields_nonce" value="<?php echo wp_create_nonce('Df#FcdSf34Dfs'); ?>"/>


</tbody>