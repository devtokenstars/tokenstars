import axios from 'axios';


let popup = require('./popup');

function removeHash () {
    let scrollV, scrollH, loc = window.location;
    if ("pushState" in history)
        history.pushState("", document.title, loc.pathname + loc.search);
    else {
        // Prevent scrolling by storing the page's current scroll offset
        scrollV = document.body.scrollTop;
        scrollH = document.body.scrollLeft;

        loc.hash = "";

        // Restore the scroll offset, should be flicker free
        document.body.scrollTop = scrollV;
        document.body.scrollLeft = scrollH;
    }
}

$(function(){
    let checkHash = () => {
        let hash = window.location.hash;
        if (hash) {
            hash = hash.replace('#', '');
            console.log(hash);
            popup.openPopup(hash, () => {
                removeHash();
            });
        } else {

        }
    };
    $(window).on('hashchange', checkHash);
    checkHash();

});


$('button#login_btn').click(function(e) {

    e.preventDefault();

    let form = $('form.js-login-form');
    $('.alert-danger', form).addClass('hide');

    $.post(form.attr('action'), form.serializeArray(), function (data, textStatus, jqXHR) {
        removeHash();
        document.location.reload(true);
    })

        .fail(function(textStatus) {

            $('.alert-danger ul', form).empty();

            $('.alert-danger', form).removeClass('hide');

            Object.keys(textStatus.responseJSON.errors).map(function(error, index) {
                let value = textStatus.responseJSON.errors[error];
                $('.alert-danger ul', form).append('<li>' + value + '</li>')
            });
        })
});


$('form#sign_up_form button').click(function(e) {
    e.preventDefault();

    let form = $('form#sign_up_form');
    $('.alert-danger', form).addClass('hide');

    $.post(form.attr('action'), form.serializeArray(), function (data, textStatus, jqXHR) {
        popup.closePopup();
        notie.alert({ type: 1, text: 'Thank you for the request, please check your email for the details.', time: 12 });
    })

        .fail(function(textStatus) {

            $('.alert-danger ul', form).empty();

            $('.alert-danger', form).removeClass('hide');

            Object.keys(textStatus.responseJSON.errors).map(function(error, index) {
                let value = textStatus.responseJSON.errors[error];

                $('.alert-danger ul', form).append('<li>' + value + '</li>')
            });
        })

});
