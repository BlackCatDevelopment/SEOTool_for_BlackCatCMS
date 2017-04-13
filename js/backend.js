jQuery(document).ready(function($) {
    $('select#page_id').on('change', function(e) {
        $('input#changepage').trigger('click');
    });
    $('button#update_sitemap').unbind('click').on('click',function(e) {
        e.preventDefault();
        $.ajax({
            type:     'GET',
            url:      CAT_URL + '/modules/seotool/ajax/update_sitemap.php',
            dataType: 'json',
            cache:    false,
            beforeSend: function(a){
                a.process=set_activity(cattranslate("Loading"))
            },
            success:  function( data, textStatus, jqXHR ) {
                if(data.success===true) {
                    return_success( jqXHR.process, cattranslate('Success') );
                } else {
                    return_error( jqXHR.process, data.message );
                }
            }
        });
    });

    $('button#edit_robots,button#edit_htaccess').unbind('click').on('click',function(e) {
        e.preventDefault();
        var name = $(this).prop('id').replace('edit_','');
        $.ajax({
            type:     'GET',
            url:      CAT_URL + '/modules/seotool/ajax/getfile.php',
            dataType: 'json',
            data:     {
                name: name,
            },
            cache:    false,
            beforeSend: function(a){
                a.process=set_activity(cattranslate("Loading"))
            },
            success:  function( data, textStatus, jqXHR ) {
                $('div#seotool_check').remove();
                if(data.success===true) {
                    $('div#seotool_inner').html(
                        '<textarea id="edit_robots_txt">' + data.message + '</textarea><br />' +
                        '<button id="edit_robots_txt_save" class="submit">' + cattranslate('Save') + '</button>'
                    );
                    $('button#edit_robots_txt_save').unbind('click').on('click',function(e) {
                        e.preventDefault();
                        $.ajax({
                            type:     'POST',
                            url:      CAT_URL + '/modules/seotool/ajax/savefile.php',
                            dataType: 'json',
                            data:     {
                                name: name,
                                content: $('textarea#edit_robots_txt').val()
                            },
                            cache:    false,
                            beforeSend: function(a){
                                a.process=set_activity(cattranslate("Saving"))
                            },
                            success:  function( data, textStatus, jqXHR ) {
                                return_success( jqXHR.process, data.message );
                            }
                        });
                    });
                    return_success( jqXHR.process, cattranslate('Success') );
                } else {
                    return_error( jqXHR.process, data.message );
                }
            }
        });
    });
});