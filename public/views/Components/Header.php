<?php namespace Components;

class Header 
{
    // NOTA PARA MEJORA que la funcion requiera un parametro para ingresar el
    // encabezado el el header
    public function getHeader()
    {
    echo   '<header class="header-mobile animated fadeIn">
                <span class="icon-bars"> </span>
                    <h1 class="header-mobile__title">Noticias</h1>
                <span class="icon-more">
                    <i></i>
                    <i></i>
                    <i></i>
                </span>
            </header>';
    }

    public function getLoginHeader()
    {
    echo   '<header class="header-mobile animated fadeIn">
                <span class="icon-row-left"> </span>
                    <h1 class="header-mobile__title">Iniciar Sesión 
                        <small class="small-title">Sistema de gestión de trabajo en equipo</small>
                    </h1>
                <span class="icon-more">

                </span>
            </header>';
    }
    
}
?>


