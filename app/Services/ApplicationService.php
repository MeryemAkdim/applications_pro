<?php

namespace App\Services;

use App\Models\Application;

class ApplicationService
{
    public function index($request)
    {
        $applications = Application::where(function($query) use($request){
            if($request->name != null)
            {
                $query->where('name', 'like', '%'.$request->name.'%');
            }
        })->where(function($query) use($request){
            if($request->lname != null)
            {
                $query->where('lname', 'like', '%'.$request->lname.'%');
            }
        })->where(function($query) use($request){
            if($request->id != null)
            {
                $query->where('id', $request->id);
            }
        })->paginate(20);

        return $applications;
    }

    public function create(array $data)
    {
        return Application::create($data);
    }

    public function edit($id)
    {
        $application = Application::find($id);

        if(!$application)
        {
            return abort(404);
        }

        return $application;
    }

    public function update(Application $application, array $data)
    {
        $application->update($data);
    }

    public function delete(Application $application)
    {
        $application->delete();
    }
}