


document.addEventListener('click',function (e) {

    if(e.target.classList.contains('Asignar-Actividades')){
        
        $('.container').load("public/views/Lider/AdminTeam/AssingActivity.php", function (response, status, request) {
            this; // dom element
            
        });



        e.preventDefault();
    }



  })/* Fin del AddEvent Listener */