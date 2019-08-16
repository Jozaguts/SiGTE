// $(document).ready(function () {


    let idsession = document.querySelector('input[type="hidden"]');

    
       
        function goBack(){
            // if(idsession.getAttribute('data-session') != ""){
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
           
        }
        if(idsession != 100){
            goBack();
        }else{
            // return false;
        }
  

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
                // return false;
            }

         

        }

        if(e.target.classList.contains('btn-login')) {
            
            let tipoUser = e.target.getAttribute('data-tipouser');
            
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
                       return false;
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
           
            
        });
    }
    if(e.target.classList.contains('form-assing-student-container-form-container__button')){


        let selects = document.querySelectorAll('select');

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
       
            // data.request= 'assingStudent';
            console.log(data)
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

 if(e.target.classList.contains('Editar-Alumno')){

    $('.container').load('public/views/maestro/AdminStudent/EditStudent.php', function (response, status, request) {
        this; // dom element
        
    });

   




}// if de evaluar alumno 

 // estoy fuera del if
 $('.getWithActivitys').on('change', function(e) {
    e.stopPropagation();
    userId = this.value
    data ={
        getInfo:userId
    }
    $('.btn-delete').val(userId)
   console.log($('.btn-delete'))
   

 
    fetch('public/DataBase/EditStudent.php',{
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'}, 
        body: JSON.stringify(data)
       })
       .then(function(res) {
            return res.json();  
        })
       .then(function (resJson) {
      

       resJson.forEach(function(datoStudent, index){

        
        $('.data-student').html('');
        // ######### 1 nombre
        let small = document.createElement('small');
        let input= document.createElement('input');
        let hidden = document.createElement('input');
        hidden.setAttribute('type','hidden');
        hidden.setAttribute('value',`${datoStudent.user_id}`);
        
        let secondsmall = document.createElement('small');
        let div = document.createElement('div');

        small.innerText = `${Object.keys(datoStudent)[0]}`
        input.setAttribute('placeholder',`${datoStudent['Nombre']}`);
        input.setAttribute('value',`${datoStudent['Nombre']}`);
        input.innerText =datoStudent['Nombre']
       
    
       
        div.classList.add('input-container')
        div.appendChild(small)
        div.appendChild(input)
        div.appendChild(secondsmall)
        div.appendChild(hidden)
       
        $('.data-student').append(div);

        // ######### 2 Apellido Paterno    
        let small2 = document.createElement('small');
        let input2= document.createElement('input');
        let secondsmall2 = document.createElement('small');
        let div2 = document.createElement('div');

        small2.innerText = `${Object.keys(datoStudent)[1]}`
        input2.setAttribute('placeholder',`${datoStudent['Apellido Paterno']}`);
        input2.setAttribute('value',`${datoStudent['Apellido Paterno']}`);
        input2.innerText =datoStudent['Apellido Paterno']
        div2.classList.add('input-container')


        div2.appendChild(small2)
        div2.appendChild(input2)
        div2.appendChild(secondsmall2)
        
        $('.data-student').append(div2);

    // ######### 3 Apellido Materno   
    let small3 = document.createElement('small');
    let input3= document.createElement('input');
    let secondsmall3 = document.createElement('small');
    let div3 = document.createElement('div');

    small3.innerText = `${Object.keys(datoStudent)[2]}`
    input3.setAttribute('placeholder',`${datoStudent['Apellido Materno']}`);
    input3.setAttribute('value',`${datoStudent['Apellido Materno']}`);
    input3.innerText =datoStudent['Apellido Materno']
    div3.classList.add('input-container')


    div3.appendChild(small3)
    div3.appendChild(input3)
    div3.appendChild(secondsmall3)
    
    $('.data-student').append(div3);
       
       // ######### 4 Tipo De Usuario   
       let small4 = document.createElement('small');
       let input4= document.createElement('input');
       let secondsmall4 = document.createElement('small');
       let div4 = document.createElement('div');
       
       small4.innerText = `${Object.keys(datoStudent)[6]}`
       input4.setAttribute('type','number');
       input4.setAttribute('placeholder',`${datoStudent['Tipo de Usuario']}`);
       input4.setAttribute('value',`${datoStudent['Tipo de Usuario']}`);
      
       input4.innerText =datoStudent['Tipo de Usuario']
       div4.classList.add('input-container')
   
   
       div4.appendChild(small4)
       div4.appendChild(input4)
       div4.appendChild(secondsmall4)
       
       $('.data-student').append(div4);
          

       // ######### 5 Nombre De Usuario   
       let small5 = document.createElement('small');
       let input5= document.createElement('input');
       let secondsmall5 = document.createElement('small');
       let div5 = document.createElement('div');
   
       small5.innerText = `${Object.keys(datoStudent)[3]}`
       input5.setAttribute('placeholder',`${datoStudent['Nombre de Usuario']}`);
       input5.setAttribute('value',`${datoStudent['Nombre de Usuario']}`);
       input5.innerText =datoStudent['Nombre de Usuario']
       div5.classList.add('input-container')
   
   
       div5.appendChild(small5)
       div5.appendChild(input5)
       div5.appendChild(secondsmall5)
       
       $('.data-student').append(div5);
       // ######### 5 Contrseña De Usuario   
       let small6 = document.createElement('small');
       let input6= document.createElement('input');
       input6.setAttribute('type','password');
       let secondsmall6 = document.createElement('small');
       let div6 = document.createElement('div');
      console.log(datoStudent);
       small6.innerText = `${Object.keys(datoStudent)[7]}`
       input6.setAttribute('placeholder',`${datoStudent['Contraseña']}`);
       input6.setAttribute('value',`${datoStudent['Contraseña']}`);
       input6.innerText =datoStudent['Contraseña']
       div6.classList.add('input-container')
   
   
       div6.appendChild(small6)
       div6.appendChild(input6)
       div6.appendChild(secondsmall6)
       
       $('.data-student').append(div6);

     

    

    }) 
    // termina el pintado en pantalla

       

   
    
          
        })
       .catch((err) => {
            console.log(err);
       })
       
    

     
  });

  // BTN ELIMAR ALUMNO 
$('.btn-delete').on('click',function(e){
    

let id = e.target.value;
    let data = {
        DeleteUser:"true",
        id:id
    }

    fetch('public/DataBase/EditStudent.php',{
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'}, 
        body: JSON.stringify(data)
       })
       .then(function(res) {
            return res.json();  
        })
        .then((result) => {
            $(".container").load("public/views/maestro/SuccessAlert/ProjectAlert/DeleteUser.php", "data", function (response, status, request) {
              
                
            });
        }).catch((err) => {
            console.log(err);
        })


    console.log(data);
})// aqui termina la eliminacion de usuarios (Alumno)




//   evaluar alumno mandar calificaicon

if(e.target.classList.contains('form-assing-student-container-form-container__button__evalueStudent')) {
    let inputs = document.querySelectorAll('input');
 
    data= {
        user_id:inputs[1].value,
        name: inputs[0].value,
        paternal_name: inputs[2].value,
        maternal_name: inputs[3].value,
        user_type_id: inputs[4].value,
        username: inputs[5].value,
        password: inputs[6].value,
        edit:"true"
    }
   
  
 
    
    fetch('public/DataBase/EditStudent.php',{
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'}, 
        body: JSON.stringify(data)
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
  
    <li class="main-content-container-list__item Editar-Alumno";">Editar Alumno</li>
    `);
}


if(e.target.classList.contains('team-icon_teacher')){
    e.stopPropagation();
    $('.main-content-container__list').html(`
    <li class="main-content-container-list__item main-content-container-list__item_teacher">Registrar Equipo</li>
    <li class="main-content-container-list__item main-content-container-list__item assing-team-of-project">Asignar Equipo A Proyecto</li>
    `);
}
if(e.target.classList.contains('project-icon_teacher')){
    e.stopPropagation();
    $('.main-content-container__list').html(`
    
    <li class="main-content-container-list__item main-content-container-list__item__register-project  "> Registrar Proyecto</li>
    <li class="main-content-container-list__item " >Crear Actividades</li>

    <li class="main-content-container-list__item main-content-container-list__item__evalute-project">Evaluar Proyecto</li>
    <li class="main-content-container-list__item main-content-container-list__item__results-project" id="resultados">Resultados de Proyectos</li>
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
    data.max_students = $('#max_students').val();

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

// asignar equipo a proyecto

if(e.target.classList.contains('assing-team-of-project')) {
   
    $('.container').load("public/views/maestro/AdminProject/AssingTeam.php", "data", function (response, status, request) {
        this; // dom element
        
    });

}
// asignar equipo a proyecto segunda parte de proceso obtener los projetos disponibles
$('#selectforGetProjects').change(function (e) { 

    //    let id = e.target.options[e.target.selectedIndex].value <--- id equipo;
    data={
        selectforGetProjects: "selectforGetProjects"
    };

    fetch('public/database/TeamActions.php',{
        method:'POST', 
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        body:JSON.stringify(data)
    })
    .then((value) => {
     return value.json()
    })
    .then((value2) => {
   
      let container = document.querySelector('.projects-container')
      

      value2.forEach(function (params) {
            let span = document.createElement('span');

            span.setAttribute('value',params.id_project)
            span.innerText = params.name_project;
            span.setAttribute('class','value-project');

            container.appendChild(span);

      })
            
  
    })
    .catch((err) => {
        console.log(err);
    })

});






if(e.target.classList.contains('value-project')){
    let button = document.querySelector('.form-create-student-container-form-container__assign-Team-To-Project');
    button.setAttribute('value', `${e.target.getAttribute('value')}`);
    button.style.background = "#448AFF";
    button.style.color = "white";
    button.innerText = "Equipo seleccionado ¿Guardar Cambios?";
}


// sigo asignando equipo a proyecto
if(e.target.classList.contains('form-create-student-container-form-container__assign-Team-To-Project')){
   
let idProject = e.target.getAttribute('value');
let select = document.getElementById('selectforGetProjects');
let idTeam = select.options[select.selectedIndex].value;

data={
    assingTeamToProject: "true",
    id_project: idProject,
    id_team: idTeam
};
console.log(data);
    fetch('public/database/TeamActions.php',{
        method:'POST',
        headers:{'Content-Type':'application/x-www-form-urlencoded '},
        body: JSON.stringify(data)
    })
    .then((value) => {
        return value.json()
    })
    .then((result) => {
        $(".container").load("public/views/maestro/SuccessAlert/ProjectAlert/SuccessProject.php", "data", function (response, status, request) {
                      
          
        });
    }).catch((err) => {
        console.log(err)
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

    if(e.target.classList.contains('main-content-container-list__item__advances-project')){
        $('.container').load("public/views/maestro/AdminProject/ProjectEvidence.php", "data", function (response, status, request) {
            
            
        });
        }

        $('#proyectoEvidence').change(function (e) { 
            e.preventDefault();

            let id = this.value;

            fetch('public/DataBase/AdvancesEvidenceProject.php',{
                method: 'POST',
                headers: {'Content-Type':'application/x-www-form-urlencoded'}, 
                body: JSON.stringify(id)
               })
               .then(function(response){
                return response.json();
               })
               .then(function(jsonResponse){
                   if(jsonResponse == 'No hay Actividades'){
                    
                   }else{

                    jsonResponse.forEach(element => {

                        let option = document.createElement('option');
                        option.setAttribute('value', `${element.id_activity}`)
                        option.innerText = `${element.name_activity}`;

                        $('#activityEvidence').append(option);
                   
                         
                        });
                   }
                  
              
                // 

                
            })
            .catch((err) => {
                console.log(err);    
            })

            
            
        });

        let advanceofactivitiesProject = {};
        if(e.target.classList.contains('form-create-student-container-form-container__button_get-evidence-project')){


            $('#proyectoEvidence').val()
            if($('#proyectoEvidence').val() == 'false'){
                $('#proyectoEvidence').prev().text('Seleccione un Proyecto')
            }else{
                $('#proyectoEvidence').prev().text(''); 
                advanceofactivitiesProject.id_project = $("#proyectoEvidence option:selected").val();
            }
            if($('#activityEvidence').val() == 'false'){
                $('#activityEvidence').prev().text('Seleccione una actividad')
            }else{
                $('#activityEvidence').prev().text(''); 
                advanceofactivitiesProject.id_activity = $("#activityEvidence option:selected").val();
            }
    
         if(Object.keys(advanceofactivitiesProject).length == 2){
            console.log(advanceofactivitiesProject);
             fetch('public/database/AdvanceEvidenceInfo.php',{
                 method: "POST",
                  headers: {'Content-Type':'application/x-www-form-urlencoded'}, 
                    body: JSON.stringify(advanceofactivitiesProject)
             })
             .then(function(e){
                return e.json();
             })
             .then(function(eJson){
                eJson.forEach(function(e){
                    
                    let file = document.createElement('h3')
                    let status = document.createElement('h3')
                    let user = document.createElement('h3')
                    let team = document.createElement('h3')
                    let button = document.createElement('a');
                    button.setAttribute('href',`${e.url}`)
                    button.target ='_blank';
                    button.innerText = "Descargar";

                    button.classList.add('btn-info') 

                    team.innerText= e.name_team;
                    user.innerText=e.username;
                    status.innerText= e.status_activity
                    file.innerText=e.file
                    $('.column-info').html("");
                    $('.column-info').append(team);
                    $('.column-info').append(user);
                    $('.column-info').append(status);
                    $('.column-info').append(file);
                    $('#buttonTable').html("");
                    $('#buttonTable').append(button)

                })
                
               
             })          
         }
   
        }



        if(e.target.innerText == "Evaluar Proyecto"){

            $('.container').load("public/views/maestro/AdminProject/EvalueProject.php", "data", function (response, status, request) {
            
            });
// hasta aqui se carga la página

// se detecta el evento de selelct para mostrar las activiades
                let event = document.addEventListener('change',function(vnt){
               
                    if(vnt.target.classList.contains('select-eval-project')){
                        let select = vnt.target;
                        
                        let id = select.options[select.selectedIndex].value
                        fetch('public/database/EvalueProject.php',{
                            method:'POST',
                            headers: {'Content-Type':'application/x-www-form-urlencoded'}, 
                            body: JSON.stringify(id)
                        })
                        .then(function(res){
                            return res.json()
                        })
                         .then(function(resJson){
                             if(resJson == "No hay Actividades"){
                                $('#tbody').text('No Hay Actividades para Revisar');
                             }
                             else{
                               
                                $('#tbody').text('');
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
                             }
                             
         
     

                        })
                        .catch((err) => {
                            console.log(err)
                        })
                     
                    }
                })
        }




/* 
obtengo los valores de cada input
 para actualizar la calificacion de las activiades 
en un proyecto y en id del proyecto*/
if(e.target.classList.contains('main-content-container-list__item__results-project__button')){

    let inputs = document.querySelectorAll('input');
    let select = document.getElementById('evalueProject');
    let option = select.options[select.selectedIndex].value;

    let data=[];
 
    inputs.forEach(function (param) {
        let dataOb={};
        dataOb['id_activity'] = param.getAttribute('data-activity')
        dataOb['score'] = param.value==""?param.value=0:param.value;
        dataOb.id_project = option
        data.push(dataOb);
      })

      let request = {
          request: 'Update Project',
          data: data
      }
      
      console.log(request)
      /* 
guardo en DB los valores para Evaluar un proyecto 
ID actividad con su calificacion y 
ID Proyecto 
Se modifica la calificacion en la tabla actividades
 */

      fetch('public/database/ProjectActions.php',{
        method: 'POST',
        headers:{'Content-Type': 'application/x-www-form-urlencoded'},
        body:JSON.stringify(request)
      })
      .then((value) => {
          return value.json()
      })
      .then((result) => {
          console.log(result)
          $(".container").load("public/views/maestro/SuccessAlert/ProjectAlert/SuccessProject.php", "data", function (response, status, request) {
                      
                        
        });
      }).catch((err) => {
          console.log(err)
      })


}


/* 
RESULTADO DEL PROYECTO
*/

if(e.target.classList.contains('main-content-container-list__item__results-project')){
    $('.container').load("public/views/maestro/AdminProject/ResultProject.php", function (response, status, request) {
            
    });
   
}


$('#projectResult').change(function (e) { 
    
    let id_project = e.target.options[e.target.selectedIndex].value;
    console.log(id_project);

    let request = {
        infoProjectDone: "true",
        id_project:id_project
    }

    fetch('public/database/ProjectActions.php',{
        method: "POST",
        headers: {'Content-Type':'application/x-www-form-urlencoded'}, 
        body: JSON.stringify(request)
    })
    .then(function(res){
        return res.json()
    })
    .then(function(resJson){
      console.log(resJson);
      resJson.forEach(function(e){
                    
        let nameProject = document.createElement('h3')
        let endDate = document.createElement('h3')
        let score = document.createElement('h3')
        let teamProject = document.createElement('h3')
        let leaderProject = document.createElement('h3')

        let button = document.createElement('a');
        button.setAttribute('href',`${e.final_file_project}`)
        button.target ='_blank';
        button.innerText = "Descargar";

        button.classList.add('btn-info') 

        nameProject.innerText= e.name_project
        endDate.innerText=e.end_date_project
        score.innerText= e.score
        teamProject.innerText=e.name_team
        leaderProject.innerText=e.username
        $('.column-info').html("");
        $('.column-info').append(nameProject);
        $('.column-info').append(endDate);
        $('.column-info').append(teamProject);
        $('.column-info').append(leaderProject);
        $('.column-info').append(score);
        $('#buttonTable').html("");
        $('#buttonTable').append(button)

    })
    })



    
    e.preventDefault(); 
});
   

    if(e.target.innerText == "Crear Actividades"){
      $('.container').load("public/views/maestro/AdminProject/CreateActivity.php", function (response, status, request) {
          this; // dom element

        });
        e.preventDefault();
    }

  
    $('#project').change(function (e) { 


       let id = e.target.options[e.target.selectedIndex].value;
       console.log(id);

        data={
            getTeamsByProject: "true",
            id:id
        }

    fetch('public/')


        e.preventDefault();
        
    });



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

   






// });  //fin jq

document.addEventListener('submit',function(e){
    e.preventDefault();
    e.stopPropagation();
});


