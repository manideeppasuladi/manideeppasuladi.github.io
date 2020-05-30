var dark = false;
$('#dark_switch').click(function() {

    $('link[href="css/style.css"]').attr('href', 'css/dark_theme.css');
    dark = true;
    if (dark) {
        $(".navbar").addClass("navbar-dark")
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();

            //>=, not <=
            if (scroll >= 100) {
                $(".navbar").removeClass("navbar-dark")
                $(".navbar").addClass("navbar-light");
            } else {

                $(".navbar").removeClass("navbar-light");
                $(".navbar").addClass("navbar-dark")
            }
        });
    } else {
        $(".navbar").addClass("navbar-light")
    }
});


$('#light_switch').click(function() {

    $('link[href="css/dark_theme.css"]').attr('href', 'css/style.css');
    dark = false;
    if (dark) {
        $(".navbar").addClass("navbar-dark")
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();

            //>=, not <=
            if (scroll >= 100) {
                $(".navbar").removeClass("navbar-dark")
                $(".navbar").addClass("navbar-light");
            } else {

                $(".navbar").removeClass("navbar-light");
                $(".navbar").addClass("navbar-dark")
            }
        });
    } else {

        console.log($(".navbar").hasClass('navbar-dark'));
        $(".navbar").addClass("navbar-light")
    }
});



$(document).ready(function() {
    if (dark) {
        $(".navbar").addClass("navbar-dark")
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();

            //>=, not <=
            if (scroll >= 100) {
                $(".navbar").removeClass("navbar-dark")
                $(".navbar").addClass("navbar-light");
            } else {

                $(".navbar").removeClass("navbar-light");
                $(".navbar").addClass("navbar-dark")
            }
        });
    } else {
        $(".navbar").addClass("navbar-light")
    }
});