<?php
$unsyncedUnitCodes = [];
if($response)
{
    if(property_exists($response, 'error'))
    {
        $class = 'notice notice-info';
        $message = $response->error->message;

        printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message );
        $unsyncedUnitCodes = [];
    } else {
        $currentUnits = get_posts(['post_type' => 'vacation_rental', 'numberposts' => '-1']);
        $currentUnitCodes = [];
        foreach($currentUnits as $unit)
        {
            $currentUnitCodes[] = get_post_meta($unit->ID, 'unit_code', true);
        }
        $apiUnits = $response->units;
        $apiUnitCodes = [];
        foreach($apiUnits as $index => $unit)
        {
            $apiUnitCodes[$index] = $unit->unit_code;
        }
        $unsyncedUnitCodes = array_diff($apiUnitCodes, $currentUnitCodes);
    }
}
?>

<form id="vacation_rentals-table" action="/wp-admin/admin-post.php"  method="post">
    <input type="hidden" name="page" value="' .  $_REQUEST['page'] . '" />
    <input type="hidden" name="action" value="q4_vr_import" />
    <div class="submitbox" id="submitpost">
        <div id="minor-publishing">
            <div id="misc-publishing-actions">
                <div class="misc-pub-section curtime misc-pub-curtime">
                    You have <?= count($unsyncedUnitCodes); ?>  units available for sync.
                </div>
            </div><!-- #minor-publishing-actions -->
            <div id="major-publishing-actions">
                <?php
                foreach($unsyncedUnitCodes as $index => $unitCode)
                {
                    echo '<input type="hidden" name="unit_codes[]" value="'  . $unitCode . '--' . $apiUnits[$index]->name . '">';
                }
                ?>
                <div id="publishing-action">
                    <span class="spinner"></span>
                    <?php $disabled = (count($unsyncedUnitCodes) == 0 ) ? 'disabled=disabled' : ''; ?>
                    <input <?= $disabled; ?> type="submit" name="publish" id="publish" class="button button-primary button-large" value="Sync Now">
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</form>
<?php

?>
