<!--Map + form-->
<div class="container">
    <div class="map-form">
        <div class="map-h">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3725.9098940754784!2d105.78656817502923!3d20.956133380675094!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ad99484c57a5%3A0xc996799ee65d65b7!2zTcOheSBs4buNYyBuxrDhu5tjIE5hbm8gR2V5c2Vy!5e0!3m2!1svi!2s!4v1719192549872!5m2!1svi!2s" width="780" height="465" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            <!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d931.4075820377913!2d105.82027432923331!3d20.967355651429827!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135acfc50366359%3A0x399891005f193415!2zMzkgTmfDtSA2MzQgxJDGsOG7nW5nIEtpbSBHaWFuZywgVGhhbmggTGnhu4d0LCBUaGFuaCBUcsOsLCBIw6AgTuG7mWksIFZpZXRuYW0!5e0!3m2!1sen!2s!4v1624268661900!5m2!1sen!2s" width="780" height="465" style="border:0;" allowfullscreen="" loading="lazy"></iframe>-->
        </div>
        <div class="form-h">
            <div class="tit-form">Gửi yêu cầu tư vấn</div>
            <p>Bạn hãy điền thông tin và cho chúng tôi biết mong muốn của bạn.Chúng tôi sẽ liên hệ lại cho bạn ngay lập tức.</p>
            <form action="" id="create_contact_form" class="dathang-f" novalidate="novalidate">
                 <input class="form-control" name="full_name" id="full_name" type="text" placeholder="Họ tên(*)">
                <!--<input class="form-control" name="email" id="email" type="email" placeholder="Email(*)"> -->
                <input class="form-control" name="phone" id="phone" type="text" placeholder="Số điện thoại(*)">
                <textarea rows="3" name="note" id="note" class="form-control popup-placeholder" placeholder="Nội dung"></textarea>
                {{ csrf_field() }}
                <div class="loading-image" style="display:none; padding-top: 10px;color: #21a52d;"><img src="{{asset('assets/img/loading.gif')}}"></div>
                <div class="div_success" style="display:none; padding-top: 10px;color: #21a52d;">Gửi yêu cầu thành công</div>
                <button type="submit" class="buttom-s" id="buttom-s">Gửi yêu cầu tư vấn</button>
                <button type="reset" class="buttom-clear" id="buttom-r">Hủy</button>
            </form>
        </div>
        <div class="clear"></div>
    </div>
</div>
<style type="text/css">
    .error{
        float: left;
        color: red;
    }
    .loading-image img{
        width: 40px;
        color: #65A63A;
        padding-bottom: 12px;
    }
</style>
<script src="{{asset('assets/js/jquery.validate.min.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $('.buttom-clear').click(function(){
            $('#create_contact_form').trigger("reset");
        });
        $('#create_contact_form').validate({
            rules: {
                phone: {
                    "required": true,
                }
            },
            messages: {
                phone: {
                    "required": "Số điện thoại không được để trống",
                },
                note: {
                    // "required": true,
                }
            },
            errorPlacement: function(error, element) {         
               error.insertBefore(element);
            },
            submitHandler: function (form) {
                $.ajax({
                    url: '{{ URL::action("Front\ContactController@contactMe")}}',
                    type: 'post',
                    data: $(form).serialize(),
                    beforeSend : function(){
                        $('#loading-image').show();
                    },
                    success: function (response) {
                        $('#loading-image').hide();
                        if(response.code == 200){
                            $('.div_success').css('display','block');
                        }
                    }
                });
            }
        });
    });
</script>
<!--Map + form-->