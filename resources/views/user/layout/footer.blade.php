<div class="footer exact-fit">
    <div class="container" id="lg-footer">
        <div class="float-right"> <strong>Version</strong> 2.0.0</div>
        <div> &#xA9; 2023</div>
    </div>
    {{-- <div class="container" id="sm-footer">
        <div class="text-center count-info">
            <button onclick="goToPanel()" class="btn btn-default mobile-cart btn-lg"><i class="fa fa-cog"></i></button>

        </div>
    </div> --}}
</div>

{{-- <script src="/lib/jquery/dist/jquery.min.js"></script>
<script src="/lib/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="/js/menuController.js"></script> --}}
<script src="{{ asset('/admin/lib/toastr/toastr.min.js') }}"></script>
<script>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}")
        @endforeach
    @endif
</script>
</body>

</html>
