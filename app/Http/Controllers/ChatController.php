<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function check(Request $request)
    {
        $data = json_decode($request->json);

        $static = [
            'date' => [],
            'persons' => [],
            'type' => [],
        ];

        foreach ($data->messages as $value) {
            $date = explode('-', $value->date);

            if (!isset($value->from)) {
                continue;
            }

            $sender = $value->from;

            if (isset($value->media_type)) {
                $media_type = $value->media_type;

                if ($media_type == 'voice_message') {
                    if (!isset($static['type']['voice_message'])) {
                        $static['type']['voice_message'] = [
                            'count' => 1,
                            'duration' => ($value->duration_seconds)/60,
                        ];
                    } else {
                        $static['type']['voice_message']['count']++;
                        $static['type']['voice_message']['duration'] += ($value->duration_seconds)/60;
                    }
                }

                if ($media_type == 'video_message') {
                    if (!isset($static['type']['video_message'])) {
                        $static['type']['video_message'] = [
                            'count' => 1,
                            'duration' => ($value->duration_seconds)/60,
                        ];
                    } else {
                        $static['type']['video_message']['count']++;
                        $static['type']['video_message']['duration'] += ($value->duration_seconds)/60;
                    }
                }

                if (!isset($static['type'][$media_type])) {
                    $static['type'][$media_type] = 1;
                } else {
                    if ($media_type != 'voice_message' && $media_type != 'video_message') {
                        $static['type'][$media_type]++;
                    }
                }
            }

            $year = $date[0];

            $month = $date[1];

            $day = explode('T', $date[2])[0];

            if (!isset($static['date'][$year])) {
                $static['date'][$year] = [];
            }

            if (!isset($static['date'][$year][$month])) {
                $static['date'][$year][$month] = [];
            }

            if (!isset($static['date'][$year][$month][$day])) {
                $static['date'][$year][$month][$day] = 1;
            } else {
                $static['date'][$year][$month][$day]++;
            }

            if (!isset($static['persons'][$sender])) {
                $static['persons'][$sender] = 1;
            } else {
                $static['persons'][$sender]++;
            }

        }

        dd($static);
    }

}
