document.addEventListener('click',function (e) {
    if(e.target.innerText=="Actividades Asignadas"){

        $('.container').load("public/views/Miembro/activities/AssignedActivities.php", "data", function (response, status, request) {
         
           
        });


    
    }

// enviar evidencias 
    if(e.target.innerText=="Enviar Evidencia"){

        $('.container').load("public/views/Miembro/activities/SendEvidence.php", function (response, status, request) {
         
           
        });
        e.preventDefault();
    }
    $(document).on('click','.btn-send',function(){

        let form = document.getElementById('uploadFile')
        let formData = new FormData(form);
        const id_activity = formData.get('id_activity')  
        const file = formData.get('evidence');

  
        $.ajax({
            type: "POST",
            url: "public/DataBase/SaveEdivence.php",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                // console.log(data)
                var ruta=data.trim();
             
                // alert(data.trim());
                let dataUpload = {
                        operacion:"uploadEvidence",
                        id_activity: id_activity,
                        route_activity_file: ruta
                }
                fetch('public/DataBase/SaveEdivence.php',{
                    method: "POST",
                    headers: {'Content-Type':'application/x-www-form-urlencoded'}, 
                    body: JSON.stringify(dataUpload)
                })
                .then((value) => {
                    return value.json()
                })
                .then((result) => {
                       
            $(".container").load("public/views/miembro/Alerts/SuccessAlert.php", function (response, status, request) {
              
                
            });
          
                }).catch((err) => {
                    console.log(err);
                })
             
        
                
           
                
            }
        });

        e.preventDefault();
    });

     

      



})