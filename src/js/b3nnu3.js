jQuery(document).ready(function () {
    jQuery('a[rel="external"]').on('click', function (el) {
        window.open(this.href);
        el.preventDefault();
        return false;
    });
    jQuery(function () {
        jQuery(".rslides").responsiveSlides({
            auto: true,
            speed: 800,
            timeout: 5000,
            random: true,
            pause: true,
            maxwidth: "1024"
        });
    });
});
