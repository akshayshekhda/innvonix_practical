<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use App\Models\TaskModel;
use Carbon\Carbon;
use App\Models\User;
use App\Models\UserRoleModel;



class TaskController extends Controller
{
    // index File Call and datatable Call  
    public function show(Request $request,$id)
    {
        $request->session()->put('project_id',$id);   

        if($request->ajax()) {

        $ProjectId = $ProjectId = $request->session()->get('project_id'); //SET session
          //User Role Wise Data List
           if(Auth::user()->role_id == 1)
           {
              $preQuery  = TaskModel::where('is_deleted', '1')->where('project_id',$ProjectId);
           }
           elseif(Auth::user()->role_id == 2)
           {
              $preQuery  = TaskModel::where('is_deleted', '1')->where('project_id',$ProjectId);
           }
           elseif(Auth::user()->role_id == 3)
           {
              $preQuery  = TaskModel::where('user_id',Auth::user()->id)->where('is_deleted', '1')->where('project_id',$ProjectId);
           }   
                
                $result_obj= $preQuery->get();
         
           
        
     
         return DataTables::of($result_obj)
//Edit Collumn
         ->addColumn('planned_start_date', function ($result_obj) {
            $date_time = '';
            $date_time .= Carbon::createFromFormat('d/m/Y', $result_obj['planned_start_date'])
                            ->format('Y M d');
            return $date_time;
           })

           ->addColumn('planned_end_date', function ($result_obj) {
            $date_time = '';
            
            $date_time .= Carbon::createFromFormat('d/m/Y', $result_obj['planned_end_date'])
                            ->format('Y M d');
            return $date_time;
           })
            ->addColumn('user_id', function ($result_obj) {
                if(isset($result_obj['user_id']) && !empty($result_obj['user_id']))
                {
                  $UserName = User::where('id',$result_obj['user_id'])->first();
                }
                
            $username = '';
            $username .= isset($UserName['name']) ? $UserName['name'] :'---';
            return $username;
           })
            ->addColumn('task_name', function ($result_obj) {
            $date_time = '';
            $date_time .= '<a class="dropdown-item" href="' . url('/setting/Task/' . $result_obj['id']) . ' " >'.$result_obj['task_name'].'</a>';
            return $date_time;
           })
           ->addColumn('user_role', function ($result_obj) {
                if(isset($result_obj['user_id']) && !empty($result_obj['user_id']))
                {
                $UserId = User::where('id',$result_obj['user_id'])->first();
                  $UserRoleName = UserRoleModel::where('id',$UserId['role_id'])->first();
                }
                
            $name = '';
            $name .= isset($UserRoleName['name']) ? $UserRoleName['name'] :'---';
            return $name;
           })
           ->addColumn('command', function ($result_obj) {
            if(Auth::user()->role_id == 3)
            {
                 $action = '';
            }
            else
            {
                 $action = '<div><a class="btn btn-primary" href="' . route('tasklist.edit' , $result_obj['id']) . ' " >Edit<i class="fa fa-edit"></i></a><a class="btn btn-danger ms-3" id="delete-button" data-value="'.route('tasklist.destroy' , $result_obj['id']).'" onclick="deleteProject()">Delete<i class="fa fa-plus"></i></a></div>';            
            }
            
                return $action;
            })
            
             ->rawColumns(['command','planned_start_date','status','id_','planned_end_date','task_name','user_role'])
             ->make(true);
        } else {
            $data = TaskModel::where('project_id',$id)->get();
            return view('task.index',compact('id'));   
        }
    }
     //create file Call and User Drop Down Data
    public function create(Request $request,$id=null)
    {
        $UserData = [];
        if(Auth::user()->role_id == 1)
        {
          $UserData = User::where('role_id','!=',1)->where('is_deleted','1')->get();
        }
        if(Auth::user()->role_id == 2)
        {
          $UserData = User::where('role_id',3)->where('is_deleted','1')->get();
        }
        
        return view('task.create',compact('UserData'));   
    }
    // project Data Edit File Call  
    public function edit($id) 
    {
        $data = TaskModel::findOrfail($id);
        $UserData = '';
        if(Auth::user()->role_id == 1)
        {
          $UserData = User::where('role_id','!=',1)->where('is_deleted','1')->get();
        }
        if(Auth::user()->role_id == 2)
        {
          $UserData = User::where('role_id',3)->where('is_deleted','1')->get();
        }
        return view('task.edit',compact('data','UserData'));
    }
     // project Data Insert Data Base
    public function store(Request $request)
    {
        $input = $request->all();
        $input['project_id'] = $request->session()->get('project_id');//get session
        $input['created_by'] = Auth::user()->id;
        $input['updated_by'] = Auth::user()->id;
       

        $data = TaskModel::create($input);
        
        if($data){
            return redirect()->route('tasklist.show',$input['project_id']);
        } else {
            return redirect()->back();
        }
    }
    // project Data Update Data Base
    public function update($id , Request $request)
    {
        $input = $request->all();    
        $data = TaskModel::find($id);
        $input['updated_by'] = Auth::user()->id;

        $saveData = $data->update($input);
        
        if($saveData) {
            return redirect()->route('tasklist.show',$request->session()->get('project_id')); //get session
        } else {
            return redirect()->back();
        }
    }
// Project Recode Deleted
    public function destroy($id)
    {
        $delete = TaskModel::where('id', $id)->update([
            'is_deleted' => '0',
        ]);
        if ($delete) {
            return true;
        }
    }
}