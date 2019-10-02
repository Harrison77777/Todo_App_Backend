<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\TodoResource;
use App\Todo;
class TodoController extends Controller
{
    public function index(){

       return $allTodos =  TodoResource::collection(Todo::all());

    }
    public function addNewTodos(Request $request){

        $validate = Validator::make($request->all(), [
           'todo_name' => 'required', 
        ]);

        if ($validate->passes()) {
            $addTodo = Todo::create(
                [
                    'todo_name' => $request->todo_name,
                    'completed' => false,
                    'edit' => false
                ]
            );
            //return response()->json(['data' => $addTodo, 'status' => 201]);
            return response()->json([$addTodo, 201]);  
        }else {
            return response()->json(['error' => $validate->errors()->all()]);  
        }

    }
    public function deleteTodo($todoId){
        $deleteTodo = Todo::find($todoId);
        
            $deleteTodo->delete();
            return response()->json(['Task deleted successfully. :)',200]);
       
    }
    public function completeTodo($todoId){

        $completeTodo = Todo::find($todoId);
        if ($completeTodo->completed === 1) {
            $completeTodo->completed = 0;
            
        }elseif($completeTodo->completed === 0) {
            $completeTodo->completed = 1; 
        }
        $completeTodo->save(); 
        
        return response()->json([200]);
    }
    public function updateTodo($todoId, Request $request){
        $updateTodoName = Todo::find($todoId);
        $updateTodoName->todo_name = $request->todo_name;
        $updateTodoName->save();
   
        return response()->json(['status' => 200]);
    }
    public function checkAllUncompletedTodos(){
        $checkAllUnCompletedTodos = Todo::all();
        foreach ($checkAllUnCompletedTodos as $checkAllUnCompletedTodo ) {
            $checkAllUnCompletedTodo->completed = 1;
            $checkAllUnCompletedTodo->save();
        }
        return response()->json(['status' => 200]);
        
    }
   public function unCheckedAllCompletedTodos(){
    $checkAllCompletedTodos = Todo::all();
    foreach ($checkAllCompletedTodos as $checkAllCompletedTodo ) {
        $checkAllCompletedTodo->completed = 0;
        $checkAllCompletedTodo->save();
    }
    return response()->json(['status' => 200]);
   }
   public function deleteAllCompletedTodos(){
       $deleteAllCompletedTodos = Todo::where('completed', 1)->get();
       foreach ($deleteAllCompletedTodos as $deleteAllCompletedTodo) {
        $deleteAllCompletedTodo->delete();
       }
       
       return response()->json(['status'=>200]);
       
   }
}
