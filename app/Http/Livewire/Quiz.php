<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Illuminate\Support\Arr;
use App\Models\Highscore;

class Quiz extends Component
{
    public $player;
    public $questionIndex = 1;
    public $questions;
    public $solution;
    public $question;
    public $score = 0;
    public $quizStarted = false;
    public $quizFinished = false;
    public $settingsOpen;
    public $numberOfQuestions = 10;
    public $difficulty;
    public $category;
    protected $listeners = ['timeUp'];
    public $timer = 60;

    public function mount()
    {
        $this->initQuiz();
    }

    public function render()
    {
        $this->highscores = Highscore::all();
        $this->highscores = $this->highscores->sortByDesc('score');
        return view('livewire.quiz');
    }

    public function create()
    {
        $this->resetCreateForm();
    }

    private function resetCreateForm()
    {
        $this->player = '';
    }

    public function store()
    {
        $this->validate([
            'player' => 'required',
        ]);
        Highscore::create([
            'player' => $this->player,
            'difficulty' => $this->difficulty ?? "Any",
            'category' => $this->category ?? "All",
            'score' => $this->score,
        ]);
        session()->flash('message', $this->player ? 'Highscore saved!' : '');
        $this->resetCreateForm();
    }

    public function timeUp()
    {
        $this->score -= 5;
    }

    public function checkAnswer(string $answer = null)
    {
        $this->solution = $answer;
        if ($answer === null) {
            $this->score -= 5;
        } else {
            if ($answer == Arr::get($this->question, 'correct_answer')) {
                $this->score += 10;
            } else {
                $this->score -= 5;
            }
            $this->timer = null;
        }
    }

    private function generateQuestion(array $question)
    {
        $answers = array_merge(Arr::get($question, 'incorrect_answers'), [Arr::get($question, 'correct_answer')]);
        $question['answers'] = collect($answers)->shuffle()->toArray();
        return $question;
    }

    public function nextQuestion()
    {
        if ($this->timer = 0) {
            $this->score -= 5;
        }
        if ($this->solution == null) {
            $this->score -= 5;
        }
        if ($this->questionIndex < $this->numberOfQuestions) {
            $this->question = $this->generateQuestion(Arr::get($this->questions, $this->questionIndex));
            $this->questionIndex++;

            $this->reset('solution');
            $this->reset('timer');
        } else {
            $this->reset('timer');
            $this->quizFinished = true;
        }
    }

    public function playAgain()
    {
        $this->initQuiz();
        $this->quizFinished = false;
        $this->quizStarted = false;
        $this->questionIndex = 1;
        $this->score = 0;
        $this->reset('solution');
        $this->reset('timer');
    }

    public function saveSettings()
    {
        $this->initQuiz();
        $this->quizFinished = false;
        $this->quizStarted = true;
        $this->questionIndex = 1;
        $this->score = 0;
        $this->reset('timer');
        $this->reset('solution');
    }

    public function initQuiz()
    {
        $response = Http::get('https://opentdb.com/api.php?amount=' . $this->numberOfQuestions . $this->category . $this->difficulty . '&type=multiple')->json();
        $this->questions = Arr::get($response, 'results');
        $this->question = $this->generateQuestion(Arr::first($this->questions));
    }
}
