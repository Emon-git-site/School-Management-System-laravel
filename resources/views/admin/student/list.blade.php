@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Student List (Total: {{ $students->total() }})</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{ route('admin.student.add.show') }}" class="btn btn-primary">Add New Student</a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Student list</h3>
                                <div class="card-tools">
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Profile Pic</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Admission Number</th>
                                            <th>Roll Number</th>
                                            <th>Class</th>
                                            <th>Gender</th>
                                            <th>Date of Birth</th>
                                            <th>Caste</th>
                                            <th>Religion</th>
                                            <th>Mobile Number</th>
                                            <th>Admission Date</th>
                                            <th>Blood Group</th>
                                            <th>Height</th>
                                            <th>Weigth</th>
                                            <th>Status</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $student)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if ($student->getProfile())
                                                        <img src="{{ $student->getProfile() }}"
                                                            style="height: 50px; width:50px; border-radius:50px;">
                                                    @endif
                                                </td>
                                                <td>{{ $student->name }} {{ $student->last_name }}</td>
                                                <td>{{ $student->email }}</td>
                                                <td>{{ $student->admission_number }}</td>
                                                <td>{{ $student->roll_number }}</td>
                                                <td>{{ $student->class_name }}</td>
                                                <td>{{ $student->gender }}</td>
                                                <td>
                                                    @if (!@empty($student->date_of_birth))
                                                        {{ date('d-m-Y', strtotime($student->date_of_birth)) }}
                                                    @endif
                                                </td>
                                                <td>{{ $student->caste }}</td>
                                                <td>{{ $student->religion }}</td>
                                                <td>{{ $student->mobile_number }}</td>
                                                <td>
                                                    @if (!@empty($student->admission_date))
                                                        {{ date('d-m-Y', strtotime($student->admission_date)) }}
                                                    @endif
                                                </td>
                                                <td>{{ $student->blood_group }}</td>
                                                <td>{{ $student->height }}</td>
                                                <td>{{ $student->weight }}</td>
                                                <td>{{ $student->status == 0 ? 'Active' : 'Inactive' }}</td>
                                                <td>{{ date('d-m-Y h:i A', strtotime($student->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ route('admin.student.edit', $student->id) }}"
                                                        class="btn btn-sm btn-primary">Edit</a>
                                                    <a href="{{ route('admin.student.delete', $student->id) }}"
                                                        class="btn btn-sm btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div style="padding: 10px; float:right">
                                    {!! $students->appends(Request::except('page'))->links() !!}
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
