<?php namespace Components;

class Header 
{
    // NOTA PARA MEJORA que la funcion requiera un parametro para ingresar el
    // encabezado el el header

    protected $class = array(0 => "icon-bars", 1=>"icon-row-left");

    public function getHeader($title,$subTitle=null,$ClassCss=null) {
        
        $iconBars = '<i></i>
                    <i></i>
                    <i></i>';
        $title !='Noticias'? $ClassCss = $this->class[1]: $ClassCss = $this->class[0];
        $subTitle ==null? $subTitle: $subTitle ='Sistema de gestión de trabajo en equipo';
      

    echo   '<header class="header-mobile animated fadeIn">
                <span class="'.$ClassCss.'"> </span>
                    <h1 class="header-mobile__title">'.$title.'</h1>
                    <small class="small-title">'.$subTitle.'</small>
                <span class="icon-more">
                    '.$iconBars.'
                </span>
            </header>';
    }

   
    
}
?>


