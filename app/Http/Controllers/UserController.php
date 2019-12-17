<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use DataTables;
use File;

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
            // for custom query use below query
            /* $data = DB::select( DB::raw("SELECT users.*,CONCAT_WS(' ',users.name,users.email) AS name FROM users
        ") ); */
            $data = User::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $url = url('users/' . $row->id);
                    $btn = '
                                <a href="'.$url.'/edit" class="user_edit btn btn-primary btn-minier">Edit</a> <a href="' . $url . '" class="delete btn btn-danger btn-minier">Delete</a>
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
            'profile' => ['nullable','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
        ]);

        $userArr = array(
            'name' => $request->post('name'),
            'email' => $request->post('email'),
            'password' => Hash::make($request->post('password')),
            'created_by' => Auth::id()
        );

        /* upload file start */
        if($request->hasFile('profile'))
        {
            $uploadPath = public_path('uploads');
            // check directory exist or not
            File::isDirectory($uploadPath) or File::makeDirectory($uploadPath, 0777, true, true);
            $imageName = time().'.'.$request->profile->getClientOriginalExtension();

            $request->profile->move($uploadPath, $imageName);
            if($imageName != "" || !$imageName) { $userArr['profile'] = $imageName; }
        }
        /* upload file end */

        $userResult = User::create($userArr);

        if ($userResult) {
            return redirect()->route('users.index')
                ->with('success', 'User created successfully');
        }
        return back()->withInput()->with('errors', 'Error creating new User');
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
        //
        $user_info = User::find($user->id);

        return view('users.user_edit', ['user'=>$user_info]);
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'profile' => ['nullable','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
        ]);

        $updateArr = array(
            'name'=>$request->post('name'),
            'email'=>$request->post('email'),
            'updated_by' => Auth::id(),
        );
        if($request->post('password')){ $updateArr['password'] = Hash::make($request->post('password')); }

        /* upload file start */
        if($request->hasFile('profile'))
        {
            $uploadPath = public_path('uploads');
            // check directory exist or not
            File::isDirectory($uploadPath) or File::makeDirectory($uploadPath, 0777, true, true);
            $imageName = time().'.'.$request->profile->getClientOriginalExtension();

            $request->profile->move($uploadPath, $imageName);
            if($imageName != "" || !$imageName) { $updateArr['profile'] = $imageName; }
        }
        /* upload file end */

        /*$userUpdate = User::where('id', $meeting->id)->update($updateArr);*/
        $userUpdate = $user->update($updateArr);
        if($userUpdate)
        {
            return redirect()->route('users.index')
                ->with('success','User updated successfully');
        }
        return back()->withInput()->with('errors', 'Error updating User');
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
}
