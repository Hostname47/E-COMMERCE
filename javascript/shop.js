
// Get category from query string
const urlParams = new URLSearchParams(window.location.search);
const category = getParameterByName("category");

/* Here, you need to check whether this category that is fetched from query string is valid or not
   by using ajax. if it's valide then ok, otherwise print a custom error
*/


// Set category dropdownlist to its names category by value
$(".categories-dropdownlist option[value='" + category + "']").attr('selected','selected');

// Change placeholder based on category
let catById = $(".categories-dropdownlist option[value=" + category + "]").first().text() + " ..";
$("#search-field").attr("placeholder", "Search on " + catById);

function getParameterByName(name, url = window.location.href) {
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}