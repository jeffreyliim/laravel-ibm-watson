<?php
/**
 * Created by PhpStorm.
 * User: Jeffrey
 * Date: 26/11/17
 * Time: 10:18 AM
 */

namespace App;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7;
use Mockery\Exception;
use Request;
use RobbieP\CloudConvertLaravel\Facades\CloudConvert as CloudConvert;
use Storage;

class IbmWatson
{

    public function getPersonalityTraits($request)
    {
        $client = new Client();
        $options = [
            'auth' => [
                env('PERSONALITY_INSIGHTS_USERNAME'),
                env('PERSONALITY_INSIGHTS_PASSWORD')
            ],
            'headers' => [
                'content-type' => 'text/plain',
            ],
            'body' => $request

        ];
        $r = $client->request("POST", env('PERSONALITY_INSIGHTS_BASEURL'), $options);
        return json_decode($r->getBody(), true);
    }

    private function convertFileToMp3($request)
    {
        $path = '../storage/app/mp3/';
        Storage::disk('local')->put('mp3', $request); //the storage/app/mp3 folder must be created using the put method
        CloudConvert::file($request)->to($path . $request->getClientOriginalName() . '.mp3'); //converting... saving in /storage/app/mp3
    }

    public function getSpeechToText($request)
    {

        $this->convertFileToMp3($request);

        Video::storeMp3($request);

        $client = new Client();
        $options = [
            'auth' => [
                env('SPEECH_TEXT_USERNAME'),
                env('SPEECH_TEXT_PASSWORD')
            ],
            'headers' => [
                'content-type' => 'audio/mp3', //accepts audio/mp3; audio/webm; audio/flaac; audio/opus; audio/wav;
            ],
            'body' => Storage::get(Video::orderBy('id', 'desc')->first()->path . Video::orderBy('id', 'desc')->first()->name) //using the storage/app/mp3/file.mp3
        ];
        $r = $client->request("POST", env('SPEECH_TEXT_BASEURL'), $options);
        return json_decode($r->getBody(), true);
    }
}