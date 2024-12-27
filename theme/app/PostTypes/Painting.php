<?php

namespace Theme\PostTypes;

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Sunra\PhpSimple\HtmlDomParser;
use Gaumap\Abstracts\AbstractPostType;

class Painting extends AbstractPostType
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
        $this->menuIcon            = 'dashicons-admin-customizer';
        $this->capalityType        = 'painting';
        $this->post_type           = 'painting';
        $this->singularName        = $this->pluralName = __('Tác phẩm', 'nrglobal');
        $this->titlePlaceHolder    = __('Tên tác phẩm', 'nrglobal');
        $this->slug                = 'tac-pham';

        parent::__construct();
    }

    /**
     * Document: https://docs.carbonfields.net/#/containers/post-meta
     */
    public function metaFields()
    {
        // Tạo các trường meta cho custom post type "painting"
        Container::make('post_meta', __('Cài đặt chung', 'nrglobal'))
            ->set_context(get_set_context_value()) // normal, advanced, side hoặc carbon_fields_after_title
            ->set_priority('high') // high, core, default hoặc low
            ->where('post_type', 'IN', [$this->post_type])
            ->add_fields([
                Field::make('text', 'width', __('Chiều rộng', 'nrglobal'))->set_width(33),
                Field::make('text', 'height', __('Chiều cao', 'nrglobal'))->set_width(33),
                Field::make('text', 'size', __('Độ dày tác phẩm', 'nrglobal'))->set_width(33),
                Field::make('textarea', 'sub_information', __('Thông tin phụ', 'nrglobal'))->set_width(100),
                
            ]);
    }


}
