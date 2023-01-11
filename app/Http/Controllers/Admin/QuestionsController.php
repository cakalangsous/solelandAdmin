<?php
    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\AdminController;
    use Illuminate\Http\Request;
    use App\Http\Requests\StoreQuestions;
use App\Models\Answers;
use App\Models\Cities;
use App\Models\QuestionCategories;
use App\Models\Questions;
    use Illuminate\Support\Collection;

    class QuestionsController extends AdminController
    {
        public function __construct()
        {
            $this->data['menu_group'] = 'questions';
            $this->data['active'] = 'questions';
            $this->data['parent'] = 'quiz';
        }
        public function index()
        {
            $this->data['questions'] = Questions::with(["category", "city"])->orderByDesc('id')->get();
            $this->data['link'] = route('admin.questions.create');
            $this->data['title'] = 'All '.ucwords(str_replace('_', ' ', 'questions'));
            $this->data['button_name'] = 'Add '.ucwords(str_replace('_', ' ', 'questions'));
            return $this->admin_view('questions.list', $this->data);
        }
        
        public function create()
        {
            $this->data['title'] = "Create New ".ucwords(str_replace('_', ' ', 'Questions'));
            $this->data["cities"] = Cities::all();
            $this->data["category"] = QuestionCategories::all();
            $this->data['active'] = 'add_questions';
            return $this->admin_view('questions.create', $this->data);
        }
        
        public function store(StoreQuestions $request)
        {
            $question = Questions::create($request->all());
            return redirect(route('admin.questions.index'))->with(['message' => 'New '.ucwords(str_replace('_', ' ', 'questions')).' data stored.']);
            // return response()->json(['status' => true, 'message' => 'New questions data stored.', 'redirect' => route('admin.questions.index')], 201);
        }
        
        public function show(Questions $question)
        {
            $this->data['question'] = $question;
            $this->data['title'] = 'Showing Questions detail';
            return $this->admin_view('questions.show', $this->data);
        }
        
        public function edit(Questions $question)
        {
            $this->data['question'] = $question;
            $this->data['answer'] = Answers::where("question_id", $question->id)->get();
            $this->data["category"] = QuestionCategories::all();
            $this->data["cities"] = Cities::all();
            $this->data['title'] = 'Edit '.ucwords(str_replace('_', ' ', 'question'));
            return $this->admin_view('questions.edit', $this->data);
        }
        
        public function update(StoreQuestions $request, Questions $question)
        {
            if (!$question) {
                return response()->json(['status' => false, 'message' => ucwords(str_replace('_', ' ', 'question')).' not found', 'redirect' => false], 404);
            }

            $question->category_id = $request->category_id;
			$question->city_id = $request->city_id;
			$question->type = $request->type;
			$question->question = $request->question;
			$question->reward_exp = $request->reward_exp;
			$question->reward_item = $request->reward_item;
			
            
            $question->save();
            return redirect(route('admin.questions.index'))->with(['message' => ucwords(str_replace('_', ' ', 'question')).' data updated.']);
            return response()->json(['status' => true, 'message' => 'New question data updated.', 'redirect' => route('admin.questions.index')], 200);
        }
        
        public function destroy(Questions $question)
        {
            if (!$question) {
                return response()->json(['status' => false, 'message' => 'question not found', 'redirect' => false], 404);
            }
            
            Questions::destroy($question->id);
            return redirect(route('admin.questions.index'))->with(['message' => ucwords(str_replace('_', ' ', 'question')).' deleted']);
            return response()->json(['status' => true, 'message' => ucwords(str_replace('_', ' ', 'question')).' deleted', 'redirect' => route('admin.questions.index')]);
        }
    }
