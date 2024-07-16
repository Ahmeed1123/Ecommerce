<x-layouts.master>
   <div class="card">
        <div class="card-body">
            <h5 class="card-title d-flex justify-content-between">
                items
                <div class="btns ms-auto">
                    @auth
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalLong">
                        <i class='bx bx-plus fs-3'></i>
                                              </button>
                    @else
                        {{-- <a href="{{ route('item.create') }}" class="btn btn-primary">Create item</a> --}}
                    @endauth
                </div>
            </h5>

            <div class="row row-cols-1 row-cols-md-3 g-4 mb-5" id="refrecheData">
                @forelse ( $items as $key => $item )
                <div class="col">
                    <div class="card h-100">
                    <img class="card-img-top" src="{{ asset('storage/items').'/'.$item->image_url }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title d-flex justify-content-between align-items-center gap-1">
                            {{ $item->title }}
                            <span class="text-dark">{{ $item->amount }} ريال</span>
                        </h5>
                        <p class="card-text">
                            {{ $item->description }}
                        </p>

                        <div class="btns-payment">
                            <form action="{{ route('payment.create') }}" method="GET">
                                @csrf
                                <input type="hidden" name="amount" value="{{ $item->amount }}">
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <input type="hidden" name="title" value="{{ $item->title }}">
                                <button type="submit" class="btn btn-md btn-dark w-100">buy now</button>
                            </form>
                        </div>
                        @auth
                            @if (auth()->user()->id == $item->user_id)
                                <div class="btns mt-5 d-flex justify-content-center gap-2">
                                    <a href="{{ route('item.edit', $item->id) }}" class="btn btn-md btn-warning">edit</a>
                                    <button type="button" class="btn btn-md btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{$item->id}}">delete</button>
                                </div>

                            @endif
                        @endauth

                    </div>
                    </div>
                </div>
                @empty
                <p>not found item</p>
                @endforelse


            </div>
        </div>
   </div>
   <!-- Modal  start -->
   <div class="modal fade" id="modalLong" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLongTitle">create item</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <!-- form start -->
            @auth
            <form id="ItemForm" method="POST"  enctype="multipart/form-data" action="{{ route('item.store') }}">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="title" name="title" aria-describedby="floatingInputHelp">
                    <label for="floatingInput">title</label>
                    <div id="title_error" class="form-text text-danger">

                    </div>
                </div>

                  <div id="floatingInputHelp" class="form-text mb-3">
                        <div class="input-group">
                          <span class="input-group-text">description</span>
                          <textarea class="form-control" name="description" aria-label="description" placeholder="description" style="height: 108px;"></textarea>
                        </div>
                        <small class="form-text text-danger" id="description_error">

                        </small>
                  </div>

                  <div id="floatingInputHelp" class="form-text mb-3">
                    <div class="input-group mb-3">
                        <span class="input-group-text">$</span>
                        <input type="nubmar" name="amount" class="form-control" placeholder="Amount" aria-label="Amount (to the nearest dollar)">
                        <span class="input-group-text">.00</span>
                    </div>
                    <small class="form-text text-danger" id="amount_error">

                    </small>
                  </div>

                <div class="mb-3">
                    <label for="formFile" class="form-label">Default file input example</label>
                    <input class="form-control" name="image_url" type="file" id="formFile">
                    <small id="photo_error" class="form-text text-danger">

                    </small>
                </div>
            </form>
            @endauth

            <!-- form end -->

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Close
          </button>
          <button type="button" id="save_item" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
   <!-- Modal end -->


   @push('scripts')
   <script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '#save_item', function(e) {
          e.preventDefault();
          // let form = $('#ItemForm');
          $('#photo_error').text('');
          $('#description_error').text('');
          $('#title_error').text('');
          $('#amount_error').text('');
          var formData = new FormData($('#ItemForm')[0]);

          $.ajax({
              url: "{{ route('item.store') }}",
              type: 'POST',
              enctype: 'multipart/form-data',
              // data: {
              //     '_token': "{{ csrf_token() }}",
              //     // 'image_url': $("input[name='image_url']").val(),
              //     'title': $("input[name='title']").val(),
              //     'description': $("input[name='description']").val(),
              //     'amount': $("input[name='amount']").val(),
              // },
              data: formData,
              processData: false,
              contentType: false,
              cache: false,
              success: function (data) {
                  // تعامل مع الاستجابة بنجاح
                  if (data.status == true ) {
                        $('#refrecheData').html(data.html); // تحديث البيانات في #refrecheData
                        $('#modalLong').modal('hide'); // إخفاء النموذج المودال
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
                          title: data.msg,
                          });
                  } else {
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
                          icon: "erorr",
                          title: data.msg,
                          });
                  }
              },
              error: function (reject) {
                var response = $.parseJSON(reject.responseText);

                // Clear previous errors
                $('#photo_error').text('');
                $('#description_error').text('');
                $('#title_error').text('');
                $('#amount_error').text('');

                if (reject.status === 422) {
                    // Validation errors
                    $.each(response.errors, function (key, value) {
                        $("#" + key + "_error").text(value[0]);
                    });
                } else {
                    // Other errors
                    const errorMessage = response.message || reject.statusText || reject.responseText;
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
                        title: errorMessage,
                    });
                }
            }
          });
        });
    });
    </script>

   @endpush
</x-layouts.master>
