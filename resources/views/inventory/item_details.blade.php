@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Item# <span class="item_code">{{ $item->item_imei }}</span>
        </h1>
    </section>

    <section class="content">
        <!-- Item Details -->
        <div class="box box-success">
            <div class="box-body">
                <div class="row">
                    <!-- P.ID -->
                    <div class="form-group col-md-2">
                        <label>P.ID</label>
                        <p class="pid" style="border:1px solid #eaeaea; padding:2px 3px;">
                            {{ $item->purchase_id }}
                        </p>
                    </div>

                    <!-- Brand -->
                    <div class="form-group col-md-3">
                        <label>Brand</label>
                        <p style="border:1px solid #eaeaea; padding:2px 3px;">
                            {{ $item->item_brand }}
                        </p>
                    </div>

                    <!-- Color -->
                    <div class="form-group col-md-2">
                        <label>Color</label>
                        <p style="border:1px solid #eaeaea; padding:2px 3px;">
                            {{ $item->item_color ?? 'Null' }}
                        </p>
                    </div>

                    <!-- Details -->
                    <div class="form-group col-md-4">
                        <label>Details</label>
                        <p style="border:1px solid #eaeaea; padding:2px 3px;">
                            {{ $item->item_details }}
                        </p>
                    </div>
                </div>

                <div class="row">
                    <!-- Grade -->
                    <div class="form-group col-md-2">
                        <label>Grade</label>
                        <p style="border:1px solid #eaeaea; padding:2px 3px;">
                            {{ $item->item_grade ?? 'Null' }}
                        </p>
                    </div>

                    <!-- Customer -->
                    <div class="form-group col-md-4">
                        <label>Customer</label>
                        <p style="border:1px solid #eaeaea; padding:2px 3px;">
                            {{ $customerName ?? 'Null' }}
                        </p>
                    </div>

                    <!-- Status -->
                    <div class="form-group col-md-2">
                        <label>Status</label>
                        <p style="border:1px solid #eaeaea; padding:2px 3px;">
                            {{ $item->status == 1 ? 'In Stock' : 'Out of Stock' }}
                        </p>
                    </div>

                    <!-- Tray# -->
                    <div class="form-group col-md-3">
                        <label>Tray#</label>
                        <div class="input-group">
                            <select class="form-control tray-control">
                                @foreach($trays as $tray)
                                    <option value="{{ $tray->tray_id }}" {{ $tray->tray_id == $item->tray_id ? 'selected' : '' }}>
                                        {{ $tray->title }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-success btn-flat confirm-tray">
                                    <i class="fa fa-check"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- In Sales Order -->
                    <div class="form-group col-md-2">
                        <label>In Sales Order</label>
                        <p style="border:1px solid #eaeaea; padding:2px 3px;">
                            {{ $salesOrderId ?? 'No' }}
                        </p>
                    </div>

                    <!-- QC Required -->
                    <div class="form-group col-md-2">
                        <label>QC Required?</label>
                        <p style="border:1px solid #eaeaea; padding:2px 3px;">
                            {{ $item->qc_required == 1 ? 'Yes' : 'No' }}
                        </p>
                    </div>

                    <!-- QC Status -->
                    <div class="form-group col-md-2">
                        <label>QC Status</label>
                        <p>
                            @if($item->qc_required == 1)
                                <label class="label label-primary">
                                    {{ $qcStatus }}
                                </label>
                            @endif
                        </p>
                    </div>

                    <!-- QC Comments -->
                    <div class="form-group col-md-4">
                        <label>QC Comments</label>
                        <p style="border:1px solid #eaeaea; padding:2px 3px;">
                            {{ $qcComments ?? 'None' }}
                        </p>
                    </div>

                    <!-- QC Link -->
                    @if($item->qc_required == 1)
                        <div class="form-group col-md-1">
                            <br>
                            <a href="{{ route('qc.edit', ['purchase_id' => $item->purchase_id]) }}" class="btn btn-info">
                                <i class="fa fa-search"></i> Visit QC
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Item Logs -->
        <div class="box box-success">
            <div class="box-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Ref</th>
                            <th>IMEI#</th>
                            <th>Subject</th>
                            <th>Details</th>
                            <th>User</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logs as $log)
                            <tr>
                                <td>{{ $log->date }}</td>
                                <td>{{ $log->ref }}</td>
                                <td>{{ $log->item_code }}</td>
                                <td>{{ $log->subject }}</td>
                                <td>{{ $log->details }}</td>
                                <td>{{ $users[$log->user_id]->user_name ?? 'Unknown' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<!-- JavaScript -->
<script>
    document.querySelector('.confirm-tray').addEventListener('click', function(e) {
        e.preventDefault();
        let trayId = document.querySelector('.tray-control').value.trim();
        let userId = document.querySelector('.user_id').innerHTML.trim();
        let purchaseId = document.querySelector('.pid').innerHTML.trim();
        let itemCode = document.querySelector('.item_code').innerHTML.trim();

        $.ajax({
            type: "POST",
            url: "{{ route('tray.update') }}",
            data: {
                _token: '{{ csrf_token() }}',
                item_code: itemCode,
                purchase_id: purchaseId,
                tray_id: trayId,
                user_id: userId
            },
            success: function(data) {
                $.notify("Tray updated", { className: "success", showDuration: 100 });
            },
            error: function(data) {
                $.notify("Error!!", { className: "error", showDuration: 100 });
            }
        });
    });
</script>
@endsection
