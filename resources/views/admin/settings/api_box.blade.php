<div class="submitbox" id="submitpost">
    <div id="minor-publishing">
        <div id="misc-publishing-actions">
            <div class="misc-pub-section curtime misc-pub-curtime">
                <textarea style="width: 100%"><?= get_site_option('q4vr_api_key'); ?></textarea>
            </div>
        </div><!-- #minor-publishing-actions -->
        <div id="major-publishing-actions">
            <div id="publishing-action">
                <span class="spinner"></span>
                <?php
                $disabled = '';
                if(empty(get_option('q4vr_api_settings')))
                {
                    $disabled = 'disabled';
                } ?>
                <a href="<?= get_site_url(); ?>/wp-admin/admin-post.php?action=q4vr_authorize" class="button button-primary <?= $disabled; ?>">Get Api Key</a>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
