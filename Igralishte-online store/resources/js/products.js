viewOptionsOnPageLoad();
$(document).ready(function () {
    checkedBoxes();
    if (window.location.href.includes('edit') && window.location.href.includes('products')) {
        adjustQuantityInputWidth();
    }
    $('#addSizeBtn').click(addSizeInput);
    $('input[name=viewOptions]').on('change', viewOptions);
    // handling the product images slider
    $(".next").click(function () {
        const currentSlider = $(this).closest(".slider-inner");
        const currentImg = currentSlider.find(".active");
        const nextImg = currentImg.next('img');

        if (nextImg.length) {
            currentImg.removeClass("active").hide("slide", { direction: "left" }, "slow");
            nextImg.addClass("active").show("slide", { direction: "left" }, "slow");
        } else {
            const firstImg = currentSlider.find("img:first");
            currentImg.removeClass("active").hide("slide", { direction: "left" }, "slow");
            firstImg.addClass("active").show("slide", { direction: "right" }, "slow");
        }
    });
    $(".prev").click(function () {
        const currentSlider = $(this).closest(".slider-inner");
        const currentImg = currentSlider.find(".active");
        const prevImg = currentImg.prev('img');

        if (prevImg.length) {
            currentImg.removeClass("active").hide("slide", { direction: "right" }, "slow");
            prevImg.addClass("active").show("slide", { direction: "left" }, "slow");
        } else {
            const lastImg = currentSlider.find("img:last");
            currentImg.removeClass("active").hide("slide", { direction: "right" }, "slow");
            lastImg.addClass("active").show("slide", { direction: "left" }, "slow");
        }
    });
    // search
    $('#searchProcutsForm').on('submit', function (e) {
        e.preventDefault();
        if ($('#searchProducts').val() == '') {
            window.location = '/products';
        } else {
            window.location = `/products/search/${$('#searchProducts').val()}`;
        }
    })
    // delete
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    $('.deleteProductBtns').click(function () {
        const productId = $(this).data('product');
        swal({
            title: "Дали сте сигурни?",
            text: "Кликнете ОК ако сакате да го избришете продуктот",
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
                        url: '/products/' + productId,
                        method: 'DELETE',
                        success: function () {
                            swal("Успешно го избришавте продуктот", {
                                icon: "success",
                            });
                            $(`div[data-product="${productId}"]`).remove();
                        },
                    })
                } else {
                    swal("Вашиот продукт е безбеден");
                }
            })
    })
    //handling the size checkboxes 
    $('input[name="sizes[]"]').on('change', function () {
        $(`label[for="${$(this).attr('id')}"]`).toggleClass('bg-[#FFDBDB] bg-[#8A8328] text-white');
    });
    // handling the quantity input
    $('#quantity').on('input', adjustQuantityInputWidth);
    $('#quantityPlus').click(function () {
        $('#quantity').val(parseInt($('#quantity').val()) + 1);
        $('#quantity').trigger('input');
    })
    $('#quantityMinus').click(function () {
        if ($('#quantity').val() > 0) {
            $('#quantity').val(parseInt($('#quantity').val()) - 1);
            $('#quantity').trigger('input');
        }
    })
    // handling the colors checkboxes
    $('input[name="colors[]"]').on('change', function () {
        if ($(this).attr('id') == 'black') {
            $(`label[for="${this.id}"]`).toggleClass('border-2 border-rose-300');
        } else if ($(this).attr('id') == 'white') {
            $(`label[for="${this.id}"]`).toggleClass('border border-gray-400 border-2 border-black');
        } else {
            $(`label[for="${this.id}"]`).toggleClass('border-2 border-black');
        }
    });
    // deleting product image on edit form
    $('.remove_img').click(function () {
        const label = $(`label[for="${$(this).data('id')}"]`);
        const removeText = $(this)

        $.ajax({
            url: "/api/image/delete",
            method: "DELETE",
            data: {
                img: $(this).data('id'),
                productId: $(this).data('product'),
            },
            success: function () {
                label.html(`<span class="text-[#504E21]">+</span>`);
                label.removeClass('sm:h-[52px] md:h-[84px]').addClass('py-3 md:py-7 bg-gray-300');
                removeText.hide();
            }
        })
    })
    // brand and categories on edit form
    if (window.location.href.includes('edit') && window.location.href.includes('products')) {
        const productId = $('#id').val();
        $.ajax({
            url: `/api/categories/${$('#edit_brand').val()}/${productId}`,
            method: 'GET',
            success: function (response) {
                $('#edit_category').html('<option value="" selected disabled>Choose Type</option>');
                response.data.categories.forEach(category => {
                    if (category['id'] == response.data.productCategory) {
                        $('#edit_category').append(`
                        <option value="${category['id']}" selected>${category['name']}</option>
                    `);
                    } else {
                        $('#edit_category').append(`
                        <option value="${category['id']}">${category['name']}</option>
                    `);
                    }

                });
            }
        });
        $('#edit_brand').on('change', function () {
            $.ajax({
                url: `/api/categories/${$(this).val()}`,
                method: "GET",
                success: function (response) {
                    $('#edit_category').html('<option value="" disabled selected>Одбери</option>');
                    $.each(response.data, function (index, category) {
                        $('#edit_category').append(`<option value="${category.id}">${category.name}</option>`)
                    });
                }
            })
        })
    }
    // discount selector 
    $('label[for="discount"]').click(function () {
        $('#productDiscount').show();
    })
    // handling the brand and cateogry selects on add form
    $('#brand').on('change', function () {
        $('#categoryWrapper').show();
        $.ajax({
            url: `/api/categories/${$(this).val()}`,
            method: "GET",
            success: function (response) {
                $('#category').html('<option value="" disabled selected>Одбери</option>');
                $.each(response.data, function (index, category) {
                    $('#category').append(`<option value="${category.id}" {{ old('brand') == "category.id" ? 'selected' : '' }}>${category.name}</option>`)
                });
            }
        })
    })

});
// functions
function viewOptions() {
    if ($('#tableView').is(':checked')) {
        showTableView();
    } else if ($('#listView').is(':checked')) {
        showListView();
    }
}
function viewOptionsOnPageLoad() {
    if (sessionStorage.getItem('selectedView') && sessionStorage.getItem('selectedView') == 'list') {
        showListView()
    } else {
        showTableView()
    }

}
function showTableView() {
    $('#tableView').prop('checked', true);
    $('#listViewIcon').removeClass('bg-[#FFDBDB]');
    $('#tableViewIcon').addClass('bg-[#FFDBDB]');
    $('.listCard').hide();
    $('.tableCard').show();
    sessionStorage.setItem('selectedView', 'table');
}
function showListView() {
    $('#listView').prop('checked', true);
    $('#tableViewIcon').removeClass('bg-[#FFDBDB]');
    $('#listViewIcon').addClass('bg-[#FFDBDB]');
    $('.tableCard').hide();
    $('.listCard').css('display', 'flex');
    sessionStorage.setItem('selectedView', 'list');
}
function addSizeInput() {
    $('#customSizes').append(`<input type="text" class="inline-block w-12 mt-1 mr-2 border-gray-300 focus:border-rose-500 focus:ring-rose-500 rounded-md shadow-sm text-sm" name="newsizes[]">`);
}
function adjustQuantityInputWidth() {
    $('#quantity').width($('#quantity').val().length * 10);
}
function checkedBoxes() {
    $('input[name="sizes[]"]').each(function () {
        if ($(this).prop('checked')) {
            $(`label[for="${$(this).attr('id')}"]`).removeClass('bg-[#FFDBDB]').addClass('bg-[#8A8328] text-white');
        }
    })
    // $('input[name="colors[]"]').each(function () {
    //     if ($(this).prop('checked')) {
    //         if ($(this).attr('id') == 'black') {
    //             $(`label[for="${this.id}"]`).addClass('border-2 border-rose-300');
    //         } else if ($(this).attr('id') == 'white') {
    //             $(`label[for="${this.id}"]`).removeClass('border border-gray-400').addClass('border-2 border-black');
    //         } else {
    //             $(`label[for="${this.id}"]`).addClass('border-2 border-black');
    //         }
    //     }
    // });
}

