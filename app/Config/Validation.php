<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    public $registration = [
        'username' => [
            'label' =>  'Token',
            'rules' => 'required|max_length[30]|min_length[3]|is_unique[users.username]',
        ],
        'email' => [
            'label' =>  'Auth.email',
            'rules' => 'required|max_length[254]|valid_email|is_unique[auth_identities.secret]',
        ],
        'gender' => [
            'label' =>  'Auth.gender',
            'rules' => 'required',
        ],
        'first_name' => [
            'label' =>  'Auth.first_name',
            'rules' => 'required|max_length[254]',
        ],
        'last_name' => [
            'label' =>  'Auth.last_name',
            'rules' => 'required|max_length[254]',
        ],
        'phone_number' => [
            'label' =>  'Auth.phone_number',
            'rules' => 'permit_empty|numeric|max_length[19]',
        ],
    ];
}
