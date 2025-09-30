<div class="row">
    <div class="col-12">
        <style>
            .cities-toggle{
                display: none;
            }
        @media (max-width: 768px) {
            .disable-div {
                display: none;
            }
            .align-div{
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }
            .cities-toggle{
                display: block;
            }
        }
        </style>
        <div class="card shadow-sm border-0" style="border-radius: 20px; overflow: hidden;">
            <div class="card-header bg-white d-flex justify-content-between align-items-center"
                style="border-radius: 20px 20px 0 0;">
                <h4 class="mb-0 text-primary">
                    <i class="bi bi-list me-2"></i>All States ({{ $states->total() }})
                </h4>
                <div class="d-flex justify-content-end align-items-center">
                    <a href="{{ route('create.state') }}" class="btn btn-primary rounded-pill py-2 fw-semibold btn-sm">
                        <i class="bi bi-plus-circle me-2"></i>Add State
                    </a>

                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="text-muted fw-bold">#</th>
                                <th scope="col" class="text-muted fw-bold">State Name</th>
                                <th scope="col" class="text-muted fw-bold disable-div">Cities</th>
                                <th scope="col" class="text-muted fw-bold disable-div">Status</th>
                                <th scope="col" class="text-muted fw-bold text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($states as $index => $item)
                            <tr>
                                <th scope="row" class="align-middle">{{ $item->id }}  </th>
                                <td class="align-middle fw-bold text-dark"><span style="display : flex" >{{ $item->name }}<span class="cities-toggle" style="max-width : max-content" >({{ $item->cities->where('status','1')->count() }})</span></span>
                            </td>
                                <td class="align-middle disable-div">
                                    <span class="badge bg-success rounded-pill px-3 py-2 fs-6">
                                        <i
                                            class="bi bi-buildings me-1"></i>{{ $item->cities->where('status','1')->count() }}
                                        Cities
                                    </span>
                                </td>
                                <td class="align-middle disable-div">
                                    @if($item->cities->where('status','1')->count() > 0)
                                    <small class="text-success fw-semibold"><i
                                            class="bi bi-check-circle me-1"></i>Active</small>
                                    @else
                                    <small class="text-warning fw-semibold"><i
                                            class="bi bi-exclamation-circle me-1"></i>Inactive</small>
                                    @endif
                                </td>
                                <td class="align-middle text-center align-div">
                                    <div class="d-flex justify-content-center flex-wrap gap-2">
                                        <a href="{{ route('show.city',  Crypt::encryptString($item->id)) }}"
                                            class="btn btn-outline-primary rounded-pill py-2 fw-semibold btn-sm">
                                            <i class="bi bi-eye me-1"></i>View
                                        </a>
                                        <a href="{{ route('state.edit', Crypt::encryptString($item->id)) }}"
                                            class="btn btn-outline-info rounded-pill py-2 fw-semibold btn-sm">
                                            <i class="bi bi-pen me-1"></i>Edit
                                        </a>
                                        <a  data-id="{{ $item->id }}"
                                            class="delete  btn btn-outline-danger rounded-pill py-2 fw-semibold btn-sm">
                                            <i class="bi bi-trash me-1"></i>Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <div class="alert alert-warning mb-0">
                                        <i class="bi bi-exclamation-triangle me-2"></i> No States Found
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@if($states->hasPages())
<div class="d-flex justify-content-center mt-4">
    {{ $states->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
</div>
@endif

<script>

</script>
<script>
    $(document).ready(function(){
        console.log('Document ready, jQuery loaded');
    $(document).on('click', '.delete', function(e){
            console.log('delete button clicked');
            e.preventDefault();

            if(!confirm('Are you sure you want to delete this head?')) {
                return;
            }

            var headId = $(this).data('id');
            console.log('Head ID:', headId);

            $.ajax({
                type: 'POST',
                url: "/admin/state-city/deletestate/" + headId,
                data: {
                                '_token': '{{ csrf_token() }}'
                            },
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response){
                    console.log('Response:', response);
                    if(response.status === 'success'){
                        alert(response.message + ' User: ' + response.state_name + ' ');
                        location.reload();
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr, status, error){
                    console.log('AJAX Error:', xhr.responseText);
                    alert('An error occurred: ' + (xhr.responseJSON?.message || xhr.responseText));
                }
            });
        });
        });
    </script>
