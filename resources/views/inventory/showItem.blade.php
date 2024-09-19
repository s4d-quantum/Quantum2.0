<!-- resources/views/inventory/showItem.blade.php -->

@extends('layouts.app')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Item# <span class="item_code">{{ $item_code }}</span>
    </h1>
  </section>

  <section class="content">
    <!-- Row -->
    <div class="row">
      <!-- Column -->
      <div class="col-md-12">
        <!-- Box -->
        <div class="box box-success">
          <div class="box-body">
            <!-- First Row -->
            <div class="row">
              <div class="form-group col-md-2 col-sm-6">
                <label>P.ID</label>
                <p class="pid" style="border:1px solid #eaeaea;padding:2px 3px;">
                  {{ $get_item->purchase_id }}
                </p>
                <p class="user_id hide">{{ auth()->user()->id }}</p>
              </div>

              <div class="form-group col-md-3 col-sm-6">
                <label>Brand</label>
                <p style="border:1px solid #eaeaea;padding:2px 3px;">
                  {{ $get_modal->title ?? 'N/A' }}
                </p>
              </div>

              <div class="form-group col-md-2 col-sm-6">
                <label>Colour</label>
                <p style="border:1px solid #eaeaea;padding:2px 3px;">
                  {{ $get_item->item_color ?? 'Null' }}
                </p>
              </div>

              <div class="form-group col-md-4 col-sm-6">
                <label>Details</label>
                <p style="border:1px solid #eaeaea;padding:2px 3px;">
                  {{ $get_item->item_details }}
                </p>
              </div>
            </div>
            <!-- Second Row -->
            <div class="row">
              <div class="form-group col-md-2 col-sm-6">
                <label>Grade</label>
                <p style="border:1px solid #eaeaea;padding:2px 3px;">
                  {{ $get_grade->title ?? 'Null' }}
                </p>
              </div>

              <div class="form-group col-md-4 col-sm-6">
                <label>Customer</label>
                <p style="border:1px solid #eaeaea;padding:2px 3px;">
                  {{ $get_customer->name ?? 'Null' }}
                </p>
              </div>

              <div class="form-group col-md-2 col-sm-6">
                <label>Status</label>
                <p style="border:1px solid #eaeaea;padding:2px 3px;">
                  {{ $get_item->status == 1 ? 'In Stock' : 'Out of Stock' }}
                </p>
              </div>

              <div class="form-group col-md-3 col-sm-6 show-tray-container">
                <label>Tray#</label>
                <div class="input-group choose-tray-container">
                  <select class="form-control tray-control">
                    @foreach($trays as $tray)
                      <option value="{{ $tray->tray_id }}" {{ $tray->tray_id == $get_item->tray_id ? 'selected' : '' }}>
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
            <!-- Third Row -->
            <div class="row">
              <div class="form-group col-md-2 col-sm-6">
                <label>In Sales Order</label>
                <p style="border:1px solid #eaeaea;padding:2px 3px;">
                  {{ ($in_sales_order->count ?? 0) == 0 ? 'No' : $in_sales_order->order_id }}
                </p>
              </div>

              <div class="form-group col-md-2 col-sm-6">
                <label>QC Required?</label>
                <p style="border:1px solid #eaeaea;padding:2px 3px;">
                  {{ $get_item->qc_required == 1 ? 'Yes' : 'No' }}
                </p>
              </div>

              <div class="form-group col-md-2 col-sm-6">
                <label>QC Status</label>
                <p>
                  @if($get_item->qc_required == 1)
                    <label class="label label-primary">
                      @if(isset($qc))
                        @if($qc->item_cosmetic_passed == 1 && $qc->item_functional_passed == 1 && $get_item->qc_completed == 1)
                          Done
                        @elseif(($qc->item_cosmetic_passed == 0 || $qc->item_functional_passed == 0) && $get_item->qc_completed == 1)
                          Failed
                        @else
                          In Progress
                        @endif
                      @else
                        Not Started
                      @endif
                    </label>
                  @endif
                </p>
              </div>

              <div class="form-group col-md-4 col-sm-6">
                <label>QC Comments</label>
                <p style="border:1px solid #eaeaea;padding:2px 3px;">
                  {{ isset($qc->item_comments) && strlen($qc->item_comments) > 0 ? $qc->item_comments : 'None' }}
                </p>
              </div>

              <div class="form-group col-md-1 col-sm-6">
                <br>
                @if($get_item->qc_required == 1)
                  <a href="{{ url('qc/qc-imei/edit_qc?pur_id=' . $get_item->purchase_id) }}" class="btn btn-info">
                    <i class="fa fa-search"></i> Visit QC
                  </a>
                @endif
              </div>
            </div>
          </div>
        </div>

        <!-- Unit History Table -->
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
                @foreach($fetch_item_logs as $row)
                  <tr>
                    <td>{{ $row->date }}</td>
                    <td>{{ $row->ref }}</td>
                    <td>{{ $row->item_code }}</td>
                    <td>{{ $row->subject }}</td>
                    <td>{{ $row->details }}</td>
                    <td>{{ $users[$row->user_id] ?? 'Unknown' }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
</div>

@endsection

@section('scripts')
<script>
  let confirmTrayBtn = document.querySelector('.confirm-tray'),
      userId = document.querySelector('.user_id').innerText.trim(),
      purchaseId = document.querySelector('.pid').innerText.trim(),
      itemCode = document.querySelector('.item_code').innerText.trim();

  confirmTrayBtn.addEventListener('click', function(e) {
    e.preventDefault();
    let trayId = document.querySelector('.tray-control').value.trim();
    $.ajax({
      type: "POST",
      url: "{{ route('inventory.updateTray') }}",
      data: {
        _token: '{{ csrf_token() }}',
        item_code: itemCode,
        purchase_id: purchaseId,
        tray_id: trayId,
        user_id: userId
      },
      success: (data) => {
        $.notify("Tray updated", {
          className: "success",
          showDuration: 100,
        });
      },
      error: (data) => {
        $.notify("Error updating tray!", {
          className: "error",
          showDuration: 100,
        });
      }
    });
  });
</script>
@endsection
