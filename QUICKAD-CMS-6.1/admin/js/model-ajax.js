jQuery(document).ready(function ($) {
    jQuery(".bookEdit").click(function () {
        var bookIdedit = jQuery(this).attr('edit-value');
        //alert(bookIdedit);
        var data = {
            'action': 'my_action',
            'bookingEditId': bookIdedit,
            'bookingEdit': 'bookingEdit'
        };
        jQuery.post(ajax_object1.ajax_url1, data, function (response) {
            jQuery('#FirstModel').html(response);
        });
    })


    jQuery(".bookadd").click(function () {
        var bookIdedit = jQuery(this).attr('edit-value');
        //alert(bookIdedit);
        var data = {
            'action': 'my_action',

            'bookingadd': bookingadd
        };
        jQuery.post(ajax_object1.ajax_url1, data, function (response) {
            jQuery('#FirstModel1').html(response);
        });
    })


    jQuery(".empEdit_id").click(function () {
        var pay_id = jQuery(this).attr('edit-empId');
        //alert(pay_id);
        var data = {
            'action': 'my_action',
            'pay_id': pay_id
        };
        jQuery.post(ajax_object1.ajax_url1, data, function (response) {
            jQuery('.modelView').html(response);
        });
    });


    jQuery("#provider_name").live('change', function () {

        jQuery('.service1').remove();
        var empid_edit = jQuery(this).val();
        //alert(empid_edit);
        var data = {
            'action': 'my_action',
            'empid_edit': empid_edit
        };
        jQuery.post(ajax_object1.ajax_url1, data, function (response) {
            //alert(response);
            jQuery('#ser_id').html();
            jQuery('#ser_id').html(response);

        });
    });

    jQuery("#emp_name").on('change', function () {
        jQuery('.service1').remove();
        var empid_add = jQuery(this).val();
        //alert(empid_edit);
        var data = {
            'action': 'my_action',
            'empid_add': empid_add
        };
        jQuery.post(ajax_object1.ajax_url1, data, function (response) {
            //alert(response);
            jQuery('#ser_id1').html();
            jQuery('#ser_id1').html(response);

        });
    });


    jQuery(".empEdit").click(function () {
        var emp_editid = jQuery(this).attr('edit-empId');
        var data = {
            'action': 'my_action',
            'emp_editid': emp_editid
        };
        jQuery.post(ajax_object1.ajax_url1, data, function (response) {
            jQuery('.modelView').html(response);
        });
    });


    jQuery("#time_start").live('change', function () {
        jQuery('.duration').remove();
        var edit_ser = jQuery('#edit_ser').val();
        var booking_date = jQuery('#bookingEditdate').val();
        var start_t = jQuery('#time_start').val();
        var data = {
            'action': 'my_action',
            'service_id': edit_ser,
            'start_t': start_t,
            'booking_date': booking_date
        };
        jQuery.post(ajax_object1.ajax_url1, data, function (response) {
            jQuery('.ser').html();
            jQuery('.ser').html(response);

        });
    });

    jQuery("#start_time").live('change', function () {
        jQuery('.duration1').remove();

        var add_ser = jQuery('#add_ser').val();
        var bookingd = jQuery('#bookingd').val();
        var start_time = jQuery('#start_time').val();
        var data = {
            'action': 'my_action',
            'ser_id': add_ser,
            'start_time': start_time,
            'bookingd': bookingd
        };
        jQuery.post(ajax_object1.ajax_url1, data, function (response) {
            jQuery('.ser1').html();
            jQuery('.ser1').html(response);

        });
    });

    jQuery("#bookingEditdate").live('change', function () {
        jQuery('.duration').remove();
        var edit_ser = jQuery('#edit_ser').val();
        var booking_date = jQuery('#bookingEditdate').val();
        var start_t = jQuery('#time_start').val();
        var data = {
            'action': 'my_action',
            'service_id': edit_ser,
            'start_t': start_t,
            'booking_date': booking_date
        };
        jQuery.post(ajax_object1.ajax_url1, data, function (response) {
            jQuery('.ser').html();
            jQuery('.ser').html(response);

        });
    });
});