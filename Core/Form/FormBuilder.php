<?php

declare(strict_types=1);

namespace Core\Form;

use Core\Util\SemanticConverter;

class FormBuilder
{
    /**
     * @var array
     */
    private $forms = [];

    /**
     * @var OptionsResolver
     */
    private $resolver;

    public function __construct(OptionsResolver $resolver)
    {
        $this->resolver = $resolver;
    }

    public function add(string $form_name)
    {
        $this->forms = $form_name;
    }

    public function getForms()
    {
        if(null === $this->resolver->getDataClass()){
            return $this->generateDynamicForm();
        }

        //@TODO implent get form
    }

    public function generateDynamicClass(array $forms = null)
    {
        return new class($forms ?? $this->forms) {
            /**
             * @var array
             */
            private $forms = [];
        

            public function __construct(array $forms)
            {
                $this->forms = array_fill_keys($forms, null);
            }

            public function __call($name, $arguments)
            {
                if (preg_match('/get.*/', $name)) {
                    $camel_case = preg_replace('/get./', $name[3], $name);

                    if (in_array($camel_case, array_keys($this->forms))) {
                        return $this->forms[$camel_case];
                    }

                    $snake_case = SemanticConverter::camelCaseToSnakeCase(preg_replace('/get/', '', $name));
                    
                    if (in_array($snake_case, array_keys($this->forms))) {
                        return $this->forms[$snake_case];
                    }

                    //error
                    echo 'Unexpected variable name';
                    
                } else if(preg_match('/set.*/', $name)) {

                    $camel_case = preg_replace('/get./', $name[3], $name);

                    if (in_array($camel_case, array_keys($this->forms)) && count($arguments) === 1 && is_string($arguments[0])) {
                        $this->forms[$camel_case] = $arguments[0];
                    }

                    $snake_case = SemanticConverter::camelCaseToSnakeCase(preg_replace('/set/', '', $name));
                    
                    if (in_array($snake_case, array_keys($this->forms)) && count($arguments) === 1 && is_string($arguments[0])) {
                        $this->forms[$snake_case] = $arguments[0];
                    }

                } else if(preg_match('/has.*/', $name)) {

                    $camel_case = preg_replace('/has./', $name[3], $name);

                    return in_array($camel_case, array_keys($this->forms));

                    $snake_case = SemanticConverter::camelCaseToSnakeCase(preg_replace('/has/', '', $name));
                    
                    return in_array($snake_case, array_keys($this->forms));

                } else {
                    //error
                    echo 'Unexpected function name';
                }

            }
        
        };
    }
}
