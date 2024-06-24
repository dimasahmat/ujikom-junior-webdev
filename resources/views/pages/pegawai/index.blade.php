@extends('layouts.dashboard')

@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <h1>Pegawai</h1>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="bx bx-user-plus"></i> Tambah Pegawai
        </button>
    </div>

    <table id="employees-table" class="table">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Nomor Telepon</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $pegawai)
                <tr>
                    <td>
                        @if ($pegawai->avatar)
                            <img class="img-thumbnail" src="{{ asset('storage/' . $pegawai->avatar) }}"
                                alt="{{ $pegawai->name }}" width="50">
                        @else
                            <img class="img-thumbnail" src="{{ asset('assets/img/avatars/ava.png') }}" alt=""
                                width="50">
                        @endif
                    </td>
                    <td>{{ $pegawai->name }}</td>
                    <td>{{ $pegawai->email }}</td>
                    <td>{{ $pegawai->phone_number ?? '-' }}</td>
                    <td>{{ $pegawai->address ?? '-' }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-sm btn-warning"
                                onclick="editEmployee('{{ $pegawai->id }}')">
                                <i class="bx bx-edit"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger"
                                onclick="deleteEmployee('{{ $pegawai->id }}')">
                                <i class="bx bx-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- modal tambah pegawai start --}}
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Pegawai Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addForm" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="addName" class="form-label">Nama<span class="required-star">*</span></label>
                            <input type="text" class="form-control" id="addName" name="name" placeholder="Nama"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="addEmail" class="form-label">Email<span class="required-star">*</span></label>
                            <input type="email" class="form-control" id="addEmail" name="email"
                                placeholder="contoh@gmail.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="addPassword" class="form-label">Kata Sandi<span
                                    class="required-star">*</span></label>
                            <input type="password" class="form-control" id="addPassword" name="password"
                                placeholder="minimal 8 karakter" required>
                        </div>
                        <div class="mb-3">
                            <label for="addPhoneNumber" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" id="addPhoneNumber" name="phone_number"
                                placeholder="08123456789">
                        </div>
                        <div class="mb-3">
                            <label for="addAddress" class="form-label">Alamat</label>
                            <textarea class="form-control" id="addAddress" name="address" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="addAvatar" class="form-label">Foto</label>
                            <input class="form-control" type="file" id="addAvatar" name="avatar">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" onclick="createUser()" class="btn btn-primary">Tambah</button>
                </div>
            </div>
        </div>
    </div>
    {{-- modal tambah pegawai end --}}

    {{-- Modal Edit Pegawai --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- Atau @method('PATCH') --}}
                        <input type="hidden" id="editId" name="id">
                        <div class="mb-3">
                            <label for="editName" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="editName" name="name" placeholder="Nama"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email"
                                placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <label for="editPassword" class="form-label">Kata Sandi</label>
                            <input type="password" class="form-control" id="editPassword" name="password"
                                placeholder="Kosongkan jika tidak ingin mengubah">
                        </div>
                        <div class="mb-3">
                            <label for="editPhoneNumber" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" id="editPhoneNumber" name="phone_number"
                                placeholder="Nomor Telepon">
                        </div>
                        <div class="mb-3">
                            <label for="editAddress" class="form-label">Alamat</label>
                            <textarea class="form-control" id="editAddress" name="address" placeholder="Alamat"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editAvatar" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="editAvatar" name="avatar">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" onclick="updateUser()" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Edit Pegawai --}}
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style>
        .required-star {
            color: red;
            /* Warna bintang merah */
            margin-left: 2px;
            /* Jarak antara label dan bintang */
        }
    </style>
@endpush

@push('javascript')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            new DataTable('#employees-table');

            // Function to submit new employee form
            window.createUser = function() {
                const url = "{{ route('api.employees.store') }}";
                let formData = new FormData();
                formData.append('name', $('#addName').val());
                formData.append('email', $('#addEmail').val());
                formData.append('password', $('#addPassword').val());
                formData.append('phone_number', $('#addPhoneNumber').val());
                formData.append('address', $('#addAddress').val());

                // Check if avatar file exists before appending
                if ($('#addAvatar')[0].files[0]) {
                    formData.append('avatar', $('#addAvatar')[0].files[0]);
                }

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        toastr.success(response.message, 'Sukses');
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        let response = error.responseJSON;
                        toastr.error(response.message, 'Error');
                        if (response.errors) {
                            for (const error in response.errors) {
                                let input = $(
                                    `#addForm input[name="${error}"], #addForm textarea[name="${error}"]`
                                );
                                input.addClass('is-invalid');
                                let feedbackElement =
                                    `<div class="invalid-feedback"><ul class="list-unstyled">`;
                                response.errors[error].forEach((message) => {
                                    feedbackElement += `<li>${message}</li>`;
                                });
                                feedbackElement += `</ul></div>`;
                                input.after(feedbackElement);
                            }
                        }
                    }
                });
            };

            // Function to show edit modal and populate data
            window.editEmployee = function(id) {
                const url = `{{ route('api.employees.show', ':id') }}`;
                $.get(url.replace(':id', id))
                    .done(function(response) {
                        $('#editId').val(response.data.id);
                        $('#editName').val(response.data.name);
                        $('#editEmail').val(response.data.email);
                        $('#editPhoneNumber').val(response.data.phone_number);
                        $('#editAddress').val(response.data.address);

                        // Show modal
                        $('#editModal').modal('show');
                    })
                    .fail(function(error) {
                        toastr.error('Gagal menampilkan data pegawai.', 'Error');
                    });
            };

            // Function to delete employee
            window.deleteEmployee = function(id) {
                Swal.fire({
                    title: 'Anda yakin?',
                    text: "Anda tidak akan dapat mengembalikan ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                }).then((result) => {
                    if (result.isConfirmed) {
                        const url = `{{ route('api.employees.destroy', ':id') }}`;
                        $.ajax({
                            url: url.replace(':id', id),
                            type: 'DELETE',
                            success: function(response) {
                                toastr.success(response.message, 'Sukses');
                                setTimeout(() => {
                                    location.reload();
                                }, 1000);
                            },
                            error: function(error) {
                                toastr.error('Gagal menghapus pegawai.', 'Error');
                            }
                        });
                    }
                });
            };

            // Function to update employee
            window.updateUser = function() {
                const id = $('#editId').val();
                const url = `{{ route('api.employees.update', ':id') }}`.replace(':id', id);
                let formData = new FormData($('#editForm')[0]);

                $.ajax({
                    url: url,
                    type: 'POST', // Ubah menjadi POST
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-HTTP-Method-Override': 'PATCH' // Tambahkan header X-HTTP-Method-Override
                    },
                    success: function(response) {
                        toastr.success(response.message, 'Sukses');
                        $('#editModal').modal('hide');
                        setTimeout(() => {
                            location.reload(); // atau perbarui DOM tanpa reload
                        }, 1000);
                    },
                    error: function(error) {
                        let response = error.responseJSON;
                        toastr.error(response.message, 'Error');

                        if (response.errors) {
                            // Tampilkan error validasi
                        }
                    }
                });
            };
        });
    </script>
@endpush
