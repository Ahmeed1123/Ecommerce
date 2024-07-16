<x-layouts.payment>
    @push('styles')
   <!-- Moyasar Styles -->
   <link rel="stylesheet" href="https://cdn.moyasar.com/mpf/1.14.0/moyasar.css" />

   <!-- Moyasar Scripts -->
   <script src="https://cdnjs.cloudflare.com/polyfill/v3/polyfill.min.js?version=4.8.0&features=fetch"></script>
   <script src="https://cdn.moyasar.com/mpf/1.14.0/moyasar.js"></script>

    @endpush

    <div class="mysr-form"></div>

    @push('scripts')
    <script>
        Moyasar.init({
            element: '.mysr-form',
            amount: {{ $amount * 100 }},
            currency: 'SAR',
            language:'ar',
            metadata: {
                'item_id': {{ $id }}
            },
            description: "charge for item {{ $title }} At a price {{ $amount }}SAR",
            publishable_api_key: 'pk_test_FzHBMi7VomHk4P97Rp8NcFuBUeYNjyoQhXGTF5xx',
            // publishable_api_key: '{{ config("moyasar.key") }}',
            callback_url: "{{ route('payment.procicing') }}",
            methods: ['creditcard'],
            fixed_width: true, // optional, only for demo purposes
        });
    </script>
    @endpush
</x-layouts.payment>
