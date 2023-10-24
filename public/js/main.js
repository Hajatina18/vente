var mois = ['Janvier', 'Février', "Mars", 'Avril', 'Mai', 'Juin', 'Juillet', "Août", "Septembre", "Octobre", "Novembre", "Decembre"];
$(function() {
    var dateNow = () => {
        setInterval(() => {
            let date = new Date();
            $(".date").text(initZero(date.getDate()) + " " + mois[date.getMonth()] + " " + date.getFullYear());
            $("#hour").text(initZero(date.getHours()));
            $("#minute").text(initZero(date.getMinutes()));
            $("#seconde").text(initZero(date.getSeconds()));
        }, 1000)
    };
    dateNow();

    var setItem = () => {
        var url = window.location.href;
        $('.sidebar-item').removeClass('active');
        if (url.lastIndexOf('/') == (url.length - 1)) {
            url = url.substr(0, url.length - 1);
        }
        $('.sidebar-link').each(function() {

            var sidebar;
            if ($(this).attr('href') == url) {
                $(this).parents('.sidebar-item').addClass('active');
                sidebar = $(this).parents('.sidebar-item');
                if (sidebar.offset().top > 700) {
                    $('.list-sidebar').animate({
                        scrollTop: sidebar.offset().top
                    });
                }

            }
        });
    };
    setItem();

});

function initZero(nombre) {
    return (nombre < 10) ? "0" + nombre : nombre;
}