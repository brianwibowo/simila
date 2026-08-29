@props(['guru'])

<x-table-actions
    :viewRoute="route('admin-guru-tamu-show', $guru->id)"
    :editRoute="route('admin-guru-tamu-edit', $guru->id)"
    :approveRoute="$guru->status === 'proses' ? route('admin-guru-tamu-approve', $guru->id) : null"
    :deleteRoute="route('admin-guru-tamu-destroy', $guru->id)"
    deleteMessage="Apakah Anda yakin ingin menghapus data ini?"
    approveMessage="Apakah Anda yakin ingin menyetujui pengajuan ini?"
    compact
/>
