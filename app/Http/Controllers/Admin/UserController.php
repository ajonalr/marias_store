<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Ventas;

class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		abort_if(Gate::denies('users_access'), Response::HTTP_FORBIDDEN, 'Forbidden');

		$users = User::with('role')->paginate(5)->appends($request->query());
		return view('admin.users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, 'Forbidden');

		$roles = Role::pluck('title', 'id');
		return view('admin.users.create', compact('roles'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreUserRequest $request)
	{
		User::create($request->validated());
		return redirect()->route('users.index')->with(['status-success' => "New User Created"]);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\User  $permission
	 * @return \Illuminate\Http\Response
	 */
	public function show(User $user)
	{
		abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, 'Forbidden');

		return view('admin.users.show', compact('user'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(User $user)
	{
		abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, 'Forbidden');

		$roles = Role::pluck('title', 'id');
		return view('admin.users.edit', compact('user', 'roles'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateUserRequest $request, User $user)
	{
		$user->update(array_filter($request->validated()));
		return redirect()->route('users.index')->with(['status-success' => "User Updated"]);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(User $user)
	{
		abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');

		$user->delete();
		return redirect()->back()->with(['status-success' => "User Deleted"]);
	}

	// retorna la vista para generar reportes
	public function report()
	{
		return view('admin.users.report', ['users' => User::all()]);
	}

	// retorna el reporte de ventas de usuario por fecha
	public function getVentasToUserAndDate(Request $request)
	{
		$data = Ventas::Where('user_id', $request->user_id)
			->whereBetween('created_at', [$request->inicio, $request->fin])
			->get();

		$user = User::findOrFail($request->user_id);

		return view('admin.reports.users.allventas', ['data' => $data, 'user' => $user, 'inicio' => $request->inicio, 'fin' => $request->fin]);
	}
}
