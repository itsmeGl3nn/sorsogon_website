<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Mail\AppointmentCreated;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{

    public function create(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'address'    => 'required|string|max:255',
            'mobile_num' => 'required|string|max:15',
            'email'      => 'required|string|email|max:255|unique:appointments,email',
            'reasons'    => 'nullable|string',
            'date'       => 'nullable|date',
            'department_office' => 'nullable|string',
            'time'       => 'nullable|string',
        ]);

    $date = $request->date ? date('Y-m-d', strtotime($request->date)) : null;

    $appointments = Appointment::create([
        'first_name' => $request->first_name,
        'last_name'  => $request->last_name,
        'address'    => $request->address,
        'mobile_num' => $request->mobile_num,
        'email'      => $request->email,
        'department_office' => $request->department_office,
        'reasons'    => $request->reasons,
        'date'       => $date,
        'time'       => $request->time,
    ]);

    Mail::to($request->email)->send(new AppointmentCreated($appointments));

        return response()->json([
            'message' => 'Book an appointment successfully',
            'data'    => $appointments
        ], 201);
    }


    public function getappointment(Request $request)
    {

        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);

        $appointments = Appointment::orderBy('id', 'desc')
            ->paginate($limit, ['*'], 'page', $page);

        return response()->json([
            'message' => 'Appointments retrieved successfully',
            'data'    => $appointments->items(),
            'meta'    => [
                'sortBy'      => 'id',
                'sortOrder'   => 'desc',
                'page'        => $appointments->currentPage(),
                'limit'       => $appointments->perPage(),
                'total'       => $appointments->total(),
                'count'       => $appointments->count(),
                'totalPages'  => $appointments->lastPage(),
            ]
        ], 200);
    }


    public function delete($id)
    {

        $appointments = Appointment::find($id);

        if (!$appointments) {
            return response()->json([
                'message' => 'Appointment not found'
            ], 404);
        }

        $appointments->delete();

        return response()->json([
            'message' => 'Appointment deleted successfully'
        ], 200);
    }
}
