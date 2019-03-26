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
            'note_list' => [
                [
                    'id' => 1,
                    'date' => '2019.03.21',
                    'memo' => "Memo 1\nMemo2\nMemo3",
                    'video_url' => 'https://www.w3schools.com/html/mov_bbb.mp4'
                ],
                [
                    'id' => 2,
                    'date' => '2019.03.22',
                    'memo' => "Memo 1\nMemo2\nMemo3",
                    'video_url' => 'https://www.w3schools.com/html/mov_bbb.mp4'
                ]
            ]
        ];

        return response()->json($this->_generalService->getSuccessResponse($data));
    }

}