@if (sizeof($_popup))

    <!-- Modal -->
    <div class="modal fade" id="popupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close-button close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <div class="modal-body">
                    <div class="nd-owl-carousel owl-theme">
                        @foreach($_popup as $popup)
                            <div class="item">
                                <a href="{{$popup->link}}">
                                    <img src="{{$popup->image_link}}">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.nd-owl-carousel').owlCarousel({
                navigation: true, // Show next and prev buttons
                slideSpeed: 300,
                paginationSpeed: 400,
                singleItem: true
            });

            $('#popupModal .close-button').click(function () {
                $('#popupModal').modal('hide');
                setCloseStatus(true);
            });

            setTimeout(function () {
                if (!getCloseStatus()) {
                    $('#popupModal').modal('show');
                }
            }, 15000);

        });

        function getCloseStatus() {

            var a = sessionStorage.getItem('is_close');

            if (a) {
                return true;
            } else {
                return false;
            }
        }

        function setCloseStatus(status) {
            sessionStorage.setItem('is_close', status);
        }

    </script>
@endif
