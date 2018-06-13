// Form Validation

jQuery.fn.validate = function() {
    var form=$(this);

    form.attr("valid", 1);
    $(".email", form).each(function(){
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/;
        var id=$(this).attr('id');

        if($(this).val() && filter.test($(this).val())){
            $(this).removeClass("error");
            $("label[for="+id+"]").removeClass("error");
        }else{
            $(this).addClass("error");
            $("label[for="+id+"]").addClass("error");
            form.attr("valid", 0);
        }
    });
    $(".required", form).each(function(){
      var id=$(this).attr('id');
        if($(this).val() && $(this).val()!=$(this).attr("val")&& $(this).val()!=""){
            $(this).removeClass("error");
            $("label[for="+id+"]").removeClass("error");
        }else{
            $(this).addClass("error");
            $("label[for="+id+"]").addClass("error");
            form.attr("valid", 0);
        }
    });
    $(".error").focus(function(){
      var id=$(this).attr('id');

      $("label[for="+id+"]").removeClass("error");
        $(this).removeClass("error");
    });
    if(form.attr("valid")==0)
        return false;
};

$('.j-header-nav-list a').click(function(e) {
    $('.j-header-nav').removeClass('opened');
    $('html').removeClass('no-scroll');
});

// Check if team member has a big height then make it smaller and add button
function check_team(btn_text) {
    $.each($('.team-item-text'), function(val){
        if($(this).height() > 200)
        {
            $(this).addClass('team-item-text--big')
            $(this).append('<a class="btn btn-small btn-blue j-team-info">' + btn_text + '</a>');
        }
    })

    $('.j-team-info').click( function(e) {
        $(this).closest('.team-item-text').removeClass('team-item-text--big');
    });
}

function check_header() {
  if($(window).scrollTop()>0){
      $("header").addClass('scrolled');
  }else{
      $("header").removeClass('scrolled');
  }
}

$(function(){
    $(window).scroll(function(){
        check_header();
    });

  $('a[href^="#"]').on('click', function(event) {
    var target = $( $(this).attr('href') );
    if(target.length){
      event.preventDefault();
      $('html, body').animate({
        scrollTop: target.offset().top-60
      }, 500);
    }
  });


  check_header();

  var iOS = /iPad/.test(navigator.userAgent) && !window.MSStream;

    $(".slider").slick({
    centerMode: true,
    focusOnSelect: true,
    variableWidth: true,
      adaptiveHeight: true,
      slidesToShow: 1,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            arrows: false,
            centerMode: true,
            centerPadding: '40px',
            slidesToShow: 1
          }
        },
        {
          breakpoint: 480,
          settings: {
            arrows: false,
            centerMode: true,
            centerPadding: '40px',
            slidesToShow: 1
          }
        }
      ]
  });

  $(".header-lang-button").click(function(){
      $(".header-lang-list").slideToggle();
      return false;
  });

  $(".money label").click(function(){
      $(".money label").removeClass('active');
      $(this).addClass('active');
  });

  $(".cases ul li a").click(function(){
      var id=$(this).data('id');

      $(".cases ul li").removeClass('active');
      $(this).parent().addClass('active');

      $(".cases .block").removeClass('active');
      $(".cases .block[data-id="+id+"]").addClass('active');

      $(".cases .image").removeClass('active');
      $(".cases .image[data-id="+id+"]").addClass('active');

      $('html, body').animate({
        scrollTop: $(".cases").offset().top-$("header").height()
      }, 500);

      return false;
  });

  $(".sendform").click(function(){
    var name=$(this).attr('rel');
    var item="form[name="+name+"]";
    $(item).validate();

    if($(item).attr('valid')==1){
      $.post("/ajax/form."+name+".php",$(item).serialize(),function(data){
        $(item).html(data);
      });
    }else{

    }
    return false;
  });

  // $(".submit").click(function(){
  //   var name=$(this).attr('rel');
  //   var form=$("form[name="+name+"]");
  //   form.validate();
  //   if(form.attr('valid')==1){
  //     form.submit();
  //     return false;
  //   }else{
  //     //document.location="#"+name;
  //     return false;
  //   }
  // });

  // $("form").submit(function(){
  //   if($(".sendform",$(this)).size()==1){
  //     var name=$(".sendform",$(this)).attr('rel');
  //     var item=$(this);
  //     item.validate();
  //     if(item.attr('valid')==1){
  //       $.post("/ajax/form."+name+".php",$(item).serialize(),function(data){
  //         $(item).html(data);
  //       });
  //     }else{
  //       document.location="#"+name;
  //     }
  //     return false;
  //   }else{
  //     $(this).validate();
  //     if($(this).attr('valid')==1){
  //       return true;
  //     }else{
  //       return false;
  //     }
  //   }
  // });


  var vimeovideo = document.getElementById('j-vimeo-video');

  if(vimeovideo)
    var vimeoplayer = new Vimeo.Player(vimeovideo);

  $('.j-popup-trigger').click(function(e){
      $($(this).data('target-popup')).addClass('showing');
  });

  $('.j-popup-video-trigger').click(function(e){
    if(vimeoplayer)
      vimeoplayer.play();

    if($('.j-youtube-video').length)
      $('.j-youtube-video')[0].contentWindow.postMessage('{"event":"command","func":"' + 'playVideo' + '","args":""}', '*');

  });

  $('.j-hide-popup').click(function(e){
      var $popup = $(this).closest('.j-popup');
      $popup.removeClass('showing');
      $popup.trigger('j-popup:close');
    if(vimeoplayer)
      vimeoplayer.unload();

    if($('.j-youtube-video').length)
      $('.j-youtube-video')[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
  });

  $('.j-christmas-banner').click(function(e) {
      if($(e.target).closest('.j-christmas-close').length) {
          e.preventDefault();
          $('.j-christmas-banner').hide();
          return false;
      }
  });

  $('.j-popup').click(function(e){
      if(!$(e.target).closest('.j-popup-holder').length) {
          $(this).removeClass('showing');
          $(this).trigger('j-popup:close');
          if(vimeoplayer)
            vimeoplayer.unload();

          if($('.j-youtube-video').length)
            $('.j-youtube-video')[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
      }
  });

  $('.ambassador-card').click(function(e) {
    if ($(window).width() > 767) {
      e.stopPropagation();
      var clickedAmb = $(this).attr('rel'),
          ambID = $('#' + clickedAmb);
      $('.ambassador-popup-holder').removeClass('hide');
      ambID.removeClass('hide');
    };
  });
  $('#ambassadors, .j-close-amb-popup').click(function(){
    $('.ambassador-popup-holder').addClass('hide');
    $('.ambassador-card-popup').addClass('hide');
  });
  $('.ambassador-popup').click(function(e){
    e.stopPropagation();
  });
  $('.j-toggle-bid-history').click(function(e){
    $('.bid-history-holder').toggleClass('hide');
  });
  function showPlatformDescription() {
    $('.platform-description-holder').removeClass('hide');
    $('html, body').animate({
      scrollTop: $(".platform-description-holder").offset().top-$("header").height()
    }, 500);
  };
  $('.j-platfrom-full-description-toggle').click(function(e){
     showPlatformDescription();
  });
  $('.j-jump-to-top').click(function(e){
      $('html, body').animate({
        scrollTop: 0
      }, 500);
  });

    // Promo popup

    // if (!localStorage.getItem("start_popup_time")) {
    //     localStorage.setItem('start_popup_time', Date.now());
    //     localStorage.setItem('popup_will_show', true);
    // }

    // if (localStorage.getItem("start_popup_time") && localStorage.getItem("popup_will_show") === 'true') {
    //     function checkTime() {

    //         setTimeout(function () {

    //             var time_now = Math.round((new Date()).getTime() / 1000);

    //             if (time_now - Math.round((localStorage.getItem("start_popup_time") / 1000)) >= 60 * 2) {
    //                 $('.j-promobonus-popup').addClass('showing');
    //                 localStorage.setItem('popup_will_show', false);
    //             } else {
    //                 checkTime();
    //             }

    //         }, 1000 * 10)
    //     }

    //     checkTime();

    // }





    let statePrice = {
        send : {
            currency: {
                type: null,
                value: null
            }
        },

        get : {
            currency: {
                type: null,
                value: null
            }
        }
    };

    function setStatePrice(type, currency, value) {
        statePrice[type]['currency']['type'] = currency;
        statePrice[type]['currency']['value'] = value;
    }


    function prepareInput ($input, float) {

        console.log('PREPARE')
        if (typeof float === 'undefined') {
            float = true
        }
        $input.keypress(function (e) {
            // Allow: backspace, delete, tab, escape, enter and . and ,
            if ($.inArray(e.which, [14, 17, 8, 9, 27, 13].concat(float ? [44, 46] : [])) !== -1 ||
                // Allow: Ctrl+A, Command+A
                (e.which === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                //Allow ctrl+v, ctrl+c
                (e.which === 67 && (e.ctrlKey === true || e.metaKey === true)) ||
                (e.which === 86 && (e.ctrlKey === true || e.metaKey === true))) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.which < 48 || e.which > 57))) {
                e.preventDefault();
            }
        });

        $input.keydown((e) => {
            setTimeout(() => {
                let decimals = Number($(e.target).data('decimals')) || 18,
                    pattern = new RegExp(`^[0-9]{0,100}[\\.\\,][0-9]{0,${decimals}}$`),
                    value = $input.val(),
                    dotPosition = value.search(/[,.]/);
                if (!pattern.test(value) && dotPosition !== -1) {
                    $input.val(value.substr(0, dotPosition + decimals + 1));
                }
            }, 1);
        });

        if (float) {
            $input.on('paste', function () {
                var element = this;
                setTimeout(function () {
                    var text = $(element).val();
                    $(element).val(text.replace(/[^0-9.,]/g, ""));
                }, 100);
            });
        } else {
            $input.on('paste', function () {
                var element = this;
                setTimeout(function () {
                    var text = $(element).val();
                    $(element).val(text.replace(/[^0-9]/g, ""));
                }, 100);
            });
        }

        $input.focus((e) => {
            let $this = $(e.target);
            $this.select();

            // Work around Chrome's little problem
            $this.mouseup(function() {
                // Prevent further mouseup intervention
                $this.unbind("mouseup");
                return false;
            });
        });
    }


    let $arrow = $('.j-calc-widget .main-widget__arrow');

    let $buyTokens = $('.js-buy-tokens');

    function arrowToLeft() {
        arrow = 'left';
        // $arrow.css('transform', 'rotate(180deg)');

        $arrow.removeClass('arrow_get_tokens');
        $arrow.addClass('arrow_get_crypto');

        $getValInput.addClass('active');
        $sendValInput.removeClass('active');
    }

    function arrowToRight() {
        arrow = 'right';
        // $arrow.css('transform', 'rotate(360deg)');

        $arrow.removeClass('arrow_get_crypto');
        $arrow.addClass('arrow_get_tokens');

        $sendValInput.addClass('active');
        $getValInput.removeClass('active');
    }

    let $sendValInput = $('.j-calc-widget .send-value');
    let $getValInput = $('.j-calc-widget .get-value');
    let $selectSendCurrency = $sendValInput.parent().find('select');
    let $changeToken = document.getElementById('currency_token');
    let $selectGetCurrency = $getValInput.parent().find('select');
    let $youGetCurrency = $('#token_type');
    let arrow = null;

    $selectSendCurrency.change(function(event) {

        if (arrow === 'left') {
            let currencyToken = document.getElementById('currency_token').value;
            let currencyCoin = event.target.value;

            calcSendVal(currencyToken, currencyCoin, $getValInput.val())

        } else {
            setStatePrice('send', event.target.value, $sendValInput.val());
            calcGetVal($sendValInput.val(), event.target.value)
        }

    });


    if (document.getElementById('currency_token') != null) {

        document.getElementById('currency_token').onchange = function(e){


            youGet(e.target.value);

            if (arrow === 'left') {
                let currencyToken = document.getElementById('currency_token').value;
                let currencyCoin = $sendValInput.parent().find('option:selected').val();

                calcSendVal(currencyToken, currencyCoin, $getValInput.val())

            } else {
                let currencyCoin = $sendValInput.parent().find('option:selected').val();
                setStatePrice('send', currencyCoin, $sendValInput.val());
                calcGetVal($sendValInput.val(), currencyCoin)
            }
        };
    }




    $selectGetCurrency.change(function(event) {

        if (arrow === 'right') {
            let currencyCoin = $sendValInput.parent().find('option:selected').val();
            calcGetVal($sendValInput.val(), currencyCoin);

        } else {

            let currencyToken = event.target.value;
            let currencyCoin = $sendValInput.parent().find('option:selected').val();
            setStatePrice('get', event.target.value, $getValInput.val())
            calcSendVal(currencyToken, currencyCoin, $getValInput.val())
        }

    });


    function calcGetVal(sendVal, currency) {
        let currencyToken = document.getElementById('currency_token').value;
        setStatePrice('get', currency, sendVal /  window.prices[currencyToken.toLowerCase()][currency.toLowerCase()])
        let decimals = currencyToken === 'ACE' ? 1 : 100;
        $getValInput.val(Math.round(statePrice['get']['currency']['value'] * decimals) / decimals);
    }


    function calcSendVal(currencyToken ,currencyCoin , getVal) {
        setStatePrice('send', currencyCoin, getVal * window.prices[currencyToken.toLowerCase()][currencyCoin.toLowerCase()])
        $sendValInput.val(statePrice['send']['currency']['value'].toFixed(2));
    }


    $sendValInput.click(arrowToRight);

    $getValInput.click(arrowToLeft);


    prepareInput($sendValInput);
    $sendValInput.on('click focus blur keyup change', function() {
        let currency = $sendValInput.parent().find('option:selected').val();
        let sendVal = $(this).val();

        setStatePrice('send', currency, sendVal)

        calcGetVal(sendVal, currency)

    });


    prepareInput($getValInput);
    $getValInput.on('click focus blur keyup change', function() {
        let currencyToken = document.getElementById('currency_token').value;
        let currencyCoin = $sendValInput.parent().find('option:selected').val();

        let getVal = $(this).val();

        setStatePrice('get', currencyCoin, getVal)

        calcSendVal(currencyToken, currencyCoin, getVal)

    });

    youGet = (val) => {
        $youGetCurrency.text(val);
        let url = 'https://www.okex.com/market?product=ace_btc';
        if (val === 'TEAM') {
            url = 'https://www.bit-z.com/trade/team_btc';
        }
        $buyTokens.attr('href', url)
    };



    function init() {
        $sendValInput.focus()
    };


    init();

});

$(function() {
  $(window).ready(function() {
    let $currency = $('.js-select-currency'),
        $buyTokens = $('.js-buy-tokens');
    let currency = $currency.find('option:selected').text();

    $currency.change(function() {
      currency = $(this).find('option:selected').text();
    });

    $buyTokens.click(function(e) {
      e.preventDefault();
      window.ga('send', 'event', 'buy_tokens_' + currency.toLowerCase(), 'pers_acc', 'menu');
      let url = $(this).attr('href');
      window.open(url, '_blank')
    });
  });
});
