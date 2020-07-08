<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/app/css/style.css">
<?php if ($this->session->flashdata('message')) { ?>
    <div class="col-lg-12 alerts">
        <div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4> <i class="icon fa fa-ban"></i> Error</h4>
            <p><?php echo $this->session->flashdata('message'); ?></p>
        </div>
    </div>
<?php } else { } ?>
<section class="content">
    <div class="row">
        <div class="col-md-5">
            <div class="box box-warning kasir">
                <div class="box-header with-border">
                    <h3 class="box-title">Kasir</h3>
                    <div class="box-tools pull-right">
                        <span><i class="fa fa-shopping-cart"></i></span>
                    </div>
                </div>
                <div class="box-body">
                    <div style="width: 425px;" class="cart">
                        <div id="pos">
                            <div class="well well-sm" id="leftdiv">
                                <div id="lefttop" style="margin-bottom:5px;">
                                    <div class="form-group" style="margin-bottom:5px;">
                                        <p align="right"><a href="#" title="Cari Barang"><i class="fa fa-search"></i></a> Cari Barang</p>
                                        <form>
                                            <div class="form-group">
                                                <input class="form-control" name="idbarang" type="text" onkeyup="showResult(this.value)" placeholder="Ketik Nama Barang">
                                                <div id="hasilcari"></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div id="list-table-div">
                                    <div class="fixed-table-header">
                                        <table class="table table-striped list-table" style="margin:0;">
                                            <thead>
                                                <tr class="info">
                                                    <th>Nama Barang</th>
                                                    <th style="width: 15%;text-align:center;">Harga</th>
                                                    <th style="width: 15%;text-align:center;">Qty</th>
                                                    <th style="width: 20%;text-align:center;">Subtotal</th>
                                                    <th style="width: 20px;" class="satu absorbing-column"><i class="fa fa-trash-o"></i></th>
                                                </tr>
                                            </thead>
                                            <div>
                                                <div class="card card-body bg-light">
                                                    <tbody>
                                                        <?php
                                                        if (!empty($this->cart->contents())) {
                                                            foreach ($this->cart->contents() as $items) { ?>
                                                                <tr>
                                                                    <td>
                                                                        <?php if ($items['size'] == 1) : ?>
                                                                            <a href="#" class="btn bg-green btn-block btn-xs">
                                                                                <span class="sname">
                                                                                    <?= $items['name']; ?> (<?= $items['namesize'] ?>)
                                                                                </span>
                                                                            </a>
                                                                        <?php elseif ($items['size'] == 2) : ?>
                                                                            <a href="#" class="btn bg-blue btn-block btn-xs">
                                                                                <span class="sname">
                                                                                    <?= $items['name']; ?> (<?= $items['namesize'] ?>)
                                                                                </span>
                                                                            </a>
                                                                        <?php elseif ($items['size'] == 3) : ?>
                                                                            <a href="#" class="btn bg-yellow btn-block btn-xs">
                                                                                <span class="sname">
                                                                                    <?= $items['name']; ?> (<?= $items['namesize'] ?>)
                                                                                </span>
                                                                            </a>
                                                                        <?php elseif ($items['size'] == 4) : ?>
                                                                            <a href="#" class="btn bg-purple btn-block btn-xs">
                                                                                <span class="sname">
                                                                                    <?= $items['name']; ?> (<?= $items['namesize'] ?>)
                                                                                </span>
                                                                            </a>
                                                                        <?php elseif ($items['size'] == 5) : ?>
                                                                            <a href="#" class="btn bg-red btn-block btn-xs">
                                                                                <span class="sname">
                                                                                    <?= $items['name']; ?> (<?= $items['namesize'] ?>)
                                                                                </span>
                                                                            </a>
                                                                        <?php else : ?>
                                                                            <a href="#" class="btn bg-black btn-block btn-xs">
                                                                                <span class="sname">
                                                                                    <?= $items['name']; ?> (<?= $items['namesize'] ?>)
                                                                                </span>
                                                                            </a>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td align="right">Rp.<?= $this->fungsi->rupiah($items['price']); ?></td>
                                                                    <td style="text-align:center;">
                                                                        <form action="<?= base_url('index.php/ubah_qty'); ?>" method="POST">
                                                                            <input type="hidden" id="idbrg" name="idbarang" value="<?= $items['id_barang']; ?>">
                                                                            <input type="hidden" name="rowid" value="<?= $items['rowid']; ?>">
                                                                            <input type="number" class="total" max="500" min="0" value="<?= $items['qty']; ?>" name="qty" size="5">
                                                                            <button class="btn btn-primary btn-sm fa fa-check" style="display:none;" title="Simpan">
                                                                            </button>
                                                                        </form>
                                                                    </td>
                                                                    <td align="center">
                                                                        Rp.<?= $this->fungsi->rupiah($items['subtotal']); ?>
                                                                    </td>
                                                                    <td align="center">
                                                                        <a onclick="location.href = '<?= base_url(); ?>index.php/hapus_cart/<?= $items['rowid']; ?>';" title="Batalkan">
                                                                            <i class="fa fa-trash-o tip pointer posdel"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            <?php }
                                                        } else { ?>
                                                        <?php } ?>
                                                    </tbody>
                                                </div>
                                            </div>
                                        </table>
                                    </div>
                                </div>
                                <div style="clear:both;"></div>
                                <table id="totaltbl" class="table table-condensed totals" style="margin-bottom:10px;">
                                    <tr class="info">
                                        <td width="25%">Total Barang</td>
                                        <td class="text-center" style="padding-right:10px;"><span id="count"><?= $this->cart->total_items(); ?></span></td>
                                        <td width="25%" style="font-weight:bold;">Grand Total</td>
                                        <td class="text-right" style="font-weight:bold;" colspan="2"><span id="total"><span id="count">Rp.<?= $this->fungsi->rupiah($this->cart->total()); ?>
                                                    <input readonly type="hidden" name="total" id="total' onfocus=" startCalculate()" onblur="stopCalc()" value="<?= $this->cart->total(); ?>" required="">
                                                </span></span></td>
                                    </tr>
                                </table>
                            </div>
                            <div id="botbuttons" class="col-xs-12 text-center">
                                <div class="row">
                                    <div class="col-xs-6" style="padding: 0;">
                                        <div class="btn-group-vertical btn-block">
                                            <a href="<?php echo base_url() ?>index.php/cancel" class="btn btn-danger btn-block btn-flat" id="reset">Cancel</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-6" style="padding: 0;">
                                        <a href="#" onclick="payment()" class="btn btn-success btn-block btn-flat" id="pembayaran">Pembayaran</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="box box-info ">
                <div class="box-header with-border">
                    <h3 class="box-title" id="ReciverName_txt">List Stok Barang</h3>
                    <div class="cold-md-3 push-1">
                        <a href="#" onclick="sort()" class="btn btn-default btn-sm toggle_form pull-right">Tampilkan/Sembunyikan Filter</a>
                    </div>
                    <div class="box-tools pull-right">
                        <span data-toggle="tooltip">
                            <i class="fa fa-cubes"></i>
                        </span>
                    </div>
                </div>
                <div class="contents" id="right-col">
                    <div class="box-body" style="height:670px;overflow-y: scroll;">
                        <div class="listitem with-border">
                            <div id="sort">
                                <?php echo form_open('penjualan/store'); ?>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="kategori" class="control-label">Kategori</label>
                                        <div class="input-group">
                                            <select class="form-control" name="kategori">
                                                <option value="">Pilih Semua</option>
                                                <?php
                                                foreach ($kategori as $k) {
                                                    echo "<option value=' $k->id_kategori'>$k->nama_kategori</option>";
                                                }
                                                ?>
                                            </select>
                                            <span class="input-group-addon">
                                                <span class="fa fa-list"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="ukuran" class="control-label">Ukuran</label>
                                        <div class="input-group">
                                            <select class="form-control" name="ukuran">
                                                <option value=""">Pilih Semua</option>
                                                <?php
                                                foreach ($ukuran as $u) {
                                                    echo "<option value=' $u->id_ukuran'>$u->nama_ukuran</option>";
                                                }
                                                ?>
                                            </select>
                                            <span class=" input-group-addon">
                                                    <span class="fa fa-expand"></span>
                                                    </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-2" style="padding-top:25px;">
                                    <div class="input-group">
                                        <button type="submit" name="filter" class="btn btn-primary ">Filter</button>
                                    </div>
                                </div>
                                <?= form_close() ?>
                            </div>
                            <div id="item-list">
                                <div class="items">
                                    <?php foreach ($result as $row) {  ?>
                                        <div class="col-md-3 pro-1">
                                            <div class="col-m" style="padding:0.5em;">
                                                <a href="#" onclick="detailCart('<?php echo $row->id_barang ?>')" class="offer-img">
                                                    <div class="img1">
                                                        <img src="<?php echo  base_url('uploads/') . $row->foto; ?>" style="width: 100px; height: 100px;" class="img-responsive" alt="<?php echo $row->nama_barang; ?>">
                                                    </div>
                                                    <?php if ($row->ukuran == 1) : ?>
                                                        <div class="offerg">
                                                            <p>
                                                                <span><?php echo $row->nama_ukuran; ?></span>
                                                            </p>
                                                        </div>
                                                    <?php elseif ($row->ukuran == 2) : ?>
                                                        <div class="offerb">
                                                            <p>
                                                                <span><?php echo $row->nama_ukuran; ?></span>
                                                            </p>
                                                        </div>
                                                    <?php elseif ($row->ukuran == 3) : ?>
                                                        <div class="offery">
                                                            <p>
                                                                <span><?php echo $row->nama_ukuran; ?></span>
                                                            </p>
                                                        </div>
                                                    <?php elseif ($row->ukuran == 4) : ?>
                                                        <div class="offerprp">
                                                            <p>
                                                                <span><?php echo $row->nama_ukuran; ?></span>
                                                            </p>
                                                        </div>
                                                    <?php elseif ($row->ukuran == 5) : ?>
                                                        <div class="offerrd">
                                                            <p>
                                                                <span><?php echo $row->nama_ukuran; ?></span>
                                                            </p>
                                                        </div>
                                                    <?php else : ?>
                                                        <div class="offerd">
                                                            <p>
                                                                <span><?php echo $row->nama_ukuran; ?></span>
                                                            </p>
                                                        </div>
                                                    <?php endif; ?>
                                                </a>
                                                <div class="mid-1">
                                                    <div class="women">
                                                        <h6 align="center" s><a href="single.html"><?php echo $row->nama_barang; ?></a>
                                                            <br>(<?php echo $row->stok_barang ?>pcs)
                                                        </h6>
                                                    </div>
                                                    <div class="mid-2">
                                                        <p align="center"><label>Rp.<?= $this->fungsi->rupiah($row->harga); ?></label></p>
                                                    </div>
                                                    <div class="add">
                                                        <a href="<?php echo base_url() . 'index.php/penjualan/tambah_barang/' . $row->id_barang . '/1' ?>" type="button" class="btn btn-danger my-cart-btn my-cart-b">Add to Cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="page">
                    <?php if (!isset($_POST['filter'])) {
                        echo $halaman;
                    } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="modalpayment" role="dialog" style="min-width: 80%;">
    <div class="modal-dialog" style="min-width: 50%;">
        <div class="modal-content">
            <div id="datapayment">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                    <h4 class="modal-title" id="payModalLabel">
                        Payment </h4>
                </div>
                <div class="modal-body">
                    <form onSubmit="if(!confirm('Pastikan sudah terjadi pembayaran!')){return false;}" action="<?= base_url('index.php/penjualan/transaksi'); ?>" method="POST" name="frm_byr">
                        <div class="row">
                            <div class="col-xs-12">
                                <div>
                                    <table id="modaltab" class="table table-bordered table-condensed" style="margin-bottom: 0;">
                                        <tr class="table-secondary">
                                            <td id="mdl" width="25%" style="border-right-color: #FFF !important;">Total Barang</td>
                                            <td id="mdl" width="25%" class="text-center">
                                                <span id="item_count"><?= $this->cart->total_items(); ?></span>
                                            </td>
                                            <td id="mdl" width="25%" style="border-right-color: #FFF !important;">Grand Total</td>
                                            <td id="mdl" class="text-right">
                                                <input type="hidden" name="totalpure" id="totalpure" value="<?php echo  $this->cart->total(); ?>" class="form-control kb-text">
                                                <span>Rp.<input readonly type="number" id="total" name="grandtotal" onfocus="startCalculate()" onblur="stopCalc()" value="<?= $this->cart->total(); ?>" required="">
                                                </span>
                                            </td>
                                        </tr class="table-secondary">
                                        <tr>
                                            <td id="mdl" style="border-right-color: #FFF !important;">Diskon</td>
                                            <td id="mdl" class="text-center"><span>
                                                    <input type="number" name="diskon" id="diskon" max="100" min="0" onfocus="startCalculate()" onblur="stopCalc()" value="0" required=""><span>%</span>
                                                </span></td>
                                            <td id="mdl" style="border-right-color: #FFF !important;">Kembalian</td>
                                            <td id="mdl" class="text-right">
                                                <span>Rp.
                                                    <input readonly type="number" id="kembalian" name="kembalian" onfocus="startCalculate()" onblur="stopCalc()" required="">
                                                </span>
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label for="note"><strong>BAYAR (Rp)</strong>
                                            </label>
                                            <input type="number" placeholder="Pembayaran" name="bayar" class="form-control" id="bayar" onfocus="startCalculate()" onblur="stopCalc()" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="pelanggan">Nama Pelanggan</label>
                                            <input type="text" name="pelanggan" placeholder="Nama Pelanggan" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="note">Catatan</label>
                                            <textarea name="note" placeholder="Catatan untuk transaksi" id="note" class="pa form-control kb-text"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label for="payment">Metode Pembayaran</label>
                                            <select id="payment" name="metode" class="form-control" style="width:100%;">
                                                <option value="1">Cash</option>
                                                <option value="2">Transfer</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="rek">
                                    <div class="col-xs-7">
                                        <div class="form-group">
                                            <label for="note">No. Rek</label>
                                            <input type="text" name="norek" class="form-control kb-text">
                                        </div>
                                    </div>
                                    <div class="col-xs-5">
                                        <div class="form-group">
                                            <label for="note">Bank</label>
                                            <div id="byjson"></div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label for="note">Atas Nama(A/N)</label>
                                            <input type="text" name="atas_nama" class="form-control kb-text">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                <?php
                                                        if (!empty($this->cart->contents())) {
                                                            foreach ($this->cart->contents() as $items) { ?>
                                    <input type="hidden" name="idbrg" value="<?= $items['id_barang']; ?>">
                                    <input type="hidden" name="rowid" value="<?= $items['rowid']; ?>">
                                    <input type="hidden" value="<?= $items['qty']; ?>" name="qty" size="5">
                                                            <?php } }else{ }?>
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"> Close </button>
                                    <button class="btn btn-primary" id="submit-sale">Submit</button>
                                </div>
                            </div>
                        </div><!-- /.modal-dialog -->
                    </form>
                </div><!-- /.modal -->
            </div>
        </div>
    </div>
</div><!-- /.modal-dialog -->

<div class="modal fade" id="myModal2" role="dialog" style="min-width: 100%">
    <div class="modal-dialog">
        <div id="barang"> </div>
    </div><!-- /.modal-dialog -->
</div>
<script type="text/javascript">
    function startCalculate() {
        interval = setInterval("Calculate()", 1);
    }

    function Calculate() {
        let a = <?= $this->cart->total(); ?>;
        let b = document.frm_byr.total.value;
        let c = document.frm_byr.diskon.value;
        let d = document.frm_byr.bayar.value;
        let e = 100;
        let f = (a / e * c);
        let g = (a - f);
        let h = (d - g);
        document.frm_byr.total.value = (g);
        document.frm_byr.kembalian.value = (h);
        let hasil;
        hasil = (g);
        let bilangan = (g);
        let number_string = bilangan.toString(),
            sisa = number_string.length % 3,
            rupiah = number_string.substr(0, sisa),
            ribuan = number_string.substr(sisa).match(/\d{3}/g);
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

    }

    function stopCalc() {
        clearInterval(interval);
    }

    function payment() {
        let idBrg = $('#idbrg').val();
        if (idBrg == undefined) {
            alert('Cart tidak boleh kosong!');
        } else {
            $('#modalpayment').modal("show");
        }
    }

    function tutup() {
        $("#modalpayment").modal("hide");
        $(".modal-backdrop").remove();
    }

    function detailCart(id) {
        let page = '<?= base_url() ?>'
        var url = page + "penjualan/detail_modal/" + id;
        $.ajax({
            url: url,
            type: "GET",
            data: {
                id: id
            },
            success: function(data) {
                $(document.getElementById('barang')).html(data);
                $('#myModal2').modal("show");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
            }
        });
    }

    function showResult(str) {
        if (str.length == 0) {
            document.getElementById("hasilcari").innerHTML = "";
            document.getElementById("hasilcari").style.border = "0px";
            return;
        }
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("hasilcari").innerHTML = this.responseText;
                document.getElementById("hasilcari").style.border = "1px solid #A5ACB2";
            }
        }
        xmlhttp.open("GET", "<?= base_url(); ?>index.php/penjualan/caribarang?q=" + str, true);
        xmlhttp.send();
    }

    function createByJson() {
        let jsonData = [{
                description: 'Pilih Metode Transfer Pembayaran',
                value: '',
                text: 'Bank Transfer'
            },
            {
                image: '../assets/dist/img/bank/mandiri.png',
                description: '',
                value: '1',
                text: 'Mandiri'
            },
            {
                image: '../assets/dist/img/bank/bni.png',
                description: '',
                value: '2',
                text: 'BNI'
            },
            {
                image: '../assets/dist/img/bank/bca.png',
                description: '',
                value: '3',
                text: 'BCA'
            },
            {
                image: '../assets/dist/img/bank/bri.png',
                description: '',
                value: '4',
                text: 'BRI',
            },
            {
                image: '../assets/dist/img/bank/niaga.png',
                description: '',
                value: '4',
                text: 'CIMB Niaga'
            },
        ];
        let jsn = $("#byjson").msDropDown({
            byJson: {
                data: jsonData,
                name: 'payments'
            }
        }).data("dd");
    }
    $(function() {
        $('#rek').hide();
        $('#payment').change(function() {
            if ($('#payment').val() == '2') {
                $('#rek').show();
                createByJson();
            } else {
                $('#rek').hide();
            }
        });
    });
    $(document).on('keyup', 'input[name=qty]', function() {
        let _this = $(this);
        let min = parseInt(_this.attr('min')) || 1;
        let max = parseInt(_this.attr('max')) || 100; // if max attribute is not defined, 100 is default
        let val = parseInt(_this.val()) || (min - 1); // if input char is not a number the value will be (min - 1) so first condition will be true
        if (val < min)
            _this.val(min);
        if (val > max)
            _this.val(max);
    });
    $(document).on('keyup', 'input[name=diskon]', function() {
        let _this = $(this);
        let zero = parseInt(_this.attr('zero')) || 0;
        let min = parseInt(_this.attr('min')) || 1; // if min attribute is not defined, 1 is default
        let max = parseInt(_this.attr('max')) || 100; // if max attribute is not defined, 100 is default
        let val = parseInt(_this.val()) || (min - 1); // if input char is not a number the value will be (min - 1) so first condition will be true
        if (val < min || val == '')
            _this.val(min);
        if (val > max)
            _this.val(max);
        if (val == 0)
            _this.val(zero);
    });

    function sort() {
        $("#sort").toggle();
    }
</script>
<script src="<?php echo base_url() ?>assets/plugins/zoomto/jquery.zoomtoo.js"></script>
<script>
    $(function() {
        $("#picture-frame").zoomToo({
            magnify: 1
        });
    });
</script>