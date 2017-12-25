(function () {
    "use strict";
    jQuery(document).ready(function () {
        jQuery(document).find('.gk-news-gallery').each(function (i, module) {
            module = jQuery(module);

            if (!module.hasClass('active')) {
                module.addClass('active');
                gkNewsGalleryInit(module);
            }
        });
    });

    var gkNewsGalleryInit = function (module) {
        // set the basic module variables
        module.attr('data-current', 1);
        module.attr('data-blank', 0);
        module.attr('data-stop', 0);
        module.attr('data-all-pages', Math.ceil(module.find('.gk-image').length / module.attr('data-cols')));

        // check if buttons exists
        if (module.find('.gk-prev-btn')) {
            module.find('.gk-prev-btn').click(function (e) {
                e.preventDefault();
                module.attr('data-blank', 1);
                gkNewsGalleryAnim(module, 'prev');
            });

            module.find('.gk-next-btn').click(function (e) {
                e.preventDefault();
                module.attr('data-blank', 1);
                gkNewsGalleryAnim(module, 'next');
            });
        }

        // check if autoanimation is enabled
        if (module.hasClass('gk-auto-animation')) {
            setTimeout(function () {
                gkNewsGalleryAutoAnim(module);
            }, module.attr('data-autoanim-time'));
        }

        // add overlays
        module.find('.gk-image').each(function (i, img) {
            img = jQuery(img);
            img.html(img.html() + '<div class="gk-img-overlay"><span></span></div>');
        });

        // add stop event
        module.find('.gk-image').each(function (i, img) {
            img = jQuery(img);
            img.mouseenter(function () {
                module.attr('data-stop', 1);
                var overlay = img.find('.gk-img-overlay');
                var realImg = img.find('img');
                overlay.css({
                    'margin-left': (-1.0 * (realImg.outerWidth() / 2.0)) + "px",
                    'width': realImg.outerWidth() + "px"
                });
                overlay.attr('class', 'gk-img-overlay active');
            });
        });

        module.find('.gk-image').each(function (i, img) {
            img = jQuery(img);
            img.mouseleave(function () {
                module.attr('data-stop', 0);
                var overlay = img.find('.gk-img-overlay');
                overlay.attr('class', 'gk-img-overlay');
            });
        });
    };

    var gkNewsGalleryAutoAnim = function (module) {
        if (module.attr('data-blank') === 1 || module.attr('data-stop') === 1) {
            setTimeout(function () {
                module.attr('data-blank', 0);
                gkNewsGalleryAutoAnim(module);
            }, module.attr('data-autoanim-time'));
        } else {
            gkNewsGalleryAnim(module, 'next');

            setTimeout(function () {
                gkNewsGalleryAutoAnim(module);
            }, module.attr('data-autoanim-time'));
        }
    };

    var gkNewsGalleryAnim = function (module, dir) {
        // amount of news per page
        var perPage = module.attr('data-cols');
        var current = module.attr('data-current') * 1.0;
        var allPages = module.attr('data-all-pages');
        var next = 0;
        // select next page
        if (dir === 'next') {
            if (current == allPages) {
                next = 1;
            } else {
                next = current + 1;
            }
        } else if (dir === 'prev') {
            if (current == 1) {
                next = allPages;
            } else {
                next = current - 1;
            }
        }
        // set the current page
        module.attr('data-current', next);
        // hide current elements
        module.find('.gk-image').each(function (i, img) {
            img = jQuery(img);

            if (img.hasClass('active')) {
                gkNewsGalleryImgClass(img, 'active', false, 0);
                gkNewsGalleryImgClass(img, '', true, 300);
            }
        });
        // show next elements	
        setTimeout(function () {
            module.find('.gk-image').each(function (i, img) {
                img = jQuery(img);

                if (i >= (next - 1) * perPage && i < (next * perPage)) {
                    gkNewsGalleryImgClass(img, 'active', false, 0);
                    gkNewsGalleryImgClass(img, 'active show', true, 300);
                }
            });
        }, 300);
    };

    var gkNewsGalleryImgClass = function (img, className, delay, time) {
        if (!delay) {
            img.attr('class', 'gk-image ' + className);
        } else {
            setTimeout(function () {
                img.attr('class', 'gk-image ' + className);
            }, time);
        }
    };
})();