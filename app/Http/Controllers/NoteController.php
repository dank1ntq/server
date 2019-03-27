<?php

namespace App\Http\Controllers;

use App\Services\GeneralService;

class NoteController extends Controller
{

    private $_generalService;

    public function __construct(GeneralService $generalService)
    {
        $this->_generalService = $generalService;
    }

    public function getNoteList()
    {
        $data = [
            'noteList' => [
                [
                    'id' => 1,
                    'date' => '2019.03.21',
                    'memo' => "Memo 1<br />Memo2<br />Memo3",
                    'thumbUrl' => 'https://images.unsplash.com/photo-1553353797-cfdaab67d669?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1000&q=80'
                ],
                [
                    'id' => 2,
                    'date' => '2019.03.22',
                    'memo' => "Memo 1<br />Memo2<br />Memo3",
                    'thumbUrl' => 'https://images.unsplash.com/photo-1553353797-cfdaab67d669?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1000&q=80'
                ]
            ]
        ];

        return response()->json($this->_generalService->getSuccessResponse($data));
    }

}