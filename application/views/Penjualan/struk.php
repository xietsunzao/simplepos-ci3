<style type="text/css" media="all">
    body {
        color: #000;
    }

    table,
    th,
    tr {
        text-align: center;
    }

    #wrapper {
        max-width: 650px;
        margin: 0 auto;
        padding-top: 20px;
    }

    .btn {
        margin-bottom: 5px;
    }

    .table {
        border-radius: 3px;
    }

    .table th {
        background: #f5f5f5;
    }

    .table th,
    .table td {
        vertical-align: middle !important;
    }

    h3 {
        margin: 5px 0;
    }

    @media print {
        .no-print {
            display: none;
        }

        #wrapper {
            max-width: 480px;
            width: 100%;
            min-width: 250px;
            margin: 0 auto;
        }
    }

    tfoot tr th:first-child {
        text-align: right;
    }
</style>
<?php if ($this->session->flashdata('message')) { ?>
<div class="col-lg-12 alerts">
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4> <i class="icon fa fa-check"></i> Sukses</h4>
        <p><?php echo $this->session->flashdata('message'); ?></p>
    </div>
</div>
<?php } else { } ?>
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-primary'>
                <div class='box-header  with-border'>
                    <h3 class='box-title'>BUKTI PEMBAYARAN</h3>
                </div>
                <div id="print-area">
                    <div class="box-body">
                        <div id="wrapper">
                            <div id="receiptData" style="width: auto; max-width: 580px; min-width: 250px; margin: 0 auto;">
                                <div id="receipt-data">
                                    <div>
                                        <div style="text-align:center;">
                                            <img src="<?php echo base_url(); ?>assets/dist/img/bilbil.png" style="max-width:150px;" alt="BILBILWEST">
                                            <p style="text-align:center;"><strong>Simple POS</strong><br>jL. ABC123</p>
                                            <p></p>
                                        </div>
                                        <p>
                                            Tanggal : <?php echo $tanggal . ' ' . $jam; ?> <br>
                                            Nomor Transaksi : <?php echo $nota; ?><br>
                                            Nama Pelanggan : <?php echo $pelanggan; ?> <br>
                                            Operator : <?php echo $operator; ?> <br>
                                        </p>
                                        <div style="clear:both;"></div>
                                        <table class="table table-striped table-condensed">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 50%; border-bottom: 2px solid #ddd;">Nama Barang</th>
                                                    <th class="text-center" style="width: 12%; border-bottom: 2px solid #ddd;">QTY</th>
                                                    <th class="text-center" style="width: 24%; border-bottom: 2px solid #ddd;">Harga</th>
                                                    <th class="text-center" style="width: 26%; border-bottom: 2px solid #ddd;">Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($result as $row) { ?>
                                                <tr>
                                                    <td><?php echo $row->nama_barang; ?></td>
                                                    <td style="text-align:center;"><?php echo $row->jumlah_stok; ?></td>
                                                    <td class="text-center">Rp.<?php echo $row->harga_barang; ?></td>
                                                    <td class="text-right">Rp.<?php echo $row->sub_total; ?></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="2">Total</th>
                                                    <th colspan="2" class="text-right">Rp.<?php echo number_format($total); ?></th>
                                                </tr>
                                                <tr>
                                                    <th colspan="2">Diskon</th>
                                                    <th colspan="2" class="text-right"><?php echo $diskon; ?>%</th>
                                                </tr>
                                                <tr>
                                                    <th colspan="2">Grand Total</th>
                                                    <th colspan="2" class="text-right">Rp.<?php echo number_format($grand_total); ?></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <table class="table table-striped table-condensed" style="margin-top:10px;">
                                            <tbody>
                                                <tr>
                                                    <td class="text-left">transaksi:</td>
                                                    <td><?php echo $metode; ?></td>
                                                    <td class="text-right">Bayar :</td>
                                                    <td>Rp.<?php echo number_format($bayar); ?></td>
                                                    <td class="text-right">Kembalian:</td>
                                                    <td>Rp.<?php echo number_format($kembalian); ?></td>
                                                </tr>
                                                <?php if ($metode == 'Transfer') : ?>
                                                <tr>
                                                    <td class="text-left">No Rekening:</td>
                                                    <td><?php
                                                            $norek = substr($rekening,4);
                                                            $nrk = 'xxxx'.$norek;
                                                            echo $nrk;
                                                            ?></td>
                                                    <td class="text-right">Via:</td>
                                                    <td><?php echo $bank; ?></td>
                                                    <td class="text-right">Atas Nama(A/N)</td>
                                                    <td><?php echo strtoupper($atasnama); ?></td>
                                                </tr>
                                                <?php else : ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                        <div class="well well-sm" style="margin-top:10px;">
                                            <div style="text-align: center;">Terimakasih Sudah Belanja :)</div>
                                        </div>
                                    </div>
                                    <div style="clear:both;"></div>
                                </div>
                            </div>
                            <div id="buttons" style="padding-top:10px; text-transform:uppercase;" class="no-print">
                                <span class="pull-right col-xs-12">
                                    <button onclick="printDiv('print-area')" class="btn btn-block btn-primary">Print</button> </span>
                                <span class="col-xs-12">
                                    <a class="btn btn-block btn-warning" href="<?php echo base_url() ?>index.php/penjualan">Kembali ke Penjualan</a>
                                </span>
                                <div style="clear:both;"></div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal -->
            </div><!-- /.modal -->
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</section><!-- /.content -->


<script type="text/javascript">
    function printDiv(divName) {
        let printContents = document.getElementById(divName).innerHTML;
        let originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload(true);
        setTimeout(function() {}, 1000);
    }
</script>