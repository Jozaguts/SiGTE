$(document).ready(function () {


    const MAESTRO = 'maestro', LIDER='lider', MIEMBRO='miembro';


    window.addEventListener('click',function(e){
        if(e.target.classList.contains('btn-login')) {
            
            let tipoUser = e.target.getAttribute('data-tipouser');
            
            switch (tipoUser) {
                case '0':
                    goToLogin(MAESTRO);
                    break;
                case '1':
                    goToLogin(LIDER);
                    
                 break;
                case '2':
                    goToLogin(MIEMBRO);
                    break;
                default:
                    alert('Usuario no admitido');
                    break;
            }
        } 


        // icon regresar en el login
        if(e.target.classList.contains('icon-row-left')) {
            
            $('.container').load(`public/views/home.html`,{
            }, 
            function (response, status, request) {
                // console.log(response);
            });
        }
        
    })

    function goToLogin(tipouser){
      
            $('.container').addClass('animated', 'fadeIn');

            $('.container').load(`public/views/${tipouser}/login.php`,{
            }, 
            function (response, status, request) {
                // console.log(response);
            });
     
    }

   
// // PREVENTDEFAULT
// $('#loginForm').submit(function (e) { 
 
    
// });

window.addEventListener('submit',function(e){
    e.preventDefault();
})

}); 