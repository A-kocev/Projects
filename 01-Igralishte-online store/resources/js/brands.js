$(document).ready(function () {
    if ((window.location.href.includes('edit') || window.location.href.includes('create')) && window.location.href.includes('brands')) {
        new MultiSelectTag('categories');
    }
    // search
    $('#searchBrands').on('input', function () {
        if ($(this).val() != '') {
            $('h2').show();
            $('#searchMsg').hide();
            $('.brandCard').hide();
            const value = $(this).val().toLowerCase();
            let counter = 0;
            $('.brandCard p').each(function () {
                if ($(this).text().toLowerCase().includes(value)) {
                    $(this).closest('.brandCard').show();
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
            $('.brandCard').show();
        }
    });
    // delete 
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    $('.deleteBrandBtns').click(function () {
        const brandId = $(this).data('brand');
        swal({
            title: "Дали сте сигурни?",
            text: "Кликнете ОК ако сакате да го избришете брендот",
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
                        url: '/brands/' + brandId,
                        method: 'DELETE',
                        success: function () {
                            swal("Успешно го избришавте брендот", {
                                icon: "success",
                            });
                            $(`div[data-brand="${brandId}"]`).remove();
                        },
                        error: function () {
                            swal("Неможе да се избрише брендот , бидејќи постојат продукти од тој бренд", {
                                icon: "error",
                            });
                        }
                    })

                } else {
                    swal("Вашиот бренд е безбеден");
                }
            })

    })
    // delete brand image on edit form
    $('.remove_brand_img').click(function () {
        const label = $(`label[for="${$(this).data('id')}"]`);
        label.html(`<span class="text-[#504E21]">+</span>`);
        label.removeClass('h-[52px] md:h-[84px]').addClass('py-3 md:py-7 bg-gray-300');
        $(this).hide();
        $.ajax({
            url: "/api/brandImage/delete",
            method: "DELETE",
            data: {
                img: $(this).data('id'),
                brandId: $(this).data('brand'),
            },
            success: function (response) {
                console.log(response);
            }
        })
    })
})