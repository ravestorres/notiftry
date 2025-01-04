function suggestion() {
    $('#sug_input').keyup(function (e) {
        const formData = { title: $('#sug_input').val() }; // Get the value from input field

        if (formData.title.length >= 1) {
            $.ajax({
                type: 'POST',
                url: 'ajax.php',
                data: formData,
                dataType: 'json',
                encode: true,
            })
            .done(function (data) {
                // If products are found, display them in the result list
                if (data && data.length) {
                    $('#result').empty().fadeIn();
                    data.forEach(product => {
                        $('#result').append(`<li data-id="${product.id}" data-name="${product.name}">${product.name}</li>`);
                    });
                } else {
                    $('#result').html('<li>No products found</li>').fadeIn();
                }

                // Add product to table when clicked
                $('#result li').click(function () {
                    const product_id = $(this).data('id');
                    const product_name = $(this).data('name');
                    $.ajax({
                        type: 'POST',
                        url: 'ajax.php',
                        data: { p_name: product_name }, // Send the product name for fetching product details
                        dataType: 'json',
                        encode: true,
                    })
                    .done(function (productData) {
                        if (productData.error) {
                            alert(productData.error);
                        } else {
                            $('#product_info').append(`
                                <tr data-product-id="${productData.id}">
                                    <td>${productData.name}</td>
                                    <td><input type="text" class="form-control" name="price" value="${productData.sale_price}" readonly></td>
                                    <td><input type="number" class="form-control" name="quantity" value="1" min="1"></td>
                                    <td><input type="text" class="form-control" name="total" value="${productData.sale_price}" readonly></td>
                                    <td><input type="date" class="form-control datePicker" name="date" data-date data-date-format="yyyy-mm-dd"></td>
                                    <td><input type="hidden" name="s_id" value="${productData.id}"></td>
                                </tr>
                            `);
                            total();  // Recalculate total after adding a new row
                        }
                    });
                    $('#result').fadeOut(500);
                });

                // Hide result list when input field loses focus
                $('#sug_input').blur(function () {
                    $('#result').fadeOut(500);
                });
            })
            .fail(function () {
                $('#result').html('<li>Sorry, no products found.</li>').fadeIn();
            });
        } else {
            $('#result').hide();
        }

        e.preventDefault();
    });
}

// Recalculate totals
function total() {
    $('#product_info').on('input', 'input[name="quantity"], input[name="price"]', function () {
        const row = $(this).closest('tr');
        const price = +row.find('input[name="price"]').val() || 0;
        const qty = +row.find('input[name="quantity"]').val() || 0;
        const total = qty * price;
        row.find('input[name="total"]').val(total.toFixed(2));
    });
}

$(document).ready(function () {
    // Initialize suggestion functionality
    suggestion();

    // Initialize datepicker
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        autoclose: true
    });

    // Initialize tooltip
    $('[data-toggle="tooltip"]').tooltip();

    // Toggle submenu visibility
    $('.submenu-toggle').click(function () {
        $(this).parent().children('ul.submenu').toggle(200);
    });
});
