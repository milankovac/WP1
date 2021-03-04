jQuery(function () {

    jQuery('#pa_color').on('change',function(){
        let color=jQuery('#pa_color').find(":selected").val();
        console.log(color);
        jQuery.ajax({
            url: tasksLocalized.Ajaxurl,
            type: 'POST',
            datatype: 'html',
            data: {
                action: 'get_data',
                color: color
            },
            success: function (data) {
               console.log(data);
            },
            error: function (errorThrown) {
                console.log(errorThrown);
            }

        });
    });

});