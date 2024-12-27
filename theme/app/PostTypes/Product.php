<?php



namespace Theme\PostTypes;



use Carbon_Fields\Container;

use Carbon_Fields\Field;

use Sunra\PhpSimple\HtmlDomParser;



use Gaumap\Abstracts\AbstractPostType;



class Product extends AbstractPostType

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

        $this->menuIcon            = 'dashicons-products';

        $this->capalityType        = 'product';

        $this->post_type           = 'product';

        $this->singularName        = $this->pluralName = __('Đồ cổ', 'nrglobal');

        $this->titlePlaceHolder    = __('Tên sản phẩm', 'nrglobal');

        $this->slug                = 'do-co';

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
                    Field::make('text', 'price_regular', __('Giá', 'nrglobal'))->set_width(100),

                    Field::make('text', 'width', __('Chiều rộng', 'nrglobal'))->set_width(33),
                    Field::make('text', 'height', __('Chiều cao', 'nrglobal'))->set_width(33),
                    Field::make('text', 'size', __('Kích thước', 'nrglobal'))->set_width(33),
                    Field::make('textarea', 'name', __('Thông tin phụ', 'nrglobal'))->set_width(100),
                    
                ]);

    }
}
