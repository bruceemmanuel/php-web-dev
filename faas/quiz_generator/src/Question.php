<?php

namespace App;

class Question
{
    public $question;
    public $choices;
    public $correctAnswer;

    function __construct(string $question, array $choices, int $correctAnswer)
    {
        $this->question = $this->escape($question);
        $this->choices = [];
        foreach ($choices as $choice) { array_push($this->choices, $this->escape($choice)); }
        $this->correctAnswer = $correctAnswer;
    }

    private function escape(string $text) : string
    {
        $text = preg_replace("/^\s*\\n\s*/","", $text);
        $text = htmlspecialchars($text, ENT_QUOTES);
        $text = nl2br($text);
        $text = preg_replace("/(.*)&quot;&quot;&quot;(.*)&quot;&quot;&quot;(.*)/s", "$1<pre>$2</pre>$3", $text);
        return str_replace(["\r\n", "\n", "\r"], "", $text);
    }

    public function shuffle()
    {
        $answer = $this->choices[$this->correctAnswer];
        shuffle($this->choices);

        foreach ($this->choices as $key => $value) {
            if ($answer === $value) {
                $this->correctAnswer = $key;
                break;
            }
        }
    }
}