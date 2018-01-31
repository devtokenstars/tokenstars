let $ = require('jquery');

let lastCloseCallback,
    popup = {
    fixDocument: () => {
        $('body').addClass('st-scroll');
        $('html').addClass('st-margin').css({"margin-right": $.scrollbarWidth()});
    },

    unfixDocument: () => {
        $('body').removeClass('st-scroll');
        $('html').removeClass('st-margin').removeAttr('style');
    },

    openPopup: (type, closeCallback) => {
        popup.clearErrors();

        let popupBox = $('.popup-box.el-' + type);
        lastCloseCallback = closeCallback;
        console.log(popupBox);
        popup.fixDocument();

        $('.popup').removeClass('st-active');
        popupBox.closest('.popup').addClass('st-active');

        $('.popup-box').css({'display': 'none'});
        popupBox.css({'display': 'block'});
    },

    closePopup: () => {
        $('.popup').removeClass('st-active');
        $('.popup-box').css({'display': 'none'});


        if (lastCloseCallback) {
            lastCloseCallback();
        }
        popup.unfixDocument();
        popup.clearErrors();
    },

    clearErrors: () => {
        $('form .alert-danger').addClass('hide');
        $('form .alert-danger ul').empty();
    }
};

$(function () {
    // popup scripts
    $.scrollbarWidth = function () {
        var parent, child, width;

        if (width === undefined) {
            parent = $('<div style="width:50px;height:50px;overflow:auto"><div/></div>').appendTo('body');
            child = parent.children();
            width = child.innerWidth() - child.height(99).innerWidth();
            parent.remove();
        }

        return width;
    };

    $('.js-popup_close').click(function () {
        popup.closePopup();
    });

    $(document).mousedown(function (e) {
        let popupBox = $('.popup-box');

        if (!popupBox.is(e.target) && popupBox.has(e.target).length == 0) {
            popup.closePopup();
        }
    });
});

module.exports = popup;