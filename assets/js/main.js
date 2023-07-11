$(document).ready(function() {
    $(document).on("click",".view-more",function() {
        if ($(this).hasClass("view-less")) {
            $(this).parents("td:first").find(".td-limited-content").css("white-space", "nowrap");
            $(this).text("View More");
        } else {
            $(this).parents("td:first").find(".td-limited-content").css("white-space", "normal");
            $(this).text("View Less");
        }
        $(this).toggleClass("view-less");
    });
    $(".select2").select2({
        placeholder: $(".select2").attr("placeholder"),
        allowClear: true
    });
    $('#daterange').daterangepicker();
});
