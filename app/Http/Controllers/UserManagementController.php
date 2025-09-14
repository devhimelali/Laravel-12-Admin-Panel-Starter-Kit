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
                ->editColumn('name', fn($row) => $row->name ?? 'N/A')
                ->editColumn('email', fn($row) => $row->email ?? 'N/A')
                ->editColumn('roles', function ($row) {
                    return $row->roles
                        ->pluck('name')
                        ->map(fn($role) => ucfirst($role))
                        ->implode(', ');
                })
                ->editColumn('created_at', fn($row) => $row->created_at->format('d-m-Y (h:i A)'))
                ->addColumn('actions', function ($row) {
                    return '<div class="btn-group">
                                <a href="javascript:void(0)" data-id="' . $row->id . '" class="edit btn btn-secondary btn-sm d-flex align-items-center">
                                    <i class="ph ph-pencil me-1"></i>
                                    Edit
                                </a>
                                <a href="javascript:void(0)" data-id="' . $row->id . '" class="delete btn btn-danger btn-sm d-flex align-items-center">
                                    <i class="ph ph-trash me-1"></i>
                                    Delete
                                </a>
                            </div>';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('user-managements.users.index');
    }
}
