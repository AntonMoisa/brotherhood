Site.init();

WebFontConfig = {
    google: {
        families: ["Roboto:100,300,500:latin"]
    },
    /* Called when all the specified web-font provider modules (google, typekit, and/or custom) have reported that they have started loading fonts. */
    loading: function() {
        // do something
    },
    /* Called when each requested web font has started loading. The fontFamily parameter is the name of the font family, and fontDescription represents the style and weight of the font. */
    fontloading: function(fontFamily, fontDescription) {
        // do something
    },
    /* Called when each requested web font has finished loading. The fontFamily parameter is the name of the font family, and fontDescription represents the style and weight of the font. */
    fontactive: function(fontFamily, fontDescription) {
        // do something
    },
    /* Called if a requested web font failed to load. The fontFamily parameter is the name of the font family, and fontDescription represents the style and weight of the font. */
    fontinactive: function(fontFamily, fontDescription) {
        // do something
    },
    /* Called when all of the web fonts have either finished loading or failed to load, as long as at least one loaded successfully. */
    active: function() {
        setTimeout(function() {
            Site.fontsDidActivate();
        }, 250);
    },
    /* Called if the browser does not support web fonts or if none of the fonts could be loaded. */
    inactive: function() {
        setTimeout(function() {
            Site.fontsDidActivate();
        }, 250);
    }
};