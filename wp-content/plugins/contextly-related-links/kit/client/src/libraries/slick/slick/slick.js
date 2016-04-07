/*
     _ _      _       _
 ___| (_) ___| | __  (_)___
/ __| | |/ __| |/ /  | / __|
\__ \ | | (__|   < _ | \__ \
|___/_|_|\___|_|\_(_)/ |___/
                   |__/

 Version: 1.5.8
  Author: Ken Wheeler
 Website: http://kenwheeler.github.io
    Docs: http://kenwheeler.github.io/slick
    Repo: http://github.com/kenwheeler/slick
  Issues: http://github.com/kenwheeler/slick/issues

 */
/* global window, document, define, jQuery, setInterval, clearInterval */
(function($) {
    'use strict';
    var Slick = (function() {

        var instanceUid = 0;

        function Slick($element, settings) {

            var _ = this, dataSettings;

            _.defaults = {
                appendArrows: $element,
                arrows: true,
                prevArrow: '<button type="button" data-role="none" class="ctx-slick-prev ctx-icon ctx-icon-left-circled" aria-label="Previous" tabindex="0" role="button">Previous</button>',
                nextArrow: '<button type="button" data-role="none" class="ctx-slick-next ctx-icon ctx-icon-right-circled" aria-label="Next" tabindex="0" role="button">Next</button>',
                centerMode: false,
                centerPadding: '50px',
                cssEase: 'ease',
                easing: 'linear',
                initialSlide: 0,
                responsive: null,
                slide: '',
                slidesToShow: 1,
                slidesToScroll: 1,
                speed: 500,
                useCSS: true,
                useTransform: true,
                waitForAnimate: true,
                zIndex: 1000
            };

            _.initials = {
                animating: false,
                currentDirection: 0,
                currentLeft: null,
                currentSlide: 0,
                direction: 1,
                listWidth: null,
                listHeight: null,
                loadIndex: 0,
                $nextArrow: null,
                $prevArrow: null,
                slideCount: null,
                slideWidth: null,
                $slideTrack: null,
                $slides: null,
                slideOffset: 0,
                $list: null,
                transformsEnabled: false,
                unslicked: false
            };

            $.extend(_, _.initials);

            _.activeBreakpoint = null;
            _.animType = null;
            _.animProp = null;
            _.breakpoints = [];
            _.breakpointSettings = [];
            _.cssTransitions = false;
            _.positionProp = null;
            _.$slider = $element;
            _.$slidesCache = null;
            _.transformType = null;
            _.transitionType = null;
            _.windowWidth = 0;
            _.windowTimer = null;

            dataSettings = $element.data('ctxSlick') || {};

            _.options = $.extend({}, _.defaults, dataSettings, settings);

            _.currentSlide = _.options.initialSlide;

            _.originalSettings = _.options;

            _.changeSlide = _.proxy(_.changeSlide);
            _.setPosition = _.proxy(_.setPosition);

            _.instanceUid = instanceUid++;

            // A simple way to check for HTML strings
            // Strict HTML recognition (must start with <)
            // Extracted from jQuery v1.11 source
            _.htmlExpr = /^(?:\s*(<[\w\W]+>)[^>]*)$/;


            _.registerBreakpoints();
            _.init();
            _.checkResponsive(true);

            _.$slider.triggerHandler('init', [_]);

        }

        return Slick;

    }());

    Slick.prototype.proxy = function(fn) {
        var _ = this,
            proxy,
            args = Array.prototype.slice.call(arguments, 1);
        if (args.length) {
            proxy = function() {
                return fn.apply(_, args.concat(Array.prototype.slice.call(arguments)));
            };
        }
        else {
            proxy = function() {
                return fn.apply(_, arguments);
            };
        }

        proxy.guid = fn.guid = fn.guid || jQuery.guid++;

        return proxy;
    };

    Slick.prototype.animateSlide = function(targetLeft, callback) {

        var animProps = {},
            _ = this;

        if (_.transformsEnabled === false) {
            _.$slideTrack.animate({
                left: targetLeft
            }, _.options.speed, _.options.easing, callback);

        } else {

            if (_.cssTransitions === false) {
                $({
                    animStart: _.currentLeft
                }).animate({
                    animStart: targetLeft
                }, {
                    duration: _.options.speed,
                    easing: _.options.easing,
                    step: function(now) {
                        now = Math.ceil(now);
                        animProps[_.animType] = 'translate(' +
                            now + 'px, 0px)';
                        _.$slideTrack.css(animProps);
                    },
                    complete: function() {
                        if (callback) {
                            callback.call();
                        }
                    }
                });

            } else {

                _.applyTransition();
                targetLeft = Math.ceil(targetLeft);

                animProps[_.animType] = 'translate3d(' + targetLeft + 'px, 0px, 0px)';
                _.$slideTrack.css(animProps);

                if (callback) {
                    setTimeout(function() {

                        _.disableTransition();

                        callback.call();
                    }, _.options.speed);
                }

            }

        }

    };

    Slick.prototype.applyTransition = function(slide) {

        var _ = this,
            transition = {};

        transition[_.transitionType] = _.transformType + ' ' + _.options.speed + 'ms ' + _.options.cssEase;

        _.$slideTrack.css(transition);

    };

    Slick.prototype.buildArrows = function() {

        var _ = this;

        if (_.options.arrows === true ) {

            _.$prevArrow = $(_.options.prevArrow).addClass('ctx-slick-arrow');
            _.$nextArrow = $(_.options.nextArrow).addClass('ctx-slick-arrow');

            if( _.slideCount > _.options.slidesToShow ) {

                _.$prevArrow
                    .removeClass('ctx-slick-hidden')
                    .removeAttr('aria-hidden')
                    .removeAttr('tabindex');
                _.$nextArrow
                    .removeClass('ctx-slick-hidden')
                    .removeAttr('aria-hidden')
                    .removeAttr('tabindex');

                if (_.htmlExpr.test(_.options.prevArrow)) {
                    _.$prevArrow.prependTo(_.options.appendArrows);
                }

                if (_.htmlExpr.test(_.options.nextArrow)) {
                    _.$nextArrow.appendTo(_.options.appendArrows);
                }

            } else {

                _.$prevArrow.add( _.$nextArrow )

                    .addClass('ctx-slick-hidden')
                    .attr({
                        'aria-disabled': 'true',
                        'tabindex': '-1'
                    });

            }

        }

    };

    Slick.prototype.buildOut = function() {

        var _ = this;

        _.$slides =
            _.$slider
                .children( _.options.slide + ':not(.ctx-slick-cloned)')
                .addClass('ctx-slick-slide');

        _.slideCount = _.$slides.length;

        _.$slides.each(function(index, element) {
            $(element)
                .attr('data-ctx-slick-index', index)
                .data('ctxOriginalStyling', $(element).attr('style') || '');
        });

        _.$slidesCache = _.$slides;

        _.$slider.addClass('ctx-slick-slider');

        _.$slideTrack = (_.slideCount === 0) ?
            $('<div class="ctx-slick-track"/>').appendTo(_.$slider) :
            _.$slides.wrapAll('<div class="ctx-slick-track"/>').parent();

        _.$list = _.$slideTrack.wrap(
            '<div aria-live="polite" class="ctx-slick-list"/>').parent();
        _.$slideTrack.css('opacity', 0);

        if (_.options.centerMode === true) {
            _.options.slidesToScroll = 1;
        }

        _.setupInfinite();

        _.buildArrows();


        _.setSlideClasses(typeof _.currentSlide === 'number' ? _.currentSlide : 0);

    };

    Slick.prototype.checkResponsive = function(initial, forceUpdate) {

        var _ = this,
            breakpoint, targetBreakpoint, respondToWidth, triggerBreakpoint = false;

        respondToWidth = _.$slider.width();

        if ( _.options.responsive &&
            _.options.responsive.length &&
            _.options.responsive !== null) {

            targetBreakpoint = null;

            for (breakpoint in _.breakpoints) {
                if (_.breakpoints.hasOwnProperty(breakpoint)) {
                    if (respondToWidth < _.breakpoints[breakpoint]) {
                        targetBreakpoint = _.breakpoints[breakpoint];
                    }
                }
            }

            if (targetBreakpoint !== null) {
                if (_.activeBreakpoint !== null) {
                    if (targetBreakpoint !== _.activeBreakpoint || forceUpdate) {
                        _.activeBreakpoint =
                            targetBreakpoint;
                        _.options = $.extend({}, _.originalSettings,
                            _.breakpointSettings[
                                targetBreakpoint]);
                        if (initial === true) {
                            _.currentSlide = _.options.initialSlide;
                        }
                        _.refresh(initial);
                        triggerBreakpoint = targetBreakpoint;
                    }
                } else {
                    _.activeBreakpoint = targetBreakpoint;
                    _.options = $.extend({}, _.originalSettings,
                        _.breakpointSettings[
                            targetBreakpoint]);
                    if (initial === true) {
                        _.currentSlide = _.options.initialSlide;
                    }
                    _.refresh(initial);
                    triggerBreakpoint = targetBreakpoint;
                }
            } else {
                if (_.activeBreakpoint !== null) {
                    _.activeBreakpoint = null;
                    _.options = _.originalSettings;
                    if (initial === true) {
                        _.currentSlide = _.options.initialSlide;
                    }
                    _.refresh(initial);
                    triggerBreakpoint = targetBreakpoint;
                }
                else if (initial) {
                    // We must be sure that on init the breakpoint event
                    // will be triggered for default settings (no breakpoint).
                    triggerBreakpoint = null;
                }
            }

            // Always trigger the breakpoint event, so listener could see a
            // complete picture and set up something on init or non-breakpoint
            // layout.
            if (triggerBreakpoint !== false) {
                _.$slider.triggerHandler('breakpoint', [_, triggerBreakpoint]);
            }
        }

    };

    Slick.prototype.changeSlide = function(event, dontAnimate) {

        var _ = this,
            $target = $(event.target),
            indexOffset, slideOffset, unevenOffset;

        // If target is a link, prevent default action.
        if($target.is('a')) {
            event.preventDefault();
        }

        // If target is not the <li> element (ie: a child), find the <li>.
        if(!$target.is('li')) {
            $target = $target.parents('li:first');
        }

        unevenOffset = (_.slideCount % _.options.slidesToScroll !== 0);
        indexOffset = unevenOffset ? 0 : (_.slideCount - _.currentSlide) % _.options.slidesToScroll;

        switch (event.data.message) {

            case 'previous':
                slideOffset = indexOffset === 0 ? _.options.slidesToScroll : _.options.slidesToShow - indexOffset;
                if (_.slideCount > _.options.slidesToShow) {
                    _.slideHandler(_.currentSlide - slideOffset, false, dontAnimate);
                }
                break;

            case 'next':
                slideOffset = indexOffset === 0 ? _.options.slidesToScroll : indexOffset;
                if (_.slideCount > _.options.slidesToShow) {
                    _.slideHandler(_.currentSlide + slideOffset, false, dontAnimate);
                }
                break;

            case 'index':
                var index = event.data.index === 0 ? 0 :
                    event.data.index || $target.index() * _.options.slidesToScroll;

                _.slideHandler(_.checkNavigable(index), false, dontAnimate);
                $target.children().trigger('focus');
                break;

            default:
                return;
        }

    };

    Slick.prototype.checkNavigable = function(index) {

        var _ = this,
            navigables, prevNavigable;

        navigables = _.getNavigableIndexes();
        prevNavigable = 0;
        if (index > navigables[navigables.length - 1]) {
            index = navigables[navigables.length - 1];
        } else {
            for (var n in navigables) {
                if (index < navigables[n]) {
                    index = prevNavigable;
                    break;
                }
                prevNavigable = navigables[n];
            }
        }

        return index;
    };

    Slick.prototype.cleanUpEvents = function() {

        var _ = this;

        if (_.options.arrows === true && _.slideCount > _.options.slidesToShow) {
            _.$prevArrow && _.$prevArrow.unbind('click.ctx-slick', _.changeSlide);
            _.$nextArrow && _.$nextArrow.unbind('click.ctx-slick', _.changeSlide);
        }

        $(window).unbind('orientationchange.ctx-slick.ctx-slick-' + _.instanceUid, _.orientationChange);

        $(window).unbind('resize.ctx-slick.ctx-slick-' + _.instanceUid, _.resize);

        $(window).unbind('load.ctx-slick.ctx-slick-' + _.instanceUid, _.setPosition);
        $(document).unbind('ready.ctx-slick.ctx-slick-' + _.instanceUid, _.setPosition);
    };

    Slick.prototype.destroy = function(refresh) {

        var _ = this;

        _.cleanUpEvents();

        $('.ctx-slick-cloned', _.$slider).remove();


        if ( _.$prevArrow && _.$prevArrow.length ) {

            _.$prevArrow
                .removeClass('ctx-slick-disabled ctx-slick-arrow ctx-slick-hidden')
                .removeAttr('aria-hidden')
                .removeAttr('aria-disabled')
                .removeAttr('tabindex')
                .css("display","");

            if ( _.htmlExpr.test( _.options.prevArrow )) {
                _.$prevArrow.remove();
            }
        }

        if ( _.$nextArrow && _.$nextArrow.length ) {

            _.$nextArrow
                .removeClass('ctx-slick-disabled ctx-slick-arrow ctx-slick-hidden')
                .removeAttr('aria-hidden')
                .removeAttr('aria-disabled')
                .removeAttr('tabindex')
                .css("display","");

            if ( _.htmlExpr.test( _.options.nextArrow )) {
                _.$nextArrow.remove();
            }

        }


        if (_.$slides) {

            _.$slides
                .removeClass('ctx-slick-slide ctx-slick-active ctx-slick-center ctx-slick-visible ctx-slick-current')
                .removeAttr('aria-hidden')
                .removeAttr('data-ctx-slick-index')
                .each(function(){
                    $(this).attr('style', $(this).data('ctxOriginalStyling'));
                });

            _.$slideTrack.children(this.options.slide).remove();

            _.$slideTrack.remove();

            _.$list.remove();

            _.$slider.append(_.$slides);
        }

        _.$slider.removeClass('ctx-slick-slider');
        _.$slider.removeClass('ctx-slick-initialized');

        _.unslicked = true;

        if(!refresh) {
            _.$slider.triggerHandler('destroy', [_]);
        }

    };

    Slick.prototype.disableTransition = function(slide) {

        var _ = this,
            transition = {};

        transition[_.transitionType] = '';

        _.$slideTrack.css(transition);

    };

    Slick.prototype.getLeft = function(slideIndex) {

        var _ = this,
            targetLeft;

        _.slideOffset = 0;

        if (_.slideCount > _.options.slidesToShow) {
            _.slideOffset = (_.slideWidth * _.options.slidesToShow) * -1;
        }
        if (_.slideCount % _.options.slidesToScroll !== 0) {
            if (slideIndex + _.options.slidesToScroll > _.slideCount && _.slideCount > _.options.slidesToShow) {
                if (slideIndex > _.slideCount) {
                    _.slideOffset = ((_.options.slidesToShow - (slideIndex - _.slideCount)) * _.slideWidth) * -1;
                } else {
                    _.slideOffset = ((_.slideCount % _.options.slidesToScroll) * _.slideWidth) * -1;
                }
            }
        }

        if (_.slideCount <= _.options.slidesToShow) {
            _.slideOffset = 0;
        }
        else if (_.options.centerMode === true) {
            _.slideOffset += _.slideWidth * Math.floor(_.options.slidesToShow / 2) - _.slideWidth;
        }

        targetLeft = ((slideIndex * _.slideWidth) * -1) + _.slideOffset;

        return targetLeft;

    };

    Slick.prototype.getNavigableIndexes = function() {

        var _ = this,
            breakPoint,
            counter,
            indexes = [],
            max;

        breakPoint = _.options.slidesToScroll * -1;
        counter = _.options.slidesToScroll * -1;
        max = _.slideCount * 2;

        while (breakPoint < max) {
            indexes.push(breakPoint);
            breakPoint = counter + _.options.slidesToScroll;
            counter += _.options.slidesToScroll <= _.options.slidesToShow ? _.options.slidesToScroll : _.options.slidesToShow;
        }

        return indexes;

    };

    Slick.prototype.init = function() {

        var _ = this;

        if (!$(_.$slider).hasClass('ctx-slick-initialized')) {

            $(_.$slider).addClass('ctx-slick-initialized');

            _.buildOut();
            _.setProps();
            _.loadSlider();
            _.initializeEvents();

        }

    };

    Slick.prototype.initArrowEvents = function() {

        var _ = this;

        if (_.options.arrows === true && _.slideCount > _.options.slidesToShow) {
            _.$prevArrow.bind('click.ctx-slick', {
                message: 'previous'
            }, _.changeSlide);
            _.$nextArrow.bind('click.ctx-slick', {
                message: 'next'
            }, _.changeSlide);
        }

    };

    Slick.prototype.initializeEvents = function() {

        var _ = this;

        _.initArrowEvents();

        $(window).bind('orientationchange.ctx-slick.ctx-slick-' + _.instanceUid, _.proxy(_.orientationChange));

        $(window).bind('resize.ctx-slick.ctx-slick-' + _.instanceUid, _.proxy(_.resize));

        $(window).bind('load.ctx-slick.ctx-slick-' + _.instanceUid, _.setPosition);
        $(document).bind('ready.ctx-slick.ctx-slick-' + _.instanceUid, _.setPosition);

    };

    Slick.prototype.initUI = function() {

        var _ = this;

        if (_.options.arrows === true && _.slideCount > _.options.slidesToShow) {

            _.$prevArrow.show();
            _.$nextArrow.show();

        }

    };

    Slick.prototype.loadSlider = function() {

        var _ = this;

        _.setPosition();

        _.$slideTrack.css({
            opacity: 1
        });

        _.initUI();
    };

    Slick.prototype.orientationChange = function() {

        var _ = this;

        _.checkResponsive();
        _.setPosition();

    };

    Slick.prototype.postSlide = function(index) {

        var _ = this;

        _.$slider.triggerHandler('afterChange', [_, index]);

        _.animating = false;

        _.setPosition();

    };

    Slick.prototype.refresh = function( initializing ) {

        var _ = this, currentSlide;

        if( !initializing ) {

            _.$slider.triggerHandler('beforeRefresh', [_]);

        }

         currentSlide = _.currentSlide;

        _.destroy(true);

        $.extend(_, _.initials, { currentSlide: currentSlide });

        _.init();

        if( !initializing ) {

            _.changeSlide({
                data: {
                    message: 'index',
                    index: currentSlide
                }
            }, true);

            _.$slider.triggerHandler('refresh', [_]);

        }

    };

    Slick.prototype.registerBreakpoints = function() {

        var _ = this, breakpoint, currentBreakpoint, l,
            responsiveSettings = _.options.responsive || null;

        if ( Contextly.Utils.isArray(responsiveSettings) && responsiveSettings.length ) {

            for ( breakpoint in responsiveSettings ) {

                l = _.breakpoints.length-1;
                currentBreakpoint = responsiveSettings[breakpoint].breakpoint;

                if (responsiveSettings.hasOwnProperty(breakpoint)) {

                    // loop through the breakpoints and cut out any existing
                    // ones with the same breakpoint number, we don't want dupes.
                    while( l >= 0 ) {
                        if( _.breakpoints[l] && _.breakpoints[l] === currentBreakpoint ) {
                            _.breakpoints.splice(l,1);
                        }
                        l--;
                    }

                    _.breakpoints.push(currentBreakpoint);
                    _.breakpointSettings[currentBreakpoint] = responsiveSettings[breakpoint].settings;

                }

            }

            _.breakpoints.sort(function(a, b) {
                return b-a;
            });

        }

    };

    Slick.prototype.resize = function() {

        var _ = this;

        if ($(window).width() !== _.windowWidth) {
            clearTimeout(_.windowDelay);
            _.windowDelay = window.setTimeout(function() {
                _.windowWidth = $(window).width();
                _.checkResponsive();
                if( !_.unslicked ) { _.setPosition(); }
            }, 50);
        }
    };

    Slick.prototype.setCSS = function(position) {

        var _ = this,
            positionProps = {},
            x, y;

        x = _.positionProp == 'left' ? Math.ceil(position) + 'px' : '0px';
        y = _.positionProp == 'top' ? Math.ceil(position) + 'px' : '0px';

        positionProps[_.positionProp] = position;

        if (_.transformsEnabled === false) {
            _.$slideTrack.css(positionProps);
        } else {
            positionProps = {};
            if (_.cssTransitions === false) {
                positionProps[_.animType] = 'translate(' + x + ', ' + y + ')';
                _.$slideTrack.css(positionProps);
            } else {
                positionProps[_.animType] = 'translate3d(' + x + ', ' + y + ', 0px)';
                _.$slideTrack.css(positionProps);
            }
        }

    };

    Slick.prototype.setDimensions = function() {

        var _ = this;

        if (_.options.centerMode === true) {
            _.$list.css({
                padding: ('0px ' + _.options.centerPadding)
            });
        }

        _.listWidth = _.$list.width();
        _.listHeight = _.$list.height();

        _.slideWidth = Math.ceil(_.listWidth / _.options.slidesToShow);
        _.$slideTrack.width(Math.ceil((_.slideWidth * _.$slideTrack.children('.ctx-slick-slide').length)));

        var offset = _.$slides.eq(0).outerWidth(true) - _.$slides.eq(0).width();
        _.$slideTrack.children('.ctx-slick-slide').width(_.slideWidth - offset);

    };

    Slick.prototype.setPosition = function() {

        var _ = this;

        _.setDimensions();

        _.setCSS(_.getLeft(_.currentSlide));

        _.$slider.triggerHandler('setPosition', [_]);

    };

    Slick.prototype.setProps = function() {

        var _ = this,
            bodyStyle = document.body.style;

        _.positionProp = 'left';

        if (bodyStyle.WebkitTransition !== undefined ||
            bodyStyle.MozTransition !== undefined ||
            bodyStyle.msTransition !== undefined) {
            if (_.options.useCSS === true) {
                _.cssTransitions = true;
            }
        }

        if (bodyStyle.webkitTransform !== undefined) {
            _.animType = 'webkitTransform';
            _.transformType = '-webkit-transform';
            _.transitionType = 'webkitTransition';
            if (bodyStyle.perspectiveProperty === undefined && bodyStyle.webkitPerspective === undefined) _.animType = false;
        }
        if (bodyStyle.transform !== undefined && _.animType !== false) {
            _.animType = 'transform';
            _.transformType = 'transform';
            _.transitionType = 'transition';
        }
        _.transformsEnabled = _.options.useTransform && (_.animType !== null && _.animType !== false);
    };


    Slick.prototype.setSlideClasses = function(index) {

        var _ = this,
            centerOffset, allSlides, indexOffset, remainder;

        allSlides = _.$slider
            .find('.ctx-slick-slide')
            .removeClass('ctx-slick-active ctx-slick-center ctx-slick-current')
            .attr('aria-hidden', 'true');

        _.$slides
            .eq(index)
            .addClass('ctx-slick-current');

        if (_.options.centerMode === true) {

            centerOffset = Math.floor(_.options.slidesToShow / 2);

            if (index >= centerOffset && index <= (_.slideCount - 1) - centerOffset) {

                _.$slides
                    .slice(index - centerOffset, index + centerOffset + 1)
                    .addClass('ctx-slick-active')
                    .attr('aria-hidden', 'false');

            } else {

                indexOffset = _.options.slidesToShow + index;
                allSlides
                    .slice(indexOffset - centerOffset + 1, indexOffset + centerOffset + 2)
                    .addClass('ctx-slick-active')
                    .attr('aria-hidden', 'false');

            }

            if (index === 0) {

                allSlides
                    .eq(allSlides.length - 1 - _.options.slidesToShow)
                    .addClass('ctx-slick-center');

            } else if (index === _.slideCount - 1) {

                allSlides
                    .eq(_.options.slidesToShow)
                    .addClass('ctx-slick-center');

            }


            _.$slides
                .eq(index)
                .addClass('ctx-slick-center');

        } else {

            if (index >= 0 && index <= (_.slideCount - _.options.slidesToShow)) {

                _.$slides
                    .slice(index, index + _.options.slidesToShow)
                    .addClass('ctx-slick-active')
                    .attr('aria-hidden', 'false');

            } else if (allSlides.length <= _.options.slidesToShow) {

                allSlides
                    .addClass('ctx-slick-active')
                    .attr('aria-hidden', 'false');

            } else {

                remainder = _.slideCount % _.options.slidesToShow;
                indexOffset = _.options.slidesToShow + index;

                if (_.options.slidesToShow == _.options.slidesToScroll && (_.slideCount - index) < _.options.slidesToShow) {

                    allSlides
                        .slice(indexOffset - (_.options.slidesToShow - remainder), indexOffset + remainder)
                        .addClass('ctx-slick-active')
                        .attr('aria-hidden', 'false');

                } else {

                    allSlides
                        .slice(indexOffset, indexOffset + _.options.slidesToShow)
                        .addClass('ctx-slick-active')
                        .attr('aria-hidden', 'false');

                }

            }

        }
    };

    Slick.prototype.setupInfinite = function() {

        var _ = this,
            i, slideIndex, infiniteCount;


        slideIndex = null;

        if (_.slideCount > _.options.slidesToShow) {

            if (_.options.centerMode === true) {
                infiniteCount = _.options.slidesToShow + 1;
            } else {
                infiniteCount = _.options.slidesToShow;
            }

            for (i = _.slideCount; i > (_.slideCount -
                    infiniteCount); i -= 1) {
                slideIndex = i - 1;
                $(_.$slides[slideIndex]).clone(true).attr('id', '')
                    .attr('data-ctx-slick-index', slideIndex - _.slideCount)
                    .prependTo(_.$slideTrack).addClass('ctx-slick-cloned');
            }
            for (i = 0; i < infiniteCount; i += 1) {
                slideIndex = i;
                $(_.$slides[slideIndex]).clone(true).attr('id', '')
                    .attr('data-ctx-slick-index', slideIndex + _.slideCount)
                    .appendTo(_.$slideTrack).addClass('ctx-slick-cloned');
            }
            _.$slideTrack.find('.ctx-slick-cloned').find('[id]').each(function() {
                $(this).attr('id', '');
            });

        }

    };

    Slick.prototype.slideHandler = function(index, sync, dontAnimate) {

        var targetSlide, animSlide, slideLeft, targetLeft,
            _ = this;

        if (_.animating === true && _.options.waitForAnimate === true) {
            return;
        }

        if (_.slideCount <= _.options.slidesToShow) {
            return;
        }

        targetSlide = index;
        targetLeft = _.getLeft(targetSlide);
        slideLeft = _.getLeft(_.currentSlide);

        _.currentLeft = slideLeft;

        if (targetSlide < 0) {
            if (_.slideCount % _.options.slidesToScroll !== 0) {
                animSlide = _.slideCount - (_.slideCount % _.options.slidesToScroll);
            } else {
                animSlide = _.slideCount + targetSlide;
            }
        } else if (targetSlide >= _.slideCount) {
            if (_.slideCount % _.options.slidesToScroll !== 0) {
                animSlide = 0;
            } else {
                animSlide = targetSlide - _.slideCount;
            }
        } else {
            animSlide = targetSlide;
        }

        _.animating = true;

        _.$slider.triggerHandler('beforeChange', [_, _.currentSlide, animSlide]);

        _.currentSlide = animSlide;

        _.setSlideClasses(_.currentSlide);

        if (dontAnimate !== true) {
            _.animateSlide(targetLeft, function() {
                _.postSlide(animSlide);
            });
        } else {
            _.postSlide(animSlide);
        }

    };

    Contextly.Slick = Slick;

})(jQuery);
