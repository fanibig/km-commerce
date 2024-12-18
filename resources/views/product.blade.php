<div x-data="variantManager({{ json_encode($product->attributes) }})">
    <div>
        <!-- Attribute Selection -->
        <template x-for="(attribute, index) in attributes" :key="index">
            <div>
                <label x-text="attribute.name"></label>
                <select x-model="selectedAttributes[attribute.id]" @change="fetchVariant">
                    <option value="">Select</option>
                    <template x-for="value in attribute.values" :key="value.id">
                        <option :value="value.id" x-text="value.name"></option>
                    </template>
                </select>
            </div>
        </template>
    </div>

    <!-- Variant Info -->
    <div x-show="variant">
        <h3 x-text="variant.sku"></h3>
        <p x-text="variant.price"></p>
        <p x-text="variant.stock"></p>
    </div>
</div>

{{--  jQuery with blade  --}}
<div id="variant-manager">
    <!-- Attribute Selection -->
    @foreach ($product->attributes as $attribute)
        <div>
            <label>{{ $attribute->name }}</label>
            <select class="attribute-select" data-attribute-id="{{ $attribute->id }}">
                <option value="">Select</option>
                @foreach ($attribute->values as $value)
                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
            </select>
        </div>
    @endforeach

    <!-- Variant Info -->
    <div id="variant-info" style="display: none;">
        <h3 id="variant-sku"></h3>
        <p id="variant-price"></p>
        <p id="variant-stock"></p>
    </div>
</div>


<script>
    function variantManager(attributes) {
        return {
            attributes: attributes,
            selectedAttributes: {},
            variant: null,

            async fetchVariant() {
                if (Object.keys(this.selectedAttributes).length === this.attributes.length) {
                    const response = await fetch('{{ route('product.variants') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            product_id: {{ $product->id }},
                            attributes: this.selectedAttributes,
                        }),
                    });

                    const data = await response.json();
                    this.variant = data.length > 0 ? data[0] : null;
                }
            },
        };
    }

    //Jquery
    $(document).ready(function () {
        let selectedAttributes = {};

        $('.attribute-select').on('change', function () {
            let attributeId = $(this).data('attribute-id');
            let valueId = $(this).val();

            if (valueId) {
                selectedAttributes[attributeId] = valueId;
            } else {
                delete selectedAttributes[attributeId];
            }

            if (Object.keys(selectedAttributes).length === $('.attribute-select').length) {
                fetchVariant();
            }
        });

        function fetchVariant() {
            $.ajax({
                url: '{{ route('product.variants') }}',
                method: 'POST',
                data: {
                    product_id: {{ $product->id }},
                    attributes: selectedAttributes,
                    _token: '{{ csrf_token() }}',
                },
                success: function (data) {
                    if (data.length > 0) {
                        const variant = data[0];
                        $('#variant-sku').text(variant.sku);
                        $('#variant-price').text(variant.price);
                        $('#variant-stock').text(variant.stock);
                        $('#variant-info').show();
                    } else {
                        $('#variant-info').hide();
                    }
                },
            });
        }
    });

</script>
