new WOW().init();

/* jQuery SmartScroll - Debounced scroll event library for jQuery.
 * https://github.com/d4nyll/smartscroll
 */
!function(e){var t,n="mousewheel DOMMouseScroll wheel MozMousePixelScroll";"undefined"!=typeof Lethargy&&null!==Lethargy&&(t=new Lethargy);var i=function(){return Math.max(window.pageYOffset,window.document.body.scrollTop,window.document.documentElement.scrollTop)};e.smartscroll=function(o){var r=e.extend({},e.smartscroll.defaults,o);if(r.sectionSelector||(r.sectionSelector="."+r.sectionClass),("undefined"==typeof EventEmitter||null===EventEmitter||r.eventEmitter&&r.eventEmitter.constructor!==EventEmitter)&&(r.eventEmitter=null),r.bindSwipe)var a=null,l=null,s=function(e){var e=e.originalEvent||e;a=e.touches[0].clientX,l=e.touches[0].clientY},c=function(e){var e=e.originalEvent||e;if(a&&l){var t=e.touches[0].clientX,n=e.touches[0].clientY,i=a-t,o=l-n;Math.abs(i)>Math.abs(o)?i>0?r.eventEmitter.emitEvent("swipeLeft"):r.eventEmitter.emitEvent("swipeRight"):o>0?r.eventEmitter.emitEvent("swipeUp"):r.eventEmitter.emitEvent("swipeDown"),a=null,l=null}};var d,h,u=!1,w=[],v=!1,p=!1,f=window.location.hash,m=e(r.sectionWrapperSelector+":first"),E=function(){var t=i(),n=t+e(window).height();return n>d&&h>=t?!0:!1},g=function(t,n){u||(u=!0,e("body,html").stop(!0,!0).animate({scrollTop:t},n,function(){u=!1,r.eventEmitter&&r.eventEmitter.emitEvent("scrollEnd")}))};this.scroll=function(t){if(w){var n=i();if(r.eventEmitter){var o=y(n+e(window).height()/2),a=t?o+1:o-1;r.eventEmitter.emitEvent("scrollStart",[a])}for(var l=0;l<w.length;l++)if(n<w[l])return t?g(w[l],700):g(w[l-1]-e(window).height(),700),r.eventEmitter&&r.eventEmitter.emitEvent("scrollEnd"),!1}};var S=function(){var t=[];d=Math.round(m.position().top+parseInt(m.css("paddingTop"),10)+parseInt(m.css("borderTopWidth"),10)+parseInt(m.css("marginTop"),10)),h=Math.round(d+m.height(),10),t.push(d),e(r.sectionSelector).each(function(n,i){t.push(Math.round(d+e(i).position().top+e(i).outerHeight()))}),w=t},b=function(e){if(t)var n=t.check(e);if(!u)if(t){if(1===n)return"up";if(-1===n)return"down"}else{if(e.originalEvent.wheelDelta>0||e.originalEvent.detail<0)return"up";if(e.originalEvent.wheelDelta<0||e.originalEvent.detail>0)return"down"}return!1},y=function(e){for(var t=0;t<w.length;t++)if(e<=w[t])return t;return w.length},k=function(){e(window).bind(n,function(t){var n=b(t);r.dynamicHeight&&S(),E();var o=i(),a=o+e(window).height();if(a>d&&h>=o){var l=y(o),s=y(o+e(window).height()/2),c=y(a);l===c&&r.innerSectionScroll||(t.preventDefault(),t.stopPropagation(),n&&("up"===n?(r.toptotop?g(w[s-2]+1,r.animationSpeed):g(w[s-1]-e(window).height(),r.animationSpeed),r.eventEmitter&&r.eventEmitter.emitEvent("scrollStart",[s-1])):"down"===n&&(g(w[s]+1,r.animationSpeed),r.eventEmitter&&r.eventEmitter.emitEvent("scrollStart",[s+1]))))}})},H=function(){e(window).unbind(n)},M=function(){var t;if(i()+e(window).height()/2<d)t=r.headerHash;else{var n=y(i()+e(window).height()/2);void 0!==n&&(t=e(r.sectionSelector+":nth-of-type("+(n+1)+")").data("hash"))}("undefined"==typeof t||window.location.hash!=="#"+t)&&("undefined"==typeof t&&(t=r.headerHash),r.keepHistory?window.location.hash=t:window.location.replace(window.location.href.split("#")[0]+"#"+t))};if(m.css({position:"relative"}),setTimeout(function(){if(S(),r.autoHash&&(null===r.eventEmitter||r.hashContinuousUpdate?e(window).bind("scroll",M):r.eventEmitter.addListener("scrollEnd",M)),r.initialScroll&&f.length>0){var t=e('[data-hash="'+f.substr(1)+'"]');t.length>0&&g(t[0].offsetTop+d,0)}},50),e(window).bind("resize",S),null!==r.breakpoint&&r.breakpoint===parseInt(r.breakpoint,10)&&r.breakpoint>0&&(v=!0),"vp"==r.mode)if(r.ie8){var T=function(){e(r.sectionSelector).css({height:e(window).height()})};T(),e(window).bind("resize",T)}else e(r.sectionSelector).css({height:"100vh"});if(r.sectionScroll&&(v&&e(window).bind("resize",function(t){if(e(window).width()<r.breakpoint){if(!p)return H(),p=!0,!1}else p&&(k(),p=!1)}),k()),r.bindSwipe&&(e(window).on("touchstart",s),e(window).on("touchmove",c)),r.bindKeyboard){var D=function(t){t=t.originalEvent||t,r.dynamicHeight&&S();var n=i(),o=n+e(window).height();if(E()){var a=y(n),l=y(n+e(window).height()/2),s=y(o);if(a!==s||!r.innerSectionScroll)switch(t.which){case 38:t.preventDefault(),t.stopPropagation(),r.toptotop?g(w[l-2]+1,r.animationSpeed):g(w[l-1]-e(window).height(),r.animationSpeed),r.eventEmitter&&r.eventEmitter.emitEvent("scrollStart",[l-1]);break;case 40:t.preventDefault(),t.stopPropagation(),g(w[l]+1,r.animationSpeed),r.eventEmitter&&r.eventEmitter.emitEvent("scrollStart",[l+1]);break;default:return}}};e(window).on("keydown",D)}return this},e.smartscroll.defaults={animationSpeed:700,autoHash:!0,breakpoint:null,initialScroll:!0,headerHash:"header",keepHistory:!1,mode:"vp",sectionClass:"section",sectionSelector:null,sectionScroll:!0,sectionWrapperSelector:".section-wrapper",eventEmitter:null,dynamicHeight:!1,ie8:!1,hashContinuousUpdate:!0,innerSectionScroll:!0,toptotop:!1,bindSwipe:!0,bindKeyboard:!0}}(jQuery);
/* end jQuery SmartScroll */

// Scroll to top
if ($('#totop').length) {
    var scrollTrigger = 100, // px
        backToTop = function () {
            var scrollTop = $(window).scrollTop();
            if (scrollTop > scrollTrigger) {
                $('#totop').addClass('show');
            } else {
                $('#totop').removeClass('show');
            }
        };
    backToTop();
    $(window).on('scroll', function () {
        backToTop();
    });
    $('#totop').on('click', function (e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 700);
    });
}
// END Scroll to top 

function showResult(str) {
    if (str.length==0) {
        document.getElementById("livesearch").innerHTML="";
        document.getElementById("livesearch").style.display="none";
        return;
    }
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    } else {  // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            document.getElementById("livesearch").innerHTML=this.responseText;
            document.getElementById("livesearch").style.display="block";
        }
    }
    xmlhttp.open("GET","admin/master.php?q="+str,true);
    xmlhttp.send();
}

(function($) {
    // jQuery function to set a maximum length or characters for a page element it can handle multiple elements
    $.fn.createExcerpts = function(elems,length,more_txt) {
        $.each($(elems), function() {
            var item_html = $(this).html(); //
            item_html = item_html.replace(/]+>/gi, ''); //replace html tags
            item_html = jQuery.trim(item_html);  //trim whitespace

            $(this).html('<span class="full_text">'+ $(this).html() +'</span>');

            var more_text = '<span class="the_excerpt">'+ item_html.substring(0,length)+more_txt +'</span>';
            $(this).append(more_text);  //update the html on page
        });
        return this; //allow jQuery chaining
    }
})(jQuery);

// Select all links with hashes
$('#info-blocks a[href*="#"]')
// Remove links that don't actually link to anything
    .not('[href="#"]')
    .not('[href="#0"]')
    .click(function(event) {
        // On-page links
        if (
            location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
            &&
            location.hostname == this.hostname
        ) {
            // Figure out element to scroll to
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            // Does a scroll target exist?
            if (target.length) {
                // Only prevent default if animation is actually gonna happen
                event.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top-50
                }, 1000, function() {
                    // Callback after animation
                    // Must change focus!
                    var $target = $(target);
                    $target.focus();
                    if ($target.is(":focus")) { // Checking if the target was focused
                        return false;
                    } else {
                        $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
                        $target.focus(); // Set focus again
                    };
                });
            }
        }
    });

$(document).ready(function(){
    $('.bxslider').bxSlider({
        mode: 'fade',
        captions: true,
        auto: true
    });

    $('header #header_search input').change(function(){
        if ($(this).val() === '') {
            $('#livesearch').hide();
        }
    });

    $('body').click(function(){
        $('#livesearch').hide();
    });

    $('header #header_search input').click(function(){
        if ($(this).val() !== '') {
            showResult($(this).val());
            $('#livesearch').show();
        }
    });

    $('header #menu').scrollToFixed();

    $("form#submitFeedback").submit(function(){
        $.post('admin/master.php', $(this).serialize()).done(function () {
            $("form#submitFeedback").html("<center><h2 class='red_title'>Thank you!</h2><h4>For your valuable feedback.</h4><br><br><button type='button' class='red_button' data-dismiss='modal'>Close</button></center>");
        });

        return false;
    });

    $('.menu-btn').on('click', function(e){
        $('.mobile-nav').addClass('show');
        $('.mobile-nav ul.levelone > li > span').off().on('click', function() {

            if ($(this).siblings('ul.leveltwo').hasClass('open')) {
                $('.mobile-nav ul.levelone > li > ul.open')
                    .slideUp('fast', function(){})
                    .removeClass('open')
                    .siblings('span')
                    .children('i')
                    .removeClass("downside-up");
            }else{
                $('.mobile-nav ul.levelone > li > ul.open')
                    .slideUp('fast', function(){})
                    .removeClass('open')
                    .siblings('span')
                    .children('i')
                    .removeClass("downside-up");
                $(this).
                    siblings('ul.leveltwo')
                    .addClass('open')
                    .slideDown('slow', function(){})
                    .siblings('span')
                    .children('i')
                    .addClass("downside-up");
            }

        });

    });

    //$("footer .container ul:first").append('<li><a href="sitemap.php">Sitemap</a></li>');

    $('.menu-close-btn').on('click', function(){
        $('.mobile-nav').removeClass('show');
    });

    $(".full-width-video-section a").click(function() {

        var href = $(this).attr('href');

        $(".full-width-video-section").html('<iframe width="100%" height="100%" src="'+href+'?rel=0&amp;controls=0&amp;showinfo=0&amp;autoplay=1" frameborder="0" allowfullscreen></iframe>');
        return false;

    });

    $('#risk_checker .question .the_question').each(function () {
        $(this).parent().find('.question_number').height($(this).height());
    });

    $("#risk_checker").submit(function(){
        var question_1 = parseInt($('input:radio[name=question_1]:checked').val());
        var question_2 = parseInt($('input:radio[name=question_2]:checked').val());
        var question_3 = parseInt($('input:radio[name=question_3]:checked').val());
        var question_4 = parseInt($('input:radio[name=question_4]:checked').val());
        var question_5 = parseInt($('input:radio[name=question_5]:checked').val());
        var question_6 = parseInt($('input:radio[name=question_6]:checked').val());
        var question_7 = parseInt($('input:radio[name=question_7]:checked').val());

        var total = question_1 + question_2 + question_3 + question_4 + question_5 + question_6 + question_7;
        var profile;

        $('.result > div').hide();

        if (total === 7 || total < 11 && total > 7) {
            profile = 'Very Conservative';
            $('.result .risk_taker_conservative').css('display', 'inline-block');
        }

        if (total === 11 || total < 18 && total > 11) {
            profile = 'Conservative';
            $('.result .risk_taker_conservative').css('display', 'inline-block');
        }

        if (total === 18 || total < 25 && total > 18) {
            profile = 'Moderate';
            $('.result .risk_taker_moderate').css('display', 'inline-block');
        }

        if (total === 25 || total < 32 && total > 25) {
            profile = 'Aggressive';
            $('.result .risk_taker_aggressive').css('display', 'inline-block');
        }

        if (total === 32 || total < 36 && total > 32) {
            profile = 'Very Aggressive';
            $('.result .risk_taker_aggressive').css('display', 'inline-block');
        }

        $('.result h1 span').html(profile);

        $('.result').slideDown();


        return false;
    });

    $('.expandables .item a').click(function () {
        $(this).parent().find('.item-content').slideToggle();

        return false;
    });

    $("form#investNow").submit(function(){
        $.post('admin/master.php', $(this).serialize()).done(function () {
            $("form#investNow").html("<center><h2 class='red_title'>Thank you!</h2></center><br><center><h4>We will contact you soon.</h4></center>");
        });

        return false;
    });

    $(".historic_nav input").change(function () {
        var fromDate = $(".historic_nav input[name='from_date']").datepicker({ dateFormat: 'yy-mm-dd' }).val();
        var toDate = $(".historic_nav input[name='to_date']").datepicker({ dateFormat: 'yy-mm-dd' }).val();
        var fundID = $(".historic_nav select[name='fund_id']").val();

        $.post("admin/master.php", {request_type: 'historic_nav', fromDate: fromDate, toDate: toDate, fundID: fundID}).done(function (data) {
            $('.historic_result').hide();
            $('.historic_result').html(data);
            $('.historic_result').fadeIn();
        });
    });

    var pager_items = $("#main_slider .bx-pager-item a").length;

    if (pager_items < 2) {
        $("#main_slider .bx-default-pager").hide();
    }

    $("#performance_content .carousel-inner .item:first-child").addClass('active');
});


jQuery( document ).ready( function($) {
	//Auto Logout if idle for x miliseconds
    $.idleTimer(5000000);

    $(document).bind("idle.idleTimer", function(ev){
		if ( '/auth/login' != window.location.pathname ) {
			window.location.replace('/auth/logout');
		}
    });
	
	
	//Disable BackButton
	window.history.pushState(null, "", window.location.href);
	window.onpopstate = function() {
		window.history.pushState(null, "", window.location.href);
	};
	
	
	$('#idlcAmlHome').on( 'click', function(event) {
		event.preventDefault();
		var $this = $( this );

        if ( '/auth/login' == window.location.pathname ) {
            if ( confirm('Your will be redirect to http://aml.idlc.com, do you want to continue? ') ) {
                window.location.replace( 'http://aml.idlc.com/' );
            }
        } else {
            if ( confirm('Your session will be logged out automatically, do you want to continue? ') ) {
                //console.log($this.attr('href'))
                window.location.replace( '/auth/logout/true' );
            }
        }
		
	} );

    $("#slidesShow").slidesjs({
        width: 940,
        height: 528
    });
	
} );

