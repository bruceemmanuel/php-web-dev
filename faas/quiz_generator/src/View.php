<!DOCTYPE html>
<html>
	<head>
		<title>Faas - quiz</title>
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open Sans"/>
    </head>
    <style>
        body {
            font-family: Open Sans;
        }

        #quiz {
            text-indent: 10px;
            display:none;
        }

        .button {
            padding: 3px 10px;
            border-radius: 4px;
            float:right;
            background-color: #DCDCDC;
            margin: 0 2px 0 2px;
            box-shadow: 2px 2px 2px #88888899;
        }

        .button.active {
            background-color: #F8F8FF;
            color: #525252;
        }

        button {
            position: relative;
            float:right;
        }

        .button a {
            text-decoration: none;
            color: black;
        }

        #container {
            width:50%;
            margin:auto;
            padding: 10px 25px 40px 15px;
            background-color: #1E90FF;
            color: #FFFFFF;
            font-weight: bold;
            box-shadow: 4px 4px 4px #88888899;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        #prev {
            display:none;
        }

        #start {
            display:none;
            width: 90px;
        }
    </style>
	<body>
		<div id='container'>
  			<div id='quiz'></div>
    		<div class='button' id='next'><a href='#'>Next</a></div>
    		<div class='button' id='prev'><a href='#'>Prev</a></div>
    		<div class='button' id='start'> <a href='#'>Start Over</a></div>
    	</div>

		<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>
        <script>
            (function() {
                var json = '<?= $json ?>'
                var questions = JSON.parse(json)
                
                var questionCounter = 0; //Tracks question number
                var selections = []; //Array containing user choices
                var quiz = $('#quiz'); //Quiz div object
                
                // Display initial question
                displayNext();
                
                // Click handler for the 'next' button
                $('#next').on('click', function (e) {
                    e.preventDefault();
                    
                    // Suspend click listener during fade animation
                    if(quiz.is(':animated')) {        
                        return false;
                    }
                    choose();
                    
                    // If no user selection, progress is stopped
                    if (isNaN(selections[questionCounter])) {
                        alert('Please make a selection!');
                    } else {
                        questionCounter++;
                        displayNext();
                    }
                });
                
                // Click handler for the 'prev' button
                $('#prev').on('click', function (e) {
                    e.preventDefault();
                    
                    if(quiz.is(':animated')) {
                        return false;
                    }
                    choose();
                    questionCounter--;
                    displayNext();
                });
                
                // Click handler for the 'Start Over' button
                $('#start').on('click', function (e) {
                    e.preventDefault();
                    
                    if(quiz.is(':animated')) {
            return false;
            }
            questionCounter = 0;
            selections = [];
            displayNext();
            $('#start').hide();
        });
        
        // Animates buttons on hover
        $('.button').on('mouseenter', function () {
            $(this).addClass('active');
        });
        $('.button').on('mouseleave', function () {
            $(this).removeClass('active');
        });
        
        // Creates and returns the div that contains the questions and 
        // the answer selections
        function createQuestionElement(index) {
            var qElement = $('<div>', {
                id: 'question'
            });
            
            var header = $('<h2>Question ' + (index + 1) + ':</h2>');
            qElement.append(header);
            
            var question = $('<p>').append(questions[index].question);
                qElement.append(question);
                
                var radioButtons = createRadios(index);
                qElement.append(radioButtons);
                
                return qElement;
            }
            
            // Creates a list of the answer choices as radio inputs
            function createRadios(index) {
                var radioList = $('<ul>');
                    var item;
                    var input = '';
                    for (var i = 0; i < questions[index].choices.length; i++) {
                        item = $('<li>');
                            input = '<input type="radio" name="answer" value=' + i + ' />';
                            input += questions[index].choices[i];
                            item.append(input);
                            radioList.append(item);
                        }
                        return radioList;
                    }
                    
                    // Reads the user selection and pushes the value to an array
                    function choose() {
                        selections[questionCounter] = +$('input[name="answer"]:checked').val();
        }
        
        // Displays next requested element
        function displayNext() {
            quiz.fadeOut(function() {
                $('#question').remove();
                
                if(questionCounter < questions.length){
                    var nextQuestion = createQuestionElement(questionCounter);
                    quiz.append(nextQuestion).fadeIn();
                    if (!(isNaN(selections[questionCounter]))) {
                        $('input[value='+selections[questionCounter]+']').prop('checked', true);
                    }
                    
                    // Controls display of 'prev' button
                    if(questionCounter === 1){
                        $('#prev').show();
                    } else if(questionCounter === 0){
                        
                        $('#prev').hide();
                        $('#next').show();
                    }
                }else {
                    var scoreElem = displayScore();
                    quiz.append(scoreElem).fadeIn();
                    $('#next').hide();
                    $('#prev').hide();
                    $('#start').show();
                }
            });
        }
        
        // Computes score and returns a paragraph element to be displayed
        function displayScore() {
            var score = $('<p>',{id: 'question'});
                
                var numCorrect = 0;
                for (var i = 0; i < selections.length; i++) {
                    if (selections[i] === questions[i].correctAnswer) {
                        numCorrect++;
                    }
                }
                
                score.append('You got ' + numCorrect + ' questions out of ' +
                questions.length + ' right!!!');
                return score;
            }
        })();
        </script>
    </body>
</html>
