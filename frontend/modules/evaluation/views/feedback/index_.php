<?php
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

//echo $ip;
?>
<div class="container">
    <div class="row">
        <!-- ./col -->
        <div class="col-lg-4 col-sm-4">
            <div class="card">
                <a href=<?='create?business_unit_id=20&agency_id=' . $_GET['agency_id'] ?>><img class="image" src="/images/cfs/budgeting.jpg" alt="Accounting and Budgetting"></a>
                <div class="text">Accounting and Budgeting</div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4">
            <div class="card card-image2">
                <a href=<?='create?business_unit_id=30&agency_id=' . $_GET['agency_id'] ?>><img class="image" src="/images/cfs/cashiering.jpg" alt="Casheiring"></a>
                <div class="text">Cashiering</div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4">
            <div class="card card-image3">
                <a href=<?='create?business_unit_id=40&agency_id=' . $_GET['agency_id'] ?>><img class="image" src="/images/cfs/purchasing.jpg" alt="Purchasing"></a>
                <div class="text">Purchasing</div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4">
            <div class="card card-image4">
                <a href=<?='create?business_unit_id=50&agency_id=' . $_GET['agency_id'] ?>><img class="image" src="/images/cfs/hrmo.jpg" alt="Human Resource"></a>
                <div class="text">Human Resource</div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4">
            <div class="card card-image5">
                <a href=<?='create?business_unit_id=60&agency_id=' . $_GET['agency_id'] ?>><img class="image" src="/images/cfs/maintenance.jpg" alt="Maintenance"></a>
                <div class="text">Maintenance</div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4">
            <div class="card card-image6">
                <a href=<?='create?business_unit_id=70&agency_id=' . $_GET['agency_id'] ?>><img class="image" src="/images/cfs/stis.jpg" alt="Science & Tech. Information Service"></a>
                <div class="text">Science & Tech. Information Service</div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4">
            <div class="card card-image7">
                <a href=<?='create?business_unit_id=80&agency_id=' . $_GET['agency_id'] ?>><img class="image" src="/images/cfs/scholars.jpg" alt="Science & Tech. Scholarship"></a>
                <div class="text">Science & Tech. Scholarship</div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4">
            <div class="card card-image8">
                <a href=<?='create?business_unit_id=90&agency_id=' . $_GET['agency_id'] ?>><img class="image" src="/images/cfs/inovation.jpg" alt="Innovation System Support"></a>
                <div class="text">Innovation System Support</div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4">
            <div class="card card-image9">
                <a href=<?='create?business_unit_id=100&agency_id=' . $_GET['agency_id'] ?>><img class="image" src="/images/cfs/stii.jpg" alt="Science & Tech. Intervention"></a>
                <div class="text">Science & Tech. Intervention</div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        height: 11vw;
        width: 17vw;
        margin: auto;
        margin-top: 25px;
        display: block;
        transition: transform .2s;
        /* Animation */
    }

    .card:hover {
        transform: scale(1.05);
    }

    img.image {
        max-height: 100%;
        max-width: 100%;
    }

    div.text {
        text-align: center;
        font-weight: bold;
        font-size: 1vw;
    }

    .content-wrapper {
        min-height: calc(100vh - 101px);
        background-color: white;
        z-index: 800;
    }

    .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: #f7f7f7;
        color: white;
    }
</style>