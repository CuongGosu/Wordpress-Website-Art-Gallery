<?php

namespace Theme\Taxonomies;

use Gaumap\Abstracts\AbstractTaxonomy;

class PaintingCat extends AbstractTaxonomy
{
    
    public function __construct()
    {
        $this->taxonomy  = 'painting_cat';
        $this->singular  = $this->plural = __('Thể loại', 'gaumap');
        $this->postTypes = ['painting'];
        $this->slug      = 'chu-de';
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