<div class="footer">
    <div class="container-fluid g-5">
        <div class="row g-3">
            <div class="col-sm-6 text-center text-sm-start">
                <p class="mb-0"><i class="far fa-copyright"></i> <span id="copyright-year"></span>
                    AIS ONLINE</p>
            </div>
        </div>
    </div>
</div>

<script>
function GoBackWithRefresh(event) {
    if ('referrer' in document) {
        window.location = document.referrer;
        /* OR */
        //location.replace(document.referrer);
    } else {
        window.history.back();
    }
}


</script>
