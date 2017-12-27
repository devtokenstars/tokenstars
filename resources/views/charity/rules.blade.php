@extends('layouts.layout-team')

@php
    $lang = app('translator')->getLocale()
@endphp

@section('content')
    <section class="section-holder alt-bg-color module-name-block">
        <div class="wrap">
            <div class="row">
                <div class="col-md-8">
                    <img src="/charity/images/charity/charity-icon.png" alt="" class="module-big-icon">
                    <div class="big-font-size">TokenStars charity event:</div>
                    <h1 class="big-title-size bold-font">Charity Crypto Auction</h1>
                </div>
                <div class="col-md-4 ch-auction-card-header-share">
                    <div class="big-font-size">Spread the word and help our&nbsp;charity:</div>
                    {{--<!-- Your share button code -->
                    <div class="fb-share-button"
                         data-href="https://d3.ru"
                         data-layout="button_count">
                    </div>--}}
                    <iframe src="https://www.facebook.com/plugins/share_button.php?href={{ app('url')->current() }}&layout=button&size=large&mobile_iframe=true&appId" width="120" height="28" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" class="small-margin-before"></iframe>
                    <iframe id="tweet-button" allowtransparency="true" frameborder="0" scrolling="no"
                            src="https://platform.twitter.com/widgets/tweet_button.html?text={{trans('meta.og_title')}}&count=horizontal&size=l"
                            style="width:110px; height:28px;"></iframe>
                </div>
            </div>
        </div>
    </section>
    <section class="big-margin-before">
        <div class="wrap">
            <div class="uppercase align-center big-title-size bold-font big-margin-before">TokenStars Charity Auction Rules</div>
            <ul style="list-style: decimal">
                <li class="huge-margin-before"><b>TokenStars Auctions</b> is a platform developed and deployed by TokenStars Group Limited, a company registered in British Virgin Islands with the company number 1953160 and registered office at Geneva Place, Waterfront Drive, PO Box 3469, Road Town, Tortola, British Virgin Islands (“<b>Company</b>”), for the purposes of conducting auctions (“<b>Auction</b>”) and available on <a href="http://tokenstars.com" target="_blank">http://tokenstars.com/</a> (“<b>Website</b>”).</li>
                <li class="big-margin-before">By any use of the TokenStars Auctions, including but not limited to placing a bid on the Auction lots, you (“<b>User</b>”) agree to these TokenStars Charity Auction Rules (“<b>Rules</b>”).</li>
                <li class="big-margin-before"><a href="http://tokenstars.com/upload/files/terms.pdf" target="_blank">Terms of Use of Website</a> and <a href="http://tokenstars.com/upload/files/privacy.pdf" target="_blank">Privacy Policy</a> are incorporated herein by reference. In the event of a conflict between these Rules and the Terms of Use of Website or the Privacy Policy, the Terms of Use of Website or the Privacy Policy respectively shall control.</li>
                <li class="big-margin-before">The Auction will start (“<b>Start Time</b>”) and end (“<b>Ending Time</b>”) at the time and date specified on the Auction page on the Website.</li>
                <li class="big-margin-before">The Users may place their bids from the Start Time until the Ending Time of the respective Auction.</li>
                <li class="big-margin-before">If any bid is placed during the final twenty (20) minutes before the Ending Time, the Ending Time shall be extended by the additional twenty (20) minutes. As long as Users keep placing bids in the final twenty (20) minutes, the Ending Time will keep being extended. In any case the Auction shall end at the time and date specified on the Auction page on the Website.</li>

                <li class="big-margin-before">The Company has made a web application to facilitate the procedure of participation in (“Web Application”). To participate in the Auction through the Web Application, the User shall:
                    <ul>
                        <li class="medium-margin-before">7.1 undergo a registration procedure and obtain a personal user account available on the Website ("User Account"). The registration procedure, as well as terms and conditions of use of the User Account, are in more detail specified in the Terms of Use of Website;</li>
                        <li class="medium-margin-before">7.2. enter the Web Application using his User Account; and</li>
                        <li class="medium-margin-before">7.3. follow the on-screen instructions.</li>
                    </ul>
                </li>
                <li class="big-margin-before">During the Auction the TokenStars Auctions will offer Auction lots for placing bids.</li>
                <li class="big-margin-before">The initial price of each Auction lot will be available on the Auction page on the Website.</li>
                <li class="big-margin-before">Bids are placed by the direct transfer of the funds:
                    <ul>
                        <li class="medium-margin-before">10.1 to the TokenStars Auctions via the payment method proposed in the Web Application or</li>
                        <li class="medium-margin-before">10.2 directly to the Auction Ethereum smart contract.</li>
                    </ul>
                </li>
                <li class="big-margin-before">The supported bidding currencies/tokens for the Auction lot and any corresponding limitations will be specified on the Auction page on the Website.</li>
                <li class="big-margin-before">All bids are accepted to and stored on the TokenStars Auctions and the Auction Ethereum smart contract in the currency used for fund transfer and, unless specifically stated otherwise, are calculated for the purposes of the Article 10 herein, at the respective exchange rates set on Kraken Bitcoin Exchange (<a href="https://www.kraken.com" target="_blank">https://www.kraken.com/</a>) at 9:00:00 UTC of the respective date. If the bid is placed in tokens created by the smart contracts developed by the Company, the respective exchange rates set on the Website shall apply.</li>

                <li class="big-margin-before">In case of placing a bid via the Web Application, it will guide the User through the bidding procedure, in particular:
                    <ul>
                        <li class="medium-margin-before">13.1. it will ask the User to check the boxes in order to confirm his consent on these Rules and other terms that may be applicable;</li>
                        <li class="medium-margin-before">13.2. it will guide the User through the whole procedure on bidding.</li>
                    </ul>
                </li>
                <li class="big-margin-before">By bidding on any Auction lot, the User agrees to purchase the relevant Auction lot for the amount bided together with all costs and commissions associated (including, but not limited to, any applicable taxes, shipping and insurance costs).</li>
                <li class="big-margin-before">Each time the User is outbid TokenStars Auctions will notify such User via an email. In this case, the User may place additional bid, the same way as described in Article 10 herein, which will be added to the previous bids of such User.</li>
                <li class="big-margin-before">User with the highest aggregate bid at the Ending Time purchases the lot. The highest bidder will be informed via an email.</li>

                <li class="big-margin-before">Auctions rules and transparency are supported by the Ethereum smart contract which stores the Start Time, Ending Time and all the bidding information.</li>
                <li class="big-margin-before">All the funds transferred for bidding by Users other than the highest bidder might be at such User’s discretion either donated to the charity, or requested for refund or conversion to tokens created by the Ethereum smart contracts developed by the Company.</li>
                <li class="big-margin-before">The Company will transfer all the funds transferred by a) the highest bidder and b) the Users requested donation of their bids as per Article 18 herein, reduced by bank, exchange, logistics or any other costs and expenses, incurred by the Company in connection with Auction, to the charity/fund specified on the Auction lot page on the Website via the payment method chosen by that charity/fund. Reasonable evidence of such transfer will be provided.</li>
                <li class="big-margin-before">The Company shall not be obliged to sell the Auction lot unless the initial price specified on the Auction page on the Website is bided. If such initial price is not bided by the Ending Time, the Auction shall be deemed to have failed. In this case the consequences described in Article 18 herein shall be applied.</li>
                <li class="big-margin-before">The Company reserves the right, at its sole discretion, to withdraw any Auction lot prior to the Ending Time, halt any sale during its progress and/or add, edit or remove any materials or content on the Website. The Company may refuse to process a transaction for any reason or refuse service to any User at any time at its sole discretion. Neither Company nor any of its affiliates will be liable to the User, or any third party for any reason in connection with actions performed under this Article.</li>
                <li class="big-margin-before">In the event of User’s failure to complete a purchase for any reason, including the Company’s decision to refuse to process the transaction, the Company shall have the right to sell the Auction lot to another User. In any case, the Company’s determination of a winning bidder will be final.</li>
                <li class="big-margin-before">The Company reserves the right to change, modify, add, or remove portions of these Rules for any reason at any time by posting the amended Rules on the Website. The revised version will be effective at the time the Company posts it unless indicated otherwise.</li>
            </ul>
        </div>
    </section>
    @include('popups.bid')
    @include('popups.login')
    @include('popups.signup')
@endsection


















