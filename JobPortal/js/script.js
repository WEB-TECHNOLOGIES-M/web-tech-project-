"use strict";
(function () {
  // Global variables
  var userAgent = navigator.userAgent.toLowerCase(),
    initialDate = new Date(),

    $document = $(document),
    $window = $(window),
    $html = $("html"),
    $body = $("body"),

    isDesktop = $html.hasClass("desktop"),
    isIE = userAgent.indexOf("msie") !== -1 ? parseInt(userAgent.split("msie")[1], 10) : userAgent.indexOf("trident") !== -1 ? 11 : userAgent.indexOf("edge") !== -1 ? 12 : false,
    isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent),
    isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent),
    windowReady = false,
    isNoviBuilder = false,
    preloaderAnimateionDuration = 500,
    plugins = {
      bootstrapTooltip: $("[data-toggle='tooltip']"),
      bootstrapModalDialog: $('.modal'),
      bootstrapTabs: $(".tabs-custom"),
      captcha: $('.recaptcha'),
      campaignMonitor: $('.campaign-mailform'),
      copyrightYear: $(".copyright-year"),
      checkbox: $("input[type='checkbox']"),
      materialParallax: $(".parallax-container"),
      mailchimp: $('.mailchimp-mailform'),
      owl: $(".owl-carousel"),
      popover: $('[data-toggle="popover"]'),
      preloader: $(".preloader"),
      rdNavbar: $(".rd-navbar"),
      rdMailForm: $(".rd-mailform"),
      rdInputLabel: $(".form-label"),
      regula: $("[data-constraints]"),
      radio: $("input[type='radio']"),
      search: $(".rd-search"),
      searchResults: $('.rd-search-results'),
      viewAnimate: $('.view-animate'),
      wow: $(".wow"),
      selectFilter: $(".select"),
      maps: $(".google-map-container"),
      counter:                 document.querySelectorAll( '.counter' ),
      progressLinear:          document.querySelectorAll( '.progress-linear' ),
      progressCircle:          document.querySelectorAll( '.progress-circle' ),
      countdown:               document.querySelectorAll( '.countdown' )
    };

  /**
   * @desc Check the element was been scrolled into the view
   * @param {object} elem - jQuery object
   * @return {boolean}
   */
  function isScrolledIntoView(elem) {
    if (isNoviBuilder) return true;
    return elem.offset().top + elem.outerHeight() >= $window.scrollTop() && elem.offset().top <= $window.scrollTop() + $window.height();
  }

  /**
   * @desc Calls a function when element has been scrolled into the view
   * @param {object} element - jQuery object
   * @param {function} func - init function
   */
  function lazyInit(element, func) {
    var scrollHandler = function () {
      if ((!element.hasClass('lazy-loaded') && (isScrolledIntoView(element)))) {
        func.call();
        element.addClass('lazy-loaded');
      }
    };

    scrollHandler();
    $window.on('scroll', scrollHandler);
  }

  // Initialize scripts that require a loaded page
  $window.on('load', function () {
    // Page loader & Page transition
    if (plugins.preloader.length && !isNoviBuilder) {
      pageTransition({
        target: document.querySelector('.page'),
        delay: 0,
        duration: preloaderAnimateionDuration,
        classIn: 'fadeIn',
        classOut: 'fadeOut',
        classActive: 'animated',
        conditions: function (event, link) {
          return !/(\#|callto:|tel:|mailto:|:\/\/)/.test(link) && !event.currentTarget.hasAttribute('data-lightgallery');
        },
        onTransitionStart: function (options) {
          setTimeout(function () {
            plugins.preloader.removeClass('loaded');
          }, options.duration * .75);
        },
        onReady: function () {
          plugins.preloader.addClass('loaded');
          windowReady = true;
        }
      });
    }

    // Counter
    if ( plugins.counter ) {
      for ( var i = 0; i < plugins.counter.length; i++ ) {
        var
          node = plugins.counter[i],
          counter = aCounter({
            node: node,
            duration: node.getAttribute( 'data-duration' ) || 1000
          }),
          scrollHandler = (function() {
            if ( Util.inViewport( this ) && !this.classList.contains( 'animated-first' ) ) {
              this.counter.run();
              this.classList.add( 'animated-first' );
            }
          }).bind( node ),
          blurHandler = (function() {
            this.counter.params.to = parseInt( this.textContent, 10 );
            this.counter.run();
          }).bind( node );

        if ( isNoviBuilder ) {
          node.counter.run();
          node.addEventListener( 'blur', blurHandler );
        } else {
          scrollHandler();
          window.addEventListener( 'scroll', scrollHandler );
        }
      }
    }

    // Progress Bar
    if ( plugins.progressLinear ) {
      for ( var i = 0; i < plugins.progressLinear.length; i++ ) {
        var
          container = plugins.progressLinear[i],
          counter = aCounter({
            node: container.querySelector( '.progress-linear-counter' ),
            duration: container.getAttribute( 'data-duration' ) || 1000,
            onStart: function() {
              this.custom.bar.style.width = this.params.to + '%';
            }
          });

        counter.custom = {
          container: container,
          bar: container.querySelector( '.progress-linear-bar' ),
          onScroll: (function() {
            if ( ( Util.inViewport( this.custom.container ) && !this.custom.container.classList.contains( 'animated' ) ) || isNoviBuilder ) {
              this.run();
              this.custom.container.classList.add( 'animated' );
            }
          }).bind( counter ),
          onBlur: (function() {
            this.params.to = parseInt( this.params.node.textContent, 10 );
            this.run();
          }).bind( counter )
        };

        if ( isNoviBuilder ) {
          counter.run();
          counter.params.node.addEventListener( 'blur', counter.custom.onBlur );
        } else {
          counter.custom.onScroll();
          document.addEventListener( 'scroll', counter.custom.onScroll );
        }
      }
    }

    // Progress Circle
    if ( plugins.progressCircle ) {
      for ( var i = 0; i < plugins.progressCircle.length; i++ ) {
        var
          container = plugins.progressCircle[i],
          counter = aCounter({
            node: container.querySelector( '.progress-circle-counter' ),
            duration: 500,
            onUpdate: function( value ) {
              this.custom.bar.render( value * 3.6 );
            }
          });

        counter.params.onComplete = counter.params.onUpdate;

        counter.custom = {
          container: container,
          bar: aProgressCircle({ node: container.querySelector( '.progress-circle-bar' ) }),
          onScroll: (function() {
            if ( Util.inViewport( this.custom.container ) && !this.custom.container.classList.contains( 'animated' ) ) {
              this.run();
              this.custom.container.classList.add( 'animated' );
            }
          }).bind( counter ),
          onBlur: (function() {
            this.params.to = parseInt( this.params.node.textContent, 10 );
            this.run();
          }).bind( counter )
        };

        if ( isNoviBuilder ) {
          counter.run();
          counter.params.node.addEventListener( 'blur', counter.custom.onBlur );
        } else {
          counter.custom.onScroll();
          window.addEventListener( 'scroll', counter.custom.onScroll );
        }
      }
    }

    // Material Parallax
    if (plugins.materialParallax.length) {
      if (!isNoviBuilder && !isIE && !isMobile) {
        plugins.materialParallax.parallax();
      } else {
        for (var i = 0; i < plugins.materialParallax.length; i++) {
          var $parallax = $(plugins.materialParallax[i]);

          $parallax.addClass('parallax-disabled');
          $parallax.css({"background-image": 'url(' + $parallax.data("parallax-img") + ')'});
        }
      }
    }
  });

  // Initialize scripts that require a finished document
  $(function () {
    isNoviBuilder = window.xMode;

    /**
     * @desc Initialize owl carousel plugin
     * @param {object} carousel - carousel jQuery object
     */
    function initOwlCarousel ( carousel ) {
      var
        aliaces = [ '-', '-sm-', '-md-', '-lg-', '-xl-', '-xxl-' ],
        values = [ 0, 576, 768, 992, 1200, 1600 ],
        responsive = {};

      for ( var j = 0; j < values.length; j++ ) {
        responsive[ values[ j ] ] = {};
        for ( var k = j; k >= -1; k-- ) {
          if ( !responsive[ values[ j ] ][ 'items' ] && carousel.attr( 'data' + aliaces[ k ] + 'items' ) ) {
            responsive[ values[ j ] ][ 'items' ] = k < 0 ? 1 : parseInt( carousel.attr( 'data' + aliaces[ k ] + 'items' ), 10 );
          }
          if ( !responsive[ values[ j ] ][ 'stagePadding' ] && responsive[ values[ j ] ][ 'stagePadding' ] !== 0 && carousel.attr( 'data' + aliaces[ k ] + 'stage-padding' ) ) {
            responsive[ values[ j ] ][ 'stagePadding' ] = k < 0 ? 0 : parseInt( carousel.attr( 'data' + aliaces[ k ] + 'stage-padding' ), 10 );
          }
          if ( !responsive[ values[ j ] ][ 'margin' ] && responsive[ values[ j ] ][ 'margin' ] !== 0 && carousel.attr( 'data' + aliaces[ k ] + 'margin' ) ) {
            responsive[ values[ j ] ][ 'margin' ] = k < 0 ? 30 : parseInt( carousel.attr( 'data' + aliaces[ k ] + 'margin' ), 10 );
          }
        }
      }

      carousel.owlCarousel( {
        autoplay:           isNoviBuilder ? false : carousel.attr( 'data-autoplay' ) !== 'false',
        autoplayTimeout:    carousel.attr( "data-autoplay-time-out" ) ? Number( carousel.attr( "data-autoplay-time-out" ) ) : 3000,
        autoplayHoverPause: true,
        URLhashListener:		carousel.attr( 'data-hash-navigation' ) === 'true' || false,
        startPosition: 			'URLHash',
        loop:               isNoviBuilder ? false : carousel.attr( 'data-loop' ) !== 'false',
        items:              1,
        autoHeight:					carousel.attr( 'data-auto-height' ) === 'true',
        center:             carousel.attr( 'data-center' ) === 'true',
        dotsContainer:      carousel.attr( 'data-pagination-class' ) || false,
        navContainer:       carousel.attr( 'data-navigation-class' ) || false,
        mouseDrag:          isNoviBuilder ? false : carousel.attr( 'data-mouse-drag' ) !== 'false',
        nav:                carousel.attr( 'data-nav' ) === 'true',
        dots:               carousel.attr( 'data-dots' ) === 'true',
        dotsEach:           carousel.attr( 'data-dots-each' ) ? parseInt( carousel.attr( 'data-dots-each' ), 10 ) : false,
        animateIn:          carousel.attr( 'data-animation-in' ) ? carousel.attr( 'data-animation-in' ) : false,
        animateOut:         carousel.attr( 'data-animation-out' ) ? carousel.attr( 'data-animation-out' ) : false,
        responsive:         responsive,
        navText:            carousel.attr( 'data-nav-text' ) ? $.parseJSON( carousel.attr( 'data-nav-text' ) ) : [],
        navClass:           carousel.attr( 'data-nav-class' ) ? $.parseJSON( carousel.attr( 'data-nav-class' ) ) : [ 'owl-prev', 'owl-next' ]
      } );
    }

    /**
     * @desc Create live search results
     * @param {object} options
     */
    function liveSearch(options) {
      $('#' + options.live).removeClass('cleared').html();
      options.current++;
      options.spin.addClass('loading');
      $.get(handler, {
        s: decodeURI(options.term),
        liveSearch: options.live,
        dataType: "html",
        liveCount: options.liveCount,
        filter: options.filter,
        template: options.template
      }, function (data) {
        options.processed++;
        var live = $('#' + options.live);
        if ((options.processed === options.current) && !live.hasClass('cleared')) {
          live.find('> #search-results').removeClass('active');
          live.html(data);
          setTimeout(function () {
            live.find('> #search-results').addClass('active');
          }, 50);
        }
        options.spin.parents('.rd-search').find('.input-group-addon').removeClass('loading');
      })
    }

    /**
     * @desc Attach form validation to elements
     * @param {object} elements - jQuery object
     */
    function attachFormValidator(elements) {
      // Custom validator - phone number
      regula.custom({
        name: 'PhoneNumber',
        defaultMessage: 'Invalid phone number format',
        validator: function () {
          if (this.value === '') return true;
          else return /^(\+\d)?[0-9\-\(\) ]{5,}$/i.test(this.value);
        }
      });

      for (var i = 0; i < elements.length; i++) {
        var o = $(elements[i]), v;
        o.addClass("form-control-has-validation").after("<span class='form-validation'></span>");
        v = o.parent().find(".form-validation");
        if (v.is(":last-child")) o.addClass("form-control-last-child");
      }

      elements.on('input change propertychange blur', function (e) {
        var $this = $(this), results;

        if (e.type !== "blur") if (!$this.parent().hasClass("has-error")) return;
        if ($this.parents('.rd-mailform').hasClass('success')) return;

        if ((results = $this.regula('validate')).length) {
          for (i = 0; i < results.length; i++) {
            $this.siblings(".form-validation").text(results[i].message).parent().addClass("has-error");
          }
        } else {
          $this.siblings(".form-validation").text("").parent().removeClass("has-error")
        }
      }).regula('bind');

      var regularConstraintsMessages = [
        {
          type: regula.Constraint.Required,
          newMessage: "The text field is required."
        },
        {
          type: regula.Constraint.Email,
          newMessage: "The email is not a valid email."
        },
        {
          type: regula.Constraint.Numeric,
          newMessage: "Only numbers are required"
        },
        {
          type: regula.Constraint.Selected,
          newMessage: "Please choose an option."
        }
      ];


      for (var i = 0; i < regularConstraintsMessages.length; i++) {
        var regularConstraint = regularConstraintsMessages[i];

        regula.override({
          constraintType: regularConstraint.type,
          defaultMessage: regularConstraint.newMessage
        });
      }
    }

    /**
     * @desc Check if all elements pass validation
     * @param {object} elements - object of items for validation
     * @param {object} captcha - captcha object for validation
     * @return {boolean}
     */
    function isValidated(elements, captcha) {
      var results, errors = 0;

      if (elements.length) {
        for (var j = 0; j < elements.length; j++) {

          var $input = $(elements[j]);
          if ((results = $input.regula('validate')).length) {
            for (k = 0; k < results.length; k++) {
              errors++;
              $input.siblings(".form-validation").text(results[k].message).parent().addClass("has-error");
            }
          } else {
            $input.siblings(".form-validation").text("").parent().removeClass("has-error")
          }
        }

        if (captcha) {
          if (captcha.length) {
            return validateReCaptcha(captcha) && errors === 0
          }
        }

        return errors === 0;
      }
      return true;
    }

    /**
     * @desc Validate google reCaptcha
     * @param {object} captcha - captcha object for validation
     * @return {boolean}
     */
    function validateReCaptcha(captcha) {
      var captchaToken = captcha.find('.g-recaptcha-response').val();

      if (captchaToken.length === 0) {
        captcha
          .siblings('.form-validation')
          .html('Please, prove that you are not robot.')
          .addClass('active');
        captcha
          .closest('.form-wrap')
          .addClass('has-error');

        captcha.on('propertychange', function () {
          var $this = $(this),
            captchaToken = $this.find('.g-recaptcha-response').val();

          if (captchaToken.length > 0) {
            $this
              .closest('.form-wrap')
              .removeClass('has-error');
            $this
              .siblings('.form-validation')
              .removeClass('active')
              .html('');
            $this.off('propertychange');
          }
        });

        return false;
      }

      return true;
    }

    /**
     * @desc Initialize Google reCaptcha
     */
    window.onloadCaptchaCallback = function () {
      for (var i = 0; i < plugins.captcha.length; i++) {
        var $capthcaItem = $(plugins.captcha[i]);

        grecaptcha.render(
          $capthcaItem.attr('id'),
          {
            sitekey: $capthcaItem.attr('data-sitekey'),
            size: $capthcaItem.attr('data-size') ? $capthcaItem.attr('data-size') : 'normal',
            theme: $capthcaItem.attr('data-theme') ? $capthcaItem.attr('data-theme') : 'light',
            callback: function (e) {
              $('.recaptcha').trigger('propertychange');
            }
          }
        );
        $capthcaItem.after("<span class='form-validation'></span>");
      }
    };

    /**
     * @desc Initialize Bootstrap tooltip with required placement
     * @param {string} tooltipPlacement
     */
    function initBootstrapTooltip(tooltipPlacement) {
      plugins.bootstrapTooltip.tooltip('dispose');

      if (window.innerWidth < 576) {
        plugins.bootstrapTooltip.tooltip({placement: 'bottom'});
      } else {
        plugins.bootstrapTooltip.tooltip({placement: tooltipPlacement});
      }
    }

    /**
     * @desc Google map function for getting latitude and longitude
     */
    function getLatLngObject(str, marker, map, callback) {
      var coordinates = {};
      try {
        coordinates = JSON.parse(str);
        callback(new google.maps.LatLng(
          coordinates.lat,
          coordinates.lng
        ), marker, map)
      } catch (e) {
        map.geocoder.geocode({'address': str}, function (results, status) {
          if (status === google.maps.GeocoderStatus.OK) {
            var latitude = results[0].geometry.location.lat();
            var longitude = results[0].geometry.location.lng();

            callback(new google.maps.LatLng(
              parseFloat(latitude),
              parseFloat(longitude)
            ), marker, map)
          }
        })
      }
    }

    /**
     * @desc Initialize Google maps
     */
    function initMaps() {
      var key;

      for ( var i = 0; i < plugins.maps.length; i++ ) {
        if ( plugins.maps[i].hasAttribute( "data-key" ) ) {
          key = plugins.maps[i].getAttribute( "data-key" );
          break;
        }
      }

      $.getScript('//maps.google.com/maps/api/js?'+ ( key ? 'key='+ key + '&' : '' ) +'sensor=false&libraries=geometry,places&v=quarterly', function () {
        var head = document.getElementsByTagName('head')[0],
          insertBefore = head.insertBefore;

        head.insertBefore = function (newElement, referenceElement) {
          if (newElement.href && newElement.href.indexOf('//fonts.googleapis.com/css?family=Roboto') !== -1 || newElement.innerHTML.indexOf('gm-style') !== -1) {
            return;
          }
          insertBefore.call(head, newElement, referenceElement);
        };
        var geocoder = new google.maps.Geocoder;
        for (var i = 0; i < plugins.maps.length; i++) {
          var zoom = parseInt(plugins.maps[i].getAttribute("data-zoom"), 10) || 11;
          var styles = plugins.maps[i].hasAttribute('data-styles') ? JSON.parse(plugins.maps[i].getAttribute("data-styles")) : [];
          var center = plugins.maps[i].getAttribute("data-center") || "New York";

          // Initialize map
          var map = new google.maps.Map(plugins.maps[i].querySelectorAll(".google-map")[0], {
            zoom: zoom,
            styles: styles,
            scrollwheel: false,
            center: {lat: 0, lng: 0}
          });

          // Add map object to map node
          plugins.maps[i].map = map;
          plugins.maps[i].geocoder = geocoder;
          plugins.maps[i].keySupported = true;
          plugins.maps[i].google = google;

          // Get Center coordinates from attribute
          getLatLngObject(center, null, plugins.maps[i], function (location, markerElement, mapElement) {
            mapElement.map.setCenter(location);
          });

          // Add markers from google-map-markers array
          var markerItems = plugins.maps[i].querySelectorAll(".google-map-markers li");

          if (markerItems.length){
            var markers = [];
            for (var j = 0; j < markerItems.length; j++){
              var markerElement = markerItems[j];
              getLatLngObject(markerElement.getAttribute("data-location"), markerElement, plugins.maps[i], function(location, markerElement, mapElement){
                var icon = markerElement.getAttribute("data-icon") || mapElement.getAttribute("data-icon");
                var activeIcon = markerElement.getAttribute("data-icon-active") || mapElement.getAttribute("data-icon-active");
                var info = markerElement.getAttribute("data-description") || "";
                var infoWindow = new google.maps.InfoWindow({
                  content: info
                });
                markerElement.infoWindow = infoWindow;
                var markerData = {
                  position: location,
                  map: mapElement.map
                }
                if (icon){
                  markerData.icon = icon;
                }
                var marker = new google.maps.Marker(markerData);
                markerElement.gmarker = marker;
                markers.push({markerElement: markerElement, infoWindow: infoWindow});
                marker.isActive = false;
                // Handle infoWindow close click
                google.maps.event.addListener(infoWindow,'closeclick',(function(markerElement, mapElement){
                  var markerIcon = null;
                  markerElement.gmarker.isActive = false;
                  markerIcon = markerElement.getAttribute("data-icon") || mapElement.getAttribute("data-icon");
                  markerElement.gmarker.setIcon(markerIcon);
                }).bind(this, markerElement, mapElement));


                // Set marker active on Click and open infoWindow
                google.maps.event.addListener(marker, 'click', (function(markerElement, mapElement) {
                  if (markerElement.infoWindow.getContent().length === 0) return;
                  var gMarker, currentMarker = markerElement.gmarker, currentInfoWindow;
                  for (var k =0; k < markers.length; k++){
                    var markerIcon;
                    if (markers[k].markerElement === markerElement){
                      currentInfoWindow = markers[k].infoWindow;
                    }
                    gMarker = markers[k].markerElement.gmarker;
                    if (gMarker.isActive && markers[k].markerElement !== markerElement){
                      gMarker.isActive = false;
                      markerIcon = markers[k].markerElement.getAttribute("data-icon") || mapElement.getAttribute("data-icon")
                      gMarker.setIcon(markerIcon);
                      markers[k].infoWindow.close();
                    }
                  }

                  currentMarker.isActive = !currentMarker.isActive;
                  if (currentMarker.isActive) {
                    if (markerIcon = markerElement.getAttribute("data-icon-active") || mapElement.getAttribute("data-icon-active")){
                      currentMarker.setIcon(markerIcon);
                    }

                    currentInfoWindow.open(map, marker);
                  }else{
                    if (markerIcon = markerElement.getAttribute("data-icon") || mapElement.getAttribute("data-icon")){
                      currentMarker.setIcon(markerIcon);
                    }
                    currentInfoWindow.close();
                  }
                }).bind(this, markerElement, mapElement))
              })
            }
          }
        }
      });
    }

    // Google ReCaptcha
    if (plugins.captcha.length) {
      $.getScript("//www.google.com/recaptcha/api.js?onload=onloadCaptchaCallback&render=explicit&hl=en");
    }

    // Additional class on html if mac os.
    if (navigator.platform.match(/(Mac)/i)) {
      $html.addClass("mac-os");
    }

    // Adds some loosing functionality to IE browsers (IE Polyfills)
    if (isIE) {
      if (isIE === 12) $html.addClass("ie-edge");
      if (isIE === 11) $html.addClass("ie-11");
      if (isIE < 10) $html.addClass("lt-ie-10");
      if (isIE < 11) $html.addClass("ie-10");
    }

    // Bootstrap Tooltips
    if (plugins.bootstrapTooltip.length) {
      var tooltipPlacement = plugins.bootstrapTooltip.attr('data-placement');
      initBootstrapTooltip(tooltipPlacement);

      $window.on('resize orientationchange', function () {
        initBootstrapTooltip(tooltipPlacement);
      })
    }

    // Stop vioeo in bootstrapModalDialog
    if (plugins.bootstrapModalDialog.length) {
      for (var i = 0; i < plugins.bootstrapModalDialog.length; i++) {
        var modalItem = $(plugins.bootstrapModalDialog[i]);

        modalItem.on('hidden.bs.modal', $.proxy(function () {
          var activeModal = $(this),
            rdVideoInside = activeModal.find('video'),
            youTubeVideoInside = activeModal.find('iframe');

          if (rdVideoInside.length) {
            rdVideoInside[0].pause();
          }

          if (youTubeVideoInside.length) {
            var videoUrl = youTubeVideoInside.attr('src');

            youTubeVideoInside
              .attr('src', '')
              .attr('src', videoUrl);
          }
        }, modalItem))
      }
    }

    // Popovers
    if (plugins.popover.length) {
      if (window.innerWidth < 767) {
        plugins.popover.attr('data-placement', 'bottom');
        plugins.popover.popover();
      }
      else {
        plugins.popover.popover();
      }
    }

    // Copyright Year (Evaluates correct copyright year)
    if (plugins.copyrightYear.length) {
      plugins.copyrightYear.text(initialDate.getFullYear());
    }

    // Google maps
    if( plugins.maps.length ) {
      lazyInit( plugins.maps, initMaps );
    }

    // Add custom styling options for input[type="radio"]
    if (plugins.radio.length) {
      for (var i = 0; i < plugins.radio.length; i++) {
        $(plugins.radio[i]).addClass("radio-custom").after("<span class='radio-custom-dummy'></span>")
      }
    }

    // Add custom styling options for input[type="checkbox"]
    if (plugins.checkbox.length) {
      for (var i = 0; i < plugins.checkbox.length; i++) {
        $(plugins.checkbox[i]).addClass("checkbox-custom").after("<span class='checkbox-custom-dummy'></span>")
      }
    }

    // UI To Top
    if (isDesktop && !isNoviBuilder) {
      $().UItoTop({
        easingType: 'easeOutQuad',
        containerClass: 'ui-to-top fl-bigmug-line-up107'
      });
    }

    // RD Navbar
    if (plugins.rdNavbar.length) {
      var aliaces, i, j, len, value, values, responsiveNavbar;

      aliaces = ["-", "-sm-", "-md-", "-lg-", "-xl-", "-xxl-"];
      values = [0, 576, 768, 992, 1200, 1600];
      responsiveNavbar = {};

      for (i = j = 0, len = values.length; j < len; i = ++j) {
        value = values[i];
        if (!responsiveNavbar[values[i]]) {
          responsiveNavbar[values[i]] = {};
        }
        if (plugins.rdNavbar.attr('data' + aliaces[i] + 'layout')) {
          responsiveNavbar[values[i]].layout = plugins.rdNavbar.attr('data' + aliaces[i] + 'layout');
        }
        if (plugins.rdNavbar.attr('data' + aliaces[i] + 'device-layout')) {
          responsiveNavbar[values[i]]['deviceLayout'] = plugins.rdNavbar.attr('data' + aliaces[i] + 'device-layout');
        }
        if (plugins.rdNavbar.attr('data' + aliaces[i] + 'hover-on')) {
          responsiveNavbar[values[i]]['focusOnHover'] = plugins.rdNavbar.attr('data' + aliaces[i] + 'hover-on') === 'true';
        }
        if (plugins.rdNavbar.attr('data' + aliaces[i] + 'auto-height')) {
          responsiveNavbar[values[i]]['autoHeight'] = plugins.rdNavbar.attr('data' + aliaces[i] + 'auto-height') === 'true';
        }

        if (isNoviBuilder) {
          responsiveNavbar[values[i]]['stickUp'] = false;
        } else if (plugins.rdNavbar.attr('data' + aliaces[i] + 'stick-up')) {
          responsiveNavbar[values[i]]['stickUp'] = plugins.rdNavbar.attr('data' + aliaces[i] + 'stick-up') === 'true';
        }

        if (plugins.rdNavbar.attr('data' + aliaces[i] + 'stick-up-offset')) {
          responsiveNavbar[values[i]]['stickUpOffset'] = plugins.rdNavbar.attr('data' + aliaces[i] + 'stick-up-offset');
        }
      }


      plugins.rdNavbar.RDNavbar({
        anchorNav: !isNoviBuilder,
        stickUpClone: (plugins.rdNavbar.attr("data-stick-up-clone") && !isNoviBuilder) ? plugins.rdNavbar.attr("data-stick-up-clone") === 'true' : false,
        responsive: responsiveNavbar,
        callbacks: {
          onStuck: function () {
            var navbarSearch = this.$element.find('.rd-search input');

            if (navbarSearch) {
              navbarSearch.val('').trigger('propertychange');
            }
          },
          onDropdownOver: function () {
            return !isNoviBuilder;
          },
          onUnstuck: function () {
            if (this.$clone === null)
              return;

            var navbarSearch = this.$clone.find('.rd-search input');

            if (navbarSearch) {
              navbarSearch.val('').trigger('propertychange');
              navbarSearch.trigger('blur');
            }

          },
          onToggleSwitch: function () {
            if (isSafari && $(this).hasClass('rd-navbar-popup-toggle')) {
              document.querySelector('.page').style.position = 'fixed';
              document.querySelector('.page').style.overflow = 'hidden';
              document.querySelector('.page').style.width = '100%';
              document.querySelector('.page').style.height = '100%';
              // alert('switch'); 
            }
          },
          onToggleClose: function () {
            if (isSafari && $(this).hasClass('rd-navbar-popup-toggle')) {
              document.querySelector('.page').style.position = 'relative';
              document.querySelector('.page').style.overflow = 'hidden';
              document.querySelector('.page').style.width = '100%';
              document.querySelector('.page').style.height = 'auto';
              // alert('close');
            }
          }
        }
      });

      if (plugins.rdNavbar.attr("data-body-class")) {
        document.body.className += ' ' + plugins.rdNavbar.attr("data-body-class");
      }
    }

    $('[data-rd-navbar-toggle]').on('click', function () {
      if (!$(this).hasClass('active')) {
        if (isSafari && $(this).hasClass('rd-navbar-popup-toggle')) {
          document.querySelector('.page').style.position = 'relative';
          document.querySelector('.page').style.overflow = 'hidden';
          document.querySelector('.page').style.width = '100';
          document.querySelector('.page').style.height = 'auto';
          // alert('fixed close');
        }
      }
    });

    // RD Search
    if (plugins.search.length || plugins.searchResults) {
      var handler = "bat/rd-search.php";
      var defaultTemplate = '<h5 class="search-title"><a target="_top" href="#{href}" class="search-link">#{title}</a></h5>' +
        '<p>...#{token}...</p>' +
        '<p class="match"><em>Terms matched: #{count} - URL: #{href}</em></p>';
      var defaultFilter = '*.html';

      if (plugins.search.length) {
        for (var i = 0; i < plugins.search.length; i++) {
          var searchItem = $(plugins.search[i]),
            options = {
              element: searchItem,
              filter: (searchItem.attr('data-search-filter')) ? searchItem.attr('data-search-filter') : defaultFilter,
              template: (searchItem.attr('data-search-template')) ? searchItem.attr('data-search-template') : defaultTemplate,
              live: (searchItem.attr('data-search-live')) ? searchItem.attr('data-search-live') : false,
              liveCount: (searchItem.attr('data-search-live-count')) ? parseInt(searchItem.attr('data-search-live'), 10) : 4,
              current: 0, processed: 0, timer: {}
            };

          var $toggle = $('.rd-navbar-search-toggle');
          if ($toggle.length) {
            $toggle.on('click', (function (searchItem) {
              return function () {
                if (!($(this).hasClass('active'))) {
                  searchItem.find('input').val('').trigger('propertychange');
                }
              }
            })(searchItem));
          }

          if (options.live) {
            var clearHandler = false;

            searchItem.find('input').on("input propertychange", $.proxy(function () {
              this.term = this.element.find('input').val().trim();
              this.spin = this.element.find('.input-group-addon');

              clearTimeout(this.timer);

              if (this.term.length > 2) {
                this.timer = setTimeout(liveSearch(this), 200);

                if (clearHandler === false) {
                  clearHandler = true;

                  $body.on("click", function (e) {
                    if ($(e.toElement).parents('.rd-search').length === 0) {
                      $('#rd-search-results-live').addClass('cleared').html('');
                    }
                  })
                }

              } else if (this.term.length === 0) {
                $('#' + this.live).addClass('cleared').html('');
              }
            }, options, this));
          }

          searchItem.submit($.proxy(function () {
            $('<input />').attr('type', 'hidden')
              .attr('name', "filter")
              .attr('value', this.filter)
              .appendTo(this.element);
            return true;
          }, options, this))
        }
      }

      if (plugins.searchResults.length) {
        var regExp = /\?.*s=([^&]+)\&filter=([^&]+)/g;
        var match = regExp.exec(location.search);

        if (match !== null) {
          $.get(handler, {
            s: decodeURI(match[1]),
            dataType: "html",
            filter: match[2],
            template: defaultTemplate,
            live: ''
          }, function (data) {
            plugins.searchResults.html(data);
          })
        }
      }
    }

    // Add class in viewport
    if (plugins.viewAnimate.length) {
      for (var i = 0; i < plugins.viewAnimate.length; i++) {
        var $view = $(plugins.viewAnimate[i]).not('.active');
        $document.on("scroll", $.proxy(function () {
          if (isScrolledIntoView(this)) {
            this.addClass("active");
          }
        }, $view))
          .trigger("scroll");
      }
    }

    // Owl carousel
    if (plugins.owl.length) {
      for (var i = 0; i < plugins.owl.length; i++) {
        var c = $(plugins.owl[i]);
        plugins.owl[i].owl = c;

        initOwlCarousel(c);
      }
    }

    // WOW
    if ($html.hasClass("wow-animation") && plugins.wow.length && !isNoviBuilder && isDesktop) {
      setTimeout(function () {
        new WOW().init();
      }, preloaderAnimateionDuration);
    }

    // RD Input Label
    if (plugins.rdInputLabel.length) {
      plugins.rdInputLabel.RDInputLabel();
    }

    // Regula
    if (plugins.regula.length) {
      attachFormValidator(plugins.regula);
    }

    // MailChimp Ajax subscription
    if (plugins.mailchimp.length) {
      for (i = 0; i < plugins.mailchimp.length; i++) {
        var $mailchimpItem = $(plugins.mailchimp[i]),
          $email = $mailchimpItem.find('input[type="email"]');

        // Required by MailChimp
        $mailchimpItem.attr('novalidate', 'true');
        $email.attr('name', 'EMAIL');

        $mailchimpItem.on('submit', $.proxy(function ($email, event) {
          event.preventDefault();

          var $this = this;

          var data = {},
            url = $this.attr('action').replace('/post?', '/post-json?').concat('&c=?'),
            dataArray = $this.serializeArray(),
            $output = $("#" + $this.attr("data-form-output"));

          for (i = 0; i < dataArray.length; i++) {
            data[dataArray[i].name] = dataArray[i].value;
          }

          $.ajax({
            data: data,
            url: url,
            dataType: 'jsonp',
            error: function (resp, text) {
              $output.html('Server error: ' + text);

              setTimeout(function () {
                $output.removeClass("active");
              }, 4000);
            },
            success: function (resp) {
              $output.html(resp.msg).addClass('active');
              $email[0].value = '';
              var $label = $('[for="' + $email.attr('id') + '"]');
              if ($label.length) $label.removeClass('focus not-empty');

              setTimeout(function () {
                $output.removeClass("active");
              }, 6000);
            },
            beforeSend: function (data) {
              var isNoviBuilder = window.xMode;

              var isValidated = (function () {
                var results, errors = 0;
                var elements = $this.find('[data-constraints]');
                var captcha = null;
                if (elements.length) {
                  for (var j = 0; j < elements.length; j++) {

                    var $input = $(elements[j]);
                    if ((results = $input.regula('validate')).length) {
                      for (var k = 0; k < results.length; k++) {
                        errors++;
                        $input.siblings(".form-validation").text(results[k].message).parent().addClass("has-error");
                      }
                    } else {
                      $input.siblings(".form-validation").text("").parent().removeClass("has-error")
                    }
                  }

                  if (captcha) {
                    if (captcha.length) {
                      return validateReCaptcha(captcha) && errors === 0
                    }
                  }

                  return errors === 0;
                }
                return true;
              })();

              // Stop request if builder or inputs are invalide
              if (isNoviBuilder || !isValidated)
                return false;

              $output.html('Submitting...').addClass('active');
            }
          });

          return false;
        }, $mailchimpItem, $email));
      }
    }

    // Campaign Monitor ajax subscription
    if (plugins.campaignMonitor.length) {
      for (i = 0; i < plugins.campaignMonitor.length; i++) {
        var $campaignItem = $(plugins.campaignMonitor[i]);

        $campaignItem.on('submit', $.proxy(function (e) {
          var data = {},
            url = this.attr('action'),
            dataArray = this.serializeArray(),
            $output = $("#" + plugins.campaignMonitor.attr("data-form-output")),
            $this = $(this);

          for (i = 0; i < dataArray.length; i++) {
            data[dataArray[i].name] = dataArray[i].value;
          }

          $.ajax({
            data: data,
            url: url,
            dataType: 'jsonp',
            error: function (resp, text) {
              $output.html('Server error: ' + text);

              setTimeout(function () {
                $output.removeClass("active");
              }, 4000);
            },
            success: function (resp) {
              $output.html(resp.Message).addClass('active');

              setTimeout(function () {
                $output.removeClass("active");
              }, 6000);
            },
            beforeSend: function (data) {
              // Stop request if builder or inputs are invalide
              if (isNoviBuilder || !isValidated($this.find('[data-constraints]')))
                return false;

              $output.html('Submitting...').addClass('active');
            }
          });

          // Clear inputs after submit
          var inputs = $this[0].getElementsByTagName('input');
          for (var i = 0; i < inputs.length; i++) {
            inputs[i].value = '';
            var label = document.querySelector('[for="' + inputs[i].getAttribute('id') + '"]');
            if (label) label.classList.remove('focus', 'not-empty');
          }

          return false;
        }, $campaignItem));
      }
    }

    // RD Mailform
    if (plugins.rdMailForm.length) {
      var i, j, k,
        msg = {
          'MF000': 'Successfully sent!',
          'MF001': 'Recipients are not set!',
          'MF002': 'Form will not work locally!',
          'MF003': 'Please, define email field in your form!',
          'MF004': 'Please, define type of your form!',
          'MF254': 'Something went wrong with PHPMailer!',
          'MF255': 'Aw, snap! Something went wrong.'
        };

      for (i = 0; i < plugins.rdMailForm.length; i++) {
        var $form = $(plugins.rdMailForm[i]),
          formHasCaptcha = false;

        $form.attr('novalidate', 'novalidate').ajaxForm({
          data: {
            "form-type": $form.attr("data-form-type") || "contact",
            "counter": i
          },
          beforeSubmit: function (arr, $form, options) {
            if (isNoviBuilder)
              return;

            var form = $(plugins.rdMailForm[this.extraData.counter]),
              inputs = form.find("[data-constraints]").add($('[data-constraints][form="' + form.attr('id') + '"]')),
              output = $("#" + form.attr("data-form-output")),
              captcha = form.find('.recaptcha').add($('.recaptcha[form=' + form.attr('id') + ']')),
              captchaFlag = true;

            if (form.attr('id')) {
              console.log(inputs);
              inputs.add($('[data-constraints][form="' + form.attr('id') + '"]'));
              captcha.add($('.recaptcha[form=' + form.attr('id') + ']'));
            }

            output.removeClass("active error success");

            if (isValidated(inputs, captcha)) {

              // verify reCaptcha
              if (captcha.length) {
                var captchaToken = captcha.find('.g-recaptcha-response').val(),
                  captchaMsg = {
                    'CPT001': 'Please, setup you "site key" and "secret key" of reCaptcha',
                    'CPT002': 'Something wrong with google reCaptcha'
                  };

                formHasCaptcha = true;

                $.ajax({
                  method: "POST",
                  url: "bat/reCaptcha.php",
                  data: {'g-recaptcha-response': captchaToken},
                  async: false
                })
                  .done(function (responceCode) {
                    if (responceCode !== 'CPT000') {
                      if (output.hasClass("snackbars")) {
                        output.html('<p><span class="icon text-middle mdi mdi-check icon-xxs"></span><span>' + captchaMsg[responceCode] + '</span></p>')

                        setTimeout(function () {
                          output.removeClass("active");
                        }, 3500);

                        captchaFlag = false;
                      } else {
                        output.html(captchaMsg[responceCode]);
                      }

                      output.addClass("active");
                    }
                  });
              }

              if (!captchaFlag) {
                return false;
              }

              form.addClass('form-in-process');

              if (output.hasClass("snackbars")) {
                output.html('<p><span class="icon text-middle fa fa-circle-o-notch fa-spin icon-xxs"></span><span>Sending</span></p>');
                output.addClass("active");
              }
            } else {
              return false;
            }
          },
          error: function (result) {
            if (isNoviBuilder)
              return;

            var output = $("#" + $(plugins.rdMailForm[this.extraData.counter]).attr("data-form-output")),
              form = $(plugins.rdMailForm[this.extraData.counter]);

            output.text(msg[result]);
            form.removeClass('form-in-process');

            if (formHasCaptcha) {
              grecaptcha.reset();
            }
          },
          success: function (result) {
            if (isNoviBuilder)
              return;

            var form = $(plugins.rdMailForm[this.extraData.counter]),
              output = $("#" + form.attr("data-form-output")),
              select = form.find('select');

            form
              .addClass('success')
              .removeClass('form-in-process');

            if (formHasCaptcha) {
              grecaptcha.reset();
            }

            result = result.length === 5 ? result : 'MF255';
            output.text(msg[result]);

            if (result === "MF000") {
              if (output.hasClass("snackbars")) {
                output.html('<p><span class="icon text-middle mdi mdi-check icon-xxs"></span><span>' + msg[result] + '</span></p>');
              } else {
                output.addClass("active success");
              }
            } else {
              if (output.hasClass("snackbars")) {
                output.html(' <p class="snackbars-left"><span class="icon icon-xxs mdi mdi-alert-outline text-middle"></span><span>' + msg[result] + '</span></p>');
              } else {
                output.addClass("active error");
              }
            }

            form.clearForm();

            if (select.length) {
              select.select2("val", "");
            }

            form.find('input, textarea').trigger('blur');

            setTimeout(function () {
              output.removeClass("active error success");
              form.removeClass('success');
            }, 3500);
          }
        });
      }
    }

    // Select2
    if (plugins.selectFilter.length) {
      for (var i = 0; i < plugins.selectFilter.length; i++) {
        var select = $(plugins.selectFilter[i]);

        select.select2({
          width: '100%',
          placeholder: select.attr("data-placeholder") ? select.attr("data-placeholder") : false,
          minimumResultsForSearch: select.attr("data-minimum-results-search") ? select.attr("data-minimum-results-search") : 10,
          maximumSelectionSize: 3,
          dropdownCssClass: select.attr("data-dropdown-class") ? select.attr("data-dropdown-class") : ''
        });
      }
    }

    // Countdown
    if ( plugins.countdown.length ) {
      for ( var i = 0; i < plugins.countdown.length; i++) {
        var
          node = plugins.countdown[i],
          countdown = aCountdown({
            node:  node,
            from:  node.getAttribute( 'data-from' ),
            to:    node.getAttribute( 'data-to' ),
            count: node.getAttribute( 'data-count' ),
            tick:  100,
          });
      }
    }

  });
}());

