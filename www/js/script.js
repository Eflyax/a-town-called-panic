window.dataLayer = window.dataLayer || [];

function gtag() {
    dataLayer.push(arguments);
}

gtag('js', new Date());
gtag('config', 'UA-121383233-1');

$(document).ready(function () {
    $('.square').on('click', function () {
        var soundSlug = $(this).data('name');
        $('#' + soundSlug)[0].play();
        ga('send', 'event', 'Sound', 'play', soundSlug);
        window.location.hash = soundSlug;
    });
});

var slugInUrl = $(location).attr('hash');
if (slugInUrl) {
    slugInUrl = slugInUrl.replace('#', '');
    $('#' + slugInUrl)[0].play();
}
