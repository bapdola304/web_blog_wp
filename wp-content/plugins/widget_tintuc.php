<?php
/**
/*
Plugin Name: Nai Widget
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: This is not just a plugin, it symbolizes the hope and enthusiasm of an entire generation summed up in two words sung most famously by Louis Armstrong: Hello, Dolly. When activated you will randomly see a lyric from <cite>Hello, Dolly</cite> in the upper right of your admin screen on every page.
Author: Matt Mullenweg
Version: 1.7
Author URI: http://ma.tt/
*/


function create_topview_widget() {
    register_widget( 'TopView_Widget' );
}
add_action( 'widgets_init', 'create_topview_widget' );
 
class TopView_Widget extends WP_Widget {
 
    /*
     * Thiết lập tên widget và description của nó (Appearance -> Widgets)
     */
    function TopView_Widget() {
        $options = array(
           'classname' => 'topview',
            'description' => 'Xem bài viết xem nhiều nhất'
        );
        $this->WP_Widget('topview', 'Top View', $options);
    }
 
    /*
     * Tạo form điền tham số cho widget
     * ở đây ta có 3 form là title, postnum (số lượng bài) và postdate (tuổi của bài
     */
    function form($instance) {
        $default = array(
            'title' => 'Bài xem nhiều nhất',
            'postnum' => 5,
            'postdate' => 30
        );
        $instance = wp_parse_args( (array) $instance, $default );
        $title = esc_attr( $instance['title'] );
        $postnum = esc_attr( $instance['postnum'] );
        $postdate = esc_attr( $instance['postdate'] );
 
        echo  "<label>Tiêu đề:</label> <input class='widefat' type='text' name='".$this->get_field_name('title')."' value='".$title."' />";
        echo "<label>Số lượng bài viết:</label> <input class='widefat' type='number' name='".$this->get_field_name('postnum')."' value='".$postnum."' />";
        echo "<label>Độ tuổi của bài viết (ngày)</label> <input class='widefat' type='number' name='".$this->get_field_name('postdate')."' value='".$postdate."' />";
    }
 
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
            $i=1;
            while ( $postview_query->have_posts() ) :
                $postview_query->the_post(); ?>
 
                    <li>
                        <?php
                        	echo $i++; /* Bỏ comment nếu muốn hiện thumbnail
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
function custom_styles() {
 
        wp_register_style( 'topview-css', plugins_url( 'styles.css', __FILE__ ) , false, false, 'all' );
        wp_enqueue_style( 'topview-css' );
 
}
add_action( 'wp_enqueue_scripts', 'custom_styles' );