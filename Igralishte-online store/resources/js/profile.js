$(document).ready(function () {
    // handling the image input for profile image
    const label = $(`#profileImageWrapper`);
    const oldImageUrl = label.find('img').attr('src');
    $('#profile_img').on('change', function () {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                label.html(`<img src="${e.target.result}" alt="user image" class="w-full h-full object-cover">`);
            };
            reader.readAsDataURL(this.files[0]);
        } else {
            label.html(`<img src="${oldImageUrl}" alt="user image" class="w-full h-full object-cover">`);
        }
    });
    // guest Part
    $('#wants_notifications').on('change', function () {
        $('#check_icon').toggle();
    })
    $('#submitParagraph').click(function () {
        $(this).closest('form').submit();
    })
    $('#image_url').on('change', function () {
        let wrapper = $(`#imgWrapper`);
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                wrapper.show();
                wrapper.html(`<img src="${e.target.result}" alt="user image" class="w-full h-full object-cover">`);
            };
            reader.readAsDataURL(this.files[0]);
        } else {
            wrapper.hide();
            wrapper.html('');
        }
    });
});