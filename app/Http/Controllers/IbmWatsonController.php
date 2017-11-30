<?php

namespace App\Http\Controllers;

use App\IbmWatson;
use App\Post;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;

class IbmWatsonController extends Controller
{

    public function getPersonalityTraits(Request $request)
    {
        $ibm = new IbmWatson();
        try {
            /* Get message from text that was converted by IBM Watson Speech to Text API */
            $results = $ibm->getPersonalityTraits($request->get('sentences')); //word count has to be more than 100

            /* Getting content message directly from post ID to fetch personality insights */
//            $results = $ibm->getPersonalityTraits(Post::find($request->get('id'))->post_content);

        } catch (ClientException $e) {
            return [
                'request error' => Psr7\str($e->getRequest()),
                'response error' => Psr7\str($e->getResponse())
            ];
        }
        return view('ibm.personality', compact('results'));
    }

    /**
     *
     * https://github.com/robbiepaul/cloudconvert-laravel converting video files to mp3
     */
    public function getSpeechToText(Request $request)
    {
        $ibm = new IbmWatson();
        try {
            $resultsSpeechToText = $ibm->getSpeechToText($request->file('toneFile'));
            $results = $resultsSpeechToText['results'];
            $sentences = null;
            $confidences = null;
            $countForeachLoop = 0;
            foreach ($results as $key => $arr) {
                foreach ($arr['alternatives'] as $result) {
                    $sentences .= $result['transcript']; //joining all sentences
                    $confidences += $result['confidence'] * 100; //adding up all confidence scores
                    $countForeachLoop++; //getting count of foreach loop
                }
            }

            $result = [
                'sentences' => $sentences,
                'confidences' => $confidences / $countForeachLoop,
            ];
            //update the user based on latest video post
            \Auth::user()->videos()->orderBy('id', 'desc')->update([
                'message' => $sentences
            ]);

            // put sentence in video
        } catch (ClientException $e) {
            return [
                'request error' => Psr7\str($e->getRequest()),
                'response error' => Psr7\str($e->getResponse())
            ];
        }
//        return $results;
        return view('ibm.speech_to_text', compact('result'));
    }
}
