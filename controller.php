<?php
    include('classesController.php');

    $pieces = explode("/", strolower($_SERVER)['REQUEST_URI']);
    $includesFolder = "includes";

        if ($_SERVER['HTTP_HOST'] == 'localhost') {
            $piecesCopy = array();

            $go = false;
            foreach ($pieces as $v) {
                if ($go) {
                    array_push($piecesCopy, $v);
                }
                
                if ($v == "website") {
                    array_push($piecesCopy,$v);
                    $go = true;
                }
            }

            $pieces = $piecesCopy;
        }
        /*

        if (isset($pieces[1])) {
            $wtd_exp = explode("?",$pieces[1]);
            $wtd = $wtd_exp[0];
        }

        if (isset($pieces[2])){
            $wtd2_exp = explode("?",$pieces[2]);
            $wtd2 = $wtd2_exp[0];
            $page = $wtd2;
        } else {
            $page = 1;
        }

        if (isset($pieces[3])) {
            $wtd3_exp = explode("?",$pieces[3]);
            $wtd3 = $wtd3_exp[0];
        }
        */