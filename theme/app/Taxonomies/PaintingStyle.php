<?php

namespace Theme\Taxonomies;

use Gaumap\Abstracts\AbstractTaxonomy;

class PaintingStyle extends AbstractTaxonomy
{
    
    public function __construct()
    {
        $this->taxonomy  = 'style';
        $this->singular  = $this->plural = __('Phong cách', 'gaumap');
        $this->postTypes = ['painting'];
        $this->slug      = 'phong-cach';
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