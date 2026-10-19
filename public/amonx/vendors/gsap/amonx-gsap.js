(function ($) {
  "use strict";

  // =============================================
  // PLUGIN REGISTRATION
  // =============================================
  gsap.registerPlugin(ScrollTrigger, ScrollSmoother, ScrollToPlugin, SplitText);

  // =============================================
  // ANIMATION FUNCTIONS
  // =============================================

  // split text animation 01
  function bwSplitText() {
    if ($(".bw-split-text").length) {
      var textheading = $(".bw-split-text");

      if (textheading.length === 0) return;
      textheading.each(function (index, el) {
        el.split = new SplitText(el, {
          type: "lines,words,chars",
          linesClass: "split-line",
        });

        if ($(el).hasClass("bw-split-text")) {
          gsap.set(el.split.chars, {
            opacity: 0.5,
            x: "-7",
          });
        }
        el.anim = gsap.to(el.split.chars, {
          scrollTrigger: {
            trigger: el,
            start: "top 80%",
            end: "top 20%",
            markers: false,
            scrub: 1,
          },
          x: "0",
          y: "0",
          opacity: 1,
          duration: 0.7,
          stagger: 0.2,
        });
      });
    }
  }

  // bw stroke text animation
  if ($(".bw-stroke-text").length) {
    const elements = document.querySelectorAll(".bw-stroke-text");

    elements.forEach((elements) => {
      const split = new SplitText(elements, {
        type: "lines",
      });

      const tl = gsap.timeline({
        scrollTrigger: {
          trigger: elements,
          start: "top 90%",
          end: "bottom 20%",
          scrub: 1,
        },
      });

      split.lines.forEach((line) => {
        tl.fromTo(
          line,
          {
            backgroundPositionX: "100%",
          },
          {
            backgroundPositionX: "0%",
            ease: "none",
            duration: 1,
          },
        );
      });
    });
  }

  // reveal text animation 01
  function bwRevealText() {
    const bwElements = document.querySelectorAll(".bw-reveal-text");

    bwElements.forEach((el) => {
      if (!el.dataset.original) {
        el.dataset.original = el.innerHTML;
      }
    });

    const splitWords = (el) => {
      const text = el.dataset.original;
      const wrapper = document.createElement("div");
      wrapper.innerHTML = text;

      const nodes = Array.from(wrapper.childNodes);
      const wrappedHTML = nodes
        .map((node) => {
          if (node.nodeType === Node.TEXT_NODE) {
            return node.textContent
              .split(/\s/)
              .map((word) => {
                return word
                  .split("-")
                  .map((part) => `<span class="word">${part}</span>`)
                  .join('<span class="hyphen">-</span>');
              })
              .join('<span class="whitespace"> </span>');
          } else {
            return node.outerHTML;
          }
        })
        .join("");
      el.innerHTML = wrappedHTML;
    };

    const getLines = (el) => {
      const lines = [];
      let line = [];
      const words = el.querySelectorAll("span");
      let lastTop = null;

      words.forEach((word) => {
        if (
          word.offsetTop !== lastTop &&
          !word.classList.contains("whitespace")
        ) {
          lastTop = word.offsetTop;
          line = [];
          lines.push(line);
        }
        line.push(word);
      });

      return lines;
    };

    const splitLines = (el) => {
      splitWords(el);

      const lines = getLines(el);
      let wrappedHTML = "";

      lines.forEach((wordsArr) => {
        wrappedHTML += '<span class="line"><span class="words">';
        wordsArr.forEach((word) => {
          wrappedHTML += word.outerHTML;
        });
        wrappedHTML += "</span></span>";
      });

      el.innerHTML = wrappedHTML;
    };

    const initReveal = (el) => {
      const lines = el.querySelectorAll(".words");
      gsap.killTweensOf(lines);
      gsap.set(el, { autoAlpha: 1 });

      gsap.from(lines, {
        yPercent: 100,
        ease: "power3.out",
        stagger: 0.25,
        duration: 1,
        delay: 0.2,
        scrollTrigger: {
          trigger: el,
          toggleActions: "restart none none reset",
        },
      });
    };

    const runAll = () => {
      bwElements.forEach((el) => {
        splitLines(el);
        initReveal(el);
      });
    };

    runAll();

    let resizeTimeout;
    window.addEventListener("resize", () => {
      clearTimeout(resizeTimeout);
      resizeTimeout = setTimeout(() => {
        runAll();
      }, 200);
    });
  }

  // reveal text animation 02
  function bwRevealText2() {
    const textRevealElements = document.querySelectorAll(".bw-reveal-text-2");

    textRevealElements.forEach((element) => {
      const nodes = Array.from(element.childNodes);
      element.innerHTML = "";

      nodes.forEach((node) => {
        if (node.nodeName === "BR") {
          element.appendChild(node.cloneNode());
          return;
        }

        if (node.nodeType === 3) {
          node.textContent.split(/(\s+)/).forEach((text) => {
            if (!text.trim()) {
              element.append(text);
            } else {
              const word = document.createElement("div");
              word.className = "word";
              word.textContent = text;
              element.appendChild(word);
            }
          });
          return;
        }

        if (node.nodeType === 1) {
          const word = document.createElement("div");
          word.className = "word";
          word.appendChild(node.cloneNode(true));
          element.appendChild(word);
        }
      });

      element.querySelectorAll(".word").forEach((word) => {
        if (word.children.length) {
          word.querySelectorAll("*").forEach((tag) => {
            const childNodes = Array.from(tag.childNodes);
            tag.innerHTML = "";

            childNodes.forEach((node) => {
              if (node.nodeType === 1) {
                tag.appendChild(node);
                return;
              }

              if (node.nodeType === 3) {
                node.textContent.split("").forEach((char) => {
                  if (!char.trim()) {
                    tag.append(char);
                  } else {
                    const p = document.createElement("div");
                    p.className = "perspective";
                    p.innerHTML = `<div class="letter"><div>${char}</div></div>`;
                    tag.appendChild(p);
                  }
                });
              }
            });
          });
        }

        if (!word.children.length) {
          const text = word.textContent;
          word.innerHTML = "";
          text.split("").forEach((char) => {
            if (!char.trim()) {
              word.append(char);
            } else {
              const p = document.createElement("div");
              p.className = "perspective";
              p.innerHTML = `<div class="letter"><div>${char}</div></div>`;
              word.appendChild(p);
            }
          });
        }
      });

      const letters = element.querySelectorAll(".letter");

      let tl = gsap.timeline({
        scrollTrigger: {
          trigger: element,
          toggleActions: "restart none none reset",
        },
      });

      tl.set(element, { autoAlpha: 1 });
      tl.fromTo(
        letters,
        1.6,
        {
          transformOrigin: "center",
          rotationY: 90,
          x: 30,
        },
        {
          rotationY: 0.1,
          x: 0,
          stagger: 0.025,
          ease: CustomEase.create("custom", "M0,0 C0.425,0.005 0,1 1,1 "),
        },
      );
    });
  }

  // title fade in
  function initTitleFadeIn() {
    if (!document.querySelector(".title-fade-in")) return;

    const elements = document.querySelectorAll(".title-fade-in");

    elements.forEach((element) => {
      let globalIndex = 0;
      const delayStep = parseFloat(element.dataset.delay) || 0.05;

      function wrapLetters(node) {
        if (node.nodeType === 3) {
          const text = node.textContent;
          const fragment = document.createDocumentFragment();

          text.split(" ").forEach((word, wordIndex) => {
            const wordSpan = document.createElement("span");
            wordSpan.className = "word";

            word.split("").forEach((letter) => {
              const span = document.createElement("span");
              span.className = "char";
              span.textContent = letter;
              span.style.setProperty(
                "--transition-delay",
                `${globalIndex * delayStep}s`,
              );
              wordSpan.appendChild(span);
              globalIndex++;
            });

            fragment.appendChild(wordSpan);

            if (wordIndex !== text.split(" ").length - 1) {
              fragment.appendChild(document.createTextNode(" "));
            }
          });

          node.replaceWith(fragment);
        } else if (node.nodeType === 1 && node.tagName !== "BR") {
          [...node.childNodes].forEach((child) => wrapLetters(child));
        }
      }

      wrapLetters(element);

      ScrollTrigger.create({
        trigger: element,
        start: "top 85%",
        onEnter: () => element.classList.add("is-visible"),
        onLeaveBack: () => element.classList.remove("is-visible"),
      });
    });
  }

  // bw title animation
  function bwTitleAnimation() {
    if (!document.querySelector(".bw-title-anim")) return;

    let splitTitleLines = gsap.utils.toArray(".bw-title-anim");

    splitTitleLines.forEach((splitTextLine) => {
      const tl = gsap.timeline({
        scrollTrigger: {
          trigger: splitTextLine,
          start: "top 90%",
          end: "bottom 60%",
          scrub: false,
          markers: false,
          toggleActions: "play none none reverse",
        },
      });

      const itemSplitted = new SplitText(splitTextLine, {
        type: "words, lines",
      });

      gsap.set(splitTextLine, { perspective: 400 });

      itemSplitted.split({ type: "lines" });

      tl.from(itemSplitted.lines, {
        duration: 1,
        delay: 0.3,
        opacity: 0,
        rotationX: -80,
        force3D: true,
        transformOrigin: "top center -50",
        stagger: 0.1,
      });
    });
  }

  // Reveal Fade Up
  function revealFadeUp(target, delay = 0) {
    gsap.set(target, { opacity: 0, filter: "blur(10px)", y: 100 });
    gsap.to(target, {
      opacity: 1,
      filter: "blur(0px)",
      y: 0,
      duration: 2.5,
      ease: "power3.out",
      delay: delay,
      scrollTrigger: {
        trigger: target,
        start: "top 100%",
        toggleActions: "play none none reverse",
      },
    });
  }

  // rotate animation
  function bwAnimateRotate() {
    gsap.utils.toArray(".bw-animate-rotate").forEach((el) => {
      let arspin = gsap.timeline({
        scrollTrigger: {
          trigger: el,
          scrub: 1,
          start: "top 100%",
          end: "top -50%",
          toggleActions: "play none none reverse",
          markers: false,
        },
      });

      arspin
        .set(el, { transformOrigin: "center center" })
        .fromTo(
          el,
          { rotate: 0 },
          { rotate: 180, duration: 2, immediateRender: false },
        );
    });
  }

  // scroll zoom effect
  function zoomEffect() {
    gsap.utils.toArray(".zoom-effect").forEach((el) => {
      let tl1 = gsap.timeline({
        scrollTrigger: {
          trigger: el,
          scrub: 1,
          start: "top 80%",
          end: "bottom 60%",
          toggleActions: "play none none reverse",
          markers: false,
        },
      });

      tl1.set(el, { transformOrigin: "center center" }).from(
        el,
        { scale: 0.7 },
        {
          background: "inherit",
          scale: 1,
          duration: 1,
          immediateRender: false,
        },
      );
    });
  }

  // scale up anim
  function initScaleUp() {
    document.querySelectorAll(".scale-up-anim").forEach((item) => {
      gsap.set(item, {
        opacity: 0,
        y: 40,
        scale: 0.9,
      });

      gsap.to(item, {
        scale: 1,
        opacity: 1,
        y: 0,
        ease: "power3.out",
        scrollTrigger: {
          trigger: item,
          start: "top 90%",
          end: "bottom 60%",
          scrub: 0.5,
          invalidateOnRefresh: true,
        },
      });
    });
  }

  // scroll scale image
  function initScaleAnimation() {
    const scales = document.querySelectorAll(".scale-anim");
    scales.forEach((item) => {
      gsap.to(item, {
        scale: 1,
        duration: 1,
        ease: "power1.out",
        scrollTrigger: {
          trigger: item,
          start: "top bottom",
          end: "bottom top",
          toggleActions: "play reverse play reverse",
        },
      });
    });
    const images = document.querySelectorAll(`${".scale-anim"} img`);
    images.forEach((img) => {
      gsap.set(img, {
        scale: 1.3,
      });
      gsap.to(img, {
        scale: 1,
        duration: 1,
        ease: "power1.out",
        scrollTrigger: {
          trigger: img,
          start: "top bottom",
          end: "bottom top",
          toggleActions: "play reverse play reverse",
        },
      });
    });
  }

  // scroll move parallax image
  function imageParallaxEffect() {
    document.querySelectorAll(".image-parallax").forEach((wrapper) => {
      const imgLR = wrapper.querySelector(".image-parallax-lr");
      const imgRL = wrapper.querySelector(".image-parallax-rl");
      const imgTB = wrapper.querySelector(".image-parallax-tb");
      const isRTL = getComputedStyle(wrapper).direction === "rtl";

      gsap.set(wrapper, {
        overflow: "hidden",
      });

      function getXPercent(startLTR, endLTR) {
        return isRTL ? -startLTR : startLTR;
      }

      // LEFT → RIGHT PARALLAX
      if (imgLR) {
        gsap.set(imgLR, {
          width: "120%",
          maxWidth: "none",
          xPercent: getXPercent(-12.5, 0),
          willChange: "transform",
        });

        gsap.to(imgLR, {
          xPercent: getXPercent(0, 12.5),
          ease: "none",
          scrollTrigger: {
            trigger: wrapper,
            start: "top bottom",
            end: "bottom top",
            scrub: 1,
          },
        });
      }

      // RIGHT → LEFT PARALLAX
      if (imgRL) {
        gsap.set(imgRL, {
          width: "120%",
          maxWidth: "none",
          xPercent: getXPercent(0, -12.5),
          willChange: "transform",
        });

        gsap.to(imgRL, {
          xPercent: getXPercent(-12.5, 0),
          ease: "none",
          scrollTrigger: {
            trigger: wrapper,
            start: "top bottom",
            end: "bottom top",
            scrub: 1,
          },
        });
      }

      // TOP ↕ BOTTOM PARALLAX
      if (imgTB) {
        gsap.set(imgTB, {
          width: "100%",
          height: "auto",
          maxWidth: "100%",
          display: "block",
          scale: 1.15,
          transformOrigin: "center center",
          willChange: "transform",
        });

        gsap.fromTo(
          imgTB,
          {
            yPercent: -10,
          },
          {
            yPercent: 10,
            ease: "none",
            scrollTrigger: {
              trigger: wrapper,
              start: "top bottom",
              end: "bottom top",
              scrub: 1,
              invalidateOnRefresh: true,
            },
          },
        );
      }
    });
  }

  /*
   * Title: GSAP Infinite Marquee Text Animation
   * Description: Smooth, two-way infinite marquee scrolling text with hover-pause and scroll-velocity speed control using GSAP & ScrollTrigger.
   */
  function addHoverPause(el, timeline) {
    el.addEventListener("mouseenter", () => timeline.pause());
    el.addEventListener("mouseleave", () => timeline.resume());
  }

  const MARQUEE_CONFIG = {
    duration: 200, // Base animation loop duration in seconds (higher = slower idle scroll)
    baseSpeed: 1, // Default speed multiplier when the user is not scrolling
    maxSpeed: 1, // Maximum speed multiplier limit during fast scroll
    scrollSensitivity: 4000, // Scroll resistance factor (higher = less speed boost on scroll)
  };

  const createMarqueeTween = (el, xVal) => {
    const wrap = gsap.utils.wrap(0, 50);
    return gsap.to(el, {
      duration: MARQUEE_CONFIG.duration,
      ease: "none",
      x: xVal,
      modifiers: { x: (v) => wrap(parseFloat(v)) + "%" },
      repeat: -1,
    });
  };

  const applyScrollSpeedControl = (timeline) => {
    const clampTS = gsap.utils.clamp(
      MARQUEE_CONFIG.baseSpeed,
      MARQUEE_CONFIG.maxSpeed,
    );

    ScrollTrigger.create({
      start: 0,
      end: "max",
      onUpdate: (st) => {
        let velocity = Math.abs(
          st.getVelocity() / MARQUEE_CONFIG.scrollSensitivity,
        );
        let targetSpeed = MARQUEE_CONFIG.baseSpeed + velocity;
        gsap.to(timeline, {
          timeScale: clampTS(targetSpeed),
          duration: 0.6,
          ease: "power1.out",
          overwrite: "auto",
        });
      },
    });
  };

  // Initialize two-line marquee elements (Top & Bottom)
  const initBwMarquees = () => {
    const containers = document.querySelectorAll(".marquee--gsap");
    if (!containers.length) return;

    containers.forEach((container) => {
      const topEl = container.querySelector(".marquee__top");
      const bottomEl = container.querySelector(".marquee__bottom");
      if (!topEl || !bottomEl) return;

      topEl.innerHTML += topEl.innerHTML;
      bottomEl.innerHTML += bottomEl.innerHTML;

      const tlTop = gsap.timeline().add(createMarqueeTween(topEl, "-=50%"), 0);
      const tlBottom = gsap
        .timeline()
        .add(createMarqueeTween(bottomEl, "+=50%"), 0);

      applyScrollSpeedControl(tlTop);
      applyScrollSpeedControl(tlBottom);
      y;
      addHoverPause(topEl, tlTop);
      addHoverPause(bottomEl, tlBottom);
    });
  };

  // Initialize right-scrolling marquee elements
  const initBwMarquee = () => {
    const containers = document.querySelectorAll(".marquee-right--gsap");
    if (!containers.length) return;

    containers.forEach((container) => {
      const el = container.querySelector(".marquee__toright");
      if (!el) return;

      el.innerHTML += el.innerHTML;
      const tl = gsap.timeline().add(createMarqueeTween(el, "+=50%"), 0);

      applyScrollSpeedControl(tl);
      addHoverPause(el, tl);
    });
  };

  // Initialize left-scrolling marquee elements
  const initBwMarqueeLeft = () => {
    const containers = document.querySelectorAll(".marquee-left--gsap");
    if (!containers.length) return;

    containers.forEach((container) => {
      const el = container.querySelector(".marquee__toleft");
      if (!el) return;

      el.innerHTML += el.innerHTML;
      const tl = gsap.timeline().add(createMarqueeTween(el, "-=50%"), 0);

      applyScrollSpeedControl(tl);
      addHoverPause(el, tl);
    });
  };

  // roll in right
  function rollInRight() {
    if (!$(".roll-in-right").length) return;

    gsap.from(".roll-in-right", {
      opacity: 0,
      x: "100%",
      rotation: 120,
      duration: 2.5,
      ease: "power4.out",
      scrollTrigger: {
        trigger: ".roll-in-right",
        start: "top 80%",
        toggleActions: "play none none reverse",
      },
    });
  }

  // roll in left
  function rollInLeft() {
    if (!$(".roll-in-left").length) return;

    gsap.from(".roll-in-left", {
      opacity: 0,
      x: "-100%",
      rotation: -120,
      duration: 2.5,
      ease: "power4.out",
      scrollTrigger: {
        trigger: ".roll-in-left",
        start: "top 80%",
        toggleActions: "play none none reverse",
      },
    });
  }

  //image cliping effect
  function gridRevealAnim() {
    const initialClipPaths = [
      "polygon(0% 0%, 0% 0%, 0% 0%, 0% 0%)",
      "polygon(33.33% 0%, 33.33% 0%, 33.33% 0%, 33.33% 0%)",
      "polygon(65.66% 0%, 66.66% 0%, 66.66% 0%, 66.66% 0%)",
      "polygon(0% 33.33%, 0% 33.33%, 0% 33.33%, 0% 33.33%)",
      "polygon(33.33% 33.33%, 33.33% 33.33%, 33.33% 33.33%, 33.33% 33.33%)",
      "polygon(65.66% 33.33%, 66.66% 33.33%, 66.66% 33.33%, 66.66% 33.33%)",
      "polygon(0% 66.66%, 0% 66.66%, 0% 66.66%, 0% 66.66%)",
      "polygon(33.33% 66.66%, 33.33% 66.66%, 33.33% 66.66%, 33.33% 66.66%)",
      "polygon(65.66% 66.66%, 66.66% 66.66%, 66.66% 66.66%, 66.66% 66.66%)",
    ];

    const finalClipPaths = [
      "polygon(0% 0%, 34.33% 0%, 34.33% 34.33%, 0% 34.33%)",
      "polygon(32.33% 0%, 66.66% 0%, 66.66% 33.33%, 33.33% 34.33%)",
      "polygon(65.66% 0%, 100% 0%, 100% 33.33%, 65.66% 34.33%)",
      "polygon(0% 33.33%, 33.33% 33.33%, 33.33% 66.66%, 0% 66.66%)",
      "polygon(30.33% 33.33%, 66.66% 33.33%, 66.66% 66.66%, 33.33% 66.66%)",
      "polygon(65.66% 33.33%, 100% 32.33%, 100% 66.66%, 65.66% 66.66%)",
      "polygon(0% 65.66%, 33.33% 66.66%, 33.33% 100%, 0% 100%)",
      "polygon(30.33% 66.66%, 66.66% 65.66%, 66.66% 100%, 33.33% 100%)",
      "polygon(65.66% 66.66%, 100% 65.66%, 100% 100%, 65.66% 100%)",
    ];

    document.querySelectorAll(".grid-reveal-anim").forEach((wrapper) => {
      const img = wrapper.querySelector(
        ".grid-reveal-anim-img[data-animate='true']",
      );
      if (!img) return;
      const url = img.src;

      wrapper.querySelectorAll(".mask").forEach((m) => m.remove());

      for (let i = 0; i < 9; i++) {
        const mask = document.createElement("div");
        mask.className = `mask mask-${i + 1}`;
        Object.assign(mask.style, {
          backgroundImage: `url(${url})`,
          backgroundSize: "cover",
          backgroundPosition: "center",
          position: "absolute",
          inset: "0",
        });
        wrapper.appendChild(mask);
      }
    });

    gsap.utils.toArray(".grid-reveal-anim").forEach((wrapper) => {
      const masks = wrapper.querySelectorAll(".mask");
      if (!masks.length) return;

      gsap.set(masks, { clipPath: (i) => initialClipPaths[i] });

      const order = [
        [".mask-1"],
        [".mask-2", ".mask-4"],
        [".mask-3", ".mask-5", ".mask-7"],
        [".mask-6", ".mask-8"],
        [".mask-9"],
      ];

      const tl = gsap.timeline({
        scrollTrigger: {
          trigger: wrapper,
          start: "top 90%",
          toggleActions: "restart none none reverse",
        },
      });

      order.forEach((targets, i) => {
        const validTargets = targets
          .map((c) => wrapper.querySelector(c))
          .filter((el) => el);

        if (validTargets.length) {
          tl.to(
            validTargets,
            {
              clipPath: (j, el) =>
                finalClipPaths[Array.from(masks).indexOf(el)],
              duration: 1,
              ease: "power4.out",
              stagger: 0.1,
            },
            i * 0.125,
          );
        }
      });
    });
  }

  // project 02 panel pin scrolling
  function bwProjectPanelPin() {
    const otherSections = document.querySelectorAll(".bw-project-panel");

    if (!otherSections.length) return;

    let pr = gsap.matchMedia();
    pr.add("(min-width: 992px)", () => {
      gsap.set(otherSections, { scale: 1 });

      otherSections.forEach((section, index) => {
        if (index === otherSections.length - 1) return;

        gsap.to(section, {
          scale: 0.8,
          scrollTrigger: {
            trigger: section,
            pin: section,
            scrub: 1,
            start: "top 0",
            end: "bottom 70%",
            endTrigger: ".bw-project-wrap",
            pinSpacing: false,
            markers: false,
          },
        });
      });
    });
  }

  // parallax image animation
  function imageYParallax() {
    if (!document.querySelector(".bw-y-parallax")) return;

    document.querySelectorAll(".bw-y-parallax").forEach((el) => {
      gsap.to(el, {
        y: 100,
        ease: "none",
        scrollTrigger: {
          trigger: el,
          start: "top top",
          end: "bottom top",
          scrub: 1.5,
        },
      });
    });
  }

  // work process 01 pinned scrolling section
  function initWorkProcessPinning() {
    const circle = document.getElementById("progressCircle");
    if (!circle) return;

    let mm = gsap.matchMedia();

    mm.add("(min-width: 1200px)", () => {
      // 1. Comprehensive RTL Detection
      const isRTL =
        document.documentElement.classList.contains("translated-rtl") ||
        document.documentElement.dir === "rtl" ||
        document.documentElement.getAttribute("dir") === "rtl" ||
        document.body.classList.contains("rtl") ||
        document.body.getAttribute("dir") === "rtl" ||
        getComputedStyle(document.documentElement).direction === "rtl" ||
        getComputedStyle(document.body).direction === "rtl";

      const pathLength = circle.getTotalLength();

      // Reset Circle & Checkmarks
      gsap.set(circle, {
        strokeDasharray: pathLength,
        strokeDashoffset: pathLength,
      });

      gsap.set(
        [
          ".work-process__check-mark--1",
          ".work-process__check-mark--2",
          ".work-process__check-mark--3",
          ".work-process__check-mark--4",
        ],
        { scale: 0, opacity: 0 },
      );

      // Entrance Setup
      gsap.set(".work-process__card--1", { y: -60, opacity: 0 });
      gsap.set(".work-process__card--3", { y: 60, opacity: 0 });

      // RTL Dynamic Offsets
      // RTL: Card 2 (Left side) comes from Left (-80px), Card 4 (Right side) comes from Right (+80px)
      const card2Start = isRTL ? -80 : 80;
      const card4Start = isRTL ? 80 : -80;

      gsap.set(".work-process__card--2", { x: card2Start, opacity: 0 });
      gsap.set(".work-process__card--4", { x: card4Start, opacity: 0 });

      const tl = gsap.timeline({
        scrollTrigger: {
          trigger: ".work-process",
          start: "top top",
          end: "+=2500",
          pin: true,
          scrub: 1,
          invalidateOnRefresh: true,
        },
      });

      // Draw Blue Progress Circle
      tl.to(circle, {
        strokeDashoffset: 0,
        ease: "none",
        duration: 4,
      });

      // STEP 1: Card 1 (Top)
      tl.to(
        ".work-process__check-mark--1",
        { scale: 1, opacity: 1, duration: 0.3 },
        0.8,
      ).to(
        ".work-process__card--1",
        { y: 0, opacity: 1, duration: 0.4, ease: "power2.out" },
        0.8,
      );

      // STEP 2: Card 2 (Slide In)
      tl.to(
        ".work-process__check-mark--2",
        { scale: 1, opacity: 1, duration: 0.3 },
        1.8,
      ).to(
        ".work-process__card--2",
        { x: 0, opacity: 1, duration: 0.4, ease: "power2.out" },
        1.8,
      );

      // STEP 3: Card 3 (Bottom)
      tl.to(
        ".work-process__check-mark--3",
        { scale: 1, opacity: 1, duration: 0.3 },
        2.8,
      ).to(
        ".work-process__card--3",
        { y: 0, opacity: 1, duration: 0.4, ease: "power2.out" },
        2.8,
      );

      // STEP 4: Card 4 (Slide In)
      tl.to(
        ".work-process__check-mark--4",
        { scale: 1, opacity: 1, duration: 0.3 },
        3.8,
      ).to(
        ".work-process__card--4",
        { x: 0, opacity: 1, duration: 0.4, ease: "power2.out" },
        3.8,
      );

      return () => {
        gsap.set(
          [
            circle,
            ".work-process__check-mark--1",
            ".work-process__check-mark--2",
            ".work-process__check-mark--3",
            ".work-process__check-mark--4",
            ".work-process__card--1",
            ".work-process__card--2",
            ".work-process__card--3",
            ".work-process__card--4",
          ],
          { clearProps: "all" },
        );
      };
    });
  }

  // work process 02 pinned scrolling section
  function initWorkProcessTwoPin() {
    const processSection = document.querySelector("#workProcessTwo");
    const processWrapper = document.querySelector("#workProcessTwoWrapper");
    const processItems = document.querySelectorAll(".work-process-two__item");
    const processShape = document.querySelector(".work-process-two__shape");

    if (!processSection || !processWrapper) return;

    const mm = gsap.matchMedia();

    mm.add("(min-width: 1200px)", () => {
      const processTimeline = gsap.timeline({
        scrollTrigger: {
          trigger: processSection,
          pin: true,
          start: "top top",
          end: "+=180%",
          scrub: 0.5,
          invalidateOnRefresh: true,
          anticipatePin: 1,
        },
      });

      processTimeline.fromTo(
        processWrapper,
        { yPercent: 20, opacity: 0 },
        { yPercent: 0, opacity: 1, duration: 0.6, ease: "power1.out" },
      );

      let shapePath = null;
      let pathLength = 0;

      if (processShape) {
        shapePath = processShape.querySelector("path");
        if (shapePath) {
          pathLength = shapePath.getTotalLength();

          gsap.set(shapePath, {
            strokeDasharray: pathLength,
            strokeDashoffset: pathLength,
          });
        }

        gsap.set(processShape, { opacity: 1 });
      }

      if (processItems.length > 0) {
        const totalItems = processItems.length;

        processItems.forEach((item, index) => {
          const position = index === 0 ? ">-0.2" : "<0.4";

          processTimeline.fromTo(
            item,
            { y: 80, opacity: 0, scale: 0.95 },
            { y: 0, opacity: 1, scale: 1, duration: 0.8, ease: "power1.out" },
            position,
          );

          if (shapePath && pathLength > 0) {
            const targetOffset =
              pathLength - (pathLength * (index + 1)) / totalItems;

            processTimeline.to(
              shapePath,
              {
                strokeDashoffset: targetOffset,
                duration: 0.8,
                ease: "power1.out",
              },
              "<",
            );
          }
        });
      }

      return () => {
        processTimeline.scrollTrigger && processTimeline.scrollTrigger.kill();
        processTimeline.kill();

        gsap.set(processWrapper, { clearProps: "all" });
        gsap.set(processItems, { clearProps: "all" });

        if (processShape) {
          gsap.set(processShape, { clearProps: "all" });
          const shapePath = processShape.querySelector("path");
          if (shapePath) gsap.set(shapePath, { clearProps: "all" });
        }
      };
    });
  }

  // =============================================
  //  WINDOW LOAD
  // =============================================

  $(window).on("load", function () {
    if ($("#smooth-wrapper").length && $("#smooth-content").length) {
      ScrollSmoother.create({
        smooth: 2,
        effects: true,
        smoothTouch: 0.1,
        ignoreMobileResize: false,
      });
    }

    bwSplitText();
    bwRevealText();
    bwRevealText2();
    initTitleFadeIn();
    bwTitleAnimation();
    document.querySelectorAll(".reveal-fade-up").forEach((el) => {
      const delay = parseFloat(el.dataset.delay) || 0;
      revealFadeUp(el, delay);
    });
    bwAnimateRotate();
    zoomEffect();
    initScaleUp();
    initScaleAnimation();
    imageParallaxEffect();
    initBwMarquees();
    initBwMarquee();
    initBwMarqueeLeft();
    rollInRight();
    rollInLeft();
    gridRevealAnim();
    bwProjectPanelPin();
    imageYParallax();
    initWorkProcessPinning();
    initWorkProcessTwoPin();

    ScrollTrigger.refresh();
  });

  window.addEventListener("resize", () => {
    ScrollTrigger.refresh();
  });

  document.fonts.ready.then(function () {
    ScrollTrigger.refresh();
  });
})(jQuery);
