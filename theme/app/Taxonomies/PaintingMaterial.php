<?php

namespace Theme\Taxonomies;

use Gaumap\Abstracts\AbstractTaxonomy;

class PaintingMaterial extends AbstractTaxonomy
{
    
    public function __construct()
    {
        $this->taxonomy  = 'material';
        $this->singular  = $this->plural = __('Chất liệu', 'gaumap');
        $this->postTypes = ['painting'];
        $this->slug      = 'chat-lieu';
        parent::__construct();
    }
    
    /**
     * Document: https://docs.carbonfields.net/#/containers/term-meta?id=term-meta
     */
    public function metaFields()
    {

    }
    
}