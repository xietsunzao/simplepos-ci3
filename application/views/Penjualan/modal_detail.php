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
            <div class="col-md-5 span-2">
                <div class="image-container">
                    <div class="image detail-view" style="background-image: url(<?php echo  base_url('uploads/') . $detail->foto; ?>);no-repeat" class="img-responsive" alt=""></div>
                </div>
            </div>
            <div class="col-md-7 span-1 ">
                <h3><?php echo $detail->nama_barang; ?>(<?php echo $detail->stok_barang; ?>pcs)</h3>
                <p class="in-para"> There are many variations of passages of Lorem Ipsum.</p>
                <div class="price_single">
                    <span class="reducedfrom ">Rp <?php echo number_format($detail->harga); ?></span>
                    <div class="clearfix"></div>
                </div>
                <h4 class="quick">Quick Overview:</h4>
                <p class="quick_desc"> Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; es</p>
                <div class="add-to">
                    <a href="<?php echo base_url() . 'index.php/penjualan/tambah_barang/' . $detail->id_barang . '/1' ?>" type="button" class="btn btn-danger my-cart-btn my-cart-btn1">Add to Cart</a>
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