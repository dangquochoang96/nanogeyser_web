 <script type="text/javascript">
    $(".slider").owlCarousel({

        items: 1,
        itemsCustom: false,
        itemsDesktop: [1199, 1],
        itemsDesktopSmall: [980, 1],
        itemsTablet: [768, 1],
        itemsTabletSmall: false,
        itemsMobile: [479, 1],
        autoPlay: 15000,
        pagination: false,
        navigation: false,

    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".icon-search").click(function() {
             $( "#search" ).toggle(300);
             $( ".icon-search" ).hide();
        });

    });
</script>


<script type="text/javascript">

// $(function() {
    // $("#left_create_order_2").validate({
    //     rules: {
    //         left_full_name: "required",
    //         left_phone: {
    //             required: true,
    //         }

    //     },
    //     messages: {
    //         left_full_name: "Tên không được để trống",
    //         left_phone: {
    //             required: "Số điện thoại không được để trống",
    //         }
    //     },
    //     submitHandler: function(form) {
    //         var data = {
    //         'full_name': $('#left_create_order_2 #left_full_name').val(),
    //         'phone': $('#left_create_order_2 #left_phone').val(),
    //         'note': $('#left_create_order_2 #left_note').val(),
    //         'product_id': 0,
    //         'count': 0,
    //         '_token': Laravel.token
    // };

    // $.ajax({
    //     url: Laravel.base + '/add-bills',
    //     type: 'post',
    //     dataType: 'json',
    //     data: data,
    //     success: function (result) {
    //         $('.left_div_success').show();
    //     },
    // });
    //     }
    // });

    // })
</script>
<script type="text/javascript">
$(document).ready(function() { 
    $(window).scroll(function(){
        if ($(window).scrollTop() > 700){
        $( ".scroll-se" ).show();
        } else {
       $( ".scroll-se" ).hide();
        }
    });
});
</script>

<script type="text/javascript">
    $(".ul-yk").owlCarousel({
        items: 1,
        itemsCustom: false,
        itemsDesktop: [1199, 1],
        itemsDesktopSmall: [980, 1],
        itemsTablet: [768, 1],
        itemsTabletSmall: false,
        itemsMobile: [479, 1],
        autoPlay: 15000,
        pagination: false,
        navigation: false,
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#search .nut_searh').on('click', function () {
            url = $('base').attr('href') + 'tim-kiem.html';
            var value = $('.top_input').val();
            if (value) {
                url += '?search=' + encodeURIComponent(value);
            }
            window.location.href = url;
        });
        $('#search input[name=\'search\']').on('keydown', function (e) {
            if (e.keyCode == 13) {
                $('#search .nut_searh').trigger('click');
            }
        });

    });
</script>
@yield('script')