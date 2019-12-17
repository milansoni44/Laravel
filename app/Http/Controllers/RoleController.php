<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use App\Exports\RolesExport;
use Maatwebsite\Excel\Facades\Excel;

class RoleController extends Controller
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
            $data = Role::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $url = url('roles/' . $row->id);
                    $btn = '
                                <a href="'.$url.'/edit" class="user_edit btn btn-primary btn-minier">Edit</a> <a href="' . $url . '" class="delete btn btn-danger btn-minier">Delete</a>
                            ';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('roles.role_list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create_role');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:191','unique:roles'],
            'description' => ['nullable','string','max:191'],
        ]);

        $roleArr = array(
            'name' => $request->post('name'),
            'description' => $request->post('description'),
            'created_by' => Auth::id()
        );

        $roleResult = Role::create($roleArr);
        if ($roleResult) {
            return redirect()->route('roles.index')
                ->with('success', 'Role created successfully');
        }
        return back()->withInput()->with('errors', 'Error creating new role');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $role_info = Role::find($role->id);

        return view('roles.role_edit', ['role'=>$role_info]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:191','unique:roles,name,'.$role->id],
            'description' => ['nullable','string','max:191'],
        ]);

        $updateArr = array(
            'name'=>$request->post('name'),
            'description'=>$request->post('description'),
            'updated_by' => Auth::id(),
        );

        $roleUpdate = $role->update($updateArr);
        if($roleUpdate)
        {
            return redirect()->route('roles.index')
                ->with('success','Role updated successfully');
        }
        return back()->withInput()->with('errors', 'Error updating role');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $findRole = Role::find($id);
        if ($findRole->delete()) {

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

    public function export()
    {
        return Excel::download(new RolesExport, 'roles.xlsx');
    }
}
