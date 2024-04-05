/*
|--------------------------------------------------------------------------
| App js
|--------------------------------------------------------------------------
|
| This file serves as the main entry point for JavaScript functionality
| in the application. It imports necessary dependencies, initializes
| Alpine.js, and includes specific JavaScript files for various
| features and components of the application.
|
| Import Dependencies:
|   - Alpine.js: A minimal framework for declarative JavaScript components.
|   - Tagify: A library for managing tags in input fields.
|   - SweetAlert: A library for displaying customizable alert messages.
|
| Included JavaScript Files:
|   - products.js: Contains functionality related to product management.
|   - discounts.js: Contains functionality related to discount management.
|   - brands.js: Contains functionality related to brand management.
|   - navigation.js: Contains functionality related to navigation and UI.
|
| Note: For specific functions related to a particular feature or component,
| refer to the corresponding JavaScript file.
|
*/
import Alpine from 'alpinejs';
import Tagify from '@yaireo/tagify';
import '@yaireo/tagify/dist/tagify.css';
import swal from 'sweetalert';
import './products.js';
import './discounts.js';
import './brands.js';
import './navigation.js';
import './profile.js';


window.Alpine = Alpine;
Alpine.start();
$(document).ready(function () {
    // hiding alerts
    setTimeout(() => {
        $('div[role="alert"]').hide("fade", 1000);
    }, 2000);
    // Handling the search icon
    $('#searchProducts ,#searchDiscounts,#searchBrands').on('input', function () {
        if ($(this).val() != '') {
            $('#searchIcon').hide();
        } else {
            $('#searchIcon').show();
        }
    })
    //handling the image inputs for products and brands
    $('.input-image').on('change', function () {
        const label = $(`label[for="${this.id}"]`);
        $(`.remove_img[data-id="${this.id}"]`).hide();
        if (this.files && this.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                label.html(`<img src="${e.target.result}" alt="product image" class="basis-12/12 object-cover h-full">`);
            };
            label.removeClass('py-3 bg-gray-300 md:py-7').addClass('h-[52px] md:h-[84px]');
            reader.readAsDataURL(this.files[0]);
        } else {
            label.html(`<span class="text-[#504E21]">+</span>`);
            label.removeClass('h-[52px] md:h-[84px]').addClass('py-3 bg-gray-300 md:py-7');
        }
    })
    // tags
    let whitelist = [];
    $.ajax({
        url: '/api/tags',
        method: 'GET',
        success: function (response) {
            $.each(response.data, function (index, value) {
                whitelist.push(value.name);
            })
            const input = document.querySelector('input[name="tags"]'),
                tagify = new Tagify(input, {
                    whitelist,
                    maxTags: 10,
                    dropdown: {
                        maxItems: 20,
                        classname: "tags-look",
                        enabled: 0,
                        closeOnSelect: false
                    },
                    transformTag: function (tagData) {
                        if (!tagData.value.startsWith('#')) {
                            tagData.value = '#' + tagData.value;
                        }
                    }
                })
        }
    });
});



