$(document).ready(function () {
    if ((window.location.href.includes('edit') || window.location.href.includes('create')) && window.location.href.includes('discounts')) {
        new MultiSelectTag('discount_brands');
        new MultiSelectTag('discount_categories');
        new MultiSelectTag('discount_products');
    }
    // search
    $('#searchDiscounts').on('input', function () {
        if ($(this).val() != '') {
            $('h2').show();
            $('#searchMsg').hide();
            $('.discountCard').hide();
            const value = $(this).val().toLowerCase();
            let counter = 0;
            $('.discountCard p').each(function () {
                if ($(this).text().toLowerCase().includes(value)) {
                    $(this).closest('.discountCard').show();
                    counter++;
                }
            });
            if (!counter) {
                $('h2').hide();
                $('#searchMsg').show();
            }
        } else {
            $('h2').show();
            $('#searchMsg').hide();
            $('.discountCard').show();
        }
    });
    // delete
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    $('.deleteDiscountBtns').click(function () {
        const discountId = $(this).data('discount');
        swal({
            title: "Дали сте сигурни?",
            text: "Кликнете ОК ако сакате да го избришете попустот",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        url: '/discounts/' + discountId,
                        method: 'DELETE',
                        success: function () {
                            swal("Успешно го избришавте попустот", {
                                icon: "success",
                            });
                            $(`div[data-discount="${discountId}"]`).remove();
                        },
                    })
                } else {
                    swal("Вашиот попуст е безбеден");
                }
            })
    })

})