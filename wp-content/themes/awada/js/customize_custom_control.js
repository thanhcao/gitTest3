wp.customize('awada_theme_options[slider_post_page_1]', function(setting) {
    var setupControl = function(control) {
        var setActiveState, isDisplayed;
        isDisplayed = function() {
            return 'post' == setting.get();
        };
        setActiveState = function() {
            control.active.set(isDisplayed());
        };
        setActiveState();
        setting.bind(setActiveState);
    };
    var setupControl2 = function(control) {
        var setActiveState, isDisplayed;
        isDisplayed = function() {
            return 'page' == setting.get();
        };
        setActiveState = function() {
            control.active.set(isDisplayed());
        };
        setActiveState();
        setting.bind(setActiveState);
    };
    wp.customize.control('awada_theme_options[post_slider_1]', setupControl);
    wp.customize.control('awada_theme_options[page_slider_1]', setupControl2);
});
wp.customize('awada_theme_options[slider_post_page_2]', function(setting) {
    var setupControl = function(control) {
        var setActiveState, isDisplayed;
        isDisplayed = function() {
            return 'post' == setting.get();
        };
        setActiveState = function() {
            control.active.set(isDisplayed());
        };
        setActiveState();
        setting.bind(setActiveState);
    };
    var setupControl2 = function(control) {
        var setActiveState, isDisplayed;
        isDisplayed = function() {
            return 'page' == setting.get();
        };
        setActiveState = function() {
            control.active.set(isDisplayed());
        };
        setActiveState();
        setting.bind(setActiveState);
    };
    wp.customize.control('awada_theme_options[post_slider_2]', setupControl);
    wp.customize.control('awada_theme_options[page_slider_2]', setupControl2);
});
wp.customize('awada_theme_options[slider_post_page_3]', function(setting) {
    var setupControl = function(control) {
        var setActiveState, isDisplayed;
        isDisplayed = function() {
            return 'post' == setting.get();
        };
        setActiveState = function() {
            control.active.set(isDisplayed());
        };
        setActiveState();
        setting.bind(setActiveState);
    };
    var setupControl2 = function(control) {
        var setActiveState, isDisplayed;
        isDisplayed = function() {
            return 'page' == setting.get();
        };
        setActiveState = function() {
            control.active.set(isDisplayed());
        };
        setActiveState();
        setting.bind(setActiveState);
    };
    wp.customize.control('awada_theme_options[post_slider_3]', setupControl);
    wp.customize.control('awada_theme_options[page_slider_3]', setupControl2);
});