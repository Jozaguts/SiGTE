<?php namespace Components;
/* 
Este Componente tendra pinta en patalla del login lo siguiente
1.- Icon con respectivo color (Maestro, Lider o Miembro de equipo)
2.- Subtituloo o Etiqueta Small con el tipo de usuario  (Maestro, Lider o Miembro de equipo)
3.- Inputs y boton para realizar el login 

Variables:
#Tipo o Nivel de Usuario (Maestro, Lider o Miembro de equipo)
#Color Representativo (en revision si realizarlo desde PHP o delegarlo a JS)
*/

class LogoInputsLoginComponent{

    
    protected $tipoUser = array(0 => 'Maestro' ,1=>'Lider De Equipo', 2 => 'Miembro De Equipo' );
    const APP_NAME = 'SiGTE';
    public function getComponents($nivel ){
       
        
        echo    '<main class="login-main">
                    <div class="login-logo-container">
                        <div class="login-logo-container__logo">
                                
                        </div>
                        <div class="login-logo-container__title">
                            <h1 class="logo-footer-title">'.self::APP_NAME.'</h1>
                            <small class="logo-footer-sub-title">'.$this->tipoUser[$nivel].'</small>
                        </div>  
                    </div>
                    <div class="login-form-container">
                        <form id="loginForm">
                        <input type="text" name="user" id="user" placeholder="Nombre">
                        <input type="password" name="password" id="password" placeholder="Contraseña">
                        <button type="submit">Aceptar</button>
                        
                        </form>
                    </div>
                </main>'; 

    }
}


