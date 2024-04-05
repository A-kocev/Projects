import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// admin nav-bar
$('#nav_products').click((e)=>{
    $('#product_items').toggle();
});

$('#nav_orders').click((e) => {
    $('#orders_items').toggle();
});

$('#nav_gallery').click((e) => {
    $('#gallery_items').toggle();
});

$('#nav_responsive_products').click((e) => {
    $('#product_responsive_items').toggle();
});

$('#nav_responsive_orders').click((e) => {
    $('#orders_responsive_items').toggle();
});

// add-product panel 
$('#categories').on('change', function () {
    console.log($(categories).val());
    $.ajax({
        url: `/api/category/types/${$(categories).val()}`,
        method: 'GET',
        success: function (response) {
            console.log(response);
            $('#types').show();
            $('#types').html('<option value="" selected disabled>Choose Type</option>');
            response.data.forEach(type => {
                $('#types').append(`
                    <option value="${type.id}">${type.name}</option>
                `);
            });
        }
    })
})

//edit-product panel
$(function () {
    setTimeout(function () {
        $('.alert').hide();
    }, 3000);

    if (window.location.href.indexOf("/product/edit") > -1) {
        let userId = $('#id').val();
        $.ajax({
            url: `/api/category/types/${$('#edit_categories').val()}/${userId}`,
            method: 'GET',
            success: function (response) {
                $('#edit_types').show();
                $('#edit_types').html('<option value="" selected disabled>Choose Type</option>');
                response.types.forEach(type => {
                    if (type['id'] == response.product['type_id']) {
                        $('#edit_types').append(`
                        <option value="${type['id']}" selected>${type['name']}</option>
                    `);
                    } else {
                        $('#edit_types').append(`
                        <option value="${type['id']}">${type['name']}</option>
                    `);
                    }

                });
            }
        });
        $('#edit_categories').on('change', function () {
            $.ajax({
                url: `/api/category/types/${$('#edit_categories').val()}`,
                method: 'GET',
                success: function (response) {
                    $('#edit_types').show();
                    $('#edit_types').html('<option value="" selected disabled>Choose Type</option>');
                    response.data.forEach(type => {
                    console.log(type.name);

                        $('#edit_types').append(`
                            <option value="${type.id}">${type.name}</option>
                            `);
                    });
                }
            })
        })
    }
});





