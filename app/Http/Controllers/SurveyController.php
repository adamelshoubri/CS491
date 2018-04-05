<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Survey;
use App\Question;
use App\SliderQuestion;
use App\MultipleChoiceItem;
use App\MatrixChoice;
use App\SkipLogic;

class SurveyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('surveys.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            //convert request object to associative array
            $data = $request->json()->all();

            //grab survey title and survey questions
            $survey_data = $data['survey'];
            $questions = $survey_data['questions'];

            //create new survey object
            $survey = new Survey;

            //set the survey title and store the survey object
            $survey->title = $survey_data['title'];
            $survey->user_id = auth()->user()->id;
            $survey->save();

            //iterate through questions and store question data
            for($i = 0; $i < count($questions); $i++) {
                $saved_question_id = $this->store_question($questions[$i], $survey);

                //check if question has skip logic enabled
                if(array_key_exists('dependents', $questions[$i])) {
                    //check if there are dependent questions
                    if(count($questions[$i]['dependents']['questions']) > 0) {
                        //store skip logic conditions
                        $skip_logic = new SkipLogic;
                        $skip_logic->question_id = $saved_question_id;
                        $skip_logic->condition = $questions[$i]['dependents']['condition'];
                        $skip_logic->response = $questions[$i]['dependents']['response'];
                        $skip_logic->save();

                        //store all dependent questions
                        foreach($questions[$i]['dependents']['questions'] as $dependent) {
                            $this->store_question($dependent, $skip_logic);
                        }
                    }
                }
            }
        } catch (QueryException $e) {
            $request->session()->flash('error', 'There was an error saving your survey. Please try again.');
            return ['redirect' => route('dashboard')];
        }

        $request->session()->flash('success', 'Your survey has been saved');
        return ['redirect' => route('dashboard')];
    }

    private function store_question($data, $parent) {
        /*
            This method takes two arguments: Question data and the parent
            to which the question will belong.
            Top-level questions belong to a Survey, and dependent questions
            belong to a SkipLogic (which in turn belongs to another question)
        */

        //store generic question data
        $question = new Question;

        $question->text = $data['text'];
        $question->required = $data['required'];
        $question->type = $data['type'];

        $parent->questions()->save($question);

        //store question-specific data
        //note: regular text questions do not have specific data

        switch($data['type']) {
            case 'slider':
                $slider = new SliderQuestion;
                $slider->min = $data['slidermin'];
                $slider->max = $data['slidermax'];
                $slider->increment = $data['increment'];
                $slider->question_id = $question->id;
                $slider->save();
                break;
            case 'matrix':
                foreach($data['radios'] as $matrixChoice) {
                    $choice = new MatrixChoice;
                    $choice->text = $matrixChoice;
                    $choice->question_id = $question->id;
                    $choice->save();
                }
            case 'radio':

            case 'checkbox':
            case 'sortable':
                foreach($data['choices'] as $multipleChoiceItem) {
                    $choice = new MultipleChoiceItem;
                    $choice->text = $multipleChoiceItem['text'];
                    $choice->question_id = $question->id;
                    $choice->save();
                }
                break;
        }

        return $question->id;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $survey = Survey::find($id);
        return view('surveys.show')->with('survey', $survey);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
