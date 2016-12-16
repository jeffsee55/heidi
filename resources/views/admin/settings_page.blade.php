@extends('admin.admin_layout')
@section('content')
    <h2>Q4 Vacation Rental Settings</h2>
    <div id="post-body-content" style="position: relative;">
    <h2 class="nav-tab-wrapper">
        <a class="nav-tab nav-tab-active" href="#general">General</a>
        <a class="nav-tab" href="#search">Search</a>
    </h2>
    <div id="poststuff" class="q4vr-settings-page">
        <div id='sections'>
            <section id="general">
                <div id="post-body" class="metabox-holder columns-<?php echo 1 == get_current_screen()->get_columns() ? '1' : '2'; ?>">
                    <form id="vacation_rentals-table" action="/wp-admin/admin-post.php" method="post">
                        <div id="postbox-container-1" class="postbox-container">
                            <?php do_meta_boxes( $hook_suffix, 'side', null ); ?>
                        </div>
                    </form>
                    <form id="vacation_rentals-table" action="/wp-admin/admin-post.php" method="post">
                        <?php wp_nonce_field('_wpnonce', '_wpnonce', false ); ?>
                        <?php wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false ); ?>
                        <?php wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false ); ?>
                        <input type="hidden" name="page" value="<?= $_REQUEST['page']; ?>">
                        <input type="hidden" name="action" value="q4vr_api_settings">
                        <div id="postbox-container-2" class="postbox-container">
                            <?php do_meta_boxes($hook_suffix, 'normal', null) ?>
                        </div>
                        <div class="import-submit">
                            <?php do_action('q4vr_options_table_footer'); ?>
                            <input style="float: right" class="button button-primary button-large" type="submit" value="Submit">
                            <div style="clear:both"></div>
                        </div>
                    </form>
                </div>
            </section>
            <br class="clear">
            <section id="search" class="can-add-admin-panel">
                <div id="post-body-2" class="metabox-holder columns-<?php echo 1 == get_current_screen()->get_columns() ? '1' : '2'; ?>">
                    <form id="vacation_rentals-table" action="/wp-admin/admin-post.php" method="post">
                        <?php wp_nonce_field('_wpnonce', '_wpnonce', false ); ?>
                        <?php wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false ); ?>
                        <?php wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false ); ?>
                        <input type="hidden" name="page" value="<?= $_REQUEST['page']; ?>">
                        <input type="hidden" name="action" value="q4vr_search_settings">
                        <div id="postbox-container-3" class="postbox-container">
                            <?php do_meta_boxes( $hook_suffix, 'advanced', null ); ?>
                            <div id="addedPanels"></div>
                        </div>
                        <div class="import-submit">
                            <?php do_action('q4vr_options_table_footer'); ?>
                            <a id="add_table" class="button button-large">Add Search Input</a>
                            <input style="float: right" class="button button-primary button-large" type="submit" value="Submit">
                            <div style="clear:both"></div>
                        </div>
                    </form>
                </div>
            </section>
            <br class="clear">
        </div>
    </div>
</div>
</div>
@endsection
