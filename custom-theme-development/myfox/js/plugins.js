
// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

// Place any jQuery/helper plugins in here.



/*
scrollUp v1.1.0
Author: Mark Goodyear - http://www.markgoodyear.com
Git: https://github.com/markgoodyear/scrollup

Copyright 2013 Mark Goodyear
Licensed under the MIT license: http://www.opensource.org/licenses/mit-license.php

Twitter: @markgdyr
*/

;(function(e){e.scrollUp=function(t){var n={scrollName:"scrollUp",topDistance:300,topSpeed:2000,animation:"fade",animationInSpeed:800,animationOutSpeed:200,scrollText:"scroll to top",scrollImg:false,activeOverlay:false};var r=e.extend({},n,t),i="#"+r.scrollName;e("<a/>",{id:r.scrollName,href:"#top",title:r.scrollText}).appendTo("body");if(!r.scrollImg){e(i).text(r.scrollText)}e(i).css({display:"none",position:"fixed","z-index":"2147483647"});if(r.activeOverlay){e("body").append("<div id='"+r.scrollName+"-active'></div>");e(i+"-active").css({position:"absolute",top:r.topDistance+"px",width:"100%","border-top":"1px dotted "+r.activeOverlay,"z-index":"2147483647"})}e(window).scroll(function(){switch(r.animation){case"fade":e(e(window).scrollTop()>r.topDistance?e(i).fadeIn(r.animationInSpeed):e(i).fadeOut(r.animationOutSpeed));break;case"slide":e(e(window).scrollTop()>r.topDistance?e(i).slideDown(r.animationInSpeed):e(i).slideUp(r.animationOutSpeed));break;default:e(e(window).scrollTop()>r.topDistance?e(i).show(0):e(i).hide(0))}});e(i).click(function(t){e("html, body").animate({scrollTop:0},r.topSpeed);t.preventDefault()})}})(jQuery);

/*!
    SlickNav Responsive Mobile Menu
    (c) 2014 Josh Cope
    licensed under MIT
*/
;(function(e,t,n){function o(t,n){this.element=t;this.settings=e.extend({},r,n);this._defaults=r;this._name=i;this.init()}var r={label:"MENU",duplicate:true,duration:300,easingOpen:"swing",easingClose:"swing",closedSymbol:"&#9658;",openedSymbol:"&#9660;",prependTo:"body",parentTag:"a",closeOnClick:false,allowParentLinks:false,nestedParentLinks:true,showChildren:false,init:function(){},open:function(){},close:function(){}},i="slicknav",s="slicknav";o.prototype.init=function(){var n=this;var r=e(this.element);var i=this.settings;if(i.duplicate){n.mobileNav=r.clone();n.mobileNav.removeAttr("id");n.mobileNav.find("*").each(function(t,n){e(n).removeAttr("id")})}else n.mobileNav=r;var o=s+"_icon";if(i.label===""){o+=" "+s+"_no-text"}if(i.parentTag=="a"){i.parentTag='a href="#"'}n.mobileNav.attr("class",s+"_nav");var u=e('<div class="'+s+'_menu"></div>');n.btn=e("<"+i.parentTag+' aria-haspopup="true" tabindex="0" class="'+s+"_btn "+s+'_collapsed"><span class="'+s+'_menutxt">'+i.label+'</span><span class="'+o+'"><span class="'+s+'_icon-bar"></span><span class="'+s+'_icon-bar"></span><span class="'+s+'_icon-bar"></span></span></a>');e(u).append(n.btn);e(i.prependTo).prepend(u);u.append(n.mobileNav);var a=n.mobileNav.find("li");e(a).each(function(){var t=e(this);var r={};r.children=t.children("ul").attr("role","menu");t.data("menu",r);if(r.children.length>0){var o=t.contents();var u=false;var a=[];e(o).each(function(){if(!e(this).is("ul")){a.push(this)}else{return false}if(e(this).is("a")){u=true}});var f=e("<"+i.parentTag+' role="menuitem" aria-haspopup="true" tabindex="-1" class="'+s+'_item"/>');if(!i.allowParentLinks||i.nestedParentLinks||!u){var l=e(a).wrapAll(f).parent();l.addClass(s+"_row")}else e(a).wrapAll('<span class="'+s+"_parent-link "+s+'_row"/>').parent();t.addClass(s+"_collapsed");t.addClass(s+"_parent");var c=e('<span class="'+s+'_arrow">'+i.closedSymbol+"</span>");if(i.allowParentLinks&&!i.nestedParentLinks&&u)c=c.wrap(f).parent();e(a).last().after(c)}else if(t.children().length===0){t.addClass(s+"_txtnode")}t.children("a").attr("role","menuitem").click(function(t){if(i.closeOnClick&&!e(t.target).parent().closest("li").hasClass(s+"_parent"))e(n.btn).click()});if(i.closeOnClick&&i.allowParentLinks){t.children("a").children("a").click(function(t){e(n.btn).click()});t.find("."+s+"_parent-link a:not(."+s+"_item)").click(function(t){e(n.btn).click()})}});e(a).each(function(){var t=e(this).data("menu");if(!i.showChildren){n._visibilityToggle(t.children,null,false,null,true)}});n._visibilityToggle(n.mobileNav,null,false,"init",true);n.mobileNav.attr("role","menu");e(t).mousedown(function(){n._outlines(false)});e(t).keyup(function(){n._outlines(true)});e(n.btn).click(function(e){e.preventDefault();n._menuToggle()});n.mobileNav.on("click","."+s+"_item",function(t){t.preventDefault();n._itemClick(e(this))});e(n.btn).keydown(function(e){var t=e||event;if(t.keyCode==13){e.preventDefault();n._menuToggle()}});n.mobileNav.on("keydown","."+s+"_item",function(t){var r=t||event;if(r.keyCode==13){t.preventDefault();n._itemClick(e(t.target))}});if(i.allowParentLinks&&i.nestedParentLinks){e("."+s+"_item a").click(function(e){e.stopImmediatePropagation()})}};o.prototype._menuToggle=function(e){var t=this;var n=t.btn;var r=t.mobileNav;if(n.hasClass(s+"_collapsed")){n.removeClass(s+"_collapsed");n.addClass(s+"_open")}else{n.removeClass(s+"_open");n.addClass(s+"_collapsed")}n.addClass(s+"_animating");t._visibilityToggle(r,n.parent(),true,n)};o.prototype._itemClick=function(e){var t=this;var n=t.settings;var r=e.data("menu");if(!r){r={};r.arrow=e.children("."+s+"_arrow");r.ul=e.next("ul");r.parent=e.parent();if(r.parent.hasClass(s+"_parent-link")){r.parent=e.parent().parent();r.ul=e.parent().next("ul")}e.data("menu",r)}if(r.parent.hasClass(s+"_collapsed")){r.arrow.html(n.openedSymbol);r.parent.removeClass(s+"_collapsed");r.parent.addClass(s+"_open");r.parent.addClass(s+"_animating");t._visibilityToggle(r.ul,r.parent,true,e)}else{r.arrow.html(n.closedSymbol);r.parent.addClass(s+"_collapsed");r.parent.removeClass(s+"_open");r.parent.addClass(s+"_animating");t._visibilityToggle(r.ul,r.parent,true,e)}};o.prototype._visibilityToggle=function(t,n,r,i,o){var u=this;var a=u.settings;var f=u._getActionItems(t);var l=0;if(r)l=a.duration;if(t.hasClass(s+"_hidden")){t.removeClass(s+"_hidden");t.slideDown(l,a.easingOpen,function(){e(i).removeClass(s+"_animating");e(n).removeClass(s+"_animating");if(!o){a.open(i)}});t.attr("aria-hidden","false");f.attr("tabindex","0");u._setVisAttr(t,false)}else{t.addClass(s+"_hidden");t.slideUp(l,this.settings.easingClose,function(){t.attr("aria-hidden","true");f.attr("tabindex","-1");u._setVisAttr(t,true);t.hide();e(i).removeClass(s+"_animating");e(n).removeClass(s+"_animating");if(!o)a.close(i);else if(i=="init")a.init()})}};o.prototype._setVisAttr=function(t,n){var r=this;var i=t.children("li").children("ul").not("."+s+"_hidden");if(!n){i.each(function(){var t=e(this);t.attr("aria-hidden","false");var i=r._getActionItems(t);i.attr("tabindex","0");r._setVisAttr(t,n)})}else{i.each(function(){var t=e(this);t.attr("aria-hidden","true");var i=r._getActionItems(t);i.attr("tabindex","-1");r._setVisAttr(t,n)})}};o.prototype._getActionItems=function(e){var t=e.data("menu");if(!t){t={};var n=e.children("li");var r=n.find("a");t.links=r.add(n.find("."+s+"_item"));e.data("menu",t)}return t.links};o.prototype._outlines=function(t){if(!t){e("."+s+"_item, ."+s+"_btn").css("outline","none")}else{e("."+s+"_item, ."+s+"_btn").css("outline","")}};o.prototype.toggle=function(){var e=this;e._menuToggle()};o.prototype.open=function(){var e=this;if(e.btn.hasClass(s+"_collapsed")){e._menuToggle()}};o.prototype.close=function(){var e=this;if(e.btn.hasClass(s+"_open")){e._menuToggle()}};e.fn[i]=function(t){var n=arguments;if(t===undefined||typeof t==="object"){return this.each(function(){if(!e.data(this,"plugin_"+i)){e.data(this,"plugin_"+i,new o(this,t))}})}else if(typeof t==="string"&&t[0]!=="_"&&t!=="init"){var r;this.each(function(){var s=e.data(this,"plugin_"+i);if(s instanceof o&&typeof s[t]==="function"){r=s[t].apply(s,Array.prototype.slice.call(n,1))}});return r!==undefined?r:this}}})(jQuery,document,window);


/*
 *  jQuery OwlCarousel v1.3.3
 *
 *  Copyright (c) 2013 Bartosz Wojciechowski
 *  http://www.owlgraphic.com/owlcarousel/
 *
 *  Licensed under MIT
 *
 */

/*JS Lint helpers: */
/*global dragMove: false, dragEnd: false, $, jQuery, alert, window, document */
/*jslint nomen: true, continue:true */

if (typeof Object.create !== "function") {
    Object.create = function (obj) {
        function F() {}
        F.prototype = obj;
        return new F();
    };
}
(function ($, window, document) {

    var Carousel = {
        init : function (options, el) {
            var base = this;

            base.$elem = $(el);
            base.options = $.extend({}, $.fn.owlCarousel.options, base.$elem.data(), options);

            base.userOptions = options;
            base.loadContent();
        },

        loadContent : function () {
            var base = this, url;

            function getData(data) {
                var i, content = "";
                if (typeof base.options.jsonSuccess === "function") {
                    base.options.jsonSuccess.apply(this, [data]);
                } else {
                    for (i in data.owl) {
                        if (data.owl.hasOwnProperty(i)) {
                            content += data.owl[i].item;
                        }
                    }
                    base.$elem.html(content);
                }
                base.logIn();
            }

            if (typeof base.options.beforeInit === "function") {
                base.options.beforeInit.apply(this, [base.$elem]);
            }

            if (typeof base.options.jsonPath === "string") {
                url = base.options.jsonPath;
                $.getJSON(url, getData);
            } else {
                base.logIn();
            }
        },

        logIn : function () {
            var base = this;

            base.$elem.data("owl-originalStyles", base.$elem.attr("style"));
            base.$elem.data("owl-originalClasses", base.$elem.attr("class"));

            base.$elem.css({opacity: 0});
            base.orignalItems = base.options.items;
            base.checkBrowser();
            base.wrapperWidth = 0;
            base.checkVisible = null;
            base.setVars();
        },

        setVars : function () {
            var base = this;
            if (base.$elem.children().length === 0) {return false; }
            base.baseClass();
            base.eventTypes();
            base.$userItems = base.$elem.children();
            base.itemsAmount = base.$userItems.length;
            base.wrapItems();
            base.$owlItems = base.$elem.find(".owl-item");
            base.$owlWrapper = base.$elem.find(".owl-wrapper");
            base.playDirection = "next";
            base.prevItem = 0;
            base.prevArr = [0];
            base.currentItem = 0;
            base.customEvents();
            base.onStartup();
        },

        onStartup : function () {
            var base = this;
            base.updateItems();
            base.calculateAll();
            base.buildControls();
            base.updateControls();
            base.response();
            base.moveEvents();
            base.stopOnHover();
            base.owlStatus();

            if (base.options.transitionStyle !== false) {
                base.transitionTypes(base.options.transitionStyle);
            }
            if (base.options.autoPlay === true) {
                base.options.autoPlay = 5000;
            }
            base.play();

            base.$elem.find(".owl-wrapper").css("display", "block");

            if (!base.$elem.is(":visible")) {
                base.watchVisibility();
            } else {
                base.$elem.css("opacity", 1);
            }
            base.onstartup = false;
            base.eachMoveUpdate();
            if (typeof base.options.afterInit === "function") {
                base.options.afterInit.apply(this, [base.$elem]);
            }
        },

        eachMoveUpdate : function () {
            var base = this;

            if (base.options.lazyLoad === true) {
                base.lazyLoad();
            }
            if (base.options.autoHeight === true) {
                base.autoHeight();
            }
            base.onVisibleItems();

            if (typeof base.options.afterAction === "function") {
                base.options.afterAction.apply(this, [base.$elem]);
            }
        },

        updateVars : function () {
            var base = this;
            if (typeof base.options.beforeUpdate === "function") {
                base.options.beforeUpdate.apply(this, [base.$elem]);
            }
            base.watchVisibility();
            base.updateItems();
            base.calculateAll();
            base.updatePosition();
            base.updateControls();
            base.eachMoveUpdate();
            if (typeof base.options.afterUpdate === "function") {
                base.options.afterUpdate.apply(this, [base.$elem]);
            }
        },

        reload : function () {
            var base = this;
            window.setTimeout(function () {
                base.updateVars();
            }, 0);
        },

        watchVisibility : function () {
            var base = this;

            if (base.$elem.is(":visible") === false) {
                base.$elem.css({opacity: 0});
                window.clearInterval(base.autoPlayInterval);
                window.clearInterval(base.checkVisible);
            } else {
                return false;
            }
            base.checkVisible = window.setInterval(function () {
                if (base.$elem.is(":visible")) {
                    base.reload();
                    base.$elem.animate({opacity: 1}, 200);
                    window.clearInterval(base.checkVisible);
                }
            }, 500);
        },

        wrapItems : function () {
            var base = this;
            base.$userItems.wrapAll("<div class=\"owl-wrapper\">").wrap("<div class=\"owl-item\"></div>");
            base.$elem.find(".owl-wrapper").wrap("<div class=\"owl-wrapper-outer\">");
            base.wrapperOuter = base.$elem.find(".owl-wrapper-outer");
            base.$elem.css("display", "block");
        },

        baseClass : function () {
            var base = this,
                hasBaseClass = base.$elem.hasClass(base.options.baseClass),
                hasThemeClass = base.$elem.hasClass(base.options.theme);

            if (!hasBaseClass) {
                base.$elem.addClass(base.options.baseClass);
            }

            if (!hasThemeClass) {
                base.$elem.addClass(base.options.theme);
            }
        },

        updateItems : function () {
            var base = this, width, i;

            if (base.options.responsive === false) {
                return false;
            }
            if (base.options.singleItem === true) {
                base.options.items = base.orignalItems = 1;
                base.options.itemsCustom = false;
                base.options.itemsDesktop = false;
                base.options.itemsDesktopSmall = false;
                base.options.itemsTablet = false;
                base.options.itemsTabletSmall = false;
                base.options.itemsMobile = false;
                return false;
            }

            width = $(base.options.responsiveBaseWidth).width();

            if (width > (base.options.itemsDesktop[0] || base.orignalItems)) {
                base.options.items = base.orignalItems;
            }
            if (base.options.itemsCustom !== false) {
                //Reorder array by screen size
                base.options.itemsCustom.sort(function (a, b) {return a[0] - b[0]; });

                for (i = 0; i < base.options.itemsCustom.length; i += 1) {
                    if (base.options.itemsCustom[i][0] <= width) {
                        base.options.items = base.options.itemsCustom[i][1];
                    }
                }

            } else {

                if (width <= base.options.itemsDesktop[0] && base.options.itemsDesktop !== false) {
                    base.options.items = base.options.itemsDesktop[1];
                }

                if (width <= base.options.itemsDesktopSmall[0] && base.options.itemsDesktopSmall !== false) {
                    base.options.items = base.options.itemsDesktopSmall[1];
                }

                if (width <= base.options.itemsTablet[0] && base.options.itemsTablet !== false) {
                    base.options.items = base.options.itemsTablet[1];
                }

                if (width <= base.options.itemsTabletSmall[0] && base.options.itemsTabletSmall !== false) {
                    base.options.items = base.options.itemsTabletSmall[1];
                }

                if (width <= base.options.itemsMobile[0] && base.options.itemsMobile !== false) {
                    base.options.items = base.options.itemsMobile[1];
                }
            }

            //if number of items is less than declared
            if (base.options.items > base.itemsAmount && base.options.itemsScaleUp === true) {
                base.options.items = base.itemsAmount;
            }
        },

        response : function () {
            var base = this,
                smallDelay,
                lastWindowWidth;

            if (base.options.responsive !== true) {
                return false;
            }
            lastWindowWidth = $(window).width();

            base.resizer = function () {
                if ($(window).width() !== lastWindowWidth) {
                    if (base.options.autoPlay !== false) {
                        window.clearInterval(base.autoPlayInterval);
                    }
                    window.clearTimeout(smallDelay);
                    smallDelay = window.setTimeout(function () {
                        lastWindowWidth = $(window).width();
                        base.updateVars();
                    }, base.options.responsiveRefreshRate);
                }
            };
            $(window).resize(base.resizer);
        },

        updatePosition : function () {
            var base = this;
            base.jumpTo(base.currentItem);
            if (base.options.autoPlay !== false) {
                base.checkAp();
            }
        },

        appendItemsSizes : function () {
            var base = this,
                roundPages = 0,
                lastItem = base.itemsAmount - base.options.items;

            base.$owlItems.each(function (index) {
                var $this = $(this);
                $this
                    .css({"width": base.itemWidth})
                    .data("owl-item", Number(index));

                if (index % base.options.items === 0 || index === lastItem) {
                    if (!(index > lastItem)) {
                        roundPages += 1;
                    }
                }
                $this.data("owl-roundPages", roundPages);
            });
        },

        appendWrapperSizes : function () {
            var base = this,
                width = base.$owlItems.length * base.itemWidth;

            base.$owlWrapper.css({
                "width": width * 2,
                "left": 0
            });
            base.appendItemsSizes();
        },

        calculateAll : function () {
            var base = this;
            base.calculateWidth();
            base.appendWrapperSizes();
            base.loops();
            base.max();
        },

        calculateWidth : function () {
            var base = this;
            base.itemWidth = Math.round(base.$elem.width() / base.options.items);
        },

        max : function () {
            var base = this,
                maximum = ((base.itemsAmount * base.itemWidth) - base.options.items * base.itemWidth) * -1;
            if (base.options.items > base.itemsAmount) {
                base.maximumItem = 0;
                maximum = 0;
                base.maximumPixels = 0;
            } else {
                base.maximumItem = base.itemsAmount - base.options.items;
                base.maximumPixels = maximum;
            }
            return maximum;
        },

        min : function () {
            return 0;
        },

        loops : function () {
            var base = this,
                prev = 0,
                elWidth = 0,
                i,
                item,
                roundPageNum;

            base.positionsInArray = [0];
            base.pagesInArray = [];

            for (i = 0; i < base.itemsAmount; i += 1) {
                elWidth += base.itemWidth;
                base.positionsInArray.push(-elWidth);

                if (base.options.scrollPerPage === true) {
                    item = $(base.$owlItems[i]);
                    roundPageNum = item.data("owl-roundPages");
                    if (roundPageNum !== prev) {
                        base.pagesInArray[prev] = base.positionsInArray[i];
                        prev = roundPageNum;
                    }
                }
            }
        },

        buildControls : function () {
            var base = this;
            if (base.options.navigation === true || base.options.pagination === true) {
                base.owlControls = $("<div class=\"owl-controls\"/>").toggleClass("clickable", !base.browser.isTouch).appendTo(base.$elem);
            }
            if (base.options.pagination === true) {
                base.buildPagination();
            }
            if (base.options.navigation === true) {
                base.buildButtons();
            }
        },

        buildButtons : function () {
            var base = this,
                buttonsWrapper = $("<div class=\"owl-buttons\"/>");
            base.owlControls.append(buttonsWrapper);

            base.buttonPrev = $("<div/>", {
                "class" : "owl-prev",
                "html" : base.options.navigationText[0] || ""
            });

            base.buttonNext = $("<div/>", {
                "class" : "owl-next",
                "html" : base.options.navigationText[1] || ""
            });

            buttonsWrapper
                .append(base.buttonPrev)
                .append(base.buttonNext);

            buttonsWrapper.on("touchstart.owlControls mousedown.owlControls", "div[class^=\"owl\"]", function (event) {
                event.preventDefault();
            });

            buttonsWrapper.on("touchend.owlControls mouseup.owlControls", "div[class^=\"owl\"]", function (event) {
                event.preventDefault();
                if ($(this).hasClass("owl-next")) {
                    base.next();
                } else {
                    base.prev();
                }
            });
        },

        buildPagination : function () {
            var base = this;

            base.paginationWrapper = $("<div class=\"owl-pagination\"/>");
            base.owlControls.append(base.paginationWrapper);

            base.paginationWrapper.on("touchend.owlControls mouseup.owlControls", ".owl-page", function (event) {
                event.preventDefault();
                if (Number($(this).data("owl-page")) !== base.currentItem) {
                    base.goTo(Number($(this).data("owl-page")), true);
                }
            });
        },

        updatePagination : function () {
            var base = this,
                counter,
                lastPage,
                lastItem,
                i,
                paginationButton,
                paginationButtonInner;

            if (base.options.pagination === false) {
                return false;
            }

            base.paginationWrapper.html("");

            counter = 0;
            lastPage = base.itemsAmount - base.itemsAmount % base.options.items;

            for (i = 0; i < base.itemsAmount; i += 1) {
                if (i % base.options.items === 0) {
                    counter += 1;
                    if (lastPage === i) {
                        lastItem = base.itemsAmount - base.options.items;
                    }
                    paginationButton = $("<div/>", {
                        "class" : "owl-page"
                    });
                    paginationButtonInner = $("<span></span>", {
                        "text": base.options.paginationNumbers === true ? counter : "",
                        "class": base.options.paginationNumbers === true ? "owl-numbers" : ""
                    });
                    paginationButton.append(paginationButtonInner);

                    paginationButton.data("owl-page", lastPage === i ? lastItem : i);
                    paginationButton.data("owl-roundPages", counter);

                    base.paginationWrapper.append(paginationButton);
                }
            }
            base.checkPagination();
        },
        checkPagination : function () {
            var base = this;
            if (base.options.pagination === false) {
                return false;
            }
            base.paginationWrapper.find(".owl-page").each(function () {
                if ($(this).data("owl-roundPages") === $(base.$owlItems[base.currentItem]).data("owl-roundPages")) {
                    base.paginationWrapper
                        .find(".owl-page")
                        .removeClass("active");
                    $(this).addClass("active");
                }
            });
        },

        checkNavigation : function () {
            var base = this;

            if (base.options.navigation === false) {
                return false;
            }
            if (base.options.rewindNav === false) {
                if (base.currentItem === 0 && base.maximumItem === 0) {
                    base.buttonPrev.addClass("disabled");
                    base.buttonNext.addClass("disabled");
                } else if (base.currentItem === 0 && base.maximumItem !== 0) {
                    base.buttonPrev.addClass("disabled");
                    base.buttonNext.removeClass("disabled");
                } else if (base.currentItem === base.maximumItem) {
                    base.buttonPrev.removeClass("disabled");
                    base.buttonNext.addClass("disabled");
                } else if (base.currentItem !== 0 && base.currentItem !== base.maximumItem) {
                    base.buttonPrev.removeClass("disabled");
                    base.buttonNext.removeClass("disabled");
                }
            }
        },

        updateControls : function () {
            var base = this;
            base.updatePagination();
            base.checkNavigation();
            if (base.owlControls) {
                if (base.options.items >= base.itemsAmount) {
                    base.owlControls.hide();
                } else {
                    base.owlControls.show();
                }
            }
        },

        destroyControls : function () {
            var base = this;
            if (base.owlControls) {
                base.owlControls.remove();
            }
        },

        next : function (speed) {
            var base = this;

            if (base.isTransition) {
                return false;
            }

            base.currentItem += base.options.scrollPerPage === true ? base.options.items : 1;
            if (base.currentItem > base.maximumItem + (base.options.scrollPerPage === true ? (base.options.items - 1) : 0)) {
                if (base.options.rewindNav === true) {
                    base.currentItem = 0;
                    speed = "rewind";
                } else {
                    base.currentItem = base.maximumItem;
                    return false;
                }
            }
            base.goTo(base.currentItem, speed);
        },

        prev : function (speed) {
            var base = this;

            if (base.isTransition) {
                return false;
            }

            if (base.options.scrollPerPage === true && base.currentItem > 0 && base.currentItem < base.options.items) {
                base.currentItem = 0;
            } else {
                base.currentItem -= base.options.scrollPerPage === true ? base.options.items : 1;
            }
            if (base.currentItem < 0) {
                if (base.options.rewindNav === true) {
                    base.currentItem = base.maximumItem;
                    speed = "rewind";
                } else {
                    base.currentItem = 0;
                    return false;
                }
            }
            base.goTo(base.currentItem, speed);
        },

        goTo : function (position, speed, drag) {
            var base = this,
                goToPixel;

            if (base.isTransition) {
                return false;
            }
            if (typeof base.options.beforeMove === "function") {
                base.options.beforeMove.apply(this, [base.$elem]);
            }
            if (position >= base.maximumItem) {
                position = base.maximumItem;
            } else if (position <= 0) {
                position = 0;
            }

            base.currentItem = base.owl.currentItem = position;
            if (base.options.transitionStyle !== false && drag !== "drag" && base.options.items === 1 && base.browser.support3d === true) {
                base.swapSpeed(0);
                if (base.browser.support3d === true) {
                    base.transition3d(base.positionsInArray[position]);
                } else {
                    base.css2slide(base.positionsInArray[position], 1);
                }
                base.afterGo();
                base.singleItemTransition();
                return false;
            }
            goToPixel = base.positionsInArray[position];

            if (base.browser.support3d === true) {
                base.isCss3Finish = false;

                if (speed === true) {
                    base.swapSpeed("paginationSpeed");
                    window.setTimeout(function () {
                        base.isCss3Finish = true;
                    }, base.options.paginationSpeed);

                } else if (speed === "rewind") {
                    base.swapSpeed(base.options.rewindSpeed);
                    window.setTimeout(function () {
                        base.isCss3Finish = true;
                    }, base.options.rewindSpeed);

                } else {
                    base.swapSpeed("slideSpeed");
                    window.setTimeout(function () {
                        base.isCss3Finish = true;
                    }, base.options.slideSpeed);
                }
                base.transition3d(goToPixel);
            } else {
                if (speed === true) {
                    base.css2slide(goToPixel, base.options.paginationSpeed);
                } else if (speed === "rewind") {
                    base.css2slide(goToPixel, base.options.rewindSpeed);
                } else {
                    base.css2slide(goToPixel, base.options.slideSpeed);
                }
            }
            base.afterGo();
        },

        jumpTo : function (position) {
            var base = this;
            if (typeof base.options.beforeMove === "function") {
                base.options.beforeMove.apply(this, [base.$elem]);
            }
            if (position >= base.maximumItem || position === -1) {
                position = base.maximumItem;
            } else if (position <= 0) {
                position = 0;
            }
            base.swapSpeed(0);
            if (base.browser.support3d === true) {
                base.transition3d(base.positionsInArray[position]);
            } else {
                base.css2slide(base.positionsInArray[position], 1);
            }
            base.currentItem = base.owl.currentItem = position;
            base.afterGo();
        },

        afterGo : function () {
            var base = this;

            base.prevArr.push(base.currentItem);
            base.prevItem = base.owl.prevItem = base.prevArr[base.prevArr.length - 2];
            base.prevArr.shift(0);

            if (base.prevItem !== base.currentItem) {
                base.checkPagination();
                base.checkNavigation();
                base.eachMoveUpdate();

                if (base.options.autoPlay !== false) {
                    base.checkAp();
                }
            }
            if (typeof base.options.afterMove === "function" && base.prevItem !== base.currentItem) {
                base.options.afterMove.apply(this, [base.$elem]);
            }
        },

        stop : function () {
            var base = this;
            base.apStatus = "stop";
            window.clearInterval(base.autoPlayInterval);
        },

        checkAp : function () {
            var base = this;
            if (base.apStatus !== "stop") {
                base.play();
            }
        },

        play : function () {
            var base = this;
            base.apStatus = "play";
            if (base.options.autoPlay === false) {
                return false;
            }
            window.clearInterval(base.autoPlayInterval);
            base.autoPlayInterval = window.setInterval(function () {
                base.next(true);
            }, base.options.autoPlay);
        },

        swapSpeed : function (action) {
            var base = this;
            if (action === "slideSpeed") {
                base.$owlWrapper.css(base.addCssSpeed(base.options.slideSpeed));
            } else if (action === "paginationSpeed") {
                base.$owlWrapper.css(base.addCssSpeed(base.options.paginationSpeed));
            } else if (typeof action !== "string") {
                base.$owlWrapper.css(base.addCssSpeed(action));
            }
        },

        addCssSpeed : function (speed) {
            return {
                "-webkit-transition": "all " + speed + "ms ease",
                "-moz-transition": "all " + speed + "ms ease",
                "-o-transition": "all " + speed + "ms ease",
                "transition": "all " + speed + "ms ease"
            };
        },

        removeTransition : function () {
            return {
                "-webkit-transition": "",
                "-moz-transition": "",
                "-o-transition": "",
                "transition": ""
            };
        },

        doTranslate : function (pixels) {
            return {
                "-webkit-transform": "translate3d(" + pixels + "px, 0px, 0px)",
                "-moz-transform": "translate3d(" + pixels + "px, 0px, 0px)",
                "-o-transform": "translate3d(" + pixels + "px, 0px, 0px)",
                "-ms-transform": "translate3d(" + pixels + "px, 0px, 0px)",
                "transform": "translate3d(" + pixels + "px, 0px,0px)"
            };
        },

        transition3d : function (value) {
            var base = this;
            base.$owlWrapper.css(base.doTranslate(value));
        },

        css2move : function (value) {
            var base = this;
            base.$owlWrapper.css({"left" : value});
        },

        css2slide : function (value, speed) {
            var base = this;

            base.isCssFinish = false;
            base.$owlWrapper.stop(true, true).animate({
                "left" : value
            }, {
                duration : speed || base.options.slideSpeed,
                complete : function () {
                    base.isCssFinish = true;
                }
            });
        },

        checkBrowser : function () {
            var base = this,
                translate3D = "translate3d(0px, 0px, 0px)",
                tempElem = document.createElement("div"),
                regex,
                asSupport,
                support3d,
                isTouch;

            tempElem.style.cssText = "  -moz-transform:" + translate3D +
                                  "; -ms-transform:"     + translate3D +
                                  "; -o-transform:"      + translate3D +
                                  "; -webkit-transform:" + translate3D +
                                  "; transform:"         + translate3D;
            regex = /translate3d\(0px, 0px, 0px\)/g;
            asSupport = tempElem.style.cssText.match(regex);
            support3d = (asSupport !== null && asSupport.length === 1);

            isTouch = "ontouchstart" in window || window.navigator.msMaxTouchPoints;

            base.browser = {
                "support3d" : support3d,
                "isTouch" : isTouch
            };
        },

        moveEvents : function () {
            var base = this;
            if (base.options.mouseDrag !== false || base.options.touchDrag !== false) {
                base.gestures();
                base.disabledEvents();
            }
        },

        eventTypes : function () {
            var base = this,
                types = ["s", "e", "x"];

            base.ev_types = {};

            if (base.options.mouseDrag === true && base.options.touchDrag === true) {
                types = [
                    "touchstart.owl mousedown.owl",
                    "touchmove.owl mousemove.owl",
                    "touchend.owl touchcancel.owl mouseup.owl"
                ];
            } else if (base.options.mouseDrag === false && base.options.touchDrag === true) {
                types = [
                    "touchstart.owl",
                    "touchmove.owl",
                    "touchend.owl touchcancel.owl"
                ];
            } else if (base.options.mouseDrag === true && base.options.touchDrag === false) {
                types = [
                    "mousedown.owl",
                    "mousemove.owl",
                    "mouseup.owl"
                ];
            }

            base.ev_types.start = types[0];
            base.ev_types.move = types[1];
            base.ev_types.end = types[2];
        },

        disabledEvents :  function () {
            var base = this;
            base.$elem.on("dragstart.owl", function (event) { event.preventDefault(); });
            base.$elem.on("mousedown.disableTextSelect", function (e) {
                return $(e.target).is('input, textarea, select, option');
            });
        },

        gestures : function () {
            /*jslint unparam: true*/
            var base = this,
                locals = {
                    offsetX : 0,
                    offsetY : 0,
                    baseElWidth : 0,
                    relativePos : 0,
                    position: null,
                    minSwipe : null,
                    maxSwipe: null,
                    sliding : null,
                    dargging: null,
                    targetElement : null
                };

            base.isCssFinish = true;

            function getTouches(event) {
                if (event.touches !== undefined) {
                    return {
                        x : event.touches[0].pageX,
                        y : event.touches[0].pageY
                    };
                }

                if (event.touches === undefined) {
                    if (event.pageX !== undefined) {
                        return {
                            x : event.pageX,
                            y : event.pageY
                        };
                    }
                    if (event.pageX === undefined) {
                        return {
                            x : event.clientX,
                            y : event.clientY
                        };
                    }
                }
            }

            function swapEvents(type) {
                if (type === "on") {
                    $(document).on(base.ev_types.move, dragMove);
                    $(document).on(base.ev_types.end, dragEnd);
                } else if (type === "off") {
                    $(document).off(base.ev_types.move);
                    $(document).off(base.ev_types.end);
                }
            }

            function dragStart(event) {
                var ev = event.originalEvent || event || window.event,
                    position;

                if (ev.which === 3) {
                    return false;
                }
                if (base.itemsAmount <= base.options.items) {
                    return;
                }
                if (base.isCssFinish === false && !base.options.dragBeforeAnimFinish) {
                    return false;
                }
                if (base.isCss3Finish === false && !base.options.dragBeforeAnimFinish) {
                    return false;
                }

                if (base.options.autoPlay !== false) {
                    window.clearInterval(base.autoPlayInterval);
                }

                if (base.browser.isTouch !== true && !base.$owlWrapper.hasClass("grabbing")) {
                    base.$owlWrapper.addClass("grabbing");
                }

                base.newPosX = 0;
                base.newRelativeX = 0;

                $(this).css(base.removeTransition());

                position = $(this).position();
                locals.relativePos = position.left;

                locals.offsetX = getTouches(ev).x - position.left;
                locals.offsetY = getTouches(ev).y - position.top;

                swapEvents("on");

                locals.sliding = false;
                locals.targetElement = ev.target || ev.srcElement;
            }

            function dragMove(event) {
                var ev = event.originalEvent || event || window.event,
                    minSwipe,
                    maxSwipe;

                base.newPosX = getTouches(ev).x - locals.offsetX;
                base.newPosY = getTouches(ev).y - locals.offsetY;
                base.newRelativeX = base.newPosX - locals.relativePos;

                if (typeof base.options.startDragging === "function" && locals.dragging !== true && base.newRelativeX !== 0) {
                    locals.dragging = true;
                    base.options.startDragging.apply(base, [base.$elem]);
                }

                if ((base.newRelativeX > 8 || base.newRelativeX < -8) && (base.browser.isTouch === true)) {
                    if (ev.preventDefault !== undefined) {
                        ev.preventDefault();
                    } else {
                        ev.returnValue = false;
                    }
                    locals.sliding = true;
                }

                if ((base.newPosY > 10 || base.newPosY < -10) && locals.sliding === false) {
                    $(document).off("touchmove.owl");
                }

                minSwipe = function () {
                    return base.newRelativeX / 5;
                };

                maxSwipe = function () {
                    return base.maximumPixels + base.newRelativeX / 5;
                };

                base.newPosX = Math.max(Math.min(base.newPosX, minSwipe()), maxSwipe());
                if (base.browser.support3d === true) {
                    base.transition3d(base.newPosX);
                } else {
                    base.css2move(base.newPosX);
                }
            }

            function dragEnd(event) {
                var ev = event.originalEvent || event || window.event,
                    newPosition,
                    handlers,
                    owlStopEvent;

                ev.target = ev.target || ev.srcElement;

                locals.dragging = false;

                if (base.browser.isTouch !== true) {
                    base.$owlWrapper.removeClass("grabbing");
                }

                if (base.newRelativeX < 0) {
                    base.dragDirection = base.owl.dragDirection = "left";
                } else {
                    base.dragDirection = base.owl.dragDirection = "right";
                }

                if (base.newRelativeX !== 0) {
                    newPosition = base.getNewPosition();
                    base.goTo(newPosition, false, "drag");
                    if (locals.targetElement === ev.target && base.browser.isTouch !== true) {
                        $(ev.target).on("click.disable", function (ev) {
                            ev.stopImmediatePropagation();
                            ev.stopPropagation();
                            ev.preventDefault();
                            $(ev.target).off("click.disable");
                        });
                        handlers = $._data(ev.target, "events").click;
                        owlStopEvent = handlers.pop();
                        handlers.splice(0, 0, owlStopEvent);
                    }
                }
                swapEvents("off");
            }
            base.$elem.on(base.ev_types.start, ".owl-wrapper", dragStart);
        },

        getNewPosition : function () {
            var base = this,
                newPosition = base.closestItem();

            if (newPosition > base.maximumItem) {
                base.currentItem = base.maximumItem;
                newPosition  = base.maximumItem;
            } else if (base.newPosX >= 0) {
                newPosition = 0;
                base.currentItem = 0;
            }
            return newPosition;
        },
        closestItem : function () {
            var base = this,
                array = base.options.scrollPerPage === true ? base.pagesInArray : base.positionsInArray,
                goal = base.newPosX,
                closest = null;

            $.each(array, function (i, v) {
                if (goal - (base.itemWidth / 20) > array[i + 1] && goal - (base.itemWidth / 20) < v && base.moveDirection() === "left") {
                    closest = v;
                    if (base.options.scrollPerPage === true) {
                        base.currentItem = $.inArray(closest, base.positionsInArray);
                    } else {
                        base.currentItem = i;
                    }
                } else if (goal + (base.itemWidth / 20) < v && goal + (base.itemWidth / 20) > (array[i + 1] || array[i] - base.itemWidth) && base.moveDirection() === "right") {
                    if (base.options.scrollPerPage === true) {
                        closest = array[i + 1] || array[array.length - 1];
                        base.currentItem = $.inArray(closest, base.positionsInArray);
                    } else {
                        closest = array[i + 1];
                        base.currentItem = i + 1;
                    }
                }
            });
            return base.currentItem;
        },

        moveDirection : function () {
            var base = this,
                direction;
            if (base.newRelativeX < 0) {
                direction = "right";
                base.playDirection = "next";
            } else {
                direction = "left";
                base.playDirection = "prev";
            }
            return direction;
        },

        customEvents : function () {
            /*jslint unparam: true*/
            var base = this;
            base.$elem.on("owl.next", function () {
                base.next();
            });
            base.$elem.on("owl.prev", function () {
                base.prev();
            });
            base.$elem.on("owl.play", function (event, speed) {
                base.options.autoPlay = speed;
                base.play();
                base.hoverStatus = "play";
            });
            base.$elem.on("owl.stop", function () {
                base.stop();
                base.hoverStatus = "stop";
            });
            base.$elem.on("owl.goTo", function (event, item) {
                base.goTo(item);
            });
            base.$elem.on("owl.jumpTo", function (event, item) {
                base.jumpTo(item);
            });
        },

        stopOnHover : function () {
            var base = this;
            if (base.options.stopOnHover === true && base.browser.isTouch !== true && base.options.autoPlay !== false) {
                base.$elem.on("mouseover", function () {
                    base.stop();
                });
                base.$elem.on("mouseout", function () {
                    if (base.hoverStatus !== "stop") {
                        base.play();
                    }
                });
            }
        },

        lazyLoad : function () {
            var base = this,
                i,
                $item,
                itemNumber,
                $lazyImg,
                follow;

            if (base.options.lazyLoad === false) {
                return false;
            }
            for (i = 0; i < base.itemsAmount; i += 1) {
                $item = $(base.$owlItems[i]);

                if ($item.data("owl-loaded") === "loaded") {
                    continue;
                }

                itemNumber = $item.data("owl-item");
                $lazyImg = $item.find(".lazyOwl");

                if (typeof $lazyImg.data("src") !== "string") {
                    $item.data("owl-loaded", "loaded");
                    continue;
                }
                if ($item.data("owl-loaded") === undefined) {
                    $lazyImg.hide();
                    $item.addClass("loading").data("owl-loaded", "checked");
                }
                if (base.options.lazyFollow === true) {
                    follow = itemNumber >= base.currentItem;
                } else {
                    follow = true;
                }
                if (follow && itemNumber < base.currentItem + base.options.items && $lazyImg.length) {
                    base.lazyPreload($item, $lazyImg);
                }
            }
        },

        lazyPreload : function ($item, $lazyImg) {
            var base = this,
                iterations = 0,
                isBackgroundImg;

            if ($lazyImg.prop("tagName") === "DIV") {
                $lazyImg.css("background-image", "url(" + $lazyImg.data("src") + ")");
                isBackgroundImg = true;
            } else {
                $lazyImg[0].src = $lazyImg.data("src");
            }

            function showImage() {
                $item.data("owl-loaded", "loaded").removeClass("loading");
                $lazyImg.removeAttr("data-src");
                if (base.options.lazyEffect === "fade") {
                    $lazyImg.fadeIn(400);
                } else {
                    $lazyImg.show();
                }
                if (typeof base.options.afterLazyLoad === "function") {
                    base.options.afterLazyLoad.apply(this, [base.$elem]);
                }
            }

            function checkLazyImage() {
                iterations += 1;
                if (base.completeImg($lazyImg.get(0)) || isBackgroundImg === true) {
                    showImage();
                } else if (iterations <= 100) {//if image loads in less than 10 seconds 
                    window.setTimeout(checkLazyImage, 100);
                } else {
                    showImage();
                }
            }

            checkLazyImage();
        },

        autoHeight : function () {
            var base = this,
                $currentimg = $(base.$owlItems[base.currentItem]).find("img"),
                iterations;

            function addHeight() {
                var $currentItem = $(base.$owlItems[base.currentItem]).height();
                base.wrapperOuter.css("height", $currentItem + "px");
                if (!base.wrapperOuter.hasClass("autoHeight")) {
                    window.setTimeout(function () {
                        base.wrapperOuter.addClass("autoHeight");
                    }, 0);
                }
            }

            function checkImage() {
                iterations += 1;
                if (base.completeImg($currentimg.get(0))) {
                    addHeight();
                } else if (iterations <= 100) { //if image loads in less than 10 seconds 
                    window.setTimeout(checkImage, 100);
                } else {
                    base.wrapperOuter.css("height", ""); //Else remove height attribute
                }
            }

            if ($currentimg.get(0) !== undefined) {
                iterations = 0;
                checkImage();
            } else {
                addHeight();
            }
        },

        completeImg : function (img) {
            var naturalWidthType;

            if (!img.complete) {
                return false;
            }
            naturalWidthType = typeof img.naturalWidth;
            if (naturalWidthType !== "undefined" && img.naturalWidth === 0) {
                return false;
            }
            return true;
        },

        onVisibleItems : function () {
            var base = this,
                i;

            if (base.options.addClassActive === true) {
                base.$owlItems.removeClass("active");
            }
            base.visibleItems = [];
            for (i = base.currentItem; i < base.currentItem + base.options.items; i += 1) {
                base.visibleItems.push(i);

                if (base.options.addClassActive === true) {
                    $(base.$owlItems[i]).addClass("active");
                }
            }
            base.owl.visibleItems = base.visibleItems;
        },

        transitionTypes : function (className) {
            var base = this;
            //Currently available: "fade", "backSlide", "goDown", "fadeUp"
            base.outClass = "owl-" + className + "-out";
            base.inClass = "owl-" + className + "-in";
        },

        singleItemTransition : function () {
            var base = this,
                outClass = base.outClass,
                inClass = base.inClass,
                $currentItem = base.$owlItems.eq(base.currentItem),
                $prevItem = base.$owlItems.eq(base.prevItem),
                prevPos = Math.abs(base.positionsInArray[base.currentItem]) + base.positionsInArray[base.prevItem],
                origin = Math.abs(base.positionsInArray[base.currentItem]) + base.itemWidth / 2,
                animEnd = 'webkitAnimationEnd oAnimationEnd MSAnimationEnd animationend';

            base.isTransition = true;

            base.$owlWrapper
                .addClass('owl-origin')
                .css({
                    "-webkit-transform-origin" : origin + "px",
                    "-moz-perspective-origin" : origin + "px",
                    "perspective-origin" : origin + "px"
                });
            function transStyles(prevPos) {
                return {
                    "position" : "relative",
                    "left" : prevPos + "px"
                };
            }

            $prevItem
                .css(transStyles(prevPos, 10))
                .addClass(outClass)
                .on(animEnd, function () {
                    base.endPrev = true;
                    $prevItem.off(animEnd);
                    base.clearTransStyle($prevItem, outClass);
                });

            $currentItem
                .addClass(inClass)
                .on(animEnd, function () {
                    base.endCurrent = true;
                    $currentItem.off(animEnd);
                    base.clearTransStyle($currentItem, inClass);
                });
        },

        clearTransStyle : function (item, classToRemove) {
            var base = this;
            item.css({
                "position" : "",
                "left" : ""
            }).removeClass(classToRemove);

            if (base.endPrev && base.endCurrent) {
                base.$owlWrapper.removeClass('owl-origin');
                base.endPrev = false;
                base.endCurrent = false;
                base.isTransition = false;
            }
        },

        owlStatus : function () {
            var base = this;
            base.owl = {
                "userOptions"   : base.userOptions,
                "baseElement"   : base.$elem,
                "userItems"     : base.$userItems,
                "owlItems"      : base.$owlItems,
                "currentItem"   : base.currentItem,
                "prevItem"      : base.prevItem,
                "visibleItems"  : base.visibleItems,
                "isTouch"       : base.browser.isTouch,
                "browser"       : base.browser,
                "dragDirection" : base.dragDirection
            };
        },

        clearEvents : function () {
            var base = this;
            base.$elem.off(".owl owl mousedown.disableTextSelect");
            $(document).off(".owl owl");
            $(window).off("resize", base.resizer);
        },

        unWrap : function () {
            var base = this;
            if (base.$elem.children().length !== 0) {
                base.$owlWrapper.unwrap();
                base.$userItems.unwrap().unwrap();
                if (base.owlControls) {
                    base.owlControls.remove();
                }
            }
            base.clearEvents();
            base.$elem
                .attr("style", base.$elem.data("owl-originalStyles") || "")
                .attr("class", base.$elem.data("owl-originalClasses"));
        },

        destroy : function () {
            var base = this;
            base.stop();
            window.clearInterval(base.checkVisible);
            base.unWrap();
            base.$elem.removeData();
        },

        reinit : function (newOptions) {
            var base = this,
                options = $.extend({}, base.userOptions, newOptions);
            base.unWrap();
            base.init(options, base.$elem);
        },

        addItem : function (htmlString, targetPosition) {
            var base = this,
                position;

            if (!htmlString) {return false; }

            if (base.$elem.children().length === 0) {
                base.$elem.append(htmlString);
                base.setVars();
                return false;
            }
            base.unWrap();
            if (targetPosition === undefined || targetPosition === -1) {
                position = -1;
            } else {
                position = targetPosition;
            }
            if (position >= base.$userItems.length || position === -1) {
                base.$userItems.eq(-1).after(htmlString);
            } else {
                base.$userItems.eq(position).before(htmlString);
            }

            base.setVars();
        },

        removeItem : function (targetPosition) {
            var base = this,
                position;

            if (base.$elem.children().length === 0) {
                return false;
            }
            if (targetPosition === undefined || targetPosition === -1) {
                position = -1;
            } else {
                position = targetPosition;
            }

            base.unWrap();
            base.$userItems.eq(position).remove();
            base.setVars();
        }

    };

    $.fn.owlCarousel = function (options) {
        return this.each(function () {
            if ($(this).data("owl-init") === true) {
                return false;
            }
            $(this).data("owl-init", true);
            var carousel = Object.create(Carousel);
            carousel.init(options, this);
            $.data(this, "owlCarousel", carousel);
        });
    };

    $.fn.owlCarousel.options = {

        items : 4,
        itemsCustom : false,
        itemsDesktop : [1199, 4],
        itemsDesktopSmall : [979, 3],
        itemsTablet : [768, 2],
        itemsTabletSmall : false,
        itemsMobile : [479, 1],
        singleItem : false,
        itemsScaleUp : false,

        slideSpeed : 800,
        paginationSpeed : 800,
        rewindSpeed : 1500,

        autoPlay : true,
        stopOnHover : true,

        navigation : false,
        navigationText : ["prev", "next"],
        rewindNav : true,
        scrollPerPage : false,

        pagination : false,
        paginationNumbers : false,

        responsive : true,
        responsiveRefreshRate : 200,
        responsiveBaseWidth : window,

        baseClass : "owl-carousel",
        theme : "owl-theme",

        lazyLoad : false,
        lazyFollow : true,
        lazyEffect : "fade",

        autoHeight : false,

        jsonPath : false,
        jsonSuccess : false,

        dragBeforeAnimFinish : true,
        mouseDrag : true,
        touchDrag : true,

        addClassActive : false,
        transitionStyle : false,

        beforeUpdate : false,
        afterUpdate : false,
        beforeInit : false,
        afterInit : false,
        beforeMove : false,
        afterMove : false,
        afterAction : false,
        startDragging : false,
        afterLazyLoad: false
    };
}(jQuery, window, document));




/* Auto Count js Plugins */

/**
* jQuery scroroller Plugin 1.0
*
* http://www.tinywall.net/
* 
* Developers: Arun David, Boobalan
* Copyright (c) 2014 
*/
(function($){
    $(window).on("load",function(){
        $(document).scrollzipInit();
        $(document).rollerInit();
    });
    $(window).on("load scroll resize", function(){
        $('.numscroller').scrollzip({
            showFunction    :   function() {
                                    numberRoller($(this).attr('data-slno'));
                                },
            wholeVisible    :     false,
        });
    });
    $.fn.scrollzipInit=function(){
        $('body').prepend("<div style='position:fixed;top:0px;left:0px;width:0;height:0;' id='scrollzipPoint'></div>" );
    };
    $.fn.rollerInit=function(){
        var i=0;
        $('.numscroller').each(function() {
            i++;
           $(this).attr('data-slno',i); 
           $(this).addClass("roller-title-number-"+i);
        });        
    };
    $.fn.scrollzip = function(options){
        var settings = $.extend({
            showFunction    : null,
            hideFunction    : null,
            showShift       : 0,
            wholeVisible    : false,
            hideShift       : 0,
        }, options);
        return this.each(function(i,obj){
            $(this).addClass('scrollzip');
            if ( $.isFunction( settings.showFunction ) ){
                if(
                    !$(this).hasClass('isShown')&&
                    ($(window).outerHeight()+$('#scrollzipPoint').offset().top-settings.showShift)>($(this).offset().top+((settings.wholeVisible)?$(this).outerHeight():0))&&
                    ($('#scrollzipPoint').offset().top+((settings.wholeVisible)?$(this).outerHeight():0))<($(this).outerHeight()+$(this).offset().top-settings.showShift)
                ){
                    $(this).addClass('isShown');
                    settings.showFunction.call( this );
                }
            }
            if ( $.isFunction( settings.hideFunction ) ){
                if(
                    $(this).hasClass('isShown')&&
                    (($(window).outerHeight()+$('#scrollzipPoint').offset().top-settings.hideShift)<($(this).offset().top+((settings.wholeVisible)?$(this).outerHeight():0))||
                    ($('#scrollzipPoint').offset().top+((settings.wholeVisible)?$(this).outerHeight():0))>($(this).outerHeight()+$(this).offset().top-settings.hideShift))
                ){
                    $(this).removeClass('isShown');
                    settings.hideFunction.call( this );
                }
            }
            return this;
        });
    };
    function numberRoller(slno){
            var min=$('.roller-title-number-'+slno).attr('data-min');
            var max=$('.roller-title-number-'+slno).attr('data-max');
            var timediff=$('.roller-title-number-'+slno).attr('data-delay');
            var increment=$('.roller-title-number-'+slno).attr('data-increment');
            var numdiff=max-min;
            var timeout=(timediff*1000)/numdiff;
            //if(numinc<10){
                //increment=Math.floor((timediff*1000)/10);
            //}//alert(increment);
            numberRoll(slno,min,max,increment,timeout);
            
    }
    function numberRoll(slno,min,max,increment,timeout){//alert(slno+"="+min+"="+max+"="+increment+"="+timeout);
        if(min<=max){
            $('.roller-title-number-'+slno).html(min);
            min=parseInt(min)+parseInt(increment);
            setTimeout(function(){numberRoll(eval(slno),eval(min),eval(max),eval(increment),eval(timeout))},timeout);
        }else{
            $('.roller-title-number-'+slno).html(max);
        }
    }
})(jQuery);





/*------------------------------
 SmoothScroll
 (for Mouse Wheel)
  v1.2.1
 ----------------------*/

(function ($) {var defaultOptions = {frameRate: 150, animationTime: 800, stepSize: 120, pulseAlgorithm: !0, pulseScale: 8, pulseNormalize: 1, accelerationDelta: 20, accelerationMax: 1 }, options = defaultOptions, direction = {x: 0, y: 0 }, root = 0 <= document.compatMode.indexOf("CSS") || !document.body ? document.documentElement : document.body, que = [], pending = !1, lastScroll = +new Date; function scrollArray(a, b, c, d) {d || (d = 1E3); directionCheck(b, c); if (1 != options.accelerationMax) {var e = +new Date - lastScroll; e < options.accelerationDelta && (e = (1 + 30 / e) / 2, 1 < e && (e = Math.min(e, options.accelerationMax), b *= e, c *= e)); lastScroll = +new Date } que.push({x: b, y: c, lastX: 0 > b ? 0.99 : -0.99, lastY: 0 > c ? 0.99 : -0.99, start: +new Date }); if (!pending) {var q = a === document.body, p = function (e) {e = +new Date; for (var h = 0, k = 0, l = 0; l < que.length; l++) {var f = que[l], m = e - f.start, n = m >= options.animationTime, g = n ? 1 : m / options.animationTime; options.pulseAlgorithm && (g = pulse(g)); m = f.x * g - f.lastX >> 0; g = f.y * g - f.lastY >> 0; h += m; k += g; f.lastX += m; f.lastY += g; n && (que.splice(l, 1), l--) } q ? window.scrollBy(h, k) : (h && (a.scrollLeft += h), k && (a.scrollTop += k)); b || c || (que = []); que.length ? requestFrame(p, a, d / options.frameRate + 1) : pending = !1 }; requestFrame(p, a, 0); pending = !0 } } function wheel(a) {var b = overflowingAncestor(a.target); if (!b || a.defaultPrevented) return !0; var c = a.wheelDeltaX || 0, d = a.wheelDeltaY || 0; c || d || (d = a.wheelDelta || 0); 1.2 < Math.abs(c) && (c *= options.stepSize / 120); 1.2 < Math.abs(d) && (d *= options.stepSize / 120); scrollArray(b, -c, -d); a.preventDefault() } var cache = {}; setInterval(function () {cache = {} }, 1E4); var uniqueID = function () {var a = 0; return function (b) {return b.uniqueID || (b.uniqueID = a++) } }(); function setCache(a, b) {for (var c = a.length; c--;) cache[uniqueID(a[c])] = b; return b } function overflowingAncestor(a) {var b = [], c = root.scrollHeight; do {var d = cache[uniqueID(a)]; if (d) return setCache(b, d); b.push(a); if (c === a.scrollHeight) {if (root.clientHeight + 10 < c) return setCache(b, document.body) } else if (a.clientHeight + 10 < a.scrollHeight && (overflow = getComputedStyle(a, "").getPropertyValue("overflow-y"), "scroll" === overflow || "auto" === overflow)) return setCache(b, a) } while (a = a.parentNode) } function directionCheck(a, b) {a = 0 < a ? 1 : -1; b = 0 < b ? 1 : -1; if (direction.x !== a || direction.y !== b) direction.x = a, direction.y = b, que = [], lastScroll = 0 } var requestFrame = function () {return window.requestAnimationFrame || window.webkitRequestAnimationFrame || function (a, b, c) {window.setTimeout(a, c || 1E3 / 60) } }(); function pulse_(a) {var b; a *= options.pulseScale; 1 > a ? b = a - (1 - Math.exp(-a)) : (b = Math.exp(-1), a = 1 - Math.exp(-(a - 1)), b += a * (1 - b)); return b * options.pulseNormalize } function pulse(a) {if (1 <= a) return 1; if (0 >= a) return 0; 1 == options.pulseNormalize && (options.pulseNormalize /= pulse_(1)); return pulse_(a) } window.addEventListener("mousewheel", wheel, !1); })();





/* Parallax jQuery */

/*!
 * Stellar.js v0.6.2
 * http://markdalgleish.com/projects/stellar.js
 * 
 * Copyright 2013, Mark Dalgleish
 * This content is released under the MIT license
 * http://markdalgleish.mit-license.org
 */

;(function($, window, document, undefined) {

    var pluginName = 'stellar',
        defaults = {
            scrollProperty: 'scroll',
            positionProperty: 'position',
            horizontalScrolling: true,
            verticalScrolling: true,
            horizontalOffset: 0,
            verticalOffset: 0,
            responsive: false,
            parallaxBackgrounds: true,
            parallaxElements: true,
            hideDistantElements: true,
            hideElement: function($elem) { $elem.hide(); },
            showElement: function($elem) { $elem.show(); }
        },

        scrollProperty = {
            scroll: {
                getLeft: function($elem) { return $elem.scrollLeft(); },
                setLeft: function($elem, val) { $elem.scrollLeft(val); },

                getTop: function($elem) { return $elem.scrollTop(); },
                setTop: function($elem, val) { $elem.scrollTop(val); }
            },
            position: {
                getLeft: function($elem) { return parseInt($elem.css('left'), 10) * -1; },
                getTop: function($elem) { return parseInt($elem.css('top'), 10) * -1; }
            },
            margin: {
                getLeft: function($elem) { return parseInt($elem.css('margin-left'), 10) * -1; },
                getTop: function($elem) { return parseInt($elem.css('margin-top'), 10) * -1; }
            },
            transform: {
                getLeft: function($elem) {
                    var computedTransform = getComputedStyle($elem[0])[prefixedTransform];
                    return (computedTransform !== 'none' ? parseInt(computedTransform.match(/(-?[0-9]+)/g)[4], 10) * -1 : 0);
                },
                getTop: function($elem) {
                    var computedTransform = getComputedStyle($elem[0])[prefixedTransform];
                    return (computedTransform !== 'none' ? parseInt(computedTransform.match(/(-?[0-9]+)/g)[5], 10) * -1 : 0);
                }
            }
        },

        positionProperty = {
            position: {
                setLeft: function($elem, left) { $elem.css('left', left); },
                setTop: function($elem, top) { $elem.css('top', top); }
            },
            transform: {
                setPosition: function($elem, left, startingLeft, top, startingTop) {
                    $elem[0].style[prefixedTransform] = 'translate3d(' + (left - startingLeft) + 'px, ' + (top - startingTop) + 'px, 0)';
                }
            }
        },

        // Returns a function which adds a vendor prefix to any CSS property name
        vendorPrefix = (function() {
            var prefixes = /^(Moz|Webkit|Khtml|O|ms|Icab)(?=[A-Z])/,
                style = $('script')[0].style,
                prefix = '',
                prop;

            for (prop in style) {
                if (prefixes.test(prop)) {
                    prefix = prop.match(prefixes)[0];
                    break;
                }
            }

            if ('WebkitOpacity' in style) { prefix = 'Webkit'; }
            if ('KhtmlOpacity' in style) { prefix = 'Khtml'; }

            return function(property) {
                return prefix + (prefix.length > 0 ? property.charAt(0).toUpperCase() + property.slice(1) : property);
            };
        }()),

        prefixedTransform = vendorPrefix('transform'),

        supportsBackgroundPositionXY = $('<div />', { style: 'background:#fff' }).css('background-position-x') !== undefined,

        setBackgroundPosition = (supportsBackgroundPositionXY ?
            function($elem, x, y) {
                $elem.css({
                    'background-position-x': x,
                    'background-position-y': y
                });
            } :
            function($elem, x, y) {
                $elem.css('background-position', x + ' ' + y);
            }
        ),

        getBackgroundPosition = (supportsBackgroundPositionXY ?
            function($elem) {
                return [
                    $elem.css('background-position-x'),
                    $elem.css('background-position-y')
                ];
            } :
            function($elem) {
                return $elem.css('background-position').split(' ');
            }
        ),

        requestAnimFrame = (
            window.requestAnimationFrame       ||
            window.webkitRequestAnimationFrame ||
            window.mozRequestAnimationFrame    ||
            window.oRequestAnimationFrame      ||
            window.msRequestAnimationFrame     ||
            function(callback) {
                setTimeout(callback, 1000 / 60);
            }
        );

    function Plugin(element, options) {
        this.element = element;
        this.options = $.extend({}, defaults, options);

        this._defaults = defaults;
        this._name = pluginName;

        this.init();
    }

    Plugin.prototype = {
        init: function() {
            this.options.name = pluginName + '_' + Math.floor(Math.random() * 1e9);

            this._defineElements();
            this._defineGetters();
            this._defineSetters();
            this._handleWindowLoadAndResize();
            this._detectViewport();

            this.refresh({ firstLoad: true });

            if (this.options.scrollProperty === 'scroll') {
                this._handleScrollEvent();
            } else {
                this._startAnimationLoop();
            }
        },
        _defineElements: function() {
            if (this.element === document.body) this.element = window;
            this.$scrollElement = $(this.element);
            this.$element = (this.element === window ? $('body') : this.$scrollElement);
            this.$viewportElement = (this.options.viewportElement !== undefined ? $(this.options.viewportElement) : (this.$scrollElement[0] === window || this.options.scrollProperty === 'scroll' ? this.$scrollElement : this.$scrollElement.parent()) );
        },
        _defineGetters: function() {
            var self = this,
                scrollPropertyAdapter = scrollProperty[self.options.scrollProperty];

            this._getScrollLeft = function() {
                return scrollPropertyAdapter.getLeft(self.$scrollElement);
            };

            this._getScrollTop = function() {
                return scrollPropertyAdapter.getTop(self.$scrollElement);
            };
        },
        _defineSetters: function() {
            var self = this,
                scrollPropertyAdapter = scrollProperty[self.options.scrollProperty],
                positionPropertyAdapter = positionProperty[self.options.positionProperty],
                setScrollLeft = scrollPropertyAdapter.setLeft,
                setScrollTop = scrollPropertyAdapter.setTop;

            this._setScrollLeft = (typeof setScrollLeft === 'function' ? function(val) {
                setScrollLeft(self.$scrollElement, val);
            } : $.noop);

            this._setScrollTop = (typeof setScrollTop === 'function' ? function(val) {
                setScrollTop(self.$scrollElement, val);
            } : $.noop);

            this._setPosition = positionPropertyAdapter.setPosition ||
                function($elem, left, startingLeft, top, startingTop) {
                    if (self.options.horizontalScrolling) {
                        positionPropertyAdapter.setLeft($elem, left, startingLeft);
                    }

                    if (self.options.verticalScrolling) {
                        positionPropertyAdapter.setTop($elem, top, startingTop);
                    }
                };
        },
        _handleWindowLoadAndResize: function() {
            var self = this,
                $window = $(window);

            if (self.options.responsive) {
                $window.bind('load.' + this.name, function() {
                    self.refresh();
                });
            }

            $window.bind('resize.' + this.name, function() {
                self._detectViewport();

                if (self.options.responsive) {
                    self.refresh();
                }
            });
        },
        refresh: function(options) {
            var self = this,
                oldLeft = self._getScrollLeft(),
                oldTop = self._getScrollTop();

            if (!options || !options.firstLoad) {
                this._reset();
            }

            this._setScrollLeft(0);
            this._setScrollTop(0);

            this._setOffsets();
            this._findParticles();
            this._findBackgrounds();

            // Fix for WebKit background rendering bug
            if (options && options.firstLoad && /WebKit/.test(navigator.userAgent)) {
                $(window).load(function() {
                    var oldLeft = self._getScrollLeft(),
                        oldTop = self._getScrollTop();

                    self._setScrollLeft(oldLeft + 1);
                    self._setScrollTop(oldTop + 1);

                    self._setScrollLeft(oldLeft);
                    self._setScrollTop(oldTop);
                });
            }

            this._setScrollLeft(oldLeft);
            this._setScrollTop(oldTop);
        },
        _detectViewport: function() {
            var viewportOffsets = this.$viewportElement.offset(),
                hasOffsets = viewportOffsets !== null && viewportOffsets !== undefined;

            this.viewportWidth = this.$viewportElement.width();
            this.viewportHeight = this.$viewportElement.height();

            this.viewportOffsetTop = (hasOffsets ? viewportOffsets.top : 0);
            this.viewportOffsetLeft = (hasOffsets ? viewportOffsets.left : 0);
        },
        _findParticles: function() {
            var self = this,
                scrollLeft = this._getScrollLeft(),
                scrollTop = this._getScrollTop();

            if (this.particles !== undefined) {
                for (var i = this.particles.length - 1; i >= 0; i--) {
                    this.particles[i].$element.data('stellar-elementIsActive', undefined);
                }
            }

            this.particles = [];

            if (!this.options.parallaxElements) return;

            this.$element.find('[data-stellar-ratio]').each(function(i) {
                var $this = $(this),
                    horizontalOffset,
                    verticalOffset,
                    positionLeft,
                    positionTop,
                    marginLeft,
                    marginTop,
                    $offsetParent,
                    offsetLeft,
                    offsetTop,
                    parentOffsetLeft = 0,
                    parentOffsetTop = 0,
                    tempParentOffsetLeft = 0,
                    tempParentOffsetTop = 0;

                // Ensure this element isn't already part of another scrolling element
                if (!$this.data('stellar-elementIsActive')) {
                    $this.data('stellar-elementIsActive', this);
                } else if ($this.data('stellar-elementIsActive') !== this) {
                    return;
                }

                self.options.showElement($this);

                // Save/restore the original top and left CSS values in case we refresh the particles or destroy the instance
                if (!$this.data('stellar-startingLeft')) {
                    $this.data('stellar-startingLeft', $this.css('left'));
                    $this.data('stellar-startingTop', $this.css('top'));
                } else {
                    $this.css('left', $this.data('stellar-startingLeft'));
                    $this.css('top', $this.data('stellar-startingTop'));
                }

                positionLeft = $this.position().left;
                positionTop = $this.position().top;

                // Catch-all for margin top/left properties (these evaluate to 'auto' in IE7 and IE8)
                marginLeft = ($this.css('margin-left') === 'auto') ? 0 : parseInt($this.css('margin-left'), 10);
                marginTop = ($this.css('margin-top') === 'auto') ? 0 : parseInt($this.css('margin-top'), 10);

                offsetLeft = $this.offset().left - marginLeft;
                offsetTop = $this.offset().top - marginTop;

                // Calculate the offset parent
                $this.parents().each(function() {
                    var $this = $(this);

                    if ($this.data('stellar-offset-parent') === true) {
                        parentOffsetLeft = tempParentOffsetLeft;
                        parentOffsetTop = tempParentOffsetTop;
                        $offsetParent = $this;

                        return false;
                    } else {
                        tempParentOffsetLeft += $this.position().left;
                        tempParentOffsetTop += $this.position().top;
                    }
                });

                // Detect the offsets
                horizontalOffset = ($this.data('stellar-horizontal-offset') !== undefined ? $this.data('stellar-horizontal-offset') : ($offsetParent !== undefined && $offsetParent.data('stellar-horizontal-offset') !== undefined ? $offsetParent.data('stellar-horizontal-offset') : self.horizontalOffset));
                verticalOffset = ($this.data('stellar-vertical-offset') !== undefined ? $this.data('stellar-vertical-offset') : ($offsetParent !== undefined && $offsetParent.data('stellar-vertical-offset') !== undefined ? $offsetParent.data('stellar-vertical-offset') : self.verticalOffset));

                // Add our object to the particles collection
                self.particles.push({
                    $element: $this,
                    $offsetParent: $offsetParent,
                    isFixed: $this.css('position') === 'fixed',
                    horizontalOffset: horizontalOffset,
                    verticalOffset: verticalOffset,
                    startingPositionLeft: positionLeft,
                    startingPositionTop: positionTop,
                    startingOffsetLeft: offsetLeft,
                    startingOffsetTop: offsetTop,
                    parentOffsetLeft: parentOffsetLeft,
                    parentOffsetTop: parentOffsetTop,
                    stellarRatio: ($this.data('stellar-ratio') !== undefined ? $this.data('stellar-ratio') : 1),
                    width: $this.outerWidth(true),
                    height: $this.outerHeight(true),
                    isHidden: false
                });
            });
        },
        _findBackgrounds: function() {
            var self = this,
                scrollLeft = this._getScrollLeft(),
                scrollTop = this._getScrollTop(),
                $backgroundElements;

            this.backgrounds = [];

            if (!this.options.parallaxBackgrounds) return;

            $backgroundElements = this.$element.find('[data-stellar-background-ratio]');

            if (this.$element.data('stellar-background-ratio')) {
                $backgroundElements = $backgroundElements.add(this.$element);
            }

            $backgroundElements.each(function() {
                var $this = $(this),
                    backgroundPosition = getBackgroundPosition($this),
                    horizontalOffset,
                    verticalOffset,
                    positionLeft,
                    positionTop,
                    marginLeft,
                    marginTop,
                    offsetLeft,
                    offsetTop,
                    $offsetParent,
                    parentOffsetLeft = 0,
                    parentOffsetTop = 0,
                    tempParentOffsetLeft = 0,
                    tempParentOffsetTop = 0;

                // Ensure this element isn't already part of another scrolling element
                if (!$this.data('stellar-backgroundIsActive')) {
                    $this.data('stellar-backgroundIsActive', this);
                } else if ($this.data('stellar-backgroundIsActive') !== this) {
                    return;
                }

                // Save/restore the original top and left CSS values in case we destroy the instance
                if (!$this.data('stellar-backgroundStartingLeft')) {
                    $this.data('stellar-backgroundStartingLeft', backgroundPosition[0]);
                    $this.data('stellar-backgroundStartingTop', backgroundPosition[1]);
                } else {
                    setBackgroundPosition($this, $this.data('stellar-backgroundStartingLeft'), $this.data('stellar-backgroundStartingTop'));
                }

                // Catch-all for margin top/left properties (these evaluate to 'auto' in IE7 and IE8)
                marginLeft = ($this.css('margin-left') === 'auto') ? 0 : parseInt($this.css('margin-left'), 10);
                marginTop = ($this.css('margin-top') === 'auto') ? 0 : parseInt($this.css('margin-top'), 10);

                offsetLeft = $this.offset().left - marginLeft - scrollLeft;
                offsetTop = $this.offset().top - marginTop - scrollTop;
                
                // Calculate the offset parent
                $this.parents().each(function() {
                    var $this = $(this);

                    if ($this.data('stellar-offset-parent') === true) {
                        parentOffsetLeft = tempParentOffsetLeft;
                        parentOffsetTop = tempParentOffsetTop;
                        $offsetParent = $this;

                        return false;
                    } else {
                        tempParentOffsetLeft += $this.position().left;
                        tempParentOffsetTop += $this.position().top;
                    }
                });

                // Detect the offsets
                horizontalOffset = ($this.data('stellar-horizontal-offset') !== undefined ? $this.data('stellar-horizontal-offset') : ($offsetParent !== undefined && $offsetParent.data('stellar-horizontal-offset') !== undefined ? $offsetParent.data('stellar-horizontal-offset') : self.horizontalOffset));
                verticalOffset = ($this.data('stellar-vertical-offset') !== undefined ? $this.data('stellar-vertical-offset') : ($offsetParent !== undefined && $offsetParent.data('stellar-vertical-offset') !== undefined ? $offsetParent.data('stellar-vertical-offset') : self.verticalOffset));

                self.backgrounds.push({
                    $element: $this,
                    $offsetParent: $offsetParent,
                    isFixed: $this.css('background-attachment') === 'fixed',
                    horizontalOffset: horizontalOffset,
                    verticalOffset: verticalOffset,
                    startingValueLeft: backgroundPosition[0],
                    startingValueTop: backgroundPosition[1],
                    startingBackgroundPositionLeft: (isNaN(parseInt(backgroundPosition[0], 10)) ? 0 : parseInt(backgroundPosition[0], 10)),
                    startingBackgroundPositionTop: (isNaN(parseInt(backgroundPosition[1], 10)) ? 0 : parseInt(backgroundPosition[1], 10)),
                    startingPositionLeft: $this.position().left,
                    startingPositionTop: $this.position().top,
                    startingOffsetLeft: offsetLeft,
                    startingOffsetTop: offsetTop,
                    parentOffsetLeft: parentOffsetLeft,
                    parentOffsetTop: parentOffsetTop,
                    stellarRatio: ($this.data('stellar-background-ratio') === undefined ? 1 : $this.data('stellar-background-ratio'))
                });
            });
        },
        _reset: function() {
            var particle,
                startingPositionLeft,
                startingPositionTop,
                background,
                i;

            for (i = this.particles.length - 1; i >= 0; i--) {
                particle = this.particles[i];
                startingPositionLeft = particle.$element.data('stellar-startingLeft');
                startingPositionTop = particle.$element.data('stellar-startingTop');

                this._setPosition(particle.$element, startingPositionLeft, startingPositionLeft, startingPositionTop, startingPositionTop);

                this.options.showElement(particle.$element);

                particle.$element.data('stellar-startingLeft', null).data('stellar-elementIsActive', null).data('stellar-backgroundIsActive', null);
            }

            for (i = this.backgrounds.length - 1; i >= 0; i--) {
                background = this.backgrounds[i];

                background.$element.data('stellar-backgroundStartingLeft', null).data('stellar-backgroundStartingTop', null);

                setBackgroundPosition(background.$element, background.startingValueLeft, background.startingValueTop);
            }
        },
        destroy: function() {
            this._reset();

            this.$scrollElement.unbind('resize.' + this.name).unbind('scroll.' + this.name);
            this._animationLoop = $.noop;

            $(window).unbind('load.' + this.name).unbind('resize.' + this.name);
        },
        _setOffsets: function() {
            var self = this,
                $window = $(window);

            $window.unbind('resize.horizontal-' + this.name).unbind('resize.vertical-' + this.name);

            if (typeof this.options.horizontalOffset === 'function') {
                this.horizontalOffset = this.options.horizontalOffset();
                $window.bind('resize.horizontal-' + this.name, function() {
                    self.horizontalOffset = self.options.horizontalOffset();
                });
            } else {
                this.horizontalOffset = this.options.horizontalOffset;
            }

            if (typeof this.options.verticalOffset === 'function') {
                this.verticalOffset = this.options.verticalOffset();
                $window.bind('resize.vertical-' + this.name, function() {
                    self.verticalOffset = self.options.verticalOffset();
                });
            } else {
                this.verticalOffset = this.options.verticalOffset;
            }
        },
        _repositionElements: function() {
            var scrollLeft = this._getScrollLeft(),
                scrollTop = this._getScrollTop(),
                horizontalOffset,
                verticalOffset,
                particle,
                fixedRatioOffset,
                background,
                bgLeft,
                bgTop,
                isVisibleVertical = true,
                isVisibleHorizontal = true,
                newPositionLeft,
                newPositionTop,
                newOffsetLeft,
                newOffsetTop,
                i;

            // First check that the scroll position or container size has changed
            if (this.currentScrollLeft === scrollLeft && this.currentScrollTop === scrollTop && this.currentWidth === this.viewportWidth && this.currentHeight === this.viewportHeight) {
                return;
            } else {
                this.currentScrollLeft = scrollLeft;
                this.currentScrollTop = scrollTop;
                this.currentWidth = this.viewportWidth;
                this.currentHeight = this.viewportHeight;
            }

            // Reposition elements
            for (i = this.particles.length - 1; i >= 0; i--) {
                particle = this.particles[i];

                fixedRatioOffset = (particle.isFixed ? 1 : 0);

                // Calculate position, then calculate what the particle's new offset will be (for visibility check)
                if (this.options.horizontalScrolling) {
                    newPositionLeft = (scrollLeft + particle.horizontalOffset + this.viewportOffsetLeft + particle.startingPositionLeft - particle.startingOffsetLeft + particle.parentOffsetLeft) * -(particle.stellarRatio + fixedRatioOffset - 1) + particle.startingPositionLeft;
                    newOffsetLeft = newPositionLeft - particle.startingPositionLeft + particle.startingOffsetLeft;
                } else {
                    newPositionLeft = particle.startingPositionLeft;
                    newOffsetLeft = particle.startingOffsetLeft;
                }

                if (this.options.verticalScrolling) {
                    newPositionTop = (scrollTop + particle.verticalOffset + this.viewportOffsetTop + particle.startingPositionTop - particle.startingOffsetTop + particle.parentOffsetTop) * -(particle.stellarRatio + fixedRatioOffset - 1) + particle.startingPositionTop;
                    newOffsetTop = newPositionTop - particle.startingPositionTop + particle.startingOffsetTop;
                } else {
                    newPositionTop = particle.startingPositionTop;
                    newOffsetTop = particle.startingOffsetTop;
                }

                // Check visibility
                if (this.options.hideDistantElements) {
                    isVisibleHorizontal = !this.options.horizontalScrolling || newOffsetLeft + particle.width > (particle.isFixed ? 0 : scrollLeft) && newOffsetLeft < (particle.isFixed ? 0 : scrollLeft) + this.viewportWidth + this.viewportOffsetLeft;
                    isVisibleVertical = !this.options.verticalScrolling || newOffsetTop + particle.height > (particle.isFixed ? 0 : scrollTop) && newOffsetTop < (particle.isFixed ? 0 : scrollTop) + this.viewportHeight + this.viewportOffsetTop;
                }

                if (isVisibleHorizontal && isVisibleVertical) {
                    if (particle.isHidden) {
                        this.options.showElement(particle.$element);
                        particle.isHidden = false;
                    }

                    this._setPosition(particle.$element, newPositionLeft, particle.startingPositionLeft, newPositionTop, particle.startingPositionTop);
                } else {
                    if (!particle.isHidden) {
                        this.options.hideElement(particle.$element);
                        particle.isHidden = true;
                    }
                }
            }

            // Reposition backgrounds
            for (i = this.backgrounds.length - 1; i >= 0; i--) {
                background = this.backgrounds[i];

                fixedRatioOffset = (background.isFixed ? 0 : 1);
                bgLeft = (this.options.horizontalScrolling ? (scrollLeft + background.horizontalOffset - this.viewportOffsetLeft - background.startingOffsetLeft + background.parentOffsetLeft - background.startingBackgroundPositionLeft) * (fixedRatioOffset - background.stellarRatio) + 'px' : background.startingValueLeft);
                bgTop = (this.options.verticalScrolling ? (scrollTop + background.verticalOffset - this.viewportOffsetTop - background.startingOffsetTop + background.parentOffsetTop - background.startingBackgroundPositionTop) * (fixedRatioOffset - background.stellarRatio) + 'px' : background.startingValueTop);

                setBackgroundPosition(background.$element, bgLeft, bgTop);
            }
        },
        _handleScrollEvent: function() {
            var self = this,
                ticking = false;

            var update = function() {
                self._repositionElements();
                ticking = false;
            };

            var requestTick = function() {
                if (!ticking) {
                    requestAnimFrame(update);
                    ticking = true;
                }
            };
            
            this.$scrollElement.bind('scroll.' + this.name, requestTick);
            requestTick();
        },
        _startAnimationLoop: function() {
            var self = this;

            this._animationLoop = function() {
                requestAnimFrame(self._animationLoop);
                self._repositionElements();
            };
            this._animationLoop();
        }
    };

    $.fn[pluginName] = function (options) {
        var args = arguments;
        if (options === undefined || typeof options === 'object') {
            return this.each(function () {
                if (!$.data(this, 'plugin_' + pluginName)) {
                    $.data(this, 'plugin_' + pluginName, new Plugin(this, options));
                }
            });
        } else if (typeof options === 'string' && options[0] !== '_' && options !== 'init') {
            return this.each(function () {
                var instance = $.data(this, 'plugin_' + pluginName);
                if (instance instanceof Plugin && typeof instance[options] === 'function') {
                    instance[options].apply(instance, Array.prototype.slice.call(args, 1));
                }
                if (options === 'destroy') {
                    $.data(this, 'plugin_' + pluginName, null);
                }
            });
        }
    };

    $[pluginName] = function(options) {
        var $window = $(window);
        return $window.stellar.apply($window, Array.prototype.slice.call(arguments, 0));
    };

    // Expose the scroll and position property function hashes so they can be extended
    $[pluginName].scrollProperty = scrollProperty;
    $[pluginName].positionProperty = positionProperty;

    // Expose the plugin class so it can be modified
    window.Stellar = Plugin;
}(jQuery, this, document));






/*! UIkit 2.1.0 | http://www.getuikit.com | (c) 2014 YOOtheme | MIT License */

(function(t,e,i){"use strict";var s=t.UIkit||{},o=t("html"),n=t(window);s.fn||(s.version="2.1.0",s.fn=function(e,i){var o=arguments,n=e.match(/^([a-z\-]+)(?:\.([a-z]+))?/i),a=n[1],r=n[2];return s[a]?this.each(function(){var e=t(this),n=e.data(a);n||e.data(a,n=new s[a](this,r?void 0:i)),r&&n[r].apply(n,Array.prototype.slice.call(o,1))}):(t.error("UIkit component ["+a+"] does not exist."),this)},s.support={},s.support.transition=function(){var t=function(){var t,i=e.body||e.documentElement,s={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd otransitionend",transition:"transitionend"};for(t in s)if(void 0!==i.style[t])return s[t]}();return t&&{end:t}}(),s.support.requestAnimationFrame=i.requestAnimationFrame||i.webkitRequestAnimationFrame||i.mozRequestAnimationFrame||i.msRequestAnimationFrame||i.oRequestAnimationFrame||function(t){i.setTimeout(t,1e3/60)},s.support.touch="ontouchstart"in window&&navigator.userAgent.toLowerCase().match(/mobile|tablet/)||i.DocumentTouch&&document instanceof i.DocumentTouch||i.navigator.msPointerEnabled&&i.navigator.msMaxTouchPoints>0||!1,s.support.mutationobserver=i.MutationObserver||i.WebKitMutationObserver||i.MozMutationObserver||null,s.Utils={},s.Utils.debounce=function(t,e,i){var s;return function(){var o=this,n=arguments,a=function(){s=null,i||t.apply(o,n)},r=i&&!s;clearTimeout(s),s=setTimeout(a,e),r&&t.apply(o,n)}},s.Utils.removeCssRules=function(t){var e,i,s,o,n,a,r,l,u,h;t&&setTimeout(function(){try{for(h=document.styleSheets,o=0,r=h.length;r>o;o++){for(s=h[o],i=[],s.cssRules=s.cssRules,e=n=0,l=s.cssRules.length;l>n;e=++n)s.cssRules[e].type===CSSRule.STYLE_RULE&&t.test(s.cssRules[e].selectorText)&&i.unshift(e);for(a=0,u=i.length;u>a;a++)s.deleteRule(i[a])}}catch(c){}},0)},s.Utils.isInView=function(e,i){var s=t(e);if(!s.is(":visible"))return!1;var o=n.scrollLeft(),a=n.scrollTop(),r=s.offset(),l=r.left,u=r.top;return i=t.extend({topoffset:0,leftoffset:0},i),u+s.height()>=a&&u-i.topoffset<=a+n.height()&&l+s.width()>=o&&l-i.leftoffset<=o+n.width()?!0:!1},s.Utils.options=function(e){if(t.isPlainObject(e))return e;var i=e?e.indexOf("{"):-1,s={};if(-1!=i)try{s=Function("","var json = "+e.substr(i)+"; return JSON.parse(JSON.stringify(json));")()}catch(o){}return s},s.Utils.events={},s.Utils.events.click=s.support.touch?"tap":"click",t.UIkit=s,t.fn.uk=s.fn,t.UIkit.langdirection="rtl"==o.attr("dir")?"right":"left",t(function(){if(t(e).trigger("uk-domready"),s.support.mutationobserver){var i=new s.support.mutationobserver(s.Utils.debounce(function(){t(e).trigger("uk-domready")},300));i.observe(document.body,{childList:!0,subtree:!0}),s.support.touch&&s.Utils.removeCssRules(/\.uk-(?!navbar).*:hover/)}}),o.addClass(s.support.touch?"uk-touch":"uk-notouch"))})(jQuery,document,window),function(t){function e(t,e,i,s){return Math.abs(t-e)>=Math.abs(i-s)?t-e>0?"Left":"Right":i-s>0?"Up":"Down"}function i(){u=null,c.last&&(c.el.trigger("longTap"),c={})}function s(){u&&clearTimeout(u),u=null}function o(){a&&clearTimeout(a),r&&clearTimeout(r),l&&clearTimeout(l),u&&clearTimeout(u),a=r=l=u=null,c={}}function n(t){return t.pointerType==t.MSPOINTER_TYPE_TOUCH&&t.isPrimary}var a,r,l,u,h,c={},d=750;t(function(){var f,p,m,g=0,v=0;"MSGesture"in window&&(h=new MSGesture,h.target=document.body),t(document).bind("MSGestureEnd",function(t){var e=t.originalEvent.velocityX>1?"Right":-1>t.originalEvent.velocityX?"Left":t.originalEvent.velocityY>1?"Down":-1>t.originalEvent.velocityY?"Up":null;e&&(c.el.trigger("swipe"),c.el.trigger("swipe"+e))}).on("touchstart MSPointerDown",function(e){("MSPointerDown"!=e.type||n(e.originalEvent))&&(m="MSPointerDown"==e.type?e:e.originalEvent.touches[0],f=Date.now(),p=f-(c.last||f),c.el=t("tagName"in m.target?m.target:m.target.parentNode),a&&clearTimeout(a),c.x1=m.pageX,c.y1=m.pageY,p>0&&250>=p&&(c.isDoubleTap=!0),c.last=f,u=setTimeout(i,d),h&&"MSPointerDown"==e.type&&h.addPointer(e.originalEvent.pointerId))}).on("touchmove MSPointerMove",function(t){("MSPointerMove"!=t.type||n(t.originalEvent))&&(m="MSPointerMove"==t.type?t:t.originalEvent.touches[0],s(),c.x2=m.pageX,c.y2=m.pageY,g+=Math.abs(c.x1-c.x2),v+=Math.abs(c.y1-c.y2))}).on("touchend MSPointerUp",function(i){("MSPointerUp"!=i.type||n(i.originalEvent))&&(s(),c.x2&&Math.abs(c.x1-c.x2)>30||c.y2&&Math.abs(c.y1-c.y2)>30?l=setTimeout(function(){c.el.trigger("swipe"),c.el.trigger("swipe"+e(c.x1,c.x2,c.y1,c.y2)),c={}},0):"last"in c&&(isNaN(g)||30>g&&30>v?r=setTimeout(function(){var e=t.Event("tap");e.cancelTouch=o,c.el.trigger(e),c.isDoubleTap?(c.el.trigger("doubleTap"),c={}):a=setTimeout(function(){a=null,c.el.trigger("singleTap"),c={}},250)},0):c={},g=v=0))}).on("touchcancel MSPointerCancel",o),t(window).on("scroll",o)}),["swipe","swipeLeft","swipeRight","swipeUp","swipeDown","doubleTap","tap","singleTap","longTap"].forEach(function(e){t.fn[e]=function(i){return t(this).on(e,i)}})}(jQuery),function(t,e){"use strict";var i=function(e,s){var o=this;this.options=t.extend({},i.defaults,s),this.element=t(e),this.element.data("alert")||(this.element.on("click",this.options.trigger,function(t){t.preventDefault(),o.close()}),this.element.data("alert",this))};t.extend(i.prototype,{close:function(){function t(){e.trigger("closed").remove()}var e=this.element.trigger("close");this.options.fade?e.css("overflow","hidden").css("max-height",e.height()).animate({height:0,opacity:0,"padding-top":0,"padding-bottom":0,"margin-top":0,"margin-bottom":0},this.options.duration,t):t()}}),i.defaults={fade:!0,duration:200,trigger:".uk-alert-close"},e.alert=i,t(document).on("click.alert.uikit","[data-uk-alert]",function(s){var o=t(this);if(!o.data("alert")){var n=new i(o,e.Utils.options(o.data("uk-alert")));t(s.target).is(o.data("alert").options.trigger)&&(s.preventDefault(),n.close())}})}(jQuery,jQuery.UIkit),function(t,e){"use strict";var i=function(e,s){var o=this,n=t(e);n.data("buttonRadio")||(this.options=t.extend({},i.defaults,s),this.element=n.on("click",this.options.target,function(e){e.preventDefault(),n.find(o.options.target).not(this).removeClass("uk-active").blur(),n.trigger("change",[t(this).addClass("uk-active")])}),this.element.data("buttonRadio",this))};t.extend(i.prototype,{getSelected:function(){this.element.find(".uk-active")}}),i.defaults={target:".uk-button"};var s=function(e,i){var o=t(e);o.data("buttonCheckbox")||(this.options=t.extend({},s.defaults,i),this.element=o.on("click",this.options.target,function(e){e.preventDefault(),o.trigger("change",[t(this).toggleClass("uk-active").blur()])}),this.element.data("buttonCheckbox",this))};t.extend(s.prototype,{getSelected:function(){this.element.find(".uk-active")}}),s.defaults={target:".uk-button"};var o=function(e,i){var s=this,n=t(e);n.data("button")||(this.options=t.extend({},o.defaults,i),this.element=n.on("click",function(t){t.preventDefault(),s.toggle(),n.trigger("change",[n.blur().hasClass("uk-active")])}),this.element.data("button",this))};t.extend(o.prototype,{options:{},toggle:function(){this.element.toggleClass("uk-active")}}),o.defaults={},e.button=o,e.buttonCheckbox=s,e.buttonRadio=i,t(document).on("click.buttonradio.uikit","[data-uk-button-radio]",function(s){var o=t(this);if(!o.data("buttonRadio")){var n=new i(o,e.Utils.options(o.attr("data-uk-button-radio")));t(s.target).is(n.options.target)&&t(s.target).trigger("click")}}),t(document).on("click.buttoncheckbox.uikit","[data-uk-button-checkbox]",function(i){var o=t(this);if(!o.data("buttonCheckbox")){var n=new s(o,e.Utils.options(o.attr("data-uk-button-checkbox")));t(i.target).is(n.options.target)&&t(i.target).trigger("click")}}),t(document).on("click.button.uikit","[data-uk-button]",function(){var e=t(this);e.data("button")||(new o(e,e.attr("data-uk-button")),e.trigger("click"))})}(jQuery,jQuery.UIkit),function(t,e){"use strict";var i=!1,s=function(o,n){var a=this,r=t(o);r.data("dropdown")||(this.options=t.extend({},s.defaults,n),this.element=r,this.dropdown=this.element.find(".uk-dropdown"),this.centered=this.dropdown.hasClass("uk-dropdown-center"),this.justified=this.options.justify?t(this.options.justify):!1,this.boundary=t(this.options.boundary),this.boundary.length||(this.boundary=t(window)),"click"==this.options.mode||e.support.touch?this.element.on("click",function(e){var s=t(e.target);s.parents(".uk-dropdown").length||((s.is("a[href='#']")||s.parent().is("a[href='#']"))&&e.preventDefault(),s.blur()),a.element.hasClass("uk-open")?(s.is("a")||!a.element.find(".uk-dropdown").find(e.target).length)&&(a.element.removeClass("uk-open"),i=!1):a.show()}):this.element.on("mouseenter",function(){a.remainIdle&&clearTimeout(a.remainIdle),a.show()}).on("mouseleave",function(){a.remainIdle=setTimeout(function(){a.element.removeClass("uk-open"),a.remainIdle=!1,i&&i[0]==a.element[0]&&(i=!1)},a.options.remaintime)}),this.element.data("dropdown",this))};t.extend(s.prototype,{remainIdle:!1,show:function(){i&&i[0]!=this.element[0]&&i.removeClass("uk-open"),this.checkDimensions(),this.element.addClass("uk-open"),i=this.element,this.registerOuterClick()},registerOuterClick:function(){var e=this;t(document).off("click.outer.dropdown"),setTimeout(function(){t(document).on("click.outer.dropdown",function(s){!i||i[0]!=e.element[0]||!t(s.target).is("a")&&e.element.find(".uk-dropdown").find(s.target).length||(i.removeClass("uk-open"),t(document).off("click.outer.dropdown"))})},10)},checkDimensions:function(){if(this.dropdown.length){var e=this.dropdown.css("margin-"+t.UIkit.langdirection,"").css("min-width",""),i=e.show().offset(),s=e.outerWidth(),o=this.boundary.width(),n=this.boundary.offset()?this.boundary.offset().left:0;if(this.centered&&(e.css("margin-"+t.UIkit.langdirection,-1*(parseFloat(s)/2-e.parent().width()/2)),i=e.offset(),(s+i.left>o||0>i.left)&&(e.css("margin-"+t.UIkit.langdirection,""),i=e.offset())),this.justified&&this.justified.length){var a=this.justified.outerWidth();if(e.css("min-width",a),"right"==t.UIkit.langdirection){var r=o-(this.justified.offset().left+a),l=o-(e.offset().left+e.outerWidth());e.css("margin-right",r-l)}else e.css("margin-left",this.justified.offset().left-i.left);i=e.offset()}s+(i.left-n)>o&&(e.addClass("uk-dropdown-flip"),i=e.offset()),0>i.left&&e.addClass("uk-dropdown-stack"),e.css("display","")}}}),s.defaults={mode:"hover",remaintime:800,justify:!1,boundary:t(window)},e.dropdown=s;var o=e.support.touch?"click":"mouseenter";t(document).on(o+".dropdown.uikit","[data-uk-dropdown]",function(i){var n=t(this);if(!n.data("dropdown")){var a=new s(n,e.Utils.options(n.data("uk-dropdown")));("click"==o||"mouseenter"==o&&"hover"==a.options.mode)&&a.show(),a.element.find(".uk-dropdown").length&&i.preventDefault()}})}(jQuery,jQuery.UIkit),function(t,e){"use strict";var i=t(window),s="resize orientationchange",o=function(n,a){var r=this,l=t(n);l.data("gridMatchHeight")||(this.options=t.extend({},o.defaults,a),this.element=l,this.columns=this.element.children(),this.elements=this.options.target?this.element.find(this.options.target):this.columns,this.columns.length&&(i.on(s,function(){var s=function(){r.match()};return t(function(){s(),i.on("load",s)}),e.Utils.debounce(s,150)}()),t(document).on("uk-domready",function(){r.columns=r.element.children(),r.elements=r.options.target?r.element.find(r.options.target):r.columns,r.match()}),this.element.data("gridMatch",this)))};t.extend(o.prototype,{match:function(){this.revert();var e=this.columns.filter(":visible:first");if(e.length){var i=Math.ceil(100*parseFloat(e.css("width"))/parseFloat(e.parent().css("width")))>=100?!0:!1,s=0,o=this;if(!i)return this.elements.each(function(){s=Math.max(s,t(this).outerHeight())}).each(function(e){var i=t(this),n="border-box"==i.css("box-sizing")?"outerHeight":"height",a=o.columns.eq(e),r=i.height()+(s-a[n]());i.css("min-height",r+"px")}),this}},revert:function(){return this.elements.css("min-height",""),this}}),o.defaults={target:!1};var n=function(o){var n=this,a=t(o);a.data("gridMargin")||(this.element=a,this.columns=this.element.children(),this.columns.length&&(i.on(s,function(){var s=function(){n.process()};return t(function(){s(),i.on("load",s)}),e.Utils.debounce(s,150)}()),t(document).on("uk-domready",function(){n.columns=n.element.children(),n.process()}),this.element.data("gridMargin",this)))};t.extend(n.prototype,{process:function(){this.revert();var e=!1,i=this.columns.filter(":visible:first"),s=i.length?i.offset().top:!1;if(s!==!1)return this.columns.each(function(){var i=t(this);i.is(":visible")&&(e?i.addClass("uk-grid-margin"):i.offset().top!=s&&(i.addClass("uk-grid-margin"),e=!0))}),this},revert:function(){return this.columns.removeClass("uk-grid-margin"),this}}),n.defaults={},e.gridMatch=o,e.gridMargin=n,t(document).on("uk-domready",function(){t("[data-uk-grid-match],[data-uk-grid-margin]").each(function(){var i,s=t(this);s.is("[data-uk-grid-match]")&&!s.data("gridMatch")&&(i=new o(s,e.Utils.options(s.attr("data-uk-grid-match")))),s.is("[data-uk-grid-margin]")&&!s.data("gridMargin")&&(i=new n(s,e.Utils.options(s.attr("data-uk-grid-margin"))))})})}(jQuery,jQuery.UIkit),function(t,e,i){"use strict";var s=!1,o=t("html"),n=function(i,s){var o=this;this.element=t(i),this.options=t.extend({},n.defaults,s),this.transition=e.support.transition,this.dialog=this.element.find(".uk-modal-dialog"),this.element.on("click",".uk-modal-close",function(t){t.preventDefault(),o.hide()}).on("click",function(e){var i=t(e.target);i[0]==o.element[0]&&o.options.bgclose&&o.hide()})};t.extend(n.prototype,{transition:!1,toggle:function(){this[this.isActive()?"hide":"show"]()},show:function(){this.isActive()||(s&&s.hide(!0),this.resize(),this.element.removeClass("uk-open").show(),s=this,o.addClass("uk-modal-page").height(),this.element.addClass("uk-open").trigger("uk.modal.show"))},hide:function(t){if(this.isActive())if(!t&&e.support.transition){var i=this;this.element.one(e.support.transition.end,function(){i._hide()}).removeClass("uk-open")}else this._hide()},resize:function(){this.dialog.css("margin-left","");var t=parseInt(this.dialog.css("width"),10),e=t+parseInt(this.dialog.css("margin-left"),10)+parseInt(this.dialog.css("margin-right"),10)<i.width();this.dialog.css("margin-left",t&&e?-1*Math.ceil(t/2):"")},_hide:function(){this.element.hide().removeClass("uk-open"),o.removeClass("uk-modal-page"),s===this&&(s=!1),this.element.trigger("uk.modal.hide")},isActive:function(){return s==this}}),n.defaults={keyboard:!0,show:!1,bgclose:!0};var a=function(e,i){var s=this,o=t(e);o.data("modal")||(this.options=t.extend({target:o.is("a")?o.attr("href"):!1},i),this.element=o,this.modal=new n(this.options.target,i),o.on("click",function(t){t.preventDefault(),s.show()}),t.each(["show","hide","isActive"],function(t,e){s[e]=function(){return s.modal[e]()}}),this.element.data("modal",this))};a.Modal=n,e.modal=a,t(document).on("click.modal.uikit","[data-uk-modal]",function(){var i=t(this);if(!i.data("modal")){var s=new a(i,e.Utils.options(i.attr("data-uk-modal")));s.show()}}),t(document).on("keydown.modal.uikit",function(t){s&&27===t.keyCode&&s.options.keyboard&&(t.preventDefault(),s.hide())}),i.on("resize orientationchange",e.Utils.debounce(function(){s&&s.resize()},150))}(jQuery,jQuery.UIkit,jQuery(window)),function(t,e){"use strict";var i,s=t(window),o=t(document),n={show:function(e){if(e=t(e),e.length){var a=t("html"),r=e.find(".uk-offcanvas-bar:first"),l=r.hasClass("uk-offcanvas-bar-flip")?-1:1,u=-1==l&&s.width()<window.innerWidth?window.innerWidth-s.width():0;i={x:window.scrollX,y:window.scrollY},e.addClass("uk-active"),a.css({width:window.innerWidth,height:window.innerHeight}).addClass("uk-offcanvas-page"),a.css("margin-left",(r.outerWidth()-u)*l).width(),r.addClass("uk-offcanvas-bar-show").width(),e.off(".ukoffcanvas").on("click.ukoffcanvas swipeRight.ukoffcanvas swipeLeft.ukoffcanvas",function(e){var i=t(e.target);if(!e.type.match(/swipe/)){if(i.hasClass("uk-offcanvas-bar"))return;if(i.parents(".uk-offcanvas-bar:first").length)return}e.stopImmediatePropagation(),n.hide()}),o.on("keydown.offcanvas",function(t){27===t.keyCode&&n.hide()})}},hide:function(e){var s=t("html"),n=t(".uk-offcanvas.uk-active"),a=n.find(".uk-offcanvas-bar:first");n.length&&(t.UIkit.support.transition&&!e?(s.one(t.UIkit.support.transition.end,function(){s.removeClass("uk-offcanvas-page").attr("style",""),n.removeClass("uk-active"),window.scrollTo(i.x,i.y)}).css("margin-left",""),setTimeout(function(){a.removeClass("uk-offcanvas-bar-show")},50)):(s.removeClass("uk-offcanvas-page").attr("style",""),n.removeClass("uk-active"),a.removeClass("uk-offcanvas-bar-show"),window.scrollTo(i.x,i.y)),n.off(".ukoffcanvas"),o.off(".ukoffcanvas"))}},a=function(e,i){var s=this,o=t(e);o.data("offcanvas")||(this.options=t.extend({target:o.is("a")?o.attr("href"):!1},i),this.element=o,o.on("click",function(t){t.preventDefault(),n.show(s.options.target)}),this.element.data("offcanvas",this))};a.offcanvas=n,e.offcanvas=a,o.on("click.offcanvas.uikit","[data-uk-offcanvas]",function(i){i.preventDefault();var s=t(this);s.data("offcanvas")||(new a(s,e.Utils.options(s.attr("data-uk-offcanvas"))),s.trigger("click"))})}(jQuery,jQuery.UIkit),function(t,e){"use strict";function i(e){var i=t(e),s="auto";if(i.is(":visible"))s=i.outerHeight();else{var o={position:i.css("position"),visibility:i.css("visibility"),display:i.css("display")};s=i.css({position:"absolute",visibility:"hidden",display:"block"}).outerHeight(),i.css(o)}return s}var s=function(e,i){var o=this,n=t(e);n.data("nav")||(this.options=t.extend({},s.defaults,i),this.element=n.on("click",this.options.toggler,function(e){e.preventDefault();var i=t(this);o.open(i.parent()[0]==o.element[0]?i:i.parent("li"))}),this.element.find(this.options.lists).each(function(){var e=t(this),i=e.parent(),s=i.hasClass("uk-active");e.wrap('<div style="overflow:hidden;height:0;position:relative;"></div>'),i.data("list-container",e.parent()),s&&o.open(i,!0)}),this.element.data("nav",this))};t.extend(s.prototype,{open:function(e,s){var o=this.element,n=t(e);this.options.multiple||o.children(".uk-open").not(e).each(function(){t(this).data("list-container")&&t(this).data("list-container").stop().animate({height:0},function(){t(this).parent().removeClass("uk-open")})}),n.toggleClass("uk-open"),n.data("list-container")&&(s?n.data("list-container").stop().height(n.hasClass("uk-open")?"auto":0):n.data("list-container").stop().animate({height:n.hasClass("uk-open")?i(n.data("list-container").find("ul:first")):0}))}}),s.defaults={toggler:">li.uk-parent > a[href='#']",lists:">li.uk-parent > ul",multiple:!1},e.nav=s,t(document).on("uk-domready",function(){t("[data-uk-nav]").each(function(){var i=t(this);i.data("nav")||new s(i,e.Utils.options(i.attr("data-uk-nav")))})})}(jQuery,jQuery.UIkit),function(t,e){"use strict";var i,s,o=function(e,i){var s=this,n=t(e);n.data("tooltip")||(this.options=t.extend({},o.defaults,i),this.element=n.on({focus:function(){s.show()},blur:function(){s.hide()},mouseenter:function(){s.show()},mouseleave:function(){s.hide()}}),this.tip="function"==typeof this.options.src?this.options.src.call(this.element):this.options.src,this.element.attr("data-cached-title",this.element.attr("title")).attr("title",""),this.element.data("tooltip",this))};t.extend(o.prototype,{tip:"",show:function(){if(s&&clearTimeout(s),this.tip.length){i.stop().css({top:-2e3,visibility:"hidden"}).show(),i.html('<div class="uk-tooltip-inner">'+this.tip+"</div>");var e=this,o=t.extend({},this.element.offset(),{width:this.element[0].offsetWidth,height:this.element[0].offsetHeight}),n=i[0].offsetWidth,a=i[0].offsetHeight,r="function"==typeof this.options.offset?this.options.offset.call(this.element):this.options.offset,l="function"==typeof this.options.pos?this.options.pos.call(this.element):this.options.pos,u={display:"none",visibility:"visible",top:o.top+o.height+a,left:o.left},h=l.split("-");"left"!=h[0]&&"right"!=h[0]||"right"!=t.UIkit.langdirection||(h[0]="left"==h[0]?"right":"left");var c={bottom:{top:o.top+o.height+r,left:o.left+o.width/2-n/2},top:{top:o.top-a-r,left:o.left+o.width/2-n/2},left:{top:o.top+o.height/2-a/2,left:o.left-n-r},right:{top:o.top+o.height/2-a/2,left:o.left+o.width+r}};t.extend(u,c[h[0]]),2==h.length&&(u.left="left"==h[1]?o.left:o.left+o.width-n);var d=this.checkBoundary(u.left,u.top,n,a);if(d){switch(d){case"x":l=2==h.length?h[0]+"-"+(0>u.left?"left":"right"):0>u.left?"right":"left";break;case"y":l=2==h.length?(0>u.top?"bottom":"top")+"-"+h[1]:0>u.top?"bottom":"top";break;case"xy":l=2==h.length?(0>u.top?"bottom":"top")+"-"+(0>u.left?"left":"right"):0>u.left?"right":"left"}h=l.split("-"),t.extend(u,c[h[0]]),2==h.length&&(u.left="left"==h[1]?o.left:o.left+o.width-n)}s=setTimeout(function(){i.css(u).attr("class","uk-tooltip uk-tooltip-"+l),e.options.animation?i.css({opacity:0,display:"block"}).animate({opacity:1},parseInt(e.options.animation,10)||400):i.show(),s=!1},parseInt(this.options.delay,10)||0)}},hide:function(){this.element.is("input")&&this.element[0]===document.activeElement||(s&&clearTimeout(s),i.stop(),this.options.animation?i.fadeOut(parseInt(this.options.animation,10)||400):i.hide())},content:function(){return this.tip},checkBoundary:function(t,e,i,s){var o="";return(0>t||t+i>window.innerWidth)&&(o+="x"),(0>e||e+s>window.innerHeight)&&(o+="y"),o}}),o.defaults={offset:5,pos:"top",animation:!1,delay:0,src:function(){return this.attr("title")}},e.tooltip=o,t(function(){i=t('<div class="uk-tooltip"></div>').appendTo("body")}),t(document).on("mouseenter.tooltip.uikit focus.tooltip.uikit","[data-uk-tooltip]",function(){var i=t(this);i.data("tooltip")||(new o(i,e.Utils.options(i.attr("data-uk-tooltip"))),i.trigger("mouseenter"))})}(jQuery,jQuery.UIkit),function(t,e){"use strict";var i=function(e,s){var o=this,n=t(e);if(!n.data("switcher")){if(this.options=t.extend({},i.defaults,s),this.element=n.on("click",this.options.toggler,function(t){t.preventDefault(),o.show(this)}),this.options.connect){this.connect=t(this.options.connect).find(".uk-active").removeClass(".uk-active").end();var a=this.element.find(this.options.toggler).filter(".uk-active");a.length&&this.show(a)}this.element.data("switcher",this)}};t.extend(i.prototype,{show:function(e){e=isNaN(e)?t(e):this.element.find(this.options.toggler).eq(e);var i=e;if(!i.hasClass("uk-disabled")){if(this.element.find(this.options.toggler).filter(".uk-active").removeClass("uk-active"),i.addClass("uk-active"),this.options.connect&&this.connect.length){var s=this.element.find(this.options.toggler).index(i);this.connect.children().removeClass("uk-active").eq(s).addClass("uk-active")}this.element.trigger("uk.switcher.show",[i])}}}),i.defaults={connect:!1,toggler:">*"},e.switcher=i,t(document).on("uk-domready",function(){t("[data-uk-switcher]").each(function(){var s=t(this);s.data("switcher")||new i(s,e.Utils.options(s.attr("data-uk-switcher")))})})}(jQuery,jQuery.UIkit),function(t,e){"use strict";var i=function(e,s){var o=this,n=t(e);if(!n.data("tab")){if(this.element=n,this.options=t.extend({},i.defaults,s),this.options.connect&&(this.connect=t(this.options.connect)),window.location.hash){var a=this.element.children().filter(window.location.hash);a.length&&this.element.children().removeClass("uk-active").filter(a).addClass("uk-active")}var r=t('<li class="uk-tab-responsive uk-active"><a href="javascript:void(0);"></a></li>'),l=r.find("a:first"),u=t('<div class="uk-dropdown uk-dropdown-small"><ul class="uk-nav uk-nav-dropdown"></ul><div>'),h=u.find("ul");l.html(this.element.find("li.uk-active:first").find("a").text()),this.element.hasClass("uk-tab-bottom")&&u.addClass("uk-dropdown-up"),this.element.hasClass("uk-tab-flip")&&u.addClass("uk-dropdown-flip"),this.element.find("a").each(function(e){var i=t(this).parent(),s=t('<li><a href="javascript:void(0);">'+i.text()+"</a></li>").on("click",function(){o.element.data("switcher").show(e)});t(this).parents(".uk-disabled:first").length||h.append(s)}),this.element.uk("switcher",{toggler:">li:not(.uk-tab-responsive)",connect:this.options.connect}),r.append(u).uk("dropdown",{mode:"click"}),this.element.append(r).data({dropdown:r.data("dropdown"),mobilecaption:l}).on("uk.switcher.show",function(t,e){r.addClass("uk-active"),l.html(e.find("a").text())}),this.element.data("tab",this)}};i.defaults={connect:!1},e.tab=i,t(document).on("uk-domready",function(){t("[data-uk-tab]").each(function(){var s=t(this);s.data("tab")||new i(s,e.Utils.options(s.attr("data-uk-tab")))})})}(jQuery,jQuery.UIkit),function(t,e){"use strict";var i={},s=function(e,o){var n=this,a=t(e);a.data("search")||(this.options=t.extend({},s.defaults,o),this.element=a,this.timer=null,this.value=null,this.input=this.element.find(".uk-search-field"),this.form=this.input.length?t(this.input.get(0).form):t(),this.input.attr("autocomplete","off"),this.input.on({keydown:function(t){if(n.form[n.input.val()?"addClass":"removeClass"](n.options.filledClass),t&&t.which&&!t.shiftKey)switch(t.which){case 13:n.done(n.selected),t.preventDefault();break;case 38:n.pick("prev"),t.preventDefault();break;case 40:n.pick("next"),t.preventDefault();break;case 27:case 9:n.hide();break;default:}},keyup:function(){n.trigger()},blur:function(t){setTimeout(function(){n.hide(t)},200)}}),this.form.find("button[type=reset]").bind("click",function(){n.form.removeClass("uk-open").removeClass("uk-loading").removeClass("uk-active"),n.value=null,n.input.focus()}),this.dropdown=t('<div class="uk-dropdown uk-dropdown-search"><ul class="uk-nav uk-nav-search"></ul></div>').appendTo(this.form).find(".uk-nav-search"),this.options.flipDropdown&&this.dropdown.parent().addClass("uk-dropdown-flip"),this.dropdown.on("mouseover",">li",function(){n.pick(t(this))}),this.renderer=new i[this.options.renderer](this),this.element.data("search",this))};t.extend(s.prototype,{request:function(e){var i=this;this.form.addClass(this.options.loadingClass),this.options.source?t.ajax(t.extend({url:this.options.source,type:this.options.method,dataType:"json",success:function(t){t=i.options.onLoadedResults.apply(this,[t]),i.form.removeClass(i.options.loadingClass),i.suggest(t)}},e)):this.form.removeClass(i.options.loadingClass)},pick:function(t){var e=!1;if("string"==typeof t||t.hasClass(this.options.skipClass)||(e=t),"next"==t||"prev"==t){var i=this.dropdown.children().filter(this.options.match);if(this.selected){var s=i.index(this.selected);e="next"==t?i.eq(i.length>s+1?s+1:0):i.eq(0>s-1?i.length-1:s-1)}else e=i["next"==t?"first":"last"]()}e&&e.length&&(this.selected=e,this.dropdown.children().removeClass(this.options.hoverClass),this.selected.addClass(this.options.hoverClass))},trigger:function(){var t=this,e=this.value,i={};return this.value=this.input.val(),this.value.length<this.options.minLength?this.hide():(this.value!=e&&(this.timer&&window.clearTimeout(this.timer),this.timer=window.setTimeout(function(){i[t.options.param]=t.value,t.request({data:i})},this.options.delay,this)),this)},done:function(t){this.renderer.done(t)},suggest:function(t){t&&(t===!1?this.hide():(this.selected=null,this.dropdown.empty(),this.renderer.suggest(t),this.show()))},show:function(){this.visible||(this.visible=!0,this.form.addClass("uk-open"))},hide:function(){this.visible&&(this.visible=!1,this.form.removeClass(this.options.loadingClass).removeClass("uk-open"))}}),s.addRenderer=function(t,e){i[t]=e},s.defaults={source:!1,param:"search",method:"post",minLength:3,delay:300,flipDropdown:!1,match:":not(.uk-skip)",skipClass:"uk-skip",loadingClass:"uk-loading",filledClass:"uk-active",listClass:"results",hoverClass:"uk-active",onLoadedResults:function(t){return t},renderer:"default"};var o=function(e){this.search=e,this.options=t.extend({},o.defaults,e.options)};t.extend(o.prototype,{done:function(t){return t?(t.hasClass(this.options.moreResultsClass)?this.search.form.submit():t.data("choice")&&(window.location=t.data("choice").url),this.search.hide(),void 0):(this.search.form.submit(),void 0)},suggest:function(e){var i=this,s={click:function(e){e.preventDefault(),i.done(t(this).parent())}};this.options.msgResultsHeader&&t("<li>").addClass(this.options.resultsHeaderClass+" "+this.options.skipClass).html(this.options.msgResultsHeader).appendTo(this.search.dropdown),e.results&&e.results.length>0?(t(e.results).each(function(){var e=t('<li><a href="#">'+this.title+"</a></li>").data("choice",this);this.text&&e.find("a").append("<div>"+this.text+"</div>"),i.search.dropdown.append(e)}),this.options.msgMoreResults&&(t("<li>").addClass("uk-nav-divider "+i.options.skipClass).appendTo(i.dropdown),t("<li>").addClass(i.options.moreResultsClass).html('<a href="#">'+i.options.msgMoreResults+"</a>").appendTo(i.search.dropdown).on(s)),i.search.dropdown.find("li>a").on(s)):this.options.msgNoResults&&t("<li>").addClass(this.options.noResultsClass+" "+this.options.skipClass).html("<a>"+this.options.msgNoResults+"</a>").appendTo(i.search.dropdown)}}),o.defaults={resultsHeaderClass:"uk-nav-header",moreResultsClass:"uk-search-moreresults",noResultsClass:"",msgResultsHeader:"Search Results",msgMoreResults:"More Results",msgNoResults:"No results found"},s.addRenderer("default",o),e.search=s,t(document).on("focus.search.uikit","[data-uk-search]",function(){var i=t(this);i.data("search")||new s(i,e.Utils.options(i.attr("data-uk-search")))})}(jQuery,jQuery.UIkit),function(t,e){"use strict";var i=t(window),s=[],o=function(){for(var t=0;s.length>t;t++)e.support.requestAnimationFrame.apply(window,[s[t].check])},n=function(i,o){var a=t(i);if(!a.data("scrollspy")){this.options=t.extend({},n.defaults,o),this.element=t(i);var r,l,u,h=this,c=function(){var t=e.Utils.isInView(h.element,h.options);t&&!l&&(r&&clearTimeout(r),u||(h.element.addClass(h.options.initcls),h.offset=h.element.offset(),u=!0,h.element.trigger("uk-scrollspy-init")),r=setTimeout(function(){t&&h.element.addClass("uk-scrollspy-inview").addClass(h.options.cls).width()},h.options.delay),l=!0,h.element.trigger("uk.scrollspy.inview")),!t&&l&&h.options.repeat&&(h.element.removeClass("uk-scrollspy-inview").removeClass(h.options.cls),l=!1,h.element.trigger("uk.scrollspy.outview"))};c(),this.element.data("scrollspy",this),this.check=c,s.push(this)}};n.defaults={cls:"uk-scrollspy-inview",initcls:"uk-scrollspy-init-inview",topoffset:0,leftoffset:0,repeat:!1,delay:0},e.scrollspy=n;var a=[],r=function(){for(var t=0;a.length>t;t++)e.support.requestAnimationFrame.apply(window,[a[t].check])},l=function(s,o){var n=t(s);if(!n.data("scrollspynav")){this.element=n,this.options=t.extend({},l.defaults,o);var r,u=[],h=this.element.find("a[href^='#']").each(function(){u.push(t(this).attr("href"))}),c=t(u.join(",")),d=this,f=function(){r=[];for(var t=0;c.length>t;t++)e.Utils.isInView(c.eq(t),d.options)&&r.push(c.eq(t));if(r.length){var s=i.scrollTop(),o=function(){for(var t=0;r.length>t;t++)if(r[t].offset().top>=s)return r[t]}();if(!o)return;d.options.closest?h.closest(d.options.closest).removeClass(d.options.cls).end().filter("a[href='#"+o.attr("id")+"']").closest(d.options.closest).addClass(d.options.cls):h.removeClass(d.options.cls).filter("a[href='#"+o.attr("id")+"']").addClass(d.options.cls)}};this.options.smoothscroll&&e.smoothScroll&&h.each(function(){new e.smoothScroll(this,d.options.smoothscroll)}),f(),this.element.data("scrollspynav",this),this.check=f,a.push(this)}};l.defaults={cls:"uk-active",closest:!1,topoffset:0,leftoffset:0,smoothscroll:!1},e.scrollspynav=l;var u=function(){o(),r()};i.on("scroll",u).on("resize orientationchange",e.Utils.debounce(u,50)),t(document).on("uk-domready",function(){t("[data-uk-scrollspy]").each(function(){var i=t(this);i.data("scrollspy")||new n(i,e.Utils.options(i.attr("data-uk-scrollspy")))}),t("[data-uk-scrollspy-nav]").each(function(){var i=t(this);i.data("scrollspynav")||new l(i,e.Utils.options(i.attr("data-uk-scrollspy-nav")))})})}(jQuery,jQuery.UIkit),function(t,e){"use strict";var i=function(e,s){var o=this,n=t(e);n.data("smoothScroll")||(this.options=t.extend({},i.defaults,s),this.element=n.on("click",function(){var e=t(this.hash).length?t(this.hash):t("body"),i=e.offset().top-o.options.offset,s=t(document).height(),n=t(window).height();
return e.outerHeight(),i+n>s&&(i=s-n),t("html,body").stop().animate({scrollTop:i},o.options.duration,o.options.transition),!1}),this.element.data("smoothScroll",this))};i.defaults={duration:1e3,transition:"easeOutExpo",offset:0},e.smoothScroll=i,t.easing.easeOutExpo||(t.easing.easeOutExpo=function(t,e,i,s,o){return e==o?i+s:s*(-Math.pow(2,-10*e/o)+1)+i}),t(document).on("click.smooth-scroll.uikit","[data-uk-smooth-scroll]",function(){var s=t(this);s.data("smoothScroll")||(new i(s,e.Utils.options(s.attr("data-uk-smooth-scroll"))),s.trigger("click"))})}(jQuery,jQuery.UIkit),function(t,e,i){var s=function(t,i){var o=this,n=e(t);n.data("toggle")||(this.options=e.extend({},s.defaults,i),this.totoggle=this.options.target?e(this.options.target):[],this.element=n.on("click",function(t){t.preventDefault(),o.toggle()}),this.element.data("toggle",this))};e.extend(s.prototype,{toggle:function(){this.totoggle.length&&this.totoggle.toggleClass(this.options.cls)}}),s.defaults={target:!1,cls:"uk-hidden"},i.toggle=s,e(document).on("click.toggle.uikit","[data-uk-toggle]",function(){var t=e(this);t.data("toggle")||(new s(t,i.Utils.options(t.attr("data-uk-toggle"))),t.trigger("click"))})}(this,jQuery,jQuery.UIkit);


jQuery(function($) {
  $('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {

      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top
        },1000);
        return false;
      }
    }
  });
});

