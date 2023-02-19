<?php

namespace App\Http\Controllers;
use App\Models\ProjectModel;
use App\Models\User;
use App\Models\UserRoleModel;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ProjectController extends Controller
{
  // index File Call and datatable Call 
    public function index(Request $request)
    {
        if($request->ajax()) {
            
            $result_obj = '';
           //User Role Wise Data List
           if(Auth::user()->role_id == 1)
           {
            $result_obj  = ProjectModel::where('is_deleted','1')->get();
           }
           elseif(Auth::user()->role_id == 2)
           {
            
            $result_obj  = ProjectModel::where('user_id',Auth::user()->id)->where('is_deleted','1')->get();
            
           }
           elseif(Auth::user()->role_id == 3)
           {
            $result_obj  = ProjectModel::where('user_id',Auth::user()->id)->where('is_deleted','1')->get();
           }
           
    //Edit Collumn
         return DataTables::of($result_obj)

         ->addColumn('planned_start_date', function ($result_obj) {
             
            $date_time = Carbon::createFromFormat('d/m/Y', $result_obj['planned_start_date'])
                            ->format('Y M d');
            
            return $date_time;
           })

           ->addColumn('planned_end_date', function ($result_obj) {
            $date_time = '';
            
            $date_time .= Carbon::createFromFormat('d/m/Y', $result_obj['planned_end_date'])
                            ->format('Y M d');
            return $date_time;
           })
            ->addColumn('project_name', function ($result_obj) {
            $date_time = '';
            $date_time .= '<a class="dropdown-item" href="' . route('tasklist.show' , $result_obj['id']) . ' " >'.$result_obj['project_name'].'</a>';
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
            $action ='';
            }
            else
            {
                  $action ='<div><a class="btn btn-primary" href="' . route('projectlist.edit' , $result_obj['id']) . ' " >Edit<i class="fa fa-edit"></i></a><a class="btn btn-danger ms-3" id="delete-button" data-value="'.route('projectlist.destroy' , $result_obj['id']).'" onclick="deleteProject()">Delete<i class="fa fa-plus"></i></a></div>'; 
            }
            
            return $action;
            })
            
             ->rawColumns(['command','planned_start_date','status','id_','planned_end_date','project_name','user_id','user_role'])
             ->make(true);
        } else {
            return view('project.index');
        }
    }
    //create file Call and User Drop Down Data
    public function create() 
    {
        $UserData = [];
        if(Auth::user()->role_id == 1)
        {
          
          $UserData = User::where('is_deleted','1')->where('role_id','!=',1)->get();
          
        }
        if(Auth::user()->role_id == 2)
        {
          $UserData = User::where('role_id',3)->where('is_deleted','1')->get();
        }
        
        return view('project.create',compact('UserData'));
    }
    // project Data Insert Data Base
    public function store(Request $request)
    {
        $input = $request->all();
        
        $input['created_by'] = Auth::user()->id;
        $input['updated_by'] = Auth::user()->id;
        
        $project = ProjectModel::create($input);
        if($project) {
            return redirect()->route('projectlist.index');
        } else {
            return redirect()->back();
        }
    }
   // project Data Update Data Base
    public function update($id , Request $request)
    {
            $input = $request->all();    
            $data = ProjectModel::find($id);
            $input['updated_by'] = Auth::user()->id;

            $saveData = $data->update($input);
            
            if($saveData) {
              return redirect()->route('projectlist.index');
            } else {
               return redirect()->back();
            }
    }
    // project Data Edit File Call  
    public function edit($id) 
    {
        $project = ProjectModel::findOrfail($id);
        $UserData = [];
        if(Auth::user()->role_id == 1)
        {
          $UserData = User::where('role_id','!=',1)->where('is_deleted','1')->get();
        }
        if(Auth::user()->role_id == 2)
        {
          $UserData = User::where('role_id',3)->where('is_deleted','1')->get();
        }

        return view('project.edit',compact('project','UserData'));
    }
    // Project Recode Deleted
    public function destroy($id)
    {
        $delete = ProjectModel::where('id', $id)->update([
            'is_deleted' => '0',
        ]);
        if ($delete) {
            return true;
        }
    }
}