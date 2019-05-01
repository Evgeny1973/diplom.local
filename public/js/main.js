
function clearCart(event) {
    if (confirm('Точно очистить корзину?')){
        event.preventDefault();
        $.ajax({
            url: '/cart/clear',
            type: 'GET',
            success: function (res) {
                $('#cart').html(res);
            },
            error: function () {
                alert('error');
            }
        })
    }
}
