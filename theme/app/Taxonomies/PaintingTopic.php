<?php

namespace Theme\Taxonomies;

use Gaumap\Abstracts\AbstractTaxonomy;

class PaintingTopic extends AbstractTaxonomy
{
    
    public function __construct()
    {
        $this->taxonomy  = 'topic';
        $this->singular  = $this->plural = __('Chủ đề', 'gaumap');
        $this->postTypes = ['painting'];
        $this->slug      = 'the-loai';
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