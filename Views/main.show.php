<?php

require('models/Task.php');

if (!is_null($tasks)) {
    for ($i = 0; $i < count($tasks); $i++) {

        $task = $tasks[$i];
        $task = unserialize($task);

        $state = false;

        if ($task -> state == false) {
            $state = "UNREADY";
        } else {
            $state = "READY";
        }

        echo $task -> text;

        echo '<form action="TaskAction.php" method="post">
            <button type="submit" name="change_status" value="' .$i.'" >'.$state.'</button>                                  
            <button type="submit" name="delete" value="'.$i.'">DELETE</button>            
            </form> ';


    }
}


