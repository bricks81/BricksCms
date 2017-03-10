<?php

/**
 * Bricks Framework & Bricks CMS
 * http://bricks-cms.org
 *
 * The MIT License (MIT)
 * Copyright (c) 2015 bricks-cms.org
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

use Bricks\Cms\Controller;

return [
    'bricks' => [
        'defaultNamespace' => 'default',
        'namespaces' => array(
            'default'
        ),
        'default' => [
            'backendPath' => 'backend123',
            'pathes' => [
                'var' => 'var',
                'tmp' => '{pathes.var}/tmp',
                'data' => 'data',
                'vendor' => 'vendor'
            ],
            'bricks-acl' => [
                'roles' => [
                    'admin' => array('registered'),
                    'registered' => array('guest'),
                    'guest' => array()
                ],
                'resources' => [
                    Controller\IndexController::class.'::index' => [
                        'admin'
                    ],
                    Controller\IndexController::class.'::index' => [
                        'admin'
                    ]
                ]
            ],
            'bricks-asset' => [
                'assets' => [
                    'bricks-cms' => [
                        [
                            'target' => 'default/bricks-cms',
                            'source' => '{{pathes;vendordir}}'
                        ]
                    ],
                    'jquery' => [
                        [
                            'target' => 'default/jquery/jquery.js',
                            'source' => '{{pathes;vendordir}}/components/jquery/jquery.js'
                        ]
                    ],
                    'jqueryui' => [
                        [
                            'target' => 'default/jqueryui/jquery-ui.js',
                            'source' => '{{pathes;vendordir}}/components/jqueryui/jquery-ui.js'
                        ]
                    ],
                    'bootstrap' => [
                        [
                            'target' => 'default/bootstrap/css',
                            'source' => '{{pathes;vendordir}}/components/bootstrap/css'
                        ],
                        [
                            'target' => 'default/bootstrap/fonts',
                            'source' => '{{pathes;vendordir}}/components/bootstrap/fonts'
                        ],
                        [
                            'target' => 'default/bootstrap/js',
                            'source' => '{{pathes;vendordir}}/components/bootstrap/js'
                        ]
                    ],
                    'font-awesome' => [
                        [
                            'target' => 'default/font-awesome/css',
                            'source' => '{{pathes;vendordir}}/components/font-awesome/css'
                        ],
                        [
                            'target' => 'default/font-awesome/fonts',
                            'source' => '{{pathes;vendordir}}/components/font-awesome/fonts'
                        ]
                    ]
                ]
            ],
            'bricks-backup' => [
                'backupSQL' => [
                    'default' => 'Zend\Db\Adapter\Adapter'
                ]
            ]
        ]
    ]
];