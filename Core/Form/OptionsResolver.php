<?php

declare(strict_types=1);

namespace Core\Form;

class OptionsResolver
{
    /**
     * @var array
     */
    private $defaults = [];

    /**
     * @param array $defaults
     * @return void
     */
    public function setDefaults(array $defaults)
    {
        $this->defaults = $defaults;
    }

    /**
     * @return string|null
     */
    public function getDataClass(): ?string
    {    
        if(!isset($this->defaults['data_class'])){
            return null;
        }

        return $this->defaults['data_class'];
    }
}