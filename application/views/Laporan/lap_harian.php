<style type="text/css">
    table {
        border: 15px solid #25BAE4;
        border-collapse: collapse;
    }

    td {
        width: 50px;
        height: 50px;
        text-align: center;
        border: 1px solid #e2e0e0;
        font-size: 18px;
        font-weight: bold;
    }

    th {
        height: 50px;
        padding-bottom: 8px;
        background: #25BAE4;
        font-size: 20px;
        text-align: center;
    }

    .prev_sign a,
    .next_sign a {
        color: white;
        text-decoration: none;
    }

    tr.week_name {
        font-size: 16px;
        font-weight: 400;
        color: red;
        width: 10px;
        background-color: #efe8e8;
    }

    .highlight {
        background-color: #25BAE4;
        color: white;
        height: 27px;
    }

    .calender .days td {
        width: 2000px;
        height: 50px;
    }

    .calender .hightlight {
        font-weight: 600px;
    }

    .calender .days td:hover {
        background-color: #DEF;
    }

    .content {
        min-height: 0px;
        /* padding: 15px; */
        /* margin-right: auto; */
        /* margin-left: auto; */
        /* padding-left: 15px; */
        /* padding-right: 15px; */
    }
</style>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class='box-header  with-border'>
                    <h3 class='box-title'>Laporan Penjualan Harian</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <?php foreach ($cards as $info_cards) : ?>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box bg-<?= $info_cards->box ?>">
                                    <span class="info-box-icon"><i class="fa fa-<?= $info_cards->icon ?>"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text"><?= $info_cards->title; ?></span>
                                            <span class="info-box-number"><?= $info_cards->total; ?></span>
                                        <div class="progress">
                                            <div style="width: 100%" class="progress-bar"></div>
                                        </div>
                                        <span class="progress-description">
                                            <?= $info_cards->description; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="col-md-12">
                            <?php echo $calender; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>