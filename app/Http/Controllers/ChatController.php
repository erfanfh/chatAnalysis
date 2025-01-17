<?php

namespace App\Http\Controllers;

use App\Charts\MyChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChatController extends Controller
{
    public function check(Request $request)
    {
        if (!$request->isMethod('POST')) {
            return redirect('/');
        }

        $data = json_decode($request->json);

        if (!isset($data->messages) && !$request->hasFile('jsonFile')) {
            return redirect('/')->with('error', 'Your data is not analysable!');
        }

        if ($request->hasFile('jsonFile')) {
            $file = $request->file('jsonFile');

            $content = file_get_contents($file->getRealPath());

            $decodedContent = json_decode($content);

            $data = $decodedContent;

            if (!isset($data->messages)) {
                return redirect('/')->with('error', 'Your data is not analysable!');
            }
        }


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
                    if (!isset($value->duration_seconds)) {
                        continue;
                    }

                    if (!isset($static['type']['voice_message'])) {
                        $static['type']['voice_message'] = [
                            'count' => 1,
                            'duration' => ($value->duration_seconds) / 60,
                        ];
                    } else {
                        $static['type']['voice_message']['count']++;
                        $static['type']['voice_message']['duration'] += ($value->duration_seconds) / 60;
                    }

                    if (!isset($static['persons'][$sender]['type']['voice_message'])) {
                        $static['persons'][$sender]['type']['voice_message'] = [
                            'count' => 1,
                            'duration' => ($value->duration_seconds) / 60,
                        ];
                    } else {
                        $static['persons'][$sender]['type']['voice_message']['count']++;
                        $static['persons'][$sender]['type']['voice_message']['duration'] += ($value->duration_seconds) / 60;
                    }
                }

                if ($media_type == 'video_message') {
                    if (!isset($value->duration_seconds)) {
                        continue;
                    }
                    if (!isset($static['type']['video_message'])) {
                        $static['type']['video_message'] = [
                            'count' => 1,
                            'duration' => ($value->duration_seconds) / 60,
                        ];
                    } else {
                        $static['type']['video_message']['count']++;
                        $static['type']['video_message']['duration'] += ($value->duration_seconds) / 60;
                    }

                    if (!isset($static['persons'][$sender]['type']['video_message'])) {
                        $static['persons'][$sender]['type']['video_message'] = [
                            'count' => 1,
                            'duration' => ($value->duration_seconds) / 60,
                        ];
                    } else {
                        $static['persons'][$sender]['type']['video_message']['count']++;
                        $static['persons'][$sender]['type']['video_message']['duration'] += ($value->duration_seconds) / 60;
                    }
                }

                if (!isset($static['type'][$media_type])) {
                    $static['type'][$media_type] = 1;
                } else {
                    if ($media_type != 'voice_message' && $media_type != 'video_message') {
                        $static['type'][$media_type]++;
                    }
                }

                if (!isset($static['persons'][$sender]['type'][$media_type])) {
                    $static['persons'][$sender]['type'][$media_type] = 1;
                } else {
                    if ($media_type != 'voice_message' && $media_type != 'video_message') {
                        $static['persons'][$sender]['type'][$media_type]++;
                    }
                }
            }

            $year = $date[0];

            $month = $date[1];

            $day = explode('T', $date[2])[0];

            if (!isset($static['date'][$year])) {
                $static['date'][$year] = [];
                $static['date'][$year]['count'] = 1;
            } else {
                $static['date'][$year]['count']++;
            }

            if (!isset($static['date'][$year][$month])) {
                $static['date'][$year][$month] = [];
                $static['date'][$year][$month]['count'] = 1;
            } else {
                $static['date'][$year][$month]['count']++;
            }

            if (!isset($static['date'][$year][$month][$day])) {
                $static['date'][$year][$month][$day] = 1;
            } else {
                $static['date'][$year][$month][$day]++;
            }

            if (!isset($static['persons'][$sender]['date'][$year])) {
                $static['persons'][$sender]['date'][$year] = [];
                $static['persons'][$sender]['date'][$year]['count'] = 1;
            } else {
                $static['persons'][$sender]['date'][$year]['count']++;
            }

            if (!isset($static['persons'][$sender]['date'][$year][$month])) {
                $static['persons'][$sender]['date'][$year][$month] = [];
                $static['persons'][$sender]['date'][$year][$month]['count'] = 1;
            } else {
                $static['persons'][$sender]['date'][$year][$month]['count']++;
            }

            if (!isset($static['persons'][$sender]['date'][$year][$month][$day])) {
                $static['persons'][$sender]['date'][$year][$month][$day] = 1;
            } else {
                $static['persons'][$sender]['date'][$year][$month][$day]++;
            }

            if (!isset($static['persons'][$sender]['messages'])) {
                $static['persons'][$sender] = [
                    'messages' => 1,
                ];
            } else {
                $static['persons'][$sender]['messages']++;
            }

        }

        if ($request->submit == 'file') {
            $jsonData = json_encode($static, JSON_PRETTY_PRINT);

            $fileName = 'data-export.json';

            Storage::disk('public')->put($fileName, $jsonData);

            return response()->download(storage_path('app/public/' . $fileName))->deleteFileAfterSend(true);
        }

        if ($request->submit == 'raw') {
            return view('showRawJson', ['static' => $static]);
        }

        $monthMessagesChart = new MyChart;
        $monthMessagesChart->labels(['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12']);
        $year = 2025;
        $monthMessagesChart->dataset(
            $year,
            'line',
            [
                $static['date'][$year]['01']['count'] ?? 0,
                $static['date'][$year]['02']['count'] ?? 0,
                $static['date'][$year]['03']['count'] ?? 0,
                $static['date'][$year]['04']['count'] ?? 0,
                $static['date'][$year]['05']['count'] ?? 0,
                $static['date'][$year]['06']['count'] ?? 0,
                $static['date'][$year]['07']['count'] ?? 0,
                $static['date'][$year]['08']['count'] ?? 0,
                $static['date'][$year]['09']['count'] ?? 0,
                $static['date'][$year]['10']['count'] ?? 0,
                $static['date'][$year]['11']['count'] ?? 0,
                $static['date'][$year]['12']['count'] ?? 0,
            ]
        )->options([
            'backgroundColor' => '#155E95',
        ]);
        $year = 2024;
        $monthMessagesChart->dataset(
            $year,
            'line',
            [
                $static['date'][$year]['01']['count'] ?? 0,
                $static['date'][$year]['02']['count'] ?? 0,
                $static['date'][$year]['03']['count'] ?? 0,
                $static['date'][$year]['04']['count'] ?? 0,
                $static['date'][$year]['05']['count'] ?? 0,
                $static['date'][$year]['06']['count'] ?? 0,
                $static['date'][$year]['07']['count'] ?? 0,
                $static['date'][$year]['08']['count'] ?? 0,
                $static['date'][$year]['09']['count'] ?? 0,
                $static['date'][$year]['10']['count'] ?? 0,
                $static['date'][$year]['11']['count'] ?? 0,
                $static['date'][$year]['12']['count'] ?? 0,
            ]
        )->options([
            'backgroundColor' => '#f5cba7',
        ]);
        $year = 2023;
        $monthMessagesChart->dataset(
            $year,
            'line',
            [
                $static['date'][$year]['01']['count'] ?? 0,
                $static['date'][$year]['02']['count'] ?? 0,
                $static['date'][$year]['03']['count'] ?? 0,
                $static['date'][$year]['04']['count'] ?? 0,
                $static['date'][$year]['05']['count'] ?? 0,
                $static['date'][$year]['06']['count'] ?? 0,
                $static['date'][$year]['07']['count'] ?? 0,
                $static['date'][$year]['08']['count'] ?? 0,
                $static['date'][$year]['09']['count'] ?? 0,
                $static['date'][$year]['10']['count'] ?? 0,
                $static['date'][$year]['11']['count'] ?? 0,
                $static['date'][$year]['12']['count'] ?? 0,
            ]
        )->options([
            'backgroundColor' => '#16a085 ',
        ]);

        $year = 2022;
        $monthMessagesChart->dataset(
            $year,
            'line',
            [
                $static['date'][$year]['01']['count'] ?? 0,
                $static['date'][$year]['02']['count'] ?? 0,
                $static['date'][$year]['03']['count'] ?? 0,
                $static['date'][$year]['04']['count'] ?? 0,
                $static['date'][$year]['05']['count'] ?? 0,
                $static['date'][$year]['06']['count'] ?? 0,
                $static['date'][$year]['07']['count'] ?? 0,
                $static['date'][$year]['08']['count'] ?? 0,
                $static['date'][$year]['09']['count'] ?? 0,
                $static['date'][$year]['10']['count'] ?? 0,
                $static['date'][$year]['11']['count'] ?? 0,
                $static['date'][$year]['12']['count'] ?? 0,
            ]
        )->options([
            'backgroundColor' => '#DAF7A6',
        ]);

        $yearMessagesChart = new MyChart;
        $yearMessagesChart->labels(['2015', '2016', '2017', '2018', '2019', '2020', '2021', '2022', '2023', '2024', '2025']);
        $yearMessagesChart->dataset(
            'Years',
            'line',
            [
                $static['date']['2015']['count'] ?? 0,
                $static['date']['2016']['count'] ?? 0,
                $static['date']['2017']['count'] ?? 0,
                $static['date']['2018']['count'] ?? 0,
                $static['date']['2019']['count'] ?? 0,
                $static['date']['2020']['count'] ?? 0,
                $static['date']['2021']['count'] ?? 0,
                $static['date']['2022']['count'] ?? 0,
                $static['date']['2023']['count'] ?? 0,
                $static['date']['2024']['count'] ?? 0,
                $static['date']['2025']['count'] ?? 0,
            ]
        )->options([
            'backgroundColor' => '#c0392b',
        ]);

        $year = 2024;
//        $month = '07';
        $dayMessagesChart = new MyChart;
        $dayMessagesChart->labels(['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30']);
        $dayMessagesChart->dataset(
            'days',
            'line',
            [
                $static['date'][$year][$month]['01'] ?? 0,
                $static['date'][$year][$month]['02'] ?? 0,
                $static['date'][$year][$month]['03'] ?? 0,
                $static['date'][$year][$month]['04'] ?? 0,
                $static['date'][$year][$month]['05'] ?? 0,
                $static['date'][$year][$month]['06'] ?? 0,
                $static['date'][$year][$month]['07'] ?? 0,
                $static['date'][$year][$month]['08'] ?? 0,
                $static['date'][$year][$month]['09'] ?? 0,
                $static['date'][$year][$month]['10'] ?? 0,
                $static['date'][$year][$month]['11'] ?? 0,
                $static['date'][$year][$month]['12'] ?? 0,
                $static['date'][$year][$month]['13'] ?? 0,
                $static['date'][$year][$month]['14'] ?? 0,
                $static['date'][$year][$month]['15'] ?? 0,
                $static['date'][$year][$month]['16'] ?? 0,
                $static['date'][$year][$month]['17'] ?? 0,
                $static['date'][$year][$month]['18'] ?? 0,
                $static['date'][$year][$month]['19'] ?? 0,
                $static['date'][$year][$month]['20'] ?? 0,
                $static['date'][$year][$month]['21'] ?? 0,
                $static['date'][$year][$month]['22'] ?? 0,
                $static['date'][$year][$month]['23'] ?? 0,
                $static['date'][$year][$month]['24'] ?? 0,
                $static['date'][$year][$month]['25'] ?? 0,
                $static['date'][$year][$month]['26'] ?? 0,
                $static['date'][$year][$month]['27'] ?? 0,
                $static['date'][$year][$month]['28'] ?? 0,
                $static['date'][$year][$month]['29'] ?? 0,
                $static['date'][$year][$month]['30'] ?? 0,
            ]
        )->options([
            'backgroundColor' => '#DAF7A6',
        ]);

        $typeMessages = new MyChart;
        $typeMessages->labels(['sticker', 'voice_message', 'animation', 'audio_file', 'video_message']);
        $typeMessages->dataset(
            'Years',
            'bar',
            [
                $static['type']['sticker'] ?? 0,
                $static['type']['voice_message']['count'] ?? 0,
                $static['type']['animation'] ?? 0,
                $static['type']['audio_file'] ?? 0,
                $static['type']['video_message']['count'] ?? 0,
            ]
        )->options([
            'backgroundColor' => '#aeb6bf',
        ]);

        return view('result', [
            'data' => $static,
            'monthMessagesChart' => $monthMessagesChart,
            'yearMessagesChart' => $yearMessagesChart,
            'typeMessages' => $typeMessages,
            'dayMessagesChart' => $dayMessagesChart,
            'total' => $static['persons'],
        ]);
    }

}
