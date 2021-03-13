<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        return view(
            'profile',
            [
                'name' => 'Controller Name',
                'id' => 1245,
                'records' => [
                    [
                        'id' => 1,
                        'text' => '1234',
                    ],
                    [
                        'id' => 2,
                        'text' => '1234',
                    ],
                ],
            ]
        );
    }
}
