$(document).ready(function () {
    $('.square').on('click', function () {
        var soundSlug = $(this).data('name');
        $('#' + soundSlug)[0].play();
    });
});
