@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Posts</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                        <div id="list">


                            {!! Form::open(['url' => $route, 'files' => true])!!}

                            @foreach($fields as $field)
                                {{ Form::label($field['key'], trans('app.' . $field['key'])) }}



                                @if($field['type']== 'drop_down')
                                    @if(isset($record[$field['key']]))
                                        @if($field['key'] == 'language_code' || $field['key'] == 'category_id' )

                                            <div class="form-group">
                                                {{Form::select($field['key'], $field ['options'], $record[$field['key']] )}}
                                            </div>
                                        @else
                                            <div class="form-group">
                                                {{Form::select($field['key'],$field ['options'], $record[$field['key']], ['placeholder' =>''] )}}
                                            </div>

                                        @endif
                                    @else

                                        @if($field['key'] == 'language_code' || $field['key'] == 'category_id')
                                            <div class="form-group">
                                                {{Form::select($field['key'], $field ['options'])}}
                                            </div>
                                        @else
                                            <div class="form-group">
                                                {{Form::select($field['key'],$field ['options'], null, ['placeholder' =>''] )}}
                                            </div>

                                        @endif



                                    @endif



                                @elseif($field['type'] == 'single_line')

                                    @if(isset($record[$field['key']]))
                                        @if($field['key'] == 'description_long')
                                            <div class="form-group">
                                                {{Form::textarea($field['key'], $record[$field['key']])}}
                                            </div>
                                        @else
                                            <div class="form-group">
                                                {{Form::text($field['key'],$record[$field['key']])}}
                                            </div>
                                        @endif
                                    @else

                                        @if($field['key']=='description_long')
                                            <div class="form-group">
                                                {{Form::textarea($field['key'])}}
                                            </div>
                                        @else
                                            <div class="form-group">
                                                {{Form::text($field['key'])}}
                                            </div>
                                        @endif
                                    @endif

                                @elseif($field['type'] == 'check_box')

                                    @if(isset($record[$field['key']]))

                                        @foreach($field['options'] as $option)
                                            <div class="form-group">
                                                {{Form::checkbox($option['name'], $option['value'], $record[$field['key']])}}
                                            </div>
                                        @endforeach

                                    @else

                                        @foreach($field['options'] as $option)
                                            <div class="form-group">
                                                {{Form::checkbox($option['name'], $option['value'])}}
                                            </div>
                                        @endforeach
                                    @endif



                                @elseif($field['type'] == 'upload_form')

                                    @if (isset ($record[$field['key']]))

                                        <td><img src="{{asset ($record[$field['key']])}}" , class="img-rounded" width="150"></td>
                                    @else
                                        <td></td>
                                    @endif
                                    <div class="form-group">
                                        {!! Form::file('file') !!}
                                    </div>

                                @endif




                            @endforeach


                            {{ Form::submit('Create') }}
                            {!! Form::close() !!}
                        </div>

                        @endsection
                        @section('script')

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
