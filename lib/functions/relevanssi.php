<?php

//add_filter('relevanssi_hits_filter', 'separate_result_types');
function separate_result_types($hits) {
    $types = array();
    $types['tribe_events'] = array();
    $types['post'] = array();
    $types['page'] = array();
 
    // Split the post types in array $types
    if (!empty($hits)) {
        foreach ($hits[0] as $hit) {
            if (!is_array($types[$hit->post_type])) $types[$hit->post_type] = array();                        
            array_push($types[$hit->post_type], $hit);
        }
    }
 
    // Merge back to $hits in the desired order
    $hits[0] = array_merge($types['tribe_events'], $types['post'], $types['page']);
    return $hits;
}


//add_filter('relevanssi_hits_filter', 'events_first');
function events_first($hits) {
    $types = array();
    $types['tribe_events'] = array();
    $types['post'] = array();
    $types['page'] = array();
    
    
 
    // Split the post types in array $types
    if (!empty($hits)) {
        foreach ($hits[0] as $hit) {
            array_push($types[$hit->post_type], $hit);
        }
    }
     
    // Merge back to $hits in the desired order
    $hits[0] = array_merge($types['tribe_events'], $types['post'], $types['page']);
    return $hits;
}
