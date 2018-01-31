window.$ = window.jQuery = require('jquery');
notie = require('notie');
let popup = require('./popup');
require('rangeslider.js');
require('./auth');

$(function () {
    var isMobile = false; //initiate as false
    // device detection
    if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
       || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) isMobile = true;

    var view = $('body').data('view');

    if($('body').data('start-poup') || (isMobile && view=='home_l3')) {
        if ($('.popup-box.el-subscribe').length) {
            setTimeout(function () {popup.openPopup('subscribe')}, 2000);
        }
    }

    $(document).on('click', '.js-popup_open', function (event) {
        event.preventDefault();

        $('.js-bid-empty').show();
        $('.js-bid-email').hide();

        var $form = $('.js-wallet_form, .js-no-registration-email');
        var type = $(this).data('type');
        var itemId = parseInt($(this).data('item-id'));

        $('.js-item_id_input').val(itemId);
        $('.js-wallet_form_button').show();

        $('input[type=radio][name=currency]', $form).prop('checked', false);
        $('.js-bid-payments').hide();

        if (itemId < 15) {
            $('.js-btc-radio', $form).show();
            $('.js-bch-radio', $form).hide();
        } else {
            $('.js-btc-radio', $form).hide();
            $('.js-bch-radio', $form).show();
        }
        popup.openPopup(type);
    });


    /**
     * Submit wallet popup form.
     */
    $('.js-wallet_form, .js-no-registration-email').submit(function(e) {
        e.preventDefault();
        var $form = $(this);
        var currency = $('input[type=radio][name=currency]:checked', $form).val();
        $('.js-bid-payments').hide();
        var $bidPayments = $('.js-payments' + currency);
        $('.js-loader').show();
        $.post($form.attr('action'), $form.serializeArray(), function (data, textStatus, jqXHR) {
            if (data.error) {
                $('.js-loader').hide();
                $bidPayments.hide();
                $('.js-bid-error').text(data.error).show();
                return;
            }
            $('.js-bid-email').hide();
            $('.js-bid-error').hide();
            if (data['highest_bid'] === 'NO') {
                $('.js-highest-bid', $bidPayments).text('');
            } else {
                $('.js-highest-bid', $bidPayments).text('Current highest bid is ' + data['highest_bid']);
            }

            if (data['your_bid'] === 'NO') {
                $('.js-your-bid', $bidPayments).text('You didn\'t bid for this item yet. We recommend you to bid ' + data['lead_bid'] + ' or more to take the lead.');
            } else {
                if (data['lead_bid'] === 'NO') {
                    $('.js-your-bid', $bidPayments).text('Your current bid is ' + data['your_bid'] + ' and you are the highest bidder!');
                } else {
                    $('.js-your-bid', $bidPayments).text('Your current bid is ' + data['your_bid'] + ' We recommend you to add ' + data['lead_bid'] + ' or more to take the lead.');
                }
            }


            $('.bid-metamask input', $bidPayments).val(data['metamask_bid']);
            $('.js-wallet_address', $bidPayments).text(data['wallet']);
            $('.js-item-eth-wallet', $bidPayments).text(data['eth_wallet']);
            $('.js-metamask-tip', $bidPayments).data('eth-wallet', data['eth_wallet']);
            $('.js-loader').hide();
            $bidPayments.show();
        });
    });
    $('input[type=radio][name=currency]', $('.js-no-registration-email')).change(function(e) {
        var $form = $(this).closest('form')
        $('.js-bid-empty').hide();
        e.preventDefault();
        $('.js-bid-payments').hide()
        var currency = $('input[type=radio][name=currency]:checked', $form).val()
        var $bidPayments = $('.js-payments' + currency)
        if ($('.js-wallet_address', $bidPayments).text().length > 1) {
            $('.js-bid-email').hide()
            $bidPayments.show()
        } else {
            if (currency === 'ACE' || currency === 'TEAM') {
                $('.js-bid-email').hide()
                $bidPayments.show()
            } else {
                $('.js-bid-email').slideDown(200)
            }
        }
    });
    $('input[type=radio][name=currency]', $('.js-wallet_form')).change(function(e) {
        $('.js-bid-empty').hide();
        e.preventDefault();
        var $form = $(this);
        $form.submit();
    });

    function startTimer(estimated, serverTime, item) {
        let dateCurrentServer = new Date(serverTime),
            dateCurrentLocal = new Date(),
            localDiff = dateCurrentServer.getTime() - dateCurrentLocal.getTime(),
            dateEnd = new Date(estimated);

        setInterval(function() {
            let dateDiff = dateEnd.getTime() - (new Date().getTime()) - localDiff,
                days = Math.floor(dateDiff / 1000 / 60 / 60 / 24),
                hours = Math.floor(dateDiff / 1000 / 60 / 60 % 24),
                minutes = Math.floor(dateDiff / 1000 / 60 % 60);

            hours = hours < 10 ? "0" + hours : hours;
            minutes = minutes < 10 ? "0" + minutes : minutes;

            item.text(days + ' days, ' + hours + ' hours and ' + minutes + ' minutes left');

        }, 1000);
    }

    $('.js-auction-card-timer').each(function() {
        var item = $(this);
        var estimated = item.data('est'),
            serverTime = item.data('current');
        item.text(startTimer(estimated, serverTime, item));
    });

    $('#radioBTC').change(function() {
        console.log('fired');

        var control = $(this);
        var block = $('#blockBTC');

        block.show();
        $('#blockSelectPayment').hide();
    });


    if (typeof show_wallet_notify !== 'undefined' && show_wallet_notify === true) notie.alert({ type: 1, text: 'Hi and welcome to the Tokenstars! Please take a moment to review your profile and specify the public address of your Ethereum wallet. It is especially important if you plan to bid using direct transfers to the Ethereum Smart Contracts. We need this information to match your bid with your profile.', stay: true });
    if (typeof new_registered !== 'undefined' && new_registered === 1) notie.alert({ type: 1, text: 'Thank you for the request, please check your email for the details.', time: 12 });

    $("[scroll-to]").click(function() {
        var $elem = $($(this).attr('scroll-to'));
        if ($elem.length) {
            $('html, body').animate({
                scrollTop: $elem.offset().top
            }, 400);
        }
    });

    const Token = require('./../artifacts/TokenMock.json')
    const Auction = require('./../artifacts/TokenStarsAuction.json')

    $('.js-metamask-tip').on('click', function() {
        const $button = $(this)
        const ethWallet = $button.data('eth-wallet')
        const tokenAddress = $button.data('token-address')
        var value = $('input', $button.parent()).val()

        if (typeof web3 === 'undefined') {
            return alert('You need to install MetaMask to use this feature.  https://metamask.io')
        }
        if (tokenAddress) {
            if ($button.data('token') === 'TEAM') {
                value = Math.floor(10000 * parseFloat(value))
            }
            const tokenContract = web3.eth.contract(Token.abi).at(tokenAddress)
            const auctionContract = web3.eth.contract(Auction.abi).at(ethWallet)

            const tx1 = tokenContract.approve(ethWallet, value, (result) => {
                console.log(result)
                const tx2 = auctionContract.bid(tokenAddress, value, (bidResult) => {
                    console.log(bidResult)
                })
            })
        } else {

            var user_address = web3.eth.accounts[0];
            web3.eth.sendTransaction({
                to: ethWallet,
                from: user_address,
                value: web3.toWei(value || '1', 'ether'),
            }, function (err, transactionHash) {
                if (err) return console.log('Oh no!: ' + err.message);

                // If you get a transactionHash, you can assume it was sent,
                // or if you want to guarantee it was received, you can poll
                // for that transaction to be mined first.
                alert('Thanks!');
            })
        }
    });



});
