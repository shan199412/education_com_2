(function ($) {
    $(document).ready(function () {

        var citylist = [];

        // Limit number of click in checkbox to 3
        $('input:checkbox').on('change', function () {
            $('.alert1').hide()

            $('.svg4c').hide()
            $('.diagram_title').hide()

            if ($('input:checkbox:checked').length > 4) {
                $(this).prop('checked', false)
            }
        });


        $('.submit_button_edu2').on('click', function () {

            // console.log(citysummary['Ballarat'])

            citylist = []
            // 1. get city from dropdown and append city list
            // var ct1 = $('#city').val();
            // citylist.push(ct1);
            // 2. get cities from checkbox list

            $("input:checkbox:checked").each(function () {
                citylist.push($(this).attr('id'));
            });
            if (citylist.length === 1) {
                $('.alert1').show()
            } else {

                $('.diagram_title').fadeIn();
                edu_thirdGraph(citylist);
                $('.svg4c').fadeIn()
            }

            $('html, body').animate({
                scrollTop: $("div.diagram_title").offset().top
            }, 1000)
        })

    })
})(jQuery);