<?php
    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\AdminController;
    use Illuminate\Http\Request;
    use App\Http\Requests\StoreAnswers;
    use App\Models\Answers;
use App\Models\Questions;
use Illuminate\Support\Collection;

    class AnswersController extends AdminController
    {
        public function __construct()
        {
            $this->data['menu_group'] = 'answers';
            $this->data['active'] = 'answers';
        }
        public function index()
        {
            $this->data['answers'] = Answers::orderByDesc('id')->get();
            $this->data['link'] = route('admin.answers.create');
            $this->data['title'] = 'All '.ucwords(str_replace('_', ' ', 'answers'));
            $this->data['button_name'] = 'Add '.ucwords(str_replace('_', ' ', 'answers'));
            return $this->admin_view('answers.list', $this->data);
        }
        
        public function create()
        {
            $this->data['title'] = "Create New ".ucwords(str_replace('_', ' ', 'Answers'));
            $this->data['questions'] = Questions::orderByDesc('id')->get();
            return $this->admin_view('answers.create', $this->data);
        }
        
        public function store(StoreAnswers $request)
        {
            $answer = Answers::create($request->all());
            return redirect()->back()->with(['message' => 'New '.ucwords(str_replace('_', ' ', 'answers')).' data stored.']);
            // return response()->json(['status' => true, 'message' => 'New answers data stored.', 'redirect' => route('admin.answers.index')], 201);
        }
        
        public function show(Answers $answer)
        {
            $this->data['answer'] = $answer;
            $this->data['title'] = 'Showing Answers detail';
            return $this->admin_view('answers.show', $this->data);
        }
        
        public function edit(Answers $answer)
        {
            $this->data['answer'] = $answer;
            $this->data['title'] = 'Edit '.ucwords(str_replace('_', ' ', 'answer'));
            return $this->admin_view('answers.edit', $this->data);
        }
        
        public function update(StoreAnswers $request, Answers $answer)
        {
            if (!$answer) {
                return response()->json(['status' => false, 'message' => ucwords(str_replace('_', ' ', 'answer')).' not found', 'redirect' => false], 404);
            }

            $answer->question_id = $request->question_id;
			$answer->answer = $request->answer;
			$answer->isCorrect = $request->isCorrect;
			
            
            $answer->save();
            return redirect(route('admin.answers.index'))->with(['message' => ucwords(str_replace('_', ' ', 'answer')).' data updated.']);
            return response()->json(['status' => true, 'message' => 'New answer data updated.', 'redirect' => route('admin.answers.index')], 200);
        }
        
        public function destroy(Answers $answer)
        {
            if (!$answer) {
                return response()->json(['status' => false, 'message' => 'answer not found', 'redirect' => false], 404);
            }
            
            Answers::destroy($answer->id);
            return redirect(route('admin.answers.index'))->with(['message' => ucwords(str_replace('_', ' ', 'answer')).' deleted']);
            return response()->json(['status' => true, 'message' => ucwords(str_replace('_', ' ', 'answer')).' deleted', 'redirect' => route('admin.answers.index')]);
        }
    }
