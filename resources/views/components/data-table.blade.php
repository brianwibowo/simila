@props([
    'title' => 'Table',
    'columns' => [],
    'rows' => [],
    'actions' => null,
    'responsive' => true,
    'striped' => true,
    'bordered' => true,
])

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">{{ $title }}</h4>
        @if(isset($header))
            <div>{{ $header }}</div>
        @endif
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($responsive)
            <div class="table-responsive">
        @endif
                <table class="table @if($striped) table-striped @endif @if($bordered) table-bordered @endif" id="dataTable">
                    <thead class="table-light">
                        <tr>
                            @foreach($columns as $column)
                                <th>{{ $column['label'] ?? ucfirst($column) }}</th>
                            @endforeach
                            @if($actions)
                                <th>{{ $actionsLabel ?? 'Aksi' }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rows as $row)
                            <tr>
                                @foreach($columns as $column)
                                    <td>
                                        @php
                                            $columnName = is_array($column) ? $column['key'] ?? $column['label'] : $column;
                                            $value = data_get($row, $columnName);
                                            
                                            // Check if there's a formatter callback
                                            if (is_array($column) && isset($column['format']) && is_callable($column['format'])) {
                                                $value = $column['format']($value, $row);
                                            }
                                        @endphp
                                        {!! $value !!}
                                    </td>
                                @endforeach
                                @if($actions)
                                    <td class="action-cell">
                                        <div class="action-buttons compact">
                                            {{ $actions($row) }}
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ count($columns) + ($actions ? 1 : 0) }}" class="text-center py-4">
                                    {{ $emptyMessage ?? 'Tidak ada data.' }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
        @if($responsive)
            </div>
        @endif

        @if(isset($pagination))
            <div class="d-flex justify-content-center mt-4">
                {{ $pagination->links() }}
            </div>
        @endif
    </div>
</div>