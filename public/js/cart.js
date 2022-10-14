$(document).ready(function() {
    // click plus button event
    $('.btn-plus').click(function() {
        $parentNode = $(this).parents('tr');
        $price = Number($parentNode.find('#price').text().replace('MMK', ''));
        $qty = Number($parentNode.find('#qty').val());
        $total = $price * $qty;
        $parentNode.find('#total').html($total + " MMK");
        summaryCalculation();
    });

    // click minus button event
    $('.btn-minus').click(function() {
        $parentNode = $(this).parents('tr');
        $price = Number($parentNode.find('#price').text().replace('MMK', ''));
        $qty = Number($parentNode.find('#qty').val());
        $total = $price * $qty;
        $parentNode.find('#total').html($total + " MMK");
        summaryCalculation();
    });

    function summaryCalculation() {
        $totalPrice = 0;
        $('#dataTable tr').each(function(index, row) {
            $totalPrice += Number($(row).find('#total').text().replace('MMK', ''));
        });
        $('#subTotalPrice').html(`${$totalPrice} MMK`);
        $('#finalPrice').html(`${$totalPrice + 2500} MMK`);
    }
})
