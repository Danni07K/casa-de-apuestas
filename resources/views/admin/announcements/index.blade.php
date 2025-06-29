@extends('layouts.admin')

@section('title', 'Anuncios')

@section('content')
<div class="card">
    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3">
        <h5 class="mb-0">Gestión de Anuncios</h5>
        <div class="d-flex flex-wrap gap-2">
            <input type="text" class="form-control" placeholder="Buscar..." id="searchInput" style="max-width: 250px;">
            <a href="{{ route('admin.announcements.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i> Nuevo Anuncio
            </a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título y Contenido</th>
                    <th class="text-center">Tipo</th>
                    <th>Periodo de Vigencia</th>
                    <th class="text-center">Estado</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($announcements as $announcement)
                <tr class="announcement-row" data-title="{{ strtolower($announcement->title) }}">
                    <td><strong>#{{ $announcement->id }}</strong></td>
                    <td>
                        <div class="fw-bold">{{ $announcement->title }}</div>
                        <small class="text-muted-color">{{ Str::limit($announcement->content, 70) }}</small>
                    </td>
                    <td class="text-center">
                        @php
                            $typeConfig = [
                                'info' => ['class' => 'bg-info bg-opacity-10 text-info', 'text' => 'Info'],
                                'warning' => ['class' => 'bg-warning bg-opacity-10 text-warning', 'text' => 'Aviso'],
                                'success' => ['class' => 'bg-success bg-opacity-10 text-success', 'text' => 'Éxito'],
                                'danger' => ['class' => 'bg-danger bg-opacity-10 text-danger', 'text' => 'Urgente'],
                            ];
                            $config = $typeConfig[$announcement->type] ?? ['class' => 'bg-secondary bg-opacity-10 text-secondary', 'text' => 'General'];
                        @endphp
                        <span class="badge rounded-pill {{ $config['class'] }}">{{ $config['text'] }}</span>
                    </td>
                    <td>
                        <div class="small">Del {{ $announcement->start_date->format('d/m/Y') }}</div>
                        <div class="small">Al {{ $announcement->end_date->format('d/m/Y') }}</div>
                    </td>
                    <td class="text-center">
                        <form action="{{ route('admin.announcements.toggle', $announcement) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm {{ $announcement->is_active ? 'btn-success' : 'btn-secondary' }}" title="Clic para cambiar estado">
                                {{ $announcement->is_active ? 'Activo' : 'Inactivo' }}
                            </button>
                        </form>
                    </td>
                    <td class="text-end">
                        <div class="btn-group">
                            <a href="{{ route('admin.announcements.edit', $announcement) }}" class="btn btn-sm btn-secondary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $announcement->id }})">
                                <i class="fas fa-trash"></i>
                            </button>
                            <form id="delete-form-{{ $announcement->id }}" action="{{ route('admin.announcements.destroy', $announcement) }}" method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5">
                        <i class="fas fa-bullhorn fa-2x text-muted-color mb-2"></i>
                        <p class="mb-0">No hay anuncios registrados.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($announcements->hasPages())
    <div class="card-footer">
        {{ $announcements->links() }}
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
function confirmDelete(announcementId) {
    if (confirm('¿Estás seguro de que deseas eliminar este anuncio?')) {
        document.getElementById('delete-form-' + announcementId).submit();
    }
}

document.getElementById('searchInput').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    document.querySelectorAll('.announcement-row').forEach(row => {
        const title = row.dataset.title;
        row.style.display = title.includes(searchTerm) ? '' : 'none';
    });
});
</script>
@endpush 