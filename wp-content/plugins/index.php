<?php 	



 
    /*
     * Cập nhật dữ liệu nhập vào form tùy chọn trong database
     */
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['postnum'] = strip_tags($new_instance['postnum']);
        $instance['postdate'] = strip_tags($new_instance['postdate']);
        return $instance;
    }
 
    function widget($args, $instance) {
        global $postdate; // Thiết lập biến $postdate là biến toàn cục để dùng ở hàm filter_where
        extract( $args );
        $title = apply_filters( 'widget_title', $instance['title'] );
        $postnum = $instance['postnum'];
        $postdate = $instance['postdate'];
 
        echo $before_widget;
        echo $before_title.$title.$after_title;
 
        $query_args = array(
            'posts_per_page' => $postnum,
            'meta_key' => 'postview_number',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
            'ignore_sticky_posts' => -1
        );
 
        /*
         * Cách lấy bài viết theo độ tuổi (-30 days = lấy bài được 30 ngày tuổi)
         * @tham khảo tại http://bit.ly/1y7WXFp
         */
        function filter_where( $where = '' ) {
            global $postdate;
            $where .= " AND post_date > '" . date('Y-m-d', strtotime('-'.$postdate.' days')) . "'";
            return $where;
        }
        add_filter( 'posts_where', 'filter_where' );
 
        $postview_query = new WP_Query( $query_args );
 
        remove_filter( 'posts_where', 'filter_where' ); // Xóa filter để tránh ảnh hưởng đến query khác
 
        if ($postview_query->have_posts() ) :
            echo "<ul>";
            while ( $postview_query->have_posts() ) :
                $postview_query->the_post(); ?>
 
                    <li>
                        <?php /* Bỏ comment nếu muốn hiện thumbnail
                            if ( has_post_thumbnail() )
                                the_post_thumbnail( 'thumbnail' );
                            else
                                echo "</br><img src='https://dummyimage.com/50/000/fff&text=thach'>";
                            */
                        ?>
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </li>
 
            <?php endwhile;
            echo "</ul>";
            endif;
            echo $after_widget;
    }
}
 ?>
 <!-- widget -->

 <?php 
 	function custom_styles() {
 
        wp_register_style( 'topview-css', plugins_url( 'styles.css', __FILE__ ) , false, false, 'all' );
        wp_enqueue_style( 'topview-css' );
 
}
add_action( 'wp_enqueue_scripts', 'custom_styles' );
  ?>
