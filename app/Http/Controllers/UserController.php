<?php

namespace App\Http\Controllers;

use App\Role;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use DataTables;
use File;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::get_users();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $url = url('users/' . $row->id);
                    $btn = '
                                <a href="' . $url . '/edit" class="user_edit btn btn-primary btn-minier">Edit</a> <a href="' . $url . '" class="delete btn btn-danger btn-minier">Delete</a>
                            ';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('users.user_list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create_user', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'integer'],
            'profile' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        $userArr = array(
            'name' => $request->post('name'),
            'email' => $request->post('email'),
            'role_id' => $request->post('role'),
            'password' => Hash::make($request->post('password')),
            'created_by' => Auth::id()
        );

        /* upload file start */
        if ($request->hasFile('profile')) {
            $uploadPath = public_path('uploads');
            // check directory exist or not
            File::isDirectory($uploadPath) or File::makeDirectory($uploadPath, 0777, true, true);
            $imageName = time() . '.' . $request->profile->getClientOriginalExtension();

            $request->profile->move($uploadPath, $imageName);
            if ($imageName != "" || !$imageName) {
                $userArr['profile'] = $imageName;
            }
        }
        /* upload file end */

        $userResult = User::create($userArr);

        if ($userResult) {
            return redirect()->route('users.index')
                ->with('success', 'User created successfully');
        }
        return back()->withInput()->with('failure', 'Error creating new User');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $user_info = User::find($user->id);

        return view('users.user_edit', ['user' => $user_info, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'integer'],
            'profile' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        $updateArr = array(
            'name' => $request->post('name'),
            'email' => $request->post('email'),
            'role_id' => $request->post('role'),
            'updated_by' => Auth::id(),
        );
        if ($request->post('password')) {
            $updateArr['password'] = Hash::make($request->post('password'));
        }

        /* upload file start */
        if ($request->hasFile('profile')) {
            $uploadPath = public_path('uploads');
            // check directory exist or not
            File::isDirectory($uploadPath) or File::makeDirectory($uploadPath, 0777, true, true);
            $imageName = time() . '.' . $request->profile->getClientOriginalExtension();

            $request->profile->move($uploadPath, $imageName);
            if ($imageName != "" || !$imageName) {
                $updateArr['profile'] = $imageName;
            }
        }
        /* upload file end */

        /*$userUpdate = User::where('id', $meeting->id)->update($updateArr);*/
        $userUpdate = $user->update($updateArr);
        if ($userUpdate) {
            return redirect()->route('users.index')
                ->with('success', 'User updated successfully');
        }
        return back()->withInput()->with('failure', 'Error updating User');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $findProduct = User::find($id);
        if ($findProduct->delete()) {

            //redirect
            return response()->json([
                'status' => true,
                'message' => 'Record deleted successfully!',
            ]);

        }
        response()->json([
            'status' => false,
            'message' => 'Record not deleted successfully!',
        ]);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function import(Request $request)
    {
        $request->validate([
            'import' => ['required', 'mimes:xlsx,xls', 'max:2048'],
        ]);

        $rows = Excel::toArray(new UsersImport, $request->file('import'));

        $errors = [];
        $data = [];
        if(!empty($rows))
        {
            foreach($rows as $row)
            {

                if(!empty($row))
                {
                    $counter = count($row);

                    foreach($row as $k=>$field)
                    {
                        if($k == 0)
                        {
                            continue;
                        }
                        $lineNo = $k+1;
                        // get role id
                        $role_id = Role::where('name','=',$row[$k][2])->first();

                        if ($role_id === null) {
                            // role doesn't exist
                            $errors[] = 'Role '.$row[$k][2].' doesn\'t exist in the system at line: '.$lineNo;
                            $email = User::where('email','=',$row[$k][1])->first();
                            if($email)
                            {
                                // email already exist in the system
                                $errors[] = 'Email '.$row[$k][1].' already exist in the system at line: '.$lineNo;
                            }
                            continue;
                        }

                        $email = User::where('email','=',$row[$k][1])->first();

                        if($email)
                        {
                            // email already exist in the system
                            $errors[] = 'Email '.$row[$k][1].' already exist in the system at line: '.$lineNo;
                            continue;
                        }

                        $data[] = array(
                            'name'=>$row[$k][0],
                            'email'=>$row[$k][1],
                            'role_id'=>$role_id->id,
                            'password'=>Hash::make('12345678'),
                            'created_by'=>Auth::id()
                        );
                    }
                }
            }
        }
        /*echo "<pre>"; print_r($data);
        print_r($errors);
        die;*/
        $successDataCount = count($data);
        if($successDataCount > 0)
        {
            DB::table('users')->insert($data);
            return redirect()->route('users.index')
            ->with('custom_flash',array("success"=>'User imported successfully. Total Data Import: '.$successDataCount,"errors"=>$errors));
        }
        if($successDataCount == 0){
            return redirect()->route('users.index')
                ->with('custom_flash',array("errors"=>$errors));
        }
        return back()->with('failure', 'Error importing User.');
    }
}
