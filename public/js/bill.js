Bill = {
    data: {},

    init: function () {

    },

    create: function () {
        /**
         * get data in form
         */
        var data = {
            'product_id': $('#create_order_2 #product_id').val(),
            'count': $('#create_order_2 #count').val(),
            'full_name': $('#create_order_2 #full_name').val(),
            'phone': $('#create_order_2 #phone').val(),
            // 'email': $('#create_order_2 #email').val(),
            // 'address': $('#create_order_2 #address').val(),
            'note': $('#create_order_2 #note').val(),
            '_token': Laravel.token
        };

        $.ajax({
            url: Laravel.base + '/add-bills',
            type: 'post',
            dataType: 'json',
            data: data,
            success: function (result) {
                $('.div_success').show();
            },
        });
    },

    updateStatus: function () {

    }

}