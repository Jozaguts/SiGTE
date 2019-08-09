$(document).ready(function () {


    let idsession = document.querySelector('input[type="hidden"]');
       
        function goBack(){
            if(idsession.getAttribute('data-session') != ""){
                let type = parseInt(idsession.getAttribute('data-session'))
                console.log(type)
                switch (type) {
                                   
                    case 0:
                         URL='public/views/maestro/home.php';
                        goTo(URL);
                        break;
                        case 1:
                         URL='public/views/lider/home.php';
                        goTo(URL);
                        break;
                        case 2:
                          
                        URL='public/views/miembro/home.php';
                        goTo(URL);
                        break;
                    default:
                        console.log('No Hay Sesion Iniciada');
                        break;
                }
        
          
            }else{
              
            }
           
        }
        goBack();
  

    // URLS
    const MAESTRO = 'public/views/maestro/login.php',
          LIDER='public/views/lider/login.php',
          MIEMBRO='public/views/miembro/login.php';


    window.addEventListener('click',function(e){

        // LISTENER PARA BOTON LOGOUT
        if(e.target.classList.contains('logout-icon')){
           
            if( logOut()== 'Sesión Cerrada'){
                console.log('Sesión Cerrada');
            }else{
                return false;
            }

         

        }

        if(e.target.classList.contains('btn-login')) {
            
            let tipoUser = e.target.getAttribute('data-tipouser');
            
            switch (tipoUser) {
                case '0':
                    goTo(MAESTRO);
                    break;
                case '1':
                    goTo(LIDER);
                 break;
                case '2':
                    goTo(MIEMBRO);
                    break;
                default:
                    alert('Usuario no admitido');
                    break;
            }
        } 


        // icon regresar en el login
        if(e.target.classList.contains('icon-row-left')) {   
        goBack();
        }


    // LISTENER PARA BOTON LOGIN
    if(e.target.getAttribute('id')== 'btnLogin'){  
                 
                if($('#user').val()=="" || $('#password').val()==""){
                    $('#user').val()==''?
                    $('.login-error__user').text('El Campo no Puede Estar Vacio')&&
                    setTimeout(() => {
                        $('.login-error__user').text('')
                    }, 3000) 
                    :null;
                    $('#password').val()==''?
                    $('.login-error__password').text('El Campo no Puede Estar Vacio')&&
                    setTimeout(() => {
                        $('.login-error__password').text('')
                    }, 3000) 
                    :null;
                }else{
            
                    // proceso los datos obtengo user y pass los paso a objetos para mandarlos al back
                    let jsonData={};
                    let data = $('#loginForm').serializeArray();
                   data.forEach(element => {
                    jsonData[element.name] = element.value;
                   });
            
                       fetch('public/DataBase/Login.php',{
                        method: 'POST',
                        headers: {'Content-Type':'application/x-www-form-urlencoded'}, 
                        body: JSON.stringify(jsonData)
                       })
                       .then(function(response){
                           return response.json()
                       })
                       .then(function(jsonResponse){
                        let URL='';
                        switch (jsonResponse.type) {
                           
                            case 0:
                                 URL='public/views/maestro/home.php';
                                goTo(URL);
                                
                                break;
                                case 1:
                                 URL='public/views/lider/home.php';
                                goTo(URL);
                               
                                break;
                                case 2:
                                URL='public/views/miembro/home.php';
                                goTo(URL);
                                
                                break;
                            default:
                                break;
                        }
                       
                       })
                       .catch(function(error) {
                        console.log('Hubo un problema con la petición Fetch:' + error.message);
                      });
            
            
            
                }

    }
        
            
            // Acciones de botones
    $('.Alta-de-Alumno').on('click',function(){

        /* create the link element */
var linkElement = document.createElement('link');

/* add attributes */
linkElement.setAttribute('rel', 'stylesheet');
linkElement.setAttribute('href', 'public/css/createStudent.css');
linkElement.setAttribute('id', 'createStudent');

/* attach to the document head */
document.getElementsByTagName('head')[0].appendChild(linkElement);

        $('.container').load(`public/views/maestro/CreateStudent.php`,{
        }, 
        function (response, status, request) {
            
        });
    })


    // CREAR ALUMNO

    if(e.target.classList.contains('form-create-student-container-form-container__button')){
        let jsonData={};
        let data = $('.form-create-student-container__form').serializeArray();
       data.forEach(element => {
        jsonData[element.name] = element.value;
       });

       this.console.log(jsonData);
    }

    })//fin addEventListener();

    
    
  


    // FUCNIONES
    // Te carga una vista
    function goTo(tipouser){
      
            $('.container').addClass('animated', 'fadeIn');

            $('.container').load(tipouser,{
            }, 
            function (response, status, request) {
            
            });
     
    }

    // CERRAR SESION

    function logOut(){
        fetch('public/DataBase/LogOut.php')
        .then(function(response){
            return response.json();
        })
        .then(function(josnResponse){
          
            if(josnResponse == 'Sesión Cerrada'){

                $('.container').load(`public/views/home.html`,{
                }, 
                function (response, status, request) {
                 
                });
            }
        })

    }

   


document.addEventListener('submit',function(e){
    e.preventDefault();
    e.stopPropagation();
});




});  //fin jq