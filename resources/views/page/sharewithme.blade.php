@extends('layouts.master')

@section('content')

<div class="m-subheader">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Chia sẻ
            </h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="#" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                <li class="m-nav__separator">
                    -
                </li>
                <li class="m-nav__item">
                    <a href="" class="m-nav__link">
                        <span class="m-nav__link-text">
                            Chia sẻ với tôi
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- BEGIN: Content -->
<div class="m-content">    
    @include('content.content-sharewithme')
</div> 
<!-- END: Content -->

@include('layouts.modals.sharewithme')

@endsection

@section('pageSnippets')
<!-- BEGIN: Page Scripts -->
<script>
    $(document).ready(function(){

        var account_datatable_options = {
            data: {
                saveState: {cookie: false},
            },
            search: {
                input: $('#accountSearch'),
            },
            columns: [
                {
                field: 'Tên',
                type: 'text',
                sortable: 'asc',
                },
            ],
            pagination: false,
        };
        var note_datatable_options = {
            data: {
                saveState: {cookie: false},
                serverSorting: true,
            },
            search: {
                input: $('#noteSearch'),
            },
            columns: [
                {
                field: 'Tiêu đề',
                type: 'text',
                sortable: 'asc',
                },
            ],
            pagination: false,
        };
        account_datatable = $('#group-account .m-datatable').mDatatable(account_datatable_options);
        note_datatable = $('#group-note .m-datatable').mDatatable(note_datatable_options);

        $(".account-delete").click(function (){
            $("#deleteAccountForm input[name=id]").val( $(this).closest('tr').find('input[name=id]').val() );
        });

        $(".note-delete").click(function (){
            $("#deleteNoteForm input[name=id]").val( $(this).closest('tr').find('input[name=id]').val() );
        });

        $('.delete-submit').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');
            
            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

            form.ajaxSubmit({
                url: 'sharewithme/delete',
                type: 'POST',
                success: function(response, status, xhr, $form) {
                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                    swal({
                        position: 'center',
                        type: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(result){
                        $('#deleteAccountForm').modal('hide');
                        $('#deleteNoteForm').modal('hide');
                    });

                    $('.m-content').html(response.view);
                    account_datatable.destroy();
                    note_datatable.destroy();
                    account_datatable = $('#group-account .m-datatable').mDatatable(account_datatable_options);
                    note_datatable = $('#group-note .m-datatable').mDatatable(note_datatable_options);

                    form.clearForm();
                },
                error: function(response, status, xhr, $form) {
                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                    swal("Có lỗi xảy ra", "", status);
                    console.log(response);
                }
            });
        });

        $(".asset-move").click(function (){
            var data = {
                'id': $(this).closest('tr').find('input[name=id]').val(),
            };
            $.ajax({
                url: 'sharewithme/move',
                type: 'POST',
                data: data,
                success: function(response, status, xhr, $form) {                    
                    swal({
                        position: 'center',
                        type: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    $('.m-content').html(response.view);
                    account_datatable.destroy();
                    note_datatable.destroy();
                    account_datatable = $('#group-account .m-datatable').mDatatable(account_datatable_options);
                    note_datatable = $('#group-note .m-datatable').mDatatable(note_datatable_options);
                },
                error: function(response, status, xhr, $form) {
                    console.log(response);
                    swal("", response.message.serialize(), "error");
                }
            });
        });

        $(".move-accounts").click(function (){
            $.ajax({
                url: 'sharewithme/moveAccounts',
                type: 'POST',
                success: function(response, status, xhr, $form) {                    
                    swal({
                        position: 'center',
                        type: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    $('.m-content').html(response.view);
                    account_datatable.destroy();
                    note_datatable.destroy();
                    account_datatable = $('#group-account .m-datatable').mDatatable(account_datatable_options);
                    note_datatable = $('#group-note .m-datatable').mDatatable(note_datatable_options);
                },
                error: function(response, status, xhr, $form) {
                    console.log(response);
                    swal("", response.message.serialize(), "error");
                }
            });
        });

        $(".move-notes").click(function (){
            $.ajax({
                url: 'sharewithme/moveNotes',
                type: 'POST',
                success: function(response, status, xhr, $form) {                    
                    swal({
                        position: 'center',
                        type: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    $('.m-content').html(response.view);
                    account_datatable.destroy();
                    note_datatable.destroy();
                    account_datatable = $('#group-account .m-datatable').mDatatable(account_datatable_options);
                    note_datatable = $('#group-note .m-datatable').mDatatable(note_datatable_options);
                },
                error: function(response, status, xhr, $form) {
                    console.log(response);
                    swal("", response.message.serialize(), "error");
                }
            });
        });
        
    });
</script>

@endsection
