(function ($) {
  "use strict";

  // achievements circle text
  $(function () {
    function circleText() {
      const svg = document.getElementById("arcSvg");
      if (!svg) return;

      const vb = svg.viewBox.baseVal;
      const cx = vb.width / 2;
      const cy = vb.height;
      const r = vb.width / 2 - 20;

      const arcPath = document.getElementById("arc-path");
      if (!arcPath) return;

      arcPath.setAttribute(
        "d",
        `M ${cx - r},${cy} A ${r},${r} 0 0,1 ${cx + r},${cy}`,
      );
    }
    circleText();
  });

  // team 02 item hover
  $(".team-two__item").on("mouseenter", function () {
    var index = $(this).index();
    $(".team-two__image").removeClass("active").eq(index).addClass("active");
    $(".team-two__item").removeClass("active");
    $(this).addClass("active");
  });

  $(".team-two__item").on("mouseleave", function () {
    var $defaultItem = $(".team-two__item.active:first");
    var defaultIndex = $defaultItem.index();

    $(".team-two__image")
      .removeClass("active")
      .eq(defaultIndex)
      .addClass("active");
  });

  // hero 02 chart
  const inBarValuePlugin = {
    id: "inBarValuePlugin",
    afterDatasetsDraw(chart) {
      const { ctx, data, canvas } = chart;
      ctx.save();

      const meta = chart.getDatasetMeta(0);
      if (!meta || !meta.data) return;

      let prefix = canvas.getAttribute("data-prefix") || "";
      let fontSize = canvas.width < 450 ? 15 : 12;

      data.datasets[0].data.forEach((value, index) => {
        const bar = meta.data[index];
        if (!bar) return;

        const { x, y } = bar;
        const formattedText = prefix + parseFloat(value).toFixed(1);

        // Text inside the top part of the vertical bar
        ctx.fillStyle = "#FFFFFF";
        ctx.font = `bold ${fontSize}px sans-serif`;
        ctx.textAlign = "center";
        ctx.textBaseline = "top";
        ctx.fillText(formattedText, x, y + 15);
      });

      ctx.restore();
    },
  };

  if (typeof Chart !== "undefined") {
    Chart.register(inBarValuePlugin);
  }

  function initamonxBarChart() {
    if ($(".amonx-bar-chart").length) {
      $(".amonx-bar-chart").each(function () {
        let self = $(this);
        let rawOptions = self.attr("data-chart-options");
        let options =
          typeof rawOptions === "string" ? JSON.parse(rawOptions) : rawOptions;

        // Dynamic Attribute Extraction
        let rawLabels = self.attr("data-labels");
        let rawValues = self.attr("data-values");
        let rawColors = self.attr("data-colors");

        if (rawLabels) options.data.labels = JSON.parse(rawLabels);
        if (rawValues) options.data.datasets[0].data = JSON.parse(rawValues);
        if (rawColors)
          options.data.datasets[0].backgroundColor = JSON.parse(rawColors);

        var ctx = document.getElementById(self.attr("id")).getContext("2d");

        // Scroll-based Animation Trigger
        let chartElement = self[0];
        let chartInstance = null;

        let observer = new IntersectionObserver(
          (entries) => {
            entries.forEach((entry) => {
              if (entry.isIntersecting) {
                if (!chartInstance) {
                  chartInstance = new Chart(ctx, options);
                } else {
                  chartInstance.update();
                }
              }
            });
          },
          { threshold: 0.2 },
        );

        observer.observe(chartElement);
      });
    }
  }

  // services 01 item hover
  $(".services-one__item").on("mouseenter", function () {
    var index = $(this).index();
    $(".services-one__image")
      .removeClass("active")
      .eq(index)
      .addClass("active");
    $(".services-one__item").removeClass("active");
    $(this).addClass("active");
  });

  $(".services-one__item").on("mouseleave", function () {
    var $defaultItem = $(".services-one__item.active:first");
    var defaultIndex = $defaultItem.index();

    $(".services-one__image")
      .removeClass("active")
      .eq(defaultIndex)
      .addClass("active");
  });

  // analytics chart
  function renderamonxChart() {
    const chartContainers = document.querySelectorAll(".amonx-custom-chart");

    chartContainers.forEach((container) => {
      const rawData = container.getAttribute("data-chart-data");
      if (!rawData) return;

      const data = JSON.parse(rawData);
      container.innerHTML = "";

      // DOM generation
      data.forEach((item) => {
        const row = document.createElement("div");
        row.className = "chart-row";

        row.innerHTML = `
        <div class="chart-bar-container">
          <div class="chart-bar" data-width="${item.value}" style="background-color: ${item.bg};">
            <div class="chart-value">${item.value}</div>
            <span class="bar-label">${item.label}</span>
            <div class="year-box">
              <span class="year-text">${item.year}</span>
            </div>
          </div>
        </div>
      `;

        container.appendChild(row);
      });

      // IntersectionObserver for Right-to-Left Animation on Scroll
      const observer = new IntersectionObserver(
        (entries) => {
          entries.forEach((entry) => {
            if (entry.isIntersecting) {
              const bars = container.querySelectorAll(".chart-bar");
              bars.forEach((bar) => {
                const targetWidth = bar.getAttribute("data-width");
                bar.style.width = targetWidth; // Animate right to left
              });
            }
          });
        },
        { threshold: 0.2 },
      );

      observer.observe(container);
    });
  }

  document.addEventListener("DOMContentLoaded", renderamonxChart);

  // hero 01 section hover
  function heroOneListHover() {
    var $listItems = $(".hero-one__list__item");
    var $bgs = $(".hero-one__bg-wrap");
    var $contents = $(".hero-one__content");

    $listItems.eq(0).addClass("active");
    $bgs.eq(0).addClass("active");
    $contents.eq(0).addClass("active");

    $listItems.on("mouseenter", function () {
      var index = $(this).index();

      $listItems.removeClass("active");
      $(this).addClass("active");

      $bgs.removeClass("active");
      $bgs.eq(index).addClass("active");

      $contents.removeClass("active");
      $contents.eq(index).addClass("active");
    });
  }

  // pricing table
  $(function () {
    const $toggle = $(".pricing-toggle");
    const $contents = $(".pricing-content");

    $contents.addClass("no-transition");
    showContent($toggle.data("active") || "monthly");

    requestAnimationFrame(() => {
      $contents[0] && $contents[0].offsetHeight;
      $contents.removeClass("no-transition");

      refreshScrollTrigger();
    });

    $("#pricingSwitch").on("click", function () {
      const current = $toggle.data("active");
      showContent(current === "monthly" ? "yearly" : "monthly");
    });

    $(".pricing-toggle__label").on("click", function () {
      showContent($(this).data("target"));
    });

    function showContent(type) {
      $toggle.data("active", type).toggleClass("active", type === "yearly");
      $contents.removeClass("active");
      $(`#${type}Content`).addClass("active");

      clearTimeout(window.__pricingRefreshTimer);
      window.__pricingRefreshTimer = setTimeout(refreshScrollTrigger, 750);
    }

    function refreshScrollTrigger() {
      if (window.ScrollTrigger) {
        ScrollTrigger.refresh();
      }
    }
  });

  // hover image
  if ($(".hover-item").length) {
    const link = document.querySelectorAll(".hover-item");
    const linkHoverReveal = document.querySelectorAll(".hover-item__box");
    const linkImages = document.querySelectorAll(".hover-item__box__img");
    for (let i = 0; i < link.length; i++) {
      link[i].addEventListener("mousemove", (e) => {
        linkHoverReveal[i].style.opacity = 1;
        linkHoverReveal[i].style.transform = `translate(-100%, -50% )`;
        linkImages[i].style.transform = "scale(1, 1)";
        linkHoverReveal[i].style.left = e.clientX + "px";
      });
      link[i].addEventListener("mouseleave", (e) => {
        linkHoverReveal[i].style.opacity = 0;
        linkHoverReveal[i].style.transform = `translate(50%, 50%)`;
        linkImages[i].style.transform = "scale(0.8, 0.8)";
      });
    }
  }

  // video play & pause
  $(function () {
    const playIcon = `<i class="fas fa-play"></i>`;
    const pauseIcon = `<i class="fas fa-pause"></i>`;

    $(document).on("click", ".play-btn", function () {
      const $btn = $(this);
      const video = $btn.closest(".video-wrapper").find(".bg-video")[0];

      if (video.paused) {
        video.play();
        $btn.find("span").html(pauseIcon);
      } else {
        video.pause();
        $btn.find("span").html(playIcon);
      }
    });
  });

  // webgl images hover animation
  function initWebglHover(context) {
    const $scope = context ? $(context) : $(document);
    if (!$scope.find(".bw-hover-item").length || typeof hoverEffect === "undefined") return;

    // Check if the element has actually rendered with a width/height;
    // if not, retry on the next frame until CSS layout has settled
    function waitForSize($el, callback, attempts) {
      attempts = attempts || 0;
      const el = $el.get(0);

      if (el.offsetWidth > 0 && el.offsetHeight > 0) {
        callback();
      } else if (attempts < 60) {
        // wait for a maximum of ~1 second (60 frames)
        requestAnimationFrame(function () {
          waitForSize($el, callback, attempts + 1);
        });
      } else {
        console.warn(
          "bw-hover-item never received a proper size, skipping:",
          el,
        );
      }
    }

    // The library has no destroy() method, so the WebGL context is freed manually
    function destroyInstance($t) {
      const canvas = $t.find("canvas")[0];
      if (canvas) {
        const gl =
          canvas.getContext("webgl") || canvas.getContext("experimental-webgl");
        if (gl) {
          const loseCtx = gl.getExtension("WEBGL_lose_context");
          if (loseCtx) loseCtx.loseContext();
        }
        canvas.remove();
      }
      $t.removeData("webglInitialized webglInstance");
    }

    function hoverAnimation__do($t, $imgs) {
      const img = $imgs.get(0);
      if (!img.naturalWidth || !img.naturalHeight) return;
      if ($t.data("webglInitialized")) return;

      waitForSize($t, function () {
        // skip if another call already initialized it while we were waiting
        if ($t.data("webglInitialized")) return;

        const instance = new hoverEffect({
          parent: $t.get(0),
          intensity: $t.data("intensity") || void 0,
          speedIn: $t.data("speedin") || void 0,
          speedOut: $t.data("speedout") || void 0,
          easing: $t.data("easing") || void 0,
          image1: $imgs.eq(0).attr("src"),
          image2: $imgs.eq(0).attr("src"),
          displacementImage: $t.data("displacement"),
          imagesRatio: img.naturalHeight / img.naturalWidth,
          hover: false,
        });

        $t.data("webglInitialized", true);
        $t.data("webglInstance", instance);

        $t.closest(".bw-hover-item")
          .off("mouseenter.webglHover mouseleave.webglHover")
          .on("mouseenter.webglHover", function () {
            instance.next();
          })
          .on("mouseleave.webglHover", function () {
            instance.previous();
          });
      });
    }

    $scope
      .find(".bw-hover-img")
      .not(".owl-clone .bw-hover-img")
      .each(function () {
        const $n = $(this);
        const $imgs = $n.find("img");
        const $img = $imgs.eq(0);

        if ($img.get(0).complete && $img.get(0).naturalWidth) {
          hoverAnimation__do($n, $imgs);
        } else {
          $img.on("load", function () {
            hoverAnimation__do($n, $imgs);
          });
        }
      });
  }

  /*-- Checkout Accoradin --*/
  if ($(".checkout-page__payment__title").length) {
    $(".checkout-page__payment__item")
      .find(".checkout-page__payment__content")
      .hide();
    $(".checkout-page__payment__item--active")
      .find(".checkout-page__payment__content")
      .show();
    $(".checkout-page__payment__title").on("click", function (e) {
      e.preventDefault();
      $(this)
        .parents(".checkout-page__payment")
        .find(".checkout-page__payment__item")
        .removeClass("checkout-page__payment__item--active");
      $(this)
        .parents(".checkout-page__payment")
        .find(".checkout-page__payment__content")
        .slideUp();
      $(this).parent().addClass("checkout-page__payment__item--active");
      $(this).parent().find(".checkout-page__payment__content").slideDown();
    });
  }

  let dynamicyearElm = $(".dynamic-year");
  if (dynamicyearElm.length) {
    let currentYear = new Date().getFullYear();
    dynamicyearElm.html(currentYear);
  }

  // Date Picker
  if ($(".amonx-datepicker").length) {
    $(".amonx-datepicker").each(function () {
      $(this).datepicker();
    });
  }

  // Popular Causes Progress Bar
  if ($(".count-bar").length) {
    $(".count-bar").appear(
      function () {
        var el = $(this);
        var percent = el.data("percent");
        $(el).css("width", percent).addClass("counted");
      },
      {
        accY: -50,
      },
    );
  }

  //Fact Counter + Text Count
  if ($(".count-box").length) {
    $(".count-box").appear(
      function () {
        var $t = $(this),
          n = $t.find(".count-text").attr("data-stop"),
          r = parseInt($t.find(".count-text").attr("data-speed"), 10);

        if (!$t.hasClass("counted")) {
          $t.addClass("counted");
          $({
            countNum: $t.find(".count-text").text(),
          }).animate(
            {
              countNum: n,
            },
            {
              duration: r,
              easing: "linear",
              step: function () {
                $t.find(".count-text").text(Math.floor(this.countNum));
              },
              complete: function () {
                $t.find(".count-text").text(this.countNum);
              },
            },
          );
        }
      },
      {
        accY: 0,
      },
    );
  }

  // custom coursor
  if ($(".custom-cursor").length) {
    var cursor = document.querySelector(".custom-cursor__cursor");
    var cursorinner = document.querySelector(".custom-cursor__cursor-two");
    var a = document.querySelectorAll("a");

    document.addEventListener("mousemove", function (e) {
      var x = e.clientX;
      var y = e.clientY;
      cursor.style.transform = `translate3d(calc(${e.clientX}px - 50%), calc(${e.clientY}px - 50%), 0)`;
    });

    document.addEventListener("mousemove", function (e) {
      var x = e.clientX;
      var y = e.clientY;
      cursorinner.style.left = x + "px";
      cursorinner.style.top = y + "px";
    });

    document.addEventListener("mousedown", function () {
      cursor.classList.add("click");
      cursorinner.classList.add("custom-cursor__innerhover");
    });

    document.addEventListener("mouseup", function () {
      cursor.classList.remove("click");
      cursorinner.classList.remove("custom-cursor__innerhover");
    });

    a.forEach((item) => {
      item.addEventListener("mouseover", () => {
        cursor.classList.add("custom-cursor__hover");
      });
      item.addEventListener("mouseleave", () => {
        cursor.classList.remove("custom-cursor__hover");
      });
    });
  }

  if ($(".contact-form-validated").length) {
    $(".contact-form-validated").validate({
      // initialize the plugin
      rules: {
        name: {
          required: true,
        },
        email: {
          required: true,
          email: true,
        },
        message: {
          required: true,
        },
        subject: {
          required: true,
        },
      },
      submitHandler: function (form) {
        // sending value with ajax request
        $.post(
          $(form).attr("action"),
          $(form).serialize(),
          function (response) {
            $(form).parent().find(".result").append(response);
            $(form).find('input[type="text"]').val("");
            $(form).find('input[type="email"]').val("");
            $(form).find("textarea").val("");
          },
        );
        return false;
      },
    });
  }

  // mailchimp form
  if ($(".mc-form").length) {
    $(".mc-form").each(function () {
      var Self = $(this);
      var mcURL = Self.data("url");
      var mcResp = Self.parent().find(".mc-form__response");

      Self.ajaxChimp({
        url: mcURL,
        callback: function (resp) {
          // appending response
          mcResp.append(function () {
            return '<p class="mc-message">' + resp.msg + "</p>";
          });
          // making things based on response
          if (resp.result === "success") {
            // Do stuff
            Self.removeClass("errored").addClass("successed");
            mcResp.removeClass("errored").addClass("successed");
            Self.find("input").val("");

            mcResp.find("p").fadeOut(10000);
          }
          if (resp.result === "error") {
            Self.removeClass("successed").addClass("errored");
            mcResp.removeClass("successed").addClass("errored");
            Self.find("input").val("");

            mcResp.find("p").fadeOut(10000);
          }
        },
      });
    });
  }

  if ($(".video-popup").length) {
    $(".video-popup").magnificPopup({
      type: "iframe",
      mainClass: "mfp-fade",
      removalDelay: 160,
      preloader: true,

      fixedContentPos: false,
    });
  }

  if ($(".img-popup").length) {
    var groups = {};
    $(".img-popup").each(function () {
      var id = parseInt($(this).attr("data-group"), 10);

      if (!groups[id]) {
        groups[id] = [];
      }

      groups[id].push(this);
    });

    $.each(groups, function () {
      $(this).magnificPopup({
        type: "image",
        closeOnContentClick: true,
        closeBtnInside: false,
        gallery: {
          enabled: true,
        },
      });
    });
  }

  function dynamicCurrentMenuClass(selector) {
    let FileName = window.location.href.split("/").reverse()[0];

    selector.find("li").each(function () {
      let anchor = $(this).find("a");
      if ($(anchor).attr("href") == FileName) {
        $(this).addClass("current");
      }
    });
    // if any li has .current elmnt add class
    selector.children("li").each(function () {
      if ($(this).find(".current").length) {
        $(this).addClass("current");
      }
    });
    // if no file name return
    if ("" == FileName) {
      selector.find("li").eq(0).addClass("current");
    }
  }

  if ($(".main-menu__list").length) {
    // dynamic current class
    let mainNavUL = $(".main-menu__list");
    dynamicCurrentMenuClass(mainNavUL);
  }

  if ($(".service-details__nav").length) {
    // dynamic current class
    let mainNavUL = $(".service-details__nav");
    dynamicCurrentMenuClass(mainNavUL);
  }

  if ($(".main-menu").length && $(".mobile-nav__container").length) {
    let navContent = document.querySelector(".main-menu").innerHTML;
    let mobileNavContainer = document.querySelector(".mobile-nav__container");
    mobileNavContainer.innerHTML = navContent;
  }

  if ($(".sticky-header").length) {
    $(".sticky-header")
      .clone()
      .insertAfter(".sticky-header")
      .addClass("sticky-header--cloned");
  }

  if ($(".mobile-nav__container .main-menu__list").length) {
    let dropdownAnchor = $(
      ".mobile-nav__container .main-menu__list .dropdown > a",
    );
    dropdownAnchor.each(function () {
      let self = $(this);
      let toggleBtn = document.createElement("BUTTON");
      toggleBtn.setAttribute("aria-label", "dropdown toggler");
      toggleBtn.innerHTML = "<i class='fa fa-angle-down'></i>";
      self.append(function () {
        return toggleBtn;
      });
      self.find("button").on("click", function (e) {
        e.preventDefault();
        let self = $(this);
        self.toggleClass("expanded");
        self.parent().toggleClass("expanded");
        self.parent().parent().children("ul").slideToggle();
      });
    });
  }

  //Show Popup menu
  $(document).on("click", ".megamenu-clickable--toggler > a", function (e) {
    $("body").toggleClass("megamenu-popup-active");
    $(this).parent().find("ul").toggleClass("megamenu-clickable--active");
    e.preventDefault();
  });
  $(document).on("click", ".megamenu-clickable--close", function (e) {
    $("body").removeClass("megamenu-popup-active");
    $(".megamenu-clickable--active").removeClass("megamenu-clickable--active");
    e.preventDefault();
  });

  if ($(".mobile-nav__toggler").length) {
    $(".mobile-nav__toggler").on("click", function (e) {
      e.preventDefault();
      $(".mobile-nav__wrapper").toggleClass("expanded");
      $("body").toggleClass("locked");
    });
  }

  if ($(".sidebar-btn__toggler").length) {
    $(".sidebar-btn__toggler").on("click", function (e) {
      e.preventDefault();
      $(".sidebar-two").toggleClass("active");
      $("body").toggleClass("locked");
    });
  }

  if ($(".search-toggler").length) {
    $(".search-toggler").on("click", function (e) {
      e.preventDefault();
      $(".search-popup").toggleClass("active");
      $(".mobile-nav__wrapper").removeClass("expanded");
      $("body").toggleClass("locked");
    });
  }
  if ($(".mini-cart__toggler").length) {
    $(".mini-cart__toggler").on("click", function (e) {
      e.preventDefault();
      $(".mini-cart").toggleClass("expanded");
      $(".mobile-nav__wrapper").removeClass("expanded");
      $("body").toggleClass("locked");
    });
  }
  if ($(".odometer").length) {
    $(".odometer").appear(function (e) {
      var odo = $(".odometer");
      odo.each(function () {
        var countNumber = $(this).attr("data-count");
        $(this).html(countNumber);
      });
    });
  }

  if ($("#donate-amount__predefined").length) {
    let donateInput = $("#donate-amount");
    $("#donate-amount__predefined")
      .find("li")
      .on("click", function (e) {
        e.preventDefault();
        let amount = $(this).find("a").text();
        donateInput.val(amount);
        $("#donate-amount__predefined").find("li").removeClass("active");
        $(this).addClass("active");
      });
  }

  // button animation
  if ($(".amonx-btn").length) {
    const buttons = document.querySelectorAll(".amonx-btn");

    buttons.forEach((button) => {
      const textEl = button.querySelector(".amonx-btn__text");
      if (!textEl) return;

      const hasIcon =
        button.querySelector(".amonx-btn__icon") || button.querySelector("i");
      if (hasIcon) {
        button.classList.add("has-icon");
      }

      const text = textEl.textContent;
      textEl.innerHTML = "";

      text.split("").forEach((char, index) => {
        const span = document.createElement("span");

        span.innerHTML = char === " " ? "&nbsp;" : char;

        const delay = (text.length - index) * 0.05;
        span.style.transitionDelay = `${delay}s`;

        textEl.appendChild(span);
      });

      button.addEventListener("mouseenter", () => {
        const spans = textEl.querySelectorAll("span");

        spans.forEach((span) => {
          span.classList.remove("animate");
          void span.offsetWidth;
          span.classList.add("animate");
        });
      });
    });
  }

  //accordion
  if ($(".amonx-accordion").length) {
    var accordionGrp = $(".amonx-accordion");
    accordionGrp.each(function () {
      var accordionName = $(this).data("grp-name");
      var Self = $(this);
      var accordion = Self.find(".accordion");
      Self.addClass(accordionName);
      Self.find(".accordion .accordion-content").hide();
      Self.find(".accordion.active").find(".accordion-content").show();
      accordion.each(function () {
        $(this)
          .find(".accordion-title")
          .on("click", function () {
            if ($(this).parent().hasClass("active") === false) {
              $(".amonx-accordion." + accordionName)
                .find(".accordion")
                .removeClass("active");
              $(".amonx-accordion." + accordionName)
                .find(".accordion")
                .find(".accordion-content")
                .slideUp();
              $(this).parent().addClass("active");
              $(this).parent().find(".accordion-content").slideDown();
            }
          });
      });
    });
  }

  $(".add").on("click", function () {
    if ($(this).prev().val() < 999) {
      $(this)
        .prev()
        .val(+$(this).prev().val() + 1);
    }
  });

  $(".sub").on("click", function () {
    if ($(this).next().val() > 0) {
      if ($(this).next().val() > 0)
        $(this)
          .next()
          .val(+$(this).next().val() - 1);
    }
  });

  if ($(".tabs-box").length) {
    $(".tabs-box .tab-buttons .tab-btn").on("click", function (e) {
      e.preventDefault();
      var target = $($(this).attr("data-tab"));

      if ($(target).is(":visible")) {
        return false;
      } else {
        target
          .parents(".tabs-box")
          .find(".tab-buttons")
          .find(".tab-btn")
          .removeClass("active-btn");
        $(this).addClass("active-btn");
        target
          .parents(".tabs-box")
          .find(".tabs-content")
          .find(".tab")
          .fadeOut(0);
        target
          .parents(".tabs-box")
          .find(".tabs-content")
          .find(".tab")
          .removeClass("active-tab");
        $(target).fadeIn(300);
        $(target).addClass("active-tab");
      }
    });
  }

  function thmOwlInit() {
    // owl slider
    let amonxowlCarousel = $(".amonx-owl__carousel");
    if (amonxowlCarousel.length) {
      amonxowlCarousel.each(function () {
        let elm = $(this);
        let options = elm.data("owl-options");

        // Re-run webGL hover setup on both initial load and carousel resize/refresh
        elm.on("initialized.owl.carousel refreshed.owl.carousel", function (e) {
          if (!e.namespace) return;
          initWebglHover(elm);
        });

        let thmOwlCarousel = elm.owlCarousel(
          "object" === typeof options ? options : JSON.parse(options),
        );
        elm.find("button").each(function () {
          $(this).attr("aria-label", "carousel button");
        });
      });
    }

    let amonxowlCarouselNav = $(".amonx-owl__carousel--custom-nav");
    if (amonxowlCarouselNav.length) {
      amonxowlCarouselNav.each(function () {
        let elm = $(this);
        let owlNavPrev = elm.data("owl-nav-prev");
        let owlNavNext = elm.data("owl-nav-next");
        $(owlNavPrev).on("click", function (e) {
          elm.trigger("prev.owl.carousel");
          e.preventDefault();
        });

        $(owlNavNext).on("click", function (e) {
          elm.trigger("next.owl.carousel");
          e.preventDefault();
        });
      });
    }

    let amonxowlCarouselWithCounter = $(".amonx-owl__carousel--with-counter");
    if (amonxowlCarouselWithCounter.length) {
      amonxowlCarouselWithCounter.each(function () {
        let elm = $(this);
        let options = elm.data("owl-options");

        if (typeof options === "string") {
          try {
            options = JSON.parse(options);
          } catch (e) {
            options = {};
          }
        }

        let owl = elm.owlCarousel(options);

        function updateCounter(event) {
          let carousel = event.relatedTarget || elm.data("owl.carousel");
          if (!carousel) return;

          let totalItems =
            carousel.items().length -
            (carousel.clones ? carousel.clones().length : 0);
          let currentItem = carousel.relative(carousel.current()) + 1;

          if (elm.find(".amonx-owl__carousel__counter").length === 0) {
            elm.append(
              '<div class="amonx-owl__carousel__counter">' +
                '<span class="amonx-owl__carousel__counter__current"></span> ' +
                '<span class="amonx-owl__carousel__counter__total"></span>' +
                "</div>",
            );
          }

          let formattedCurrent =
            currentItem < 10 ? "0" + currentItem : currentItem;
          let formattedTotal = totalItems < 10 ? "0" + totalItems : totalItems;

          elm
            .find(".amonx-owl__carousel__counter__current")
            .text(formattedCurrent);
          elm.find(".amonx-owl__carousel__counter__total").text(formattedTotal);
        }

        updateCounter({ relatedTarget: elm.data("owl.carousel") });

        elm.on("changed.owl.carousel", function (event) {
          updateCounter(event);
        });

        if (typeof initWebglHover === "function") {
          initWebglHover(elm);
        }
      });
    }

    let amonxowlCarouselCustomDots = $(".amonx-owl__carousel--custom-dots");
    if (amonxowlCarouselCustomDots.length) {
      amonxowlCarouselCustomDots.each(function () {
        let elm = $(this);
        let amonxowlCarouselThumb = elm.data("thumb-elm");
        $(amonxowlCarouselThumb).each(function () {
          let self = $(this);
          self.find(".owl-dot").on("click", function () {
            elm.trigger("to.owl.carousel", [$(this).index(), 300]);
          });
        });
        elm.on("changed.owl.carousel", function (element) {
          $(amonxowlCarouselThumb).each(function () {
            let self = $(this);
            self.find(".owl-dot").removeClass("active");
            self.find(".owl-dot").eq(element.item.index).addClass("active");
          });
        });
      });
    }
  }

  function amonxSlickInit() {
    // slick slider
    let amonxslickCarousel = $(".amonx-slick__carousel");
    if (amonxslickCarousel.length) {
      amonxslickCarousel.each(function () {
        let elm = $(this);
        let options = elm.data("slick-options");
        let amonxslickCarousel = elm.slick(
          "object" === typeof options ? options : JSON.parse(options),
        );
      });
    }
    let amonxslickCarouselCounter = $(".amonx-slick__custome-counter");
    if (amonxslickCarouselCounter.length) {
      amonxslickCarouselCounter.each(function () {
        let elm = $(this);
        let options = elm.data("slick-options");
        let currentSlide;
        let slidesCount;
        let sliderCounter = document.createElement("div");
        sliderCounter.classList.add("amonx-slick__counter");

        let updateSliderCounter = function (slick, currentIndex) {
          currentSlide = slick.slickCurrentSlide() + 1;
          slidesCount = slick.slideCount;
          $(sliderCounter).html(
            '<span class="amonx-slick__counter__active">' +
              currentSlide +
              "</span>" +
              "" +
              "<span>" +
              slidesCount +
              "</span>",
          );
        };
        elm.on("init", function (event, slick) {
          elm.append(sliderCounter);
          updateSliderCounter(slick);
        });
        elm.on("afterChange", function (event, slick, currentSlide) {
          updateSliderCounter(slick, currentSlide);
        });

        let amonxslickCarousel = elm.slick(
          "object" === typeof options ? options : JSON.parse(options),
        );
      });
    }
  }

  /*-- Handle Scrollbar --*/
  function handleScrollbar() {
    const bodyHeight = $("body").height();
    const scrollPos = $(window).innerHeight() + $(window).scrollTop();
    let percentage = (scrollPos / bodyHeight) * 100;
    if (percentage > 100) {
      percentage = 100;
    }
    $(".scroll-to-top .scroll-to-top__inner").css("width", percentage + "%");
  }

  /*-- One Page Menu --*/
  function SmoothMenuScroll() {
    var anchor = $(".scrollToLink");
    if (anchor.length) {
      anchor.children("a").bind("click", function (event) {
        if ($(window).scrollTop() > 10) {
          var headerH = "0";
        } else {
          var headerH = "0";
        }
        var target = $(this);
        $("html, body")
          .stop()
          .animate(
            {
              scrollTop: $(target.attr("href")).offset().top - headerH + "px",
            },
            900,
            "easeInOutExpo",
          );
        anchor.removeClass("current");
        anchor.removeClass("current-menu-ancestor");
        anchor.removeClass("current_page_item");
        anchor.removeClass("current-menu-parent");
        target.parent().addClass("current");
        event.preventDefault();
      });
    }
  }
  SmoothMenuScroll();

  function OnePageMenuScroll() {
    var windscroll = $(window).scrollTop();
    if (windscroll >= 117) {
      var menuAnchor = $(".one-page-scroll-menu .scrollToLink").children("a");
      menuAnchor.each(function () {
        var sections = $(this).attr("href");
        $(sections).each(function () {
          if ($(this).offset().top <= windscroll + 100) {
            var Sectionid = $(sections).attr("id");
            $(".one-page-scroll-menu").find("li").removeClass("current");
            $(".one-page-scroll-menu")
              .find("li")
              .removeClass("current-menu-ancestor");
            $(".one-page-scroll-menu")
              .find("li")
              .removeClass("current_page_item");
            $(".one-page-scroll-menu")
              .find("li")
              .removeClass("current-menu-parent");
            $(".one-page-scroll-menu")
              .find("a[href*=\\#" + Sectionid + "]")
              .parent()
              .addClass("current");
          }
        });
      });
    } else {
      $(".one-page-scroll-menu li.current").removeClass("current");
      $(".one-page-scroll-menu li:first").addClass("current");
    }
  }

  // window scroll event
  function stickyMenuUpScroll($targetMenu, $toggleClass) {
    var lastScrollTop = 0;
    window.addEventListener(
      "scroll",
      function () {
        var st = window.pageYOffset || document.documentElement.scrollTop;
        if (st > 500) {
          if (st > lastScrollTop) {
            // downscroll code
            $targetMenu.removeClass($toggleClass);
            // console.log("down");
          } else {
            // upscroll code
            $targetMenu.addClass($toggleClass);
            // console.log("up");
          }
        } else {
          $targetMenu.removeClass($toggleClass);
        }
        lastScrollTop = st;
      },
      false,
    );
  }
  stickyMenuUpScroll($(".sticky-header--normal"), "active");

  //Strech Column
  function amonx_stretch() {
    var i = $(window).width();
    $(".row .amonx-stretch-element-inside-column").each(function () {
      var $this = $(this),
        row = $this.closest(".row"),
        cols = $this.closest('[class^="col-"]'),
        colsheight = $this.closest('[class^="col-"]').height(),
        rect = this.getBoundingClientRect(),
        l = row[0].getBoundingClientRect(),
        s = cols[0].getBoundingClientRect(),
        r = rect.left,
        d = i - rect.right,
        c = l.left + (parseFloat(row.css("padding-left")) || 0),
        u = i - l.right + (parseFloat(row.css("padding-right")) || 0),
        p = s.left,
        f = i - s.right,
        styles = {
          "margin-left": 0,
          "margin-right": 0,
        };
      if (Math.round(c) === Math.round(p)) {
        var h = parseFloat($this.css("margin-left") || 0);
        styles["margin-left"] = h - r;
      }
      if (Math.round(u) === Math.round(f)) {
        var w = parseFloat($this.css("margin-right") || 0);
        styles["margin-right"] = w - d;
      }
      $this.css(styles);
    });
  }
  amonx_stretch();

  /*-- Price Range --*/
  function priceFilter() {
    if ($(".price-ranger").length) {
      $(".price-ranger #slider-range").slider({
        range: true,
        min: 50,
        max: 1000,
        values: [11, 500],
        slide: function (event, ui) {
          $(".price-ranger .ranger-min-max-block .min").val("$" + ui.values[0]);
          $(".price-ranger .ranger-min-max-block .max").val("$" + ui.values[1]);
        },
      });
      $(".price-ranger .ranger-min-max-block .min").val(
        "$" + $(".price-ranger #slider-range").slider("values", 0),
      );
      $(".price-ranger .ranger-min-max-block .max").val(
        "$" + $(".price-ranger #slider-range").slider("values", 1),
      );
    }
  }

  // window load event
  $(window).on("load", function () {
    if ($(".preloader").length) {
      $(".preloader").fadeOut();
    }

    initamonxBarChart();
    heroOneListHover();
    initWebglHover();
    thmOwlInit();
    amonxSlickInit();
    priceFilter();

    if ($(".circle-progress").length) {
      $(".circle-progress").appear(function () {
        let circleProgress = $(".circle-progress");
        circleProgress.each(function () {
          let progress = $(this);
          let progressOptions = progress.data("options");
          progress.circleProgress(progressOptions);
        });
      });
    }
    if ($(".masonry-layout").length) {
      $(".masonry-layout").imagesLoaded(function () {
        $(".masonry-layout").isotope({
          layoutMode: "masonry",
        });
      });
    }
    if ($(".fitRow-layout").length) {
      $(".fitRow-layout").imagesLoaded(function () {
        $(".fitRow-layout").isotope({
          layoutMode: "fitRows",
        });
      });
    }

    if ($(".post-filter").length) {
      var postFilterList = $(".post-filter li");
      // for first init
      $(".filter-layout").isotope({
        filter: ".filter-item",
        animationOptions: {
          duration: 500,
          easing: "linear",
          queue: false,
        },
      });
      // on click filter links
      postFilterList.on("click", function () {
        var Self = $(this);
        var selector = Self.attr("data-filter");
        postFilterList.removeClass("active");
        Self.addClass("active");

        $(".filter-layout").isotope({
          filter: selector,
          animationOptions: {
            duration: 500,
            easing: "linear",
            queue: false,
          },
        });
        return false;
      });
    }

    if ($(".post-filter.has-dynamic-filter-counter").length) {
      // var allItem = $('.single-filter-item').length;

      var activeFilterItem = $(".post-filter.has-dynamic-filter-counter").find(
        "li",
      );

      activeFilterItem.each(function () {
        var filterElement = $(this).data("filter");
        var count = $(".filter-layout").find(filterElement).length;
        $(this).append("<sup>[" + count + "]</sup>");
      });
    }

    AOS.init();
  });

  $(window).on("scroll", function () {
    OnePageMenuScroll();
    handleScrollbar();
    if ($(".sticky-header--one-page").length) {
      var headerScrollPos = 130;
      var stricky = $(".sticky-header--one-page");
      if ($(window).scrollTop() > headerScrollPos) {
        stricky.addClass("active");
      } else if ($(this).scrollTop() <= headerScrollPos) {
        stricky.removeClass("active");
      }
    }

    var scrollToTopBtn = ".scroll-to-top";
    if (scrollToTopBtn.length) {
      if ($(window).scrollTop() > 500) {
        $(scrollToTopBtn).addClass("show");
      } else {
        $(scrollToTopBtn).removeClass("show");
      }
    }
  });

  $(window).on("resize", function () {
    amonx_stretch();
  });
})(jQuery);
