function clearCart(event) {
    if (confirm('Точно очистить корзину?')) {
        event.preventDefault();
        $.ajax({
            url: '/cart/clear',
            type: 'GET',
            success: function (res) {
                $('.menu-quantity').html('(' + $('.total_quantity').html() + ')');
                $('html').html(res);
            },
            error: function () {
                alert('error');
            }
        })
    }
}

$(document).ready(function()
{
    $('.add_to_cart').on('click', function (event) {
        event.preventDefault();
        let id = $(this).data('id');
        $.ajax({
            url: '/cart/add/' + id,
            type: 'GET',
            success: function (response) {
                $('#menu-quantity').html(response);
            },
            error: function () {
                alert('Беда!');
            }
        })
    })
});
