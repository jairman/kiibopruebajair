@extends('layouts.admin')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <section class="box-typical">
                        @include('alerts')
                        <div id="toolbar">
                            <div class="bootstrap-table-header" style="font-size: 18px">Usuarios</div>
                            <button id="add" class="btn btn-primary botonadmin add" data-toggle="modal"
                                title="Agregar Usuario" data-target="#nuevo">
                                <i class="font-icon font-icon-plus"></i>
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table id="table" class="table table-striped" data-toolbar="#toolbar" data-search="true"
                                data-show-refresh="false" data-show-toggle="true" data-show-columns="true"
                                data-show-export="true" data-detail-view="false" data-detail-formatter="detailFormatter"
                                data-minimum-count-columns="2" data-show-pagination-switch="true" data-pagination="true"
                                data-id-field="email" data-page-list="[10, 25, 50, 100, TODOS]" data-show-footer="false"
                                data-response-handler="responseHandler">
                            </table>
                        </div>
                    </section>
                    <!--.box-typical-->
                </div>
            </div>
        </div>
        <!--.container-fluid-->
    </div>
    <!--.page-content-->

    <div class="modal fade" id="nuevo" tabindex="-1" role="dialog" aria-labelledby="nuevo" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="nuevo">Nuevo Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.usuarios/registro') }}" enctype="multipart/form-data">

                        @csrf
                        @method('get')

                        <div class="form-group">
                            <label for="name" class="col-form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') }}" required>

                        </div>
                        <div class="form-group">
                            <label for="email" class="col-form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ old('email') }}" required>

                        </div>



                        <div class="form-group">
                            <label for="password" class="col-form-label">Password:</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <label for="password-confirm" class="col-form-label">Confirmar Password:</label>
                            <input type="password" class="form-control" id="password-confirm" name="password_confirmation"
                                placeholder="Password" required>
                        </div>
                        <input type="submit" id="botonnuevo" style="display:none;">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="$('#botonnuevo').click()">Guardar</button>
                </div>
            </div>
        </div>
    </div>


    @if ($usuarios)
        @foreach ($usuarios as $registro)
            <div class="modal fade" id="editar{{ $registro->id }}" tabindex="-1" role="dialog" aria-labelledby="nuevo"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="nuevo">Editar Usuario</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ route('admin.usuarios/editar', $registro->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('post')


                                <div class="form-group">
                                    <label for="name" class="col-form-label">Nombre</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $registro->name }}" required>

                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ $registro->email }}" required>

                                </div>



                                <div class="form-group">
                                    <label for="password" class="col-form-label">Password:</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="password-confirm" class="col-form-label">Confirmar Password:</label>
                                    <input type="password" class="form-control" id="password-confirm"
                                        name="password_confirmation" placeholder="Password">
                                </div>

                                <input type="hidden" name="id" value="{{ $registro->id }}" required>
                                <input type="submit" id="botoneditar{{ $registro->id }}" style="display:none;">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary"
                                onclick="$('#botoneditar{{ $registro->id }}').click()">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>



            <div class="modal fade" id="eliminar{{ $registro->id }}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Eliminar Usuario</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>¿Estas seguro de querer eliminar {{ $registro->nombre }} ?</p>
                        </div>
                        <div class="modal-footer">
                            <form method="post" action="{{ route('admin.usuarios/eliminar', $registro->id) }}">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $registro->id }}">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif


@endsection
@section('scripts')
    @parent
    <script>
        $(document).ready(function() {

            /* ==========================================================================
                Tables
                ========================================================================== */
            var data = [
                @if ($usuarios)
                    @foreach ($usuarios as $usu)

                        {
                            "id": "{{ $usu->id }}",
                            "name": "{{ $usu->name }}",
                            "email": "{{ $usu->email }}",


                        },
                    @endforeach
                @endif

            ];
            var $table = $('#table'),
                $remove = $('#remove'),
                selections = [];



            function totalNameFormatter(data) {
                return data.length;
            }

            function totalPriceFormatter(data) {
                var total = 0;
                $.each(data, function(i, row) {
                    total += +(row.price.substring(1));
                });
                return '$' + total;
            }
            window.operateEvents = {
                'click .edit': function(e, value, row, index) {
                    $('#editar' + row.id).modal();

                },
                'click .subcategorias': function(e, value, row, index) {
                    location.href = "{{ url('/subcategorias') }}/" + row.id;

                },
                'click .eliminar': function(e, value, row, index) {
                    $('#eliminar' + row.id).modal();

                }
            };

            function operateFormatter(value, row, index) {
                return [
                    '<a class="edit remove operateicon" href="javascript:void(0)" title="Editar">',
                    '<i class="glyphicon glyphicon-pencil"></i>',
                    '</a>  ',

                    '<a class="eliminar remove operateicon" href="javascript:void(0)" title="Eliminar">',
                    '<i class="glyphicon glyphicon-remove"></i>',
                    '</a>'
                ].join('');
            }


            function getIdSelections() {
                return $.map($table.bootstrapTable('getSelections'), function(row) {
                    return row.id
                });
            }

            $table.bootstrapTable({
                iconsPrefix: 'font-icon',
                icons: {
                    paginationSwitchDown: 'font-icon-arrow-square-down',
                    paginationSwitchUp: 'font-icon-arrow-square-down up',
                    refresh: 'font-icon-refresh',
                    toggle: 'font-icon-list-square',
                    columns: 'font-icon-list-rotate',
                    export: 'font-icon-download',
                    detailOpen: 'font-icon-plus',
                    detailClose: 'font-icon-minus-1'
                },
                paginationPreText: '<i class="font-icon font-icon-arrow-left"></i>',
                paginationNextText: '<i class="font-icon font-icon-arrow-right"></i>',
                data: data,
                columns: [
                    [{
                            title: 'ID',
                            field: 'id',
                            align: 'center',
                            valign: 'middle',
                            sortable: true,
                            show: false,
                            visible: false,
                        },
                        {
                            title: 'Nombre',
                            field: 'name',
                            align: 'center',
                            valign: 'middle',
                            sortable: true,
                        },
                        {
                            title: 'Email',
                            field: 'email',
                            align: 'center',
                            valign: 'middle',
                            sortable: true,
                        },

                        {
                            field: 'operate',
                            title: 'Operación',
                            align: 'center',
                            events: operateEvents,
                            formatter: operateFormatter
                        }
                    ]
                ]
            });

            $table.on('check.bs.table uncheck.bs.table ' +
                'check-all.bs.table uncheck-all.bs.table',
                function() {
                    $remove.prop('disabled', !$table.bootstrapTable('getSelections').length);
                    // save your data, here just save the current page
                    selections = getIdSelections();
                    // push or splice the selections if you want to save all data selections
                });

            $remove.click(function() {
                var ids = getIdSelections();
                $table.bootstrapTable('remove', {
                    field: 'id',
                    values: ids
                });
                $remove.prop('disabled', true);
            });

            $('#toolbar').find('select').change(function() {
                $table.bootstrapTable('refreshOptions', {
                    exportDataType: $(this).val()
                });
            });

            /* ========================================================================== */
        });
    </script>
@endsection
