var mainApp = {
    init: function(){
        this.placeholder();
        this.counter();
        this.photoPreview();
        this.addProoduct();
        this.shopSlider();
    },
    placeholder: function(){
        if(!Modernizr.input.placeholder){
            $('[placeholder]').focus(function() {
                var input = $(this);
                if (input.val() == input.attr('placeholder')) {
                    input.val('');
                    input.removeClass('placeholder');
                }
            }).blur(function() {
                var input = $(this);
                if (input.val() == '' || input.val() == input.attr('placeholder')) {
                input.addClass('placeholder');
                input.val(input.attr('placeholder'));
            }
            }).blur();
            $('[placeholder]').parents('form').submit(function() {
                $(this).find('[placeholder]').each(function() {
                var input = $(this);
                if (input.val() == input.attr('placeholder')) {
                    input.val('');
                }
                })
            });
        };
    },
    counter: function(){
        $('.counter .plus').click(function(){
            var inputElement =  $(this).parents('.counter').find('.counter_input')
            var currentVal = parseInt(inputElement.val());
            inputElement.val(currentVal+1).change();
            return false;
        });
         $('.counter .minus').click(function(){
            var inputElement =  $(this).parents('.counter').find('.counter_input')
            var currentVal = parseInt(inputElement.val());
            if(currentVal>1){
                inputElement.val(currentVal-1).change();
            }
            return false;
        });
    },
    photoPreview: function(){
        $('.img_preview a').click(function(){
            var img_url = $(this).attr('href');
            $(this).parents('.product_photo_widget').find('.big_img img').attr('src', img_url);
            $(this).parents('.img_preview').find('.active').removeClass('active');
            $(this).addClass('active');
            return false;
        });
    },
    addProoduct: function(){
        $('.product_form').on('submit', function(){
            var url  = $(this).attr('action');
            var data = $(this).serialize();

            ajaxApp.ajaxMethod(url, data, 'addCart');

            return false;
        });
    },
    triads: function(str){
        str = str.replace(/(\d{1,3})(?=((\d{3})*([^\d]|$)))/g, " $1 ");
        return str;
    },
    shopSlider: function(){
        if($('.shop_photo_content .slides').length>0 && $('.shop_photo_content .slides a').length>5){
            $('.shop_photo_content .slides').jCarouselLite({
                btnNext: '.btn_next',
                btnPrev: '.btn_prev',
                visible: 5,
                auto: 3000,
                speed: 1000
            });
        }   
    }
}
var filterApp = {
    init: function(){
        this.multiFilter();
        this.singleFilter();
        this.pagination();
    },
    multiFilter: function(){
        var obj = this;
        $('.multi_filter').click(function(){
            var name  = $(this).data('name');
            var id    = $(this).data('id');
            var input = '<input type="hidden" name="'+name+'" id="'+id+'" value="'+id+'">';
            
            if($(this).hasClass('active')){
                $('.filter_form #'+id+'').remove();
            }else{
                $('.filter_form').append(input);
            }

            $(this).toggleClass('active');
            
            obj.filterAply();
        });
    },
    singleFilter: function(){
        var obj = this;
        $('.single_filter').click(function(){
            if(!$(this).parents('.select_list').hasClass('no_filter')){
                var name  = $(this).data('name');
                var id    = $(this).data('id');
                var text  = $.trim($(this).text());
                var input = '<input type="hidden" name="'+name+'" id="'+id+'" value="'+id+'">';
                
                if(!$(this).hasClass('active')){
                    $('.filter_form').find('input[name='+name+']').remove();
                    $('.filter_form').append(input);
                    $(this).parents('.list').find('.active').removeClass('active');
                    $(this).addClass('active');
                    $(this).parents('.select_list').find('.current').text(text);
                    selectListApp.hide($(this));
                }
                
                obj.filterAply();
            }
        });
    },
    pagination: function(){
        var obj = this;

        $('.products').on('click', '.pagination a', function(){
            var name  = $(this).parents('.pagination').data('name');
            var id    = $(this).data('value');
            var input = '<input type="hidden" name="'+name+'" value="'+id+'">';

            if(!$(this).hasClass('active')){
                $('.filter_form').find('input[name='+name+']').remove();
                $('.filter_form').append(input);
            }
            
            obj.filterAply();
        });

    },
    filterAply: function(){
        var form = $('.filter_form');
        var url  = form.attr('action');
        var data = form.serialize();

        ajaxApp.ajaxMethod(url, data, 'filterCallback');
    }
}
var selectListApp = {
    init: function() {
        this.show();
        this.select();
    },
    show: function(){
        $('.select_list .current').click(function(){
            $(this).next().slideToggle().parents('.select_list').toggleClass('max_index');
        });
    },
    hide: function(element){
        element.parents('.select_list').removeClass('max_index').find('.list').slideUp();
    },
    select: function(){
        $('.select_list .list li').click(function(){
            if($(this).parents('.select_list').hasClass('no_filter')){
                var val = $(this).data('val');
                var text  = $.trim($(this).text());

                $(this).parents('.select_list').find('.select_input').val(val);
                if(!$(this).hasClass('active')){
                    $(this).parents('.list').find('.active').removeClass('active');
                    $(this).addClass('active');
                    $(this).parents('.select_list').find('.current').text(text);
                    selectListApp.hide($(this));
                }
            }
        });
    }
}
var ajaxApp = {
    ajaxMethod: function(url, data, callbackName){
        var obj = this;
        $.ajax({
            url: url,
            type: 'post',
            data: data,
            dataType: 'json',               
            success: function(data){
                if(data.response){
                    if(data.redirectUrl){
                        document.location.href = data.redirectUrl;
                    }else{
                        if(callbackName != ''){
                            obj.callBacks[callbackName](data);
                        }
                    }
                }else{
                    alert('Что-то пошло не так...');
                }
            },
            error: function(){
                alert('Ошибка сервера');
            },
            beforeSend: function(){

            }
        });
    },
    callBacks: {
        'filterCallback': function(data){
            $('.products_list').html(data.responseContent);
        },
        'addCart': function(data){
            $('.cart_widget .value').html(data.responseContent);
            $('body,html').animate({scrollTop:0},500);
        },
        'sendOrder': function(data){
            $('.order').html(data.responseContent);
        }
    }
}
var cartApp = {
    init: function(){
        this.counter();
        this.removeItem();
        this.sendOrder();
    },
    counter: function(){
        var obj = this;

        $('.cart_item .counter_input').on('change', function(){
            var currentCount = $(this).val();
            var currentPrice = $(this).parents('.cart_item').data('price');
            var newItemPrice = currentCount*currentPrice;

            $(this).parents('.cart_item').find('.count_price .price .val span').text(mainApp.triads(newItemPrice.toString()));

            obj.reSumm();
        });
    },
    removeItem: function(){
        var obj = this;

        $('.cart_item .remove').click(function(){
            $(this).parents('.cart_item').remove();
            obj.reSumm();
            return false;
        });
    },
    reSumm: function(){
        var obj = this;

        var form = $('.cart');
        var url  = form.attr('action');
        var data = form.serialize();

        ajaxApp.ajaxMethod(url, data, '');

        var allCount = 0;
        var allPrice = 0;
        var finishPrice = 0;
        var deliverySumm = $('.delivery_price').data('delivery-summ');
        var deliveryCondition = $('.delivery_price').data('delivery-condition'); 

        $('.cart').find('.cart_item').each(function(){
            var itemPrice = $(this).data('price');
            var itemCount = $(this).find('.counter_input').val();
            allCount = parseInt(allCount) + parseInt(itemCount);
            allPrice = allPrice + itemPrice*itemCount;
        });

        $('.cash_info .products_price span').text(mainApp.triads(allPrice.toString()));
        $('.cart_widget .price_cart').text(mainApp.triads(allPrice.toString()));
        $('.cart_widget .count_cart').text(allCount);
        $('.cart_widget .count_text_cart').text(obj.returnWord(allCount));
        if(allPrice>=deliveryCondition){
            $('.delivery_price span').text(0);
            $('.cash_info .final_price').text(mainApp.triads(allPrice.toString()));
        }else{
            finishPrice = deliverySumm + allPrice;
            $('.delivery_price span').text((mainApp.triads(deliverySumm.toString())));
            $('.cash_info .final_price').text(mainApp.triads(finishPrice.toString()));
        }
    },
    returnWord: function(number){
        var titles = ['товар', 'товара', 'товаров'];
        cases = [2, 0, 1, 1, 1, 2];  
        return titles[ (number%100>4 && number%100<20)? 2 : cases[(number%10<5)?number%10:5] ];  
    },
    'sendOrder': function(){
        $('.order').on('submit', function(){
            var form = $(this);
            var url  = form.attr('action');
            var data = form.serialize();

            ajaxApp.ajaxMethod(url, data, 'sendOrder');

            return false;
        });
    }
}
$(document).ready(function() {
    mainApp.init();
    filterApp.init();
    selectListApp.init();
    cartApp.init();
});