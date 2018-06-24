$(document).ready(function () {
    $('.square-grid__cell').on('click', function () {
        var soundSlug = $(this).data('name');
        $('#' + soundSlug)[0].play();
    });
});
