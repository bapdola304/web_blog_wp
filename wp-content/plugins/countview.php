<?php
/*
 Plugin Name: PostView
 Plugin Author: ThachPham
 Description: Plugin đếm lượt xem bài viết và hiển thị top bài xem nhiều
 Version: 1.0
 Author URI: https://thachpham.com
 */
 function postview_set($postID) {
    $count_key = 'postview_number';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
function postview_get($postID){
    $count_key = 'postview_number';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 lượt xem";
    }
    return $count.' lượt xem';
}