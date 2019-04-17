<?php

namespace App;

/**
 * Class Handler
 * @package App
 */
class Handler
{
    /**
     * @param $data
     * @return
     */
    public function handle($data)
    {
        $textQuestions = explode("@question", $data);
        $questions = [];

        foreach ($textQuestions as $textQuestion) {
            $question = $this->process($textQuestion) AND array_push($questions, $question);
        }

        shuffle($questions);
        $json = json_encode($questions);

        ob_start();
        include __DIR__ . "/View.php";
        $page = ob_get_clean();
        
        return $page;
    }

    private function process(string $question)
    {
        $headers = [];
        if (!preg_match("/@header(.*)@end/sU", $question, $headers)) return false;
    
        $options = [];
        if (!preg_match_all("/@option(.*)@end/sU", $question, $options)) return false;
    
        $correctAnswer = -1;
        $matches = [];
        foreach ($options[1] as $key => $value) {
            if (preg_match("/^\s*correct(.*)/s", $value, $matches)) {
                $correctAnswer = $key;
                $options[1][$key] = $matches[1];
            }
        }
        if ($correctAnswer === -1) return false;
        
        $question = new Question($headers[1], $options[1], $correctAnswer);
        $question->shuffle();
        return $question;
    }
}
