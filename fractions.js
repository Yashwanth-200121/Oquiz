var questionBank= [
    {
        question : '1/5 of 6 oranges: 6/5 orange : : 1/6 of 11 apples: ___apple',
        option : ['11/6','6/11','5/6','6/5'],
        answer : '11/6'
    },
    {
        question : 'Find the value of * in the following fractions. 5/7=∗/21',
        option : ['16','18','15','17'],
        answer : '15'
    },
    {
        question : 'By how much 32/70 is greater than 42/100?',
        option : ['45/94', '57/100', '13/350', '13/700'],
        answer : '13/350'
    },
    {
        question : 'Convert the following decimals into fractions. 1478/100000',
        option : ['147.8',' 0.1478',' 0.01478',' 14.78'],
        answer : '0.01478'
    },
    {
        question : 'If there are 7 apples and 5 oranges in the basket then what fraction of oranges are there in the fruit basket?',
        option : [ '5/7',' 7/5 ','7/12',' 5/12'],
        answer : '5/12'
    }
]

var question= document.getElementById('question');
var quizContainer= document.getElementById('quiz-container');
var scorecard= document.getElementById('scorecard');
var option0= document.getElementById('option0');
var option1= document.getElementById('option1');
var option2= document.getElementById('option2');
var option3= document.getElementById('option3');
var next= document.querySelector('.next');
var points= document.getElementById('score');
var span= document.querySelectorAll('span');
var i=0;
var score= 0;

//function to display questions
function displayQuestion(){
    for(var a=0;a<span.length;a++){
        span[a].style.background='none';
    }
    question.innerHTML= 'Q.'+(i+1)+' '+questionBank[i].question;
    option0.innerHTML= questionBank[i].option[0];
    option1.innerHTML= questionBank[i].option[1];
    option2.innerHTML= questionBank[i].option[2];
    option3.innerHTML= questionBank[i].option[3];
    stat.innerHTML= "Question"+' '+(i+1)+' '+'of'+' '+questionBank.length;
}

//function to calculate scores
function calcScore(e){
    if(e.innerHTML===questionBank[i].answer && score<questionBank.length)
    {
        score= score+1;
        document.getElementById(e.id).style.background= 'limegreen';
    }
    else{
        document.getElementById(e.id).style.background= 'tomato';
    }
    setTimeout(nextQuestion,300);
}

//function to display next question
function nextQuestion(){
    if(i<questionBank.length-1)
    {
        i=i+1;
        displayQuestion();
    }
    else{
        points.innerHTML= score+ '/'+ questionBank.length;
        quizContainer.style.display= 'none';
        scoreboard.style.display= 'block'
    }
}

//click events to next button
next.addEventListener('click',nextQuestion);

//Back to Quiz button event
function backToQuiz(){
    location.reload();
}

//function to check Answers
function checkAnswer(){
    var answerBank= document.getElementById('answerBank');
    var answers= document.getElementById('answers');
    answerBank.style.display= 'block';
    scoreboard.style.display= 'none';
    for(var a=0;a<questionBank.length;a++)
    {
        var list= document.createElement('li');
        list.innerHTML= questionBank[a].answer;
        answers.appendChild(list);
    }
}


displayQuestion();