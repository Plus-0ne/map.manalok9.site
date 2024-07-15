$(function () {
    $('#toggler-sidebar').on('click', function () {
        $('#sidebar').toggleClass('show');
    });

    $('#sidebar-close').on('click', function () {
        $('#sidebar').toggleClass('show');
    });

    $(".table-responsive").on("show.bs.dropdown", function () {
        $(".table-responsive").css("overflow", "inherit");
    });

    $(".table-responsive").on("hide.bs.dropdown", function () {
        $(".table-responsive").css("overflow", "auto");
    });

});
