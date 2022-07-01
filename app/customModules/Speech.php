<?php

namespace App\customModules;
// namespace Google\Cloud\Samples\TextToSpeech;


use Exception;
use Google\Cloud\Speech\V1\SpeechClient;
use Google\Cloud\Speech\V1\RecognitionAudio;
use Google\Cloud\Speech\V1\RecognitionConfig;


use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\AudioEncoding;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;
use Google\Cloud\Speech\V1\StreamingRecognitionConfig;


class Speech
{

    function __construct()
    {
        // echo "speech cls";
    }

    function speechToText()
    {
        try {
            echo "Start";
            // ** Uncomment and populate these variables in your code */
            // $audioFile = 'D:\project-search\public\assets\audio\sample.mp3';
            // $audioFile = asset('public\assets\audio\sample.mp3');
            $audioFile = "D:\project-search\public\assets\audio\samplenew.wav";

            // change these variables if necessary
            $encoding = AudioEncoding::LINEAR16;
            $sampleRateHertz = 32000;
            $languageCode = 'en-US';
            // get contents of a file into a string
            $content = file_get_contents($audioFile);


            // set string as audio content
            $audio = (new RecognitionAudio())
                ->setContent($content);
            // set config
            $config = (new RecognitionConfig())
                ->setEncoding($encoding)
                ->setSampleRateHertz($sampleRateHertz)
                ->setLanguageCode($languageCode);

            // create the speech client
            $client = new SpeechClient();

            // create the asyncronous recognize operation
            $operation = $client->longRunningRecognize($config, $audio);
            $operation->pollUntilComplete();

            if ($operation->operationSucceeded()) {
                $response = $operation->getResult();
                // each result is for a consecutive portion of the audio. iterate
                // through them to get the transcripts for the entire audio file.

                foreach ($response->getResults() as $result) {
                    $alternatives = $result->getAlternatives();
                    $mostLikely = $alternatives[0];
                    $transcript = $mostLikely->getTranscript();
                    $confidence = $mostLikely->getConfidence();


                    printf('Transcript: %s' . PHP_EOL, $transcript);
                    printf('Confidence: %s' . PHP_EOL, $confidence);
                }
            } else {
                print_r($operation->getError());
            }
            $client->close();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function TextTospeech()
    {
        $textToSpeechClient = new TextToSpeechClient();

        $input = new SynthesisInput();
        $input->setText('how are you? vishal');
        $voice = new VoiceSelectionParams();
        $voice->setLanguageCode('en-US');
        $audioConfig = new AudioConfig();
        $audioConfig->setAudioEncoding(AudioEncoding::MP3);

        $resp = $textToSpeechClient->synthesizeSpeech($input, $voice, $audioConfig);
        file_put_contents('D:\project-search\public\assets\audio\test1.wav', $resp->getAudioContent());
    }

    function speechToText1()
    {
        $recognitionConfig = new RecognitionConfig();
        $recognitionConfig->setEncoding(AudioEncoding::AUDIO_ENCODING_UNSPECIFIED);
        $recognitionConfig->setSampleRateHertz(44100);
        $recognitionConfig->setLanguageCode('en-US');
        $config = new StreamingRecognitionConfig();
        $config->setConfig($recognitionConfig);

        $audioResource = fopen('D:\project-search\public\assets\audio\sample.mp3', 'r');
        $speechClient = new SpeechClient();

        $responses = $speechClient->recognizeAudioStream($config, $audioResource);

        foreach ($responses as $element) {
            // doSomethingWith($element);
            echo $element;

        }
    }
}
