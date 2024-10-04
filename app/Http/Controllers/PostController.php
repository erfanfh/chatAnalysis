<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function check(Request $request)
    {
        $data = json_decode($request->json);

        $static = [];

        foreach ($data->messages as $value) {
            $date = explode('-', $value->date);

            $year = $date[0];

            $month = $date[1];

            $day = explode('T', $date[2])[0];

            if (!isset($static[$year])) {
                $static[$year] = [];
            }

            if (!isset($static[$year][$month])) {
                $static[$year][$month] = [];
            }

            if (!isset($static[$year][$month][$day])) {
                $static[$year][$month][$day] = 1;
            } else {
                $static[$year][$month][$day]++;
            }
        }

        dd($static);
    }

}
