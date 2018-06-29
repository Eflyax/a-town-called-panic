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
        gtag('send', {
            hitType: 'event',
            eventCategory: 'Sounds',
            eventAction: 'play',
            eventLabel: soundSlug,
        });
        gtag('event', 'play', {
            'event_category': 'Sound',
            'event_label': soundSlug,
        });
        window.location.hash = soundSlug;
    });
});

var slugInUrl = $(location).attr('hash');
if (slugInUrl) {
    slugInUrl = slugInUrl.replace('#', '');
    $('#' + slugInUrl)[0].play();
}
