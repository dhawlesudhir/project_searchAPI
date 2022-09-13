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


        var textfromarea = document.getElementById("comprehendtextara").value;

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
        // updateHTML_request(payload);
        const obj = JSON.stringify(payloaddata);

        updateHTML_request(payloaddata);

        var testdataobject = `{
    "entities": {
        "Index": 0,
        "Entities": [
            {
                "Score": 0.9997740983963013,
                "Type": "PERSON",
                "Text": "Zhang Wei",
                "BeginOffset": 6,
                "EndOffset": 15
            },
            {
                "Score": 0.9984936714172363,
                "Type": "PERSON",
                "Text": "John",
                "BeginOffset": 22,
                "EndOffset": 26
            },
            {
                "Score": 0.9996161460876465,
                "Type": "ORGANIZATION",
                "Text": "AnyCompany Financial Services, LLC",
                "BeginOffset": 33,
                "EndOffset": 67
            },
            {
                "Score": 0.9963298439979553,
                "Type": "OTHER",
                "Text": "1111-0000-1111-0008",
                "BeginOffset": 88,
                "EndOffset": 107
            },
            {
                "Score": 0.9986886978149414,
                "Type": "QUANTITY",
                "Text": "$24.53",
                "BeginOffset": 133,
                "EndOffset": 139
            },
            {
                "Score": 0.99925696849823,
                "Type": "DATE",
                "Text": "July 31st",
                "BeginOffset": 155,
                "EndOffset": 164
            },
            {
                "Score": 0.9884562492370605,
                "Type": "OTHER",
                "Text": "XXXXXX1111",
                "BeginOffset": 274,
                "EndOffset": 284
            },
            {
                "Score": 0.76296067237854,
                "Type": "OTHER",
                "Text": "XXXXX0000",
                "BeginOffset": 309,
                "EndOffset": 323
            },
            {
                "Score": 0.9358068704605103,
                "Type": "LOCATION",
                "Text": "2200 West Cypress Creek Road, 1st Floor, Fort Lauderdale, Florida, 33309",
                "BeginOffset": 355,
                "EndOffset": 433
            },
            {
                "Score": 0.9995972514152527,
                "Type": "OTHER",
                "Text": "206-555-0100",
                "BeginOffset": 508,
                "EndOffset": 523
            },
            {
                "Score": 0.9896668195724487,
                "Type": "ORGANIZATION",
                "Text": "AnyCompany",
                "BeginOffset": 560,
                "EndOffset": 570
            },
            {
                "Score": 0.999754011631012,
                "Type": "OTHER",
                "Text": "206-555-0199",
                "BeginOffset": 613,
                "EndOffset": 625
            },
            {
                "Score": 0.9981456995010376,
                "Type": "OTHER",
                "Text": "support@anycompany.com",
                "BeginOffset": 638,
                "EndOffset": 660
            }
        ]
    },
    "sentiment": {
        "Index": 0,
        "Sentiment": "NEUTRAL",
        "SentimentScore": {
            "Positive": 0.0009977805893868208,
            "Negative": 0.015936780720949173,
            "Neutral": 0.9830580353736877,
            "Mixed": 0.0000073353699008293916
        }
    },
    "keyPhaseResults": {
        "KeyPhrases": [
            {
                "Score": 0.9522862434387207,
                "Text": "Zhang Wei",
                "BeginOffset": 6,
                "EndOffset": 15
            },
            {
                "Score": 0.9984013438224792,
                "Text": "John",
                "BeginOffset": 22,
                "EndOffset": 26
            },
            {
                "Score": 0.9867493510246277,
                "Text": "Your AnyCompany Financial Services",
                "BeginOffset": 28,
                "EndOffset": 62
            },
            {
                "Score": 0.8626571893692017,
                "Text": "LLC credit card account 1111-0000-1111-0008",
                "BeginOffset": 64,
                "EndOffset": 107
            },
            {
                "Score": 0.9999487996101379,
                "Text": "a minimum payment",
                "BeginOffset": 112,
                "EndOffset": 129
            },
            {
                "Score": 0.9997239112854004,
                "Text": "$24.53",
                "BeginOffset": 133,
                "EndOffset": 139
            },
            {
                "Score": 0.9980087876319885,
                "Text": "July 31st",
                "BeginOffset": 155,
                "EndOffset": 164
            },
            {
                "Score": 0.9989496469497681,
                "Text": "your autopay settings",
                "BeginOffset": 175,
                "EndOffset": 196
            },
            {
                "Score": 0.9996367692947388,
                "Text": "your payment",
                "BeginOffset": 215,
                "EndOffset": 227
            },
            {
                "Score": 0.9994645118713379,
                "Text": "the due date",
                "BeginOffset": 231,
                "EndOffset": 243
            },
            {
                "Score": 0.9747101664543152,
                "Text": "your bank account number XXXXXX1111",
                "BeginOffset": 249,
                "EndOffset": 284
            },
            {
                "Score": 0.8630982637405396,
                "Text": "the routing number XXXXX0000.Your latest statement",
                "BeginOffset": 290,
                "EndOffset": 340
            },
            {
                "Score": 0.9693149924278259,
                "Text": "2200 West Cypress Creek Road",
                "BeginOffset": 355,
                "EndOffset": 383
            },
            {
                "Score": 0.9786699414253235,
                "Text": "1st Floor",
                "BeginOffset": 385,
                "EndOffset": 394
            },
            {
                "Score": 0.9936948418617249,
                "Text": "Fort Lauderdale",
                "BeginOffset": 396,
                "EndOffset": 411
            },
            {
                "Score": 0.9876502156257629,
                "Text": "Florida",
                "BeginOffset": 413,
                "EndOffset": 420
            },
            {
                "Score": 0.9998143911361694,
                "Text": "your payment",
                "BeginOffset": 434,
                "EndOffset": 446
            },
            {
                "Score": 0.9995299577713013,
                "Text": "a confirmation text message",
                "BeginOffset": 477,
                "EndOffset": 504
            },
            {
                "Score": 0.9978468418121338,
                "Text": "206-555-0100.If",
                "BeginOffset": 508,
                "EndOffset": 523
            },
            {
                "Score": 0.9946339130401611,
                "Text": "questions",
                "BeginOffset": 533,
                "EndOffset": 542
            },
            {
                "Score": 0.9997805953025818,
                "Text": "your bill",
                "BeginOffset": 549,
                "EndOffset": 558
            },
            {
                "Score": 0.9996623396873474,
                "Text": "AnyCompany Customer Service",
                "BeginOffset": 560,
                "EndOffset": 587
            },
            {
                "Score": 0.9988850951194763,
                "Text": "phone",
                "BeginOffset": 604,
                "EndOffset": 609
            },
            {
                "Score": 0.9981843829154968,
                "Text": "206-555-0199",
                "BeginOffset": 613,
                "EndOffset": 625
            },
            {
                "Score": 0.9155728220939636,
                "Text": "support@anycompany.com",
                "BeginOffset": 638,
                "EndOffset": 660
            }
        ]
    },
    "languageResults": {
        "Languages": [
            {
                "LanguageCode": "en",
                "Score": 0.9902476668357849
            }
        ]
    },
    "piiEntitiesResults": {
        "Entities": [
            {
                "Score": 0.9997674822807312,
                "Type": "NAME",
                "BeginOffset": 6,
                "EndOffset": 15
            },
            {
                "Score": 0.9998503923416138,
                "Type": "NAME",
                "BeginOffset": 22,
                "EndOffset": 26
            },
            {
                "Score": 0.9986937642097473,
                "Type": "CREDIT_DEBIT_NUMBER",
                "BeginOffset": 88,
                "EndOffset": 107
            },
            {
                "Score": 0.9999628663063049,
                "Type": "DATE_TIME",
                "BeginOffset": 155,
                "EndOffset": 164
            },
            {
                "Score": 0.9998927116394043,
                "Type": "BANK_ACCOUNT_NUMBER",
                "BeginOffset": 274,
                "EndOffset": 284
            },
            {
                "Score": 0.9999721050262451,
                "Type": "BANK_ROUTING",
                "BeginOffset": 309,
                "EndOffset": 323
            },
            {
                "Score": 0.9999604821205139,
                "Type": "ADDRESS",
                "BeginOffset": 355,
                "EndOffset": 433
            },
            {
                "Score": 0.9984651803970337,
                "Type": "PHONE",
                "BeginOffset": 508,
                "EndOffset": 523
            },
            {
                "Score": 0.9997573494911194,
                "Type": "PHONE",
                "BeginOffset": 613,
                "EndOffset": 625
            },
            {
                "Score": 0.9997019171714783,
                "Type": "EMAIL",
                "BeginOffset": 638,
                "EndOffset": 660
            }
        ]
    },
    "syntaxResults": {
        "SyntaxTokens": [
            {
                "TokenId": 1,
                "Text": "Hello",
                "BeginOffset": 0,
                "EndOffset": 5,
                "PartOfSpeech": {
                    "Tag": "INTJ",
                    "Score": 0.9812782406806946
                }
            },
            {
                "TokenId": 2,
                "Text": "Zhang",
                "BeginOffset": 6,
                "EndOffset": 11,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.9995248913764954
                }
            },
            {
                "TokenId": 3,
                "Text": "Wei",
                "BeginOffset": 12,
                "EndOffset": 15,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.9987133741378784
                }
            },
            {
                "TokenId": 4,
                "Text": ",",
                "BeginOffset": 15,
                "EndOffset": 16,
                "PartOfSpeech": {
                    "Tag": "PUNCT",
                    "Score": 0.9999990463256836
                }
            },
            {
                "TokenId": 5,
                "Text": "I",
                "BeginOffset": 17,
                "EndOffset": 18,
                "PartOfSpeech": {
                    "Tag": "PRON",
                    "Score": 0.9997743964195251
                }
            },
            {
                "TokenId": 6,
                "Text": "am",
                "BeginOffset": 19,
                "EndOffset": 21,
                "PartOfSpeech": {
                    "Tag": "VERB",
                    "Score": 0.9853795170783997
                }
            },
            {
                "TokenId": 7,
                "Text": "John",
                "BeginOffset": 22,
                "EndOffset": 26,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.9999022483825684
                }
            },
            {
                "TokenId": 8,
                "Text": ".",
                "BeginOffset": 26,
                "EndOffset": 27,
                "PartOfSpeech": {
                    "Tag": "PUNCT",
                    "Score": 0.9999861717224121
                }
            },
            {
                "TokenId": 9,
                "Text": "Your",
                "BeginOffset": 28,
                "EndOffset": 32,
                "PartOfSpeech": {
                    "Tag": "PRON",
                    "Score": 0.9985801577568054
                }
            },
            {
                "TokenId": 10,
                "Text": "AnyCompany",
                "BeginOffset": 33,
                "EndOffset": 43,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.9924488067626953
                }
            },
            {
                "TokenId": 11,
                "Text": "Financial",
                "BeginOffset": 44,
                "EndOffset": 53,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.9987910389900208
                }
            },
            {
                "TokenId": 12,
                "Text": "Services",
                "BeginOffset": 54,
                "EndOffset": 62,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.9981211423873901
                }
            },
            {
                "TokenId": 13,
                "Text": ",",
                "BeginOffset": 62,
                "EndOffset": 63,
                "PartOfSpeech": {
                    "Tag": "PUNCT",
                    "Score": 0.9999691247940063
                }
            },
            {
                "TokenId": 14,
                "Text": "LLC",
                "BeginOffset": 64,
                "EndOffset": 67,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.9854297041893005
                }
            },
            {
                "TokenId": 15,
                "Text": "credit",
                "BeginOffset": 68,
                "EndOffset": 74,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9992117881774902
                }
            },
            {
                "TokenId": 16,
                "Text": "card",
                "BeginOffset": 75,
                "EndOffset": 79,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9995114803314209
                }
            },
            {
                "TokenId": 17,
                "Text": "account",
                "BeginOffset": 80,
                "EndOffset": 87,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.8321436643600464
                }
            },
            {
                "TokenId": 18,
                "Text": "1111-0000-1111-0008",
                "BeginOffset": 88,
                "EndOffset": 107,
                "PartOfSpeech": {
                    "Tag": "NUM",
                    "Score": 0.9857685565948486
                }
            },
            {
                "TokenId": 19,
                "Text": "has",
                "BeginOffset": 108,
                "EndOffset": 111,
                "PartOfSpeech": {
                    "Tag": "VERB",
                    "Score": 0.990443766117096
                }
            },
            {
                "TokenId": 20,
                "Text": "a",
                "BeginOffset": 112,
                "EndOffset": 113,
                "PartOfSpeech": {
                    "Tag": "DET",
                    "Score": 0.9999935626983643
                }
            },
            {
                "TokenId": 21,
                "Text": "minimum",
                "BeginOffset": 114,
                "EndOffset": 121,
                "PartOfSpeech": {
                    "Tag": "ADJ",
                    "Score": 0.8807594180107117
                }
            },
            {
                "TokenId": 22,
                "Text": "payment",
                "BeginOffset": 122,
                "EndOffset": 129,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9999881982803345
                }
            },
            {
                "TokenId": 23,
                "Text": "of",
                "BeginOffset": 130,
                "EndOffset": 132,
                "PartOfSpeech": {
                    "Tag": "ADP",
                    "Score": 0.9999105334281921
                }
            },
            {
                "TokenId": 24,
                "Text": "$",
                "BeginOffset": 133,
                "EndOffset": 134,
                "PartOfSpeech": {
                    "Tag": "SYM",
                    "Score": 0.9999962449073792
                }
            },
            {
                "TokenId": 25,
                "Text": "24.53",
                "BeginOffset": 134,
                "EndOffset": 139,
                "PartOfSpeech": {
                    "Tag": "NUM",
                    "Score": 0.999960720539093
                }
            },
            {
                "TokenId": 26,
                "Text": "that",
                "BeginOffset": 140,
                "EndOffset": 144,
                "PartOfSpeech": {
                    "Tag": "PRON",
                    "Score": 0.9871926307678223
                }
            },
            {
                "TokenId": 27,
                "Text": "is",
                "BeginOffset": 145,
                "EndOffset": 147,
                "PartOfSpeech": {
                    "Tag": "VERB",
                    "Score": 0.9648488163948059
                }
            },
            {
                "TokenId": 28,
                "Text": "due",
                "BeginOffset": 148,
                "EndOffset": 151,
                "PartOfSpeech": {
                    "Tag": "ADJ",
                    "Score": 0.9366286993026733
                }
            },
            {
                "TokenId": 29,
                "Text": "by",
                "BeginOffset": 152,
                "EndOffset": 154,
                "PartOfSpeech": {
                    "Tag": "ADP",
                    "Score": 0.9998490810394287
                }
            },
            {
                "TokenId": 30,
                "Text": "July",
                "BeginOffset": 155,
                "EndOffset": 159,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.9991292953491211
                }
            },
            {
                "TokenId": 31,
                "Text": "31st",
                "BeginOffset": 160,
                "EndOffset": 164,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9941086769104004
                }
            },
            {
                "TokenId": 32,
                "Text": ".",
                "BeginOffset": 164,
                "EndOffset": 165,
                "PartOfSpeech": {
                    "Tag": "PUNCT",
                    "Score": 0.9999989867210388
                }
            },
            {
                "TokenId": 33,
                "Text": "Based",
                "BeginOffset": 166,
                "EndOffset": 171,
                "PartOfSpeech": {
                    "Tag": "VERB",
                    "Score": 0.9985010623931885
                }
            },
            {
                "TokenId": 34,
                "Text": "on",
                "BeginOffset": 172,
                "EndOffset": 174,
                "PartOfSpeech": {
                    "Tag": "ADP",
                    "Score": 0.997907280921936
                }
            },
            {
                "TokenId": 35,
                "Text": "your",
                "BeginOffset": 175,
                "EndOffset": 179,
                "PartOfSpeech": {
                    "Tag": "PRON",
                    "Score": 0.9999997019767761
                }
            },
            {
                "TokenId": 36,
                "Text": "autopay",
                "BeginOffset": 180,
                "EndOffset": 187,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9419152140617371
                }
            },
            {
                "TokenId": 37,
                "Text": "settings",
                "BeginOffset": 188,
                "EndOffset": 196,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9981927871704102
                }
            },
            {
                "TokenId": 38,
                "Text": ",",
                "BeginOffset": 196,
                "EndOffset": 197,
                "PartOfSpeech": {
                    "Tag": "PUNCT",
                    "Score": 0.9999999403953552
                }
            },
            {
                "TokenId": 39,
                "Text": "we",
                "BeginOffset": 198,
                "EndOffset": 200,
                "PartOfSpeech": {
                    "Tag": "PRON",
                    "Score": 0.9999995231628418
                }
            },
            {
                "TokenId": 40,
                "Text": "will",
                "BeginOffset": 201,
                "EndOffset": 205,
                "PartOfSpeech": {
                    "Tag": "AUX",
                    "Score": 0.9999973177909851
                }
            },
            {
                "TokenId": 41,
                "Text": "withdraw",
                "BeginOffset": 206,
                "EndOffset": 214,
                "PartOfSpeech": {
                    "Tag": "VERB",
                    "Score": 0.9999938607215881
                }
            },
            {
                "TokenId": 42,
                "Text": "your",
                "BeginOffset": 215,
                "EndOffset": 219,
                "PartOfSpeech": {
                    "Tag": "PRON",
                    "Score": 0.9999996423721313
                }
            },
            {
                "TokenId": 43,
                "Text": "payment",
                "BeginOffset": 220,
                "EndOffset": 227,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.999988853931427
                }
            },
            {
                "TokenId": 44,
                "Text": "on",
                "BeginOffset": 228,
                "EndOffset": 230,
                "PartOfSpeech": {
                    "Tag": "ADP",
                    "Score": 0.9997056126594543
                }
            },
            {
                "TokenId": 45,
                "Text": "the",
                "BeginOffset": 231,
                "EndOffset": 234,
                "PartOfSpeech": {
                    "Tag": "DET",
                    "Score": 0.999993622303009
                }
            },
            {
                "TokenId": 46,
                "Text": "due",
                "BeginOffset": 235,
                "EndOffset": 238,
                "PartOfSpeech": {
                    "Tag": "ADJ",
                    "Score": 0.9993534684181213
                }
            },
            {
                "TokenId": 47,
                "Text": "date",
                "BeginOffset": 239,
                "EndOffset": 243,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9999743700027466
                }
            },
            {
                "TokenId": 48,
                "Text": "from",
                "BeginOffset": 244,
                "EndOffset": 248,
                "PartOfSpeech": {
                    "Tag": "ADP",
                    "Score": 0.9966364502906799
                }
            },
            {
                "TokenId": 49,
                "Text": "your",
                "BeginOffset": 249,
                "EndOffset": 253,
                "PartOfSpeech": {
                    "Tag": "PRON",
                    "Score": 0.9999997019767761
                }
            },
            {
                "TokenId": 50,
                "Text": "bank",
                "BeginOffset": 254,
                "EndOffset": 258,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9987537860870361
                }
            },
            {
                "TokenId": 51,
                "Text": "account",
                "BeginOffset": 259,
                "EndOffset": 266,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9592134952545166
                }
            },
            {
                "TokenId": 52,
                "Text": "number",
                "BeginOffset": 267,
                "EndOffset": 273,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9994857907295227
                }
            },
            {
                "TokenId": 53,
                "Text": "XXXXXX1111",
                "BeginOffset": 274,
                "EndOffset": 284,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.9354207515716553
                }
            },
            {
                "TokenId": 54,
                "Text": "with",
                "BeginOffset": 285,
                "EndOffset": 289,
                "PartOfSpeech": {
                    "Tag": "ADP",
                    "Score": 0.9772429466247559
                }
            },
            {
                "TokenId": 55,
                "Text": "the",
                "BeginOffset": 290,
                "EndOffset": 293,
                "PartOfSpeech": {
                    "Tag": "DET",
                    "Score": 0.9999812245368958
                }
            },
            {
                "TokenId": 56,
                "Text": "routing",
                "BeginOffset": 294,
                "EndOffset": 301,
                "PartOfSpeech": {
                    "Tag": "VERB",
                    "Score": 0.6380329132080078
                }
            },
            {
                "TokenId": 57,
                "Text": "number",
                "BeginOffset": 302,
                "EndOffset": 308,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.996759295463562
                }
            },
            {
                "TokenId": 58,
                "Text": "XXXXX0000.Your",
                "BeginOffset": 309,
                "EndOffset": 323,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.9919377565383911
                }
            },
            {
                "TokenId": 59,
                "Text": "latest",
                "BeginOffset": 324,
                "EndOffset": 330,
                "PartOfSpeech": {
                    "Tag": "ADJ",
                    "Score": 0.9976332187652588
                }
            },
            {
                "TokenId": 60,
                "Text": "statement",
                "BeginOffset": 331,
                "EndOffset": 340,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9999690651893616
                }
            },
            {
                "TokenId": 61,
                "Text": "was",
                "BeginOffset": 341,
                "EndOffset": 344,
                "PartOfSpeech": {
                    "Tag": "AUX",
                    "Score": 0.9935356378555298
                }
            },
            {
                "TokenId": 62,
                "Text": "mailed",
                "BeginOffset": 345,
                "EndOffset": 351,
                "PartOfSpeech": {
                    "Tag": "VERB",
                    "Score": 0.9998807907104492
                }
            },
            {
                "TokenId": 63,
                "Text": "to",
                "BeginOffset": 352,
                "EndOffset": 354,
                "PartOfSpeech": {
                    "Tag": "ADP",
                    "Score": 0.9976246953010559
                }
            },
            {
                "TokenId": 64,
                "Text": "2200",
                "BeginOffset": 355,
                "EndOffset": 359,
                "PartOfSpeech": {
                    "Tag": "NUM",
                    "Score": 0.9798623919487
                }
            },
            {
                "TokenId": 65,
                "Text": "West",
                "BeginOffset": 360,
                "EndOffset": 364,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.9844287633895874
                }
            },
            {
                "TokenId": 66,
                "Text": "Cypress",
                "BeginOffset": 365,
                "EndOffset": 372,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.9998825788497925
                }
            },
            {
                "TokenId": 67,
                "Text": "Creek",
                "BeginOffset": 373,
                "EndOffset": 378,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.9991940855979919
                }
            },
            {
                "TokenId": 68,
                "Text": "Road",
                "BeginOffset": 379,
                "EndOffset": 383,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.9953961372375488
                }
            },
            {
                "TokenId": 69,
                "Text": ",",
                "BeginOffset": 383,
                "EndOffset": 384,
                "PartOfSpeech": {
                    "Tag": "PUNCT",
                    "Score": 0.9999976754188538
                }
            },
            {
                "TokenId": 70,
                "Text": "1st",
                "BeginOffset": 385,
                "EndOffset": 388,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.5152491927146912
                }
            },
            {
                "TokenId": 71,
                "Text": "Floor",
                "BeginOffset": 389,
                "EndOffset": 394,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.9993359446525574
                }
            },
            {
                "TokenId": 72,
                "Text": ",",
                "BeginOffset": 394,
                "EndOffset": 395,
                "PartOfSpeech": {
                    "Tag": "PUNCT",
                    "Score": 0.9999949336051941
                }
            },
            {
                "TokenId": 73,
                "Text": "Fort",
                "BeginOffset": 396,
                "EndOffset": 400,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.9999544620513916
                }
            },
            {
                "TokenId": 74,
                "Text": "Lauderdale",
                "BeginOffset": 401,
                "EndOffset": 411,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.9998687505722046
                }
            },
            {
                "TokenId": 75,
                "Text": ",",
                "BeginOffset": 411,
                "EndOffset": 412,
                "PartOfSpeech": {
                    "Tag": "PUNCT",
                    "Score": 0.9999944567680359
                }
            },
            {
                "TokenId": 76,
                "Text": "Florida",
                "BeginOffset": 413,
                "EndOffset": 420,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.9992241263389587
                }
            },
            {
                "TokenId": 77,
                "Text": ",",
                "BeginOffset": 420,
                "EndOffset": 421,
                "PartOfSpeech": {
                    "Tag": "PUNCT",
                    "Score": 0.9999986290931702
                }
            },
            {
                "TokenId": 78,
                "Text": "33309.After",
                "BeginOffset": 422,
                "EndOffset": 433,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.9872213006019592
                }
            },
            {
                "TokenId": 79,
                "Text": "your",
                "BeginOffset": 434,
                "EndOffset": 438,
                "PartOfSpeech": {
                    "Tag": "PRON",
                    "Score": 0.9999979138374329
                }
            },
            {
                "TokenId": 80,
                "Text": "payment",
                "BeginOffset": 439,
                "EndOffset": 446,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.999993085861206
                }
            },
            {
                "TokenId": 81,
                "Text": "is",
                "BeginOffset": 447,
                "EndOffset": 449,
                "PartOfSpeech": {
                    "Tag": "AUX",
                    "Score": 0.9797427654266357
                }
            },
            {
                "TokenId": 82,
                "Text": "received",
                "BeginOffset": 450,
                "EndOffset": 458,
                "PartOfSpeech": {
                    "Tag": "VERB",
                    "Score": 0.9998161792755127
                }
            },
            {
                "TokenId": 83,
                "Text": ",",
                "BeginOffset": 458,
                "EndOffset": 459,
                "PartOfSpeech": {
                    "Tag": "PUNCT",
                    "Score": 0.9999999403953552
                }
            },
            {
                "TokenId": 84,
                "Text": "you",
                "BeginOffset": 460,
                "EndOffset": 463,
                "PartOfSpeech": {
                    "Tag": "PRON",
                    "Score": 0.9999962449073792
                }
            },
            {
                "TokenId": 85,
                "Text": "will",
                "BeginOffset": 464,
                "EndOffset": 468,
                "PartOfSpeech": {
                    "Tag": "AUX",
                    "Score": 0.9999966025352478
                }
            },
            {
                "TokenId": 86,
                "Text": "receive",
                "BeginOffset": 469,
                "EndOffset": 476,
                "PartOfSpeech": {
                    "Tag": "VERB",
                    "Score": 0.9999992251396179
                }
            },
            {
                "TokenId": 87,
                "Text": "a",
                "BeginOffset": 477,
                "EndOffset": 478,
                "PartOfSpeech": {
                    "Tag": "DET",
                    "Score": 0.9999974966049194
                }
            },
            {
                "TokenId": 88,
                "Text": "confirmation",
                "BeginOffset": 479,
                "EndOffset": 491,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9905379414558411
                }
            },
            {
                "TokenId": 89,
                "Text": "text",
                "BeginOffset": 492,
                "EndOffset": 496,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9989776015281677
                }
            },
            {
                "TokenId": 90,
                "Text": "message",
                "BeginOffset": 497,
                "EndOffset": 504,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9994093775749207
                }
            },
            {
                "TokenId": 91,
                "Text": "at",
                "BeginOffset": 505,
                "EndOffset": 507,
                "PartOfSpeech": {
                    "Tag": "ADP",
                    "Score": 0.9978802800178528
                }
            },
            {
                "TokenId": 92,
                "Text": "206-555-0100.If",
                "BeginOffset": 508,
                "EndOffset": 523,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.9949573874473572
                }
            },
            {
                "TokenId": 93,
                "Text": "you",
                "BeginOffset": 524,
                "EndOffset": 527,
                "PartOfSpeech": {
                    "Tag": "PRON",
                    "Score": 0.9999827146530151
                }
            },
            {
                "TokenId": 94,
                "Text": "have",
                "BeginOffset": 528,
                "EndOffset": 532,
                "PartOfSpeech": {
                    "Tag": "VERB",
                    "Score": 0.9925605654716492
                }
            },
            {
                "TokenId": 95,
                "Text": "questions",
                "BeginOffset": 533,
                "EndOffset": 542,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9999264478683472
                }
            },
            {
                "TokenId": 96,
                "Text": "about",
                "BeginOffset": 543,
                "EndOffset": 548,
                "PartOfSpeech": {
                    "Tag": "ADP",
                    "Score": 0.9969242811203003
                }
            },
            {
                "TokenId": 97,
                "Text": "your",
                "BeginOffset": 549,
                "EndOffset": 553,
                "PartOfSpeech": {
                    "Tag": "PRON",
                    "Score": 0.9999996423721313
                }
            },
            {
                "TokenId": 98,
                "Text": "bill",
                "BeginOffset": 554,
                "EndOffset": 558,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9999887943267822
                }
            },
            {
                "TokenId": 99,
                "Text": ",",
                "BeginOffset": 558,
                "EndOffset": 559,
                "PartOfSpeech": {
                    "Tag": "PUNCT",
                    "Score": 0.9999999403953552
                }
            },
            {
                "TokenId": 100,
                "Text": "AnyCompany",
                "BeginOffset": 560,
                "EndOffset": 570,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.9988423585891724
                }
            },
            {
                "TokenId": 101,
                "Text": "Customer",
                "BeginOffset": 571,
                "EndOffset": 579,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.998726487159729
                }
            },
            {
                "TokenId": 102,
                "Text": "Service",
                "BeginOffset": 580,
                "EndOffset": 587,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.9993500709533691
                }
            },
            {
                "TokenId": 103,
                "Text": "is",
                "BeginOffset": 588,
                "EndOffset": 590,
                "PartOfSpeech": {
                    "Tag": "VERB",
                    "Score": 0.9932278394699097
                }
            },
            {
                "TokenId": 104,
                "Text": "available",
                "BeginOffset": 591,
                "EndOffset": 600,
                "PartOfSpeech": {
                    "Tag": "ADJ",
                    "Score": 0.9999136328697205
                }
            },
            {
                "TokenId": 105,
                "Text": "by",
                "BeginOffset": 601,
                "EndOffset": 603,
                "PartOfSpeech": {
                    "Tag": "ADP",
                    "Score": 0.9988844990730286
                }
            },
            {
                "TokenId": 106,
                "Text": "phone",
                "BeginOffset": 604,
                "EndOffset": 609,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9991739392280579
                }
            },
            {
                "TokenId": 107,
                "Text": "at",
                "BeginOffset": 610,
                "EndOffset": 612,
                "PartOfSpeech": {
                    "Tag": "ADP",
                    "Score": 0.9993857145309448
                }
            },
            {
                "TokenId": 108,
                "Text": "206-555-0199",
                "BeginOffset": 613,
                "EndOffset": 625,
                "PartOfSpeech": {
                    "Tag": "NUM",
                    "Score": 0.9994412660598755
                }
            },
            {
                "TokenId": 109,
                "Text": "or",
                "BeginOffset": 626,
                "EndOffset": 628,
                "PartOfSpeech": {
                    "Tag": "CONJ",
                    "Score": 0.999998152256012
                }
            },
            {
                "TokenId": 110,
                "Text": "email",
                "BeginOffset": 629,
                "EndOffset": 634,
                "PartOfSpeech": {
                    "Tag": "NOUN",
                    "Score": 0.9792916774749756
                }
            },
            {
                "TokenId": 111,
                "Text": "at",
                "BeginOffset": 635,
                "EndOffset": 637,
                "PartOfSpeech": {
                    "Tag": "ADP",
                    "Score": 0.9998379349708557
                }
            },
            {
                "TokenId": 112,
                "Text": "support@anycompany.com",
                "BeginOffset": 638,
                "EndOffset": 660,
                "PartOfSpeech": {
                    "Tag": "PROPN",
                    "Score": 0.8361684083938599
                }
            },
            {
                "TokenId": 113,
                "Text": ".",
                "BeginOffset": 660,
                "EndOffset": 661,
                "PartOfSpeech": {
                    "Tag": "PUNCT",
                    "Score": 0.9999966025352478
                }
            }
        ]
    }
}`;
        responsedataprocessing(JSON.parse(testdataobject));
        showentitytab();

        function callcomprehend() {

            if (textfromarea.length < 30) {
                alert('Minimum 30 charecter long text required');
                return false;
            }
            document.getElementById("btnAnalyze").style.display = "none";
            document.getElementById("btnanalyzing").style.display = "block";
            textfromarea = document.getElementById("comprehendtextara").value;


            var requestOptions = {
                method: 'POST',
                redirect: 'follow'
            };
            fetch("http://127.0.0.1:8000/api/comprehend?text=" + textfromarea,
                    requestOptions)
                .then(response => response.json())
                .then(result => {
                    console.log(result)
                    responsedataprocessing(result);
                    document.getElementById("btnAnalyze").style.display = "block";
                    document.getElementById("btnanalyzing").style.display = "none";
                    // console.log(result.Entities);
                })
                .catch(error => console.log('error', error));
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
                cell3.innerHTML = score.toFixed(10);
            } //for end

            document.getElementById("entity_textaradisabled").innerHTML = temp_textfromarea;


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
                cell2.innerHTML = data[index].Score;
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
                cell2.innerHTML = data[index].Score;

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
                row2_cell3.innerHTML = data[index].Score;
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
                cell2.innerHTML = data[index].Score;
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
                cell2.innerHTML = data.SentimentScore.Positive;

                var row = tablebodyObj.insertRow(1);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                cell1.innerHTML = "Negative";
                cell2.innerHTML = data.SentimentScore.Negative;

                var row = tablebodyObj.insertRow(2);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                cell1.innerHTML = "Neutral";
                cell2.innerHTML = data.SentimentScore.Neutral;

                var row = tablebodyObj.insertRow(3);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                cell1.innerHTML = "Mixed";
                cell2.innerHTML = data.SentimentScore.Mixed;
            }
            document.getElementById("sentiment_textaradisabled").innerHTML = textfromarea;
            // updateHTML_response(JSON.stringify(data, null, '\t'));

        }

        function syntaxdataprocessing(data) {
            var count = data.length;
            var tableobj = document.getElementById("tbodysyntaxtable");
            tableobj.innerHTML = "";
            var textstyled = '';
            // var payloaddata = '';
            // var payloaddata1 = '';
            // console.log(data);
            for (let index = 0; index < count; index++) {
                var row = tableobj.insertRow(index);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                // console.log(data[index]);
                cell1.innerHTML = data[index].Text;
                text = data[index].Text;
                // payloaddata = payloaddata + " " + text;

                // if (payloaddata.length > 40) {
                //     payloaddata1 = payloaddata1 + "\n" + payloaddata;
                //     payloaddata = '';
                // }


                textstyled = textstyled + ` <span class="hoveronspan">` + text + "</span>";
                cell2.innerHTML = data[index].PartOfSpeech.Tag;
                cell3.innerHTML = data[index].PartOfSpeech.Score;
            }
            document.getElementById("syntax_textaradisabled").innerHTML = textstyled;
            // updateHTML_response(JSON.stringify(data, null, '\t'));


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

        }

        function togglepiioptions() {
            radios = document.getElementsByName('piioptions');
            var selected = Array.from(radios).find(radio => radio.checked);

            if (selected.value == 'offset') {
                document.getElementsByClassName('divtogglekeypii')[1].style.display = 'block';
                document.getElementsByClassName('divtogglekeypii')[2].style.display = 'none';
                document.getElementsByClassName('divtogglekeypii')[3].style.display = 'block';

            } else {
                document.getElementsByClassName('divtogglekeypii')[1].style.display = 'none';
                document.getElementsByClassName('divtogglekeypii')[2].style.display = 'block';
                document.getElementsByClassName('divtogglekeypii')[3].style.display = 'none';

            }


        }

        function entitidata_filter() {
            var searchvalue = document.getElementById('searchentity').value;
            searchvalue = searchvalue.toUpperCase();
            console.log(searchvalue);
            datavalues = Object.values(entities);
            console.log(datavalues);

            var text_filter = datavalues.filter(element => ((element.Text).toUpperCase()).search(searchvalue) != -1);
            console.log(text_filter.length);

            var type_filter = (text_filter.length == 0 ? datavalues : text_filter).filter(element => ((element.Type)
                .toUpperCase()).search(searchvalue) != -1);
            console.log(type_filter.length);


            if (text_filter.length == 0 && type_filter.length == 0) {
                tempentities = datavalues;
            } else if (type_filter.length == 0) {
                tempentities = text_filter;
            } else {
                tempentities = type_filter;
            }

            console.log(tempentities);
            entitydataprocessing(tempentities);
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
        }

        function syntax_filter() {
            var searchvalue = document.getElementById('syntaxseachtext').value;
            searchvalue = searchvalue.toUpperCase();
            console.log(searchvalue);
            datavalues = Object.values(syntaxtokens);
            console.log(datavalues);

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

            console.log(temdata);
            syntaxdataprocessing(temdata);
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
    </script>
@endpush

@push('header')
    <h1>Comprehend Demonstration</h1>
@endpush

@push('aside')
    <h4 class="selected">Comprehend</h4>
@endpush

@push('artical')
    <div class="comprehendbodydiv">

        {{-- text area div --}}
        <div class="textareadiv">
            <label for="comprehendtextara" class="headings">Input Text</label>
            <textarea id="comprehendtextara" class="textinput" name="" maxlength="100000"
                placeholder="But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and">Hello Zhang Wei, I am John. Your AnyCompany Financial Services, LLC credit card account 1111-0000-1111-0008 has a minimum payment of $24.53 that is due by July 31st. Based on your autopay settings, we will withdraw your payment on the due date from your bank account number XXXXXX1111 with the routing number XXXXX0000.

Your latest statement was mailed to 2200 West Cypress Creek Road, 1st Floor, Fort Lauderdale, Florida, 33309.
After your payment is received, you will receive a confirmation text message at 206-555-0100.
If you have questions about your bill, AnyCompany Customer Service is available by phone at 206-555-0199 or email at support@anycompany.com.</textarea>
            <p id="textremaining-p" class="pChars">100000 Characters remaining</p>

            <div class="textareadivbtns">
                <button class="btnClear btn" onclick="cleartext()">CLEAR TEXT</button>
                <button id="btnAnalyze" class="btnAnalyze btn" onclick="callcomprehend()">analyze</button>

                <button id="btnanalyzing" type="button" class="btnAnalyze btn" onclick="convert()">
                    <i id="converting" class="fa fa-spinner fa-spin"></i> analyzing
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
                        <span>
                            < </span>
                                <a href="" class="selected">1</a>
                                <a href="">2</a>
                                <a href="">3</a>
                                <span> > </span>
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
                        <span>
                            < </span>
                                <a href="" class="selected">1</a>
                                <a href="">2</a>
                                <a href="">3</a>
                                <span> > </span>
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

                    <div id="paginationpii" class="pagination">
                        <span>
                            < </span>
                                <a href="" class="selected">1</a>
                                <a href="">2</a>
                                <a href="">3</a>
                                <span> > </span>
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

                    <div id="paginationentity" class="pagination">
                        <span>
                            < </span>
                                <a href="" class="selected">1</a>
                                <a href="">2</a>
                                <a href="">3</a>
                                <span> > </span>
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
                        <span>
                            < </span>
                                <a href="" class="selected">1</a>
                                <a href="">2</a>
                                <a href="">3</a>
                                <span> > </span>
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
@endpush

<style>
    .comprehendbodydiv {
        width: 100%;
        height: 100%;
        overflow: auto;
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
        border-radius: 5px;
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

    .btn {
        font-weight: 400 !important;
    }


    .btnAnalyze {
        color: #FFFFFF !important;
        background-color: #0091FF !important;
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
    }

    .comprehendtextaradisabled::-webkit-scrollbar {
        display: none;
        /* Safari and Chrome */
    }


    .btn {
        height: 30px !important;
        width: 98px !important;
        text-transform: uppercase;
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
        margin: 15px;
    }

    .titleanalyzedtextp {
        color: #111111;
        font-weight: bold;
        margin-bottom: 7px;
    }

    /* styling result content  inside results */
    .results {
        margin: 15px 15px 20px 15px;
    }

    .results p {
        margin-bottom: 15px;
    }

    .results .tools {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        margin-bottom: 15px;
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
        width: 400px;
        border: none;
        font-weight: 600;
    }


    /* pagination */
    .pagination {
        display: flex;
        justify-content: space-between;
        width: 150px;
        text-align: center;
        align-content: center;
        font-size: 16px;
        font-weight: 900;
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

    tbody tr .tdcol2 {}

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

    .comprehendresultdiv {
        /* display: none; */
    }

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
</style>
