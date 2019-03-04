<?php
define('UTC',' UTC');

function l_to_d($user_given) {
    
    /* ======================== REFERENCE CODE ============================== */
    
    //date_default_timezone_get();
    
    // $given = new DateTime($given);
    // echo $given->format("Y-m-d H:i:s") . "\n"; // 2014-12-12 14:18:00 Europe/Berlin
    
    // $given->setTimezone(new DateTimeZone("UTC"));
    // echo $given->format("Y-m-d H:i:s") . "\n"; // 2014-12-12 07:18:00 UTC
    
    /* ======================== REFERENCE CODE ============================== */
    
    
    $given = new DateTime($user_given);
    $given->setTimezone(new DateTimeZone("UTC"));
    return $given->format("Y-m-d H:i:s");
}

function d_to_l($db_given) {
    /* ======================== REFERENCE CODE ============================== */
    
    //     $dt = new DateTime($utc);
    //     $tz = new DateTimeZone('Asia/Kolkata'); // or whatever zone you're after
    
    //     $dt->setTimezone($tz);
    //     echo $dt->format('Y-m-d H:i:s');
    
    /* ======================== REFERENCE CODE ============================== */
    
    if($db_given != '0000-00-00 00:00:00') { 
        $dt = new DateTime($db_given);
        $default_time_zone = date_default_timezone_get();
        
        if(isset($default_time_zone) && !empty($default_time_zone)) {
            $tz = new DateTimeZone($default_time_zone);
        } else {
            $tz = new DateTimeZone('Asia/Kolkata');
        }
        $dt->setTimezone($tz);
        return $dt->format('Y-m-d H:i:s');
    } else {
        return '';
    }
}

function lu_to_d($user_given) {
    
    /* ======================== REFERENCE CODE ============================== */
    
    //date_default_timezone_get();
    
    // $given = new DateTime($given);
    // echo $given->format("Y-m-d H:i:s") . "\n"; // 2014-12-12 14:18:00 Europe/Berlin
    
    // $given->setTimezone(new DateTimeZone("UTC"));
    // echo $given->format("Y-m-d H:i:s") . "\n"; // 2014-12-12 07:18:00 UTC
    
    /* ======================== REFERENCE CODE ============================== */
    
    
    $given = new DateTime($user_given);
    $given->setTimezone(new DateTimeZone("UTC"));
    return $given->format("Y-m-d H:i:s");
}

function d_to_lu($db_given) {
    /* ======================== REFERENCE CODE ============================== */
    
    //     $dt = new DateTime($utc);
    //     $tz = new DateTimeZone('Asia/Kolkata'); // or whatever zone you're after
    
    //     $dt->setTimezone($tz);
    //     echo $dt->format('Y-m-d H:i:s');
    
    /* ======================== REFERENCE CODE ============================== */
    
    if($db_given != '0000-00-00 00:00:00') { 
        $dt = new DateTime($db_given.UTC);
        $default_time_zone = date_default_timezone_get();
        
        if(isset($default_time_zone) && !empty($default_time_zone)) {
            $tz = new DateTimeZone($default_time_zone);
        } else {
            $tz = new DateTimeZone('Asia/Kolkata');
        }
        
        $dt->setTimezone($tz);
        return $dt->format('d-m-Y');
    } else {
        return '';
    }
}

function duration($start_utc, $end_utc) {
    $start_date = new DateTime($start_utc);
    $end_date  = new DateTime($end_utc);
    $date_diff = $start_date->diff($end_date);
    
    if($date_diff->d == 1) {
        return $date_diff->d . ' day';
    } else {
        return $date_diff->d . ' days';
    }
}

function c_for_d() {
    return lu_to_d(date('Y-m-d H:i:s'));
}

function lu_to_d_for_date($user_date) {
    return date('Y-m-d', strtotime(lu_to_d($user_date)));
}