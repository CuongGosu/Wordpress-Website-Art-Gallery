<?php

namespace Theme\Taxonomies;

use Gaumap\Abstracts\AbstractTaxonomy;

class ProductCat extends AbstractTaxonomy
{
    
    public function __construct()
    {
        $this->taxonomy  = 'product_cat';
        $this->singular  = $this->plural = __('Danh mục sản phẩm', 'gaumap');
        $this->postTypes = ['product'];
        $this->slug      = 'loai-do-co';
        parent::__construct();
    }
    
    /**
     * Document: https://docs.carbonfields.net/#/containers/term-meta?id=term-meta
     */
    public function metaFields()
    {
        // Container::make('term_meta', __('Category Properties'))
        //          ->where('term_taxonomy', '=', $this->taxonomy)
        //          ->add_fields([
        //              Field::make('color', 'crb_title_color', __('Title Color')),
        //              Field::make('image', 'crb_thumb', __('Thumbnail')),
        //          ]);
    }
    
}