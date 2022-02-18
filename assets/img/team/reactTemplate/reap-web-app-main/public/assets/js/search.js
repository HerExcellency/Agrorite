$(document).ready(function () {
    $('villageSearch').on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $('.mTitle row').filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        })
    })
})