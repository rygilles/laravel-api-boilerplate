<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Models configuration
    |--------------------------------------------------------------------------
    |
    | Extra configuration information for models.
    |
    | Each model configuration array is defined with :
    |
    | - attributes :                    List of attributes that need extra configuration (not all needed)
    |   - defaultValue :                Attribute default value (used for hidden & not fillable model fields)
    |   - apiCannotReadOnUserGroups :   Remove reading access (hide in transformer)
    |                                   from the Api user if it's not in the supplied user groups (string[])
    |                                   @see App\Http\Transformers\Api\ApiTransformer
    |   - apiCannotFillOnUserGroups :   Remove fill access (remove from fillable fields)
    |                                   from the Api user if it's not in the supplied user groups (string[])
    | - requestQueryStringParameters :  List of query string filtering parameters
    |   - authorizedOrderByColumns :    Comma delimited column names allowed for order by
    |   - authorizedSearchColumns :     Comma delimited column names allowed for searching
    |   - defaultSearchFields :         Comma delimited column names used for basic searching ("search=xxx" query parameter)
    |
    | @see App\Models\ApiModel
    */

    App\Models\User::class => [

        'attributes' => [

            'user_group_id' => [

                'defaultValue' => 'End-User',
                'apiCannotFillOnUserGroups' => ['Support', 'End-User'],

            ],
        ],

        'requestQueryStringParameters' => [

            'authorizeSearch' => true,
            'authorizedOrderByColumns' => 'id,user_group_id,name,email,created_at,updated_at',
            'authorizedSearchColumns' => 'name,email',
            'defaultSearchColumns' => 'name,email',

        ],

    ],

    App\Models\UserGroup::class => [

        'requestQueryStringParameters' => [

            'authorizedOrderByColumns' => 'id,users_count',

        ],

    ],

    App\Models\I18nLang::class => [

        'requestQueryStringParameters' => [

            'authorizeSearch' => true,
            'authorizedOrderByColumns' => 'id,description',
            'authorizedSearchColumns' => 'id,description',
            'defaultSearchColumns' => 'id,description',

        ],

    ],

];
