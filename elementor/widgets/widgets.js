(function ($, window) {
    "use strict";
    var $window = $(window);
    var drthWidgets = {
        LoadWidgets: function () {
            var e_front = elementorFrontend,
                e_module = elementorModules;
            
            var $proWidgets = {
                "dladdons-countdown-pro.default": '_dl_pro_count_down',
                "dladdons-testimonial-pro.default":'_dl_pro_advance_slider',
                "droit-teams.default": '_dl_pro_team',
                "dladdons-animated-image.default":'_dl_pro_animated_img',
                "droit-advance-accordions.default": '_dl_pro_accordions',
                "droit-blogs.default": '_dl_pro_blogs',
                "droit-blogs_grid.default": '_dl_pro_blog_grid',
                "droit-tabs.default": '_dl_pro_tabs',
                "droit-image_compare.default": '_dl_pro_compare',
                "droit-fun_fact.default": '_dl_pro_counterup',
                "droit-advance_pricing.default": '_dl_pro_advance_pricing',
                "droit-adavnced-slider.default": '_dl_pro_advance_slider',
                "droit-video_popup.default": '_video_popup',
            }; 
            
            var widgetsMap = {
                "drth-test.default": drthWidgets.drth_test,
                //"dladdons-countdown-pro.default": drthWidgets._dl_pro_count_down,
                "dladdons-testimonial-pro.default": drthWidgets._dl_pro_advance_slider,
                "droit-teams.default": drthWidgets._dl_pro_team,
                "droit-advance-accordions.default": drthWidgets._dl_pro_accordions,
                "droit-blogs.default": drthWidgets._dl_pro_blogs,
                "droit-blogs_grid.default": drthWidgets._dl_pro_blog_grid,
                "droit-tabs.default": drthWidgets._dl_pro_tabs,
                "droit-image_compare.default": drthWidgets._dl_pro_compare,
                "droit-fun_fact.default": drthWidgets._dl_pro_counterup,
                "droit-advance_pricing.default": drthWidgets._dl_pro_advance_pricing,
                "droit-adavnced-slider.default": drthWidgets._dl_pro_advance_slider,
                "droit-video_popup.default": drthWidgets._video_popup,
                "drth-filter-gallery.default": drthWidgets._dl_pro_filter_gallery,
            };
           
            $.each(widgetsMap, function (name, callback) {
                if( dlth_theme.dl_pro == 'yes' && name in $proWidgets ) {
                   
                } else{
                   e_front.hooks.addAction("frontend/element_ready/" + name, callback);
                }
            });
        },
        // test
        drth_test: function($scope){
            //alert();
        },
        _dl_pro_count_down: function ($scope, t) {
            var $selector = $scope.find(".droit-countdown-wrapper-pro"),
              $countdown_id =
                void 0 !== $selector.data("countdown-id")
                  ? $selector.data("countdown-id")
                  : "",
              $end_type =
                void 0 !== $selector.data("end-type")
                  ? $selector.data("end-type")
                  : "",
              $end_title =
                void 0 !== $selector.data("end-title")
                  ? $selector.data("end-title")
                  : "",
              $end_text =
                void 0 !== $selector.data("end-text")
                  ? $selector.data("end-text")
                  : "",
              $redirect_url =
                void 0 !== $selector.data("redirect-url")
                  ? $selector.data("redirect-url")
                  : "",
              $item = $scope.find("#droit-countdown-pro-" + $countdown_id);
                $item.countdown({
                end: function () {
                    if ("text" == $end_type)
                    $item.html(
                        '<div class="droit-countdown-action-message"><h4 class="droit-countdown-end-title">' +
                        $end_title +
                        '</h4><div class="droit-countdown-end-text">' +
                        $end_text +
                        "</div></div>"
                    );
                    else if ("url" === $end_type) {
                    _dl_pro_count_down_redirect($redirect_url);
                    }
                },
                });
        },
    
        _dl_pro_team: function ($scope, t) {
            var $selector = $scope.find(".mouse_move_animation");
            if ($($selector).length > 0) {
                $($selector).parallax({ scalarX: 10.0, scalarY: 8.0 });
            }
        },
        _dl_pro_accordions: function ($scope) {
            var $accrodion = $scope.find(".dl_accordion");
            if ($accrodion.length > 0) {
                $accrodion.find(".dl_accordion_item.is-active").children(".dl_accordion_panel").slideDown();
                $accrodion.find(".dl_accordion_item").on("click", function () {
                    // Cancel the siblings
                    $(this).siblings(".dl_accordion_item").removeClass("is-active").children(".dl_accordion_panel").slideUp();
                    // Toggle the item
                    $(this).toggleClass("is-active").children(".dl_accordion_panel").slideToggle("ease-out");
                });
            }
        },
    
        _dl_pro_blogs: function ($scope, t, e) {
        var $blogSelector = $scope.find(".droit__blog--wrap"),
            pagination = $blogSelector.data("pagination"),
            layout = $blogSelector.data("layout"),
            pageNumber = 1;
        if ("masonry" === layout) {
            var $selector = $scope.find(".droit__blog---inner-wrap");
            $selector.dlAddonsGridLayout();
        }
        if (pagination) {
            $scope.on("click", ".page-numbers", function (e) {
            e.preventDefault();
            if ($(this).hasClass("current")) return;
            var currentPage = parseInt(
                $scope.find(".page-numbers.current").html()
            );
            if ($(this).hasClass("next")) {
                pageNumber = currentPage + 1;
            } else if ($(this).hasClass("prev")) {
                pageNumber = currentPage - 1;
            } else {
                pageNumber = $(this).html();
            }
            getPostsByAjax(scrollAfter);
            });
        }
        if ("tab" === layout) {
            var a =
            "#" + $scope.find(".droit-blog-tabs-container").attr("id").toString();
            t(a + " ul.dl_tab_menu > li").each(function (e) {
            t(this).hasClass("active-default")
                ? (t(a + " ul.dl_tab_menu > li")
                    .removeClass("dl_active")
                    .addClass("dl_inactive"),
                t(this).removeClass("dl_inactive"))
                : 0 == e &&
                t(this).removeClass("dl_inactive").addClass("dl_active");
            }),
            t(a + " .tab_container div").each(function (e) {
                t(this).hasClass("active-default")
                ? t(a + " .tab_container > div").removeClass("dl_active")
                : 0 == e &&
                    t(this).removeClass("dl_inactive").addClass("dl_active");
            }),
            t(a + " ul.dl_tab_menu > li").click(function () {
                var e = t(this).index(),
                a = t(this).closest(".droit-advance-tabs"),
                n = t(a)
                    .children(".droit-tabs-nav")
                    .children("ul")
                    .children("li"),
                i = t(a).children(".tab_container").children("div");
                t(this).parent("li").addClass("dl_active"),
                t(n)
                    .removeClass("dl_active active-default")
                    .addClass("dl_inactive"),
                t(this).addClass("dl_active").removeClass("dl_inactive"),
                t(i).removeClass("dl_active").addClass("dl_inactive"),
                t(i).eq(e).addClass("dl_active").removeClass("dl_inactive");
                t(i).each(function (e) {
                t(this).removeClass("active-default");
                });
            });
        }
        function getPostsByAjax(shouldScroll) {
            $.ajax({
            url: dlpro.ajaxurl,
            type: "post",
            data: {
                action: "droit_pro_get_posts",
                page_id: $blogElement.data("page"),
                widget_id: $scope.data("id"),
                page_number: pageNumber,
                nonce: dlpro.nonce,
            },
            beforeSend: function () {
                console.log("before");
            },
            success: function (res) {
                console.log("before");
                if (!res.data) return;
                var posts = res.data.posts,
                paging = res.data.paging;
                $blogElement.html(posts);
                $scope.find(".droit-blog-footer").html(paging);
            },
            error: function (err) {
                console.log(err);
            },
            });
            return !1;
        }
        },
        _dl_pro_blog_grid: function ($scope, t, e) {
        var $blogSelector = $scope.find(".dl__blog--grid-inner"),
            pagination = $blogSelector.data("pagination"),
            layout = $blogSelector.data("layout"),
            isLoaded = true,
            pageNumber = 1;
        if (pagination) {
            $scope.on("click", ".page-numbers", function (e) {
            e.preventDefault();
            if ($(this).hasClass("current")) return;
            var currentPage = parseInt(
                $scope.find(".page-numbers.current").html()
            );
            if ($(this).hasClass("next")) {
                pageNumber = currentPage + 1;
            } else if ($(this).hasClass("prev")) {
                pageNumber = currentPage - 1;
            } else {
                pageNumber = $(this).html();
            }
            gridPostsByAjax(false);
            });
        }
        function gridPostsByAjax(shouldScroll) {
            $.ajax({
            url: dlpro.ajaxurl,
            type: "post",
            data: {
                action: "droit_pro_get_grid_posts",
                page_id: $blogSelector.data("page"),
                widget_id: $scope.data("id"),
                page_number: pageNumber,
                nonce: dlpro.nonce,
            },
            beforeSend: function () {
                //console.log("before");
            },
            success: function (res) {
                if (!res.data) return;
                var posts = res.data.posts,
                paging = res.data.paging;
                $blogSelector.html(posts);
                $scope.find(".dl-grid-pagination").html(paging);
            },
            error: function (err) {
                // console.log(err);
            },
            });
            return !1;
        }
        function getInfiniteScrollPosts() {
            var windowHeight = jQuery(window).outerHeight() / 1.25;
    
            $(window).scroll(function () {
            if (filterTabs) {
                $blogPost = $blogSelector.find(".blog-grid-item");
                total = $blogPost.data("total");
            }
    
            if (count <= total) {
                if (
                $(window).scrollTop() + windowHeight >=
                $scope.find(".blog-grid-item:last").offset().top
                ) {
                if (true == isLoaded) {
                    pageNumber = count;
                    gridPostsByAjax(false);
                    count++;
                    isLoaded = false;
                }
                }
            }
            });
        }
        },
        _dl_pro_tabs: function ($scope, t, e) {
            var a = "#" + $scope.find(".dl_tab_container").attr("id").toString();
            t(a + " ul.dl_tab_menu > li").each(function (e) {
                t(this).hasClass("active-default")
                ? (t(a + " ul.dl_tab_menu > li")
                    .removeClass("dl_active")
                    .addClass("dl_inactive"),
                    t(this).removeClass("dl_inactive"))
                : 0 == e && t(this).removeClass("dl_inactive").addClass("dl_active");
            }),
            t(a + " .tab_container div").each(function (e) {
            t(this).hasClass("active-default")
                ? t(a + " .tab_container > div").removeClass("dl_active")
                : 0 == e &&
                t(this).removeClass("dl_inactive").addClass("dl_active");
            }),
            t(a + " ul.dl_tab_menu > li").click(function () {
            var e = t(this).index(),
                a = t(this).closest(".droit-advance-tabs"),
                n = t(a).children(".droit-tabs-nav").children("ul").children("li"),
                i = t(a).children(".tab_container").children("div");
            t(this).parent("li").addClass("dl_active"),
                t(n)
                .removeClass("dl_active active-default")
                .addClass("dl_inactive"),
                t(this).addClass("dl_active").removeClass("dl_inactive"),
                t(i).removeClass("dl_active").addClass("dl_inactive"),
                t(i).eq(e).addClass("dl_active").removeClass("dl_inactive");
            t(i).each(function (e) {
                t(this).removeClass("active-default");
            });
            });
        },
        _dl_pro_compare: function ($scope) {
            var $selector = $scope.find(".dl_image_swipe"),
                controls = null,
                before_label = "Before",
                after_label = "After",
                orientation_style = "",
                overlay = false,
                move = true,
                offset = 0.5,
                _icon_type = "",
                left_icon = "fas fa-chevron-left",
                right_icon = "fas fa-chevron-right";
        
            if ($selector.attr("data-controls")) {
                var controls = JSON.parse($selector.attr("data-controls"));
                before_label = controls.before;
                after_label = controls.after;
                move = controls.move == "yes" ? true : false;
                overlay =
                move == "yes" ? false : controls.overlay == "yes" ? true : false;
                orientation_style = controls.orientation;
                offset = controls.offset;
                _icon_type = controls.icon_type;
                left_icon = controls.left_icon;
                right_icon = controls.right_icon;
            }
            var $obj = {};
            $obj.before_label = before_label;
            $obj.after_label = after_label;
            $obj.orientation = orientation_style;
            $obj.no_overlay = overlay;
            $obj.move_slider_on_hover = move;
            $obj.default_offset_pct = offset;
            $obj._icon_type = _icon_type;
            $obj.left_icon = left_icon;
            $obj.right_icon = right_icon;
            if ($($selector).length) {
                $($selector).imagesLoaded(function () {
                $($selector).twentytwenty($obj);
                });
            }
            
            let $id = $selector.attr('id');
            let $idSelector = document.querySelector('#'+$id);
            if( $idSelector ){
                let $before = $idSelector.querySelector('img').offsetWidth;
                $scope.find(".dl_product_compaire").css("width", $before+"px");
            }
        },
        _dl_pro_counterup: function ($scope) {
            var $selector = $scope.find(".dl-fun-fact-wrapper"),
                $selector_id = "#" + $selector.attr("id").toString(),
                controls = null,
                delay = 10,
                timer = 1000;
            if ($selector.attr("data-controls")) {
                var controls = JSON.parse($selector.attr("data-controls"));
                delay = controls.delay;
                timer = controls.timer;
            }
            if ($selector_id.length > 0) {
                $($selector_id + " .fun-counter").counterUp({
                delay: delay,
                time: timer,
                });
            }
        },
        _dl_pro_advance_pricing: function ($scope) {
        var t = $scope.find(".dl_switcher_control-item"),
            h = $scope.find(".dl_switcher_content-item");
            // tab style
            t.click(function (e) {
                e.preventDefault();
                var $this = $(this);
        
                // close all switcher active class
                t.each(function () {
                let $self = $(this);
                $self.removeClass("on-select");
                });
        
                // close all content tab
                h.each(function () {
                let $self = $(this);
                $self.removeClass("on-active");
                });
        
                // selector content
                let $target = $this.data("target");
                let $content = $scope.find("[data-toggle=" + $target + "]");
                $content.addClass("on-active");
                // selected tab
                $this.addClass("on-select");
            });
    
            // switch style
            var s = $scope.find(".dl_toggle");
            s.click(function (e) {
                e.preventDefault();
                var $this = $(this);
                $this.toggleClass("dl-active");
                $this.parents(".dl_switcher_control").toggleClass("dl-active");
        
                // content
                h.each(function () {
                let $self = $(this);
                $self.toggleClass("on-active");
                });
            });
        },
        _dl_pro_advance_slider: function ($scope) {
            var $slider = $scope.find(
                ".dl_advance_slider, .dl_pro_testimonial_slider"
                ),
                $item = $scope.find(".swiper-slide"),
                $dat = $slider.data("settings");
        
            // render slider
            new Swiper($slider, $dat);
        
            // auto slider
            if ($dat.dl_mouseover) {
                $slider.hover(
                function () {
                    this.swiper.autoplay.stop();
                },
                function () {
                    this.swiper.autoplay.start();
                }
                );
            }
        
            if ($dat.dl_autoplay) {
                $slider.each(function () {
                this.swiper.autoplay.start();
                });
            } else {
                $slider.each(function () {
                this.swiper.autoplay.stop();
                });
            }
        
            let $delay = $dat.speed;
            if ($dat.autoplay) {
                $delay = $dat.autoplay.delay;`1`
            }
        },
        _dl_pro_animated_img: function ($scope) {
            var $parallax_img = $scope.find(
                ".droit_parallax_img_wrapper"
                ),
                $parallax_data = $parallax_img.data("settings");
        
        },
        _video_popup: function ($scope) {
            var $selector = $scope.find(".droit-video-popup");
            if ($selector.length > 0) {
                $($selector).magnificPopup({
                type: "iframe",
                mainClass: "mfp-fade",
                removalDelay: 160,
                preloader: !0,
                fixedContentPos: !1,
                });
            }
        },
        _dl_pro_filter_gallery: function($scope){
            var $id = $scope.data('id');
            let $el = $scope.find('#dl_filter_'+$id);
            if($el.length > 0){
                let $content = $el.find('.dl_filter_gallery_wrapper');
                let $btns = $el.find('.dl_data_filter_item');
                
                let is_rtl = $content.data('rtl') ? false : true;
                let $layout = $content.data('layout');

                var item = $content.find( '.dl_filter_item' ),
				$columns = $content.data('columns') ? $content.data('columns') : 3,
				$gutter = $content.data('gutter') ? $content.data('gutter') : 0,
				$contWidth = $content.width() + $gutter - 0.3;

			    item.outerWidth( Math.floor( $contWidth / $columns - $gutter ) );


                if( $content.length > 0){
                    $el.imagesLoaded(function () {
                        
                        if ('masonry' == $layout) {
                            $content.isotope({
                                itemSelector: '.dl_filter_item',
                                percentPosition: true,
                                originLeft: is_rtl,
                                layoutMode: "masonry",
                                masonry: {
                                    columnWidth: '.dl_filter_item',
                                    gutter: $gutter
                                },
                                fitRows: {
                                    gutter: $gutter
                                }
                            });
                        } else {
                            $content.isotope({
                                itemSelector: '.dl_filter_item',
                                layoutMode: 'fitRows',
                                originLeft: is_rtl,
                                fitRows: {
                                    gutter: $gutter
                                }
                            });
                        }
                    });
                    
                   
                    $btns.each(function(i, btns) {
                        var btns = $(btns);
                         btns.on('click', function() {
                            btns.find('.current').removeClass('current');
                            $(this).addClass('current');
                            var filterValue = $(this).attr('data-filter');
                
                            $content.isotope({
                                filter: filterValue,
                                originLeft: is_rtl,
                            });
                        });
                    });

                    $el.find('.dl_filter_item').resize(function() {
                        $content.isotope('layout');
                    });
                    
                }

            }
            
        } 
    };
   function _dl_pro_count_down_redirect(url) {
        window.location.replace(url);
    }
    // load elementor
    $window.on("elementor/frontend/init", drthWidgets.LoadWidgets);
})(jQuery, window);
