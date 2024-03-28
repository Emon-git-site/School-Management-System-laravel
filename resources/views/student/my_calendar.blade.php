@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>My Caldendar</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
<script src="{{ url('admin/dist/fullcalendar/index.global.js') }}"></script>

    <script type="text/javascript">
     var events = new Array();

     @foreach (getMyTimetable as )
         
     @endforeach

     var calendarID = document.getElementById('calendar');
     var calendar = new FullCalendar.Calendar(calendarID,{
        headerToolbar:{
            left:'prev,next,today',
            center:'title',
            right:'dayGridMonth, timeGridWeek, timeGridDay, listMonth'
        },
        initialDate:'<?=date('Y-m-d')?>',
        navLinks:true,
        edittable:false,
     });  
     calendar.render();
    </script>
@endsection