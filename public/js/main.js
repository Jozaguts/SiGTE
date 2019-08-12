$(document).ready(function () {


    let idsession = document.querySelector('input[type="hidden"]');
       
        function goBack(){
            if(idsession.getAttribute('data-session') != ""){
                let type = parseInt(idsession.getAttribute('data-session'))
               
                switch (type) {
                                   
                    case 1:
                         URL='public/views/maestro/home.php';
                        goTo(URL);
                        break;
                        case 2:
                         URL='public/views/lider/home.php';
                        goTo(URL);
                        break;
                        case 3:
                          
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
        e.stopPropagation();
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
            console.log(tipoUser);
            switch (tipoUser) {
                case '1':
                    goTo(MAESTRO);
                    break;
                case '2':
                    goTo(LIDER);
                 break;
                case '3':
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
                           
                            case 1:
                                 URL='public/views/maestro/home.php';
                                goTo(URL);
                                
                                break;
                                case 2:
                                 URL='public/views/lider/home.php';
                                goTo(URL);
                               
                                break;
                                case 3:
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

        $('.container').load(`public/views/maestro/AdminStudent/CreateStudent.php`,{
        }, 
        function (response, status, request) {
            
        });
    })


    // CREAR ALUMNO

    if(e.target.classList.contains('form-create-student-container-form-container__button')){
      
        let inputs = this.document.querySelectorAll('input')
     
        inputs.forEach(function(input,index){
            if(input.value==""){
           input.style.border = "1px solid red";
          input.nextElementSibling.innerText= input.getAttribute('placeholder') +' No puede estar Vacio';
         
            }else{
                input.style.border = " 1px solid #bdbdbd";
                input.nextElementSibling.innerText="";
                input.previousElementSibling.setAttribute('class', 'animated fadeIn');
                input.previousElementSibling.style.color = " #bdbdbd";
                input.previousElementSibling.innerText = input.getAttribute('placeholder');
                
            }
            
        })
        let count=0;
        inputs.forEach(element => {
            element.value==""?count++:count;
        });
  
        if(count==0){
            let jsonData={};
            let data = $('.form-create-student-container__form').serializeArray();
           data.forEach(element => {
            jsonData[element.name] = element.value;
           });
           console.log(jsonData);
          
    
           fetch('public/DataBase/CreateStudent.php',{
            method: 'POST',
            headers: {'Content-Type':'application/x-www-form-urlencoded'}, 
            body: JSON.stringify(jsonData)
           }).then(function(response){
            return response.json();
           })
           .then(function(jsonResponse){
   
               
            $(".container").load("public/views/maestro/SuccessAlert/StudentAlert/SuccessStudent.php", "data", function (response, status, request) {
              
                
            });
          
           })
           .catch((err) => {
                this.console.log(err)
           })
        }else{
            document.querySelectorAll('input').forEach(function(input){
              
            })
        }
       

      
    }

    // regresar a crear alumno
    if(e.target.classList.contains('option-ok')){
        let link = e.target.getAttribute('value');
       
        $('.container').load(`public/views/${link}.php`, 

         function (response, status, request) {
        
            
            
        });
    }
    // salir de crear alumno
    if(e.target.classList.contains('option-not')){
        let link = e.target.getAttribute('value');
     
        $('.container').load(`public/views/maestro/${link}.php`, 

         function (response, status, request) {
        
            
            
        });
    }

    // asignarl alumno
      
    if(e.target.classList.contains('Asignar-Alumno')){

        $('.container').load('public/views/maestro/AdminStudent/AssignStudent.php', function (response, status, request) {
            this; // dom element
            
        });
    }
    if(e.target.classList.contains('form-assing-student-container-form-container__button')){


        let selects = document.querySelectorAll('select');
// console.log(selects);
        selects.forEach(select => {
          if(select.options[select.selectedIndex].value == 'false'){
            select.nextElementSibling.innerText = 'Seleccione Una Opción';
          }else{
            select.nextElementSibling.innerText = '';
          }      
        });
        let count=0;
        selects.forEach(select => {
            select.options[select.selectedIndex].value == 'false'?count++:count;
        });
        
        if(count == 0){

            let data={};
            data.user_id =$("#alumno").find(":selected").val();
            data.id_project =$("#proyecto").find(":selected").val();
            data.id_team =$("#equipo").find(":selected").val();
            data.leader= $("input[name=leader]:checked").val()==undefined? data.leader='false':data.leader= $("input[name=leader]:checked").val();
            console.log(data)
            // data.request= 'assingStudent';

            fetch('public/DataBase/AssingStudent.php',{
                method: 'POST',
                headers: {'Content-Type':'application/x-www-form-urlencoded'}, 
                body: JSON.stringify(data)
               }).then(function(res){
                return res.json();
               }).then(function(res){

                $(".container").load("public/views/maestro/SuccessAlert/StudentAlert/SuccessStudent.php", "data", function (response, status, request) {
              
                
                });

               }).catch((err) => {
                console.log(err);    
               })
        }
        
    }
    
 // evaluar alumno

 if(e.target.classList.contains('Evaluar-Alumno')){

    $('.container').load('public/views/maestro/AdminStudent/EvalueStudent.php', function (response, status, request) {
        this; // dom element
        
    });

   




}// if de evaluar alumno 

 // estoy fuera del if
 $('.getWithActivitys').on('change', function(e) {
    e.stopPropagation();
    id = this.value

 
    fetch('public/DataBase/EvalueStudent.php',{
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'}, 
        body: JSON.stringify(id)
       })
       .then(function(res) {
            return res.json();  
        })
       .then(function (resJson) {
       
        // let tr = document.createElement('tr');
        resJson.forEach(function(row ,index){
             index = document.createElement('tr');
                let td1 = document.createElement('td')
                let td2 = document.createElement('td')
                let td3 = document.createElement('td')
                let input = document.createElement('input')
                input.setAttribute('type','number');
                input.setAttribute('data-userid',`${row.id_user}`);
                input.setAttribute('data-activity',`${row.id_activity}`);
                input.setAttribute('class','input-table');
                row.score==null?row.score=0:row.score==row.score;
                input.setAttribute('placeholder',row.score);
  
    
                
            td1.innerText = row.name_activity;
            $(index).append(td1);
            td2.innerText = row.status_activity;
            $(index).append(td2); 
            $(td3).append(input); 
            $(index).append(td3);
            
           
            $('#tbody').append(index);
        })
      
 

          
        })
       .catch((err) => {
            console.log(err);
       })
       
    

     
  });

//   evaluar alumon mandar calificaicon

if(e.target.classList.contains('form-assing-student-container-form-container__button__evalueStudent')) {
    let inputs = document.querySelectorAll('input');
    let arraydata=[];
    inputs.forEach(function(input){
        let data= {};
        data.user_id = input.getAttribute('data-userid');
        data.id_activity = input.getAttribute('data-activity');
        data.score = input.value;
        arraydata.push(data)
    })
    fetch('public/DataBase/SetScoreStudent.php',{
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'}, 
        body: JSON.stringify(arraydata)
       })
       .then(function(response){
        return response.json();
       })
       .then(function(jsonResponse){

        $(".container").load("public/views/maestro/SuccessAlert/StudentAlert/SuccessStudent.php", "data", function (response, status, request) {
              
                
        });
       })
}


// botones navbar maestro
if(e.target.classList.contains('studens-icon_teacher')){
    e.stopPropagation();
    $('.main-content-container__list').html(`
    
    <li class="main-content-container-list__item Alta-de-Alumno "> Alta de Alumno</li>
    <li class="main-content-container-list__item Asignar-Alumno ">Asignar Alumno</li>
    <li class="main-content-container-list__item Evaluar-Alumno ">Evaluar Alumno</li>
    `);
}


if(e.target.classList.contains('team-icon_teacher')){
    e.stopPropagation();
    $('.main-content-container__list').html(`
    <li class="main-content-container-list__item main-content-container-list__item_teacher">Registrar Equipo</li>
    `);
}
if(e.target.classList.contains('project-icon_teacher')){
    e.stopPropagation();
    $('.main-content-container__list').html(`
    
    <li class="main-content-container-list__item main-content-container-list__item__register-project  "> Registrar Proyecto</li>
    <li class="main-content-container-list__item  main-content-container-list__item__advances-project">Avances y Evidencias del Proyecto</li>
    <li class="main-content-container-list__item main-content-container-list__item__evalute-project">Evaluar Proyecto</li>
    <li class="main-content-container-list__item main-content-container-list__item__
    10/5000
    results-project">Resultados de Proyectos</li>
    `);
}

// 
// 
// 
// 
// 
// 
// 
// espacio para los botones del navbar


// crear equipo
if(e.target.classList.contains('main-content-container-list__item_teacher')){
$('.container').load("public/views/maestro/AdminTeam/RegisterTeam.php", "data", function (response, status, request) {
    this; // dom element
    
});
}

if(e.target.classList.contains('form-create-student-container-form-container__button_create-team')) {

    let data={};

    data.cod_team = $('#cod_team').val();
    data.name_team = $('#name_team').val();

    fetch('public/DataBase/SetTeam.php',{
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'}, 
        body: JSON.stringify(data)
       })
       .then(function(response){
        return response.json();
       })
       .then(function(jsonResponse){
        $(".container").load("public/views/maestro/SuccessAlert/TeamAlert/SuccessTeam.php", "data", function (response, status, request) {
              
                
        });
    })
    .catch((err) => {
        console.log(err);    
    })
  
}

// registrar proyecto

if(e.target.classList.contains('main-content-container-list__item__register-project')){
    $('.container').load("public/views/maestro/AdminProject/RegisterProject.php", "data", function (response, status, request) {
        
        
    });
    }

    // agregar activiades al proyecto
        
      
    // let activitiesProject = {};
    // let ArrayActivities = [];
  
    // if(e.target.classList.contains('btn-span')){
      
    //     if(e.target.previousElementSibling.value != "" && e.target.previousElementSibling.value.length > 5 ){
    //         ArrayActivities.push(e.target.previousElementSibling.value)
    //         cl
    //         e.target.nextElementSibling.style.position="absolute";
    //         e.target.nextElementSibling.style.top="-20px";
    //         e.target.nextElementSibling.style.left="0";
    //         e.target.nextElementSibling.style.marginLeft="16px";
    //         e.target.nextElementSibling.style.color ="#448AFF";
    //         e.target.nextElementSibling.innerText = "Actividad Agregada";

           
    //         setTimeout(() => {
    //             e.target.nextElementSibling.innerText = "";
    //         }, 2500);
          
    //     }else{
    //         e.target.nextElementSibling.style.position="absolute";
    //         e.target.nextElementSibling.style.top="-20px";
    //         e.target.nextElementSibling.style.left="0";
    //         e.target.nextElementSibling.style.marginLeft="16px";
    //         e.target.nextElementSibling.style.color ="#757575";
    //         e.target.nextElementSibling.innerText = "Nombre muy Corto";
    //         $('#name_project').val('');
    //         setTimeout(() => {
    //             e.target.nextElementSibling.innerText = "";
    //         }, 2500);
         
    //     }
       
       
    // }

   
    let activitiesProject = {};

    if(e.target.classList.contains('form-create-student-container-form-container__button_create-project')){
       


        // obtengo el nombre del proyecto
        $('#name_project').val().length > 5 ? 
        activitiesProject.name_project =  $('#name_project').val(): 
         $('#name_project').prev().text('Ingrese un Nombre de Proyecto');
        //  limpio la etiqueta de alerta
        $('#name_project').val().length > 5 ? 
        $('#name_project').prev().text(''):
        null;


        if($('#file').val() == 'false'){
            $('#file').prev().text('Seleccione un tipo de Archivo')
        }else{
            $('#file').prev().text(''); 
            activitiesProject.file = $("#file option:selected").text();
        }

        
        if( $('#endDate').val() == ''){
            $('#endDate').prev().text('Seleccione una Fecha')
        }else{
            $('#endDate').prev().text(''); 
            activitiesProject.endDate =  $('#endDate').val()
        }

            activitiesProject.comments =  $('#comments').val()


        if(Object.keys(activitiesProject).length == 4){

            fetch('public/DataBase/SetProject.php',{
                method: 'POST',
                headers: {'Content-Type':'application/x-www-form-urlencoded'}, 
                body: JSON.stringify(activitiesProject)
               })
               .then(function(response){
                return response.json();
               })
               .then(function(jsonResponse){
                $(".container").load("public/views/maestro/SuccessAlert/ProjectAlert/SuccessProject.php", "data", function (response, status, request) {
                      
                        
                });
            })
            .catch((err) => {
                console.log(err);    
            })
        
        }

       
    }


    // Avances del proyecto y evidencias





  
   





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