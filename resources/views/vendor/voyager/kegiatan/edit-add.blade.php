@php
    $edit = !is_null($dataTypeContent->getKey());
    $add  = is_null($dataTypeContent->getKey());
@endphp

@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular'))

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular') }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form role="form"
                            class="form-edit-add"
                            action="{{ $edit ? route('voyager.'.$dataType->slug.'.update', $dataTypeContent->getKey()) : route('voyager.'.$dataType->slug.'.store') }}"
                            method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
                        @if($edit)
                            {{ method_field("PUT") }}
                        @endif

                        <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Adding / Editing -->
                            @php
                                $dataTypeRows = $dataType->{($edit ? 'editRows' : 'addRows' )};
                            @endphp

                            @foreach($dataTypeRows as $row)
                                <!-- GET THE DISPLAY OPTIONS -->
                                @php
                                    $display_options = $row->details->display ?? NULL;
                                    if ($dataTypeContent->{$row->field.'_'.($edit ? 'edit' : 'add')}) {
                                        $dataTypeContent->{$row->field} = $dataTypeContent->{$row->field.'_'.($edit ? 'edit' : 'add')};
                                    }
                                @endphp
                                @if (isset($row->details->legend) && isset($row->details->legend->text))
                                    <legend class="text-{{ $row->details->legend->align ?? 'center' }}" style="background-color: {{ $row->details->legend->bgcolor ?? '#f0f0f0' }};padding: 5px;">{{ $row->details->legend->text }}</legend>
                                @endif

                                <div class="form-group @if($row->type == 'hidden') hidden @endif col-md-{{ $display_options->width ?? 12 }} {{ $errors->has($row->field) ? 'has-error' : '' }}" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                                    {{ $row->slugify }}
                                    <label class="control-label" for="name">{{ $row->getTranslatedAttribute('display_name') }}</label>
                                    @include('voyager::multilingual.input-hidden-bread-edit-add')
                                    @if ($add && isset($row->details->view_add))
                                        @include($row->details->view_add, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'view' => 'add', 'options' => $row->details])
                                    @elseif ($edit && isset($row->details->view_edit))
                                        @include($row->details->view_edit, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'view' => 'edit', 'options' => $row->details])
                                    @elseif (isset($row->details->view))
                                        @include($row->details->view, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'action' => ($edit ? 'edit' : 'add'), 'view' => ($edit ? 'edit' : 'add'), 'options' => $row->details])
                                    @elseif ($row->type == 'relationship')
                                        @include('voyager::formfields.relationship', ['options' => $row->details])
                                    @else
                                        {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
                                    @endif

                                    @foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
                                        {!! $after->handle($row, $dataType, $dataTypeContent) !!}
                                    @endforeach
                                    @if ($errors->has($row->field))
                                        @foreach ($errors->get($row->field) as $error)
                                            <span class="help-block">{{ $error }}</span>
                                        @endforeach
                                    @endif
                                </div>
                            @endforeach
                            {{-- Custom --}}
                            <div class="form-group">
                                <label for='aset'>Aset</label>
                                <select class="form-control select2" id="aset" name="aset" onchange="changeAset()">
                                    <option value="">--- Pilih ---</option>
                                    <option value=1>Bendungan</option>
                                    <option value=2>Irigasi</option>
                                    <option value=3>Danau</option>
                                    <option value=4>Embung</option>
                                    <option value=5>Pantai</option>
                                    <option value=6>Aset Air Tanah</option>
                                    <option value=7>Aset Air Baku</option>
                                    <option value=8>Sungai</option>
                                   
                                </select>
                            </div>

                            @if (Auth::user()->hasRole(['admin','superadmin']))
                            <div class="form-group" id="display_bendungan" style="display: none">
                                <label for="locale">Bendungan</label>
                                <select class="form-control select2" id="id_aset" name="id_aset">
                                    <option value="">--- Pilih ---</option>
                                    @foreach (App\Models\AsetsBendungan::all() as $a)
                                        <option value="{{ $a->id }}"
                                            {{ ($dataTypeContent->id_aset == $a->id ? 'selected' : '') }}
                                        >{{ $a->nama_bendungan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" id="display_irigasi" style="display: none">
                                <label for="locale">Irigasi</label>
                                <select class="form-control select2" id="id_irigasi" name="id_irigasi">
                                    <option value="">--- Pilih ---</option>
                                    @foreach (App\Models\AsetsIrigasi::all() as $p)
                                        <option value="{{ $p->id }}"
                                            {{ ($dataTypeContent->id_irigasi == $p->id ? 'selected' : '') }}
                                        >{{ $p->nama_di }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" id="display_danau" style="display: none">
                                <label for="locale">Danau</label>
                                <select class="form-control select2" id="id_danau" name="id_danau">
                                    <option value="">--- Pilih ---</option>
                                    @foreach (App\Models\AsetsDanau::all() as $p)
                                        <option value="{{ $p->id }}"
                                            {{ ($dataTypeContent->id_danau == $p->id ? 'selected' : '') }}
                                        >{{ $p->nama_danau }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" id="display_embung" style="display: none">
                                <label for="locale">Embung</label>
                                <select class="form-control select2" id="id_embung" name="id_embung">
                                    <option value="">--- Pilih ---</option>
                                    @foreach (App\Models\AsetsEmbung::all() as $p)
                                        <option value="{{ $p->id }}"
                                            {{ ($dataTypeContent->id_embung == $p->id ? 'selected' : '') }}
                                        >{{ $p->nama_embung }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" id="display_pantai" style="display: none">
                                <label for="locale">Pantai</label>
                                <select class="form-control select2" id="id_pantai" name="id_pantai">
                                    <option value="">--- Pilih ---</option>
                                    @foreach (App\Models\AsetsPantai::all() as $p)
                                        <option value="{{ $p->id }}"
                                            {{ ($dataTypeContent->id_pantai == $p->id ? 'selected' : '') }}
                                        >{{ $p->nama_bangunan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" id="display_airtanah" style="display: none">
                                <label for="locale">Air Tanah</label>
                                <select class="form-control select2" id="id_airtanah" name="id_airtanah">
                                    <option value="">--- Pilih ---</option>
                                    @foreach (App\Models\AsetsAirTanah::all() as $p)
                                        <option value="{{ $p->id }}"
                                            {{ ($dataTypeContent->id_airtanah == $p->id ? 'selected' : '') }}
                                        >{{ $p->nama_bangunan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" id="display_airbaku" style="display: none">
                                <label for="locale">Air Baku</label>
                                <select class="form-control select2" id="id_airbaku" name="id_airbaku">
                                    <option value="">--- Pilih ---</option>
                                    @foreach (App\Models\AsetsAirBaku::all() as $p)
                                        <option value="{{ $p->id }}"
                                            {{ ($dataTypeContent->id_airbaku == $p->id ? 'selected' : '') }}
                                        >{{ $p->nama_bangunan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" id="display_sungai" style="display: none">
                                <label for="locale">Sungai</label>
                                <select class="form-control select2" id="id_sungai" name="id_sungai">
                                    <option value="">--- Pilih ---</option>
                                    @foreach (App\Models\Asetssungai::all() as $p)
                                        <option value="{{ $p->id }}"
                                            {{ ($dataTypeContent->id_sungai == $p->id ? 'selected' : '') }}
                                        >{{ $p->nama_sungai }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif

                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            @section('submit-buttons')
                                <button type="submit" class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
                            @stop
                            @yield('submit-buttons')
                        </div>
                    </form>

                    <div style="display:none">
                        <input type="hidden" id="upload_url" value="{{ route('voyager.upload') }}">
                        <input type="hidden" id="upload_type_slug" value="{{ $dataType->slug }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-danger" id="confirm_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}</h4>
                </div>

                <div class="modal-body">
                    <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                    <button type="button" class="btn btn-danger" id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete File Modal -->
@stop

@section('javascript')
    <script>
        var params = {};
        var $file;

        function deleteHandler(tag, isMulti) {
          return function() {
            $file = $(this).siblings(tag);

            params = {
                slug:   '{{ $dataType->slug }}',
                filename:  $file.data('file-name'),
                id:     $file.data('id'),
                field:  $file.parent().data('field-name'),
                multi: isMulti,
                _token: '{{ csrf_token() }}'
            }

            $('.confirm_delete_name').text(params.filename);
            $('#confirm_delete_modal').modal('show');
          };
        }

        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();

            //Init datepicker for date fields if data-datepicker attribute defined
            //or if browser does not handle date inputs
            $('.form-group input[type=date]').each(function (idx, elt) {
                if (elt.hasAttribute('data-datepicker')) {
                    elt.type = 'text';
                    $(elt).datetimepicker($(elt).data('datepicker'));
                } else if (elt.type != 'date') {
                    elt.type = 'text';
                    $(elt).datetimepicker({
                        format: 'L',
                        extraFormats: [ 'YYYY-MM-DD' ]
                    }).datetimepicker($(elt).data('datepicker'));
                }
            });

            @if ($isModelTranslatable)
                $('.side-body').multilingual({"editing": true});
            @endif

            $('.side-body input[data-slug-origin]').each(function(i, el) {
                $(el).slugify();
            });

            $('.form-group').on('click', '.remove-multi-image', deleteHandler('img', true));
            $('.form-group').on('click', '.remove-single-image', deleteHandler('img', false));
            $('.form-group').on('click', '.remove-multi-file', deleteHandler('a', true));
            $('.form-group').on('click', '.remove-single-file', deleteHandler('a', false));

            $('#confirm_delete').on('click', function(){
                $.post('{{ route('voyager.'.$dataType->slug.'.media.remove') }}', params, function (response) {
                    if ( response
                        && response.data
                        && response.data.status
                        && response.data.status == 200 ) {

                        toastr.success(response.data.message);
                        $file.parent().fadeOut(300, function() { $(this).remove(); })
                    } else {
                        toastr.error("Error removing file.");
                    }
                });

                $('#confirm_delete_modal').modal('hide');
            });
            $('[data-toggle="tooltip"]').tooltip();
        });




// Custom
    var aset = $("#aset").val();
        if (aset == 1) {
                $("#display_bendungan").show();
            } else {
                $("#display_bendungan").hide();
        }
        if (aset == 2) {
                $("#display_irigasi").show();
            } else {
                $("#display_irigasi").hide();
        }
        function changeAset(){
            var aset = $("#aset").val();
            if (aset == 1) {
                $("#display_bendungan").show();
                $("#display_irigasi").hide();
                $("#display_danau").hide();
                $("#display_embung").hide();
                $("#display_pantai").hide();
                $("#display_airtanah").hide();
                $("#display_airbaku").hide();
                $("#display_sungai").hide();
            }
            else if (aset == 2) {
                $("#display_irigasi").show();
                $("#display_bendungan").hide();
                $("#display_danau").hide();
                $("#display_embung").hide();
                $("#display_pantai").hide();
                $("#display_airtanah").hide();
                $("#display_airbaku").hide();
                $("#display_sungai").hide();
            }
            else if (aset == 3) {
                $("#display_danau").show();
                $("#display_bendungan").hide();
                $("#display_irigasi").hide();
                $("#display_embung").hide();
                $("#display_pantai").hide();
                $("#display_airtanah").hide();
                $("#display_airbaku").hide();
                $("#display_sungai").hide();
            }
            else if (aset == 4) {
                $("#display_embung").show();
                $("#display_bendungan").hide();
                $("#display_irigasi").hide();
                $("#display_danau").hide();
                $("#display_pantai").hide();
                $("#display_airtanah").hide();
                $("#display_airbaku").hide();
                $("#display_sungai").hide();
            }
            else if (aset == 5) {
                $("#display_pantai").show();
                $("#display_bendungan").hide();
                $("#display_irigasi").hide();
                $("#display_danau").hide();
                $("#display_embung").hide();
                $("#display_airtanah").hide();
                $("#display_airbaku").hide();
                $("#display_sungai").hide();
            }
            else if (aset == 6) {
                $("#display_airtanah").show();
                $("#display_bendungan").hide();
                $("#display_irigasi").hide();
                $("#display_danau").hide();
                $("#display_embung").hide();
                $("#display_pantai").hide();
                $("#display_airbaku").hide();
                $("#display_sungai").hide();
            }
            else if (aset == 7) {
                $("#display_airbaku").show();
                $("#display_bendungan").hide();
                $("#display_irigasi").hide();
                $("#display_danau").hide();
                $("#display_embung").hide();
                $("#display_pantai").hide();
                $("#display_airtanah").hide();
                $("#display_sungai").hide();
            }
            else if (aset == 8) {
                $("#display_sungai").show();
                $("#display_bendungan").hide();
                $("#display_irigasi").hide();
                $("#display_danau").hide();
                $("#display_embung").hide();
                $("#display_pantai").hide();
                $("#display_airtanah").hide();
                $("#display_airbaku").hide();
            }
            else {
                $("#display_irigasi").hide();
                $("#display_bendungan").hide();
            }
        }

    </script>
@stop
