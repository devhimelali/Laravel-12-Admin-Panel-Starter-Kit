<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::with('roles');

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('name', fn($row) => $row->name ?? 'N/A' )
                ->editColumn('email', fn($row) => $row->email ?? 'N/A')
                ->editColumn('roles', function($row) {
                    return $row->roles
                        ->pluck('name')
                        ->map(fn($role) => ucfirst($role))
                        ->implode(', ');
                })
                ->addColumn('actions', function($row){})
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('user-managements.index');
    }
}
