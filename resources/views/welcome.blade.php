@extends('layouts.app')

@section('content')
<div class="container">
<div class=col-md-6>
<div class="card">
    <div class="card-header"> Enter Section name </div>
    <form action="{{url('post/section')}}" method="post">

<div class="card-body">
    @if(Session::has('error'))
 <div style="color:red">"Error" {{Session::get('status')}}- {{Session::get('error')}}</div>
@endif
    {{ csrf_field() }}
    <div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">/</span>
      </div>
      <input type="text" name="section_name" value=""  autofocus required/>

    </div>
    
    @if($errors->has('section_name'))
    <div class="error">{{ $errors->first('section_name') }}</div>
@endif
</div>
<div class="card-footer">
    <input type="submit">
    </form>
</div>
</div>
</div>

@endsection
