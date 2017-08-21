@extends('layouts.app')

@section('content')

<div class="container" style="padding:1em;">
    <div class="row">
        <div class="col-md-6" style="margin-left:-185px;">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <form method="post" action="meeting">
                        {{ csrf_field() }}
                        <input class="form-control" name="title" placeholder="title of the meeting"><br>
                        <input class="form-control" type="hidden" value="{{Auth::id()}}" name="user_id" ><br>
                        <input class="form-control" name="date" type="date"><br>
                        <button type="submit" class="btn btn-info btn-lg">Schedule Meeting</button>
                    </form>
                </div>
            </div>
        </div>
        <div>
            <meetings></meetings>
        </div>

    </div>
</div>
@endsection
