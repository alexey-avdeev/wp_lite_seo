# wp_lite_seo
This plugin adds SEO headers to your website (Title, Keywords, Description). Editable fields will appear for posts, pages, tags and categories. The plugin is implemented as minimalist as possible and does not require a large amount of resources.

# How to get field value?

*For posts and pages*

*$id - post or page id*

**get_post_meta($id, 'lite_seo_title', 1);** *// Title*

**get_post_meta($id, 'lite_seo_keywords', 1);** *// Keywords*

**get_post_meta($id, 'lite_seo_description', 1);** *// Description*

*For categories and tags*

*$id - category or tag id*

**get_term_meta($id,'lite_seo_title',1);** *// Title*

**get_term_meta($id,'lite_seo_keywords',1);** *// Keywords*

**get_term_meta($id,'lite_seo_description',1);** *// Description*


# *The plugin uses hooks for output (wp_head,wp_title).*

