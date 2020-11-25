<?php
    //here use sleep() function because we want to show loading_grif when select any data. Here 1 means 1 second
    sleep(1);

    include('db.php');

    //hold id & type which comes through url
    $id=$_POST['id'];
    $type=$_POST['type'];

    if($type=='state'){

        //write sql query for fetch state by using country id
        $sql="SELECT id,name FROM state WHERE country_id='$id'";
        $stmt=$con->prepare($sql);
        $stmt->execute();
        $arrState=$stmt->fetchAll(PDO::FETCH_ASSOC);

        $html='';
        foreach($arrState as $state){
            $html.='<option value="'.$state['id'].'">'.$state['name'].'</option>';
        }
    }

    if($type=='city'){
        
        //write sql query for fetch state by using country id
        $sql="SELECT id,name FROM city WHERE state_id='$id'";
        $stmt=$con->prepare($sql);
        $stmt->execute();
        $arrCity=$stmt->fetchAll(PDO::FETCH_ASSOC);

        $html='';
        foreach($arrCity as $city){
            $html.='<option value="'.$city['id'].'">'.$city['name'].'</option>';
        }
    }

    


    echo $html;
    

?>