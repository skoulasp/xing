import "../sass/main.scss";
import "../img/svg-icons.svg";
import "../img/cosmetic-bg.jpg";
import "../img/archive.png";
import "../img/maginfier.jpg";
import "../img/svg-icons.svg";
import "./editor-styles.js";

const searchIconMagnifierAlt = document.querySelector(".nav__layout .dashicons.dashicons-search");
const searchForm = document.querySelector(".search-form");
const searchFormFixed = document.querySelector(".nav__layout .search-form");
const searchField = document.querySelector(".search-field");
const searchIconMagnifier = document.querySelector(".dashicons-search");
const searchIconClose = document.querySelector(".dashicons-no-alt");
const searchIconCloseAlt = document.querySelector(".nav__layout .dashicons-no-alt");
const siteDescription = document.querySelector(".site-description");
const secondaryNavMenu = document.querySelector('div.nav__layout [class^="menu-"]');
const header = document.querySelector(".site-header");
const siteNavigation = document.getElementById("site-navigation");

if (!searchForm.classList.contains("search-hidden")) {
    searchForm.classList.add("search-hidden");
}

const openSearchForm = () => {
    header.classList.add("overflow-animation-fix");
    searchForm.classList.add("search-animated");
    if (siteDescription !== null) {
        siteDescription.classList.add("site-description-animated");
        siteDescription.classList.remove("site-description-fadein");
    }
    searchForm.classList.remove("search-hidden");
    searchForm.classList.remove("search-inactive-animation");
    main.classList.remove("reverse");
    main.classList.add("dimm");
    setTimeout(function () {
        header.classList.remove("overflow-animation-fix");
        searchField.focus();
    }, 350);
};

const closeSearchForm = () => {
    searchForm.classList.remove("search-animated");
    searchForm.classList.add("search-hidden");
    searchForm.classList.add("search-inactive-animation");
    setTimeout(function () {
        searchForm.classList.remove("search-inactive-animation");
    }, 300);
    if (siteDescription !== null) siteDescription.classList.remove("site-description-animated");
    if (siteDescription !== null) siteDescription.classList.add("site-description-fadein");

    main.classList.add("reverse");
    main.style.animationPlayState = "running";
    setTimeout(function () {
        main.classList.remove("dimm");
    }, 300);
};

searchForm.addEventListener("click", (e) => {
    if (e.target === searchIconMagnifier) {
        openSearchForm();
    } else if (e.target === searchIconClose) {
        closeSearchForm();
    }
});

const openSearchForm2 = () => {
    siteNavigation.classList.add("overflow-animation-fix");
    secondaryNavMenu.classList.add("nav-translateX");
    setTimeout(function () {
        searchFormFixed.classList.add("search-animated");
        searchFormFixed.classList.remove("search-hidden");
        searchFormFixed.classList.remove("search-inactive-animation");
        searchFormFixed.classList.remove("search-inactive-animation-mobile");
        main.classList.remove("reverse");
        main.classList.add("dimm");
    }, 300);

    setTimeout(function () {
        searchField.focus();
    }, 350);

    setTimeout(function () {
        siteNavigation.classList.remove("overflow-animation-fix");
    }, 800);
};

const closeSearchFormFixed = () => {
    secondaryNavMenu.classList.remove("nav-translateX");
    searchFormFixed.classList.remove("search-animated");

    if (siteNavigation.classList.contains("mobile__nav")) {
        searchFormFixed.classList.add("search-inactive-animation-mobile");
        setTimeout(function () {
            searchFormFixed.classList.remove("search-inactive-animation-mobile");
            searchFormFixed.classList.add("search-hidden");
        }, 300);
    } else {
        searchFormFixed.classList.add("search-inactive-animation");
        searchFormFixed.classList.add("search-hidden");
        setTimeout(function () {
            searchFormFixed.classList.remove("search-inactive-animation");
        }, 300);
    }

    main.classList.add("reverse");
    setTimeout(function () {
        main.classList.remove("dimm");
    }, 300);
};

searchFormFixed.addEventListener("click", (e) => {
    if (e.target === searchIconMagnifierAlt) {
        openSearchForm2();
    } else if (e.target === searchIconCloseAlt) {
        closeSearchFormFixed();
    }
});

document.addEventListener("keydown", function (event) {
    if (event.key === "Escape") {
        closeSearchForm();
    }
});

if (document.getElementById("wpadminbar")) {
    const adminBar = document.getElementById("wpadminbar");
    let adminBarHeight = adminBar.clientHeight;

    const handleAdminBarResize = () => {
        const newHeight = adminBar.clientHeight;
        if (newHeight !== adminBarHeight) {
            adminBarHeight = newHeight;
            if (stickyNavbar.classList.contains("sticky")) {
                stickyNavbar.style.top = `calc(${adminBarHeight}px - 123px)`;
            }
        }
    };

    const resizeObserver = new ResizeObserver(handleAdminBarResize);
    resizeObserver.observe(adminBar);

    const stickyNavbar = document.querySelector(".site-header");

    const handleStickyClassChange = (mutationsList, observer) => {
        for (const mutation of mutationsList) {
            if (mutation.type === "attributes" && mutation.attributeName === "class") {
                const isSticky = stickyNavbar.classList.contains("sticky");
                if (isSticky) {
                    stickyNavbar.style.top = `calc(${adminBarHeight}px - 123px)`;
                } else {
                    stickyNavbar.style.top = "0";
                }
            }
        }
    };

    const classObserver = new MutationObserver(handleStickyClassChange);

    classObserver.observe(stickyNavbar, { attributes: true });
}

const scroller = document.querySelector(".scroll-link");
if (scroller) {
    scroller.addEventListener("click", function (e) {
        e.preventDefault();

        const targetId = this.getAttribute("href").substring(1);
        const targetElement = document.getElementById(targetId);

        if (targetElement) {
            const offsetTop = targetElement.offsetTop;
            const scrollOptions = {
                top: offsetTop,
                behavior: "smooth",
            };

            window.scrollTo(scrollOptions);
        }
    });
}

(function () {
    const siteNavigation = document.getElementById("site-navigation");
    const navMenu = document.getElementById("nav-menu");
    const hasChildren = document.querySelectorAll(".menu-item-has-children");
    const mobileNavBtn = document.getElementById("hamburger-btn");
    const navAlt = document.querySelector('div.nav__layout [class^="menu-"]');
    const primary = document.getElementById("primary");
    let searchIconMagnifierAlt = document.querySelector(".search-alt .dashicons.dashicons-search");
    const brandOrLogoAlt = document.querySelector(".brand-or-logo-alt");
    const searchAlt = document.querySelector(".search-alt");
    let viewportWidth = document.documentElement.clientWidth;
    let isMobileNavOpen = false;
    const searchForm = document.querySelector("div.search-alt form.search-form");

    if (!siteNavigation) {
        return;
    }

    document.addEventListener("click", function (event) {
        const isClickInside = siteNavigation.contains(event.target);

        if (!isClickInside) {
            siteNavigation.classList.remove("toggled");
        }
    });

    function toggleFocus() {
        if (event.type === "focus" || event.type === "blur") {
            let self = this;

            while (!self.classList.contains("nav-menu")) {
                if ("li" === self.tagName.toLowerCase()) {
                    self.classList.toggle("focus");
                }
                self = self.parentNode;
            }
        }

        if (event.type === "touchstart") {
            const menuItem = this.parentNode;
            event.preventDefault();
            for (const link of menuItem.parentNode.children) {
                if (menuItem !== link) {
                    link.classList.remove("focus");
                }
            }
            menuItem.classList.toggle("focus");
        }
    }

    const cleanNavClasses = () => {
        hasChildren.forEach((el) => {
            el.children[1].classList.remove("reveal");
            el.classList.remove("active");
        });
    };

    const cleanNavMobileClasses = () => {
        if (viewportWidth <= 800) {
            siteNavigation.classList.remove("mobile__nav");
            document.body.classList.remove("overflow__hidden");
            clearSelection();
        }
    };

    const clearSelection = () => {
        if (window.getSelection) {
            window.getSelection().removeAllRanges();
        } else if (document.selection) {
            document.selection.empty();
        }
    };

    document.addEventListener("click", function (e) {
        let target = e.target.parentElement;
        console.log(target);

        if (target === null || !target.classList.contains("menu-item-has-children")) {
            cleanNavClasses();
        }
        if (target !== null && target.matches(".menu-item-has-children")) {
            e.preventDefault();
            console.log("x");
            target.children[1].classList.toggle("reveal");
            target.classList.toggle("active");
        }
        if (target !== null && (e.target === mobileNavBtn || e.target === mobileNavBtn.firstElementChild)) {
            searchForm.classList.contains("search-animated") ? (isMobileNavOpen = true) : (isMobileNavOpen = false);
            if (isMobileNavOpen) {
                closeSearchFormFixed();
            }
            siteNavigation.classList.toggle("mobile__nav");
            navMenu.classList.toggle("mobile");
            document.body.classList.toggle("overflow__hidden");
            clearSelection();
            console.log(isMobileNavOpen);
        }
    });

    document.addEventListener("keyup", function (e) {
        if (e.code === "Escape") {
            cleanNavClasses();
            cleanNavMobileClasses();
        }
    });

    const checkWindowSize = () => {
        viewportWidth = document.documentElement.clientWidth;
        searchForm.classList.contains("search-animated") ? (isMobileNavOpen = true) : (isMobileNavOpen = false);

        if (viewportWidth > 800) {
            navMenu.classList.remove("mobile");
            siteNavigation.classList.remove("mobile__nav");
            document.body.classList.remove("overflow__hidden");

            if (isMobileNavOpen) {
                closeSearchFormFixed();
            }
        }
    };

    window.addEventListener("resize", checkWindowSize);

    const adminBarExists = document.querySelector(".nojq") ? true : false;
    const navbar = document.querySelector(".site-header");
    let navbarHeight = navbar.getBoundingClientRect().height;
    let animationCheck = true;
    let fireCounter = 0;

    const options = {
        root: null,
        threshold: 0,
        rootMargin: `${navbarHeight}px`,
    };
    const observer = new IntersectionObserver((entries, observer) => {
        console.log(fireCounter);
        const [entry] = entries;
        if (!entry.isIntersecting && !entry.isVisible && fireCounter !== 0) {
            navbar.classList.add("sticky");
            searchIconMagnifierAlt.classList.remove("search-dashicon-hidden");
            navAlt.classList.remove("navbar-stabilizer");
            brandOrLogoAlt.classList.remove("width-0");
            searchAlt.classList.remove("width-0");

            setTimeout(() => {
                animationCheck = false;
            }, 600);
        }
        scrollY;
        if (fireCounter === 0 && window.scrollY > navbarHeight) {
            navbar.classList.add("sticky");
            searchIconMagnifierAlt.classList.remove("search-dashicon-hidden");
            navAlt.classList.remove("navbar-stabilizer");
            brandOrLogoAlt.classList.remove("width-0");
            searchAlt.classList.remove("width-0");
            searchIconMagnifierAlt = document.querySelector(".site-header.sticky .dashicons.dashicons-search");
        }
        fireCounter++;
    }, options);

    observer.observe(navbar);

    let lastKnownScrollPosition = 0;
    let ticking = false;

    function navbarDefaultPos(scrollPos) {
        if (window.scrollY === 0) {
            navbar.classList.remove("sticky");
            searchIconMagnifierAlt.classList.add("search-dashicon-hidden");
            navAlt.classList.add("navbar-stabilizer");
            setTimeout(() => {
                brandOrLogoAlt.classList.add("width-0");
                searchAlt.classList.add("width-0");
            }, 300);

            if (!animationCheck) {
                console.log("check");
                navbar.classList.remove("sticky");
                searchIconMagnifierAlt.classList.add("search-dashicon-hidden");
                navAlt.classList.add("navbar-stabilizer");
                setTimeout(() => {
                    brandOrLogoAlt.classList.add("width-0");
                    searchAlt.classList.add("width-0");
                }, 300);
                animationCheck = true;
            }
        }
    }

    document.addEventListener("scroll", function (e) {
        lastKnownScrollPosition = window.scrollY;

        if (!ticking) {
            window.requestAnimationFrame(function () {
                navbarDefaultPos(lastKnownScrollPosition);
                ticking = false;
            });
            ticking = true;
        }
    });
})();
