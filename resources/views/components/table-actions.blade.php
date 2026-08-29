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

<div class="action-group @if($compact) btn-group-sm @endif">
    @if($viewRoute)
        <a href="{{ $viewRoute }}" class="btn btn-sm btn-info btn-action" title="Lihat">
            @if($showIcons) <i class="fa fa-eye"></i> @endif
        </a>
    @endif

    @if($editRoute)
        <a href="{{ $editRoute }}" class="btn btn-sm btn-primary btn-action" title="Edit">
            @if($showIcons) <i class="fa fa-edit"></i> @endif
        </a>
    @endif

    @if($approveRoute)
        <form action="{{ $approveRoute }}" method="POST" class="d-inline">
            @csrf
            @method('PUT')
            <button type="submit" 
                    class="btn btn-sm btn-success btn-action" 
                    onclick="return confirm('{{ $approveMessage }}')"
                    title="Setujui">
                @if($showIcons) <i class="fa fa-check"></i> @endif
            </button>
        </form>
    @endif

    @if($rejectRoute)
        <form action="{{ $rejectRoute }}" method="POST" class="d-inline">
            @csrf
            @method('PUT')
            <button type="submit" 
                    class="btn btn-sm btn-warning btn-action" 
                    onclick="return confirm('{{ $rejectMessage }}')"
                    title="Tolak">
                @if($showIcons) <i class="fa fa-times"></i> @endif
            </button>
        </form>
    @endif

    @if($downloadRoute)
        <a href="{{ $downloadRoute }}" class="btn btn-sm btn-secondary btn-action" title="Download">
            @if($showIcons) <i class="fa fa-download"></i> @endif
        </a>
    @endif

    @if($deleteRoute)
        <form action="{{ $deleteRoute }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="btn btn-sm btn-danger btn-action" 
                    onclick="return confirm('{{ $deleteMessage }}')"
                    title="Hapus">
                @if($showIcons) <i class="fa fa-trash"></i> @endif
            </button>
        </form>
    @endif

    @foreach($customActions as $action)
        @if(isset($action['route']) && isset($action['label']))
            <a href="{{ $action['route'] }}" 
               class="btn btn-sm {{ $action['class'] ?? 'btn-secondary' }} btn-action"
               title="{{ $action['label'] }}"
               @if(isset($action['target'])) target="{{ $action['target'] }}" @endif>
                @if($showIcons && isset($action['icon']))
                    <i class="{{ $action['icon'] }}"></i>
                @endif
            </a>
        @elseif(isset($action['html']))
            {!! $action['html'] !!}
        @endif
    @endforeach
</div>
