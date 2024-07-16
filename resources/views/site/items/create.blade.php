<x-layouts.master>

    <div class="col-md-12">
        <div class="card mb-4">
          <h5 class="card-header">create item</h5>
          <div class="card-body demo-vertical-spacing demo-only-element">

            <div>
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

                      <div class="form-group">
                        <button id="save_item" type="button" class="btn btn-primary w-100">save</button>
                      </div>

                </form>
            </div>

          </div>
        </div>
      </div>

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
