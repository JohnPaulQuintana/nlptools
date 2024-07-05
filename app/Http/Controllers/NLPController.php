<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;
use NlpTools\Classifiers\MultinomialNBClassifier;
use NlpTools\Documents\TokensDocument;
use NlpTools\Documents\TrainingSet;
use NlpTools\FeatureFactories\DataAsFeatures;
use NlpTools\Models\FeatureBasedNB;
use NlpTools\Tokenizers\WhitespaceAndPunctuationTokenizer;
use NlpTools\Tokenizers\WhitespaceTokenizer;

class NLPController extends Controller
{
    protected $classifier;
    protected $tokenizer;


    public function index(){
        // Define a greeting message
        $greetings = "Hello! Welcome to the Exousia Navi 2D Navigation Guide demo website. This site is for demonstration purposes only.";

        // Set timezone to Manila
        date_default_timezone_set('Asia/Manila'); // Set your timezone

        $hour = date('H');

        if ($hour >= 5 && $hour < 12) {
            $greetings = "Good morning! Welcome to the Exousia Navi 2D Navigation Guide demo website. This site is for demonstration purposes only.";
        } elseif ($hour >= 12 && $hour < 18) {
            $greetings = "Good afternoon! Welcome to the Exousia Navi 2D Navigation Guide demo website. This site is for demonstration purposes only.";
        } else {
            $greetings = "Good evening! Welcome to the Exousia Navi 2D Navigation Guide demo website. This site is for demonstration purposes only.";
        }
        return view('welcome', compact('greetings'));
    }

    //tokenizer sample usage
    private function tokenizer($text){
        $tok = new WhitespaceAndPunctuationTokenizer();
        return $tok->tokenize($text);// this is the tokenizer
    }

    //classification example usage
    public function classify(){
        // Initialize the tokenizer and classifier
        // $this->tokenizer = new WhitespaceAndPunctuationTokenizer();
        $text = 'Hello there...';
        $tokens = $this->tokenizer->tokenize($text);
        $doc = new TokensDocument($tokens);

        $prediction = $this->classifier->classify(['greetings', 'ham', 'spam'], $doc);

        return response()->json(['text' => $text, 'prediction' => $prediction]);

    }

    public function evaluate()
    {
        // Testing data
        $testing = [
            ['greetings', 'Good morning!'],
            ['ham', 'I\'ve been searching for the right words to thank you for this breather. I promise i wont take your help for granted and will fulfil my promise. You have been wonderful and a blessing at all times.'],
            ['ham', 'I HAVE A DATE ON SUNDAY WITH WILL!!'],
            ['spam', 'XXXMobileMovieClub: To use your credit, click the WAP link in the next txt message or click here>> http://wap.xxxmobilemovieclub.com?n=QJKGIGHJJGCBL'],
        ];

        $correct = 0;
        foreach ($testing as $d) {
            $prediction = $this->classifier->classify(
                ['greetings', 'ham', 'spam'], // all possible classes
                new TokensDocument(
                    $this->tokenizer->tokenize($d[1]) // The document
                )
            );
            if ($prediction == $d[0]) {
                $correct++;
            }
        }

        $accuracy = 100 * $correct / count($testing);

        return response()->json(['accuracy' => $accuracy]);
    }

    //classification example usage
    private function classify2(){
        // we use a part for training
        $training = array(
            array('greetings','Hello There...'),
            ...
            array('ham','Fine if that\'s the way u feel. That\'s the way its gota b'),
            array('spam','England v Macedonia - dont miss the goals/team news. Txt ur national team to 87077 eg ENGLAND to 87077 Try:WALES, SCOTLAND 4txt/ú1.20 POBOXox36504W45WQ 16+')
        );
        // and another for evaluating
        $testing = array(
            array('ham','I\'ve been searching for the right words to thank you for this breather. I promise i wont take your help for granted and will fulfil my promise. You have been wonderful and a blessing at all times.'),
            ...
            array('ham','I HAVE A DATE ON SUNDAY WITH WILL!!'),
            array('spam','XXXMobileMovieClub: To use your credit, click the WAP link in the next txt message or click here>> http://wap. xxxmobilemovieclub.com?n=QJKGIGHJJGCBL')
        );
         
        $tset = new TrainingSet(); // will hold the training documents
        $tok = new WhitespaceTokenizer(); // will split into tokens
        $ff = new DataAsFeatures(); // see features in documentation

        // ---------- Training ----------------
        foreach ($training as $d)
        {
            $tset->addDocument(
                $d[0], // class
                new TokensDocument(
                    $tok->tokenize($d[1]) // The actual document
                )
            );
        }

        $model = new FeatureBasedNB(); // train a Naive Bayes model
        $model->train($ff,$tset);

        // ---------- Classification ----------------
        $cls = new MultinomialNBClassifier($ff,$model);
        $correct = 0;
        foreach ($testing as $d)
        {
            // predict if it is spam or ham
            $prediction = $cls->classify(
                array('ham','spam'), // all possible classes
                new TokensDocument(
                    $tok->tokenize($d[1]) // The document
                )
            );
            if ($prediction==$d[0])
                $correct ++;
        }

        return 100*$correct / count($testing);
    }

    

    public function classifyAndEvaluate()
    {
        // // Training data
        // $training = [
        //     ['greetings', 'Hello there...'],
        //     ['greetings', 'Hi, how are you?'],
        //     ['ham', 'Go until jurong point, crazy.. Available only in bugis n great world la e buffet... Cine there got amore wat...'],
        //     ['ham', 'Fine if that\'s the way u feel. That\'s the way its gota b'],
        //     ['spam', 'England v Macedonia - dont miss the goals/team news. Txt ur national team to 87077 eg ENGLAND to 87077 Try:WALES, SCOTLAND 4txt/ú1.20 POBOXox36504W45WQ 16+'],
        // ];

        // // Create a training set
        // $tset = new TrainingSet();
        // $ff = new DataAsFeatures();
        // $tok = new WhitespaceTokenizer();

        // foreach ($training as $d) {
        //     $tset->addDocument(
        //         $d[0], // class
        //         new TokensDocument(
        //             $tok->tokenize($d[1]) // The actual document
        //         )
        //     );
        // }

        // // Train the classifier
        // $model = new FeatureBasedNB();
        // $model->train($ff, $tset);
        // $this->classifier = new MultinomialNBClassifier($ff, $model);
        // $this->tokenizer = $tok;

        // Classify user input
        $text = "hello...";
        $tokens = $this->tokenizer->tokenize($text);
        $doc = new TokensDocument($tokens);

        $prediction = $this->classifier->classify(['greetings', 'ham', 'spam'], $doc);

        // Evaluation
        $testing = [
            ['greetings', 'Good morning!'],
            ['ham', 'I\'ve been searching for the right words to thank you for this breather. I promise i wont take your help for granted and will fulfil my promise. You have been wonderful and a blessing at all times.'],
            ['ham', 'I HAVE A DATE ON SUNDAY WITH WILL!!'],
            ['spam', 'XXXMobileMovieClub: To use your credit, click the WAP link in the next txt message or click here>> http://wap.xxxmobilemovieclub.com?n=QJKGIGHJJGCBL'],
        ];

        $correct = 0;
        foreach ($testing as $d) {
            $testTokens = $this->tokenizer->tokenize($d[1]);
            $testDoc = new TokensDocument($testTokens);

            $testPrediction = $this->classifier->classify(
                ['greetings', 'ham', 'spam'], // all possible classes
                $testDoc
            );

            if ($testPrediction == $d[0]) {
                $correct++;
            }
        }

        $accuracy = 100 * $correct / count($testing);

        return response()->json(['text' => $text, 'prediction' => $prediction, 'accuracy' => $accuracy]);
    }

    //custom approach

    public function tokenizeInput(){
        $text = 'where is et and sit';
        //tokenize the input
        $tokens = $this->tokenizer->tokenize($text);

        //get the key in database
        $keys = Information::pluck('key')->toArray();
        // Find matches between tokens and keys
        $matches = array_intersect($tokens, $keys);

        // Query the database to get records that match the specific tokens
        $matchedRecords = Information::with(['informationDetail:id,information_id,fullname'])->whereIn('key', $matches)->get();
        dd($matchedRecords);
    }
}
