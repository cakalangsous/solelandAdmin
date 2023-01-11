<?php
    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\AdminController;
    use Illuminate\Http\Request;
    use App\Http\Requests\StoreQuestionCategories;
use App\Models\Cities;
use App\Models\QuestionCategories;
    use Illuminate\Support\Collection;

    class QuestionCategoriesController extends AdminController
    {
        public function __construct()
        {
            $this->data['menu_group'] = 'question_categories';
            $this->data['active'] = 'question_categories';
            $this->data['parent'] = 'quiz';

        }
        public function index()
        {
            $this->data['question_categories'] = QuestionCategories::orderByDesc('id')->get();
            $this->data['link'] = route('admin.question_categories.create');
            $this->data['title'] = 'All '.ucwords(str_replace('_', ' ', 'question_categories'));
            $this->data['button_name'] = 'Add '.ucwords(str_replace('_', ' ', 'question_categories'));
            return $this->admin_view('questionCategories.list', $this->data);
        }
        
        public function create()
        {
            $this->data['title'] = "Create New ".ucwords(str_replace('_', ' ', 'QuestionCategories'));
            return $this->admin_view('questionCategories.create', $this->data);
        }
        
        public function store(StoreQuestionCategories $request)
        {
            $question_category = QuestionCategories::create($request->all());
            return redirect(route('admin.question_categories.index'))->with(['message' => 'New '.ucwords(str_replace('_', ' ', 'question_categories')).' data stored.']);
            return response()->json(['status' => true, 'message' => 'New question_categories data stored.', 'redirect' => route('admin.question_categories.index')], 201);
        }
        
        public function show(QuestionCategories $question_category)
        {
            $this->data['question_category'] = $question_category;
            $this->data['title'] = 'Showing QuestionCategories detail';
            return $this->admin_view('questionCategories.show', $this->data);
        }
        
        public function edit(QuestionCategories $question_category)
        {
            $this->data['question_category'] = $question_category;
            $this->data['title'] = 'Edit '.ucwords(str_replace('_', ' ', 'question_category'));
            return $this->admin_view('questionCategories.edit', $this->data);
        }
        
        public function update(StoreQuestionCategories $request, QuestionCategories $question_category)
        {
            if (!$question_category) {
                return response()->json(['status' => false, 'message' => ucwords(str_replace('_', ' ', 'question_category')).' not found', 'redirect' => false], 404);
            }

            $question_category->name = $request->name;
			
            
            $question_category->save();
            return redirect(route('admin.question_categories.index'))->with(['message' => ucwords(str_replace('_', ' ', 'question_category')).' data updated.']);
            return response()->json(['status' => true, 'message' => 'New question_category data updated.', 'redirect' => route('admin.question_categories.index')], 200);
        }
        
        public function destroy(QuestionCategories $question_category)
        {
            if (!$question_category) {
                return response()->json(['status' => false, 'message' => 'question_category not found', 'redirect' => false], 404);
            }
            
            QuestionCategories::destroy($question_category->id);
            return redirect(route('admin.question_categories.index'))->with(['message' => ucwords(str_replace('_', ' ', 'question_category')).' deleted']);
            return response()->json(['status' => true, 'message' => ucwords(str_replace('_', ' ', 'question_category')).' deleted', 'redirect' => route('admin.question_categories.index')]);
        }
    }
