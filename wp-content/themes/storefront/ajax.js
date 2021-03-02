jQuery(document).ready(function () {

    jQuery('.ajaxPhp').click(function (e) {
        e.preventDefault();
        let product_id = jQuery('.ajaxPhp').val();
        console.log(product_id);
        jQuery.ajax({
            url: tasksLocalized.Ajaxurl,
            type: 'POST',
            datatype: 'html',
            data: {
                action: 'meta_ajax_request',
                product: product_id
            },
            success: function (data) {
                jQuery('#successfully').text('We will contact you soon');
                jQuery('.ajaxPhp').prop("disabled",true);
                setTimeout(function (){
                    jQuery('#successfully').text('');
                },2000)
            },
            error: function (errorThrown) {
                console.log(errorThrown);
            }

        });
    });
});