<form id="vacation_rentals-table" action="/wp-admin/admin-post.php"  method="post">
    <input type="hidden" name="page" value="' .  $_REQUEST['page'] . '" />
    <input type="hidden" name="action" value="q4vr_import" />
    <div class="submitbox" id="submitpost">
        <div id="minor-publishing">
            <div id="misc-publishing-actions">
                <div class="misc-pub-section curtime misc-pub-curtime">
                    You have <?= count($unit_codes); ?>  units available for sync.
                </div>
            </div><!-- #minor-publishing-actions -->
            <div id="major-publishing-actions">
                @foreach($unit_codes as $unit_code)
                    <input type="hidden" name="unit_codes[]" value="{{ $unit_code }}">
                @endforeach
                <div id="publishing-action">
                    <span class="spinner"></span>
                    <?php $disabled = (count($unit_codes) == 0 ) ? 'disabled=disabled' : ''; ?>
                    <input <?= $disabled; ?> type="submit" name="publish" id="publish" class="button button-primary button-large" value="Sync Now">
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</form>
<?php

?>
