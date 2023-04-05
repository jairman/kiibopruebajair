@extends('layouts.app')

@section('content')
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <div class="row col-12">
        <div class="col-lg-4">
            <section class="card">
                <header class="card-header" style="text-align: center">
                    <b style="font-size: 18px">Control</b>
                </header>
                <div class="card-block" style="margin-left: 30px;margin-top:20px">
                    <div class="row col-11" style="text-align: center;margin-top:20px">
                        <button id="comenzar" type="button" class="btn btn-outline-success btn-lg ">Comenzar a
                            laborar</button>
                    </div>
                    <div class="row col-11" style="text-align: center;margin-top:20px">
                        <button id="receso" type="button"
                            class="btn btn-outline-primary btn-lg btn-block">Receso</button>
                    </div>
                    <div class="row col-11" style="text-align: center;margin-top:20px">
                        <button id="regreso" type="button" class="btn btn-outline-warning btn-lg btn-block">Regreso de
                            Receso</button>
                    </div>
                    <div class="row col-11" style="text-align: center;margin-top:20px">
                        <button id="finalizar" type="button" class="btn btn-outline-Secondary btn-lg btn-block">Finalizar
                            Trabajo</button>
                    </div>

                    </br>
                    </br>
                    </br>
                    </hr>
                    <div class="row col-11" style="text-align: center;margin-top:20px">
                        <button id="cerrar" type="button" class="btn btn-outline-danger btn-lg btn-block">Cerrar</button>
                    </div>
                    </br>

                </div>

            </section>
        </div>
        <div class="col-lg-8">
            <section class="card">
                <header class="card-header" style="text-align: center">
                    <b style="font-size: 18px">Reportes</b>
                </header>

                <div id="divcomenzar" class="card-block">
                    <table class="table table-striped">
                        <thead>
                            <tr>

                                <th scope="col">Fecha</th>
                                <th scope="col">Entrada</th>
                                <th scope="col">Receso</th>
                                <th scope="col">Regreso</th>
                                <th scope="col">Salida</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($asistencias as $key => $user)
                                <tr>
                                    <td>{{ $user->fecha }}</td>
                                    <td>{{ $user->horaentrada }}</td>
                                    <td>{{ $user->comidaentrada }}</td>
                                    <td>{{ $user->comidasalida }} </td>
                                    <td>{{ $user->horasalida }} </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center">
                        {{ $asistencias->links() }}
                    </div>
                </div>
            </section>
        </div>

    </div>
@endsection
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#comenzar").click(function() {
            Swal.fire({
                title: 'Comenzar a laborar?',
                text: "No podrás revertir esto.!",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {

                            "Access-Control-Allow-Origin": "*",
                            'Content-Type': 'application/json;',
                            "Content-Type": "application/x-www-form-urlencoded",
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]'

                            ).attr('content')
                        },
                        type: "GET",
                        url: '{{ route('admin.asistencia/inicial') }}',
                        data: {
                            'fecha': "fecha",
                        },
                        success: function(resultado) {
                            $("#divcomenzar").load(location.href +
                                " #divcomenzar>*", "");
                        },
                    });
                }
            })
        });


        $("#receso").click(function() {
            Swal.fire({
                title: 'Comenzar Receso?',
                text: "No podrás revertir esto.!",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "GET",
                        url: '{{ route('admin.asistencia/receso') }}',
                        data: {
                            'fecha': "fecha",
                        },
                        success: function(resultado) {
                            $("#divcomenzar").load(location.href +
                                " #divcomenzar>*", "");
                        },
                    });
                }
            })
        });


        $("#regreso").click(function() {
            Swal.fire({
                title: 'Regreso de Receso?',
                text: "No podrás revertir esto.!",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "GET",
                        url: '{{ route('admin.asistencia/regreso') }}',
                        data: {
                            'fecha': "fecha",
                        },
                        success: function(resultado) {
                            $("#divcomenzar").load(location.href +
                                " #divcomenzar>*", "");
                        },
                    });
                }
            })
        });



        $("#finalizar").click(function() {
            Swal.fire({
                title: 'Finalizar Trabajo?',
                text: "No podrás revertir esto.!",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "GET",
                        url: '{{ route('admin.asistencia/salida') }}',
                        data: {
                            'fecha': "fecha",
                        },
                        success: function(resultado) {
                            $("#divcomenzar").load(location.href +
                                " #divcomenzar>*", "");
                        },
                    });
                }
            })
        });


        $("#cerrar").click(function() {
            Swal.fire({
                title: 'Finalizar labor?',
                text: "No podrás revertir esto.!",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        "contentType": 'application/json; charset=utf-8',
                        type: "get",
                        url: '{{ route('logout') }}',

                    });
                }
            })
        });


    });
</script>
