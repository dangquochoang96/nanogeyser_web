var start = 0;
$(document).ready(function(){
    $('#comment').click(function() { 
        $('.comment_after').slideDown(200);
    });
});
$('#loadmore').click(function(){
    start           = start + 5;
    var id_comment  = $('#id_comment').val();
    var dataObj = {
        'start' : start,
        'url_ajax' : $("#url_ajax").val(),
    }; 
    $.post('index.php?route=common/comment/index&product_id='+id_comment, dataObj, function(response) { 
        // console.log(response); 
        var comments = JSON.parse(response);
        if(comments.length < 5){
            $('#loadmore').hide();
        }
        $.each(comments, function( index, value ) {
           var html =   '<div class=\"col-md-1 col-sm-1 col-xs-1 img-uer\">'
                        +'<span><i class=\"fa fa-user\" aria-hidden=\"true\"></i></span>'
                        +'</div>'
                        +'<div class=\"col-md-11 col-sm-11 col-xs-11 \">'
                        +   '<div class=\"commentitem\"><h5>'
                        +   value.name
                        +   '<i class=\"fa fa-commenting\" aria-hidden=\"true\"></i>'

                        +'<div class="rating-start rating-comment">'
                        +'<span itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">'
                        +'<input id="input-id" type="number" value="'+ value.rating +'" class="rating" min=0 max=5 step=0.5 data-size="sm"></span>'
                        // +'<div class="alert alert-success alert-success-comment" style="display:none">'
                        // +'<strong>Thành Công! </strong> Cảm ơn bạn đã bình chọn.'
                        // +'</div>'
                        +'</div>'


                        +   '<span class=\"pull-right\">'
                        +   value.email+'<i> '
                        +   value.date_add
                        +   '</i></span></h5><p>'
                        +   value.comment
                        +   '</p>'
                        +   "<span class=\"mod_comment_reply\" data-id='"+value.id+"'>Trả lời</span>"
                        +   value.sub
                        +   '</div>'
                        +   '</div>';
                $('#listcommrnts').append(html);
                $('input.rating').rating();
        });
    }); 
});
$('.btn-comment').click(function() {
    $('#error').hide();
    $('#success').hide();
    var dataObj = {
        'name' 		: $('#name').val(),
        'email' 	: $('#email').val(),
        'comment' 	: $('#comment').val(),
        'url'		: $('#id_comment').val()
    };
    if( checkValue(dataObj) ){ 
        $('#loading').show();
        $.post('index.php?route=common/comment/writeComment', dataObj, function(response) { 
            window.location.reload();
        	// response = jQuery.parseJSON(response);
         //    if(response.success == "success"){
         //        $('.comment_after').slideUp(200);
         //        var myDate = new Date();
         //        var displayDate = myDate.getHours() + ':' +myDate.getMinutes() + ' ' +(myDate.getMonth()+1) + '/' + (myDate.getDate()) + '/' + myDate.getFullYear();
         //        var html = '<div class="col-md-12 col-sm-12 col-xs-12 commentitem"><h5>'+dataObj['name']+'<span class="pull-right">'+dataObj['email']+' <i>'+displayDate+'</i></span></h5><p>'+dataObj['comment']+'</p><span class="mod_comment_reply" data-id="">Trả lời</span></div>';
         //        $('#listcommrnts').prepend(html);
         //    }  
         //    $('#comment').val('');

         //    $('#loading').hide();
        }); 
    }
});

function ValidateEmail(){
    var x = document.forms["form"]["email"].value; 
    var y = document.getElementById("email").value;
    var mailformat = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (x == null || x == "") {
        showerror('Email không được để trống!','#email');
        return false;  
    }
    else{
        if(y.match(mailformat)){
            showerror('Email đạt tiêu chuẩn!','#email');  
            return true;  
        }  
        else{
            showerror('Email phải theo mẫu(email@example.com)!','#email');
            return false;  
        }  
    }

}

function ValidateName(){
    var x = document.forms["form"]["name"].value;
    var y = document.getElementById("name").value;
    //var nameformat = /^[a-zA-Z0-9 ]*$/;
    if (x == null || x == "") {
        showerror('Tên không được để trống!','#name');
        return false;  
    }
    else{
        if (y.length <=6) {
            showerror('Tên phải không được nhỏ hơn 6 kí tự!','#name');
            return false;  
        }
        else{
            showerror('Tên đạt tiêu chuẩn!','#name');
            return true;
        }
    }

}
function ValidateComment(){
    var x = document.forms["form"]["comment"].value;
    var y = document.getElementById("comment").value;
    if (x == null || x == "") {
        showerror('Bình luân không được để trống!','#comment');
        return false;  
    }
    else{
        if(y.length <=10){
            showerror('Bình luận không được nhỏ hơn 10 kí tự!','#comment');
            return false;
        }
        else{
            showerror('Bình luân đạt tiêu chuẩn!','#comment');
            return true;
        }
    }
}

function ValidateReplyEmail(){
    var y = document.getElementById("remail").value;
    var mailformat = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if ($.trim($('.reply_email') == '')) {
        showerror('Bạn chưa nhập email!','#remail');
        return false;  
    }
    else{
        if(y.match(mailformat)){
            showerror('Email đạt tiêu chuẩn!','#remail');  
            return true;  
        }  
        else{
            showerror('Email phải theo mẫu(email@example.com)!','#remail');
            return false;  
        }  
    }

}

function ValidateReplyName(){
    var y = document.getElementById("rname").value;
    if ($.trim($('.reply_name') == '')) {
        showerror('Bạn chưa nhập tên!','#rname');
        return false;  
    }
    else{
        if(y.length <= 6){
            showerror('Tên quá ngắn!','#rname');
            return false;  
        }
        else{
            showerror('Tên đạt tiêu chuẩn!','#rname');
            return true;
        }
    }

}

function ValidateReplyComment(){
    var y = document.getElementById("rcomment").value;
    if ($.trim($('.reply_comment') == '')) {
        showerror('Bạn chưa nhập câu trả lời!','#rcomment');
        return false;  
    }
    else{
        if(y.length <= 10){
            showerror('Câu trả lời quá ngắn!','#rcomment');
            return false;
        }
        else{
            showerror('Câu trả lời đạt tiêu chuẩn!','#rcomment');
            return true;
        }
    }
}

function validEmail(email){
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

function checkValue(d){
    if(d['name'] ==''){
        return false;
    }
    if(!validEmail(d['email'])){
        return false;
    }
    if(d['comment'] ==''){
        return false;
    }
    return true;
}
function showerror(m,i){
    $('#error').text(m);
    $('#error').show();
    $(i).focus();
}
$(document).ready(function(){
    $('body').on('click','.mod_comment_reply',function(){
        $('#listcommrnts').find('.form_reply_comment').remove();
        var id = $(this).attr('data-id');
        var html = "<div class=\"form_reply_comment\"><div class=\"form-group col-md-12 col-sm-12 col-xs-12\"><textarea class=\"form-control reply_comment\" rows=\"2\" name=\"reply_comment\" id=\"rcomment\"  placeholder=\"Nội dung bình luận\"></textarea></div>"
        + "<div class=\"rcomment_after\" style=\"display:none;\">"
        + "<div class=\"form-group col-md-5 col-sm-5 col-xs-5\"><input type=\"text\" class=\"form-control reply_name\" id=\"rname\" name=\"reply_name\" placeholder=\"Tên của bạn\"></div>"
        + "<div class=\"form-group col-md-5 col-sm-5 col-xs-5\"><input type=\"email\" class=\"form-control reply_email\" id=\"remail\"  name=\"reply_email\" placeholder=\"email@example.com\"></div>"
        + "<div class=\"form-group col-md-1 col-sm-1 col-xs-1\"><input type=\"button\" class=\"btn btn-info btn-lg   form_reply_send\" data-id=\'"+id+"\' value=\"Gửi\"></div>"
        + "<div class=\"form-group col-md-1 col-sm-1 col-xs-1\"><input type=\"button\" class=\"btn btn-info btn-lg   form_reply_cancel\" data-id=\'"+id+"\' value=\"Hủy\" ></div>";
        + "</div>"
        $(this).after(html);
        $('.form_reply_comment').slideDown(400);                        
    });
    $('body').on('click','.reply_comment',function(){
        $('.rcomment_after').slideDown(500);
    });
    $('body').on('click','.form_reply_send',function(e){
        var message = $('.reply_comment').val();
        var name = $('.reply_name').val();
        var email = $('.reply_email').val();
        var id_comment = $(this).attr('data-id');
        var idsp = $('#p_idsp').val();
        var total = $('.mod_statistics').find('b:last').text();
        var node = $('.mod_reply_box').parent().parent();
        if($.trim(message) == ''){
            alert('Bạn chưa nhập câu trả lời!');
            $('.mod_reply_info').focus();
            return false;
        }
        if(message.length <= 10){
            alert('Tin nhắn quá ngắn!');
            $('#p_message').focus();
            return false;
        }
        if($.trim(name) == ''){
            alert('Chưa nhập tên!');
            $('.mod_reply_name').focus();
            return false;
        }
        if(name.length <= 6){
            alert('Tên quá ngắn!');
            $('#p_message').focus();
            return false;
        }
        if($.trim(email) == ''){
            alert('Chưa nhập email!!!');
            $('.mod_reply_email').focus();
            return false;
        }
        if (!email.match(/^[a-z0-9_\.]{2,32}@[a-z0-9\-]{3,}(\.[a-z]{2,4}){1,2}$/gi)) {
            alert('email không hợp lệ!');
            $('.mod_reply_email').focus();
            return false;
        }
        $('.mod_reply_box').before("<center class='mod_loading'><img src='http://webbnc.net/themes/web/common/comment/imgs/loading.gif' /></center>");
        var datajson = {
            'name'       : name,
            'email'      : email,
            'comment'    : message,
            'url'		 : $('#id_comment').val(),
            'id_comment' : id_comment,
        };        
        $.post('index.php?route=common/comment/writeComment', datajson, function(response) {   
        	response = jQuery.parseJSON(response);         
            $('.mod_loading').remove();
            $('.mod_reply_info').val('');            
            total = parseInt(total)+1;

            var html = '<div class="col-md-12 col-sm-12 col-xs-12 commentitem"><h5>'+datajson['name']+'<span class="pull-right">'+datajson['email']+' <i>'+datajson.time_cr+'</i></span></h5><p>'+datajson['comment']+'</p><span class="mod_comment_reply" data-id='+response.id+'>Trả lời</span></div>';
            var abc = $('.form_reply_send').parent().parent().parent().find('.mod_comment_reply').after(html);
            console.log(e);
            $('.form_reply_comment').remove();
        });
    });

})