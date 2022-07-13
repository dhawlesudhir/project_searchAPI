<?php

namespace App\customModules;
// namespace Google\Cloud\Samples\TextToSpeech;


use Exception;
use Google\Cloud\Speech\V1\RecognitionAudio;
use Google\Cloud\Speech\V1\RecognitionConfig;
use Google\Cloud\Speech\V1\SpeechClient;



use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\AudioEncoding;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;

use Google\Cloud\Vision\V1\Feature\Type;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\Likelihood;




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
            $audioFile = "D:\project-search\public\assets\audio\\04-07-2022_12_46_57.wav";

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

    function TextTospeech($text)
    {

        $textToSpeechClient = new TextToSpeechClient();

        $input = new SynthesisInput();
        $input->setText($text);
        $voice = new VoiceSelectionParams();
        $voice->setLanguageCode('en-US');
        $audioConfig = new AudioConfig();
        $audioConfig->setAudioEncoding(AudioEncoding::MP3);

        $resp = $textToSpeechClient->synthesizeSpeech($input, $voice, $audioConfig);
        $filename = date_format(now(), "d-m-Y_H_i_s");
        $flag = file_put_contents('D:\project-search\public\assets\audio\\' . $filename . '.wav', $resp->getAudioContent());
        echo $flag;
        if ($flag) {
            echo 'File Saved';
        } else {
            echo 'Failed to save';
        }
    }

    function textExtractfromImage()
    {


        // try {
        $path = 'D:\project-search\public\assets\images\9e19d0f553eeadc85d17a712a1d5b2e7461cb256_en-text-editor-img.webp';

        //     //code...
        // } catch (\Exception $th) {
        //     //throw $th;

        //    dd($th);
            
        // }

        // $path = asset(__FILE__.'/images/alttext.jpg');
        // echo $path;die;
        $imageAnnotator = new ImageAnnotatorClient();

        # annotate the image
        $image = file_get_contents($path);
        $response = $imageAnnotator->documentTextDetection($image);
        $annotation = $response->getFullTextAnnotation();
        $text = [];
        # print out detailed and structured information about document text
        if ($annotation) {
            foreach ($annotation->getPages() as $page) {
                foreach ($page->getBlocks() as $block) {
                    $block_text = '';
                    foreach ($block->getParagraphs() as $paragraph) {
                        foreach ($paragraph->getWords() as $word) {
                            foreach ($word->getSymbols() as $symbol) {
                                $block_text .= $symbol->getText();
                            }
                            $block_text .= ' ';
                        }
                    }
                    $text[] .= $block_text;
                    // printf('Block content: %s', $block_text);
                    // printf(
                    //     'Block confidence: %f' . PHP_EOL,
                    //     $block->getConfidence()
                    // );

                    # get bounds
                    $vertices = $block->getBoundingBox()->getVertices();
                    $bounds = [];
                    foreach ($vertices as $vertex) {
                        $bounds[] = sprintf(
                            '(%d,%d)',
                            $vertex->getX(),
                            $vertex->getY()
                        );
                    }
                    // print('Bounds: ' . join(', ', $bounds) . PHP_EOL);
                    // print(PHP_EOL);
                }
            }
            print_r($text);
        } else {
            print('No text found' . PHP_EOL);
        }

        $imageAnnotator->close();
    }
}
