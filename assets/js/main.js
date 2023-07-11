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
    $('#daterange').daterangepicker({
        autoUpdateInput: false,
        locale: {
            format: 'YYYY-MM-DD',
            separator: ' - ',
            applyLabel: 'Apply',
            cancelLabel: 'Cancel',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            placeholder: 'Select Date Range'
          }
    });
    $('#daterange').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
        $(this).parents("form:first").submit();
    });
    $('#daterange').on('cancel.daterangepicker', function(ev, picker) {
        if ($(this).val() != '') {
            $(this).val('');
            $(this).parents("form:first").submit();
        }
    });
});
