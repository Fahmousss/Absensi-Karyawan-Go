<?php

namespace App\Http\Controllers\Admin;

use App\Attendance;
use App\Department;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;

use function Ramsey\Uuid\v1;

class EmployeeController extends Controller
{
    public function index()
    {
        $data = [
            'employees' => Employee::all(),
            'attendance' => Attendance::all()
        ];
        return view('admin.employees.index')->with($data);
    }
    public function create()
    {
        $data = [
            'departments' => Department::all(),
            'desgs' => ['Manajer', 'Asisten Manajer', 'Kepala Divisi', 'Staff']
        ];
        return view('admin.employees.create')->with($data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'sex' => 'required',
            'desg' => 'required',
            'department_id' => 'required',
            'salary' => 'required|numeric',
            'email' => 'required|email',
            'photo' => 'image|nullable',
            'password' => 'required|confirmed|min:6'
        ]);
        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $employeeRole = Role::where('name', 'employee')->first();
        $user->roles()->attach($employeeRole);
        $employeeDetails = [
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'sex' => $request->sex,
            'dob' => $request->dob,
            'join_date' => $request->join_date,
            'desg' => $request->desg,
            'department_id' => $request->department_id,
            'salary' => $request->salary,
            'photo'  => 'user.png'
        ];
        // Photo upload
        if ($request->hasFile('photo')) {
            // GET FILENAME
            $filename_ext = $request->file('photo')->getClientOriginalName();
            // GET FILENAME WITHOUT EXTENSION
            $filename = pathinfo($filename_ext, PATHINFO_FILENAME);
            // GET EXTENSION
            $ext = $request->file('photo')->getClientOriginalExtension();
            //FILNAME TO STORE
            $filename_store = $filename . '_' . time() . '.' . $ext;
            // UPLOAD IMAGE
            // $path = $request->file('photo')->storeAs('public'.DIRECTORY_SEPARATOR.'employee_photos', $filename_store);
            // add new file name
            $image = $request->file('photo');
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(128, 128);
            $image_resize->save(public_path(DIRECTORY_SEPARATOR . 'folder_photo' . DIRECTORY_SEPARATOR . $filename_store));
            $employeeDetails['photo'] = $filename_store;
        }

        Employee::create($employeeDetails);
        $request->session()->flash('success', 'Karyawan berhasil ditambahkan!');
        return back();
    }

    public function attendance(Request $request)
    {
        $data = [

            'date' => null
        ];
        if ($request->all()) {
            $date = Carbon::create($request->date);
            $employees = $this->attendanceByDate($date);
            $data['date'] = $date->format('d M, Y');
        } else {
            $employees = $this->attendanceByDate(Carbon::now());
        }
        $data['employees'] = $employees;
        // dd($employees->get(4)->attendanceToday->id);
        return view('admin.employees.attendance')->with($data);
    }

    public function attendanceByDate($date)
    {
        $employees = DB::table('employees')->select('id', 'first_name', 'last_name', 'desg', 'department_id')->get();
        $attendances = Attendance::all()->filter(function ($attendance, $key) use ($date) {
            return $attendance->created_at->dayOfYear == $date->dayOfYear;
        });
        return $employees->map(function ($employee, $key) use ($attendances) {
            $attendance = $attendances->where('employee_id', $employee->id)->first();
            $employee->attendanceToday = $attendance;
            $employee->department = Department::find($employee->department_id)->name;
            return $employee;
        });
    }

    public function destroy($employee_id)
    {
        $employee = Employee::findOrFail($employee_id);
        $user = User::findOrFail($employee->user_id);
        // detaches all the roles
        DB::table('leaves')->where('employee_id', '=', $employee_id)->delete();
        DB::table('attendances')->where('employee_id', '=', $employee_id)->delete();
        DB::table('expenses')->where('employee_id', '=', $employee_id)->delete();
        $employee->delete();
        $user->roles()->detach();
        // deletes the users
        $user->delete();
        request()->session()->flash('success', 'Karyawan berhasil dihapus!');
        return back();
    }

    public function attendanceDelete($attendance_id)
    {
        $attendance = Attendance::findOrFail($attendance_id);
        $attendance->delete();
        request()->session()->flash('success', 'Riwayat Absensi berhasil dihapus!');
        return back();
    }

    public function employeeProfile($employee_id)
    {
        $employee = Employee::findOrFail($employee_id);
        return view('admin.employees.profile')->with('employee', $employee);
    }

    public function recap(Request $request): Response
    {
        $query = Attendance::query();
        $filter = $request->filter;

        switch ($filter) {
            case 'jan':
                $query = $query->whereMonth('created_at', 1);
                break;
            case 'feb':
                $query = $query->whereMonth('created_at', 2);
                break;
            case 'mar':
                $query = $query->whereMonth('created_at', 3);
                break;
            case 'apr':
                $query = $query->whereMonth('created_at', 4);
                break;
            case 'may':
                $query = $query->whereMonth('created_at', 5);
                break;
            case 'jun':
                $query = $query->whereMonth('created_at', 6);
                break;
            case 'jul':
                $query = $query->whereMonth('created_at', 7);
                break;
            case 'aug':
                $query = $query->whereMonth('created_at', 8);
                break;
            case 'sep':
                $query = $query->whereMonth('created_at', 9);
                break;
            case 'oct':
                $query = $query->whereMonth('created_at', 10);
                break;
            case 'nov':
                $query = $query->whereMonth('created_at', 11);
                break;
            case 'dec':
                $query = $query->whereMonth('created_at', 12);
                break;
            case 'all':
                $query = $query;
                break;
        }
        $data = [
            'filter' => $filter ?? 'all',
            'attendances' => $query->get(),
            'employees' => Employee::all(),
            // 'request' => 'jan'
        ];
        return response()->view('admin.recap.index', $data);
    }

    public function printRecap($filter_req)
    {
        $query = Attendance::query();
        $filter = $filter_req;
        // echo $filter;

        switch ($filter) {
            case 'jan':
                $query = $query->whereMonth('created_at', 1);
                $filter = 'Januari';
                break;
            case 'feb':
                $query = $query->whereMonth('created_at', 2);
                $filter = 'Februari';
                break;
            case 'mar':
                $query = $query->whereMonth('created_at', 3);
                $filter = 'Maret';
                break;
            case 'apr':
                $query = $query->whereMonth('created_at', 4);
                $filter = 'April';
                break;
            case 'may':
                $query = $query->whereMonth('created_at', 5);
                $filter = 'Mei';
                break;
            case 'jun':
                $query = $query->whereMonth('created_at', 6);
                $filter = 'Juni';
                break;
            case 'jul':
                $query = $query->whereMonth('created_at', 7);
                $filter = 'Juli';
                break;
            case 'aug':
                $query = $query->whereMonth('created_at', 8);
                $filter = 'Agustus';
                break;
            case 'sep':
                $query = $query->whereMonth('created_at', 9);
                $filter = 'September';
                break;
            case 'oct':
                $query = $query->whereMonth('created_at', 10);
                $filter = 'Oktober';
                break;
            case 'nov':
                $query = $query->whereMonth('created_at', 11);
                $filter = 'November';
                break;
            case 'dec':
                $query = $query->whereMonth('created_at', 12);
                $filter = 'Desember';
                break;
            case 'all':
                $query = $query;
                $filter = 'Semua Bulan';
                break;
        }
        $data = [
            'attendances' => $query->get(),
            'employees' => Employee::all(),
            'filter' => $filter
        ];

        // echo $filter_req;
        return  view('admin.recap.print')->with($data);
    }
}
