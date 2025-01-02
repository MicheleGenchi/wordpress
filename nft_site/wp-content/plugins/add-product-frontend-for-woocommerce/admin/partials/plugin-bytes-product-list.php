<style type="text/css">
    /* product list pagination */
    .product_list_pagination{
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 30px;
    }
    .product_list_pagination .page-numbers{
        padding: 0px 20px;
        border: 1px solid #000;
        text-decoration: none;
    }
    .product_list_pagination .page-numbers:hover{
        text-decoration: underline;
    }
</style>
<?php
    $bytes_product_frontend_info = get_admin_url()."admin.php?page=bytes-product-frontend-info";
    $bytes_product_frontend_setting = get_admin_url()."admin.php?page=bytes-product-frontend-setting";  
    $bytes_product_list = get_admin_url()."admin.php?page=bytes-product-list";  
?>
<div class="wrap custom-user-wrap">
    <hr class="wp-header-end"> 
    <h1 class="wp-heading-inline"><?php esc_html_e('Add Product Frontend', 'bytes_product_frontend'); ?></h1>
    <div id="tabs" style="padding-bottom: 25px;">
        <h2 class="nav-tab-wrapper">
            <a href="<?php echo esc_url($bytes_product_frontend_info); ?>" id="switch_tabs_general_section" class="nav-tab"><?php esc_html_e('Information', 'bytes_product_frontend'); ?></a>
            <a href="<?php echo esc_url($bytes_product_frontend_setting); ?>" id="switch_tabs_general_section" class="nav-tab"><?php esc_html_e('Settings', 'bytes_product_frontend'); ?></a>
            <a href="<?php echo esc_url($bytes_product_list); ?>" id="switch_tabs_general_section" class="nav-tab  nav-tab-active"><?php esc_html_e('Product List', 'bytes_product_frontend'); ?></a>
        </h2>
    </div>
    <div class="entry-edit">
        <?php
            /* show list of product which is added by customer (author) */
            $author = (current_user_can('administrator')) ? '' : get_current_user_id();
            $status = (current_user_can('administrator')) ? 'any' : 'any';
            $admin_display_name = get_the_author_meta('display_name', get_current_user_id());
            $paged = !empty($_GET['list_page']) ? absint($_GET['list_page']) : 1;
            $posts_per_page = 10;
            $args = array(
                'post_type' => 'product',
                'post_status' => $status,
                'posts_per_page' => $posts_per_page,
                'paged' => $paged,
                'author' => $author,
            );
            $loop = new WP_Query($args);
            if($loop->have_posts()): ?>
            <div style="overflow-x:auto;">  
                <table class="table table-striped">
                    <thead>
                        <tr class="text-center">
                            <th><?php esc_html_e('Sr. No.', 'bytes_product_frontend'); ?></th>
                            <th><?php esc_html_e('Product Name', 'bytes_product_frontend'); ?></th>
                            <th><?php esc_html_e('Price', 'bytes_product_frontend'); ?></th>
                            <?php if(current_user_can('administrator')): ?>
                                <th><?php esc_html_e('Author', 'bytes_product_frontend'); ?></th> 
                            <?php endif; ?>
                            <th><?php esc_html_e('Status', 'bytes_product_frontend'); ?></th>
                            <th><?php esc_html_e('Action', 'bytes_product_frontend'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = (($paged*$posts_per_page) - $posts_per_page) + 1;
                        while($loop->have_posts()) : $loop->the_post(); 
                            /* Get $product object using product ID */
                            $product = wc_get_product(get_the_id()); ?>
                            <tr class="text-center">
                                <td><?php esc_html_e(absint($i++), 'bytes_product_frontend'); ?></td>
                                <td><?php esc_html_e(sanitize_title($product->get_name()), 'bytes_product_frontend'); ?></td>
                                <td><?php echo wp_kses_post($product->get_price_html()); ?></td>
                                <?php if(current_user_can('administrator')): ?>
                                    <td><?php esc_html_e(get_the_author(), 'bytes_product_frontend'); ?></td>
                                <?php endif; ?>
                                <td><?php esc_html_e(get_post_status(), 'bytes_product_frontend'); ?></td>
                                 <?php if(current_user_can('administrator')): ?>
                                    <td><a href="<?php echo esc_url(admin_url()); ?>post.php?post=<?php echo absint(get_the_id()) ?>&action=edit" data-id="<?php echo absint(get_the_id()); ?>" class="edit_product"><?php esc_html_e('Edit', 'bytes_product_frontend'); ?></a>
                                | <a href="javascript:void(0)" data-id="<?php echo absint(get_the_id()); ?>" class="delete_product"><?php esc_html_e('Delete', 'bytes_product_frontend'); ?></a></td>
                                <?php else: ?>
                                    <td><a href="<?php echo esc_url(admin_url()); ?>post.php?post=<?php echo absint(get_the_id()) ?>&action=edit" data-id="<?php echo absint(get_the_id()); ?>" class="edit_product"><?php esc_html_e('Edit', 'bytes_product_frontend'); ?></a></td>
                                <?php endif; ?>
                            </tr>
                            <?php 
                        endwhile; ?>
                    </tbody>
                </table>
            </div>
            <?php
            else:
                esc_html_e('No products found', 'bytes_product_frontend');
            endif;    
            wp_reset_postdata(); ?>
    </div>
</div>

<?php
/* *** pagination *** */
echo product_list_pagination($loop);
?>