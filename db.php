<?php

    try{
        $con=new PDO('mysql:host=localhost;dbname=country_state_city_dropdown_ajax','root','');
        
    }catch(PDOException $e){
        echo $e->getMessage();
    }

?>