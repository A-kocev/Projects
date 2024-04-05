$(document).ready(function () {
    $('.openMenu').click(function () {
        $('#sideBar').switchClass("w-[25%] md:w-[20%] lg:w-[15%]", "basis-12/12 w-full", { effect: "slide", direction: 'right', duration: 650 });
        $('main').hide();
        $('nav').removeClass('items-center');
        $('nav > div').removeClass('items-center');
        $('.nav-link').removeClass('hidden');
        $('nav div').removeClass('justify-center');
        $('.sidebar-links').addClass('pl-3');
        $('.biggerIcons').css('margin-left', '2px');
    });
    $('#closeMenuBtn').click(function () {
        $('#sideBar').removeClass('basis-12/12 w-full').addClass('w-[25%] md:w-[20%] lg:w-[15%]');
        $('main').show({ effect: "slide", direction: 'right', duration: 650 });
        $('nav').addClass('items-center');
        $('nav > div').addClass('items-center');
        $('.nav-link').addClass('hidden');
        $('nav div').addClass('justify-center');
        $('.sidebar-links').removeClass('pl-3');
        $('.biggerIcons').css('margin-left', '0px');
    });

});