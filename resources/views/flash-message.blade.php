{{--@if (session('success'))--}}
{{--    <div class="alert alert-success alert-dismissible fade show" id = "successAlert" role="alert">--}}
{{--        <strong> {{ session('success') }}</strong>--}}
{{--        <button type="button" class="btn-close" data-bs-dissmiss="alert" aria-label="Close"--}}
{{--                onclick="closeAlert('successAlert')"></button>--}}
{{--    </div>--}}
{{--@endif--}}

@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" id = "successAlert" role="alert">
        <strong> {{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dissmiss="alert" aria-label="Close"
                onclick="closeAlert('successAlert')"></button>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible fade show" id="errorAlert" role="alert">
        <strong> {{ $message }}</strong>
        <button type="button" onclick="closeAlert('errorAlert')" class="btn-close" data-bs-dissmiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($message = Session::get('warning'))
    <div class="alert alert-danger alert-dismissible fade show" id="warningAlert" role="alert">
        <strong> {{ $message }}</strong>
        <button type="button" class="btn-close" onclick="closeAlert('warningAlert')" data-bs-dissmiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($message = Session::get('info'))
    <div class="alert alert-info alert-dismissible fade show" id="infoAlert"  role="alert">
        <strong> {{ $message }}</strong>
        <button type="button" class="btn-close" onclick="closeAlert('infoAlert')" data-bs-dissmiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" id="anyErrorsAlert" role="alert">
        <strong> Please check the form bellow for errors</strong>
        <button type="button" class="btn-close" onclick="closeAlert('anyErrorsAlert')" data-bs-dissmiss="alert" aria-label="Close"></button>
    </div>
@endif

<script>
    function closeAlert($alertName){
        document.getElementById($alertName).hidden = true;
    }
</script>
