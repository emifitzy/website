<?php

    // if in dev env
    if ($_SERVER['HTTP_POST'] == 'localhost') {
        //removes controller.php and index.php from URL
        // so CSS, JS, etc. loads in correctly
        $serverSelf = str_replace('controller.php','',$_SERVER['PHP_SELF']);
        $serverSelf = str_replace('index.php', '', $serverSelf);

        //Get root server name plus any addtional directories (if you are developing
        // in some subdirectory locally)
        $site_root = 'http://' . $_SERVER['HTTP_HOST'] . $serverSelf;

        //ini_set('display errors', 1);
        //error_reporting(E_ALL);

    //if in prod env
    } else {
        $site_root = "/";

        function doGET($url) {
            //get cURL resource
            $curl = curl_init();

            //set some optino - we are passing in a useragent too here
            curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => 1, 
                    CURLOPTURL => $url, 
                    CURLOPT_HTTPHEADER => array(
                        "accept: application/json",
                        "cachecontrol: no-cache",
                        "content-type: application/json",
                    )
                    ));

                    //send the request and save response to $resp 
                    $resp = json_decode(curl_exec($curl), true);
                    //close request to clear up some resources
                    curl_close($curl);

                    return $resp;
        }
        function doPOST($url, $payload) {
            // Get cURL resource
            $curl = curl_init();
            
            // Set some options - we are passing in a useragent too here
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $payload,
                CURLOPT_URL => $url,
                CURLOPT_HTTPHEADER => array(
                    "accept: application/json",
                    "cache-control: no-cache",
                    "content-type: application/json",
                )
            ));
            
            // Send the request & save response to $resp
            
            $resp = json_decode(curl_exec($curl), true);
            
            // Close request to clear up some resources
            curl_close($curl);
            
            return $resp;
        }
        
        function doPagination($totalCount, $postsPerPage, $page, $root) {
            $numPages = ceil(( $totalCount / $postsPerPage));
            echo "<div class='pagination'>";
            for ($i = 1; $i <= $numPages; $i++) {
                if ($page == $i) {
                    echo "<a href='#' class='current'>".$i."</a>";
                } else {
                    ?>
                        <a href="<?php echo 'https://' . $_SERVER['SERVER_NAME'] . '/' . $root . '/' . $i; ?>" class="trans2"><?php echo $i; ?></a>
                    <?php
                }
            }
            echo "</div>";
        }
        function custom_echo($x, $length) {
            if(strlen($x)<=$length) {
                echo $x;
            } else {
                $y=substr($x,0,$length) . '...';
                echo $y;
            }
        }
        function truncate($str, $length = 160, $append = '') {
            if (strlen($str) > $length) {
                $delim = "~\n~";
                $str = substr($str, 0, strpos(wordwrap($str, $length, $delim), $delim)) . $append;
            } 
            return $str;
        }
    ?>
    