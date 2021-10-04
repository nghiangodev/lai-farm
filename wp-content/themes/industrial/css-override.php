<?php
if ( class_exists( 'BoldThemesFramework' ) && isset( BoldThemesFramework::$crush_vars ) ) {
	$boldthemes_crush_vars = BoldThemesFramework::$crush_vars;
}
if ( class_exists( 'BoldThemesFramework' ) && isset( BoldThemesFramework::$crush_vars_def ) ) {
	$boldthemes_crush_vars_def = BoldThemesFramework::$crush_vars_def;
}
if ( isset( $boldthemes_crush_vars['headingFont'] ) ) {
	$headingFont = $boldthemes_crush_vars['headingFont'];
} else {
	$headingFont = "Montserrat";
}
if ( isset( $boldthemes_crush_vars['headingSuperTitleFont'] ) ) {
	$headingSuperTitleFont = $boldthemes_crush_vars['headingSuperTitleFont'];
} else {
	$headingSuperTitleFont = "Montserrat";
}
if ( isset( $boldthemes_crush_vars['headingSubTitleFont'] ) ) {
	$headingSubTitleFont = $boldthemes_crush_vars['headingSubTitleFont'];
} else {
	$headingSubTitleFont = "Roboto";
}
if ( isset( $boldthemes_crush_vars['menuFont'] ) ) {
	$menuFont = $boldthemes_crush_vars['menuFont'];
} else {
	$menuFont = "Montserrat";
}
if ( isset( $boldthemes_crush_vars['bodyFont'] ) ) {
	$bodyFont = $boldthemes_crush_vars['bodyFont'];
} else {
	$bodyFont = "Roboto";
}
if ( isset( $boldthemes_crush_vars['accentColor'] ) ) {
	$accentColor = $boldthemes_crush_vars['accentColor'];
} else {
	$accentColor = "#FBBD02";
}
$accentColorDark = CssCrush\fn__l_adjust( $accentColor." -15" );$accentColorVeryDark = CssCrush\fn__l_adjust( $accentColor." -35" );$accentColorVeryVeryDark = CssCrush\fn__l_adjust( $accentColor." -42" );$accentColorLight = CssCrush\fn__a_adjust( $accentColor." -30" );if ( isset( $boldthemes_crush_vars['alternateColor'] ) ) {
	$alternateColor = $boldthemes_crush_vars['alternateColor'];
} else {
	$alternateColor = "#FF7F00";
}
$alternateColorDark = CssCrush\fn__l_adjust( $alternateColor." -15" );$alternateColorVeryDark = CssCrush\fn__l_adjust( $alternateColor." -25" );$alternateColorLight = CssCrush\fn__a_adjust( $alternateColor." -40" );if ( isset( $boldthemes_crush_vars['logoHeight'] ) ) {
	$logoHeight = $boldthemes_crush_vars['logoHeight'];
} else {
	$logoHeight = "100";
}
$css_override = sanitize_text_field("select,
input{font-family: {$bodyFont};}
input:not([type='checkbox']):not([type='radio']),
textarea,
select{
    font-family: \"{$headingFont}\";}
input:not([type='checkbox']):not([type='radio']):not([type='submit']):focus,
textarea:focus{-webkit-box-shadow: 0 0 4px 0 {$accentColor};
    box-shadow: 0 0 4px 0 {$accentColor};}
html a:hover,
.btLightSkin a:hover,
.btDarkSkin .btLightSkin a:hover,
.btLightSkin .btDarkSkin .btLightSkin a:hover,
.btDarkSkin a:hover,
.btLightSkin .btDarkSkin a:hover,
.btDarkSkin.btLightSkin .btDarkSkin a:hover{
    color: {$accentColor};}
.btLightSkin .btText a,
.btDarkSkin .btLightSkin .btText a,
.btLightSkin .btDarkSkin .btLightSkin .btText a,
.btDarkSkin .btText a,
.btLightSkin .btDarkSkin .btText a,
.btDarkSkin.btLightSkin .btDarkSkin .btText a{color: {$accentColor};}
body{font-family: \"{$bodyFont}\",Arial,sans-serif;}
.btContentHolder cite{
    font-family: \"{$headingFont}\";}
h1,
h2,
h3,
h4,
h5,
h6{font-family: \"{$headingFont}\";}
.btContentHolder table thead th{
    background-color: {$accentColor};
    font-family: \"{$headingFont}\";}
.btAccentColorBackground{background-color: {$accentColor} !important;}
.btAccentColorBackground .headline b.animate.animated{color: {$alternateColor};}
.btAccentColorBackground .btDash.bottomDash .dash:after{border-color: {$alternateColor};}
.btAccentDarkColorBackground{background-color: {$accentColorDark} !important;}
.btAccentDarkColorBackground .headline b.animate.animated{color: {$alternateColor};}
.btAccentVeryDarkColorBackground{background-color: {$accentColorVeryDark} !important;}
.btAccentLightColorBackground{background-color: {$accentColorLight} !important;}
.btAlternateColorBackground{background-color: {$alternateColor} !important;}
.btAlternateDarkColorBackground{background-color: {$alternateColorDark} !important;}
.btAlternateVeryDarkColorBackground{background-color: {$alternateColorVeryDark} !important;}
.btAlternateLightColorBackground{background-color: {$alternateColorLight} !important;}
.btAccentDarkHeader .btPreloader .animation > div:first-child,
.btLightAccentHeader .btPreloader .animation > div:first-child{
    background-color: {$accentColorDark};}
.btPreloader .animation .preloaderLogo{height: {$logoHeight}px;}
.mainHeader{
    font-family: \"{$menuFont}\";}
.btMenuVertical.btAccentDarkHeader .mainHeader,
.btMenuVertical.btLightAccentHeader .mainHeader{background-color: {$accentColor};}
.btMenuVertical.btLightAlternateHeader .mainHeader{background-color: {$alternateColor};}
.menuPort{font-family: \"{$menuFont}\";}
.menuPort nav ul li a:hover{color: {$accentColor} !important;}
.menuPort nav > ul > li > a{line-height: {$logoHeight}px;}
.btTextLogo{
    line-height: {$logoHeight}px;}
.btLogoArea .logo img{height: {$logoHeight}px;}
.btHorizontalMenuTrigger{
    line-height: {$logoHeight}px;}
.btMenuHorizontal .menuPort nav > ul > li.current-menu-ancestor > a:after,
.btMenuHorizontal .menuPort nav > ul > li.current-menu-item > a:after{
    background-color: {$accentColor};}
.btAccentDarkHeader.btMenuHorizontal .menuPort nav > ul > li.current-menu-ancestor > a:after,
.btAccentDarkHeader.btMenuHorizontal .menuPort nav > ul > li.current-menu-item > a:after,
.btAccentLightHeader.btMenuHorizontal .menuPort nav > ul > li.current-menu-ancestor > a:after,
.btAccentLightHeader.btMenuHorizontal .menuPort nav > ul > li.current-menu-item > a:after{background-color: {$alternateColor};}
.btMenuHorizontal .menuPort nav > ul > li > ul li.current-menu-ancestor > a,
.btMenuHorizontal .menuPort nav > ul > li > ul li.current-menu-item > a{color: {$accentColor} !important;}
body.btMenuHorizontal .subToggler{
    line-height: {$logoHeight}px;}
.btMenuHorizontal .topBarInMenu{
    height: {$logoHeight}px;}
.btLightSkin.btAccentLightHeader.btMenuHorizontal .btBelowLogoArea .menuPort > nav > ul > li > a:hover,
.btDarkSkin.btAccentLightHeader.btMenuHorizontal .btBelowLogoArea .menuPort > nav > ul > li > a:hover,
.btLightSkin.btAccentLightHeader.btMenuHorizontal .topBar .menuPort > nav > ul > li > a:hover,
.btDarkSkin.btAccentLightHeader.btMenuHorizontal .topBar .menuPort > nav > ul > li > a:hover{color: {$alternateColor} !important;}
.btAccentLightHeader.btMenuHorizontal:not(.btBelowMenu) .btBelowLogoArea,
.btAccentLightHeader.btMenuHorizontal:not(.btBelowMenu) .topBar,
.btAccentLightHeader.btMenuHorizontal.btStickyHeaderActive .btBelowLogoArea,
.btAccentLightHeader.btMenuHorizontal.btStickyHeaderActive .topBar{background-color: {$accentColor};}
.btAccentLightHeader.btMenuHorizontal:not(.btBelowMenu) .btBelowLogoArea:before,
.btAccentLightHeader.btMenuHorizontal:not(.btBelowMenu) .topBar:before,
.btAccentLightHeader.btMenuHorizontal.btStickyHeaderActive .btBelowLogoArea:before,
.btAccentLightHeader.btMenuHorizontal.btStickyHeaderActive .topBar:before{
    background-color: {$accentColor};}
.btAccentLightHeader.btMenuHorizontal.btBelowMenu:not(.btStickyHeaderActive) .mainHeader .btBelowLogoArea,
.btAccentLightHeader.btMenuHorizontal.btBelowMenu:not(.btStickyHeaderActive) .mainHeader .topBar{background-color: {$accentColor};}
.btLightSkin.btLightHeader.btMenuHorizontal .btBelowLogoArea .menuPort > nav > ul > li > a:hover,
.btDarkSkin.btLightHeader.btMenuHorizontal .btBelowLogoArea .menuPort > nav > ul > li > a:hover,
.btLightSkin.btLightHeader.btMenuHorizontal .topBar .menuPort > nav > ul > li > a:hover,
.btDarkSkin.btLightHeader.btMenuHorizontal .topBar .menuPort > nav > ul > li > a:hover{color: {$alternateColor} !important;}
.btLightSkin.btAccentDarkHeader.btMenuHorizontal .mainHeader .menuPort > nav > ul > li > a:hover,
.btDarkSkin.btAccentDarkHeader.btMenuHorizontal .mainHeader .menuPort > nav > ul > li > a:hover{color: {$alternateColor} !important;}
.btAccentDarkHeader.btMenuHorizontal:not(.btBelowMenu) .mainHeader,
.btAccentDarkHeader.btMenuHorizontal.btStickyHeaderActive .mainHeader{background-color: {$accentColor};}
.btAccentDarkHeader.btMenuHorizontal.btBelowMenu:not(.btStickyHeaderActive) .mainHeader .port .btLogoArea{background-color: {$accentColor};}
.btLightSkin.btLightAccentHeader.btMenuHorizontal .mainHeader .btLogoArea .menuPort > nav > ul > li > a:hover,
.btDarkSkin.btLightAccentHeader.btMenuHorizontal .mainHeader .btLogoArea .menuPort > nav > ul > li > a:hover{color: {$alternateColor} !important;}
.btLightAccentHeader.btMenuHorizontal:not(.btBelowMenu) .mainHeader,
.btLightAccentHeader.btMenuHorizontal.btStickyHeaderActive .mainHeader{background-color: {$accentColor};}
.btLightAccentHeader.btMenuHorizontal.btBelowMenu:not(.btStickyHeaderActive) .mainHeader .port .btLogoArea{background-color: {$accentColor};}
.btLightSkin.btLightAlternateHeader.btMenuHorizontal .mainHeader .btLogoArea .menuPort > nav > ul > li > a:hover,
.btDarkSkin.btLightAlternateHeader.btMenuHorizontal .mainHeader .btLogoArea .menuPort > nav > ul > li > a:hover{color: {$accentColor} !important;}
.btLightAlternateHeader.btMenuHorizontal:not(.btBelowMenu) .mainHeader,
.btLightAlternateHeader.btMenuHorizontal.btStickyHeaderActive .mainHeader{background-color: {$alternateColor};}
.btLightAlternateHeader.btMenuHorizontal.btBelowMenu:not(.btStickyHeaderActive) .mainHeader .port .btLogoArea{background-color: {$alternateColor};}
.btAccentDarkHeader.btMenuVertical > .menuPort .logo,
.btLightAccentHeader.btMenuVertical > .menuPort .logo{background-color: {$accentColor};}
.btLightAlternateHeader.btMenuVertical > .menuPort .logo{background-color: {$alternateColor};}
.btMenuVertical > .menuPort .btCloseVertical:before:hover{color: {$accentColor};}
@media (min-width: 1200px){.btMenuVerticalOn .btVerticalMenuTrigger .btIco a:before{color: {$accentColor} !important;}
}.btMenuHorizontal .topBarInLogoArea{
    height: {$logoHeight}px;}
.btMenuHorizontal .topBarInLogoArea .topBarInLogoAreaCell{border: 0 solid {$accentColor};}
.btSearchInner.btFromTopBox{
    background: {$accentColor};}
.btSearchInner.btFromTopBox form button:hover:before{color: {$accentColor};}
.btDarkSkin .btSiteFooter .port:before,
.btLightSkin .btDarkSkin .btSiteFooter .port:before,
.btDarkSkin.btLightSkin .btDarkSkin .btSiteFooter .port:before{background-color: {$accentColor};}
.btMediaBox.btQuote,
.btMediaBox.btLink{
    background-color: {$accentColor};}
.btArticleListItem .headline a:hover{color: {$accentColor};}
.btCommentsBox .vcard .posted{
    font-family: \"{$headingFont}\";}
.btCommentsBox .commentTxt p.edit-link,
.btCommentsBox .commentTxt p.reply{
    font-family: \"{$headingFont}\";}
.comment-respond .btnOutline button[type=\"submit\"]{font-family: \"{$headingFont}\";}
a#cancel-comment-reply-link:hover{color: {$accentColor};}
.post-password-form input[type=\"submit\"]{
    background: {$accentColor};
    font-family: \"{$headingFont}\";}
.btPagination{font-family: \"{$headingFont}\";}
.btPagination .paging a:hover:after{border-color: {$accentColor};}
span.btHighlight{
    background-color: {$accentColor};}
.btArticleCategories a:not(:first-child):before{
    background-color: {$accentColor};}
.btArticleMeta{font-family: \"{$headingFont}\";}
body:not(.btNoDashInSidebar) .btBox > h4:after,
body:not(.btNoDashInSidebar) .btCustomMenu > h4:after,
body:not(.btNoDashInSidebar) .btTopBox > h4:after{
    border-bottom: 3px solid {$accentColor};}
.btBox ul li.current-menu-item > a,
.btCustomMenu ul li.current-menu-item > a,
.btTopBox ul li.current-menu-item > a{color: {$accentColor};}
.btBox .ppTxt .header .headline a a:hover,
.btCustomMenu .ppTxt .header .headline a a:hover,
.btTopBox .ppTxt .header .headline a a:hover{color: {$accentColor};}
.btBox p.posted,
.btBox .quantity,
.btCustomMenu p.posted,
.btCustomMenu .quantity,
.btTopBox p.posted,
.btTopBox .quantity{
    font-family: {$headingFont};}
.widget_calendar table caption{background: {$accentColor};
    font-family: \"{$headingFont}\";}
.widget_rss li a.rsswidget{font-family: \"{$headingFont}\";}
.fancy-select .trigger.open{color: {$accentColor};}
.fancy-select ul.options li:hover{color: {$accentColor};}
.widget_shopping_cart .total{
    font-family: {$headingFont};}
.widget_shopping_cart .widget_shopping_cart_content .mini_cart_item .ppRemove a.remove{
    background-color: {$accentColor};}
.widget_shopping_cart .widget_shopping_cart_content .mini_cart_item .ppRemove a.remove:hover{background-color: {$alternateColor};}
.menuPort .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetIcon span.cart-contents,
.topTools .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetIcon span.cart-contents,
.topBarInLogoArea .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetIcon span.cart-contents{
    background-color: {$alternateColor};
    font: normal 10px/1 {$menuFont};}
.btMenuVertical .menuPort .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetInnerContent .verticalMenuCartToggler,
.btMenuVertical .topTools .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetInnerContent .verticalMenuCartToggler,
.btMenuVertical .topBarInLogoArea .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetInnerContent .verticalMenuCartToggler{
    background-color: {$accentColor};}
.widget_recent_reviews{font-family: {$headingFont};}
.widget_price_filter .price_slider_wrapper .ui-slider .ui-slider-handle{
    background-color: {$accentColor};}
.btBox .tagcloud a,
.btTags ul a{
    background: {$accentColor};
    font-family: \"{$headingFont}\";}
.btSidebar .btIconWidget:hover .btIconWidgetText,
footer .btIconWidget:hover .btIconWidgetText{color: {$accentColor};}
.btTopBox.widget_bt_text_image .widget_sp_image-description{
    font-family: '{$bodyFont}',arial,sans-serif;}
.btMenuHorizontal .topTools .btIconWidget:hover,
.btMenuHorizontal .topBarInMenu .btIconWidget:hover{color: {$accentColor};}
.btMenuHorizontal .topTools .btAccentIconWidget,
.btMenuHorizontal .topBarInMenu .btAccentIconWidget{background-color: {$accentColor};}
.btTopToolsInMenuArea.btMenuHorizontal .topTools .btAccentIconWidget,
.btTopToolsInMenuArea.btMenuHorizontal .topBarInMenu .btAccentIconWidget{background-color: {$alternateColor};}
.btTopToolsInMenuArea.btMenuHorizontal .topTools .btAccentIconWidget:hover,
.btTopToolsInMenuArea.btMenuHorizontal .topBarInMenu .btAccentIconWidget:hover{color: {$accentColor};}
.btAccentLightHeader.btMenuHorizontal .topTools .btAccentIconWidget,
.btLightAccentHeader.btMenuHorizontal .topTools .btAccentIconWidget,
.btAccentLightHeader.btMenuHorizontal .topBarInMenu .btAccentIconWidget,
.btLightAccentHeader.btMenuHorizontal .topBarInMenu .btAccentIconWidget{background-color: {$alternateColor};}
.btMenuHorizontal .topTools .btAccentIconWidget:hover,
.btMenuHorizontal .topBarInMenu .btAccentIconWidget:hover{color: {$alternateColor};}
.btTopToolsInMenuArea.btLightAccentHeader.btMenuHorizontal .topTools .btAccentIconWidget:hover,
.btTopToolsInMenuArea.btLightAccentHeader.btMenuHorizontal .topBarInMenu .btAccentIconWidget:hover{background-color: {$accentColor};}
.btLightSkin.btAccentLightHeader.btMenuHorizontal .btBelowLogoArea .btIco.btIcoDefaultType.btIcoDefaultColor .btIcoHolder:hover:before,
.btDarkSkin.btAccentLightHeader.btMenuHorizontal .btBelowLogoArea .btIco.btIcoDefaultType.btIcoDefaultColor .btIcoHolder:hover:before,
.btLightSkin.btAccentLightHeader.btMenuHorizontal .topBar .btIco.btIcoDefaultType.btIcoDefaultColor .btIcoHolder:hover:before,
.btDarkSkin.btAccentLightHeader.btMenuHorizontal .topBar .btIco.btIcoDefaultType.btIcoDefaultColor .btIcoHolder:hover:before{color: {$alternateColor};}
.btLightSkin.btLightHeader.btMenuHorizontal .btBelowLogoArea .btIco.btIcoDefaultType.btIcoAccentColor .btIcoHolder:hover:before,
.btDarkSkin.btLightHeader.btMenuHorizontal .btBelowLogoArea .btIco.btIcoDefaultType.btIcoAccentColor .btIcoHolder:hover:before,
.btLightSkin.btLightHeader.btMenuHorizontal .topBar .btIco.btIcoDefaultType.btIcoAccentColor .btIcoHolder:hover:before,
.btDarkSkin.btLightHeader.btMenuHorizontal .topBar .btIco.btIcoDefaultType.btIcoAccentColor .btIcoHolder:hover:before{color: {$alternateColor};}
.btLightSkin.btLightHeader.btMenuHorizontal .btBelowLogoArea .btIco.btIcoDefaultType.btIcoDefaultColor .btIcoHolder:hover:before,
.btDarkSkin.btLightHeader.btMenuHorizontal .btBelowLogoArea .btIco.btIcoDefaultType.btIcoDefaultColor .btIcoHolder:hover:before,
.btLightSkin.btLightHeader.btMenuHorizontal .topBar .btIco.btIcoDefaultType.btIcoDefaultColor .btIcoHolder:hover:before,
.btDarkSkin.btLightHeader.btMenuHorizontal .topBar .btIco.btIcoDefaultType.btIcoDefaultColor .btIcoHolder:hover:before{color: {$alternateColor};}
.btLightSkin.btAccentDarkHeader.btMenuHorizontal .mainHeader .btIco.btIcoDefaultType.btIcoAccentColor .btIcoHolder:before,
.btDarkSkin.btAccentDarkHeader.btMenuHorizontal .mainHeader .btIco.btIcoDefaultType.btIcoAccentColor .btIcoHolder:before{color: {$alternateColor};}
.btLightSkin.btAccentDarkHeader.btMenuHorizontal .mainHeader .btIco.btIcoDefaultType .btIcoHolder:hover:before,
.btDarkSkin.btAccentDarkHeader.btMenuHorizontal .mainHeader .btIco.btIcoDefaultType .btIcoHolder:hover:before{color: {$alternateColor};}
.btLightSkin.btLightAccentHeader.btMenuHorizontal .mainHeader .btLogoArea .btIco.btIcoDefaultType.btIcoAccentColor .btIcoHolder:before,
.btDarkSkin.btLightAccentHeader.btMenuHorizontal .mainHeader .btLogoArea .btIco.btIcoDefaultType.btIcoAccentColor .btIcoHolder:before{color: {$alternateColor};}
.btLightSkin.btLightAccentHeader.btMenuHorizontal .mainHeader .btLogoArea .btIco.btIcoDefaultType .btIcoHolder:hover:before,
.btDarkSkin.btLightAccentHeader.btMenuHorizontal .mainHeader .btLogoArea .btIco.btIcoDefaultType .btIcoHolder:hover:before{color: {$alternateColor};}
.btLightSkin.btLightAlternateHeader.btMenuHorizontal .mainHeader .btLogoArea .btIco.btIcoDefaultType.btIcoAccentColor .btIcoHolder:before,
.btDarkSkin.btLightAlternateHeader.btMenuHorizontal .mainHeader .btLogoArea .btIco.btIcoDefaultType.btIcoAccentColor .btIcoHolder:before{color: {$accentColor};}
.btLightSkin.btLightAlternateHeader.btMenuHorizontal .mainHeader .btLogoArea .btIco.btIcoDefaultType .btIcoHolder:hover:before,
.btDarkSkin.btLightAlternateHeader.btMenuHorizontal .mainHeader .btLogoArea .btIco.btIcoDefaultType .btIcoHolder:hover:before{color: {$accentColor};}
.btSpecialHeaderIcon .btIco .btIcoHolder:before,
.btSpecialHeaderIcon .btIconWidgetTitle,
.btSpecialHeaderIcon .btIconWidgetText{color: {$accentColor} !important;}
.btLightSkin .btBox .btSearch button:hover,
.btDarkSkin .btLightSkin .btBox .btSearch button:hover,
.btLightSkin .btDarkSkin .btLightSkin .btBox .btSearch button:hover,
.btDarkSkin .btBox .btSearch button:hover,
.btLightSkin .btDarkSkin .btBox .btSearch button:hover,
.btDarkSkin.btLightSkin .btDarkSkin .btBox .btSearch button:hover,
.btLightSkin form.woocommerce-product-search button:hover,
.btDarkSkin .btLightSkin form.woocommerce-product-search button:hover,
.btLightSkin .btDarkSkin .btLightSkin form.woocommerce-product-search button:hover,
.btDarkSkin form.woocommerce-product-search button:hover,
.btLightSkin .btDarkSkin form.woocommerce-product-search button:hover,
.btDarkSkin.btLightSkin .btDarkSkin form.woocommerce-product-search button:hover{background: {$accentColor} !important;
    border-color: {$accentColor} !important;}
.topTools .widget_search button,
.topBarInMenu .widget_search button{
    background: {$accentColor};}
.topTools .widget_search button:before,
.topBarInMenu .widget_search button:before{
    color: {$accentColor};}
.topTools .widget_search button:hover,
.topBarInMenu .widget_search button:hover{background: {$accentColorDark};}
.btIcoFilledType.btIcoAccentColor.btIconHexagonShape.btIco .btIcoHolder .hex{fill: {$accentColor};}
.btIcoFilledType.btIcoAlternateColor.btIconHexagonShape.btIco .btIcoHolder .hex{fill: {$alternateColor};}
.btIcoOutlineType.btIcoAccentColor.btIconHexagonShape.btIco .btIcoHolder .hex{
    stroke: {$accentColor};}
.btIcoOutlineType.btIcoAlternateColor.btIconHexagonShape.btIco .btIcoHolder .hex{
    stroke: {$alternateColor};}
.btLightSkin .btIconHexagonShape.btIcoOutlineType.btIcoAccentColor.btIco:hover .btIcoHolder .hex,
.btDarkSkin .btLightSkin .btIconHexagonShape.btIcoOutlineType.btIcoAccentColor.btIco:hover .btIcoHolder .hex,
.btLightSkin .btDarkSkin .btLightSkin .btIconHexagonShape.btIcoOutlineType.btIcoAccentColor.btIco:hover .btIcoHolder .hex,
.btDarkSkin .btIconHexagonShape.btIcoOutlineType.btIcoAccentColor.btIco:hover .btIcoHolder .hex,
.btLightSkin .btDarkSkin .btIconHexagonShape.btIcoOutlineType.btIcoAccentColor.btIco:hover .btIcoHolder .hex,
.btDarkSkin.btLightSkin .btDarkSkin .btIconHexagonShape.btIcoOutlineType.btIcoAccentColor.btIco:hover .btIcoHolder .hex{fill: {$accentColor};
    stroke: {$accentColor};}
.btLightSkin .btIconHexagonShape.btIcoOutlineType.btIcoAlternateColor.btIco:hover .btIcoHolder .hex,
.btDarkSkin .btLightSkin .btIconHexagonShape.btIcoOutlineType.btIcoAlternateColor.btIco:hover .btIcoHolder .hex,
.btLightSkin .btDarkSkin .btLightSkin .btIconHexagonShape.btIcoOutlineType.btIcoAlternateColor.btIco:hover .btIcoHolder .hex,
.btDarkSkin .btIconHexagonShape.btIcoOutlineType.btIcoAlternateColor.btIco:hover .btIcoHolder .hex,
.btLightSkin .btDarkSkin .btIconHexagonShape.btIcoOutlineType.btIcoAlternateColor.btIco:hover .btIcoHolder .hex,
.btDarkSkin.btLightSkin .btDarkSkin .btIconHexagonShape.btIcoOutlineType.btIcoAlternateColor.btIco:hover .btIcoHolder .hex{fill: {$alternateColor};
    stroke: {$alternateColor};}
.btLightSkin .btIconHexagonShape.btIcoFilledType.btIcoAlternateColor.btIco:hover .btIcoHolder .hex,
.btDarkSkin .btLightSkin .btIconHexagonShape.btIcoFilledType.btIcoAlternateColor.btIco:hover .btIcoHolder .hex,
.btLightSkin .btDarkSkin .btLightSkin .btIconHexagonShape.btIcoFilledType.btIcoAlternateColor.btIco:hover .btIcoHolder .hex,
.btDarkSkin .btIconHexagonShape.btIcoFilledType.btIcoAlternateColor.btIco:hover .btIcoHolder .hex,
.btLightSkin .btDarkSkin .btIconHexagonShape.btIcoFilledType.btIcoAlternateColor.btIco:hover .btIcoHolder .hex,
.btDarkSkin.btLightSkin .btDarkSkin .btIconHexagonShape.btIcoFilledType.btIcoAlternateColor.btIco:hover .btIcoHolder .hex{
    stroke: {$alternateColor};}
.btLightSkin .btIconHexagonShape.btIcoFilledType.btIcoAccentColor.btIco:hover .btIcoHolder .hex,
.btDarkSkin .btLightSkin .btIconHexagonShape.btIcoFilledType.btIcoAccentColor.btIco:hover .btIcoHolder .hex,
.btLightSkin .btDarkSkin .btLightSkin .btIconHexagonShape.btIcoFilledType.btIcoAccentColor.btIco:hover .btIcoHolder .hex,
.btDarkSkin .btIconHexagonShape.btIcoFilledType.btIcoAccentColor.btIco:hover .btIcoHolder .hex,
.btLightSkin .btDarkSkin .btIconHexagonShape.btIcoFilledType.btIcoAccentColor.btIco:hover .btIcoHolder .hex,
.btDarkSkin.btLightSkin .btDarkSkin .btIconHexagonShape.btIcoFilledType.btIcoAccentColor.btIco:hover .btIcoHolder .hex{
    stroke: {$accentColor};}
.btIconHexagonShape .btIco.btIcoFilledType .btIcoHolder svg .hex{
    fill: {$accentColor};}
.btIconHexagonShape .btIco.btIcoFilledType:hover .btIcoHolder svg .hex{stroke: {$accentColor};}
.btIconHexagonShape .btIco.btIcoOutlineType .btIcoHolder svg .hex{stroke: {$accentColor};}
.btIconHexagonShape .btIco.btIcoOutlineType:hover .btIcoHolder svg .hex{stroke: {$accentColor};
    fill: {$accentColor};}
.btIco.btIcoFilledType.btIcoAccentColor .btIcoHolder:before,
.btIco.btIcoOutlineType.btIcoAccentColor:hover .btIcoHolder:before{-webkit-box-shadow: 0 0 0 1em {$accentColor} inset;
    box-shadow: 0 0 0 1em {$accentColor} inset;}
.btIco.btIcoFilledType.btIcoAccentColor:hover .btIcoHolder:before,
.btIco.btIcoOutlineType.btIcoAccentColor .btIcoHolder:before{-webkit-box-shadow: 0 0 0 1px {$accentColor} inset;
    box-shadow: 0 0 0 1px {$accentColor} inset;
    color: {$accentColor};}
.btIco.btIcoFilledType.btIcoAlternateColor .btIcoHolder:before,
.btIco.btIcoOutlineType.btIcoAlternateColor:hover .btIcoHolder:before{-webkit-box-shadow: 0 0 0 1em {$alternateColor} inset;
    box-shadow: 0 0 0 1em {$alternateColor} inset;}
.btIco.btIcoFilledType.btIcoAlternateColor:hover .btIcoHolder:before,
.btIco.btIcoOutlineType.btIcoAlternateColor .btIcoHolder:before{-webkit-box-shadow: 0 0 0 1px {$alternateColor} inset;
    box-shadow: 0 0 0 1px {$alternateColor} inset;
    color: {$alternateColor};}
.btLightSkin .btIco.btIcoDefaultType.btIcoAccentColor .btIcoHolder:before,
.btLightSkin .btIco.btIcoDefaultType.btIcoDefaultColor:hover .btIcoHolder:before,
.btDarkSkin .btLightSkin .btIco.btIcoDefaultType.btIcoAccentColor .btIcoHolder:before,
.btDarkSkin .btLightSkin .btIco.btIcoDefaultType.btIcoDefaultColor:hover .btIcoHolder:before,
.btLightSkin .btDarkSkin .btLightSkin .btIco.btIcoDefaultType.btIcoAccentColor .btIcoHolder:before,
.btLightSkin .btDarkSkin .btLightSkin .btIco.btIcoDefaultType.btIcoDefaultColor:hover .btIcoHolder:before,
.btDarkSkin .btIco.btIcoDefaultType.btIcoAccentColor .btIcoHolder:before,
.btDarkSkin .btIco.btIcoDefaultType.btIcoDefaultColor:hover .btIcoHolder:before,
.btLightSkin .btDarkSkin .btIco.btIcoDefaultType.btIcoAccentColor .btIcoHolder:before,
.btLightSkin .btDarkSkin .btIco.btIcoDefaultType.btIcoDefaultColor:hover .btIcoHolder:before,
.btDarkSkin.btLightSkin .btDarkSkin .btIco.btIcoDefaultType.btIcoAccentColor .btIcoHolder:before,
.btDarkSkin.btLightSkin .btDarkSkin .btIco.btIcoDefaultType.btIcoDefaultColor:hover .btIcoHolder:before{color: {$accentColor};}
.btLightSkin .btIco.btIcoDefaultType.btIcoAlternateColor .btIcoHolder:before,
.btDarkSkin .btLightSkin .btIco.btIcoDefaultType.btIcoAlternateColor .btIcoHolder:before,
.btLightSkin .btDarkSkin .btLightSkin .btIco.btIcoDefaultType.btIcoAlternateColor .btIcoHolder:before,
.btDarkSkin .btIco.btIcoDefaultType.btIcoAlternateColor .btIcoHolder:before,
.btLightSkin .btDarkSkin .btIco.btIcoDefaultType.btIcoAlternateColor .btIcoHolder:before,
.btDarkSkin.btLightSkin .btDarkSkin .btIco.btIcoDefaultType.btIcoAlternateColor .btIcoHolder:before{color: {$alternateColor};}
.btIcoAccentColor span{color: {$accentColor};}
.btIcoAlternateColor span{color: {$alternateColor};}
.btIcoDefaultColor:hover span{color: {$accentColor};}
.btBtn{
    font-family: \"{$headingFont}\";}
.btnFilledStyle.btnAccentColor,
.btnOutlineStyle.btnAccentColor:hover{background-color: {$accentColor};
    border: 2px solid {$accentColor};}
.btnOutlineStyle.btnAccentColor,
.btnFilledStyle.btnAccentColor:hover{
    border: 2px solid {$accentColor};
    color: {$accentColor};}
.btnOutlineStyle.btnAccentColor span,
.btnFilledStyle.btnAccentColor:hover span,
.btnOutlineStyle.btnAccentColor span:before,
.btnFilledStyle.btnAccentColor:hover span:before,
.btnOutlineStyle.btnAccentColor a,
.btnFilledStyle.btnAccentColor:hover a,
.btnOutlineStyle.btnAccentColor .btIco a:before,
.btnFilledStyle.btnAccentColor:hover .btIco a:before,
.btnOutlineStyle.btnAccentColor button,
.btnFilledStyle.btnAccentColor:hover button{color: {$accentColor} !important;}
.btnBorderlessStyle.btnAccentColor span,
.btnBorderlessStyle.btnNormalColor:hover span,
.btnBorderlessStyle.btnAccentColor span:before,
.btnBorderlessStyle.btnNormalColor:hover span:before,
.btnBorderlessStyle.btnAccentColor a,
.btnBorderlessStyle.btnNormalColor:hover a,
.btnBorderlessStyle.btnAccentColor .btIco a:before,
.btnBorderlessStyle.btnNormalColor:hover .btIco a:before,
.btnBorderlessStyle.btnAccentColor button,
.btnBorderlessStyle.btnNormalColor:hover button{color: {$accentColor};}
.btnFilledStyle.btnAlternateColor,
.btnOutlineStyle.btnAlternateColor:hover{background-color: {$alternateColor};
    border: 2px solid {$alternateColor};}
.btnOutlineStyle.btnAlternateColor,
.btnFilledStyle.btnAlternateColor:hover{
    border: 2px solid {$alternateColor};
    color: {$alternateColor};}
.btnOutlineStyle.btnAlternateColor span,
.btnFilledStyle.btnAlternateColor:hover span,
.btnOutlineStyle.btnAlternateColor span:before,
.btnFilledStyle.btnAlternateColor:hover span:before,
.btnOutlineStyle.btnAlternateColor a,
.btnFilledStyle.btnAlternateColor:hover a,
.btnOutlineStyle.btnAlternateColor .btIco a:before,
.btnFilledStyle.btnAlternateColor:hover .btIco a:before,
.btnOutlineStyle.btnAlternateColor button,
.btnFilledStyle.btnAlternateColor:hover button{color: {$alternateColor} !important;}
.btnBorderlessStyle.btnAlternateColor span,
.btnBorderlessStyle.btnAlternateColor span:before,
.btnBorderlessStyle.btnAlternateColor a,
.btnBorderlessStyle.btnAlternateColor .btIco a:before,
.btnBorderlessStyle.btnAlternateColor button{color: {$alternateColor};}
.btCounterHolder{font-family: \"{$headingFont}\";}
.btCounterHolder .btCountdownHolder .days_text,
.btCounterHolder .btCountdownHolder .hours_text,
.btCounterHolder .btCountdownHolder .minutes_text,
.btCounterHolder .btCountdownHolder .seconds_text{
    font-family: {$headingFont};
    color: {$accentColor};}
.btProgressContent{font-family: \"{$headingFont}\";}
.btProgressContent .btProgressAnim{
    background-color: {$accentColor};}
.btShowTitle{
    border-left: 4px solid {$accentColor};}
.btAccentColorBackground .btShowTitle{border-left: 4px solid {$alternateColor};}
.btPriceTable .btPriceTableHeader{background: {$accentColor};}
.btPriceTableSticker{
    font-family: \"{$headingFont}\";}
.header .btSuperTitle{font-family: \"{$headingSuperTitleFont}\";}
.header .btSubTitle{font-family: \"{$headingSubTitleFont}\";}
.btDash.bottomDash .dash:after{
    border-bottom: 4px solid {$accentColor};}
.btDash.topDash .btSuperTitle:after,
.btDash.topDash .btSuperTitle:before{
    border-top: 1px solid {$accentColor};}
.btNoMore{
    font-family: {$headingFont};}
.btGridContent .header .btSuperTitle a:hover{color: {$accentColor};}
.btCatFilter{
    font-family: {$headingFont};}
.btCatFilter .btCatFilterItem:hover{color: {$accentColor};}
.btCatFilter .btCatFilterItem.active{color: {$accentColor};}
.nbs a .nbsItem .nbsDir{
    font-family: \"{$headingSuperTitleFont}\";}
.btLightSkin .btSimpleArrows .nbs a:hover:before,
.btDarkSkin .btLightSkin .btSimpleArrows .nbs a:hover:before,
.btLightSkin .btDarkSkin .btLightSkin .btSimpleArrows .nbs a:hover:before,
.btDarkSkin .btSimpleArrows .nbs a:hover:before,
.btLightSkin .btDarkSkin .btSimpleArrows .nbs a:hover:before,
.btDarkSkin.btLightSkin .btDarkSkin .btSimpleArrows .nbs a:hover:before{color: {$accentColor} !important;}
.neighboringArticles .nbs a .nbsItem .nbsDir{
    font-family: '{$bodyFont}',arial,sans-serif;}
.neighboringArticles .nbs a:hover .nbsDir{color: {$accentColor};}
.recentTweets small:before{
    color: {$accentColor};}
.btInfoBar .btInfoBarMeta p strong{color: {$accentColor};}
.tabsHeader li{
    font-family: \"{$headingFont}\";}
.tabsVertical .tabAccordionTitle{
    font-family: \"{$headingFont}\";}
.btVisualizer{font-family: {$headingFont};}
form.wpcf7-form .wpcf7-submit{
    background-color: {$accentColor};}
.btAnimNav li.btAnimNavDot{
    font-family: {$headingFont};}
.btAnimNav li.btAnimNavNext:hover,
.btAnimNav li.btAnimNavPrev:hover{border-color: {$accentColor};
    color: {$accentColor};}
.headline b.animate.animated{
    color: {$accentColor};}
.headline em.animate{
    font-family: {$bodyFont};}
p.demo_store{
    background-color: {$accentColor};}
.woocommerce .woocommerce-info a: not(.button),
.woocommerce .woocommerce-message a: not(.button),
.woocommerce-page .woocommerce-info a: not(.button),
.woocommerce-page .woocommerce-message a: not(.button){color: {$accentColor};}
.woocommerce .woocommerce-message:before,
.woocommerce .woocommerce-info:before,
.woocommerce-page .woocommerce-message:before,
.woocommerce-page .woocommerce-info:before{
    color: {$accentColor};}
.woocommerce a.button,
.woocommerce input[type=\"submit\"],
.woocommerce button[type=\"submit\"],
.woocommerce input.button,
.woocommerce input.alt:hover,
.woocommerce a.button.alt:hover,
.woocommerce .button.alt:hover,
.woocommerce button.alt:hover,
.woocommerce-page a.button,
.woocommerce-page input[type=\"submit\"],
.woocommerce-page button[type=\"submit\"],
.woocommerce-page input.button,
.woocommerce-page input.alt:hover,
.woocommerce-page a.button.alt:hover,
.woocommerce-page .button.alt:hover,
.woocommerce-page button.alt:hover{
    font-family: {$headingFont};}
.woocommerce a.button:hover,
.woocommerce input[type=\"submit\"]:hover,
.woocommerce .button:hover,
.woocommerce button:hover,
.woocommerce input.alt,
.woocommerce a.button.alt,
.woocommerce .button.alt,
.woocommerce button.alt,
.woocommerce-page a.button:hover,
.woocommerce-page input[type=\"submit\"]:hover,
.woocommerce-page .button:hover,
.woocommerce-page button:hover,
.woocommerce-page input.alt,
.woocommerce-page a.button.alt,
.woocommerce-page .button.alt,
.woocommerce-page button.alt{
    font-family: \"{$headingFont}\";}
.woocommerce p.lost_password:before,
.woocommerce-page p.lost_password:before{
    color: {$accentColor};}
.woocommerce form.login p.lost_password a:hover,
.woocommerce-page form.login p.lost_password a:hover{color: {$accentColor};}
.woocommerce .added:after,
.woocommerce .loading:after,
.woocommerce-page .added:after,
.woocommerce-page .loading:after{
    background-color: {$accentColor};}
.woocommerce form .form-row .select2-container,
.woocommerce-page form .form-row .select2-container{
    font-family: \"{$headingFont}\";}
.woocommerce div.product p.price,
.woocommerce div.product span.price,
.woocommerce-page div.product p.price,
.woocommerce-page div.product span.price{
    font-family: \"{$headingFont}\";
    color: {$accentColor};}
.woocommerce div.product .stock,
.woocommerce-page div.product .stock{color: {$accentColor};}
.woocommerce div.product div.images .woocommerce-product-gallery__trigger:after,
.woocommerce-page div.product div.images .woocommerce-product-gallery__trigger:after{
    -webkit-box-shadow: 0 0 0 2em {$accentColor} inset,0 0 0 2em rgba(255,255,255,.5) inset;
    box-shadow: 0 0 0 2em {$accentColor} inset,0 0 0 2em rgba(255,255,255,.5) inset;}
.woocommerce div.product div.images .woocommerce-product-gallery__trigger:hover:after,
.woocommerce-page div.product div.images .woocommerce-product-gallery__trigger:hover:after{-webkit-box-shadow: 0 0 0 1px {$accentColor} inset,0 0 0 2em rgba(255,255,255,.5) inset;
    box-shadow: 0 0 0 1px {$accentColor} inset,0 0 0 2em rgba(255,255,255,.5) inset;
    color: {$accentColor};}
.woocommerce div.product a.reset_variations:hover,
.woocommerce-page div.product a.reset_variations:hover{color: {$accentColor};}
.woocommerce .added_to_cart,
.woocommerce-page .added_to_cart{
    font-family: {$headingFont};}
.woocommerce .products ul li.product .btPriceTableSticker,
.woocommerce ul.products li.product .btPriceTableSticker,
.woocommerce-page .products ul li.product .btPriceTableSticker,
.woocommerce-page ul.products li.product .btPriceTableSticker{
    background: {$alternateColor};}
.woocommerce .products ul li.product .price,
.woocommerce ul.products li.product .price,
.woocommerce-page .products ul li.product .price,
.woocommerce-page ul.products li.product .price{
    font-family: \"{$headingFont}\";}
.woocommerce nav.woocommerce-pagination,
.woocommerce-page nav.woocommerce-pagination{
    font-family: \"{$headingFont}\";}
.woocommerce nav.woocommerce-pagination ul li a:focus,
.woocommerce nav.woocommerce-pagination ul li a:hover,
.woocommerce nav.woocommerce-pagination ul li a.next,
.woocommerce nav.woocommerce-pagination ul li a.prev,
.woocommerce nav.woocommerce-pagination ul li span.current,
.woocommerce-page nav.woocommerce-pagination ul li a:focus,
.woocommerce-page nav.woocommerce-pagination ul li a:hover,
.woocommerce-page nav.woocommerce-pagination ul li a.next,
.woocommerce-page nav.woocommerce-pagination ul li a.prev,
.woocommerce-page nav.woocommerce-pagination ul li span.current{background: {$accentColor};}
.woocommerce .star-rating span:before,
.woocommerce-page .star-rating span:before{
    color: {$accentColor};}
.woocommerce p.stars a[class^=\"star-\"].active:after,
.woocommerce p.stars a[class^=\"star-\"]:hover:after,
.woocommerce-page p.stars a[class^=\"star-\"].active:after,
.woocommerce-page p.stars a[class^=\"star-\"]:hover:after{color: {$accentColor};}
.woocommerce-cart table.cart td.product-remove a.remove{
    color: {$accentColor};
    border: 1px solid {$accentColor};}
.woocommerce-cart table.cart td.product-remove a.remove:hover{background-color: {$accentColor};}
.woocommerce-cart .cart_totals .discount td{color: {$accentColor};}
.woocommerce-account header.title .edit{
    color: {$accentColor};}
.woocommerce-account header.title .edit:before{
    color: {$accentColor};}
.btLightSkin.woocommerce-page .product .headline a:hover,
.btDarkSkin .btLightSkin.woocommerce-page .product .headline a:hover,
.btLightSkin .btDarkSkin .btLightSkin.woocommerce-page .product .headline a:hover,
.btDarkSkin.woocommerce-page .product .headline a:hover,
.btLightSkin .btDarkSkin.woocommerce-page .product .headline a:hover,
.btDarkSkin.btLightSkin .btDarkSkin.woocommerce-page .product .headline a:hover{color: {$accentColor};}
.btQuoteBooking .btTotalNextWrapper{
    font-family: \"{$headingFont}\";}
.btQuoteBooking .btContactNext{
    border: {$accentColor} 2px solid;
    color: {$accentColor};}
.btQuoteBooking .btContactNext:hover,
.btQuoteBooking .btContactNext:active{background-color: {$accentColor} !important;}
.btQuoteBooking .btQuoteSwitch:hover{-webkit-box-shadow: 0 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);
    box-shadow: 0 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);}
.btQuoteBooking .btQuoteSwitch.on .btQuoteSwitchInner{
    background: {$accentColor};}
.btQuoteBooking .dd.ddcommon.borderRadiusTp .ddTitleText,
.btQuoteBooking .dd.ddcommon.borderRadiusBtm .ddTitleText{
    -webkit-box-shadow: 5px 0 0 {$accentColor} inset,0 2px 10px rgba(0,0,0,.2);
    box-shadow: 5px 0 0 {$accentColor} inset,0 2px 10px rgba(0,0,0,.2);}
.btQuoteBooking .ui-slider .ui-slider-handle{
    background: {$accentColor};}
.btQuoteBooking .btQuoteBookingForm .btQuoteTotal{
    background: {$accentColor};}
.btQuoteBooking .btContactFieldMandatory.btContactFieldError input,
.btQuoteBooking .btContactFieldMandatory.btContactFieldError textarea{border: 1px solid {$accentColor};
    -webkit-box-shadow: 0 0 0 1px {$accentColor} inset;
    box-shadow: 0 0 0 1px {$accentColor} inset;}
.btQuoteBooking .btContactFieldMandatory.btContactFieldError .dd.ddcommon.borderRadius .ddTitleText{border: 1px solid {$accentColor};
    -webkit-box-shadow: 0 0 0 1px {$accentColor} inset;
    box-shadow: 0 0 0 1px {$accentColor} inset;}
.btQuoteBooking .btContactFieldMandatory.btContactFieldError input:hover,
.btQuoteBooking .btContactFieldMandatory.btContactFieldError textarea:hover{-webkit-box-shadow: 0 0 0 1px {$accentColor} inset,0 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);
    box-shadow: 0 0 0 1px {$accentColor} inset,0 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);}
.btQuoteBooking .btContactFieldMandatory.btContactFieldError .dd.ddcommon.borderRadius:hover .ddTitleText{-webkit-box-shadow: 0 0 0 1px {$accentColor} inset,0 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);
    box-shadow: 0 0 0 1px {$accentColor} inset,0 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);}
.btQuoteBooking .btContactFieldMandatory.btContactFieldError input:focus,
.btQuoteBooking .btContactFieldMandatory.btContactFieldError textarea:focus{-webkit-box-shadow: 0 0 0 1px {$accentColor} inset,5px 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);
    box-shadow: 0 0 0 1px {$accentColor} inset,5px 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);}
.btQuoteBooking .btContactFieldMandatory.btContactFieldError .dd.ddcommon.borderRadiusTp .ddTitleText{-webkit-box-shadow: 0 0 0 1px {$accentColor} inset,5px 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);
    box-shadow: 0 0 0 1px {$accentColor} inset,5px 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);}
.btQuoteBooking .btSubmitMessage{color: {$accentColor};}
.btDatePicker .ui-datepicker-header{
    background-color: {$accentColor};}
.btQuoteBooking .btContactSubmit{font-family: \"{$headingFont}\";
    background-color: {$accentColor};
    border: 1px solid {$accentColor};}
.btQuoteBooking .btContactSubmit:hover{
    color: {$accentColor};}
.btPayPalButton:hover{-webkit-box-shadow: 0 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);
    box-shadow: 0 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);}
#btSettingsPanel #btSettingsPanelToggler:before{
    color: {$accentColor};}
#btSettingsPanel h4{
    background-color: {$accentColor};}
#btSettingsPanel .btSettingsPanelRow.btAccentColorRow .trigger,
#btSettingsPanel .btSettingsPanelRow.btAccentColorRow select{border-color: {$accentColor};}
#btSettingsPanel .btSettingsPanelRow.btAlternateColorRow .trigger,
#btSettingsPanel .btSettingsPanelRow.btAlternateColorRow select{border-color: {$alternateColor};}
.wp-block-button__link:hover{color: {$accentColor} !important;}
", array() );