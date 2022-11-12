<?php 

class Correios{

    function calculateShipping($service, $weight){
        $valor = 0;

        if ($service == "PAC")
            $valor = 10;
        
        else if ($service == "SEDEX")
            $valor = 30;
        

        return $valor;

    }

}
