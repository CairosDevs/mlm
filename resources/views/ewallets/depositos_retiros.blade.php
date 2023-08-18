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

    <!-- Modal -->


<script>
        $(document).ready(function() {
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

