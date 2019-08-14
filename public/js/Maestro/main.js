

    
// validar si el equipo ya tiene un lider
function equipoChange(elem){

    let id = elem.options[elem.selectedIndex].value
    
    fetch('public/database/verifyIsCanSetLeader.php',{
        method: "POST",
        headers: {'Content-Type':'application/x-www-form-urlencoded'}, 
        body: JSON.stringify(id)
    })
    .then((response) => {
        return response.json()
    })
    .then((responseJson) => {
   
        responseJson.forEach(function(team){
            if(team.id_leader == null){
               
                $('#si').attr('disabled', false);
                $('#no').attr('disabled', false);
            }else{
                $('#si').attr('disabled', true);
                $('#no').attr('disabled', true);
                let h1 = document.createElement('h1');
                h1.innerText="Equipo con líder ya asignado";
                $(h1).insertBefore(".is-leader-container");
                setTimeout(() => {
                    h1.innerText= " ";
                }, 2500);
                
               

                
             
                
            }
            
        })
           
         
       
    })
    .catch((err) => {
        console.log(err)
    })

}

