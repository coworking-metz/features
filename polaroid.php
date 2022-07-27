<?php

/**
 * picture_user_presence();
 * Get the picture coworker
 */

function picture_user_presence() {

    $hour_now = date('H');
    $hour_now += 2;
    $start_hour = 12;
    $end_hour = 14;


    if ($hour_now >= $start_hour && $hour_now < $end_hour) {
        $url = 'https://tickets.coworking-metz.fr/api/current-users?key=' . API_KEY_TICKET . '&delay=120';
    } else {
        $url = 'https://tickets.coworking-metz.fr/api/current-users?key=' . API_KEY_TICKET . '&delay=15';
    }

    $data = file_get_contents($url);
    $json = json_decode($data, true);
    
    //DIV wrapper
    echo '<div class="grid-images">';
    
    //Images trombi
    foreach ($json as $key => $value){
      $i = 0;
      $url_image = get_user_meta($value['wpUserId'], $key = 'url_image_trombinoscope', $single = true );
      $image_array = wp_get_attachment_image_src($url_image);
      $image_url = $image_array[0];
      $user_balance = $value['balance'];
     
        if ($image_url == '') {
            echo '<img class="animated-image" style="transform: rotate(' . rand(-6,6) . 'deg); animation-delay: '. (rand(0,1000) + ($i*100)) . 'ms;" src="https://www.coworking-metz.fr/wp-content/uploads/2022/07/pouleinvisible-polaroid.jpg"><span class="language"></span>';
        } else {
            echo '<img class="animated-image" style="transform: rotate(' . rand(-6,6) . 'deg); animation-delay: '. (rand(0,1000) + ($i*100)) . 'ms;" src="' . $image_url . '"><span class="language"></span>';
        }
      $i++;
    }
    //DIV closing
    echo '</div>';
}

    