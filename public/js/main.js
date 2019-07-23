$(document).ready(function () {

    $('.btn-maestro').on('click', function () {
        $('.container').addClass('aninated', 'fadeIn');
        $('.container').load("./public/views/maestro/home.php",{

        }, 
        // C:/laragon/www/9no/SiGTE/public/views/maestro/home.php
        function (response, status, request) {

         
            
        });
    });


}); 