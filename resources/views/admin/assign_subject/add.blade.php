@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add New Assign Subject</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('admin.assign-subject.add.perform') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Class Name</label>
                            <select class="form-control" name="class_id" required>
                                <option value="">Choose One</option>
                                @foreach ($getClass as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>                    
                            </div>
                        <div class="form-group">
                            <label for="name">Subject Name</label>
                            @foreach ($getSubject as $subject)
                                <div>
                                    <input type="checkbox" value="{{ $subject->id }}" name="subject_id[]"> {{ $subject->name }}
                                </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label for="name">Status</label>
                            <select class="form-control" name="status" required>
                                <option value="">Choose One</option>
                                <option value="0">Active</option>
                                <option value="1">Incctive</option>
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
