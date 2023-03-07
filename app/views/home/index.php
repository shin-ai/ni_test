<style>
    .banner {
        height: 80vh;
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)) skyblue;
        color: white;
    }

    .banner-content {
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
<div class="container-fluid banner ">
    <div class="container banner-content col-lg-6">
        <div class="text-center">
            <p class="fs-1">Selamat Datang di Website Saya</p>
            <p>
                Hallo nama saya <?= $data['nama']; ?>
            </p>
        </div>
    </div>
</div>