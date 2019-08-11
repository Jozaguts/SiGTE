<?php namespace Components;

class Alert 
{
   
    public function getSuccessAlert($message,array $link){
    echo    '
            <div class="alert-container">
                <div class="alert-icon-container"></div>
                <div class="alert-messager-container">
                    <p class="message">'.$message.'</p>
                </div>
                <div class="options-container">
                    <span class="option-ok" value="'.$link[0].'" ></span>
                    <span class="option-not" value="'.$link[1].'"></span>
                </div>
                <div class="question-contanier">¿Repetir Operación?</div>
            </div>
            ';
    }
    
}