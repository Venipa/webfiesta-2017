$('button[data-href], span[data-href], div[data-href]').on('click', function(e) {
    e.preventDefault();
    window.location.href = $(this).attr('data-href');
});
// $('ul.nav.navbar-nav>li').hover(function() {
//     $(this).addClass("active");
// }, function() {
//     $(this).removeClass("active");
// })
$(function() {
    tippy('[data-toggle="tooltip"]', {
        arrow: true,
        theme: 'light',
        size: 'big',
        inertia: true
    });
    $('[data-toggle="select"], select').select2({
        minimumResultsForSearch: Infinity
    });
    $v = $('.panel-wall');
    if ($v.length > 0) {
        var mc = Macy({
            container: '.panel-wall',
            trueOrder: false,
            waitForImages: false,
            margin: 24,
            columns: 4,
            breakAt: {
                1200: 3,
                940: 2,
                520: 1
            }
        });
    }
    let elem = [
        [".btn:not(.btn-link)", ".nav.navbar-nav > li > a"],
        ['input[type="checkbox"] + label', 'input[type="radio"] + label']
    ];
    $.each(elem, function(k, v) {
        $.each(v, function(_k, _v) {
            if (k == 0) {
                $(_v).append('<link class="rippleJS">');
            } else if (k == 1) {
                $(_v).append('<link class="rippleJS fill">');
            }
        });
    });
})
$(window).load(function() {
    $('.page-load').fadeOut(800, function() {
        setTimeout(function() {
            $('.page-loading-wrapper').fadeOut('slow', function() {
                $(this).remove();
            })
        }, 200);
    })
});