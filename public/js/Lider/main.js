


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


        }

}

  



  })/* Fin del AddEvent Listener */