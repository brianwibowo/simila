@props([
    'viewRoute' => null,
    'editRoute' => null,
    'deleteRoute' => null,
    'approveRoute' => null,
    'rejectRoute' => null,
    'downloadRoute' => null,
    'customActions' => [],
    'deleteMessage' => 'Apakah Anda yakin ingin menghapus data ini?',
    'approveMessage' => 'Apakah Anda yakin ingin menyetujui?',
    'rejectMessage' => 'Apakah Anda yakin ingin menolak?',
    'showIcons' => true,
    'compact' => false,
])

<div class="action-group">
    @if($viewRoute)
        <a href="{{ $viewRoute }}" 
           class="btn btn-action btn-info" 
           title="Lihat Detail" 
           data-bs-toggle="tooltip" 
           aria-label="Lihat Detail">
            @if($showIcons) <i class="fa fa-eye"></i> @else Detail @endif
        </a>
    @endif

    @if($editRoute)
        <a href="{{ $editRoute }}" 
           class="btn btn-action btn-primary" 
           title="Edit Data" 
           data-bs-toggle="tooltip" 
           aria-label="Edit Data">
            @if($showIcons) <i class="fa fa-edit"></i> @else Edit @endif
        </a>
    @endif

    @if($approveRoute)
        <form action="{{ $approveRoute }}" method="POST" class="d-inline m-0 p-0">
            @csrf
            @method('PUT')
            <button type="submit" 
                    class="btn btn-action btn-success" 
                    onclick="return confirm('{{ $approveMessage }}')"
                    title="Setujui" 
                    data-bs-toggle="tooltip" 
                    aria-label="Setujui">
                @if($showIcons) <i class="fa fa-check"></i> @else Setuju @endif
            </button>
        </form>
    @endif

    @if($rejectRoute)
        <form action="{{ $rejectRoute }}" method="POST" class="d-inline m-0 p-0">
            @csrf
            @method('PUT')
            <button type="submit" 
                    class="btn btn-action btn-warning" 
                    onclick="return confirm('{{ $rejectMessage }}')"
                    title="Tolak" 
                    data-bs-toggle="tooltip" 
                    aria-label="Tolak">
                @if($showIcons) <i class="fa fa-times"></i> @else Tolak @endif
            </button>
        </form>
    @endif

    @if($downloadRoute)
        <a href="{{ $downloadRoute }}" 
           class="btn btn-action btn-secondary" 
           title="Unduh File" 
           data-bs-toggle="tooltip" 
           aria-label="Unduh File">
            @if($showIcons) <i class="fa fa-download"></i> @else Unduh @endif
        </a>
    @endif

    @if($deleteRoute)
        <form action="{{ $deleteRoute }}" method="POST" class="d-inline m-0 p-0">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="btn btn-action btn-danger" 
                    onclick="return confirm('{{ $deleteMessage }}')"
                    title="Hapus" 
                    data-bs-toggle="tooltip" 
                    aria-label="Hapus">
                @if($showIcons) <i class="fa fa-trash"></i> @else Hapus @endif
            </button>
        </form>
    @endif

    @foreach($customActions as $action)
        @if(isset($action['route']))
            <a href="{{ $action['route'] }}" 
               class="btn btn-action {{ $action['class'] ?? 'btn-secondary' }}"
               title="{{ $action['label'] ?? '' }}"
               data-bs-toggle="tooltip"
               @if(isset($action['target'])) target="{{ $action['target'] }}" @endif>
                @if($showIcons && isset($action['icon']))
                    <i class="{{ $action['icon'] }}"></i>
                @else
                    {{ $action['label'] ?? 'Aksi' }}
                @endif
            </a>
        @elseif(isset($action['html']))
            {!! $action['html'] !!}
        @endif
    @endforeach
</div>
