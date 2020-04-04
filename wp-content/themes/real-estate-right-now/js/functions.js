/* global realestaterightnow_screenReaderText */
/**
 * Theme functions file.
 *
 * Contains handlers for navigation and widget area.
 */
(function($) {
	var body, masthead, menuToggle, siteNavigation, socialNavigation, siteHeaderMenu, resizeTimer;
	function realestaterightnow_initMainNavigation(container) {
		// Add dropdown toggle that displays child menu items.
		var dropdownToggle = $('<button />', {
			'class': 'dropdown-toggle',
			'aria-expanded': false
		}).append($('<span />', {
			'class': 'screen-reader-text',
			text: realestaterightnow_screenReaderText.expand
		}));
		container.find('.menu-item-has-children > a').after(dropdownToggle);
		// Toggle buttons and submenu items with active children menu items.
		container.find('.current-menu-ancestor > button').addClass('toggled-on');
		container.find('.current-menu-ancestor > .sub-menu').addClass('toggled-on');
		// Add menu items with submenus to aria-haspopup="true".
		container.find('.menu-item-has-children').attr('aria-haspopup', 'true');
		container.find('.dropdown-toggle').click(function(e) {
			var _this = $(this),
				screenReaderSpan = _this.find('.screen-reader-text');
			e.preventDefault();
			_this.toggleClass('toggled-on');
			_this.next('.children, .sub-menu').toggleClass('toggled-on');
			// jscs:disable
			_this.attr('aria-expanded', _this.attr('aria-expanded') === 'false' ? 'true' : 'false');
			// jscs:enable

            if(typeof screenReaderText !== 'undefined')
            { 
                screenReaderSpan.text(screenReaderSpan.text() === realestaterightnow_screenReaderText.expand ? screenReaderText.collapse : screenReaderText.expand);
		    }



		});
	}
	realestaterightnow_initMainNavigation($('.main-navigation'));
	masthead = $('#masthead');
	menuToggle = masthead.find('#menu-toggle');
	siteHeaderMenu = masthead.find('#site-header-menu');
	siteNavigation = masthead.find('#site-navigation');
	socialNavigation = masthead.find('#social-navigation');
	// Enable menuToggle.
	(function() {
		// Return early if menuToggle is missing.
		if (!menuToggle.length) {
			return;
		}
		// Add an initial values for the attribute.
		menuToggle.add(siteNavigation).add(socialNavigation).attr('aria-expanded', 'false');
		menuToggle.on('click.realestaterightnow_', function() {
			$(this).add(siteHeaderMenu).toggleClass('toggled-on');
			// jscs:disable
			$(this).add(siteNavigation).add(socialNavigation).attr('aria-expanded', $(this).add(siteNavigation).add(socialNavigation).attr('aria-expanded') === 'false' ? 'true' : 'false');
			// jscs:enable
		});
	})();
	// Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
	(function() {
		if (!siteNavigation.length || !siteNavigation.children().length) {
			return;
		}
		// Toggle `focus` class to allow submenu access on tablets.
		function realestaterightnow_toggleFocusClassTouchScreen() {
			if (window.innerWidth >= 910) {
				$(document.body).on('touchstart.realestaterightnow_', function(e) {
					if (!$(e.target).closest('.main-navigation li').length) {
						$('.main-navigation li').removeClass('focus');
					}
				});
				siteNavigation.find('.menu-item-has-children > a').on('touchstart.realestaterightnow_', function(e) {
					var el = $(this).parent('li');
					if (!el.hasClass('focus')) {
						e.preventDefault();
						el.toggleClass('focus');
						el.siblings('.focus').removeClass('focus');
					}
				});
			} else {
				siteNavigation.find('.menu-item-has-children > a').unbind('touchstart.realestaterightnow_');
			}
		}
		if ('ontouchstart' in window) {
			$(window).on('resize.realestaterightnow_', realestaterightnow_toggleFocusClassTouchScreen);
			realestaterightnow_toggleFocusClassTouchScreen();
		}
		siteNavigation.find('a').on('focus.realestaterightnow_ blur.realestaterightnow_', function() {
			$(this).parents('.menu-item').toggleClass('focus');
		});
	})();
	// Add the default ARIA attributes for the menu toggle and the navigations.
	function realestaterightnow_onResizeARIA() {
		if (window.innerWidth < 910) {
			if (menuToggle.hasClass('toggled-on')) {
				menuToggle.attr('aria-expanded', 'true');
			} else {
				menuToggle.attr('aria-expanded', 'false');
			}
			if (siteHeaderMenu.hasClass('toggled-on')) {
				siteNavigation.attr('aria-expanded', 'true');
				socialNavigation.attr('aria-expanded', 'true');
			} else {
				siteNavigation.attr('aria-expanded', 'false');
				socialNavigation.attr('aria-expanded', 'false');
			}
			menuToggle.attr('aria-controls', 'site-navigation social-navigation');
		} else {
			menuToggle.removeAttr('aria-expanded');
			siteNavigation.removeAttr('aria-expanded');
			socialNavigation.removeAttr('aria-expanded');
			menuToggle.removeAttr('aria-controls');
		}
	}
	// Add 'below-entry-meta' class to elements.
	function realestaterightnow_belowEntryMetaClass(param) {
		if (body.hasClass('page') || body.hasClass('search') || body.hasClass('single-attachment') || body.hasClass('error404')) {
			return;
		}
		$('.entry-content').find(param).each(function() {
			var element = $(this),
				elementPos = element.offset(),
				elementPosTop = elementPos.top,
				entryFooter = element.closest('article').find('.entry-footer'),
				entryFooterPos = entryFooter.offset(),
				entryFooterPosBottom = entryFooterPos.top + (entryFooter.height() + 28),
				caption = element.closest('figure'),
				newImg;
			// Add 'below-entry-meta' to elements below the entry meta.
			if (elementPosTop > entryFooterPosBottom) {
				// Check if full-size images and captions are larger than or equal to 840px.
				if ('img.size-full' === param) {
					// Create an image to find native image width of resized images (i.e. max-width: 100%).
					newImg = new Image();
					newImg.src = element.attr('src');
					$(newImg).on('load.realestaterightnow_', function() {
						if (newImg.width >= 840) {
							element.addClass('below-entry-meta');
							if (caption.hasClass('wp-caption')) {
								caption.addClass('below-entry-meta');
								caption.removeAttr('style');
							}
						}
					});
				} else {
					element.addClass('below-entry-meta');
				}
			} else {
				element.removeClass('below-entry-meta');
				caption.removeClass('below-entry-meta');
			}
		});
	}
		body = $("#page");    
		$(window).on('load.realestaterightnow_', realestaterightnow_onResizeARIA).on('resize.realestaterightnow_', function() {
			clearTimeout(resizeTimer);
			resizeTimer = setTimeout(function() {
				realestaterightnow_belowEntryMetaClass('img.size-full');
				realestaterightnow_belowEntryMetaClass('blockquote.alignleft, blockquote.alignright');
			}, 300);
			realestaterightnow_onResizeARIA();
		});
		realestaterightnow_belowEntryMetaClass('img.size-full');
		realestaterightnow_belowEntryMetaClass('blockquote.alignleft, blockquote.alignright');
		$("#display_loading").fadeOut("slow");
		var amountScrolled = 300;
		$(window).scroll(function() {
			if ($(window).scrollTop() > amountScrolled) {
				$('a.back-to-top').fadeIn('fast');
			} else {
				$('a.back-to-top').fadeOut('fast');
			}
		});
		$('a.back-to-top, a.simple-back-to-top').click(function() {
			$("html, body").animate({
				scrollTop: 0
			}, "fast");
			return false;
		}); /* Sticky Header */
		$(window).bind("load resize scroll", function(e) {
			win = $(window);
    		var realestaterightnow_width = document.body.offsetWidth;
   			var top_header = $("#top_header");
   			var site_header = $(".site-header"); 
    			var site_header_main = $(".site-header-main");
       			var realestaterightnow_my_shopping_cart = $(".realestaterightnow_my_shopping_cart");
                realestaterightnow_my_shopping_cart
    			var pos = site_header.offset().top;
    			realestaterightnow_width = document.body.offsetWidth;
    			var rolou = win.scrollTop();
    			rolar = rolou - 150;
            if (realestaterightnow_width > 910) 
            {                
    			if (rolou > 50)
                 {
                    
                    
   			
                    //top_header.attr('style', 'opacity: 0 !important');
   		         	top_header.slideUp();
    			
                
                	// realestaterightnow_my_shopping_cart.attr('style', 'display: none !important');
                    realestaterightnow_my_shopping_cart.slideUp();
                    
   
   
      				site_header_main.attr('style', 'margin-top: -10px !important;') // , 'max-height: 50px!important');
    				site_header.attr('style', 'margin-top: ' + (rolar) + 'px !important;') // , 'max-height: 50px!important');
  
                   
                    site_header.css({
                        "position": "absolute",
                        "padding-top": "0px !important",
                        /* "max-height": "151px", */
                        "min-height" : "90px !important"
                        
                        
                    });
                    
                    
    			} else {
                //	site_header.attr('style', 'margin-top: ' + (rolar) + 'px !important;') // , 'max-height: 50px!important');
                				site_header.attr('style', 'margin-top: -150px !important'); // , 'max-height: 50px!important');
                	site_header_main.attr('style', 'margin-top: -20px !important');
                     // , 'max-height: 50px!important');
    				realestaterightnow_my_shopping_cart.attr('style', 'display: block !important');
                    if (realestaterightnow_width > 910) {
    					top_header.attr('style', 'display: block');
                        top_header.css ({"margin-top" : "30px"});
                    }
    			}
             }
             else
             {
                top_header.attr('style', 'display: none !important');
                site_header.css({
                        "position": "relative",
                    }); 
     			if (rolou > 100) {
    			    rolar = rolar + 80;
                	site_header_main.attr('style', 'margin-top: 0px !important;'); // , 'max-height: 50px!important');
    			//	site_header.attr('style', 'margin-top: ' - rolar + 'px !important;') // , 'max-height: 50px!important');
 							site_header.attr('style', 'margin-top: -150px !important'); // , 'max-height: 50px!important');
     				site_header.attr('style', 'padding-bottom: 10px !important;'); // , 'max-height: 50px!important');
    			} else {
                    site_header_main.attr('style', 'margin-top: -20px !important;'); // , 'max-height: 50px!important');
    			}
             }
		});
                  $( "a" ).hover(
                  function() {
                    $( this ).animate({
                      opacity: .7
                      }, 500 );
                  }, 
                  function() {
                     $( this ).animate({
                         opacity: 1
                         }, 500 );      
                  }
);
})(jQuery);
jQuery(function () 
{ 
  jQuery(window).on('load', function () {
     jQuery("#realestate-loader").fadeOut();
    });  
    
    
    
    
    
		jQuery('#search-toggle').click(function(e) {
		  
          
          
			if (jQuery('#realestaterightnow_searchform').is(':visible')) {
                 jQuery("#realestaterightnow_searchform").slideUp();
			} else {
				jQuery("#realestaterightnow_searchform").slideDown();
			}
		});
		// Search toggle
		jQuery('.search-submit').click(function(e) {
			if (jQuery(this).parent().find('.search-field').val() == '') {
				e.preventDefault();
				jQuery("#realestaterightnow_searchform").slideUp();
			}
		});
		if (jQuery(".realestaterightnow_blog_grid").length) {
			var m = new Masonry(jQuery('.realestaterightnow_blog_grid').get()[0], {
				itemSelector: ".realestaterightnow_masonry_thumbnail",
				gutter: 0
			});
		}    
    
    
    
    
    
     
});