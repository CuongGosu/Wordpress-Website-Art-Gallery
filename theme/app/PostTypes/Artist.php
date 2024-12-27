<?php



namespace Theme\PostTypes;



use Carbon_Fields\Container;

use Carbon_Fields\Field;

use Sunra\PhpSimple\HtmlDomParser;



use Gaumap\Abstracts\AbstractPostType;



class Artist extends AbstractPostType

{

    public function __construct()

    {

        $this->showThumbnailOnList = true;

        $this->supports            = [

            'title',

            'editor',

            'author',

            'comments',

            'thumbnail',

            'excerpt',

        ];

        $this->menuIcon            = 'dashicons-id-alt';

        $this->capalityType        = 'artist';

        $this->post_type           = 'artist';

        $this->singularName        = $this->pluralName = __('Nghệ sĩ', 'nrglobal');

        $this->titlePlaceHolder    = __('Tên nghệ sĩ', 'nrglobal');

        $this->slug                = 'nghe-si';

        add_action('add_meta_boxes', [$this, 'add_artist_meta_box']);
        // add_action('add_meta_boxes', [$this, 'add_artist_meta_box_product']);

        parent::__construct();

    }

    

    /**

     * Document: https://docs.carbonfields.net/#/containers/post-meta

     */
  
    public function metaFields()

    {
        Container::make('post_meta', __('Cài đặt chung', 'nrglobal'))

                 ->set_context(get_set_context_value())// normal, advanced, side or get_set_context_value = carbon_fields_after_title

                 ->set_priority('high')// high, core, default or low

                 ->where('post_type', 'IN', [$this->post_type])

                 ->add_fields([

                    Field::make('text', 'birth', __('Năm sinh', 'nrglobal'))->set_width(50),
                    Field::make('text', 'address', __('Nơi sinh sống', 'nrglobal'))->set_width(50),
                    Field::make('textarea', 'information', __('Mô tả nghệ sĩ', 'nrglobal')),
                    Field::make('complex', 'main_train' , __('Thông tin đào tạo', 'nrglobal'))
                    ->set_layout('tabbed-horizontal')// grid, tabbed-vertical

                    ->add_fields([

                        Field::make('text', 'mock_time', __('Mốc thời gian (năm)', 'nrglobal'))->set_width(20),

                        Field::make('text', 'information', __('Nơi đào tạo', 'nrglobal'))->set_width(80),

                    ]),
                    Field::make('complex', 'main_exhibition' , __('Thông tin triển lãm', 'nrglobal'))

                    ->set_layout('tabbed-horizontal')// grid, tabbed-vertical

                    ->add_fields([

                        Field::make('text', 'mock_time', __('Mốc thời gian (năm)', 'nrglobal'))->set_width(20),

                        Field::make('textarea', 'information', __('Nơi triển lãm', 'nrglobal'))->set_width(80),

                    ]),
                   
                    
                 ]);

    }
    // album paintings
    public function add_artist_meta_box()
    {
        add_meta_box(
            'artist_paintings',                     // ID của meta box
            __('Ablum tác phẩm', 'nrglobal'),   // Tiêu đề meta box
            [$this, 'display_artist_paintings'],    // Hàm hiển thị nội dung
            'artist',                               // Post type "artist"
            'normal',                               // Vị trí
            'high'                                  // Độ ưu tiên
        );
    }

    /**
     * Hàm hiển thị danh sách các tác phẩm trong meta box
     */
    public function display_artist_paintings($post)
    {
        // Lấy ID của nghệ sĩ hiện tại
        $artist_id = $post->ID;

        // Truy vấn các tác phẩm liên kết với nghệ sĩ
        $args = [
            'post_type' => 'painting',
            'posts_per_page' => -1,
            'meta_query' => [
                [
                    'key' => 'artist',
                    'value' => $artist_id,
                    'compare' => '=',
                ],
            ],
        ];

        $paintings = new \WP_Query($args);
        if ($paintings->have_posts()) {
            echo '<ul style="list-style: none; padding: 0; display: flex; flex-wrap: wrap; gap: 20px;">';
            while ($paintings->have_posts()) {
                $paintings->the_post();
                
                // Lấy URL bài viết (tác phẩm)
                $link = get_edit_post_link();
                
                // Lấy ảnh đại diện của bài viết
                $thumbnail = get_the_post_thumbnail(null, 'thumbnail', ['alt' => get_the_title(), 'style' => 'width: 100px; height: auto;']);
                
                // Kiểm tra xem bài viết có ảnh đại diện không
                if ($thumbnail) {
                    echo '<li style="margin-bottom: 10px;">';
                    echo '<a href="' . esc_url($link) . '">' . $thumbnail . '</a>'; // Thêm ảnh đại diện vào thẻ <a>
                    echo '</li>';
                } else {
                    echo '<li>Không có ảnh đại diện.</li>';
                }
            }
            echo '</ul>';
        } else {
            echo 'Không có tác phẩm nào liên kết với nghệ sĩ này.';
        }
    
        // Reset lại post data
        wp_reset_postdata();
    }
    // albums products
  

}