
function clearCart(eve) {
    if (confirm('Точно очистить корзину?')){
        eve.preventDefault();
        $.ajax({
            url: '/cart/clear',
            type: 'GET',
            success: function (res) {
                $('#cart .modal-content').html(res);
            },
            error: function () {
                alert('error');
            }
        })
    }

}
