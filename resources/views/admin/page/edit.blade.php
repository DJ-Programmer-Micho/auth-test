@extends('admin.layouts.master')

@section('content')


@push('sort-meta')

@endpush
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
    #draggable { 
        width: 150px;
        height: 150px;
        padding: 0.5em;
    }
    .list-group-item{
        background-color: #44454f !important;;
        color: #fff;
    }
  </style>
<div class="m-4 p-0" style="color:#fff">
    {{-- select --}}
  <div class="row">
            <div class="col-md-6">
                <div class="card bg-card-dark rounded border-4 mb-2 p-1 text-white">
                    <table class="table table-dark table-striped">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Pages</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody id="table-body-container">
                          @foreach($data['items'] as $item)
                          <tr>
                              <th scope="row">{{ $item->id }}</th>
                            
                              <td>{{ $item->name }}</td>
                              <td class="d-flex flex-wrap">
                                  @foreach(json_decode($item->properties) as $property)
                                  <h3 class="px-1"><span class="badge bg-success">{{ $property }}</span></h3>
                                  @endforeach
                              </td>
                              <td>
                                  <a class="btn btn-info btn-edit" role="button"
                                      data-item-id="{{ $item->id }}"
                                      data-item-name="{{ $item->name }}"
                                      data-item-properties="{{ json_encode(json_decode($item->properties)) }}">
                                      <i class="fas fa-expand-arrows-alt"></i>
                                  </a>
                              </td>
                          </tr>
                          @endforeach
                        </tbody>
                        <input type="hidden" id="hidden-item-id" name="hidden-item-id">
                    </table>
                </div>
            </div>
            <div class="col-md-3 bg-dark">
                <div class="card bg-card-dark rounded border-4 mb-2 p-1">
                <ul class="list-group shadow-lg connectedSortable" id="padding-item-drop">
                  {{-- @if($data['items'][0])
                    @foreach($panddingItem as $key=>$value)
                      <li class="list-group-item" item-id="{{ $property }}">{{ $property }} Component</li>
                      @endforeach
                      @endif --}}
                      <li class="list-group-item ui-state-disabled" item-id="">THE PAGES</li>
                      {{-- <li class="list-group-item" item-id="about">About Component</li>
                      <li class="list-group-item" item-id="blog">Blog Component</li>
                      <li class="list-group-item" item-id="brand">Brand Component</li>
                      <li class="list-group-item" item-id="fact">Fact Component</li>
                      <li class="list-group-item" item-id="pricing">Pricing Component</li>
                      <li class="list-group-item" item-id="qoute">Qoute Component</li>
                      <li class="list-group-item" item-id="services">Services Component</li>
                      <li class="list-group-item" item-id="slider">Slider Component</li>
                      <li class="list-group-item" item-id="team">Team Component</li>
                      <li class="list-group-item" item-id="testimonial">Testimonial Component</li>
                      <li class="list-group-item" item-id="whyus">Whyus Component</li> --}}

                </ul>
            </div>
            </div>
            <div class="col-md-3 bg-dark shadow-lg complete-item">
                <div class="card bg-card-dark rounded border-4 mb-2 p-1">
                <ul class="list-group  connectedSortable" id="complete-item-drop">
                  <li class="list-group-item ui-state-disabled" item-id="empty">THE RESULT</li>
            </div>
            </div>
  </div>

@push('iconscript')
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    // function attachEventHandlers() {

    $(function () {
        $("#padding-item-drop, #complete-item-drop").sortable({
            connectWith: ".connectedSortable",
            opacity: 0.5,
        }).disableSelection();

        // Handle edit button click
        $('.btn-edit').on('click', function () {
            updateCompleteItemDrop2();
            var itemId = $(this).data('item-id');
            var itemName = $(this).data('item-name');
            var itemProperties = $(this).data('item-properties');
            $('#hidden-item-id').val(itemId);
            updateCompleteItemDrop(itemId, itemName, itemProperties);
        });

        // Function to update complete-item-drop with item properties
        function updateCompleteItemDrop(itemId, itemName, itemProperties) {
            var completeItemDrop = $('#complete-item-drop');
            completeItemDrop.empty();

            // Add empty item
            completeItemDrop.append('<li class="list-group-item ui-state-disabled" item-id="empty">THE RESULT</li>');

            // Add item properties
            $.each(itemProperties, function (index, property) {
                completeItemDrop.append('<li class="list-group-item" item-id="' + property + '">' + property + ' Component</li>');
            });
        }

        function updateCompleteItemDrop2() {
            var completeItemDrop2 = $('#padding-item-drop');
            completeItemDrop2.empty();

            // Add empty item
            completeItemDrop2.append('<li class="list-group-item ui-state-disabled" item-id="">THE PAGES</li>');

            // Add item properties
            var asd = [
                        "about",
                        "blog",
                        "brand",
                        "fact",
                        "pricing",
                        "qoute",
                        "services",
                        "services_all",
                        "slider",
                        "team",
                        "testimonial",
                        "whyus"
                      ]
            $.each(asd, function (index, property) {
                completeItemDrop2.append('<li class="list-group-item" item-id="' + property + '">' + property + ' Component</li>');
            });
        }

        $(".connectedSortable").on("sortupdate", function (event, ui) {
            if (event.target.id === "complete-item-drop") {
                var completeArr = [];
                $("#complete-item-drop li").each(function (index) {
                    var itemId = $(this).attr('item-id');
                    if (!completeArr.includes(itemId)) {
                        completeArr.push(itemId);
                    } else {
                        $(this).remove(); // Remove duplicate item from complete-item-drop
                    }
                });

                $("#padding-item-drop li").each(function () {
                    var itemId = $(this).attr('item-id');
                    if (completeArr.includes(itemId)) {
                        $(this).remove(); // Remove item from padding-item-drop if it exists in complete-item-drop
                    }
                });
                var itemId = $('#hidden-item-id').val();
                $.ajax({
                    url: "{{ route('update.properties') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        itemId: itemId, // Send the selected ID
                        properties: completeArr // Send the completeArr
                    },
                    success: function (data) {
                        console.log('success');
                        $('#table-body-container').html(data);
                        $('.btn-edit').on('click', function () {
                            updateCompleteItemDrop2();
                            var itemId = $(this).data('item-id');
                            var itemName = $(this).data('item-name');
                            var itemProperties = $(this).data('item-properties');
                            $('#hidden-item-id').val(itemId);
                            updateCompleteItemDrop(itemId, itemName, itemProperties);
                        });
                    },
                    error: function (xhr, status, error) {
                        console.log(error)
            }
                });
            }
        });

        // Remove items from padding-item-drop on load if they exist in complete-item-drop
        $("#padding-item-drop li").each(function () {
            var itemId = $(this).attr('item-id');
            if ($("#complete-item-drop li[item-id='" + itemId + "']").length > 0) {
                $(this).remove();
            }
        });
    });







// }

</script>
@endpush

@endsection
 