<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'O campo :attribute precisa ser aceito.',
    'active_url'           => 'O campo :attribute não é uma URL válida.',
    'after'                => 'O campo :attribute precisa ser uma data após :date.',
    'after_or_equal'       => 'O campo :attribute precisa ser uma data após ou igual a :date.',
    'alpha'                => 'O campo :attribute deve conter apenas letras.',
    'alpha_dash'           => 'O campo :attribute deve conter somente letras, números e traços.',
    'alpha_num'            => 'O campo :attribute deve conter apenas letras e números.',
    'array'                => 'O campo :attribute precisa ser um vetor (array).',
    'before'               => 'O campo :attribute deve ser uma data anterior à :date.',
    'before_or_equal'      => 'O campo :attribute deve ser uma data anterior ou igual a :date.',
    'between'              => [
        'numeric' => 'O campo :attribute precisa estar entre :min e :max.',
        'file'    => 'O campo :attribute precisa ter um tamanho entre :min e :max kilobytes.',
        'string'  => 'O campo :attribute precisa ter entre :min e :max caracteres.',
        'array'   => 'O campo :attribute precisa conter entre :min e :max itens.',
    ],
    'boolean'              => 'O campo :attribute precisa ser verdadeiro ou falso.',
    'confirmed'            => 'O campo :attribute de confirmação não correspondem.',
    'date'                 => 'O campo :attribute não é uma data válida.',
    'date_format'          => 'O campo :attribute não corresponde ao formato :format.',
    'different'            => 'O campo :attribute e :other precisam ser diferentes.',
    'digits'               => 'O campo :attribute precisa ter :digits dígitos.',
    'digits_between'       => 'O campo :attribute precisa estar entre :min e :max dígitos.',
    'dimensions'           => 'O campo :attribute pussui uma tamanho de imagem inválido.',
    'distinct'             => 'O campo :attribute possui um valor duplicado.',
    'email'                => 'O campo :attribute precisa ser um endereço de e-mail válido.',
    'exists'               => 'O campo :attribute selecionado é inválido.',
    'file'                 => 'O campo :attribute precisa ser um arquivo.',
    'filled'               => 'O campo :attribute precisa ter algum valor.',
    'image'                => 'O campo :attribute precisa ser uma imagem.',
    'in'                   => 'O campo selecionado :attribute é inválido.',
    'in_array'             => 'O campo :attribute não existe em :other.',
    'integer'              => 'O campo :attribute precsia ser um valor inteiro.',
    'ip'                   => 'O campo :attribute precisa ser um IP address válido.',
    'ipv4'                 => 'O campo :attribute precisa ser um IPv4 address válido.',
    'ipv6'                 => 'O campo :attribute precisa ser um IPv6 address válido.',
    'json'                 => 'O campo :attribute precisa ser um JSON string válido.',
    'max'                  => [
        'numeric' => 'O campo :attribute não pode ser maior que :max.',
        'file'    => 'O campo :attribute não pode ser maior que :max kilobytes.',
        'string'  => 'O campo :attribute não pode ter mais que :max caracteres.',
        'array'   => 'O campo :attribute não pode conter mais do que :max itens.',
    ],
    'mimes'                => 'O :attribute precisa ser um arquivo com o seguinte formato: :values.',
    'mimetypes'            => 'O :attribute precisa ser um arquivo to tipo: :values.',
    'min'                  => [
        'numeric' => 'O campo :attribute precisa ser no mínimo :min.',
        'file'    => 'O campo :attribute precisa ter no mínimo :min kilobytes.',
        'string'  => 'O campo :attribute precisa ter no mínimo :min caracteres.',
        'array'   => 'O campo :attribute precisa conter pelo menos :min itens.',
    ],
    'not_in'               => 'O campo selecionado :attribute é inválido.',
    'numeric'              => 'O campo :attribute precisa ser um número.',
    'present'              => 'O campo :attribute deve estar presente.',
    'regex'                => 'O campo :attribute é um formato inválido.',
    'required'             => 'O campo :attribute é requerido.',
    'required_if'          => 'O campo :attribute é requerido quando :other for :value.',
    'required_unless'      => 'O campo :attribute field is required unless :other is in :values.',
    'required_with'        => 'O campo :attribute field is required when :values is present.',
    'required_with_all'    => 'O campo :attribute field is required when :values is present.',
    'required_without'     => 'O campo :attribute é requerido quando nenhum dos valores :values esteja presente.',
    'required_without_all' => 'O campo :attribute é requerido quando nenhum dos valores :values estejam presentes.',
    'same'                 => 'O campo :attribute e :other devem corresponder um com outro.',
    'size'                 => [
        'numeric' => 'O campo :attribute precisa ter :size.',
        'file'    => 'O campo :attribute precisa ter :size kilobytes.',
        'string'  => 'O campo :attribute deve ter :size caracteres.',
        'array'   => 'O campo :attribute precisa ter :size itens.',
    ],
    'string'               => 'O campo :attribute precisa ser uma string.',
    'timezone'             => 'O campo :attribute precisa estar em um fuso horário válido.',
    'unique'               => 'O campo :attribute já foi usado.',
    'uploaded'             => 'O campo :attribute falhou em ser enviado.',
    'url'                  => 'O formato do campo :attribute é inválido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
