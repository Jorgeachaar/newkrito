@extends('layouts.base')

@section('container')
<section id="form-section" class="content-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('renewplan') }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="result" class="col-md-4 control-label"></label>
                                <div class="col-md-6 pull-left">
                                    {{ Form::radio('plan', '1' , true) }}
                                    1 Year $25
                                    {{ Form::radio('plan', '2' , false) }}
                                    2 Years $45
                                    {{ Form::radio('plan', '3' , false) }}
                                    5 Years $95
                                </div>
                            </div>

                            <div class="form-group form-inline">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Aceptar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
