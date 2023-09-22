<x-app-layout>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <h1>Depositos & Retiros</h1>
            
            @include('ewallets.admin.index')
            @include('ewallets.customer.index')
            
        </div>
    </div>
    <!--end page wrapper -->

<script>
        $(document).ready(function() {
            $("#solicitar_retiros").tooltip();

            $("#retiro-total").click(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "Una vez aceptes, se procedera a procesar su solicitud de retiro total de capital",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        let formData = new FormData();
                        formData.append('type', $("#tipo_total").val());
                        formData.append('amount', $('#amount_total').val());
                        formData.append('_token', $('input[name=_token]').val());
                        axios({
                            url: "{{ route('payment.form') }}",
                            method: 'POST',
                            data: formData,
                        })
                        .then(function (response) {

                            console.log(response);

                            Swal.fire({
                                title: "¡Éxito!",
                                text: response.data.success,
                                icon: "success",
                            });
                        })
                        .catch(function (error) {

                            console.log(error);

                            if (error.response) {
                                
                                Swal.fire({
                                    title: "Error",
                                    text: error.response.data.error,
                                    icon: "error",
                                });
                            }
                        });
                    }
                });
            });

            $("#deposit_plus").click(function() {
                var currentValue = parseInt($("#deposit_amount").val());
                $("#deposit_amount").val(currentValue + 1);
            });
            $("#deposit_minus").click(function() {
                var currentValue = parseInt($("#deposit_amount").val());
                if (currentValue > 0) {
                $("#deposit_amount").val(currentValue - 1);
                }
            });
            $("#withdraw_plus").click(function() {
                var currentValue = parseInt($("#withdraw_amount").val());
                $("#withdraw_amount").val(currentValue + 1);
            });
            $("#withdraw_minus").click(function() {
                var currentValue = parseInt($("#withdraw_amount").val());
                if (currentValue > 0) {
                $("#withdraw_amount").val(currentValue - 1);
                }
            });
        });
</script>
</x-app-layout>

