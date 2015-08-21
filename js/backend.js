jQuery(document).ready(function($) {
    $('select#page_id').on('change', function(e) {
        $('input#changepage').trigger('click');
    });
});