<script type="text/javascript">
    jQuery(document).ready( function($) {
        $('.if-js-closed').removeClass('if-js-closed').addClass('closed');
        postboxes.add_postbox_toggles( {{ $hook_suffix }} );
    });
</script>
