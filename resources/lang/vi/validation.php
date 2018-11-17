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

    'accepted'             => '[vi] The :attribute must be accepted.',
    'active_url'           => '[vi] The :attribute is not a valid URL.',
    'after'                => '[vi] The :attribute must be a date after :date.',
    'after_or_equal'       => '[vi] The :attribute must be a date after or equal to :date.',
    'alpha'                => '[vi] The :attribute may only contain letters.',
    'alpha_dash'           => '[vi] The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num'            => '[vi] The :attribute may only contain letters and numbers.',
    'array'                => '[vi] The :attribute must be an array.',
    'before'               => '[vi] The :attribute must be a date before :date.',
    'before_or_equal'      => '[vi] The :attribute must be a date before or equal to :date.',
    'between'              => [
        'numeric' => '[vi] The :attribute must be between :min and :max.',
        'file'    => '[vi] The :attribute must be between :min and :max kilobytes.',
        'string'  => '[vi] The :attribute must be between :min and :max characters.',
        'array'   => '[vi] The :attribute must have between :min and :max items.',
    ],
    'boolean'              => '[vi] The :attribute field must be true or false.',
    'confirmed'            => '[vi] The :attribute confirmation does not match.',
    'date'                 => '[vi] The :attribute is not a valid date.',
    'date_format'          => '[vi] The :attribute does not match the format :format.',
    'different'            => '[vi] The :attribute and :other must be different.',
    'digits'               => '[vi] The :attribute must be :digits digits.',
    'digits_between'       => '[vi] The :attribute must be between :min and :max digits.',
    'dimensions'           => '[vi] The :attribute has invalid image dimensions.',
    'distinct'             => '[vi] The :attribute field has a duplicate value.',
    'email'                => '[vi] The :attribute must be a valid email address.',
    'exists'               => '[vi] The selected :attribute is invalid.',
    'file'                 => '[vi] The :attribute must be a file.',
    'filled'               => '[vi] The :attribute field must have a value.',
    'gt'                   => [
        'numeric' => '[vi] The :attribute must be greater than :value.',
        'file'    => '[vi] The :attribute must be greater than :value kilobytes.',
        'string'  => '[vi] The :attribute must be greater than :value characters.',
        'array'   => '[vi] The :attribute must have more than :value items.',
    ],
    'gte'                  => [
        'numeric' => '[vi] The :attribute must be greater than or equal :value.',
        'file'    => '[vi] The :attribute must be greater than or equal :value kilobytes.',
        'string'  => '[vi] The :attribute must be greater than or equal :value characters.',
        'array'   => '[vi] The :attribute must have :value items or more.',
    ],
    'image'                => '[vi] The :attribute must be an image.',
    'in'                   => '[vi] The selected :attribute is invalid.',
    'in_array'             => '[vi] The :attribute field does not exist in :other.',
    'integer'              => '[vi] The :attribute must be an integer.',
    'ip'                   => '[vi] The :attribute must be a valid IP address.',
    'ipv4'                 => '[vi] The :attribute must be a valid IPv4 address.',
    'ipv6'                 => '[vi] The :attribute must be a valid IPv6 address.',
    'json'                 => '[vi] The :attribute must be a valid JSON string.',
    'lt'                   => [
        'numeric' => '[vi] The :attribute must be less than :value.',
        'file'    => '[vi] The :attribute must be less than :value kilobytes.',
        'string'  => '[vi] The :attribute must be less than :value characters.',
        'array'   => '[vi] The :attribute must have less than :value items.',
    ],
    'lte'                  => [
        'numeric' => '[vi] The :attribute must be less than or equal :value.',
        'file'    => '[vi] The :attribute must be less than or equal :value kilobytes.',
        'string'  => '[vi] The :attribute must be less than or equal :value characters.',
        'array'   => '[vi] The :attribute must not have more than :value items.',
    ],
    'max'                  => [
        'numeric' => '[vi] The :attribute may not be greater than :max.',
        'file'    => '[vi] The :attribute may not be greater than :max kilobytes.',
        'string'  => '[vi] The :attribute may not be greater than :max characters.',
        'array'   => '[vi] The :attribute may not have more than :max items.',
    ],
    'mimes'                => '[vi] The :attribute must be a file of type: :values.',
    'mimetypes'            => '[vi] The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => '[vi] The :attribute must be at least :min.',
        'file'    => '[vi] The :attribute must be at least :min kilobytes.',
        'string'  => ':attribute phải có độ dài ít nhất :min ký tự.',
        'array'   => '[vi] The :attribute must have at least :min items.',
    ],
    'not_in'               => '[vi] The selected :attribute is invalid.',
    'not_regex'            => 'Định dạng :attribute không hợp lệ.',
    'numeric'              => '[vi] The :attribute must be a number.',
    'present'              => '[vi] The :attribute field must be present.',
    'regex'                => 'Định dạng :attribute không hợp lệ.',
    'required'             => '[vi] The :attribute field is required.',
    'required_if'          => '[vi] The :attribute field is required when :other is :value.',
    'required_unless'      => '[vi] The :attribute field is required unless :other is in :values.',
    'required_with'        => '[vi] The :attribute field is required when :values is present.',
    'required_with_all'    => '[vi] The :attribute field is required when :values is present.',
    'required_without'     => '[vi] The :attribute field is required when :values is not present.',
    'required_without_all' => '[vi] The :attribute field is required when none of :values are present.',
    'same'                 => '[vi] The :attribute and :other must match.',
    'size'                 => [
        'numeric' => '[vi] The :attribute must be :size.',
        'file'    => '[vi] The :attribute must be :size kilobytes.',
        'string'  => '[vi] The :attribute must be :size characters.',
        'array'   => '[vi] The :attribute must contain :size items.',
    ],
    'string'               => '[vi] The :attribute must be a string.',
    'timezone'             => '[vi] The :attribute must be a valid zone.',
    'unique'               => ':attribute đã được đăng ký, vui lòng nhập :attribute khác.',
    'uploaded'             => '[vi] The :attribute failed to upload.',
    'url'                  => '[vi] The :attribute format is invalid.',

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
            'rule-name' => '[vi] custom-message',
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

    'attributes' => [
        'password' => 'mật khẩu',
    ],

];
