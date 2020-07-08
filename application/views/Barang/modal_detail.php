<style>
    .image {
        cursor: crosshair;
    }
</style>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body modal-spa">
            <div class="col-md-12 span-2">
                <div class="image-container">
                    <div class="image detail-view" style="background-image: url(<?php echo  base_url('uploads/') . $detail->foto; ?>);no-repeat" class="img-responsive" alt=""></div>
                </div>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>

<script>
    (function() {
        // Get all images with the `detail-view` class
        var zoomBoxes = document.querySelectorAll('.detail-view');

        // Extract the URL
        zoomBoxes.forEach(function(image) {
            var imageCss = window.getComputedStyle(image, false),
                imageUrl = imageCss.backgroundImage
                .slice(4, -1).replace(/['"]/g, '');

            // Get the original source image
            var imageSrc = new Image();
            imageSrc.onload = function() {
                var imageWidth = imageSrc.naturalWidth,
                    imageHeight = imageSrc.naturalHeight,
                    ratio = imageHeight / imageWidth;

                // Adjust the box to fit the image and to adapt responsively
                var percentage = ratio * 100 + '%';
                image.style.paddingBottom = percentage;

                // Zoom and scan on mousemove
                image.onmousemove = function(e) {
                    // Get the width of the thumbnail
                    var boxWidth = image.clientWidth,
                        // Get the cursor position, minus element offset
                        x = e.pageX - this.offsetLeft,
                        y = e.pageY - this.offsetTop,
                        // Convert coordinates to % of elem. width & height
                        xPercent = x / (boxWidth / 100) + '%',
                        yPercent = y / (boxWidth * ratio / 100) + '%';

                    // Update styles w/actual size
                    Object.assign(image.style, {
                        backgroundPosition: xPercent + ' ' + yPercent,
                        backgroundSize: imageWidth + 'px'
                    });
                };

                // Reset when mouse leaves
                image.onmouseleave = function(e) {
                    Object.assign(image.style, {
                        backgroundPosition: 'center',
                        backgroundSize: 'cover'
                    });
                };
            }
            imageSrc.src = imageUrl;
        });
    })();
</script>