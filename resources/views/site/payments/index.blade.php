<x-layouts.master>
    <div class="card">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>id</th>
                    <th>payment_id</th>
                    <th>description</th>
                    <th>status</th>
                    <th>amount</th>
                    <th>image</th>
                    <th>crated_at</th>
                </tr>
            </thead>
            <tbody>
                @forelse ( $payments as $payment )
                    <tr>
                        <td>{{ $payment->id }}</td>
                        <td>{{ $payment->payment_id }}</td>
                        <td>{{ $payment->description }}</td>
                        <td>{{ $payment->status }}</td>
                        <td>{{ $payment->amount }}</td>
                        <td>
                            @if ($payment->item)
                                <img class="h-auto" style="width:50px;" src="{{ asset('storage/items/'.$payment->item->image_url) }}" alt="" srcset="">
                                @else
                                No Image
                            @endif
                        </td>
                        <td>{{ $payment->created_at }}</td>
                    </tr>
                    @empty
                    <p>empty</p>
                @endforelse
            </tbody>

            <tfoot>
                <tr>
                    <th>id</th>
                    <th>payment_id</th>
                    <th>description</th>
                    <th>status</th>
                    <th>amount</th>
                    <th>image</th>
                    <th>crated_at</th>
                </tr>
            </tfoot>
        </table>
    </div>

@push('scripts')


    @if(session('failed'))

        <script>
              const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: "error",
                        title: 'Oops...',
                        text: '{{ session("failed") }}'
                    });

        </script>



    @endif
    @if(session('success'))

        <script>
            const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: "success",
                        text: '{{ session("success") }}'
                    });

        </script>

    @endif
@endpush

</x-layouts.master>
