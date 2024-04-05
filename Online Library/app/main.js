// GETTING THE RANDOM QUOTE IN FOOTER
$(document).ready(function () {
    $.ajax({
        url: "http://api.quotable.io/random",
        success: function (response) {
            $("#quote").html(`<p class="mb-1">${response.content}</p>
                              <p class="text-warning text-end m-0">${response.author}</p>`);
        },
    });
})