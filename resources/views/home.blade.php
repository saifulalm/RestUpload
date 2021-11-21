@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="card bg-light mt-3">

            <div class="card-header">

                <div style="text-align: center;">Web Rest Jempol Kios</div>

            </div>

            <div class="card-body">


                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#importExcel">
                    Import Transaction Request
                </button>


                <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form method="post" action="import" enctype="multipart/form-data">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Import Transaction Request</h5>
                                </div>
                                <div class="modal-body">
                                    @csrf

                                    <label>Pilih file excel</label>
                                    <div class="form-group">
                                        <input type="file" name="file" required="required">
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Import</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <a class="btn btn-warning" href="{{ route('export') }}">Export Transaction Response</a>

            </div>
          @include('data')
        </div>


    </div>

@endsection
