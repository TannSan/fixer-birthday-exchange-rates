/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 6);
/******/ })
/************************************************************************/
/******/ ({

/***/ 6:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(7);


/***/ }),

/***/ 7:
/***/ (function(module, exports) {

$('#datetimepicker').datetimepicker({
    inline: true,
    format: 'L',
    minDate: moment().subtract(1, 'year'),
    maxDate: moment(),
    date: moment()
});

$("button#btn_exchange_rate").click(function () {
    var birthday = $("#datetimepicker").datetimepicker('date');
    var birthday_short = birthday.format("YYYY-MM-DD");
    var tbody = $("tbody#rates");
    $.ajax({
        method: 'GET',
        url: '/' + birthday_short,
        headers: { 'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]') }
    }).done(function (json_response) {
        if (json_response.success) {
            var empty_row = $("tr#empty-row", tbody);
            if (empty_row.length) empty_row.remove();

            // Search for a matching record and increment its duplicate count or create a new row
            var table_cell = $("td[data-date='" + birthday_short + "']", tbody);
            if (table_cell.length) {
                var badge = $("span.badge", table_cell);
                if (badge.length) $("span.badge", table_cell).text(json_response.search_count);else table_cell.append(' <span class="badge badge-success">' + json_response.search_count + '</span>');
            } else {
                // Loop through table and find the correct place to insert the new row based on the date
                var inserted = false;
                $("tbody#rates tr td:first-child").each(function () {
                    if (new Date(birthday_short).getTime() > new Date($(this).attr("data-date")).getTime()) {
                        inserted = true;
                        $(this).parent().before('<tr><td data-date="' + birthday_short + '">' + birthday.format('Do MMMM YYYY') + (json_response.search_count > 1 ? ' <span class="badge badge-success">' + json_response.search_count + '</span>' : '') + '</td><td class="text-right">' + json_response.exchange_rate + '</td></tr>');
                        return false;
                    }
                });
                if (!inserted) tbody.append('<tr><td data-date="' + birthday_short + '">' + birthday.format('Do MMMM YYYY') + (json_response.search_count > 1 ? ' <span class="badge badge-success">' + json_response.search_count + '</span>' : '') + '</td><td class="text-right">' + json_response.exchange_rate + '</td></tr>');
            }

            var success_notification = new hullabaloo();
            success_notification.options.align = 'center';
            success_notification.options.width = 320;
            success_notification.send("Exchange rate retrieved!<br /><br />" + birthday.format('Do MMMM YYYY') + " - " + json_response.exchange_rate, "success");
        } else {
            var error_notification = new hullabaloo();
            error_notification.options.align = 'center';
            error_notification.options.width = 320;
            error_notification.send("Error: " + json_response.error.info, "danger");
        }
    });
});

/***/ })

/******/ });