try {
    window.$ = window.jQuery = require('jquery');
    // Bootstrap JS is not needed for now
    // require('bootstrap');
    // require('bootstrap/js/dist/collapse');
} catch (e) {
    console.log("Error: Could not load core libraries");
}