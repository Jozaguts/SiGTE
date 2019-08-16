


document.addEventListener('click',function (e) {

    if(e.target.classList.contains('Asignar-Actividades')){
        
        $('.container').load("public/views/Lider/AdminTeam/AssingActivity.php", function (response, status, request) {
            this; // dom element
            
        });



        e.preventDefault();
    }


    let activitiesProject = {};

if(e.target.classList.contains('form-create-student-container-form-container__button_create-activity-project')){
   
  

        // obtengo el nombre del proyecto
        $('#name_project').val().length > 5 ? 
        activitiesProject.name_activity =  $('#name_project').val(): 
         $('#name_project').prev().text('Ingrese un Nombre de Proyecto');
        //  limpio la etiqueta de alerta
        $('#name_project').val().length > 5 ? 
        $('#name_project').prev().text(''):null;



        
        


        

        if($('#file').val() == 'false'){
            $('#file').prev().text('Seleccione un tipo de Archivo')
        }else{
            $('#file').prev().text(''); 
            activitiesProject.file = $("#file option:selected").text();
        }

        
        // if( $('#endDate').val() == ''){
        //     $('#endDate').prev().text('Seleccione una Fecha')
        // }else{
        //     $('#endDate').prev().text(''); 
        //     activitiesProject.endDate =  $('#endDate').val()
        // }

            activitiesProject.comments =  $('#comments').val()
            activitiesProject.createActivity = "true";
            let selectProject = document.getElementById('project');
   
   
            selectProject.options[selectProject.selectedIndex].value == "false"? alert('Elija un proyecto'): activitiesProject.idproject =selectProject.options[selectProject.selectedIndex].value;

        if(Object.keys(activitiesProject).length == 5){
            console.log('entor');
            fetch('public/DataBase/ProjectActions.php',{
                method: 'POST',
                headers: {'Content-Type':'application/x-www-form-urlencoded'}, 
                body: JSON.stringify(activitiesProject)
               })
               .then(function(response){
                return response.json();
               })
               .then(function(jsonResponse){
                $(".container").load("public/views/Maestro/SuccessAlert/ProjectAlert/CreateActivity.php", "data", function (response, status, request) {
                      
                        
                });
            })
            .catch((err) => {
                console.log(err);    
            })
        
        }
}

// boton para aceptar para asignar tarea a miembro

if(e.target.classList.contains('form-create-student-container-form-container__assign-Activity-To-Parner')){
    let  getParnerTeamSelect,  getParnerTeamOption,
        getActivityTeamSelect, getActivityTeamoption,
        data = {};


        getParnerTeamSelect = document.getElementById('getParnerTeam')
        getParnerTeamOption = getParnerTeamSelect.options[getParnerTeamSelect.selectedIndex].value

        
        getActivityTeamSelect = document.getElementById('getActivityTeam')
        getActivityTeamoption = getActivityTeamSelect.options[getActivityTeamSelect.selectedIndex].value        
        
        // validacion  no falsos

        if(getParnerTeamOption == "false" || getActivityTeamoption == "false"){
            $('.projects-container').text('No puede Ingresar Campos Vacios');
        }else{
            $('.projects-container').text('');


            // prepararo datos
            data.assignActivity = "true";

            data.id_activity = getActivityTeamoption;
            data.id_student = getParnerTeamOption;

            console.log(data)

            // envio datos

            fetch('public/database/ActivityActions.php',{
                method: "POST",
                headers: {'Content-Type':'application/x-www-form-urlencoded'}, 
                body: JSON.stringify(data)
            })
            .then((value) => {
                return value.json()
            })
            .then((result) => {
                
                $(".container").load("public/views/Lider/Alerts/SuccessAlert.php", "data", function (response, status, request) {

                });
            }).catch((err) => {
                console.log(err)
            })


        }

}




$('.main-content-container__list').on('click','.Revisar-Actividades',function(e){

    e.preventDefault();
    e.stopPropagation();


    $('.container').load("public/views/lider/AdminTeam/ReviewActivity.php", function (response, status, request) {
        this; // dom element
        
    });
})
$('.show-info-activity').change(function (e) { 
    e.preventDefault();
    e.stopPropagation();


    let id = e.target.options[e.target.selectedIndex].value;

    data = {
        getInfoActivity: "true",
        id:id
    }

    fetch('public/database/activityActions.php',{
        method: "POST",
        headers: {'Content-Type':'application/x-www-form-urlencoded'}, 
        body: JSON.stringify(data)
    })
    .then((value) => {
        return value.json();
    })
    .then((result) => {
      let container = document.querySelector('.data-activity');

      let ul = document.createElement('ul');
      result.forEach(element => {
            let li = document.createElement('li');
            let p = document.createElement('p');
            let a = document.createElement('a');
            let user = document.createElement('p');
            let check = document.createElement('input');
            let span = document.createElement('span')
            span.innerText = "Validar";
            
            check.setAttribute('type', 'radio');
            check.setAttribute('name', 'validar');
            check.setAttribute('value','T');
            
            span.append(check)
            let check2 = document.createElement('input');
            check2.setAttribute('type', 'radio');
            check2.setAttribute('name', 'validar');
            check.setAttribute('value','R');


            let span2 = document.createElement('span');
            span2.innerText = "Rechazar";
            span2.appendChild(check2)

            
            a.setAttribute('href',element.evidence_activity)
            a.innerText = "Descargar Actividad";
            p.innerText =  element.description_activity
            user.innerText = element.username;
            li.innerText = element.name_activity;
            
            ul.appendChild(li);
            ul.appendChild(p)
            ul.appendChild(a);
            ul.appendChild(user)
            ul.appendChild(span)
            ul.appendChild(span2)
        
      });
        container.appendChild(ul);
        console.log(container);

    }).catch((err) => {
        console.log(err);
    })

    
});

$('.form-assing-student-container__send_valitation ').click(function (e) { 
    e.preventDefault();
    
    let select = document.querySelector('.show-info-activity')
    let id = select.options[select.selectedIndex].value
    value = document.querySelector('input[name="validar"]:checked').value;


    let data = {
        validateActivity: "true",
        id: id,
        value: value
    }

    fetch('public/database/activityActions.php',{
        method: "POST",
        headers: {'Content-Type':'application/x-www-form-urlencoded'}, 
        body: JSON.stringify(data)
    })
    .then((value) => {
       return value.json();
    })
    .then((result) => {
        $(".container").load("public/views/Lider/Alerts/SuccessAlert.php", "data", function (response, status, request) {

        });
    }).catch((err) => {
       console.log(err); 
    })

   
});






  })/* Fin del AddEvent Listener */

