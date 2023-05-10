// select all the rows in the table with the class "table-row"
var $rows = $('#table .table-row');

// select the HTML element with the ID search and attach a keyup event listener to it
// when release a key while typing in the search input field, the function inside the keyup event listener will be triggered
$('#search').keyup(function() {

    // val() method returns the current value of the input field
    // replace- JavaScript string method 
    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
    
    //  show all rows in the table by using show() and filter it
    $rows.show().filter(function() {

        // If function returns true, row is included in the filtered set
        // retrieve text content of each row - text()
        //  check if the search term appears anywhere in the row text - indexOf()
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
    }).hide();
        // if it returns false, the row is not included
        // if false then the row is hidden by hide() method
});
