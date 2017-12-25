/**
 * jQuery Cookie plugin
 *
 * Copyright (c) 2010 Klaus Hartl (stilbuero.de)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 */
(function () {
    "use strict";

    // IE checker
    function gkIsIE() {
        var myNav = navigator.userAgent.toLowerCase();
        return (myNav.indexOf('msie') != -1) ? parseInt(myNav.split('msie')[1]) : false;
    }

    jQuery.cookie = function (key, value, options) {

        // key and at least value given, set cookie...
        if (arguments.length > 1 && String(value) !== "[object Object]") {
            options = jQuery.extend({}, options);

            if (value === null || value === undefined) {
                options.expires = -1;
            }

            if (typeof options.expires === 'number') {
                var days = options.expires,
                    t = options.expires = new Date();
                t.setDate(t.getDate() + days);
            }

            value = String(value);

            return (document.cookie = [
                encodeURIComponent(key), '=',
                options.raw ? value : encodeURIComponent(value),
                options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
                options.path ? '; path=' + options.path : '',
                options.domain ? '; domain=' + options.domain : '',
                options.secure ? '; secure' : ''
            ].join(''));
        }

        // key and possibly options given, get cookie...
        options = value || {};
        var result, decode = options.raw ? function (s) {
                return s;
            } : decodeURIComponent;
        return (result = new RegExp('(?:^|; )' + encodeURIComponent(key) + '=([^;]*)').exec(document.cookie)) ? decode(result[1]) : null;
    };

    // Array filter
    if (!Array.prototype.filter) {
        Array.prototype.filter = function (fun /*, thisp */ ) {
            if (this === null) {
                throw new TypeError();
            }

            var t = Object(this);
            var len = t.length >>> 0;
            if (typeof fun !== "function") {
                throw new TypeError();
            }

            var res = [];
            var thisp = arguments[1];

            for (var i = 0; i < len; i++) {
                if (i in t) {
                    var val = t[i]; // in case fun mutates this
                    if (fun.call(thisp, val, i, t))
                        res.push(val);
                }
            }

            return res;
        };
    }

    /**
     *
     * Template scripts
     *
     **/

    // onDOMLoadedContent event
    jQuery(document).ready(function () {
        // Thickbox use
        jQuery(document).ready(function () {
            if (typeof tb_init !== "undefined") {
                tb_init('div.wp-caption a'); //pass where to apply thickbox
            }
        });
        // style area
        if (jQuery('#gk-style-area')) {
            jQuery('#gk-style-area div').each(function () {
                jQuery(this).find('a').each(function () {
                    jQuery(this).click(function (e) {
                        e.stopPropagation();
                        e.preventDefault();
                        changeStyle(jQuery(this).attr('href').replace('#', ''));
                    });
                });
            });
        }
        // Function to change styles

        function changeStyle(style) {
            var file = $GK_TMPL_URL + '/css/' + style;
            jQuery('head').append('<link rel="stylesheet" href="' + file + '" type="text/css" />');
            jQuery.cookie($GK_TMPL_NAME + '_style', style, {
                expires: 365,
                path: '/'
            });
        }

        // Responsive tables
        jQuery('article section table').each(function (i, table) {
            table = jQuery(table);

            if (table.hasClass('hosting')) {
                var heads = table.find('thead th:not(:first-child)');
            } else {
                var heads = table.find('thead th');
            }
            var cells = table.find('tbody td');
            var heads_amount = heads.length;
            // if there are the thead cells
            if (heads_amount) {
                var cells_len = cells.length;
                for (var j = 0; j < cells_len; j++) {
                    var head_content = jQuery(heads.get(j % heads_amount)).text();
                    jQuery(cells.get(j)).html('<span class="gk-table-label">' + head_content + '</span>' + jQuery(cells.get(j)).html());
                }
            }
        });
		
		// login popup
        if (jQuery('#gk-popup-login').length > 0 || jQuery('#btn-cart')) {
            // login popup
            var popup_overlay = jQuery('#gk-popup-overlay');
            popup_overlay.css({
                'display': 'none',
                'opacity': 0
            });
            popup_overlay.fadeOut();

            jQuery('#gk-popup-login').css({
                'display': 'none',
                'opacity': 0
            });
            var opened_popup = null;
            var popup_login = null;
            var popup_cart = null;

            if (jQuery('#gk-popup-login').length > 0) {
                popup_login = jQuery('#gk-popup-login');

                jQuery('#gk-login').click(function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    popup_overlay.css('height', jQuery('body').height() + 32);
                    popup_login.css('display', 'block');
                    popup_login.css('opacity', 0);
                    popup_overlay.css('opacity', 0);
                    popup_overlay.css('display', 'block');
                    popup_overlay.animate({
                        'opacity': 0.45
                    });

                    setTimeout(function () {
                        popup_login.animate({
                            'opacity': 1,
                            'margin-top': 0
                        }, 200, 'swing');
                        opened_popup = 'login';
                    }, 300);
                });
            }

            if (jQuery('#btn-cart').length > 0) {
                popup_cart = jQuery('#gk-popup-cart');

                jQuery('#btn-cart').click(function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    popup_overlay.css('height', jQuery('body').height() + 32);
                    popup_cart.css('display', 'block');
                    popup_cart.css('opacity', 0);
                    popup_overlay.css('opacity', 0);
                    popup_overlay.css('display', 'block');
                    popup_overlay.animate({
                        'opacity': 0.45
                    });

                    setTimeout(function () {
                        popup_cart.animate({
                            'opacity': 1,
                            'margin-top': 0
                        }, 200, 'swing');
                        opened_popup = 'cart';
                    }, 300);
                });
            }

            popup_overlay.click(function () {
                if (opened_popup === 'login') {
                    popup_overlay.fadeOut('slow');
                    popup_login.animate({
                        'opacity': 0,
                        'margin-top': -50
                    }, 500, function () {
                        popup_login.css('display', 'none');
                    });
                }

                if (opened_popup === 'cart') {
                    popup_overlay.fadeOut('slow');
                    popup_cart.animate({
                        'opacity': 0,
                        'margin-top': -50
                    }, 500, function () {
                        popup_cart.css('display', 'none');
                    });
                }
            });

            jQuery('.gk-popup-wrap').each(function (i, wrap) {
                wrap = jQuery(wrap);
                if (wrap.find('.gk-icon-cross')) {
                    wrap.find('.gk-icon-cross').click(function () {
                        popup_overlay.trigger('click');
                    });
                }
            });
        }
                
    });
    
     // Image Show & Title Overlay
        jQuery(window).load(function () {
            jQuery('.gk-title-overlay').each(function (i, wrapper) {
                jQuery(wrapper).addClass('active');
            });
    
            jQuery(".gk-is-wrapper-gk-instyle").each(function (i, wrapper) {
                wrapper = jQuery(wrapper);
                var slides = [];
                var imagesToLoad = [];
                var loadedImages = 0;
                // animation variables
                var $G = [];
                $G.anim_speed = parseInt(wrapper.attr('data-speed'), 10);
                $G.anim_interval = parseInt(wrapper.attr('data-interval'), 10);
                $G.autoanim = wrapper.attr('data-autoanim');
                $G.animation_timer = false;
                $G.actual_slide = 0;
                $G.blank = false;
                $G.progress = false;
                $G.scrollarea = wrapper.find('.gk-is-image-scroll');
                // load the images
                wrapper.find('div.gk-is-slide').each(function (i, el) {
                    el = jQuery(el);
                    var newImg = jQuery('<img title="' + el.text() + '" class="' + el.attr('class') + '" style="' + el.attr('data-style') + '" src="' + el.attr('data-path') + '" data-num="' + i + '" data-url="' + el.attr('data-link') + '" />');
                    imagesToLoad.push(newImg);
                    el.after(newImg);
                    el.remove();
                });
    
                var time = setInterval(function () {
                    var process = 0;
                    jQuery(imagesToLoad).each(function (i, img) {
                        if (img[0].complete) {
                            process++;
                        }
                    });
    
                    if (process === imagesToLoad.length) {
                        clearInterval(time);
                        loadedImages = process;
                        setTimeout(function () {
                            wrapper.find('.gk-is-preloader').fadeOut();
                        }, 400);
                    }
                }, 200);
    
                var time_main = setInterval(function () {
                    if (loadedImages) {
                        clearInterval(time_main);
    
                        wrapper.find(".gk-is-slide").each(function (i, elmt) {
                            elmt = jQuery(elmt);
                            slides[i] = elmt;
                            elmt.click(function (e) {
                                window.location = jQuery(e.target).attr('data-url');
                            });
                            elmt.css("cursor", "pointer");
                        });
    
                        // pagination
                        if (wrapper.find('ol').length) {
                            wrapper.find('ol li').each(function (i, btn) {
                                btn = jQuery(btn);
                                btn.click(function () {
                                    if (i !== $G.actual_slide) {
                                        $G.blank = true;
                                        gk_instyle_autoanimate($G, wrapper, 'next', i);
                                    }
                                });
                            });
                        }
                        //
                        var initText = wrapper.find('.figcaption');
                        initText.css('margin-top', -0.5 * initText.outerHeight() + "px");
                        // buttons 
                        if (wrapper.find('.gk-is-btn-prev')) {
                            wrapper.find('.gk-is-btn-prev').click(function (e) {
                                e.preventDefault();
                                $G.blank = true;
                                gk_instyle_autoanimate($G, wrapper, 'prev', null);
                            });
    
                            wrapper.find('.gk-is-btn-next').click(function (e) {
                                e.preventDefault();
                                $G.blank = true;
                                gk_instyle_autoanimate($G, wrapper, 'next', null);
                            });
                        }
    
                        wrapper.mouseenter(function () {
                            wrapper.addClass('hover');
                        });
    
                        wrapper.mouseleave(function () {
                            wrapper.removeClass('hover');
                        });
    
                        // auto animation
                        if ($G.autoanim === 'on') {
                            $G.animation_timer = setTimeout(function () {
                                gk_instyle_autoanimate($G, wrapper, 'next', null);
                            }, $G.anim_interval);
                        }
    
                        // pagination
                        var slide_pos_start_x = 0;
                        var slide_pos_start_y = 0;
                        var slide_time_start = 0;
                        var slide_swipe = false;
    
                        wrapper.bind('touchstart', function (e) {
                            slide_swipe = true;
                            var touches = e.originalEvent.changedTouches || e.originalEvent.touches;
    
                            if (touches.length > 0) {
                                slide_pos_start_x = touches[0].pageX;
                                slide_pos_start_y = touches[0].pageY;
                                slide_time_start = new Date().getTime();
                            }
                        });
    
                        wrapper.bind('touchmove', function (e) {
                            var touches = e.originalEvent.changedTouches || e.originalEvent.touches;
    
                            if (touches.length > 0 && slide_swipe) {
                                if (
                                    Math.abs(touches[0].pageX - slide_pos_start_x) > Math.abs(touches[0].pageY - slide_pos_start_y)
                                ) {
                                    e.preventDefault();
                                } else {
                                    slide_swipe = false;
                                }
                            }
                        });
    
                        wrapper.bind('touchend', function (e) {
                            var touches = e.originalEvent.changedTouches || e.originalEvent.touches;
    
                            if (touches.length > 0 && slide_swipe) {
                                if (
                                    Math.abs(touches[0].pageX - slide_pos_start_x) >= 50 &&
                                    new Date().getTime() - slide_time_start <= 500
                                ) {
                                    if (touches[0].pageX - slide_pos_start_x > 0) {
                                        $G.blank = true;
                                        gk_instyle_autoanimate($G, wrapper, 'prev', null);
                                    } else {
                                        $G.blank = true;
                                        gk_instyle_autoanimate($G, wrapper, 'next', null);
                                    }
                                }
                            }
                        });
                    }
                }, 250);
            });
        });
    
        var gk_instyle_animate = function ($G, wrapper, imgPrev, imgNext, dir, next) {
            var prevText = jQuery(imgPrev).find('.figcaption');
            var nextText = jQuery(imgNext).find('.figcaption');
            imgPrev = jQuery(imgPrev);
            imgNext = jQuery(imgNext);
    
            if (prevText) {
                prevText.css('margin-top', -0.5 * prevText.outerHeight() + "px");
                nextText.css('margin-top', -0.5 * nextText.outerHeight() + "px");
    
                if (dir === 'next') {
                    //
                    imgPrev.find('img').first().css('margin-left', 0);
                    imgPrev.find('img').first().animate({
                            'margin-left': 300
                        },
                        $G.anim_speed,
                        'linear',
                        function () {
                            setTimeout(function () {
                                imgPrev.find('img').first().css('margin-left', 0);
                            }, 100);
                        }
                    );
                    //
                    imgNext.find('img').first().css('margin-left', '-300px');
                    imgNext.find('img').first().animate({
                            'margin-left': 0
                        },
                        $G.anim_speed,
                        'linear',
                        function () {
                            setTimeout(function () {
                                imgPrev.find('img').first().css('margin-left', 0);
                            }, 100);
                        }
                    );
                } else {
                    //
                    imgPrev.find('img').first().css('margin-left', 0);
                    imgPrev.find('img').first().animate({
                            'margin-left': -300
                        },
                        $G.anim_speed,
                        'linear',
                        function () {
                            setTimeout(function () {
                                imgPrev.find('img').first().css('margin-left', 0);
                            }, 100);
                        }
                    );
                    //
                    imgNext.find('img').first().css('margin-left', '300px');
                    imgNext.find('img').first().animate({
                            'margin-left': 0
                        },
                        $G.anim_speed,
                        'linear',
                        function () {
                            setTimeout(function () {
                                imgPrev.find('img').first().css('margin-left', 0);
                            }, 100);
                        }
                    );
                }
            }
            //
            imgPrev.removeClass('active');
            imgNext.addClass('active');
            //
            $G.scrollarea.animate({
                    'margin-left': (next * -1 * 100) + "%"
                },
                $G.anim_speed,
                'linear',
                function () {
                    $G.progress = false;
                    if ($G.autoanim === 'on') {
                        clearTimeout($G.animation_timer);
    
                        $G.animation_timer = setTimeout(function () {
                            if ($G.blank) {
                                $G.blank = false;
                                clearTimeout($G.animation_timer);
    
                                $G.animation_timer = setTimeout(function () {
                                    gk_instyle_autoanimate($G, wrapper, 'next', null);
                                }, $G.anim_interval);
                            } else {
                                gk_instyle_autoanimate($G, wrapper, 'next', null);
                            }
                        }, $G.anim_interval);
                    }
                }
            );
        };
    
        var gk_instyle_autoanimate = function ($G, wrapper, dir, nextSlide) {
            if (!$G.progress) {
                $G.progress = true;
                var i = $G.actual_slide;
                var imgs = wrapper.find('.figure');
                var next = nextSlide;
    
                if (nextSlide === null) {
                    next = (dir === 'next') ? ((i < imgs.length - 1) ? i + 1 : 0) : ((i === 0) ? imgs.length - 1 : i - 1); // dir: next|prev
                }
    
                gk_instyle_animate($G, wrapper, imgs[i], imgs[next], ((next > $G.actual_slide) ? 'next' : 'prev'), next);
                $G.actual_slide = next;
                wrapper.find('ol li').attr('class', '');
                jQuery(wrapper.find('ol li')[next]).attr('class', 'active');
            }
        };
    //
    jQuery(document).ready(function () {
        //
        setTimeout(function () {
            if (jQuery('#gk-top-bar').length > 0) {
                jQuery('#gk-top-bar').addClass('active');
            }
        }, 500);
    });
})();