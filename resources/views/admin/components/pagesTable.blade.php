
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
    
