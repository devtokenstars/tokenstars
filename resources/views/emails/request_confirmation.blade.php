<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>{{ trans('meta.title') }}</title>
    <!-- <link href="styles.css" rel="stylesheet" type="text/css" /> -->

  <style type="text/css">
		body{
	background-color:#0B112A;
			background-image:url();
			background-repeat:repeat;
			margin-top:0;
			margin-right:0;
			margin-bottom:0;
			margin-left:0;
			padding:0;
		}
		.background-table{
			font-family:"HelveticaNeue-Light","Helvetica Neue Light","Helvetica Neue",Helvetica,Arial,"Lucida Grande",sans-serif;
			font-size:16px;
			-webkit-text-size-adjust:100%;
			-webkit-font-smoothing:antialiased;
			font-weight:300;
			line-height:1.2em;
			color:#2d2d2d;
			background-color:#0B112A;
			background-image:url();
			background-repeat:repeat;
		}
		.content-holder{
			background-color:#ffffff;
			-webkit-border-radius:5px !important;
			-moz-border-radius:5px !important;
			border-radius:5px !important;
			-moz-box-shadow:#dcdcdc 0 2px 0;
			-webkit-box-shadow:#dcdcdc 0 2px 0;
			box-shadow:#dcdcdc 0 2px 0;
		}
		.inside-post-text{
			font-size:16px;
		}
		.intro{
			display:block;
			padding:30px 50px 60px;
			position:relative;
		}
		.intro h1,.intro p{
			color:white;
		}
		.intro a{
			color:#f3be08;
		}
		a{
			text-decoration:none;
			color:#1f65c2;
		}
		h1{
			font-weight:bold;
			font-size:25px;
			line-height:1.2em;
			margin:0;
			padding:30px 0 20px;
			border-bottom:solid 1px #dddddd;
			border-bottom-color:rgba(255,255,255,.4);
		}
		h2{
			font-size:20px;
			font-weight:bold;
			line-height:1.15em;
			margin-top:30px;
			margin-bottom:0;
			padding-top:30px;
			border-top:solid 1px #dddddd;
			position:relative;
		}
		p{
			font-size:16px;
			line-height:1.4em;
			padding-top:1.1em;
			margin-bottom:0;
			margin-top:0;
		}
		p+p{
			padding-top:.9em;
		}
		.quote{
			font-weight:bold;
			margin-top:1em;
			padding:.5em 0 .5em 35px;
			border-left:solid 5px #32d300;
		}
		img{
			max-width:100%;
		}
		.small-font{
			font-size:12px;
			line-height:1.3em;
		}
		.medium-font{
			font-size:14px;
		}
		.sub-light-font-color{
			color:#808080;
		}
		b{
			font-weight:bold;
		}
		.green-color{
			color:#7cc331;
		}
		.white-color{
			color:white;
		}
		ul,ol{
			font-size:18px;
			line-height:1.4em;
			list-style-type:disc;
		}
		li+li{
			margin-top:.8em;
		}
		ol{
			list-style-type:decimal;
		}
		.no-border-header{
			padding-top:0;
			border:none;
		}
		.middle-bg{
			background-color:#fafafa;
		}
		.dark-bg{
			background-color:#eeeeee;
		}
		.green-bg{
			background-color:#7cc331;
		}
		.vertical-margin{
			height:35px;
		}
		.side-margin{
			width:50px;
		}
		.extra-padding{
			padding-top:20px;
			padding-bottom:20px;
		}
		.header{
			padding-top:15px;
			padding-bottom:15px;
		}
		.nav-link{
			font-size:12px;
			margin-left:10px;
		}
		.big-btn{
			color:#fff;
			text-align:center;
			background:#157FFB;
			display:inline-block;
			margin-top:15px;
			padding-top:7px;
			padding-right:30px;
			padding-bottom:7px;
			padding-left:30px;
			-webkit-border-radius:5px;
			-moz-border-radius:5px;
			border-radius:5px;
			-moz-box-shadow:#144380 0 2px 0;
			-webkit-box-shadow:#144380 0 2px 0;
			box-shadow:#1160BD 0 2px 0;
		}
	@media screen and (max-width: 700px){
		td[class=side-margin]{
			width:15px !important;
		}

}	@media screen and (max-width: 700px){
		table[class=content-holder]{
			width:100% !important;
		}

}	@media screen and (max-width: 700px){
		td[class=course-info]{
			padding-left:10px !important;
		}

}	@media screen and (max-width: 700px){
		table[class=background-table]{
			line-height:1em !important;
		}

}	@media screen and (max-width: 700px){
		.small-font{
			font-size:11px !important;
		}

}	@media screen and (max-width: 700px){
		.medium-font{
			font-size:13px !important;
		}

}	@media screen and (max-width: 700px){
		.blog-post-link{
			font-size:12px !important;
		}

}	@media screen and (max-width: 700px){
		.vertical-margin{
			height:10px !important;
		}

}	@media screen and (max-width: 700px){
		.nav-link{
			display:block !important;
		}

}	@media screen and (max-width: 700px){
		.intro{
			padding:30px 10px 60px !important;
		}

}</style></head>
  <body>
    <center>
      <table border="0" cellpadding="0" cellspacing="0" width="100%" class="background-table">
        <!-- Vertical margin -->
        <tr>
          <td class="vertical-margin"></td>
        </tr>
        <!-- Main content holder -->
        <tr>
          <td align="center" valign="top">
            <table border="0" cellpadding="0" cellspacing="0" width="500" class="content-holder">
              <!-- Email header -->
              <tr>
                <td class="side-margin"></td>
                <td class="header">
                  <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                      <td width="150">
                      </td>
                      <td align="right"></td>
                    </tr>
                  </table>
                </td>
                <td class="side-margin"></td>
              </tr>
              <tr>
                <td colspan="3">
                </td>
              </tr>
              <!-- Message -->
              <tr>
                <td class="side-margin"></td>
                <td>
                  <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                      <td>
                        <h2 class="no-border-header">Hi and thanks for joining the Tokenstars platform.</h2>
                        <p class="medium-font">To confirm the registration, please click the link below:</p>
                      </td>
                    </tr>
                    <tr align="center">
                      <td>
                        <a href="{{ $url  }}" class="big-btn">Confirm your registration</a>
                      </td>
                    </tr>
                  </table>
                </td>
                <td class="side-margin"></td>
              </tr>
              <tr>
                <td class="side-margin"></td>
                <td>
                </td>
                <td class="side-margin"></td>
              </tr>
              <tr>
                <td class="side-margin"></td>
                <td>
                  <table border="0" cellpadding="0" cellspacing="0" width="100%">

                  </table>
                </td>
                <td class="side-margin"></td>
              </tr>
              <tr>
                <td class="side-margin"></td>
                <td>

                </td>
                <td class="side-margin"></td>
              </tr>
              <!-- Signature -->
              <tr>
                <td class="side-margin"></td>
                <td class="extra-padding">

                </td>

              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td align="center" class="small-font white-color">
            <br>If you have any questions, just hit us in our Telegram chat at <a href="https://t.me/TokenStars_en">https://t.me/TokenStars_en</a> our team is there to help.

          </td>
        </tr>
        <!-- Vertical margin -->
        <tr>
            <td class="vertical-margin"></td>
        </tr>
      </table>
    </center>
  </body>
</html>
