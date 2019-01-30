/**
 * SuperMinimal theme-specific JS
 */


/**
 * Pick up paragraphs that contain a WORDPRESS image only (which has a data-attachment-id), 
 * otherwise it's an old MRP image
 */
jQuery('.article-content p').has(
    jQuery("img[data-attachment-id]")
).addClass('image-wide');

/**
 * Sticky Header
 * 
 * maybe use waypoints to determine when header hits the top exactly
 */

// Clone the header, make the clone be the compact version and hide it
jQuery(document).ready(function() {
    //TO DO: clone into a variable, change the ID, then append to layout
    var masthead_space = jQuery('#masthead').height() * -1;
    jQuery('#masthead').clone().addClass('compact sticky').insertAfter('#masthead');
    jQuery('#masthead.sticky').css("top", masthead_space + "px");

    // Ensure keyboard tabbing doesn't cycle through both menus 
    jQuery('#masthead.sticky a').attr("tabindex", -1);

});

// On scroll, slide down the compact version of the header
jQuery(window).scroll(function() {
    if (jQuery(this).scrollTop() > 400) {
        jQuery('#masthead.sticky').css("top", "0");
    } else {
        var masthead_space = jQuery('#masthead').height() * -1;
        jQuery('#masthead.sticky').css("top", masthead_space + "px");
    }
});

/**
 * ScrollReveal
 *
jQuery(document).ready(function() {

    window.sr = ScrollReveal({
        easing: 'ease-in-out',
        scale: 1,
        reset: true,
        useDelay: 'once'
    });

    sr.reveal('.cta > .container', {
        // Time in milliseconds.
        origin: 'bottom',
        duration: 300,
        delay: 400,
    });

});
*/
jQuery(document).ready(function() {

    /*
     * Replace all SVG images with inline SVG
     * http://stackoverflow.com/questions/11978995/how-to-change-color-of-svg-image-using-css-jquery-svg-image-replacement
     */
    jQuery('img.inline-svg').each(function() {
        var $img = jQuery(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');

        jQuery.get(imgURL, function(data) {
            // Get the SVG tag, ignore the rest
            var $svg = jQuery(data).find('svg');

            // Add replaced image's ID to the new SVG
            if (typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }
            // Add replaced image's classes to the new SVG
            if (typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass + ' replaced-svg');
            }

            // Remove any invalid XML tags as per http://validator.w3.org
            $svg = $svg.removeAttr('xmlns:a');

            // Replace image with new SVG
            $img.replaceWith($svg);

        }, 'xml');

    });
});