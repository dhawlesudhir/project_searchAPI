@extends('layouts.modal')
@push('style')
    <style>


    </style>
@endpush

@push('scripts')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.16.0/codemirror.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.16.0/mode/htmlmixed/htmlmixed.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.16.0/mode/javascript/javascript.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.16.0/mode/xml/xml.js'></script>
    <script>
        //

        var HTMLContainer_response = document.querySelector(".HTMLContainercallresponse");
        var HTMLContainer_request = document.querySelector(".HTMLContainercall");



        // function updateEditor_request() {
        //     if (!tinymce.activeEditor.hasFocus()) {
        //         tinymce.activeEditor.setContent(editor_request.getDoc().getValue());
        //     }
        // }


        // function updateEditor_response() {
        //     if (!tinymce.activeEditor.hasFocus()) {
        //         tinymce.activeEditor.setContent(editor_response.getDoc().getValue());
        //     }
        // }


        var editor_request = CodeMirror(HTMLContainer_request, {
            lineNumbers: true,
            mode: "htmlmixed"
        });

        // editor_request.on("change", (editor) => {
        //     updateHTML_request();
        // });

        var editor_response = CodeMirror(HTMLContainer_response, {
            lineNumbers: true,
            mode: "htmlmixed"
        });

        // editor_response.on("change", (editor) => {
        //     updateHTML_response();
        // });

        function updateHTML_response(content) {
            // loading into Var to copytext function use
            responseload = content;
            editor_response.getDoc().setValue(content);
        }

        function updateHTML_request(content) {
            editor_request.getDoc().setValue(content);
        }


        // updateHTML_response(payload);
    </script>
    <script>
        var entityTypeArray = {};
        var entities;
        var sentiment;
        var languages;
        var piientities;
        var syntaxtokens;
        var keyPhrases;

        let perpage = 10;
        let pages = 0;
        let currentpage = 1;

        var localhost = "{{ env('APP_URL') }}";

        var textfromarea = document.getElementById("comprehendtextara").value;


        function payloadDataToHTMLDiv() {
            payloadtext = textfromarea;
            var responseload = '';

            var multilinedata = '';
            while (payloadtext.length >= (multilinedata.length + 40)) {
                // console.log(data.length);
                // console.log(multilinedata.length);
                multilinedata = multilinedata + payloadtext.substr(0, 40) + '\n';
                payloadtext = payloadtext.substr(41);
            }
            multilinedata = multilinedata + payloadtext;

            var payloaddata = `{\n 'text':"` + multilinedata + `" \n}`;
            updateHTML_request(payloaddata);
        }





        var testdataobject = `{
    "entities": {
        "Index": 0,
        "Entities": [
            {
                "Score": 0.5865874886512756,
                "Type": "DATE",
                "Text": "period",
                "BeginOffset": 24,
                "EndOffset": 30
            },
            {
                "Score": 0.9961597919464111,
                "Type": "LOCATION",
                "Text": "Mediterranean",
                "BeginOffset": 95,
                "EndOffset": 108
            },
            {
                "Score": 0.999405026435852,
                "Type": "DATE",
                "Text": "1930",
                "BeginOffset": 171,
                "EndOffset": 175
            },
            {
                "Score": 0.99830162525177,
                "Type": "ORGANIZATION",
                "Text": "Maritime Air Force",
                "BeginOffset": 181,
                "EndOffset": 199
            },
            {
                "Score": 0.9973596334457397,
                "Type": "ORGANIZATION",
                "Text": "Royal Yugoslav Army",
                "BeginOffset": 218,
                "EndOffset": 237
            },
            {
                "Score": 0.8668088912963867,
                "Type": "LOCATION",
                "Text": "Adriatic coast",
                "BeginOffset": 348,
                "EndOffset": 362
            },
            {
                "Score": 0.9651749730110168,
                "Type": "OTHER",
                "Text": "British",
                "BeginOffset": 386,
                "EndOffset": 393
            },
            {
                "Score": 0.49801331758499146,
                "Type": "ORGANIZATION",
                "Text": "KM",
                "BeginOffset": 455,
                "EndOffset": 457
            },
            {
                "Score": 0.998932421207428,
                "Type": "LOCATION",
                "Text": "Mediterranean",
                "BeginOffset": 490,
                "EndOffset": 503
            },
            {
                "Score": 0.7214317321777344,
                "Type": "OTHER",
                "Text": "British",
                "BeginOffset": 518,
                "EndOffset": 525
            },
            {
                "Score": 0.7522981762886047,
                "Type": "OTHER",
                "Text": "French",
                "BeginOffset": 530,
                "EndOffset": 536
            }
        ]
    },
    "sentiment": {
        "Index": 0,
        "Sentiment": "NEUTRAL",
        "SentimentScore": {
            "Positive": 0.0029022120870649815,
            "Negative": 0.02242126874625683,
            "Neutral": 0.9736720323562622,
            "Mixed": 0.0010044765658676624
        }
    },
    "keyPhaseResults": {
        "KeyPhrases": [
            {
                "Score": 0.9999402761459351,
                "Text": "the interwar period",
                "BeginOffset": 11,
                "EndOffset": 30
            },
            {
                "Score": 0.9998807907104492,
                "Text": "elements",
                "BeginOffset": 32,
                "EndOffset": 40
            },
            {
                "Score": 0.9999830722808838,
                "Text": "the fleet",
                "BeginOffset": 44,
                "EndOffset": 53
            },
            {
                "Score": 0.996868908405304,
                "Text": "visits",
                "BeginOffset": 64,
                "EndOffset": 70
            },
            {
                "Score": 0.9997290968894958,
                "Text": "ports",
                "BeginOffset": 74,
                "EndOffset": 79
            },
            {
                "Score": 0.9998825192451477,
                "Text": "the Mediterranean",
                "BeginOffset": 91,
                "EndOffset": 108
            },
            {
                "Score": 0.9974275231361389,
                "Text": "few fleet exercises",
                "BeginOffset": 114,
                "EndOffset": 133
            },
            {
                "Score": 0.9996500611305237,
                "Text": "budget pressures",
                "BeginOffset": 150,
                "EndOffset": 166
            },
            {
                "Score": 0.9999716281890869,
                "Text": "1930",
                "BeginOffset": 171,
                "EndOffset": 175
            },
            {
                "Score": 0.9999449253082275,
                "Text": "the Maritime Air Force",
                "BeginOffset": 177,
                "EndOffset": 199
            },
            {
                "Score": 0.9945186972618103,
                "Text": "Royal Yugoslav Army control",
                "BeginOffset": 218,
                "EndOffset": 245
            },
            {
                "Score": 0.9999209046363831,
                "Text": "the naval air arm",
                "BeginOffset": 251,
                "EndOffset": 268
            },
            {
                "Score": 0.9999358654022217,
                "Text": "the establishment",
                "BeginOffset": 311,
                "EndOffset": 328
            },
            {
                "Score": 0.999833345413208,
                "Text": "bases",
                "BeginOffset": 332,
                "EndOffset": 337
            },
            {
                "Score": 0.9999572038650513,
                "Text": "the Adriatic coast",
                "BeginOffset": 344,
                "EndOffset": 362
            },
            {
                "Score": 0.999880313873291,
                "Text": "The following year",
                "BeginOffset": 364,
                "EndOffset": 382
            },
            {
                "Score": 0.9999604225158691,
                "Text": "a British-made flotilla leader",
                "BeginOffset": 384,
                "EndOffset": 414
            },
            {
                "Score": 0.9999598264694214,
                "Text": "the idea",
                "BeginOffset": 437,
                "EndOffset": 445
            },
            {
                "Score": 0.9998332262039185,
                "Text": "the KM",
                "BeginOffset": 451,
                "EndOffset": 457
            },
            {
                "Score": 0.9995250105857849,
                "Text": "the Mediterranean",
                "BeginOffset": 486,
                "EndOffset": 503
            },
            {
                "Score": 0.9987865686416626,
                "Text": "the British and French navies",
                "BeginOffset": 514,
                "EndOffset": 543
            }
        ]
    },
    "languageResults": {
        "Languages": [
            {
                "LanguageCode": "en",
                "Score": 0.9959194660186768
            }
        ]
    },
    "piiEntitiesResults": {
        "Entities": [
            {
                "Score": 0.9998798370361328,
                "Type": "DATE_TIME",
                "BeginOffset": 171,
                "EndOffset": 175
            }
        ]
    },
    "syntaxResults": {
        "SyntaxTokens": [
            {
                "TokenId": 1,
                "Text": "Throughout",
                "BeginOffset": 0,
                "EndOffset": 10,
                "PartOfSpeech": {
                    "Tag": "ADP",
                    "Score": 0.9987390041351318
                }
            },
            {
                "TokenId": 2,
                "Text": "the",
                "BeginOffset": 11,
                "EndOffset": 14,
                "PartOfSpeech": {
                    "Tag": "DET",
                    "Score": 0.9999986886978149
                }
            },
            {
                "TokenId": 3,
                "Text": "interwar",
                "BeginOffset": 15,
                "EndOffset": 23,
                "PartOfSpeech": {
                    "Tag": "ADJ",
                    "Score": 0.9636280536651611
                }
            },
            {
                "TokenId": 4,
                "Text": "period",
                "BeginOffset": 24,
                "EndOffset": 30,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9999498724937439
                }
            },
            {
                "TokenId": 5,
                "Text": ",",
                "BeginOffset": 30,
                "EndOffset": 31,
                "PartOfSpeech": {
                    "Tag": "PUNCT",
                    "Score": 0.9999992251396179
                }
            },
            {
                "TokenId": 6,
                "Text": "elements",
                "BeginOffset": 32,
                "EndOffset": 40,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9999023079872131
                }
            },
            {
                "TokenId": 7,
                "Text": "of",
                "BeginOffset": 41,
                "EndOffset": 43,
                "PartOfSpeech": {
                    "Tag": "ADP",
                    "Score": 0.9948706030845642
                }
            },
            {
                "TokenId": 8,
                "Text": "the",
                "BeginOffset": 44,
                "EndOffset": 47,
                "PartOfSpeech": {
                    "Tag": "DET",
                    "Score": 0.9999822378158569
                }
            },
            {
                "TokenId": 9,
                "Text": "fleet",
                "BeginOffset": 48,
                "EndOffset": 53,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9930176138877869
                }
            },
            {
                "TokenId": 10,
                "Text": "conducted",
                "BeginOffset": 54,
                "EndOffset": 63,
                "PartOfSpeech": {
                    "Tag": "VERB",
                    "Score": 0.9968438148498535
                }
            },
            {
                "TokenId": 11,
                "Text": "visits",
                "BeginOffset": 64,
                "EndOffset": 70,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9968258142471313
                }
            },
            {
                "TokenId": 12,
                "Text": "to",
                "BeginOffset": 71,
                "EndOffset": 73,
                "PartOfSpeech": {
                    "Tag": "ADP",
                    "Score": 0.9876771569252014
                }
            },
            {
                "TokenId": 13,
                "Text": "ports",
                "BeginOffset": 74,
                "EndOffset": 79,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9996002912521362
                }
            },
            {
                "TokenId": 14,
                "Text": "throughout",
                "BeginOffset": 80,
                "EndOffset": 90,
                "PartOfSpeech": {
                    "Tag": "ADP",
                    "Score": 0.9999434351921082
                }
            },
            {
                "TokenId": 15,
                "Text": "the",
                "BeginOffset": 91,
                "EndOffset": 94,
                "PartOfSpeech": {
                    "Tag": "DET",
                    "Score": 0.9999870657920837
                }
            },
            {
                "TokenId": 16,
                "Text": "Mediterranean",
                "BeginOffset": 95,
                "EndOffset": 108,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.9815877079963684
                }
            },
            {
                "TokenId": 17,
                "Text": ",",
                "BeginOffset": 108,
                "EndOffset": 109,
                "PartOfSpeech": {
                    "Tag": "PUNCT",
                    "Score": 1
                }
            },
            {
                "TokenId": 18,
                "Text": "but",
                "BeginOffset": 110,
                "EndOffset": 113,
                "PartOfSpeech": {
                    "Tag": "CONJ",
                    "Score": 0.9971989393234253
                }
            },
            {
                "TokenId": 19,
                "Text": "few",
                "BeginOffset": 114,
                "EndOffset": 117,
                "PartOfSpeech": {
                    "Tag": "ADJ",
                    "Score": 0.9997069239616394
                }
            },
            {
                "TokenId": 20,
                "Text": "fleet",
                "BeginOffset": 118,
                "EndOffset": 123,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9758131504058838
                }
            },
            {
                "TokenId": 21,
                "Text": "exercises",
                "BeginOffset": 124,
                "EndOffset": 133,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9999178647994995
                }
            },
            {
                "TokenId": 22,
                "Text": "occurred",
                "BeginOffset": 134,
                "EndOffset": 142,
                "PartOfSpeech": {
                    "Tag": "VERB",
                    "Score": 0.9996079206466675
                }
            },
            {
                "TokenId": 23,
                "Text": "due",
                "BeginOffset": 143,
                "EndOffset": 146,
                "PartOfSpeech": {
                    "Tag": "ADP",
                    "Score": 0.5574691295623779
                }
            },
            {
                "TokenId": 24,
                "Text": "to",
                "BeginOffset": 147,
                "EndOffset": 149,
                "PartOfSpeech": {
                    "Tag": "ADP",
                    "Score": 0.9967748522758484
                }
            },
            {
                "TokenId": 25,
                "Text": "budget",
                "BeginOffset": 150,
                "EndOffset": 156,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9974693655967712
                }
            },
            {
                "TokenId": 26,
                "Text": "pressures",
                "BeginOffset": 157,
                "EndOffset": 166,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.99986732006073
                }
            },
            {
                "TokenId": 27,
                "Text": ".",
                "BeginOffset": 166,
                "EndOffset": 167,
                "PartOfSpeech": {
                    "Tag": "PUNCT",
                    "Score": 0.999997079372406
                }
            },
            {
                "TokenId": 28,
                "Text": "In",
                "BeginOffset": 168,
                "EndOffset": 170,
                "PartOfSpeech": {
                    "Tag": "ADP",
                    "Score": 0.9999426603317261
                }
            },
            {
                "TokenId": 29,
                "Text": "1930",
                "BeginOffset": 171,
                "EndOffset": 175,
                "PartOfSpeech": {
                    "Tag": "NUM",
                    "Score": 0.998344361782074
                }
            },
            {
                "TokenId": 30,
                "Text": ",",
                "BeginOffset": 175,
                "EndOffset": 176,
                "PartOfSpeech": {
                    "Tag": "PUNCT",
                    "Score": 0.9999996423721313
                }
            },
            {
                "TokenId": 31,
                "Text": "the",
                "BeginOffset": 177,
                "EndOffset": 180,
                "PartOfSpeech": {
                    "Tag": "DET",
                    "Score": 0.9999690651893616
                }
            },
            {
                "TokenId": 32,
                "Text": "Maritime",
                "BeginOffset": 181,
                "EndOffset": 189,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.998085618019104
                }
            },
            {
                "TokenId": 33,
                "Text": "Air",
                "BeginOffset": 190,
                "EndOffset": 193,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.9992965459823608
                }
            },
            {
                "TokenId": 34,
                "Text": "Force",
                "BeginOffset": 194,
                "EndOffset": 199,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.9990269541740417
                }
            },
            {
                "TokenId": 35,
                "Text": "was",
                "BeginOffset": 200,
                "EndOffset": 203,
                "PartOfSpeech": {
                    "Tag": "AUX",
                    "Score": 0.9813507795333862
                }
            },
            {
                "TokenId": 36,
                "Text": "divorced",
                "BeginOffset": 204,
                "EndOffset": 212,
                "PartOfSpeech": {
                    "Tag": "VERB",
                    "Score": 0.9993037581443787
                }
            },
            {
                "TokenId": 37,
                "Text": "from",
                "BeginOffset": 213,
                "EndOffset": 217,
                "PartOfSpeech": {
                    "Tag": "ADP",
                    "Score": 0.9995124936103821
                }
            },
            {
                "TokenId": 38,
                "Text": "Royal",
                "BeginOffset": 218,
                "EndOffset": 223,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.9736484885215759
                }
            },
            {
                "TokenId": 39,
                "Text": "Yugoslav",
                "BeginOffset": 224,
                "EndOffset": 232,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.5458774566650391
                }
            },
            {
                "TokenId": 40,
                "Text": "Army",
                "BeginOffset": 233,
                "EndOffset": 237,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.9974660873413086
                }
            },
            {
                "TokenId": 41,
                "Text": "control",
                "BeginOffset": 238,
                "EndOffset": 245,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9929476380348206
                }
            },
            {
                "TokenId": 42,
                "Text": ",",
                "BeginOffset": 245,
                "EndOffset": 246,
                "PartOfSpeech": {
                    "Tag": "PUNCT",
                    "Score": 0.9999992251396179
                }
            },
            {
                "TokenId": 43,
                "Text": "and",
                "BeginOffset": 247,
                "EndOffset": 250,
                "PartOfSpeech": {
                    "Tag": "CONJ",
                    "Score": 0.9999973177909851
                }
            },
            {
                "TokenId": 44,
                "Text": "the",
                "BeginOffset": 251,
                "EndOffset": 254,
                "PartOfSpeech": {
                    "Tag": "DET",
                    "Score": 0.999994695186615
                }
            },
            {
                "TokenId": 45,
                "Text": "naval",
                "BeginOffset": 255,
                "EndOffset": 260,
                "PartOfSpeech": {
                    "Tag": "ADJ",
                    "Score": 0.9896062016487122
                }
            },
            {
                "TokenId": 46,
                "Text": "air",
                "BeginOffset": 261,
                "EndOffset": 264,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9989261627197266
                }
            },
            {
                "TokenId": 47,
                "Text": "arm",
                "BeginOffset": 265,
                "EndOffset": 268,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9999770522117615
                }
            },
            {
                "TokenId": 48,
                "Text": "began",
                "BeginOffset": 269,
                "EndOffset": 274,
                "PartOfSpeech": {
                    "Tag": "VERB",
                    "Score": 0.9998490810394287
                }
            },
            {
                "TokenId": 49,
                "Text": "to",
                "BeginOffset": 275,
                "EndOffset": 277,
                "PartOfSpeech": {
                    "Tag": "PART",
                    "Score": 0.9997002482414246
                }
            },
            {
                "TokenId": 50,
                "Text": "develop",
                "BeginOffset": 278,
                "EndOffset": 285,
                "PartOfSpeech": {
                    "Tag": "VERB",
                    "Score": 0.9999859929084778
                }
            },
            {
                "TokenId": 51,
                "Text": "significantly",
                "BeginOffset": 286,
                "EndOffset": 299,
                "PartOfSpeech": {
                    "Tag": "ADV",
                    "Score": 0.999842643737793
                }
            },
            {
                "TokenId": 52,
                "Text": ",",
                "BeginOffset": 299,
                "EndOffset": 300,
                "PartOfSpeech": {
                    "Tag": "PUNCT",
                    "Score": 0.9999997019767761
                }
            },
            {
                "TokenId": 53,
                "Text": "including",
                "BeginOffset": 301,
                "EndOffset": 310,
                "PartOfSpeech": {
                    "Tag": "VERB",
                    "Score": 0.9999694228172302
                }
            },
            {
                "TokenId": 54,
                "Text": "the",
                "BeginOffset": 311,
                "EndOffset": 314,
                "PartOfSpeech": {
                    "Tag": "DET",
                    "Score": 0.9999970197677612
                }
            },
            {
                "TokenId": 55,
                "Text": "establishment",
                "BeginOffset": 315,
                "EndOffset": 328,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9996310472488403
                }
            },
            {
                "TokenId": 56,
                "Text": "of",
                "BeginOffset": 329,
                "EndOffset": 331,
                "PartOfSpeech": {
                    "Tag": "ADP",
                    "Score": 0.9995364546775818
                }
            },
            {
                "TokenId": 57,
                "Text": "bases",
                "BeginOffset": 332,
                "EndOffset": 337,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9997947216033936
                }
            },
            {
                "TokenId": 58,
                "Text": "along",
                "BeginOffset": 338,
                "EndOffset": 343,
                "PartOfSpeech": {
                    "Tag": "ADP",
                    "Score": 0.9997931718826294
                }
            },
            {
                "TokenId": 59,
                "Text": "the",
                "BeginOffset": 344,
                "EndOffset": 347,
                "PartOfSpeech": {
                    "Tag": "DET",
                    "Score": 0.999996542930603
                }
            },
            {
                "TokenId": 60,
                "Text": "Adriatic",
                "BeginOffset": 348,
                "EndOffset": 356,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.636817991733551
                }
            },
            {
                "TokenId": 61,
                "Text": "coast",
                "BeginOffset": 357,
                "EndOffset": 362,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9922339916229248
                }
            },
            {
                "TokenId": 62,
                "Text": ".",
                "BeginOffset": 362,
                "EndOffset": 363,
                "PartOfSpeech": {
                    "Tag": "PUNCT",
                    "Score": 0.999999463558197
                }
            },
            {
                "TokenId": 63,
                "Text": "The",
                "BeginOffset": 364,
                "EndOffset": 367,
                "PartOfSpeech": {
                    "Tag": "DET",
                    "Score": 0.9999522566795349
                }
            },
            {
                "TokenId": 64,
                "Text": "following",
                "BeginOffset": 368,
                "EndOffset": 377,
                "PartOfSpeech": {
                    "Tag": "VERB",
                    "Score": 0.7211319804191589
                }
            },
            {
                "TokenId": 65,
                "Text": "year",
                "BeginOffset": 378,
                "EndOffset": 382,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.999933123588562
                }
            },
            {
                "TokenId": 66,
                "Text": ",",
                "BeginOffset": 382,
                "EndOffset": 383,
                "PartOfSpeech": {
                    "Tag": "PUNCT",
                    "Score": 0.9999996423721313
                }
            },
            {
                "TokenId": 67,
                "Text": "a",
                "BeginOffset": 384,
                "EndOffset": 385,
                "PartOfSpeech": {
                    "Tag": "DET",
                    "Score": 0.9999603629112244
                }
            },
            {
                "TokenId": 68,
                "Text": "British",
                "BeginOffset": 386,
                "EndOffset": 393,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.6344547271728516
                }
            },
            {
                "TokenId": 69,
                "Text": "-",
                "BeginOffset": 393,
                "EndOffset": 394,
                "PartOfSpeech": {
                    "Tag": "PUNCT",
                    "Score": 0.9999788403511047
                }
            },
            {
                "TokenId": 70,
                "Text": "made",
                "BeginOffset": 394,
                "EndOffset": 398,
                "PartOfSpeech": {
                    "Tag": "VERB",
                    "Score": 0.999243974685669
                }
            },
            {
                "TokenId": 71,
                "Text": "flotilla",
                "BeginOffset": 399,
                "EndOffset": 407,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9894526600837708
                }
            },
            {
                "TokenId": 72,
                "Text": "leader",
                "BeginOffset": 408,
                "EndOffset": 414,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9999657273292542
                }
            },
            {
                "TokenId": 73,
                "Text": "was",
                "BeginOffset": 415,
                "EndOffset": 418,
                "PartOfSpeech": {
                    "Tag": "AUX",
                    "Score": 0.9911738634109497
                }
            },
            {
                "TokenId": 74,
                "Text": "commissioned",
                "BeginOffset": 419,
                "EndOffset": 431,
                "PartOfSpeech": {
                    "Tag": "VERB",
                    "Score": 0.9993489980697632
                }
            },
            {
                "TokenId": 75,
                "Text": "with",
                "BeginOffset": 432,
                "EndOffset": 436,
                "PartOfSpeech": {
                    "Tag": "ADP",
                    "Score": 0.9970481991767883
                }
            },
            {
                "TokenId": 76,
                "Text": "the",
                "BeginOffset": 437,
                "EndOffset": 440,
                "PartOfSpeech": {
                    "Tag": "DET",
                    "Score": 0.9999901056289673
                }
            },
            {
                "TokenId": 77,
                "Text": "idea",
                "BeginOffset": 441,
                "EndOffset": 445,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9999324679374695
                }
            },
            {
                "TokenId": 78,
                "Text": "that",
                "BeginOffset": 446,
                "EndOffset": 450,
                "PartOfSpeech": {
                    "Tag": "SCONJ",
                    "Score": 0.9598349928855896
                }
            },
            {
                "TokenId": 79,
                "Text": "the",
                "BeginOffset": 451,
                "EndOffset": 454,
                "PartOfSpeech": {
                    "Tag": "DET",
                    "Score": 0.9999749064445496
                }
            },
            {
                "TokenId": 80,
                "Text": "KM",
                "BeginOffset": 455,
                "EndOffset": 457,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.949669361114502
                }
            },
            {
                "TokenId": 81,
                "Text": "might",
                "BeginOffset": 458,
                "EndOffset": 463,
                "PartOfSpeech": {
                    "Tag": "AUX",
                    "Score": 0.9999860525131226
                }
            },
            {
                "TokenId": 82,
                "Text": "be",
                "BeginOffset": 464,
                "EndOffset": 466,
                "PartOfSpeech": {
                    "Tag": "VERB",
                    "Score": 0.9996456503868103
                }
            },
            {
                "TokenId": 83,
                "Text": "able",
                "BeginOffset": 467,
                "EndOffset": 471,
                "PartOfSpeech": {
                    "Tag": "ADJ",
                    "Score": 0.9999683499336243
                }
            },
            {
                "TokenId": 84,
                "Text": "to",
                "BeginOffset": 472,
                "EndOffset": 474,
                "PartOfSpeech": {
                    "Tag": "PART",
                    "Score": 0.9996376037597656
                }
            },
            {
                "TokenId": 85,
                "Text": "operate",
                "BeginOffset": 475,
                "EndOffset": 482,
                "PartOfSpeech": {
                    "Tag": "VERB",
                    "Score": 0.9999722838401794
                }
            },
            {
                "TokenId": 86,
                "Text": "in",
                "BeginOffset": 483,
                "EndOffset": 485,
                "PartOfSpeech": {
                    "Tag": "ADP",
                    "Score": 0.9986878633499146
                }
            },
            {
                "TokenId": 87,
                "Text": "the",
                "BeginOffset": 486,
                "EndOffset": 489,
                "PartOfSpeech": {
                    "Tag": "DET",
                    "Score": 0.9999935626983643
                }
            },
            {
                "TokenId": 88,
                "Text": "Mediterranean",
                "BeginOffset": 490,
                "EndOffset": 503,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.968278169631958
                }
            },
            {
                "TokenId": 89,
                "Text": "alongside",
                "BeginOffset": 504,
                "EndOffset": 513,
                "PartOfSpeech": {
                    "Tag": "ADP",
                    "Score": 0.9560133218765259
                }
            },
            {
                "TokenId": 90,
                "Text": "the",
                "BeginOffset": 514,
                "EndOffset": 517,
                "PartOfSpeech": {
                    "Tag": "DET",
                    "Score": 0.9999886155128479
                }
            },
            {
                "TokenId": 91,
                "Text": "British",
                "BeginOffset": 518,
                "EndOffset": 525,
                "PartOfSpeech": {
                    "Tag": "ADJ",
                    "Score": 0.973266065120697
                }
            },
            {
                "TokenId": 92,
                "Text": "and",
                "BeginOffset": 526,
                "EndOffset": 529,
                "PartOfSpeech": {
                    "Tag": "CONJ",
                    "Score": 0.9998942613601685
                }
            },
            {
                "TokenId": 93,
                "Text": "French",
                "BeginOffset": 530,
                "EndOffset": 536,
                "PartOfSpeech": {
                    "Tag": "ADJ",
                    "Score": 0.9976128339767456
                }
            },
            {
                "TokenId": 94,
                "Text": "navies",
                "BeginOffset": 537,
                "EndOffset": 543,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9999626874923706
                }
            },
            {
                "TokenId": 95,
                "Text": ".",
                "BeginOffset": 543,
                "EndOffset": 544,
                "PartOfSpeech": {
                    "Tag": "PUNCT",
                    "Score": 0.9999978542327881
                }
            }
        ]
    }
}`;
        responsedataprocessing(JSON.parse(testdataobject));
        showentitytab();
        inputChange();
        payloadDataToHTMLDiv();

        function callcomprehend() {
            temp = document.getElementById("comprehendtextara").value;

            if (textfromarea.length < 30) {
                alert('Minimum 30 charecter long text required');
                return false;
            } else if (temp.trim() == textfromarea.trim()) {
                return false;
            }
            document.getElementById("btnAnalyze").style.display = "none";
            document.getElementById("btnanalyzing").style.display = "block";
            textfromarea = document.getElementById("comprehendtextara").value;


            var requestOptions = {
                method: 'POST',
                redirect: 'follow'
            };

            fetch(localhost + "/api/comprehend?text=" + textfromarea,
                    requestOptions)
                .then(response => {
                    if (response.ok) {
                        return response.json()
                        console.log("ok");
                    } else {

                        console.log("erropr");
                        throw new Error();
                    }
                })
                .then(result => {
                    console.log(result)
                    responsedataprocessing(result);
                    showentitytab();

                    document.getElementById("btnAnalyze").style.display = "block";
                    document.getElementById("btnanalyzing").style.display = "none";
                    // console.log(result.Entities);
                })
                .catch(error => {
                    alert('something went wrong,try again later');
                    document.getElementById("btnAnalyze").style.display = "block";
                    document.getElementById("btnanalyzing").style.display = "none";
                    console.log('error', error)
                });
        }

        function responsedataprocessing(data) {

            entities = data.entities.Entities;
            sentiment = data.sentiment;
            languages = data.languageResults.Languages;
            piidata = data.piiEntitiesResults.Entities;
            piioffsetentities = data.piiEntitiesResults.Entities;
            piilabelentities = data.piiEntitiesResults.Entities;
            syntaxtokens = data.syntaxResults.SyntaxTokens;
            keyPhrases = data.keyPhaseResults.KeyPhrases;

            entitydataprocessing(entities);
            keyphrasedataprocessing(keyPhrases);
            languagedataprocessing(languages);
            piioffsetdataprocessing(piioffsetentities);
            piilabeldataprocessing(piilabelentities);
            sentimentdataprocessing(sentiment);
            syntaxdataprocessing(syntaxtokens);
        }

        function cleartext() {
            document.getElementById("comprehendtextara").value = '';
        }

        function entitydataprocessing(data) {
            // alert("called");
            var count = data.length;
            var entitytable = document.getElementById("entitytablebody");
            entitytable.innerHTML = "";
            var temp_textfromarea = textfromarea;
            for (let index = 0; index < count; index++) {
                var row = entitytable.insertRow(index);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                entity = data[index].Text;
                entitytype = data[index].Type;
                // 'entity':'type' array for formate disabled text
                entityTypeArray[entity] = entitytype;

                //column 1 filling
                cell1.innerHTML = entity;

                // result field to get replaced string
                let result = '';

                //column 2 filling & styling based on type of
                if (entitytype == "PERSON") {
                    cell2.innerHTML = `<span class="line bc-entiry-person"></span>
                                    Person`;

                    result = temp_textfromarea.replaceAll(entity, `<span class="bb-entiry-person">` + entity +
                        "</span>");
                } else if (entitytype == "ORGANIZATION") {
                    cell2.innerHTML = `<span class="line bc-entiry-organization"></span>
                                    Organization`;
                    result = temp_textfromarea.replaceAll(entity, `<span class="bb-entiry-organization">` +
                        entity +
                        "</span>");
                } else if (entitytype == "QUANTITY") {
                    cell2.innerHTML = `<span class="line bc-entiry-quantity"></span>
                                    Quantity`;

                    result = temp_textfromarea.replaceAll(entity, `<span class="bb-entiry-quantity">` + entity +
                        "</span>");
                } else if (entitytype == "DATE") {
                    cell2.innerHTML = `<span class="line bc-entiry-date"></span>
                                    Date`;
                    result = temp_textfromarea.replaceAll(entity, `<span class="bb-entiry-date">` + entity +
                        "</span>");
                } else if (entitytype == "LOCATION") {
                    cell2.innerHTML = `<span class="line bc-entiry-location"></span>
                                    Location`;
                    result = temp_textfromarea.replaceAll(entity, `<span class="bb-entiry-location">` + entity +
                        "</span>");
                } else {
                    cell2.innerHTML = `<span class="line bc-entiry-other"></span>
                                    Other`;
                    result = temp_textfromarea.replaceAll(entity, `<span class="bb-entiry-other">` + entity +
                        "</span>");
                }
                temp_textfromarea = result;

                //column 3 filling
                score = data[index].Score;
                // fixedScore =
                // score = score * 100;
                cell3.innerHTML = scoreRound(score);
            } //for end

            document.getElementById("entity_textaradisabled").innerHTML = temp_textfromarea;
            // createpagination('paginationentity', entities, 'entities', 1);

        } //funends

        function scoreRound(score) {
            return score.toString().substr(0, 4)
        } //funends


        function languagedataprocessing(data) {
            var count = data.length;
            var tablebodyObj = document.getElementById("languagetablebody");
            tablebodyObj.innerHTML = "";

            for (let index = 0; index < count; index++) {
                var row = tablebodyObj.insertRow(index);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                cell1.innerHTML = data[index].LanguageCode;
                // cell2.innerHTML = data[index].Score;
                cell2.innerHTML = scoreRound(data[index].Score);
            }
            document.getElementById("language_textaradisabled").innerHTML = textfromarea;
            updateHTML_response(JSON.stringify(data, null, '\t'));

        }

        function keyphrasedataprocessing(data) {
            // console.log(data.KeyPhrases.length);
            var count = data.length;
            var tablebodyObj = document.getElementById("keyphrasebody");
            tablebodyObj.innerHTML = "";

            // console.log(data.KeyPhrases);

            //value from textarea i.e user input
            var temp_textfromarea = textfromarea;
            // result field to get replaced string
            let result = '';
            for (let index = 0; index < count; index++) {
                var row = tablebodyObj.insertRow(index);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                phrase = data[index].Text;
                // filling fields
                cell1.innerHTML = phrase;
                cell2.innerHTML = scoreRound(data[index].Score);

                // replacing normal text to styled text
                result = temp_textfromarea.replaceAll(phrase, `<span class="bb-entiry-person">` + phrase +
                    "</span>");
                temp_textfromarea = result;
            }
            document.getElementById("keyphrase_textaradisabled").innerHTML = temp_textfromarea;
            // updateHTML_response(JSON.stringify(data, null, '\t'));


        }

        function piioffsetdataprocessing(data) {
            var count = data.length;


            // object of table used for PII offset
            var tablebodyObj2 = document.getElementById("tbody_piioffset");
            tablebodyObj2.innerHTML = "";

            //value from textarea i.e user input
            var temp_textfromarea = textfromarea;
            // result field to get replaced string
            let result = '';

            for (let index = 0; index < count; index++) {
                // as in PII response no TEXT filed mentioned ,
                //      using BeginOffset and EndOffset to extarct Text from orginal input

                // text start and end of text
                start = data[index].BeginOffset;
                end = data[index].EndOffset;
                // console.log(start + ' ' + end);
                text = textfromarea.substring(start, end);

                // adding extarcted text to orginal data(response received from API)
                data[index].Text = text;

                // console.log(text);

                // highliting text from disabled text area
                // replacing normal text to styled text
                result = temp_textfromarea.replaceAll(text, `<span class="bb-entiry-location">` + text +
                    "</span>");
                temp_textfromarea = result;

                // filling table data
                var row2 = tablebodyObj2.insertRow(index);
                var row2_cell1 = row2.insertCell(0);
                var row2_cell2 = row2.insertCell(1);
                var row2_cell3 = row2.insertCell(2);
                row2_cell1.innerHTML = text;
                row2_cell2.innerHTML = data[index].Type;
                row2_cell3.innerHTML = scoreRound(data[index].Score);
            }
            document.getElementById("piioffset_textaradisabled").innerHTML = temp_textfromarea;
            // updateHTML_response(JSON.stringify(data, null, '\t'));

        }

        function piilabeldataprocessing(data) {
            var count = data.length;

            // object of table used for PII label
            var tablebodyObj = document.getElementById("piitablebody");
            tablebodyObj.innerHTML = "";

            for (let index = 0; index < count; index++) {

                // filling label table
                var row = tablebodyObj.insertRow(index);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                cell1.innerHTML = data[index].Type;
                cell2.innerHTML = scoreRound(data[index].Score);
            }
            // updateHTML_response(JSON.stringify(data, null, '\t'));

        }

        function sentimentdataprocessing(data) {

            var tablebodyObj = document.getElementById("tbodysentimenttable");
            tablebodyObj.innerHTML = "";

            console.log(data);

            if (data) {
                var row = tablebodyObj.insertRow(0);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                cell1.innerHTML = "Positive";
                cell2.innerHTML = scoreRound(data.SentimentScore.Positive);

                var row = tablebodyObj.insertRow(1);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                cell1.innerHTML = "Negative";
                cell2.innerHTML = scoreRound(data.SentimentScore.Negative);

                var row = tablebodyObj.insertRow(2);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                cell1.innerHTML = "Neutral";
                cell2.innerHTML = scoreRound(data.SentimentScore.Neutral);

                var row = tablebodyObj.insertRow(3);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                cell1.innerHTML = "Mixed";
                cell2.innerHTML = scoreRound(data.SentimentScore.Mixed);
            }
            document.getElementById("sentiment_textaradisabled").innerHTML = textfromarea;
            // updateHTML_response(JSON.stringify(data, null, '\t'));

        }

        function syntaxdataprocessing(data) {
            var count = data.length;
            var tableobj = document.getElementById("tbodysyntaxtable");
            tableobj.innerHTML = "";
            var textstyled = '';
            var temp_textfromarea = textfromarea;

            for (let index = 0; index < count; index++) {
                var row = tableobj.insertRow(index);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);


                cell1.innerHTML = data[index].Text;
                text = data[index].Text;

                result = temp_textfromarea.replaceAll(text, `<span class="hoveronspan">` + text +
                    "</span>");

                temp_textfromarea = result;


                cell2.innerHTML = data[index].PartOfSpeech.Tag;
                cell3.innerHTML = scoreRound(data[index].PartOfSpeech.Score);
            }
            document.getElementById("syntax_textaradisabled").innerHTML = temp_textfromarea;
        }

        function addclass(id, className) {
            for (let index = 0; index < 6; index++) {
                document.getElementsByClassName("tab")[index].classList.remove(className);
            }
            var obj = document.getElementById(id);
            obj.classList.add(className);
        }

        function showentitytab() {
            addclass("a_tab_entity", "active");
            document.getElementsByClassName('divtoggleentity')[0].style.display = 'block';
            document.getElementsByClassName('divtoggleentity')[1].style.display = 'block';

            document.getElementsByClassName("divtogglekeyphrase")[0].style.display = 'none';
            document.getElementsByClassName("divtogglekeyphrase")[1].style.display = 'none';

            document.getElementsByClassName("divtogglekeypii")[0].style.display = 'none';
            document.getElementsByClassName("divtogglekeypii")[1].style.display = 'none';
            document.getElementsByClassName("divtogglekeypii")[2].style.display = 'none';
            document.getElementsByClassName("divtogglekeypii")[3].style.display = 'none';

            document.getElementsByClassName("divtogglelanguage")[0].style.display = 'none';
            document.getElementsByClassName("divtogglelanguage")[1].style.display = 'none';

            document.getElementsByClassName("divtogglesentiment")[0].style.display = 'none';
            document.getElementsByClassName("divtogglesentiment")[1].style.display = 'none';

            document.getElementsByClassName("divtogglesyntax")[0].style.display = 'none';
            document.getElementsByClassName("divtogglesyntax")[1].style.display = 'none';
            updateHTML_response(JSON.stringify(entities, null, '\t'));
            createpagination('paginationentity', entities, 'entities', 1);
        }

        function showphrasetab() {
            addclass("a_tab_phrase", "active");
            document.getElementsByClassName('divtoggleentity')[0].style.display = 'none';
            document.getElementsByClassName('divtoggleentity')[1].style.display = 'none';

            document.getElementsByClassName("divtogglekeyphrase")[0].style.display = 'block';
            document.getElementsByClassName("divtogglekeyphrase")[1].style.display = 'block';

            document.getElementsByClassName("divtogglekeypii")[0].style.display = 'none';
            document.getElementsByClassName("divtogglekeypii")[1].style.display = 'none';
            document.getElementsByClassName("divtogglekeypii")[2].style.display = 'none';
            document.getElementsByClassName("divtogglekeypii")[3].style.display = 'none';

            document.getElementsByClassName("divtogglelanguage")[0].style.display = 'none';
            document.getElementsByClassName("divtogglelanguage")[1].style.display = 'none';

            document.getElementsByClassName("divtogglesentiment")[0].style.display = 'none';
            document.getElementsByClassName("divtogglesentiment")[1].style.display = 'none';

            document.getElementsByClassName("divtogglesyntax")[0].style.display = 'none';
            document.getElementsByClassName("divtogglesyntax")[1].style.display = 'none';
            updateHTML_response(JSON.stringify(keyPhrases, null, '\t'));
            createpagination('paginationtblkeyphrase', keyPhrases, 'keyPhrases', 2);

        }

        function showlanguagetab() {
            addclass("a_tab_language", "active");
            document.getElementsByClassName('divtoggleentity')[0].style.display = 'none';
            document.getElementsByClassName('divtoggleentity')[1].style.display = 'none';

            document.getElementsByClassName("divtogglekeyphrase")[0].style.display = 'none';
            document.getElementsByClassName("divtogglekeyphrase")[1].style.display = 'none';

            document.getElementsByClassName("divtogglekeypii")[0].style.display = 'none';
            document.getElementsByClassName("divtogglekeypii")[1].style.display = 'none';
            document.getElementsByClassName("divtogglekeypii")[2].style.display = 'none';
            document.getElementsByClassName("divtogglekeypii")[3].style.display = 'none';

            document.getElementsByClassName("divtogglelanguage")[0].style.display = 'block';
            document.getElementsByClassName("divtogglelanguage")[1].style.display = 'block';

            document.getElementsByClassName("divtogglesentiment")[0].style.display = 'none';
            document.getElementsByClassName("divtogglesentiment")[1].style.display = 'none';

            document.getElementsByClassName("divtogglesyntax")[0].style.display = 'none';
            document.getElementsByClassName("divtogglesyntax")[1].style.display = 'none';
            updateHTML_response(JSON.stringify(languages, null, '\t'));

        }

        function showpiitab() {
            addclass("a_tab_pii", "active");
            document.getElementsByClassName('divtoggleentity')[0].style.display = 'none';
            document.getElementsByClassName('divtoggleentity')[1].style.display = 'none';

            document.getElementsByClassName("divtogglekeyphrase")[0].style.display = 'none';
            document.getElementsByClassName("divtogglekeyphrase")[1].style.display = 'none';

            document.getElementsByClassName("divtogglekeypii")[0].style.display = 'block';
            document.getElementsByClassName("divtogglekeypii")[1].style.display = 'block';
            document.getElementsByClassName("divtogglekeypii")[2].style.display = 'block';
            document.getElementsByClassName("divtogglekeypii")[3].style.display = 'block';

            document.getElementsByClassName("divtogglelanguage")[0].style.display = 'none';
            document.getElementsByClassName("divtogglelanguage")[1].style.display = 'none';

            document.getElementsByClassName("divtogglesentiment")[0].style.display = 'none';
            document.getElementsByClassName("divtogglesentiment")[1].style.display = 'none';

            document.getElementsByClassName("divtogglesyntax")[0].style.display = 'none';
            document.getElementsByClassName("divtogglesyntax")[1].style.display = 'none';
            togglepiioptions();
            updateHTML_response(JSON.stringify(piidata, null, '\t'));

        }

        function showsentimenttab() {
            addclass("a_tab_sentiment", "active");
            document.getElementsByClassName('divtoggleentity')[0].style.display = 'none';
            document.getElementsByClassName('divtoggleentity')[1].style.display = 'none';

            document.getElementsByClassName("divtogglekeyphrase")[0].style.display = 'none';
            document.getElementsByClassName("divtogglekeyphrase")[1].style.display = 'none';

            document.getElementsByClassName("divtogglekeypii")[0].style.display = 'none';
            document.getElementsByClassName("divtogglekeypii")[1].style.display = 'none';
            document.getElementsByClassName("divtogglekeypii")[2].style.display = 'none';
            document.getElementsByClassName("divtogglekeypii")[3].style.display = 'none';

            document.getElementsByClassName("divtogglelanguage")[0].style.display = 'none';
            document.getElementsByClassName("divtogglelanguage")[1].style.display = 'none';

            document.getElementsByClassName("divtogglesentiment")[0].style.display = 'block';
            document.getElementsByClassName("divtogglesentiment")[1].style.display = 'block';

            document.getElementsByClassName("divtogglesyntax")[0].style.display = 'none';
            document.getElementsByClassName("divtogglesyntax")[1].style.display = 'none';
            updateHTML_response(JSON.stringify(sentiment, null, '\t'));

        }

        function showsyntaxtab() {
            addclass("a_tab_syntax", "active");

            document.getElementsByClassName('divtoggleentity')[0].style.display = 'none';
            document.getElementsByClassName('divtoggleentity')[1].style.display = 'none';

            document.getElementsByClassName("divtogglekeyphrase")[0].style.display = 'none';
            document.getElementsByClassName("divtogglekeyphrase")[1].style.display = 'none';

            document.getElementsByClassName("divtogglekeypii")[0].style.display = 'none';
            document.getElementsByClassName("divtogglekeypii")[1].style.display = 'none';
            document.getElementsByClassName("divtogglekeypii")[2].style.display = 'none';
            document.getElementsByClassName("divtogglekeypii")[3].style.display = 'none';

            document.getElementsByClassName("divtogglelanguage")[0].style.display = 'none';
            document.getElementsByClassName("divtogglelanguage")[1].style.display = 'none';

            document.getElementsByClassName("divtogglesentiment")[0].style.display = 'none';
            document.getElementsByClassName("divtogglesentiment")[1].style.display = 'none';

            document.getElementsByClassName("divtogglesyntax")[0].style.display = 'block';
            document.getElementsByClassName("divtogglesyntax")[1].style.display = 'block';
            updateHTML_response(JSON.stringify(syntaxtokens, null, '\t'));
            createpagination('paginationsyntax', syntaxtokens, 'syntaxtokens', 5);

        }

        function togglepiioptions() {
            radios = document.getElementsByName('piioptions');
            var selected = Array.from(radios).find(radio => radio.checked);

            if (selected.value == 'offset') {
                document.getElementsByClassName('divtogglekeypii')[1].style.display = 'block';
                document.getElementsByClassName('divtogglekeypii')[2].style.display = 'none';
                document.getElementsByClassName('divtogglekeypii')[3].style.display = 'block';
                createpagination('paginationpiioffset', piioffsetentities, 'piioffsetentities', 3);


            } else {
                document.getElementsByClassName('divtogglekeypii')[1].style.display = 'none';
                document.getElementsByClassName('divtogglekeypii')[2].style.display = 'block';
                document.getElementsByClassName('divtogglekeypii')[3].style.display = 'none';
                createpagination('paginationpiilabel', piilabelentities, 'piilabelentities', 4);

            }


        }

        function entitidata_filter() {
            var searchvalue = document.getElementById('searchentity').value;
            searchvalue = searchvalue.toUpperCase();
            datavalues = Object.values(entities);

            var text_filter = datavalues.filter(element => ((element.Text).toUpperCase()).search(searchvalue) != -1);

            var type_filter = (text_filter.length == 0 ? datavalues : text_filter).filter(element => ((element.Type)
                .toUpperCase()).search(searchvalue) != -1);


            if (text_filter.length == 0 && type_filter.length == 0) {
                tempentities = datavalues;
            } else if (type_filter.length == 0) {
                tempentities = text_filter;
            } else {
                tempentities = type_filter;
            }

            entitydataprocessing(tempentities);
            createpagination('paginationentity', tempentities, 'tempentities', 1);

        }

        function keyphrase_filter() {
            var searchvalue = document.getElementById('keyphrasetext').value;
            searchvalue = searchvalue.toUpperCase();

            datavalues = Object.values(keyPhrases);
            // console.log(datavalues);

            var text_filter = datavalues.filter(element => ((element.Text).toUpperCase()).search(searchvalue) != -1);
            // console.log(text_filter.length);

            tempentities = text_filter.length == 0 ? datavalues : text_filter;

            // console.log(tempentities);
            keyphrasedataprocessing(tempentities);
            createpagination('paginationtblkeyphrase', tempentities, 'tempentities', 2);

        }

        function syntax_filter() {
            var searchvalue = document.getElementById('syntaxseachtext').value;
            searchvalue = searchvalue.toUpperCase();
            // console.log(searchvalue);
            datavalues = Object.values(syntaxtokens);
            // console.log(datavalues);

            var text_filter = datavalues.filter(element => ((element.Text).toUpperCase()).search(searchvalue) != -1);
            console.log(text_filter.length);

            var tag_filter = (text_filter.length == 0 ? datavalues : text_filter).filter(element => ((element.PartOfSpeech
                    .Tag)
                .toUpperCase()).search(searchvalue) != -1);
            console.log(tag_filter.length);


            if (text_filter.length == 0 && tag_filter.length == 0) {
                temdata = datavalues;
            } else if (tag_filter.length == 0) {
                temdata = text_filter;
            } else {
                temdata = tag_filter;
            }

            // console.log(temdata);
            syntaxdataprocessing(temdata);
            createpagination('paginationsyntax', temdata, 'tempentities', 5);

        }


        function piioffset_filter() {
            var searchvalue = document.getElementById('piioffsetseachtext').value;
            searchvalue = searchvalue.toUpperCase();
            console.log(searchvalue);
            datavalues = Object.values(piioffsetentities);
            console.log(datavalues);

            var text_filter = datavalues.filter(element => ((element.Text).toUpperCase()).search(searchvalue) != -1);
            console.log(text_filter.length);

            var type_filter = (text_filter.length == 0 ? datavalues : text_filter).filter(element => ((element.Type)
                .toUpperCase()).search(searchvalue) != -1);
            console.log(type_filter.length);


            if (text_filter.length == 0 && type_filter.length == 0) {
                temdata = datavalues;
            } else if (type_filter.length == 0) {
                temdata = text_filter;
            } else {
                temdata = type_filter;
            }

            console.log(temdata);
            piioffsetdataprocessing(temdata);
            createpagination('paginationpiioffset', temdata, 'tempentities', 3);
        }

        function piilablset_filter() {
            var searchvalue = document.getElementById('piilabelsearchtext').value;
            searchvalue = searchvalue.toUpperCase();
            console.log(searchvalue);
            datavalues = Object.values(piioffsetentities);
            console.log(datavalues);

            var type_filter = datavalues.filter(element => ((element.Type)
                .toUpperCase()).search(searchvalue) != -1);
            console.log(type_filter.length);

            temdata = type_filter.length == 0 ? datavalues : type_filter;
            console.log(temdata);
            piilabeldataprocessing(temdata);
            createpagination('paginationpiilabel', temdata, 'tempentities', 4);
        }

        function copytext(element) {
            // Get the text field
            if (element == 1) {
                copyText = payloaddata;
            } else {
                copyText = responseload;
            }

            // Select the text field
            // copyText.select();
            // copyText.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText);

            // Alert the copied text
            alert("Copied the text: " + copyText);
        }
        //now
        function paginationwork(element, data, page, tablenumber) {
            // console.log(element + "  " + page + " current " + currentpage);

            if (page == 'pre') {
                page = currentpage - 1;
                page = page < 1 ? 1 : page;
            } else if (page == 'next') {
                page = currentpage + 1;
                page = page > pages ? pages : page;
            }
            currentpage = page;
            // console.log("  updated " + page);

            start = (page * perpage) - perpage;
            start = start < 0 ? 0 : start;
            end = (page * perpage) - 1;
            console.log(start + "/" + end);
            var tempdata = [];
            let index2 = 0;
            for (let index = start; index <= end; index++) {
                if (data[index]) {
                    tempdata[index2] = data[index];
                    index2++;
                } else {
                    break;
                }
            }

            elementname = element.split('-')[0];
            for (let index = 1; index <= pages; index++) {
                elementid = elementname + "-" + index;
                // console.log("generatedid " + elementid);
                if (index == page) {
                    var element = document.getElementById(elementid);
                    element.classList.add("selected");

                } else {
                    var element = document.getElementById(elementid);
                    element.classList.remove("selected");
                }

            }


            switch (tablenumber) {
                case 1:
                    entitydataprocessing(tempdata);
                    break;

                case 2:
                    keyphrasedataprocessing(tempdata);
                    break;

                case 3:
                    piioffsetdataprocessing(tempdata);
                    break;


                case 4:
                    piilabeldataprocessing(tempdata);
                    break;


                default:
                    syntaxdataprocessing(tempdata);
            }


        }

        function createpagination(element, data, datasetname, tablenumber) {
            // console.log(data);
            let elementobj = document.getElementById(element);
            elementobj.innerHTML = '';
            pages = data.length / perpage;
            pages = Math.ceil(pages);
            console.log("pages " + pages);


            elementobj.innerHTML += `<span id="previous" ` + `onclick="paginationwork('` +
                element + `',` + datasetname +
                `,'pre',` + tablenumber +
                `)"> < </span>`;

            for (let index = 1; index <= pages; index++) {
                elementid = element + "-" + index;
                if (index == 1) {
                    elementobj.innerHTML += ` <a id="` + elementid + `"  onclick="paginationwork('` +
                        elementid + `',` + datasetname +
                        `,` + index + `,` + tablenumber +
                        `)">` +
                        index + `</a>`;

                } else {
                    elementobj.innerHTML += ` <a id="` + elementid + `"  onclick="paginationwork('` + elementid +
                        `',` + datasetname + `,` + index + `,` + tablenumber +
                        `)">` + index +
                        `</a>`;
                }
            }
            elementid = 'next';

            elementobj.innerHTML += `<span id="nextpageentity" ` + `onclick="paginationwork('` +
                element + `',` + datasetname +
                `,'next',` + tablenumber +
                `)"> > </span>`;
            paginationwork(element + "-" + 1, data, 1, tablenumber);
        }

        function reset() {
            textfromarea =
                'Throughout the interwar period, elements of the fleet conducted visits to ports throughout the Mediterranean, but few fleet exercises occurred due to budget pressures. In 1930, the Maritime Air Force was divorced from Royal Yugoslav Army control, and the naval air arm began to develop significantly, including the establishment of bases along the Adriatic coast. The following year, a British-made flotilla leader was commissioned with the idea that the KM might be able to operate in the Mediterranean alongside the British and French navies.';
            document.getElementById("comprehendtextara").value = textfromarea;
            responsedataprocessing(JSON.parse(testdataobject));
        }

        function inputChange() {
            inputtext = document.getElementById('comprehendtextara').value.trim();
            balanceInput = 10000 - inputtext.length;
            document.getElementById('textremaining-p').innerHTML = `<p id="textremaining-p" class="pChars">` +
                balanceInput + ` Characters remaining </p>`;
        }
    </script>
@endpush

@push('header')
    <h1>Comprehend Demonstration</h1>
@endpush

@push('aside')
    <a href="{{ url('/speechtotext') }}">Speech To Text</a>
    <a href="{{ url('/texttospeech') }}">Text To Speech</a>
    <a href="{{ url('/textextract') }}">Text Extract</a>
    <a href="{{ url('/comprehend') }}" class="selected">Comprehend Demonstration</a>
    <a href="{{ url('/objectrecognisation') }}">Object Recognition</a>
@endpush

@push('artical')
    <div class="comprehendbodydiv">

        {{-- text area div --}}
        <div class="textareadiv">
            <label for="comprehendtextara" class="headings">Input Text</label>
            <textarea id="comprehendtextara" class="textinput" name="" maxlength="100000" onkeyup="inputChange()">Throughout the interwar period, elements of the fleet conducted visits to ports throughout the Mediterranean, but few fleet exercises occurred due to budget pressures. In 1930, the Maritime Air Force was divorced from Royal Yugoslav Army control, and the naval air arm began to develop significantly, including the establishment of bases along the Adriatic coast. The following year, a British-made flotilla leader was commissioned with the idea that the KM might be able to operate in the Mediterranean alongside the British and French navies.</textarea>
            <p id="textremaining-p" class="pChars">100000 Characters remaining</p>

            <div class="textareadivbtns">
                <button class="btnClear btn" onclick="cleartext()">CLEAR TEXT</button>
                <button id="btnAnalyze" class="btnAnalyze btn" onclick="callcomprehend()">ANALYZE</button>

                <button id="btnanalyzing" type="button" class="btnAnalyze btn" onclick="convert()">
                    Analyzing <i id="converting" class="fa fa-spinner fa-spin"></i>
                </button>
            </div>
        </div>
        <div class="comprehendresultdiv">
            <p class="headings tabtitlep">Insights</p>
            <div id="tabs" class="responsive sticky-top bg-white">
                <!-- <div class="tabs tabs-center"> -->
                <a id="a_tab_entity" class="tab" onclick="showentitytab()">
                    Entities
                </a>
                <a id="a_tab_phrase" class="tab" onclick="showphrasetab()">
                    Key phrases
                </a>
                <a id="a_tab_language" class="tab" onclick="showlanguagetab()">
                    Languages
                </a>
                <a id="a_tab_pii" class="tab" onclick="showpiitab()">
                    PII
                </a>
                <a id="a_tab_sentiment" class="tab" onclick="showsentimenttab()">
                    Sentiment
                </a>
                <a id="a_tab_syntax" class="tab" onclick="showsyntaxtab()">
                    Syntax
                </a>
                <!-- </div> -->
            </div>

            <div class="piielements divtogglekeypii">
                <p class="subtextappintegration">Personally Identifiable information (PII) analysis mode</p>
                <div class="radiospii">

                    <label class="form-control">
                        <input type="radio" id="piioffset" name="piioptions" value="offset" checked
                            onclick="togglepiioptions()" />
                        <span class="radiotitle">Offsets</span>
                        <p> Identify the location of PII in your text documents.</p>
                    </label>

                    <label class="form-control">
                        <input type="radio" id="piilabel" name="piioptions" value="labels"
                            onclick="togglepiioptions()" />
                        <span class="radiotitle">Labels</span>
                        <p>Label text documents with PII.</p>
                    </label>

                </div>
            </div>


            <div class="entityanalyzedtextdiv analyzedtextdiv divtoggleentity">
                <p class="titleanalyzedtextp">Analyzed Text</p>
                <div id="entity_textaradisabled" class="textinput comprehendtextaradisabled" disabled></div>

            </div>

            <div class="keyphraseanalyzedtextdiv analyzedtextdiv divtogglekeyphrase">
                <p class="titleanalyzedtextp">Analyzed Text</p>
                <div id="keyphrase_textaradisabled" class="textinput comprehendtextaradisabled" disabled></div>

            </div>

            <div class="piioffsetanalyzedtextdiv analyzedtextdiv divtogglekeypii">
                <p class="titleanalyzedtextp">Analyzed Text</p>
                <div id="piioffset_textaradisabled" class="textinput comprehendtextaradisabled" disabled></div>

            </div>

            <div class="languageanalyzedtextdiv analyzedtextdiv divtogglelanguage">
                <p class="titleanalyzedtextp">Analyzed Text</p>
                <div id="language_textaradisabled" class="textinput comprehendtextaradisabled" disabled></div>
            </div>

            <div class="sentimentanalyzedtextdiv analyzedtextdiv divtogglesentiment">
                <p class="titleanalyzedtextp">Analyzed Text</p>
                <div id="sentiment_textaradisabled" class="textinput comprehendtextaradisabled" disabled></div>
            </div>

            <div class="syntaxanalyzedtextdiv analyzedtextdiv divtogglesyntax">
                <p class="titleanalyzedtextp">Analyzed Text</p>
                <div id="syntax_textaradisabled" class="textinput comprehendtextaradisabled" disabled></div>
            </div>



            <div id="tblEntity" class="table results divtoggleentity">
                <p class="headings">Results</p>

                <div class="tools">

                    <div class="iconinputbox">
                        <span class="material-symbols-outlined">
                            search
                        </span>
                        <input id="searchentity" class="nooutline searchtext" type="text" placeholder="Search.."
                            onkeyup="entitidata_filter()">
                    </div>

                    <div id="paginationentity" class="pagination">
                        {{-- <span id="previouspageentity">
                            < </span>
                                <a class="selected" onclick="paginationwork(entities,1)">1</a>
                                <a href="">2</a>
                                <a href="">3</a>
                                <span id="nextpageentity"> > </span> --}}
                        {{-- code will be generated dynamically --}}

                    </div>
                </div>

                <div class="tablebody">
                    <table id="entitytable">
                        <thead>
                            <tr>
                                <th class="col1">Entity</th>
                                <th class="col2">Type</th>
                                <th class="col3">Confidence</th>
                            </tr>
                        </thead>
                        <tbody id="entitytablebody">

                        </tbody>
                    </table>
                </div>
            </div>

            <div id="tblkeyphrase" class="table results divtogglekeyphrase">
                <p class="headings">Results</p>

                <div class="tools">

                    <div class="iconinputbox">
                        <span class="material-symbols-outlined">
                            search
                        </span>
                        <input id="keyphrasetext" class="nooutline searchtext" type="text" placeholder="Search.."
                            onkeyup="keyphrase_filter()">
                    </div>

                    <div id="paginationtblkeyphrase" class="pagination">
                        {{-- <span>
                            < </span>
                                <a href="" class="selected">1</a>
                                <a href="">2</a>
                                <a href="">3</a>
                                <span> > </span> --}}
                        {{-- code will be generated dynamically --}}

                    </div>
                </div>

                <div class="keyphrasetablediv cols-2">
                    <table id="keyphrasetable">
                        <thead>
                            <tr>
                                <th class="col1">Key phrases</th>
                                <th class="col2">Confidence</th>
                            </tr>
                        </thead>
                        <tbody id="keyphrasebody">

                        </tbody>
                    </table>
                </div>
            </div>

            <div id="tbllanguage" class="table results divtogglelanguage">
                <p class="headings">Results</p>

                <div class="languagetable cols-2 ">
                    <table>
                        <thead>
                            <tr>
                                <th class="col1">Language</th>
                                <th class="col2">Confidence</th>
                            </tr>
                        </thead>
                        <tbody id="languagetablebody">

                        </tbody>
                    </table>
                </div>
            </div>

            <div id="div_tbl_piilabel" class="table results divtogglekeypii">
                <p class="headings"></p>

                <div class="tools">

                    <div class="iconinputbox">
                        <span class="material-symbols-outlined">
                            search
                        </span>
                        <input id="piilabelsearchtext" class="nooutline searchtext" type="text"
                            placeholder="Search.." onkeyup="piilablset_filter()">
                    </div>

                    <div id="paginationpiilabel" class="pagination">
                        {{-- //pagination dynamically will be added --}}
                    </div>
                </div>

                <div class="divpiitable cols-2">
                    <table id="piitable">
                        <thead>
                            <tr>
                                <th class="col1">Type</th>
                                <th class="col2">Confidence</th>
                            </tr>
                        </thead>
                        <tbody id="piitablebody">

                        </tbody>
                    </table>
                </div>
            </div>

            <div id="div_tbl_piioffset" class="table results divtogglekeypii">
                <p class="headings">Results</p>

                <div class="tools">

                    <div class="iconinputbox">
                        <span class="material-symbols-outlined">
                            search
                        </span>
                        <input id="piioffsetseachtext" class="nooutline searchtext" type="text"
                            placeholder="Search.." onkeyup="piioffset_filter()">
                    </div>

                    <div id="paginationpiioffset" class="pagination">
                        {{-- //pagination dynamically will be added --}}


                    </div>
                </div>

                <div class="tablebody">
                    <table id="entitytable">
                        <thead>
                            <tr>
                                <th class="col1">Entity</th>
                                <th class="col2">Type</th>
                                <th class="col3">Confidence</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_piioffset">

                        </tbody>
                    </table>
                </div>
            </div>

            <div id="tblsentiment" class="table results divtogglesentiment">
                <p class="headings">Results</p>

                <div class="divsentimenttable cols-2">
                    <table>
                        <thead>
                            <tr>
                                <th class="col1">Sentiment</th>
                                <th class="col2">Confidence</th>
                            </tr>
                        </thead>
                        <tbody id="tbodysentimenttable">

                        </tbody>
                    </table>
                </div>
            </div>

            <div id="divtblsyntax" class="table results divtogglesyntax">
                <p class="headings">Results</p>

                <div class="tools">

                    <div class="iconinputbox">
                        <span class="material-symbols-outlined">
                            search
                        </span>
                        <input id="syntaxseachtext" class="nooutline searchtext" type="text" placeholder="Search.."
                            onkeyup="syntax_filter()">
                    </div>

                    <div id="paginationsyntax" class="pagination">
                        {{-- //pagination dynamically will be added --}}

                    </div>
                </div>

                <div class="tablebody">
                    <table id="entitytable">
                        <thead>
                            <tr>
                                <th class="col1">Word</th>
                                <th class="col2">Part of speech</th>
                                <th class="col3">Confidence</th>
                            </tr>
                        </thead>
                        <tbody id="tbodysyntaxtable">

                        </tbody>
                    </table>
                </div>
            </div>


            <div class="appintegration">
                <p class="headings">Application Integration</p>
                <p class="subtextappintegration">API call and API response of DetectEntities API.</p>
                <div class="callresponsedivs">
                    <div class="divapicall">
                        <div id="HTMLContainercall" class="HTMLContainer HTMLContainercall"></div>
                        <button class="btn btncpycall" onclick="copytext(1)">COPY TEXT</button>
                    </div>
                    <div class="divapiresponse">
                        <div id="HTMLContainerresponse" class="HTMLContainer HTMLContainercallresponse"></div>
                        <button class="btn btncpyresponse" onclick="copytext(2)">COPY TEXT</button>
                    </div>
                </div>
            </div>

        </div>

        <div class="loaderdiv">
            <div class="loader"></div>

        </div>
    </div>
@endpush

@push('footer')
    <div class="footerDiv">
        <button class="btn reset" onclick="reset()">
            RESET DEMO </button>
    </div>
@endpush

<style>
    .comprehendbodydiv {
        width: 100%;
        height: 100%;
        overflow: auto;
    }

    .comprehendbodydiv::-webkit-scrollbar {
        display: none;
        /*SafariandChrome*/
    }


    .textareadiv {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-template-rows: 10px 160px 20px;
        height: 140px;
        /* width: 840px; */
        row-gap: 15px;
        margin: 10px 15px 100px 15px;
    }

    .headings {
        color: #0091FF;
        font-size: 13px !important;
        font-weight: bold !important;
        margin-bottom: 5px;
    }

    #comprehendtextara {
        grid-column: 1/4;
        width: 100%;
        border-radius: 8px;
        padding: 12px 15px 12px 15px !important;
        box-sizing: border-box;
        border: 1px solid #DDDDDD;
        resize: none;
        font-family: "Open Sans", sans-serif;
    }

    #comprehendtextara::placeholder {
        font-size: 13px;
        font-family: "Open Sans", sans-serif;
        color: #888888;
    }

    #textremaining-p {
        font-size: 13px;
        color: #888888;
    }

    .btnClear {
        font-weight: 100 !important;
        width: 98px !important;

    }


    .btnAnalyze {
        font-weight: 100 !important;
        color: #FFFFFF !important;
        background-color: #0091FF !important;
        text-transform: uppercase;
        width: 98px !important;
    }


    .comprehendtextaradisabled {
        grid-column: 1/4;
        width: 100%;
        height: 140px;
        border-radius: 5px;
        padding: 10px;
        box-sizing: border-box;
        border: 1px solid #DDDDDD;
        resize: none;
        font-family: "Open Sans", sans-serif;
        line-height: 28px;
        overflow-y: scroll;
        background-color: #F0F0F0;
        color: #888888;
        line-height: 24px;
        font-weight: 400 !important;
    }

    .comprehendtextaradisabled::-webkit-scrollbar {
        display: none;
        /* Safari and Chrome */
    }



    .textareadivbtns {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .tabtitlep {
        margin: 15px;
    }

    /* Style the tab */
    #tabs {
        overflow: hidden;
        border-bottom: 1px solid #EEEEEE;
        margin: 0 25px 0 25px;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        grid-column: 1/4;
    }

    .divtogglekeypii {
        transition: opacity 4s ease-out;
    }


    .tab {
        /* margin: 5px; */
        text-decoration: none;
        font-size: 13px;
        color: #111111;
        font-weight: bold;
        padding: 0 10px 8px 10px;
        box-sizing: border-box;
        border-bottom: 3px solid transparent;
        transition: all 0.35s linear;
    }

    .active {
        border-bottom: 3px solid #0091FF;
    }

    /* end Style the tab */


    .analyzedtextdiv {
        margin: 20px;
    }

    .titleanalyzedtextp {
        color: #111111;
        font-weight: bold;
        margin-bottom: 7px;
    }

    /* styling result content  inside results */
    .results {
        /* margin: 15px 15px 20px 15px; */
        margin: 20px;
    }

    .results p {
        margin-bottom: 15px;
    }

    .results .tools {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        margin-bottom: 20px;
        gap: 10px;
    }

    .iconinputbox {
        border: 1px solid #DDDDDD;
        border-radius: 16px;
        padding: 7px 5px 7px 10px;
        display: flex;
    }

    .searchtext {
        font-size: 13px;
        font-family: "Open Sans", sans-serif;
        color: #000000 !important;
        width: auto;
        min-width: 350px;
        max-width: 400px;
        border: none;
        font-weight: 600;
    }


    /* pagination */
    .pagination {
        display: flex;
        justify-content: space-between;
        width: auto;
        text-align: center;
        align-content: center;
        font-size: 16px;
        font-weight: 900;
        column-gap: 10px;
    }

    .pagination a {
        text-decoration: none;
        width: 20px;
        height: 20px;
        color: #111111;
        font-size: 14px;
    }

    .pagination span {
        margin: 0px !important;
    }

    /* selected page */
    .pagination .selected {
        background-color: #DDDDDD;
        border-radius: 50px;
    }


    /* table stling below  */
    table {
        border-collapse: collapse;
    }

    table th {
        text-align: start;
    }

    tbody tr {
        height: 48px;
        margin: 0;
        border-bottom: 1px solid #EEEEEE;
        /* background: #EEEEEE 0% 0% no-repeat padding-box; */

        /* &:last-child {
            border:0;
        } */
    }

    table .col1 {
        width: 500px;
    }

    table .col2 {
        width: 250px;
    }

    table .col3 {
        width: 50px;
    }

    /* tbody tr .tdcol2 {} */

    tbody tr td {
        /* text-align: center; */
        font-weight: 500;
    }

    /* coloured line in table row */
    tbody .line {
        content: "";
        display: inline-block;
        width: 35px;
        height: 3px;
        vertical-align: middle;
        margin-right: 5px;
        /* background-color: #0091FF; */
    }



    /* // api integration boxes */
    .appintegration {
        margin: 15px;
    }

    .subtextappintegration {
        font-weight: 400;
        margin: 12px 0;
    }

    .callresponsedivs {
        display: flex;
        width: 100%;
        justify-content: space-between;
    }

    /* 3rd part code below  */
    .HTMLContainer {
        width: 390px;
        min-height: 300px;
        border: solid 2px #d8e3fa;
        overflow: auto;
        outline: none;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none;
        resize: none;
        margin-bottom: 10px;
    }

    /* 3rd part code over  */


    .divapicall,
    .divapiresponse {
        position: relative;
    }

    .btncpycall,
    .btncpyresponse {
        position: absolute;
        right: 0;
    }

    /* hide  */
    .table {
        display: block;
    }

    .language {
        display: block;
    }

    /* language table  */
    /* .languagetable .col1 {
        width: 750px;
    }

    .languagetable .col2 {
        width: 50px;
    } */

    .languagetable tbody tr {
        border-bottom: 0px;
    }


    /* 2 columns table  */
    .cols-2 .col1 {
        width: 750px;
    }

    .cols-2 .col2 {
        width: 50px;
    }


    .piielements {
        margin: 25px 15px;

    }

    .radiospii {
        display: flex;
        gap: 120px;
    }

    .form-control p {
        margin-left: 20px;
        color: #888888;
    }

    .radiotitle {
        color: #000000;
        margin-left: 5px;
        font-weight: 600;
    }

    /* .comprehendresultdiv {
      display: none;
    } */

    .loaderdiv {
        display: none;
    }

    #btnanalyzing {
        display: none;
    }


    .bc-entiry-person {
        background-color: #CE6DBD;
    }

    .bc-entiry-organization {
        background-color: #756BB1;
    }

    .bc-entiry-date {
        background-color: #1E8900;
    }

    .bc-entiry-location {
        background-color: #0073BB;
    }

    .bc-entiry-other {
        background-color: #545B64;
    }

    .bc-entiry-quantity {
        background-color: #77002A;
    }

    .divtext {
        line-height: 28px;
        overflow: hidden;
    }

    .divtext span {
        font-size: 13px;
        font-family: "Open Sans", sans-serif;
        color: #888888;
    }


    .bb-entiry-person {
        border-bottom: 2px solid #CE6DBD;
    }

    .bb-entiry-organization {
        border-bottom: 2px solid #756BB1;
    }

    .bb-entiry-date {
        border-bottom: 2px solid #1E8900;
    }

    .bb-entiry-location {
        border-bottom: 2px solid #0073BB;
    }

    .bb-entiry-other {
        border-bottom: 2px solid #545B64;
    }

    .bb-entiry-quantity {
        border-bottom: 2px solid #77002A;
    }

    .hoveronspan:hover {
        border-bottom: 2px solid #545B64;

    }

    .footerDiv {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 20px;
        /* margin: 5px 10px 10px 10px; */
        /* height: 100%; */
        align-items: center;
    }
</style>
